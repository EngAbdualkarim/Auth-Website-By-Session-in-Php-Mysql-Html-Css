
<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <?php
    if(isset($_SESSION['user'])){
?> 
  <a href="profile.php">Profile</a><br><br><br>

<?php
    }else{
        ?> 
        <a href="login.php">Login</a><br><br><br>
        <a href="register.php">Register</a>

        <?php
    }
    ?>
<br><br><br>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>
    </nav>
    <br>
    <br>

</body>
</html>