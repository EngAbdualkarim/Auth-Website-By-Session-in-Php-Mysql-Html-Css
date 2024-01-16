
<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$dbname="auth";

try{
$conn=new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
//echo"sucess";
}catch(Exception $e){
echo $e->getMessage();
exit();
}

?>