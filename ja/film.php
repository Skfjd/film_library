<html>
    <head>
        <title>Wypożyczalnia</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="filmy.css" type="text/css">
    </head>
    <body>
        <div id="header">
            <?php
            if(empty($_COOKIE["email"])&&empty($_COOKIE["nazw"])){
                echo '<div class="log"><a href="log.php">Zaloguj się </a><br><br>
                <a href="rejestracja.php">Zarejestruj się </a></div>';}
            else{
            echo '<div class="log">Zalogowano jako: '.$_COOKIE["email"].
            '<br><br><a href="wypozycz.php?d=1">Wyloguj</a><br><br>
            <a href="wypozyczone.php">Zobacz wypożyczone filmy</a>
            </div>';
            $email=$_COOKIE["email"];
            $nazw=$_COOKIE["nazw"];
            }
            ?>
            <h1><a href="wypozycz.php"><img id="logo" src="zdj/logo.png"></a></h1>
        </div>
        <div id="pom1">
            <div id="cofnij" > <button id='but' onclick="window.location.href='wypozycz.php'"><img id='strz' src='zdj/strzalka.png'></button></div>
            <?php
                if(empty($_GET['id'])){ 
                    echo 'Błąd wybranego filmu, wybierz ponownie film ze strony głównej.';
                }
                else{
                $id=$_GET['id'];
                $conn=mysqli_connect('localhost','root','','film');
                $out=mysqli_query($conn, "SELECT zdj,tytul,rezyser,wytwornia,gatunek,gatunek2,gatunek3,rok_wyd,cena FROM film WHERE id='$id'");
                while($row=mysqli_fetch_array($out)){
                    echo '<div id="prev"><img id="pic" src='.$row['zdj'].'></div>';
                    echo '<div id="desc"><h3>'.$row['tytul'].'</h3>'.
                    "Gatunek: ".$row['gatunek'].', '.$row['gatunek2'].', '.$row['gatunek3'].'<br>'.
                    "Reżyser: ".$row['rezyser'].'<br>'.
                    "Rok wydania: ".$row['rok_wyd'].'<br>'.
                    "Cena: ".$row['cena'].'<br>';
                    $cena=$row['cena'];
                }
                $out3=mysqli_query($conn,"SELECT AVG(ocena) AS avg FROM `film`,`ocena` WHERE id_film=film.id AND film.id='$id'");
                $row3=mysqli_fetch_array($out3);
                if($row3['avg']==0){
                  echo  'Brak ocen</div>';
                }
                if($row3['avg']>0){
                echo "Średnia ocena filmu ".ROUND($row3['avg'],2)."</div>";}
                ?>
                <div id="wypozycz">
                    Wypożycz film!
                    <form method="POST">
                        <label>Do kiedy </label><input name="do" type="date">
                        <button type="submit">x</button><br>
                        <?php
                        if(!empty($email)&&!empty($nazw)){   
                            if(!empty($_POST['do'])){
                                $log=mysqli_query($conn, "SELECT id FROM klient WHERE nazwisko='$nazw' AND email='$email'");
                                $row4=mysqli_fetch_array($log);
                                $idk=$row4['id'];
                                $od=date('Y-m-d');
                                $do=$_POST['do'];
                                $dni=(strtotime($_POST['do'])-strtotime(date('Y-m-d')))/86400;
                                if($dni<1){
                                    echo 'Minimalny czas wypożyczenia to jeden dzień';
                                }
                                else{
                                    echo 'Czas wypożyczenia to: '.$dni.' dni.<br>
                                    Cena wypożyczenia to: '.$dni*$cena.'zł<br>';
                                    $sql="INSERT INTO wypozyczenia (id_os,id_film,od,do) 
                                    VALUES ('$idk','$id','$od','$do')";
                                    mysqli_query($conn, $sql);
                                    echo 'Wypożyczono film!';
                                }
                            }
                            else
                            echo 'Ustaw date końca wypożyczenia';
                        }
                        else
                        echo 'Najpierw się zaloguj';
                        ?>
                        </form>
                        </div>
                <?php
                $out2=mysqli_query($conn, "SELECT ocena,opinia FROM ocena WHERE id_film='$id'");     
                    echo '<p id="comt">Opinie dotyczące filmu</p>'.'<a href="ocena.php?id='.$id.'"><div>'.'Dodaj opinie'.'</div></a>';;
                while($row2=mysqli_fetch_array($out2)){
                    echo '<div class="com">'.$row2['ocena'].' '.$row2['opinia'].'</div>';
                    }
                }
            ?>
        </div>
        <div id="footer">
            <h4> Damian Jargieło</h4>
        </div>
    </body>
</html>