<html>
	<header>
		
	</header>
	<body>
		<div align="center">
		
			<form id="insertQuestion" name="insertQuestion" onSubmit="return konprobazioa()" enctype="multipart/form-data" method="post" action="InsertQuestion.php">
			<fieldset style="max-width:50%;">
				<legend>InsertQuestion</legend><br>
				Galdera: <input type="text" name="galdera"><br><br>
				Erantzuna: <input type="text" name="erantzuna"><br><br>
				Zailtasun-maila:  <select name="zailtasuna">
									<option value="null"></option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
							</select> <br>
				
				
				 <small><i>* Galderaren zailtasun maila 1etik 5era (oso sinplea - oso zaila)</i></small><br><br>
				
				<input name="button" type="submit" value="Galdera gehitu">
			</fieldset>
			</form>
			
			<p>Sakatu Galdera gehitu botoia galdera bat gehitzeko.</p>
			<span><a href='layout.html'>Itzuli</a></span>
		</div>
	</body>
</html>
<?php 

	$email = $_POST['email'];
	echo "$email";

if(isset($_POST['galdera'],$_POST['erantzuna'],$_POST['zailtasuna'])){
	
	$esteka = mysqli_connect("localhost","root","","quizz");
	//$esteka = mysqli_connect("mysql.hostinger.es","u362104564_mikel","123456","u362104564_erab");
	

	if(!$esteka){
		echo "Hutsegitea MySQLra konektatzerakoan." .PHP_EOL;
		echo "errno depurazio akatsa: " . mysqli_connect_errno().PHP_EOL;
		echo "error depurazio akatsa: " . mysqli_connect_error().PHP_EOL;
		exit;
	}

	$sql = "INSERT INTO 
		galdera(Eposta,Galdera,Erantzuna,Zailtasuna) 
		VALUES('$email','$_POST[galdera]','$_POST[erantzuna]',
		'$_POST[zailtasuna]')";
		
		if(!mysqli_query($esteka,$sql)){
		die('Errorea query-a gauzatzerakoan: ' .mysqli_error($esteka));
	}
	

		mysqli_close($esteka);
}


?>