<html>
<body>

<?php 

$esteka = mysqli_connect("localhost","root","","quiz");
//$esteka = mysqli_connect("mysql.hostinger.es","u362104564_mikel","123456","u362104564_erab");

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



//Errore konprobaketa.
if ($_FILES["files"]["error"] > 0){
	echo "ha ocurrido un error";
} else {
	//Fitxategi egokia dela ziurtatu
	//baita tamaina egokia duela.
	$baimenduak = array("image/jpg", "image/jpeg", "image/gif", "image/png");
	$limitea_kb = 100;

	if (in_array($_FILES['files']['type'], $baimenduak) && $_FILES['files']['size'] <= $limitea_kb * 1024){
		//Argazkiak images karpetan metatu.
		$target_path = "images/";
		$target_path = $target_path . basename( $_FILES['files']['name']); 
		if(move_uploaded_file($_FILES['files']['tmp_name'], $target_path)) { 
			echo "". basename( $_FILES['files']['name']). " ongi igo da. ";
		} else{
		echo "Errore bat gertatu da, saiatu berriz!";
		}
		$izena = $_FILES['files']['name'];
		$sql = "INSERT INTO 
		erabiltzaile(Izena,Abizenak,Eposta,Pasahitza,
		Telefonoa,Espezialitatea,Gehigarriak,Argazkia) 
		VALUES('$_POST[name]','$_POST[surname]','$_POST[email]',
		'$_POST[password]','$_POST[phone]','$varEspezialitatea',
		'$_POST[message]','$izena')";
		
		if(!mysqli_query($esteka,$sql)){
			die('Errorea query-a gauzatzerakoan: ' .mysqli_error($esteka));
		}

		echo "Erregistro bat gehitu da!";
		echo "<p><a href='IkusiErabiltzaileak.php'> Erregistroak ikusi</a></p>";
		
	} else {
		echo "Fitxategi honek ez du balio, ez du formatu egokia edo tamaina handiegia, gehienez $limitea_kb Kilobyte";
	}
}




mysqli_close($esteka);
?>

<span><a href='layout.html'>Itzuli</a></span>

</body>
</html> 