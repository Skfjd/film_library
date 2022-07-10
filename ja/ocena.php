<html>
    <head>
        <title>Wypożyczalnia</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="filmy.css" type="text/css">
<script>
    function r(){
    var x = Number(document.getElementById("ocena").value);
    var k = Math.floor(x);
    document.getElementById("gwiazdki").innerHTML = "<td> " + "</td>";
        for(let i=0; i<k;i++){
            document.getElementById("gwiazdki").innerHTML += "<td><img class='gw' src='zdj/gwiazdka.png'>" + "</td>";
        }
        if(x-k>0){
        document.getElementById("gwiazdki").innerHTML += "<td><img class='gw' src='zdj/gwiazdkapol.png'>" + "</td>";
        }
    }
</script>
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
                        <div id='oc'>
                        <form action="" method="POST">
            </select>
            <label>Oceń film:</label>
            <select name="rating" id="ocena" onchange="r();">
            <option value=''>-</option>
                <option value="5">5</option>
                <option value="4.5">4.5</option>
                <option value="4">4</option>
                <option value="3.5">3.5</option>
                <option value="3">3</option>
                <option value="2.5">2.5</option>
                <option value="2">2</option>
                <option value="1.5">1.5</option>
                <option value="1">1</option>
            </select><br>
            <table id='gw1' ><tr id="gwiazdki"></tr></table>
            <textarea name="review" id="opinia" cols="50" rows="10" placeholder="Wpisz komentarz"></textarea><br>
            <button type="submit" >Prześlij</button>
            <?php
             $ob=$_GET['id'];
             if(!empty($ob)){
                 $conn=mysqli_connect('localhost','root','','film');
                 $out=mysqli_query($conn,"SELECT tytul,id,zdj FROM film WHERE id='$ob'");
                 $row=mysqli_fetch_array($out);  
             }
             else{
                 echo 'wybierz tytuł do dodania recenzji';
             }
                if(!empty($_POST['rating'])&&!empty($_POST['review'])){
                    $rating=$_POST['rating'];
                    $review=$_POST['review'];
                    $sql="INSERT INTO ocena (id_film,ocena,opinia)
                    VALUES ('$ob','$rating','$review')";
                    mysqli_query($conn,$sql);
                    echo 'Dodano nową recenzje!';
                }
                else{
                    echo 'Wpisz recenzje';
                }
            }
            ?>
        </form>
        </div>    
            <div id="footer">
            <h4>Made by Kacper Banert and Damian Jargieło</h4>
        </div>
    </body>
</html>