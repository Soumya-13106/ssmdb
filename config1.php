<html>
<body>

<?php 
// your config
$filename = 'dbms_project.sql';
$dbHost = '127.0.0.1';
$dbUser = 'root';
$dbPass = '';
$dbName = 'dbms_project1';
$maxRuntime = 8; // less then your max script execution limit


$deadline = time()+$maxRuntime; 
$progressFilename = $filename.'_filepointer'; // tmp file for progress
$errorFilename = $filename.'_error'; // tmp file for erro

$conn = mysqli_connect($dbHost,$dbUser,$dbPass);

if(mysqli_connect_errno()) {
    echo "Database could not be connected :( " . mysqli_connect_error();
} else {
    echo "Database Connected! xD";
}

// Create database
$sql = "CREATE DATABASE dbms_project1";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close()
?>

</body>
</html>