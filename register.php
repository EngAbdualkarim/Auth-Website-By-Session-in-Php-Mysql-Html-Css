



<?php
include 'conect.php';

session_start();
if(isset($_SESSION['user'])){
    header('location:profile.php');
    exit() ;
}
if(isset($_POST['submit'])){
$name=filter_var($_POST['name'],FILTER_SANITIZE_STRING);
$password=filter_var($_POST['password'],FILTER_SANITIZE_STRING);
$email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);

$errors=[];
//valiadate name
if(empty($name)){
    $errors[]="يجب كتابة الاسم"; 
}elseif (strlen($name)>100) {
    $errors[]='يجب ان يكون اقل من 100';
}

//validate email address
if(empty($email)){
    $errors[]="يجب كتابة الايميل"; 
}elseif (filter_var($email, FILTER_VALIDATE_EMAIL)==false) {
    $errors[]='البريد غير صالح';
}
//valiate password

if(empty($password)){
    $errors[]="يجب كتابة كلمة سر خاص بك"; 
}elseif (strlen($password)<8) {
    $errors[]='يجب ان يكون اكثر من 8 ';
}

$stat="select email from users where email='$email'";
$q=$conn->prepare($stat);;
$q->execute();
$data=$q->fetch();

if($data){
    $errors[]="البريد موجود مسبقا";
}


if(empty($errors)){
//echo "insert";

    $password=password_hash($password,PASSWORD_DEFAULT);
    $quer = "insert into users (name,password,email) values ('$name','$password','$email')";
    $conn->prepare($quer)->execute();
    $_POST[$name]='';
    $_POST[$email]='';

    $_SESSION['user']=[
        "name"=>$name,
        "email"=>$email,
    ];
header('location:profile.php');

}


}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    

<form action="register.php" method="post">
    <?php
    if(isset($errors)){
        if(!empty($errors)){
            foreach($errors as $message){
                echo $message."<br>";
            }
        }

    }
    ?>
    <input type="text" value="<?php if(isset($_POST['name'])){echo $_POST['name'];}?>" name="name" placeholder="name" ><br><br>
    <input type="email"   value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>"name="email" placeholder="email" ><br><br>
    <input type="password"  name="password" placeholder="password" ><br><br>
    <input type="submit" name="submit" placeholder="Register" ><br><br>
    <br><br>
    <a href="login.php">Login</a>
</form>

</body>
</html>