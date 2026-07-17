<?php

include "db.php";


$query = "SELECT * FROM courses";


$result = mysqli_query($conn,$query);


$courses=[];


while($row=mysqli_fetch_assoc($result))
{
    $courses[]=$row;
}


echo json_encode($courses);


?>