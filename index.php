<html>
<head>
<title>Hello World</title>
<style>

/* Style the header */
header {
    background-color: #666;
    padding: 30px;
    text-align: center;
    font-size: 35px;
    color: white;
}

/* Style the footer */
footer {
    background-color: #777;
    padding: 10px;
    text-align: center;
    color: white;
}
</style>
</head>
<header>
<?php
include('header.html');
?> 
</header>
<body>
<br>
<h3>New Friend</h3>
<form action="index.php" method="post">
Name: <input type="text" name="appendfile">
<input type="submit" value="submit">
</form>
<h3>Filter</h3>
<form action="index.php" method="post">
<input type="text" name="nameFilter" value="">
<input type="checkbox" name="startingWith" value="TRUE">Only names starting with</input>
<input type="submit" value="Filter list">
</form>
<?php
if( empty($_POST["startingWith"]) ) { echo "Not Checked"; }
else { echo "Checked"; }
?>


<h1>My best friends:</h1>
<ul>

<?php

$filename = 'friends.txt';
if (isset($_POST['appendfile'])) {
    $apptext = $_POST['appendfile'];
    
    $file = fopen($filename, "a") or die("Unable to find the textfile");
    fwrite($file, "\n" . $apptext);
    fclose($file);
}
$nameFilter="";
if (isset($_POST['nameFilter'])) {
    $nameFilter = $_POST['nameFilter'];
}
$file = fopen($filename, "r") or die("Unable to find the textfile");
while (!feof($file)) {
    $name = fgets($file);
    if ($nameFilter=="" || strpos($name, $nameFilter)!==FALSE) {
        echo "<li>$name</li>";
    }
    
}
fclose($file);

?>
</ul>


</body>
<footer>
<?php
include('footer.html');
?>
</footer>
</html>
