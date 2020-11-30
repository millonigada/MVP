<?php 
	
	$pdo = new PDO('mysql:host=localhost; port=3306; dbname=mvp', 'root', '');
	// $stmt = $pdo->query("SELECT * FROM content_type");
	// while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	// {
	// 	print_r($row);
	// }

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>