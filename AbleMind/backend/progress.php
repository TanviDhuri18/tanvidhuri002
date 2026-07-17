<?php

include "db.php";


$student_id = $_GET['student_id'];


$query =
"SELECT * FROM progress 
WHERE student_id='$student_id'";


$result=mysqli_query($conn,$query);


$data=[];


while($row=mysqli_fetch_assoc($result))
{
    $data[]=$row;
}


echo json_encode($data);


?>