<html>
<body>
    <a href="addRecord.php">Insert A Record</a>
    <a href="rateMovie.php">Rate A Movie</a>
    <a href="updateRecord.php">Update A Record</a>
    <a href="DeleteRecord.php">Delete A Record</a>
    
</body>
</html>

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

$conn = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName);

if(mysqli_connect_errno()) {
    echo "Server could not be connected :( " . mysqli_connect_error();
} else {
    echo "Server Connected! xD";
}

/*$sqli = "USE " . $dbName;
if(mysqli_query($conn,$sqli)) {
    echo "Column added successfully " . PHP_EOL;
} else {
    echo "Column not added" . mysqli_error($conn) . PHP_EOL; 
}*/
($fp = fopen($filename, 'r')) OR die('failed to open file:'.$filename);

// check for previous error
if( file_exists($errorFilename) ){
    die('<pre> previous error: '.file_get_contents($errorFilename));
}

// activate automatic reload in browser
echo '<html><head> <meta http-equiv="refresh" content="'.($maxRuntime+2).'"><pre>';

// go to previous file position
$filePosition = 0;
if( file_exists($progressFilename) ){
    $filePosition = file_get_contents($progressFilename);
    fseek($fp, $filePosition);
}

$queryCount = 0;
$query = '';
while( $deadline>time() AND ($line=fgets($fp, 1024000)) ){
    if(substr($line,0,2)=='--' OR trim($line)=='' ){
        continue;
    }

    $query .= $line;
    if( substr(trim($query),-1)==';' ){
        if( !mysql_query($query) ){
            $error = 'Error performing query \'<strong>' . $query . '\': ' . mysql_error() . mysql_errno();
            file_put_contents($errorFilename, $error."\n");
            exit;
        }
        $query = '';
        file_put_contents($progressFilename, ftell($fp)); // save the current file position for 
        $queryCount++;
        echo "Executed";
    }
}

if( feof($fp) ){
    echo 'dump successfully restored!';
}else{
    echo ftell($fp).'/'.filesize($filename).' '.(round(ftell($fp)/filesize($filename), 2)*100).'%'."\n";
    echo $queryCount.' queries processed! please reload or wait for automatic browser refresh!';
}
?>

</body>
</html>