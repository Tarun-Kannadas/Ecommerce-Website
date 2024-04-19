<?php
include('../includes/connect.php');

global $con;
$query = "SELECT * FROM messages";
$result = mysqli_query($con, $query);

$messages = [];
while ($row = mysqli_fetch_assoc($result)) 
{
    $messages[] = $row;
}

echo json_encode($messages);
?>
