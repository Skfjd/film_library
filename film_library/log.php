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
        <h1><a href="wypozycz.php"><img id="logo" src="zdj/logo.png"></a></h1>  
    </div>
    <div id="pom">
        <div id="cofnij" > <button id='but' onclick="window.location.href='wypozycz.php'"><img id='strz' src='zdj/strzalka.png'></button></div>
    <h1>Zaloguj</h1>
    <form method="post" action="">
        <table id="form">
        <tr><td><label>E-mail</label></td><td><input type="email" name="email"></td></tr>
        <tr><td><label>Nazwisko</label></td><td><input type="text" name="nazw"></td></tr>
        <tr><td colspan="2"><label>Zapamiętaj na tym urządzeniu</label><input type="checkbox" name="rem"></td></tr>
        <tr><td colspan="2"><button type="submit">Zaloguj</button></td></tr>
        </table>
    </form>
    <?php
        error_reporting(0);
        $conn=Mysqli_connect('localhost','root','','film');
        if(isset($_POST['email']) && isset($_POST['nazw'])){
            $email=$_POST['email'];
            $nazw=$_POST['nazw'];
            $spr=mysqli_query($conn,"SELECT imie, nazwisko FROM klient WHERE email='$email'");
            $row=mysqli_fetch_array($spr);
        if($nazw==$row['nazwisko']){
            echo "Zalogowano jako ".$row['imie']." ".$row['nazwisko'];
            if(!$_POST['rem']){
            setcookie("email",$email,time()+(300));
            setcookie("nazw",$nazw,time()+(300));
            }
            else{
            setcookie("email",$email,time()+(86400*30*12));
            setcookie("nazw",$nazw,time()+(86400*30*12));
            }
        }
        if($nazw!=$row['nazwisko']){
            echo "Złe hasło lub login<br>";
            echo "Jeśli nie masz konta kliknij <a href='rejestracja.php'>zarejestruj się</a>";
        }
        }
    ?>
    </div>
    <div id="footer">
        <h4>Damian Jargieło</h4>
    </div>
</body>
</html>