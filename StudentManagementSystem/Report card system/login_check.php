<?php 

$host="localhost";

$user="root";

$password="12345";

$db="reportcardsystem";

$port= 3307;

$data=mysqli_connect($host,$user,$password,$db,$port);

if($data===false)
{
	die("connection error");
}

		
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$name = $_POST['username'];

		$pass = $_POST['password'];


		$sql="select * from user where username='".$name."' AND password='".$pass."'  ";

		$result=mysqli_query($data,$sql);

		$row=mysqli_fetch_array($result);



		if($row["usertype"]=="parent")
		{

			$_SESSION['username']=$name;

			$_SESSION['usertype']="student";

			header("location:parent.php");
		}

		elseif($row["usertype"]=="admin")
		{	
			$_SESSION['username']=$name;

			$_SESSION['usertype']="admin";

			header("location:admin.php");
		}

		else
		{
			

			$message= "username or password do not match";

			$_SESSION['loginMessage']=$message;

			header("location:login.php");
		}


	}


?>