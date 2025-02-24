<?php

session_start();



$host = 'localhost';
$db = 'project';
$pass = '';
$user = 'root';


$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// ----- data from login page

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $U_name = trim($_POST['username']);
    $Pass = trim($_POST['pass']);
    $Con_pass = trim($_POST['con_pass']);
    $Type = trim($_POST['type']);
    $Email = trim($_POST['email']);

}

echo"<br> $U_name <br> $Pass  $Con_pass <br> $Type <br> $Email";

if($Pass!=$Con_pass){
    print("enter same password");
}
else{



$stmt= "insert into `login`(`u_name`, `u_pass`, `Email`, `type`) VALUES ('$U_name','$Pass','$Email','$Type')";
    if (mysqli_query($conn,$stmt))
		 {
			echo "<br>Successfully Inserted";
		 }
	     else
			{
				echo "<br>".mysqli_error($conn);
		
            }
        }
header('Location: ../public/dashboard.php');        