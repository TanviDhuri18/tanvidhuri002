<?php

include "db.php";


$query =
"SELECT * FROM progress";


$result=mysqli_query($conn,$query);


$data=[];


while($row=mysqli_fetch_assoc($result))
{
    $data[]=$row;
}


echo json_encode($data);


?>