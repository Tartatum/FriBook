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
<br>(Be careful it's case sensitive -> M =/=m)
</form>


<h1>My best friends:</h1>
<ul>
<form action="index.php" method="post">
<?php


$filename = 'friends.txt';
if (!empty($_POST['appendfile']) ) {
    $apptext = $_POST['appendfile'];
    $file = fopen($filename, "a") or die("Unable to find the textfile");
    fwrite($file, $apptext. "\n");
    fclose($file);
}
$nameFilter="";

if (isset($_POST['nameFilter'])) {
    $nameFilter = $_POST['nameFilter'];
}
$filename = 'friends.txt';
if(filesize($filename) !=0){
    $file = fopen($filename, "r") or die("Unable to find the textfile");
	$list = array();
	while (!feof($file)){
	$name = fgets($file);
	if(!empty($name)){
	array_push($list,$name);}
	}
fclose($file);
	if (isset($_POST['delete'])) {
        $indexToBeRemoved = $_POST['delete'];
        unset($list[$indexToBeRemoved]);
        $list = array_filter($list);
		$file = fopen($filename, "w") or die("Unable to find the textfile");
		foreach($list as $name){
		if (!empty($name)){
		fwrite($file,$name);
		}
		}
		fclose($file);
    }


/*foreach ($list as $name) */
$i=0;

foreach ($list as $name){
 if ($nameFilter=="" || strpos($name, $nameFilter)!==FALSE) {
        if (empty($_POST["startingWith"])) {
            echo "<li>$name ";
            echo "<button type='submit' name='delete' value='$i'>Delete</button>";
        } else {
            if (strpos($name,$nameFilter)==0) {
            echo "<li>$name ";
            echo "<button type='submit' name='delete' value='$i'>Delete</button>";
            }
        }
        
        
    }
	$i++;
	
}
}
else
{echo "File empty, change the txt's content or use the new friend.";}







/*
$file = fopen($filename, "r") or die("Unable to find the textfile");
while (!feof($file)) {
    $name = fgets($file);
    if ($nameFilter=="" || strpos($name, $nameFilter)!==FALSE) {
        if (empty($_POST["startingWith"])) {
            echo "<li>$name ";
            echo "<button type='submit' name='delete' value='delete'>Delete</button></li>";
        } else {
            if (strpos($name,$nameFilter)==0) {
            echo "<li>$name ";
            echo "<button type='submit' name='delete' value='delete'>Delete</button></li>";
            }
        }
        
        
    }
    
}
fclose($file);
*/
?>
</form>
</ul>


</body>
<footer>
<?php
include('footer.html');
?>
</footer>
</html>
