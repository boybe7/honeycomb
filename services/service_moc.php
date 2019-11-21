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
        $sid = 0;
        $subgroup = "";
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
		    if($data[2]=="หน่วย" || $data[2]=="")
		    {
		       if($data[0]!="")
		       {	
		    	$group = $data[1];
		    	$group_id = $data[0];
		    	//echo "group:".$group_id.":".$group."<br>";
		       }	
		    	
		    }
		    else{
		    	
		    	//$data[1] = $group.$data[1];
		    	$data[1] = $data[1];
		    }

		    
           
            if($data[2]!="หน่วย" && $data[2]!="" && $data[4]!="-")
            {	
		    	$json_data[] = array("id"=>$data[0],"name"=>$data[1],"unit"=>$data[2],"lastprice"=>$data[3],"price"=>$data[4],'group_id'=>$group_id,'group'=>$group);
		    	echo "data:".$data[1].":".$group."<br>";
		    	$group_id = intval(substr($group_id, 0,2));
		    	if($subgroup!=$group)
	     	 	{
	     	 		$subgroup = $group;
	     	 		$sid++;

	     	 		$sql = "INSERT INTO material (id,name) values('$sid','$group')";
	     	 	
			    	echo $sql."<br>";
		     	 	$conn->query($sql);
	     	 	}


		    	

	     	 	
	     	 	$id++;
		    	//print_r($json_data);
		    	//echo "<br>";
		    }	
		

		    $data = array();
		}

		$group_id = 0;
		$old_group = "";
		// foreach ($json_data as $key => $data) {
		// 	         //print_r($data);
			        
		// 	    	 $id = $data["id"];
		// 	    	 $name = $data["name"];
		// 	    	 $unit = $data["unit"];
		// 	    	 $lastprice = str_replace(",", "", $data["lastprice"]) ;
		// 	    	 $price = str_replace(",", "", $data["price"]) ;
			    	 
			    	

		//           	$today = date("Y-m-d H:i:s");
			   
		// 	    	 $sql = "SELECT  COUNT( * ) AS TOTALFOUND FROM moc_price WHERE code='$id' AND month='$month' AND year='$year'";
		// 	    	 $result = $conn->query($sql);
		// 	    	 $row_array = mysqli_fetch_array($result, MYSQLI_ASSOC);
		// 			if($row_array['TOTALFOUND']==0){
  //                        echo $id.":insert<br>";
		// 				//insert new material
		// 				$sql = "INSERT INTO moc_price (code,name,unit,price,month,year,datetime_record) values('$id','$name','$unit','$price','$month','$year','$today')";
	 //    	 			$conn->query($sql);
		// 			}
		// 			else{
		// 				 $sql = "UPDATE moc_price SET name='$name',price='$price',datetime_record='$today'  WHERE code='$id' AND month='$month' AND year='$year'";
		// 	    	 	 $conn->query($sql);

		// 			} 


		// 			//insert mapping
		// 			/*$group = $data["group"];
		// 			if($group != $old_group)
		// 			{
		// 				$old_group = $group;
		// 				echo $group."<br>";
		// 				$sql = "INSERT INTO moc_group (id,name,code) values('$group_id','$group','$id')";
	 //    	 			$conn->query($sql);
		// 				$group_id++;
		// 			}	*/
					


		             
		// }

	
		

         mysqli_close($conn)
?>  