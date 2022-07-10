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
            }
            ?>
            <form method="POST" ><input type="text" name="sb" id="szukaj" placeholder="Wyszukaj film" onchange="this.form.submit()"></form>
            <h1><a href="wypozycz.php"><img id="logosb" src="zdj/logo.png"></a></h1>
        </div>
        <div id="main">
            <h2>Twoje wypożyczone filmy!</h2>
            <?php
                if(!empty($_COOKIE["email"])&&!empty($_COOKIE["nazw"])){
                    $email=$_COOKIE["email"];
                    $nazw=$_COOKIE["nazw"];
                    $conn=mysqli_connect('localhost','root','','film');
                    if(!empty($_POST['sb'])){
                        $sb=$_POST['sb'];
                        $out=mysqli_query($conn, "SELECT zdj,tytul,od,do,film.id FROM film,klient,wypozyczenia WHERE nazwisko='$nazw' AND email='$email' AND klient.id=id_os AND id_film=film.id AND tytul LIKE '$sb%'");
                    }
                    else{
                        $out=mysqli_query($conn, "SELECT zdj,tytul,od,do,film.id FROM film,klient,wypozyczenia WHERE nazwisko='$nazw' AND email='$email' AND klient.id=id_os AND id_film=film.id");
                    }
                    while($row=mysqli_fetch_array($out)){
                        echo '<div class="movie">'.'<a href=film.php?id='.$row['id'].'>'.
                        '<img class="img" src='.$row['zdj'].'><h3>'.
                        $row['tytul'].'</h3><h3>Wypożyczono </h3>'.$row['od'].' do '.$row['do'].'</a></div>';
                    }
                }
                else
                echo 'Najpierw sie zaloguj';
            ?>
        </div>
        <div id="footer">
            <h4>Damian Jargieło</h4>
        </div>
    </body>
</html>