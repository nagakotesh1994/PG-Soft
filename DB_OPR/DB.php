<?php
session_start();
$messages = [
    "<script>$('.toastrDefaultError').ready(function() {toastr.error('Incorrect Credentials.') });</script>",
    "<script>$('.toastrDefaultSuccess').ready(function() { toastr.success('Login Success.') }); </script>",                                         //0
    "<script>$('.toastrDefaultInfo').ready(function() { toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.') });</script>",      //2
    "<script>$('.toastrDefaultError').ready(function() {toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.') });</script>",     //3
    "<script>$('.toastrDefaultWarning').ready(function() {toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.') });</script>",  //4
    "<script>$('.toastrDefaultSuccess').ready(function() { toastr.success('PG saved Successfully.') }); </script>",                   //5
    "<script>$('.toastrDefaultError').ready(function() {toastr.error('PG Not Saved.') });</script>", //6
];


$pages = [
    'home_page' => 'index.php', //ROOT PAGE TO LOAD OR HOME PAGE TO LOAD
    'login_page' => 'index.php',
    'logout_page' => 'logout.php'
];


$pages_titles = [
    'home_page_title' => '<title>PG Soft | Log in</title>',
    'login_page' => '',
    'dashboard_page_title' => '<title>PG Soft | Dashboard</title>'
];



//DB Connecting Function (Start)
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
//DB Connecting Function (End)

//This Sanitize function is used for security (Start)
function Sanitize($FromData)
{
    $conn = DB_Connect();

    foreach ($FromData as $key => $value) {
        if (is_array($value)) {

            Sanitize($value);
        } else {

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
    }
    return $array;
}
//This Sanitize function is used for security (End)



function PG_Table_Users()
{
    $conn = DB_Connect();

    $query = "CREATE TABLE IF NOT EXISTS PG_Table_Users (
    `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `pg_id` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `level` VARCHAR(255) NOT NULL,
    `address` VARCHAR(1000) NOT NULL,
    `reg_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";

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
    $query = "SELECT * FROM `pg_table_users` WHERE (`email`='{$LoginId}' OR `phone`='{$LoginId}') AND `password`='{$password}' AND `pg_id`={$pg_id}";

    $result = $conn->query($query);

    if ($result) {
        if ($result->num_rows == 1) {

            $_SESSION['LoginId'] = $LoginId;
            $row = mysqli_fetch_array($result);
            $_SESSION['pg_name'] = $row['name'];
            $_SESSION['pg_id'] = $row['pg_id'];

            return 1; //success message array index
        } else {
            return 0; // login fail message array index
        }
    } else {
        return 0; // login fail message array index
    }
}

function PG_Hostel_Create()
{
    $conn = DB_Connect();
    $query = "CREATE TABLE IF NOT EXISTS PG_Hostel (
        `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `PG_User_Id` VARCHAR(255) NOT NULL,
        `PG_Hostel_Name` VARCHAR(255) NOT NULL,
        `GST_No` VARCHAR(255) NOT NULL,
        `PAN_NO` VARCHAR(255) NOT NULL,
        `address` VARCHAR(1000) NOT NULL,
        `status` VARCHAR(1000) DEFAULT 1,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
    if ($conn->query($query) === TRUE) {
        //echo "Table MyGuests created successfully";
    } else {
        echo "Error creating PG_Hostel table: " . $conn->error;
    }
}

function PG_Hostel_Insert($FromData)
{
    $conn = DB_Connect();
    PG_Hostel_Create();
    $FromData = Sanitize($FromData);
    extract($FromData);
    $query = "INSERT INTO PG_Hostel (`PG_User_Id`, `PG_Hostel_Name`) VALUES ('{$_SESSION['pg_id']}','{$PG_Hostel_Name}')";
    if ($conn->query($query) === TRUE) {
        return 1;
    } else {
        echo "Error creating PG_Hostel table: " . $conn->error;
        return 0;
    }
}

function Get_PG_Hostel_Data()
{
    $conn = DB_Connect();
    $query = "SELECT * FROM `pg_hostel`";
    $result = $conn->query($query);
    $sno = 1;
    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>  <td>{$sno}</td>
                    <td>{$row['PG_Hostel_Name']}</td>
                    <td> <a href='DB_OPR/Delete.php?table=pg_hostel&id={$row['id']}&page=PG' class='btn btn-sm	 btn-outline-danger'>Delete</a>"; 
                    if($row['status']=='1')
                        echo "&nbsp;&nbsp; <a href='DB_OPR/ActiveInactive.php?table=pg_hostel&id={$row['id']}&page=PG&status=0' class='btn btn-sm	 btn-outline-secondary'>Inactive</a></td>";
                    else 
                    echo "&nbsp;&nbsp; <a href='DB_OPR/ActiveInactive.php?table=pg_hostel&id={$row['id']}&page=PG&status=1' class='btn btn-sm	 btn-outline-secondary'>Active</a></td>";
                echo "</tr>"; 
            $sno++;
        }
    }
}

function PG_Beds_Create()
{
    $conn = DB_Connect();
    $query = "CREATE TABLE IF NOT EXISTS PG_Hostel_Beds (
        `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `PG_User_Id` VARCHAR(255) NOT NULL,
        `bed_no` VARCHAR(255) NOT NULL,
        `PG_Hostel_Name` VARCHAR(255) NOT NULL,
        `name` VARCHAR(255) NOT NULL,
        `status` VARCHAR(1000) DEFAULT 1,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
    if ($conn->query($query) === TRUE) {
        //echo "Table MyGuests created successfully";
    } else {
        echo "Error creating PG_Hostel table: " . $conn->error;
    }
}


function PG_Beds_Insert($FromData)
{
    $conn = DB_Connect();
    PG_Beds_Create();
    $FromData = Sanitize($FromData);
    extract($FromData);
    $query = "INSERT INTO PG_Hostel_Beds (`PG_User_Id`,`bed_no`, `PG_Hostel_Name`,`name`)   
                             VALUES ('{$_SESSION['pg_id']}','{$m_roomno}','{$m_name}','{$m_guest_name}')";
    if ($conn->query($query) === TRUE) {
        return 1;
    } else {
        echo "Error creating PG_Hostel table: " . $conn->error;
        return 0;
    }
}



function Get_PG_Hostel_Beds_Data()
{
    $conn = DB_Connect();
    $query = "SELECT * FROM `pg_hostel_beds`";
    $result = $conn->query($query);
    $sno = 1;
    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>  <td>{$sno}</td>
                    <td>{$row['PG_Hostel_Name']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['bed_no']}</td>
                </tr>"; 
            $sno++;
        }
    }
}