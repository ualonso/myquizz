<html>
<body>

<?php 

//$esteka = mysqli_connect("localhost","root","","quizz");
$esteka = mysqli_connect("mysql.hostinger.es","u362104564_mikel","123456","u362104564_erab");

if(!$esteka){
	echo "Hutsegitea MySQLra konektatzerakoan." .PHP_EOL;
	echo "errno depurazio akatsa:" . mysqli_connect_errno().PHP_EOL;
	echo "error depurazio akatsa:" . mysqli_connect_error().PHP_EOL;
	exit;
}
$varEspezialitatea = $_POST['espezialitatea'];
if($varEspezialitatea == 'besterik'){
	$varEspezialitatea = $_POST['message2'];
}
$sql = "INSERT INTO 
erabiltzaile(Izena,Abizenak,Eposta,Pasahitza,
Telefonoa,Espezialitatea,Gehigarriak,Argazkia) 
VALUES('$_POST[name]','$_POST[surname]','$_POST[email]',
'$_POST[password]','$_POST[phone]','$varEspezialitatea',
'$_POST[message]','')";

if(!mysqli_query($esteka,$sql)){
	die('Errorea query-a gauzatzerakoan: ' .mysqli_error($esteka));
}

echo "Erregistro bat gehitu da!";
echo "<p><a href='IkusiErabiltzaileak.php'> Erregistroak ikusi</a></p>";

mysqli_close($esteka);
?>

<span><a href='layout.html'>Itzuli</a></span>

</body>
</html> 