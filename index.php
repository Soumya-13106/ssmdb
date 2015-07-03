<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript">
		$('#selectDBTag').change(function() {
		var parent = $(this).val();
		
		$('#payment_plan').children().each(function() {
			if($(this).data('parent') != parent) {
				$(this).hide();
			} else    $(this).show();
		});
	});
	</script>-->
</head>
<body>
	<?php
	// your config
	
	global $conn;
	$dbHost = '127.0.0.1';
	$dbUser = 'root';
	$dbPass = '';
	$dbName = 'dbms_project1';

	$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
	//$conn = mysqli_connect($dbHost,$dbUser,$dbPass) or die("unable to connect to server");

	if($mysqli->connect_errno) {
		echo "Connection failed";
		exit();
	}

	$result = $mysqli->query("USE dbms_project1");
	if (!$result) {
		echo 'Could not run query: ' . mysql_error();
		exit;
	}

?>
	<div id="modal">
		<div id="left">
		<form action='#' method="POST">
			<div class='field'>
			<input placeholder="Query" name="query">
			<label>Your Query</label>
			</div>
			<div class='field form-actions'>
			<button type='submit' name='customQuery' style="margin-left: 85px;">Execute</button>
			</div>

			<div class = "answer">
			<?php
			error_reporting(E_ERROR);
			if(isset($_POST["customQuery"])){
				$result = $mysqli->query($_POST["query"]);
				if (!$result) {
					echo 'Could not run query: ' . $mysqli->error();
					exit;
				}

				if(mysqli_num_rows($result) > 0){
					echo "<table>";
					$finfo = $result->fetch_fields();
					echo "<tr>";
					foreach ($finfo as $val) {
						echo "<td>" . $val->name . "</td>";
					}
					echo "</tr>";
					while($row = $result->fetch_array()) {
						$finfo = $result->fetch_fields();
						echo "<tr>";
						foreach ($finfo as $val) {
							echo "<td>" . $row[$val->name] . "</td>";
						}
						echo "</tr>";
					}
					echo "</table>";
				}
				else{
					echo "Query executed succesfully! No rows returned";
				}

			}
			?>
		</div>	
		</form>
		</div>


		<div id="center1">
		</div>

		<div id="middle">
			<div class='dropQueries'>
			<form action='#' method="POST">
		    <select name="queries" style="margin-right: 20px;width:100%;">
				<option value="SELECT * FROM actor GROUP BY name">SELECT * FROM actor GROUP BY name</option>
				<option value="SELECT * FROM movies WHERE title LIKE '%Princess%'">SELECT * FROM movies WHERE title LIKE "%Princess%"</option>
				<option value="SELECT * FROM actor, director WHERE actor.dob = director.dob">SELECT * FROM actor, director WHERE actor.dob = director.dob</option>
				<option value="SELECT * FROM director, movies WHERE director.did = 32">select * FROM director, movies WHERE director.did = 32</option>
			</select>
		  </div>
		  <div class='field form-actions'>
		    <button type='submit' name='dropExecute' style="margin-top: 13px; margin-left: 85px;">Execute</button>
		  </div>

			<?php
			if(isset($_POST["dropExecute"])){
				$result = $mysqli->query($_POST["queries"]);
				if (!$result) {
					echo 'Could not run query: ' . mysql_error();
					exit;
				}

				echo "<table>";
				$finfo = $result->fetch_fields();
				echo "<tr>";
				foreach ($finfo as $val) {
					echo "<td>" . $val->name . "</td>";
				}
				echo "</tr>";
				while($row = $result->fetch_array()) {
					$finfo = $result->fetch_fields();
					echo "<tr>";
					foreach ($finfo as $val) {
						echo "<td>" . $row[$val->name] . "</td>";
					}
					echo "</tr>";
				}
				echo "</table>";
			}

			?>

		</form>
		</div>

		<div id="center2">
		</div>

		<div id="right">
			<div id="selectDB">
			<form method="POST" action="#">
				<?php
				$res = $mysqli->query("SHOW TABLES");
				echo "<select name='selectDBTag' id='selectDBTag'>";
				while($cRow = mysqli_fetch_array($res)) {
					echo "<option value=" . $cRow[0] . ">" . $cRow[0] ."</option>";
				}
				echo "</select>"
				?>
				<br>
			<button type="submit" name="addEntry" id="addEntryID" style="padding-right: 56px;">Add</button>
			<button type="submit" name="updateEntry" id="updateEntryID" onclick="document.getElementById('selectDB').style.display='block';document.getElementById('executeQuery').style.display='block';">Update</button>
			<button type="submit" name="deleteEntry" id="deleteEntryID" onclick="document.getElementById('selectDB').style.display='block';document.getElementById('executeQuery').style.display='block';">Delete</button>
			<button type="submit" name="searchEntry" id="searchEntryID" onclick="document.getElementById('selectDB').style.display='block';document.getElementById('executeQuery').style.display='block';">Search</button>
			</form>
			</div>
			<form name='selectQueryForm' action='#' method='POST'>	
			<?php
			//echo $_POST['addEntry'];
			
			if(isset($_POST['addEntry'])) {
				$result = $mysqli->query("SELECT * from " . $_POST['selectDBTag']);
				if (!$result) {
					echo 'Could not run query: ' . $mysqli->error();
					exit;
				}
				$finfo = $result->fetch_fields();
				foreach ($finfo as $val) {
					echo "<input class='attributeTextField' type='";
					if($val->type===10) {
						echo "date";
					} elseif ($val->type===11) {
						echo "time";
					} else {
						echo "text";
					}
					echo "' placeholder='" . $val->name . "' name='" . $val->name . "'>";
				}
				echo "<input type='hidden' value='" .$_POST['selectDBTag'] ."' name='databaseNameSelected'/>";
				echo "<input type='hidden' value='add' name='queryType'/>";
			}
			
			if(isset($_POST['updateEntry']) || isset($_POST['deleteEntry'])) {
				$result = $mysqli->query("SELECT * from " .$_POST['selectDBTag']);
				if(!$result) {
					echo 'Could not run query: ' . $mysqli->error();
					exit();
				}

				while($row = $result->fetch_array()) {
					$finfo = $result->fetch_fields();
					$str = "<input type='radio' name='updateRB' class='updateRadioButton' value='";
					$tupleValues = "";
					$tupleHeaders = "";
					//echo "<input type='radio' name='updateRB' class='updateRadioButton' value='";
					//$flag=0;

					foreach ($finfo as $val) {
						/*if($val->flags=="49667") {
							$str .= "Bleh!".$row[$val->name];
						} else {
							$str .= "'>" .$row[$val->name];
						}*/
						$str .= $row[$val->name] .", ";
						$tupleValues .= $row[$val->name];
					}
					$str = rtrim($str, ", ");
					$str .= "'>";
					echo $str .$tupleValues ."<br>";
				}
				echo "<input type='hidden' value='" .$_POST['selectDBTag'] ."' name='databaseNameSelected'/>";
				if(isset($_POST['updateEntry'])){
					echo "<input type='hidden' value='update' name='queryType'/>";
				} elseif(isset($_POST['deleteEntry'])){
					echo "<input type='hidden' value='delete' name='queryType'/>";
				}
			}
			if(isset($_POST['searchEntry'])) {
				$result = $mysqli->query("SELECT * from " . $_POST['selectDBTag']);
				if (!$result) {
					echo 'Could not run query: ' . $mysqli->error();
					exit;
				}
				/*$finfo = $result->fetch_fields();
				foreach ($finfo as $val) {
					echo "<input class='attributeTextField' type='";
					if($val->type===10) {
						echo "date";
					} elseif ($val->type===11) {
						echo "time";
					} else {
						echo "text";
					}
					echo "' placeholder='" . $val->name . "' name='" . $val->name . "'>";
				}*/
				$finfo = $result->fetch_fields();
				foreach ($finfo as $val) {
					echo "<select name='" .$val->name ."Query'>";
					echo "<option value='" . $val->name . "'>" .$val->name ."</option>";
					$query1 = "SELECT DISTINCT " .$val->name ." from " . $_POST['selectDBTag'];
					$result = $mysqli->query($query1);
					while($row = $result->fetch_array()) {
						echo "<option value='" . $row[$val->name] . "'>" .$row[$val->name] ."</option>";
						/*$finfo1 = $result->fetch_fields();
						foreach ($finfo1 as $val1) {*/
						/*	if($val==$val1){
								echo "<option value='" . $row[$val1->name] . "'>" .$row[$val1->name] ."</option>";
							}
						*/
					}
					echo "</select>";
				}
				
				echo "<input type='hidden' value='" .$_POST['selectDBTag'] ."' name='databaseNameSelected'/>";
				echo "<input type='hidden' value='search' name='queryType'/>";
			}

			?>
			
			<button type="submit" name="execute" style="margin-left: 85px; margin-top: 13px;">Execute</button>
			</form>
			<?php

			/*print("<pre>");
			print_r($_POST);
			print("</pre>");
			*/
			if(isset($_POST['execute'])) {
				if($_POST['queryType']=="add") {
					$str = "INSERT INTO " .$_POST['databaseNameSelected'] . " (";
					$result1 = $mysqli->query("SELECT * from " .$_POST['databaseNameSelected']);
					if (!$result1) {
						echo 'Could not run query: ' . $mysqli->error();
						exit;
					}

					$finfo = $result1->fetch_fields();
					foreach ($finfo as $val) {
						$str.= " " .$val->name . ",";
					}
					$str = rtrim($str, ",");
					$str .= ") VALUES (";
					foreach ($finfo as $val) {
						$str.= " " ."'" .$_POST[$val->name] ."'" . ",";
					}
					$str = rtrim($str, ",");
					$str .= ")";
					
					echo "SQL Query becomes: " .$str;
					$result = $mysqli->query($str);
					if (!$result) {
						echo 'Could not run query: ' . $mysqli->error();
						exit;
					} else {
						echo "Query inserted";
					}
				} elseif($_POST['queryType']=="search") {
					$str = "SELECT * FROM " .$_POST['databaseNameSelected'] . " WHERE ";
					$result1 = $mysqli->query("SELECT * from " .$_POST['databaseNameSelected']);
					if (!$result1) {
						echo 'Could not run query: ' . $mysqli->error();
						exit;
					}
					print("<pre>");
					print_r($_POST);
					print("</pre>");
					
					$finfo = $result1->fetch_fields();
					foreach ($finfo as $val) {
						$str1 = $val->name . "Query";
						if($_POST[$str1]!=$val->name)
							$str .= $val->name ."=" ."'" .$_POST[$str1] ."' and ";
					}
					$str = rtrim($str, " and ");
					$str .= ";";
					
					echo "SQL Query becomes: " .$str;
					$result = $mysqli->query($str);
					if (!$result) {
						echo 'Could not run query: ' . $mysqli->error();
						exit;
					} else {
						echo "Query selected";
					}
					$finfo = $result->fetch_fields();
					echo "<table>";
					$finfo = $result->fetch_fields();
					echo "<tr>";
					foreach ($finfo as $val) {
						echo "<td>" . $val->name . "</td>";
					}
					echo "</tr>";

					while($row = $result->fetch_array()) {
						$finfo = $result->fetch_fields();
						echo "<tr>";
						foreach ($finfo as $val) {
							echo "<td>" . $row[$val->name] . "</td>";
						}
						echo "</tr>";
					}
					echo "</table>";
				} elseif($_POST['queryType']=="update") {
					print("<pre>");
					print_r($_POST);
					print("</pre>");
					$exploded = (explode(", ",$_POST['updateRB']));
					$result1 = $mysqli->query("SELECT * FROM " .$_POST['databaseNameSelected']);
					if(!$result1) {
						echo "Could not run query: " .$mysqli->error();
						exit();
					}
					$finfo = $result1->fetch_fields();
					/*foreach ($finfo as $val) {
						echo $val->name;
					}*/
					$i=0;
					$queryString = "SELECT * FROM " .$_POST['databaseNameSelected'] . " WHERE ";
					foreach ($finfo as $val) {
						$queryString .= $val->name . "='" .$exploded[$i] ."' and ";
						$i += 1;
					}
					$queryString = rtrim($queryString, ' and ');
					$queryString .= ";";
					echo "SQL query is: ";
					echo $queryString;
					$result = $mysqli->query($queryString);
					if (!$result) {
						echo "Could not run query: " . $mysqli->error();
						exit;
					} else {
						echo "Make changes";
					}
				} elseif($_POST['queryType']=="delete") {
					print("<pre>");
					print_r($_POST);
					print("</pre>");
					$exploded = (explode(", ",$_POST['updateRB']));
					$result1 = $mysqli->query("SELECT * FROM " .$_POST['databaseNameSelected']);
					if(!$result1) {
						echo "Could not run query: " .$mysqli->error();
						exit();
					}
					$finfo = $result1->fetch_fields();
					/*foreach ($finfo as $val) {
						echo $val->name;
					}*/
					$i=0;
					$queryString = "DELETE FROM " .$_POST['databaseNameSelected'] . " WHERE ";
					foreach ($finfo as $val) {
						$queryString .= $val->name . "='" .$exploded[$i] ."' and ";
						$i += 1;
					}
					$queryString = rtrim($queryString, ' and ');
					$queryString .= ";";
					echo "SQL query is: ";
					echo $queryString;
					$result = $mysqli->query($queryString);
					if (!$result) {
						echo "Could not run query: " . $mysqli->error();
						exit;
					} else {
						echo "Tuple Deleted";
					}
				}

			}
			?>
			</div>
			</div>
	



	<?php
	//echo "Yay";
	/*$result = $mysqli->query("SELECT * from actor, movies");
	if (!$result) {
		echo 'Could not run query: ' . $mysqli->error();
		exit;
	}

	echo "<table>";
	$finfo = $result->fetch_fields();
	echo "<tr>";
	foreach ($finfo as $val) {
		echo "<td>" . $val->name . "</td>";
	}
	echo "</tr>";

	while($row = $result->fetch_array()) {
		$finfo = $result->fetch_fields();
		echo "<tr>";
		foreach ($finfo as $val) {
			echo "<td>" . $row[$val->name] . "</td>";
		}
		echo "</tr>";
	}
	echo "</table>";

	$mysqli->close()*/
?>

</body>
</html>