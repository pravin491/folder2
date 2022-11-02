<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
</head>

<body>
    <h1 align="center"> Register New Customer </h1>

    <table border="1" align="center">
        <form name="f" action="#" method="POST" enctype="multipart/form-data">
            <tr>
                <td> Customer Name </td>
                <td> <input type="text" name="username"> </td>
            </tr>
            <tr>
                <td> Password </td>
                <td> <input type="text" name="password"> </td>
            </tr>
            <tr>
                <td> <input type="submit" value="Register" name="submit"> </td>
                <td> <input type="reset" value="reset" name="reset"> </td>
            </tr>
        </form>
    </table>

    <h5 align="center"> Already Have an Account ? <a href="login.php"> Login </a></h5>
</body>

</html>

<?php

$con = mysqli_connect("localhost", "root", "", "test2");
if ($con == false) {
    echo "<h1 align='center'> Some Problem with Connecting to Database </h1>";
} else {
    if (isset($_POST["submit"])) {

        $name=$_POST["username"];
        $password=$_POST["password"];

        $q="INSERT INTO `customer` (`cid`, `cnm`, `pwd`) VALUES (NULL, '$name', '$password');";
        $r=mysqli_query($con,$q) or die("<br>error in query");
        if(!$r){
            echo "<h1 align='center'> not inserted </h1>";
        }else{
            $q = "SELECT * FROM `customer` where cnm = '$name 'and pwd='$password'";
            $r = mysqli_query($con,$q) or die("query error");
            while($row=mysqli_fetch_row($r)){
                $_SESSION["user_id"] = $row[0];
                echo "$row[0]";
            }   
            $_SESSION["user_nm"] = $name;
            ?>
            <script>
                alert("Customer Registered Successfully");
                window.location.href="customer_homepage.php";
            </script>
            <?php
            
        }
    }
}


?>