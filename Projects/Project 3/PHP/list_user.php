<?php

require_once('../mysqli_connect.php');

$query = "SELECT * FROM park";

$response = @mysqli_query($dbc, $query);

if($response){
	echo '<table align="left">
	
	<tr>
	<td><b>ID</b></td>
	<td><b>Name</b></td>
	<td><b>Desc</b></td>
	<td><b>Lat</b></td>
	<td><b>Lon</b></td>
	<td><b>Im</b></td>
	<td><b>Vid</b></td>
	<td><b>Creat</b></td>
	<td><b>Upd</b></td>
	</tr>';
	
	while($row = mysqli_fetch_array($response)){
		echo '<tr><td>' .
		$row['id'] . '</td><td>' .
		$row['name'] . '</td><td>' .
		$row['description'] . '</td><td>' .
		$row['latitude'] . '</td><td>' .
		$row['longitude'] . '</td><td>' .
		$row['image'] . '</td><td>' .
		$row['video'] . '</td><td>' .
		$row['date_created'] . '</td><td>' .
		$row['date_updated'] . '</td>';
		
		echo '</tr>';
	}
	
	echo '</table>';
} else {
	
	echo "DB query failed."; 
	
	echo mysqli_error($dbc);
	
}

mysqli_close($dbc);

?>