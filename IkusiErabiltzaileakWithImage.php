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

$ema=mysqli_query($esteka,"SELECT * FROM erabiltzaile");

echo '<table border=1><tr><th>Izena</th><th>Abizenak</th><th>Eposta</th>
<th>Pasahitza</th><th>Telefonoa</th><th>Espezialitatea</th>
<th>Gehigarriak</th><th>Argazkia</tr>';

while($row=mysqli_fetch_array($ema,MYSQLI_ASSOC)){
	$id = $row['Argazkia'];

	echo '<tr><td>'.$row['Izena'].'</td><td>'.$row['Abizenak'].'</td>
	<td>'.$row['Eposta'].'</td><td>'.$row['Pasahitza'].'</td>
	<td>'.$row['Telefonoa'].'</td><td>'.$row['Espezialitatea'].'</td>
	<td>'.$row['Gehigarriak'].'</td><td>'."<img src='images/$id' />".'</td>';
}

echo '</table>';


mysqli_free_result($ema);


mysqli_close($esteka);
?>

<span><a href='layout.html'>Itzuli</a></span>

</body>
</html> 