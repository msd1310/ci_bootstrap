<?php
$link=mysqli_connect("localhost","root","password","ci_bootstrap");

if (mysqli_connect_errno())
    echo "Failed to connect to MySQL: " . mysqli_connect_error();

$action=$_POST["action"];
if($action=="showroom"){
    $query="SELECT * FROM users";
    $show=mysqli_query($link,$query) or die ("Error");
    while($row=mysqli_fetch_array($show)){
        echo "<li>$row['name']</li>";
    }
}
?>
