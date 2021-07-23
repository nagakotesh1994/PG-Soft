<?php
$messages = [
    "<script>$('.toastrDefaultSuccess').ready(function() { toastr.success('Login Success.') }); </script>",                                         //0
    "<script>$('.toastrDefaultError').ready(function() {toastr.error('Incorrect Credentials.') });</script>",                                       //1
    "<script>$('.toastrDefaultInfo').ready(function() { toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.') });</script>",      //2
    "<script>$('.toastrDefaultError').ready(function() {toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.') });</script>",     //3
    "<script>$('.toastrDefaultWarning').ready(function() {toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.') });</script>"  //4
];

//DB Connecting Function Start
function DB_Connect()
{
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pgsoft";

    $conn = new mysqli($server_name, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo "Error-Connecting Database:" . $conn->connect_error;
        return false;
    } else {
        return $conn;
    }
}
//DB Connecting Function End

//This Sanitize function is used for security Start
function Sanitize($FromData)
{
    $conn = DB_Connect();

    foreach ($FromData as $key => $value) {

        $key = strip_tags($key); // Remove HTML
        $value = strip_tags($value); // Remove HTML

        $key = htmlspecialchars($key); // Convert characters
        $value = htmlspecialchars($value); // Convert characters

        $key = trim(rtrim(ltrim($key))); // Remove spaces
        $value = trim(rtrim(ltrim($value))); // Remove spaces

        $key = $conn->real_escape_string($key); // Prevent SQL Injection
        $value = $conn->real_escape_string($value); // Prevent SQL Injection

        $array[$key] = $value;
    }
    return $array;
}
//This Sanitize function is used for security End



function PG_Table()
{
    $conn = DB_Connect();

    $query = "CREATE TABLE IF NOT EXISTS PG_Table (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pg_id VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    address VARCHAR(1000) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    if ($conn->query($query) === TRUE) {
        //echo "Table MyGuests created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
}


function Check_Login($FromData)
{
    $conn = DB_Connect();
    $FromData = Sanitize($FromData);
    extract($FromData);
    $query = "SELECT * FROM `pg_table` WHERE (`email`='{$LoginId}' OR `phone`='{$LoginId}') AND `password`='{$password}'";
    $result = $conn->query($query);


    if ($result->num_rows == 1) {
        $_SESSION['LoginId']= $LoginId;
        return 0; //success message array index
    } else {
        return 1; // login fail message array index
    }
}
