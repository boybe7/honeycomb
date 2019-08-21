<?php  

 
   // Connect DB

    $servername = "localhost";
	$username = "root";
	$password = "meroot";
	$dbname = "m_price";
	
	date_default_timezone_set("Asia/Bangkok");



	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql = "SET CHARACTER SET utf8";
	$res = $conn->query($sql);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$today = date("Y-m-d H:i:s");
	$sql = "SELECT * FROM moc_price_map";
	$result = $conn->query($sql);

	$group = '';
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		echo $row['name']."<br>";
		$str = explode(" ", $row['name']);
		echo $str[0]."<br>";
	}

    mysqli_close($conn)
?>  