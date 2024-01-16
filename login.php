





<?php
include 'conect.php';

session_start();
if(isset($_SESSION['user'])){
    header('location:profile.php');
    exit() ;
}
if(isset($_POST['submit'])){
$password=filter_var($_POST['password'],FILTER_SANITIZE_STRING);
$email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);

$errors=[];

//validate email address
if(empty($email)){
    $errors[]="يجب كتابة الايميل"; 
}elseif (filter_var($email, FILTER_VALIDATE_EMAIL)==false) {
    $errors[]='البريد غير صالح';
}
//valiate password
if(empty($email)){
    $errors[]="يجب كتابة كلمة مرور";
}

if(empty($errors)){

    $stat="select * from users where email='$email'";
    $q=$conn->prepare($stat);;
    $q->execute();
    $data=$q->fetch();
    if(!$data){
$errors[]="خطا في تسجيل دخول";
    }
    else{
        $password_hash=$data['password'];
        if(!password_verify($password,$password_hash)){
            $errors[]="خطا في تسجيل دخول";
        }
       else{
        $_SESSION['user']=[
            "name"=>$data['name'],
            "email"=>$email,
        ];
        header('location:profile.php');
       }
    }

header('location:profile.php');

}
else{
echo var_dump($errors);
}

}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    

<form action="login.php" method="post">
    <input type="email"   value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>"name="email" placeholder="email" ><br><br>
    <input type="password"  name="password" placeholder="password" ><br><br>
    <input type="submit" name="submit" placeholder="Login" ><br><br>
    <a href="register.php">Register</a>
</form>

</body>
</html>