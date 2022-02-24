<?php


	function GET_ID($tablename, $idname){
		$id = "";
		$connect = mysqli_connect("localhost", "root", "", "CultureXdb");
		$select = "SELECT * FROM $tablename";
		$run = mysqli_query($connect, $select);
		$num = mysqli_num_rows($run);

		if($num==0){
			$id = 1;
		}
		elseif($num>=1){
			for($a=0;$a<$num;$a++){
				$data = mysqli_fetch_array($run);	
				$tempid = $data[$idname];
				if($tempid-1==$a){
					$id = $a+2;
				}
				elseif($tempid-1!=$a){
					$id = $a+1;
					break;
				}
			}
		}
		return $id;
	}

	function GET_ATTRIBUTE($tablename, $input_attribute_col_name, $input_attribute_value, $wantedattribute){
		$attribute = "";
		$connect = mysqli_connect("localhost", "root", "", "CultureXdb");
		$select = "SELECT * FROM $tablename";
		$run = mysqli_query($connect, $select);
		$num = mysqli_num_rows($run);

		for($i=0;$i<$num;$i++){
			$data = mysqli_fetch_array($run);
			$tempattribute = $data[$input_attribute_col_name];
			if($tempattribute==$input_attribute_value){
				$attribute = $data[$wantedattribute];
				break;
			}
			else{
				$attribute = "";
			}
		}

		return $attribute;
	}


	function CHECK_ATTRIBUTE($tablename, $input_attribute_col_name, $input_attribute_value){
		$attribute = "";
		$connect = mysqli_connect("localhost", "root", "", "CultureXdb");
		$select = "SELECT * FROM $tablename";
		$run = mysqli_query($connect, $select);
		$num = mysqli_num_rows($run);

		for($i=0;$i<$num;$i++){
			$data = mysqli_fetch_array($run);
			$tempattribute = $data[$input_attribute_col_name];
			if($tempattribute==$input_attribute_value){
				$attribute = $tempattribute;
				break;
			}
			else{
				$attribute = "";
			}
		}

		return $attribute;
	}

	function CHECK_PASSWORD($tablename, $tableattribute1, $tableattribute2, $input_attribute){
		$attribute = "";
		$connect = mysqli_connect("localhost", "root", "", "CultureXdb");
		$select = "SELECT * FROM $tablename";
		$run = mysqli_query($connect, $select);
		$num = mysqli_num_rows($run);

		for($i=0;$i<$num;$i++){
			$data = mysqli_fetch_array($run);
			$tempattribute = $data[$tableattribute1];
			if($tempattribute==$input_attribute){
				$attribute = $data[$tableattribute2];
				break;
			}
			else{
				$attribute = "";
			}
		}

		return $attribute;
	}

?>