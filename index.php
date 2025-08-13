<?php
$con = mysqli_connect("localhost", "root", "Magazin2024", "social");

if(mysqli_connect_errno()){
    echo "Failed to connect: ".mysqli_connect_erno();
}

$query = mysqli_query($con, "INSERT INTO test VALUES(NULL, 'Reece')");
?>

<html>
<head>
    <title>Swirlfeed</title>
</head>
<body>
HELLO!!!
</body>
</html>