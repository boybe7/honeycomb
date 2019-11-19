<?php  

 
   // Connect DB

    $servername = "localhost";
	$username = "root";
	$password = "meroot";
	$dbname = "m_price";
	
	date_default_timezone_set("Asia/Bangkok");

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$today = date("Y-m-d H:i:s");
	$sql = "SET CHARACTER SET utf8";
	$res = $conn->query($sql);
	ini_set('max_execution_time', 300); 

	//--------------GET CONTENT FROM MOC-------//
	if(!isset($_GET['month']) && !isset($_GET['year']))
	{
		$dates = explode("-",date("n-Y"));
		//print_r($dates);
		if($dates[0]==1){
			$month = 12;
			$year = $dates[1]+ 543 -1;
		}else{
			$month = $dates[0]-1;
			$year = $dates[1]+ 543;
		} 
		//echo $month.":".$year;
		$month_str = $month < 10 ? '0'.$month : $month ;
	}
	else{
		$month_str = $_GET['month'];
		$month = intval($_GET['month']);
		$year = $_GET['year'];
	}	

		//http://203.209.116.53/PRICE_PRESENT/tablecsi_month_region.asp?DDMonth=01&DDYear=2562&DDProvince=10&B1=%B5%A1%C5%A7
		$url="http://203.209.116.53/PRICE_PRESENT/tablecsi_month_region.asp?DDMonth=".$month_str."&DDYear=".$year."&DDProvince=10&B1=%B5%A1%C5%A7";

	
		$data = array('Submit' => '1');
		$options = array(
				'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data),
			)
		);

		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		//print_r($result);
		$result = iconv( 'windows-874','UTF-8', $result);

		
		$src = new DOMDocument('1.0', 'utf-8');
		$src->formatOutput = true;
		$src->preserveWhiteSpace = false;
		$content = file_get_contents($url, false, $context);
		@$src->loadHTML($content);
		$xpath = new DOMXPath($src);
		$values=$xpath->query('//tr[ contains (@class, "") ]');
		$i = 0;

		$json_data = array();
		$rows= $xpath->query('//table/tr');
        $group = "";
        $group_id = 0;
        $id = 1;
		for( $i = 1, $max = $rows->length ; $i < $max; $i++)
		 {
		    $row = $rows->item( $i);
		    $cols = $xpath->query( 'td', $row);
		    $data = array();
		    $cid = 0;
		    //print("//----------------".$i."-------------//<br>");
		    foreach( $cols as $col) {
		        //echo $col->textContent."<br>";
		        $data[] = trim($col->textContent);
		        $cid++;

		    }


		    for($j=$cid;$j<5;$j++)
		    {
		    	$data[] = "";
		    }
		    if($data[0]!="")
		   { 
		   		$json_data[] = $data;
		   		 echo $data[0].":".$data[1].":".$data[2].":".$data[3].":".$data[4]."<br>";
		   }

		    /*$str = substr(strval($data[0]), 6,12);
		    $str2 = substr(strval($data[0]), 5,12);
		    if($str2!='0000000000' && $str=='0000000000')
		   	{	 echo strval($data[0]).":".$str2.":".$str."<br>";
		   		 echo $data[1]."<br>"; 	
			}*/


		    /*if($data[2]=="หน่วย" )
		    {
		     
		    	$group = $data[1];
		    	$group_id = $data[0];
		    	echo "group:".$group_id.":".$group."<br>";
		       	$sql = "INSERT INTO moc_group (id,code,name) values('$id','$group_id','$group')";
	    	 	$conn->query($sql);
		    	$id++;
		    }*/
		

		    
          
		}

	
		

         mysqli_close($conn)
?>  