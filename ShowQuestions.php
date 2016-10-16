<?php 
	
	$esteka = mysqli_connect("localhost","root","","quizz");
	//$esteka = mysqli_connect("mysql.hostinger.es","u362104564_mikel","123456","u362104564_erab");
	
	if(!$esteka){
		echo "Hutsegitea MySQLra konektatzerakoan." .PHP_EOL;
		echo "errno depurazio akatsa: " . mysqli_connect_errno().PHP_EOL;
		echo "error depurazio akatsa: " . mysqli_connect_error().PHP_EOL;
		exit;
	}
	
	$sql = "SELECT * FROM galdera";
		
	$ema=mysqli_query($esteka,$sql);
	
	echo '<h1 align="center">GALDERAK</h1>';
	
	while($row=mysqli_fetch_array($ema,MYSQLI_ASSOC)){
		echo '<div align="center"><fieldset style="max-width:50%;" ><p>Galdera: '.$row['Galdera'].'</p><p>Zailtasuna: '.$row['Zailtasuna'].'</p><br></fieldset></div>';
	}
	
	mysqli_close($esteka);
	
?>

<html>
<body>

	<div align="center"><a href='layout.html'>Itzuli</a></div>

</body>
</html> 