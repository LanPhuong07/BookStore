<?php

include "dbconnect.php";


if(isset($_POST['submit']))
{
   if($_POST['submit']=="register")
     {
        $username=$_POST['register_username'];
        $password=$_POST['register_password'];
        $fullname=$_POST['register_fullname'];
        $gender=$_POST['register_gender'];
        $dob=$_POST['register_dob'];
        $address=$_POST['register_address'];
        $phonenumber=$_POST['register_phonenumber'];
        $role=2;
        $query="select * from users where UserName = '$username'";
        $result=mysqli_query($con,$query) or die();
        if(mysqli_num_rows($result)>0)
        {   
              header("Location: index.php?register=" . "Username is already taken...Use different username");
        }
        else
        {
          $query ="INSERT INTO users VALUES ('$username','$password')";
          $result=mysqli_query($con,$query);
          header("Location: index.php?register=" . "Successfully Registered!!");
        }
    }
}

?>