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
	<div id="modal">
		<div id="left">
		<form action='#'>
		  <div class='field'>
		    <input placeholder='Query'>
		    <label>Your Query</label>
		  </div>
		  <div class='field form-actions'>
		    <button type='submit'>Execute</button>
		  </div>

		  <?php

		  ?>
		</form>
		</div>
		<div id="center">

		</div>
		<div id="right">

		</div>
	</div>
	

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

		</div>
		<div id="center">

		</div>
		<div id="right">
			<button type="button" id="addEntry" onclick="document.getElementById('selectDB').style.display='block';document.getElementById('executeQuery').style.display='block';">Add</button>
			<button type="button" id="updateEntry" onclick="document.getElementById('selectDB').style.display='block';document.getElementById('executeQuery').style.display='block';">Update</button>
			<button type="button" id="deleteEntry" onclick="document.getElementById('selectDB').style.display='block';document.getElementById('executeQuery').style.display='block';">Delete</button>
			<div id="selectDB">
				<?php
				$res = $mysqli->query("SHOW TABLES");
  				echo "<select name='selectDBTag' id='selectDBTag'>";
  				while($cRow = mysqli_fetch_array($res)) {
    				echo "<option value=" . $cRow[0] . ">" . $cRow[0] ."</option>";
				}
				echo "</select>"



				?>

			</div>
			<button type="button" id="executeQuery" onclick="document.getElementById('selectDB').style.display='block';">Execute</button>
		</div>
	</div>
	



	<?php
	//echo "Yay";
	$result = $mysqli->query("SELECT * from actor");
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

	$mysqli->close()
?>
</body>
</html>