<?php
//get the index from URL
$index = $_GET['index']; // itong index na ito is galing sa login PHP | Line 25

//get json data
$data = file_get_contents('../jsonDB/userInfo.json');
$data_array = json_decode($data);

//assign the data to selected index
$row = $data_array[$index];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RGH Shop</title>
</head>
<body>
    <h2>ID:<?= $row->id ?> </h2>
    <h2>Name:<?= $row->name ?> </h2>
    <h2>Email:<?= $row->email ?> </h2>
    <h2>Phone:<?= $row->phone ?> </h2>
    <h2>Username:<?= $row->username ?> </h2>
    <h2>Password:<?= $row->password ?> </h2>

<h1></h1>
</body>
</html>