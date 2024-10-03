<?php
include "connect.php";
?>
<?php
if(isset($_POST['submit']))
{
    $usertype = $_POST['usertype'];
    $username = $_POST['username'];
    $upassword = $_POST['password'];
}
$usertype=strtolower($usertype);
if($usertype=='admin'){
    $sql = " select * from admin where Username='$username' and password='$upassword' ";
}
elseif($usertype=='user'){
    $sql = " select * from user where Username='$username' and password='$upassword' ";
}
$query = mysqli_query($con,$sql);

	$row = mysqli_num_rows($query);
		if($row == 1){
            session_start();
            $_SESSION['loggedin']=true;
			$_SESSION['username'] = $username;
			//header('location:adminmainpage.php');
            if($usertype=='admin'){
                header('location:adminpage.php');
            }
            elseif($usertype=='user'){
                header('location:userpage.php');
            }
		}else{
			echo "login failed";
		}

// close connection
mysqli_close($con);
?>
