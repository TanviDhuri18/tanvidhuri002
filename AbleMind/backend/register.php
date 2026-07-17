<?php

include "db.php";


$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];


$query = "INSERT INTO users
(name,email,password,role)
VALUES
('$name','$email','$password','$role')";


if(mysqli_query($conn,$query))
{
    echo "Registration Successful";
}

else
{
    echo "Error";
}


?>