

<?php 

$esteka = mysqli_connect("localhost","root","","quizz");
//$esteka = mysqli_connect("mysql.hostinger.es","u362104564_mikel","123456","u362104564_erab");

if(!$esteka){
	echo "Hutsegitea MySQLra konektatzerakoan." .PHP_EOL;
	echo "errno depurazio akatsa: " . mysqli_connect_errno().PHP_EOL;
	echo "error depurazio akatsa: " . mysqli_connect_error().PHP_EOL;
	exit;
}

// Balioztatzea zerbitzari aldean
$echomessage = "";
$echomessage2 = "";

$name = $_POST['name'];
if (filter_var($name, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[A-Z]{1}[a-z]+$/")))){
	$echomessage2 .= "Izena onartua.\n";
} else{
	$echomessage .= "Izena idatzi behar da, letra larriz hasita.\n";
}
$surname = $_POST['surname'];
if (filter_var($surname, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[A-Z]{1}[a-z]+\s+[A-Z]{1}[a-z]+$/")))){
	$echomessage2 .= "Abizena onartua.\n";
} else{
	$echomessage .= "Bi abizen idatzi behar dira, biak letra larriz hasita.\n". $surname;
}
$email = $_POST['email'];
if (filter_var($email, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[a-z]+[0-9]{3}@ikasle\.ehu\.(eus|es)$/")))){
	$echomessage2 .= "Emaila onartua.\n";
} else{
	$echomessage .= "Email okerra, Email egokia: ikasleizena+3digitu@ikasle.ehu.e(u)s\n";
}
$password = $_POST['password'];
if (strlen($password) >= 6){
	$echomessage2 .= "Pasahitza onartua.\n";
} else{
	$echomessage .= "Pasahitzak gutxienez 6 karaktere izan behar ditu.\n";
}
$phone = $_POST['phone'];
if (filter_var($phone, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^\d{9}$/")))){
	$echomessage2 .= "Telefono zenbakia onartua.\n";
} else{
	$echomessage .= "Telefono zenbaki okerra, Telefono zenbaki egokia: 9 digitu\n";
}
if($echomessage != ""){
	echo $echomessage; exit;
}else{
	echo $echomessage2;
}


// Espezialitatea besterik bada.
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
		
		// Fitxategi tenporala
        $tenporala = $_FILES['files']['tmp_name'];

        // Fitxategi mota
        $tipo = $_FILES['files']['type'];

        // Fitxategi tenporalaren edukia bitarrean irakurri.
        $fp = fopen($tenporala, 'r+b');
        $data = fread($fp, filesize($tenporala));
        fclose($fp);
        
        $data = mysql_escape_string($data);

        // Datu basean gorde.
        		$sql = "INSERT INTO 
		erabiltzaile(Izena,Abizenak,Eposta,Pasahitza,
		Telefonoa,Espezialitatea,Gehigarriak,Argazkia,Formatua) 
		VALUES('$_POST[name]','$_POST[surname]','$_POST[email]',
		'$_POST[password]','$_POST[phone]','$varEspezialitatea',
		'$_POST[message]','$data','$tipo')";
	
		if(!mysqli_query($esteka,$sql)){
		die('Errorea query-a gauzatzerakoan: ' .mysqli_error($esteka));
		}
		
	} else {
		echo "Fitxategi honek ez du balio, ez du formatu egokia edo tamaina handiegia, gehienez $limitea_kb Kilobyte";
	}
		echo "Erregistro bat gehitu da!";
		echo "<p><a href='IkusiErabiltzaileakWithImage.php'> Erregistroak ikusi</a></p>";
	
}

mysqli_close($esteka);
?>

<html>
<body>

<span><a href='layout.html'>Itzuli</a></span>

</body>
</html> 