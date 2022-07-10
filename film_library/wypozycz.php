<html>
    <head>
        <title>Wypożyczalnia</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="filmy.css" type="text/css">
    </head>
    <body>
        <div id="header">
            <?php
            if(!empty($_GET['d'])){
                setcookie("email","",time()-(300));
                setcookie("nazw","",time()-(300));
            }
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
            <h2>Wypożycz film!</h2>
            <?php
                $conn=mysqli_connect('localhost','root','','film');
                if(!empty($_POST['sb'])){
                    $sb=$_POST['sb'];
                    $out=mysqli_query($conn, "SELECT zdj,tytul,id FROM film WHERE tytul LIKE '$sb%'");
                }
                else{
                    $out2=mysqli_query($conn, "SELECT zdj,tytul,id FROM film ORDER BY rok_wyd DESC;");
                    $out=mysqli_query($conn, "SELECT zdj,tytul,id FROM film;");
                echo '<h2>Najnowsze dostępne filmy: </h2>';
                for($i=0;$i<=5;$i++){
                    $row2=mysqli_fetch_array($out2);
                    echo '<div class="movie"><a href=film.php?id='.$row2['id'].'>'.
                    '<img class="img" src='.$row2['zdj'].'><h3>'.
                    $row2['tytul'].'</h3></a></div>';
                }
                }
                echo '<h2 style="clear: both">Wszystkie dostępne filmy: </h3>';
                while($row=mysqli_fetch_array($out)){
                    echo '<div class="movie"><a href=film.php?id='.$row['id'].'>'.
                    '<img class="img" src='.$row['zdj'].'><h3>'.
                    $row['tytul'].'</h3></a></div>';
                }
            ?>
        </div>
        <div id="footer" style="position: relative !important">
            <h4>Damian Jargieło</h4>
        </div>
    </body>
</html>