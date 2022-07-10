<html>
<head>
    <title>Wypożyczalnia</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="filmy.css" type="text/css">
</head>
<body>
    <div id="header">
        <h1><a href="wypozycz.php"><img id="logo" src="zdj/logo.png"></a></h1>
    </div>
    <div id="pom">
        <div id="cofnij" > <button id='but' onclick="window.location.href='wypozycz.php'"><img id='strz' src='zdj/strzalka.png'></button></div>
    <h1>Rejestracja</h1>
    <div id="logg">
    <form action="" method="POST">
        <table id="form"><tr>
        <td><label>Email: </label></td><td><input type="email" name="emil"></td></tr>
        <tr><td><label>Imię: </label></td><td><input type="text" name="imie"></td></tr>
        <tr><td><label>Nazwisko: </label></td><td><input type="text" name="nazwisko"></td></tr>
        <tr><td><label>Nr konta </label></td><td><input type="text" name="nr" maxlength="26"></td></tr>
        <tr><td colspan="2"><button type="submit">Zarejestruj</button><button type="reset">Wyczyść</button></td></tr>
        </table>
    </form>
</div>
    <?php
$conn=Mysqli_connect('localhost','root','','film');
if(!empty($_POST['emil']) && !empty($_POST['imie']) && !empty($_POST['nazwisko']) && !empty($_POST['nr'])){
   
$email=$_POST['emil'];
$imie=$_POST['imie'];
$nazw=$_POST['nazwisko'];
$nrk=$_POST['nr'];
$jest=Mysqli_query($conn,"SELECT email FROM klient WHERE email='$email' OR (imie='$imie' AND nazwisko='$nazw') OR nr_konta='$nrk';");
$row=mysqli_fetch_array($jest);
if(mysqli_num_rows($jest)>0) {
    echo 'SORRY ALE KONTO NA TE DANE ISTNIEJE';
}
if(mysqli_num_rows($jest)<1){
    $sql = "INSERT INTO klient (imie, nazwisko, email, nr_konta)
    VALUES ('$imie', '$nazw', '$email', '$nrk')";
    mysqli_query($conn, $sql);
}
}
?>
</div>
<div id="footer">
    <h4>Damian Jargieło</h4>
</div>
</body>
</html>