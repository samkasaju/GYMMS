<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "sam";

//create connection
$con = mysqli_connect($host, $username, $password, $database);

//check connection
if(!$con)
{
        die("Connection Failed:". mysqli_connect_error());
}
else
{
    echo"connected successfully";

}