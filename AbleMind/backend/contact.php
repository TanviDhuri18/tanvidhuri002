<?php

include "db.php";


$name = $_POST['name'];

$email = $_POST['email'];

$message = $_POST['message'];



$query = "INSERT INTO contact_messages
(name,email,message)

VALUES

('$name','$email','$message')";



if(mysqli_query($conn,$query))
{

echo "Message Sent Successfully";

}

else
{

echo "Error Sending Message";

}


?>