<html>

	<header>
		
	</header>
	<body>
		<div align="center">
		
			<form id="login" name="login" onSubmit="return konprobazioa()" enctype="multipart/form-data" method="post" action="InsertQuestion.php">
			<fieldset style="max-width:50%;">
				<legend>Sign-In</legend><br>
				Eposta elektronikoa: <input type="text" name="email"><br><br>
				Pasahitza: <input type="text" name="password"><br><br>
				
				<input name="button" type="submit" value="Sartu">
			</fieldset>
			</form>
			
			<p>Sakatu Sartu botoia sisteman sartzeko.</p>
			<span><a href='layout.html'>Itzuli</a></span>
			
		</div>
	</body>
</html>

<?php 
if(isset($_POST['email'],$_POST['password'])){

$esteka = mysqli_connect("localhost","root","","quizz");
//$esteka = mysqli_connect("mysql.hostinger.es","u362104564_mikel","123456","u362104564_erab");

if(!$esteka){
	echo "Hutsegitea MySQLra konektatzerakoan." .PHP_EOL;
	echo "errno depurazio akatsa: " . mysqli_connect_errno().PHP_EOL;
	echo "error depurazio akatsa: " . mysqli_connect_error().PHP_EOL;
	exit;
}

$ema=mysqli_query($esteka,"SELECT * FROM erabiltzaile WHERE Eposta='$_POST[email]' AND Pasahitza='$_POST[password]'");

if($ema->num_rows == 0){
	header('Location: SignIn.php');	
}else{
	header('Location: InsertQuestion.php');
}

mysqli_free_result($ema);

mysqli_close($esteka);

}
?>