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

$email = $_POST['email'];
if (filter_var($email, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[a-z]+[0-9]{3}@ikasle\.ehu\.(eus|es)$/")))){
	echo("emaila onartua, ");
} else{
	echo("email desegokia ");
}



$varEspezialitatea = $_POST['espezialitatea'];
if($varEspezialitatea == 'besterik'){
	$varEspezialitatea = $_POST['message2'];
}

//Argazkirik ez.
if ($_FILES["files"]["error"] > 0){
	
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
	echo "<p><a href='IkusiErabiltzaileakWithImage.php'> Erregistroak ikusi</a></p>";
	
//Argazkia bai.	
} else {
	//Fitxategi egokia dela ziurtatu
	//baita tamaina egokia duela.
	$baimenduak = array("image/jpg", "image/jpeg", "image/gif", "image/png");
	$limitea_kb = 100;

	
	if (in_array($_FILES['files']['type'], $baimenduak) && $_FILES['files']['size'] <= $limitea_kb * 1024){
		
		$izena = $_FILES['files']['name'];
		$path = "images/$izena";
		$sql = "INSERT INTO 
		erabiltzaile(Izena,Abizenak,Eposta,Pasahitza,
		Telefonoa,Espezialitatea,Gehigarriak,Argazkia) 
		VALUES('$_POST[name]','$_POST[surname]','$_POST[email]',
		'$_POST[password]','$_POST[phone]','$varEspezialitatea',
		'$_POST[message]','$izena')";
	
		if(!mysqli_query($esteka,$sql)){
		die('Errorea query-a gauzatzerakoan: ' .mysqli_error($esteka));
		}
			
		//Argazkiak images karpetan metatu.
		$target_path = "images/";
		$target_path = $target_path . basename( $_FILES['files']['name']); 
		if(move_uploaded_file($_FILES['files']['tmp_name'], $target_path)) { 
			echo "". basename( $_FILES['files']['name']). " ongi igo da. ";
		} else{
		echo "Errore bat gertatu da, saiatu berriz!";
		}
		
	} else {
		echo "Fitxategi honek ez du balio, ez du formatu egokia edo tamaina handiegia, gehienez $limitea_kb Kilobyte";
	}
		echo "Erregistro bat gehitu da!";
		echo "<p><a href='IkusiErabiltzaileakWithImage.php'> Erregistroak ikusi</a></p>";
	
}




mysqli_close($esteka);
?>

<span><a href='layout.html'>Itzuli</a></span>

</body>
</html> 