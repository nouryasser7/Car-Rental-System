<!doctype html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="mystyles.css">
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>
    <title>Car Rental System</title>
</head>

<body style="background-image: url('loginpicc.jpeg'); height: 100%; background-repeat: no-repeat; background-size: cover;">
    <h1>LOGIN</h1>
    <form action="#" name="myForm" method="post" onsubmit="return validateForm()">
        
        <label  class="form-label">Username</label>
        <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">@</span>
  <input type="text" name="usr" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
</div>
         <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>

        <div class="center" style="margin-top: -30px">
            <button type="submit" name="submit" value="Submit" class="btn btn-primary">Log in</button>
        </div>

       
        <script>
        function validateForm() {
  var y = document.forms["myForm"]["usr"].value;
  var z = document.forms["myForm"]["password"].value;

  if (y == "") {
    alert("Please enter your username");
    return false;
  }
  if (z == "") {
    alert("Please enter password");
    return false;
  }
}
    </script>
    
    </form>
    <div class="second" style="margin-top: 10px;"><p>Don't have an account?</p></div>
    <form action="#" method="post">
    <div style="margin-top: 50px;" class="second" >
            <button type="submit" name="register" value="Submit" class="btn btn-primary">Register</button>
        </div>
</form>
    

<?php
$servername = "localhost";
$database = "CarRentalSystem";
$user = "root";
$password = "root";

// Create connection

$conn = mysqli_connect($servername, $user, $password, $database);

// Check connection

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

session_start();
if(isset($_POST['submit']))
{
 $usr=$_POST['usr'];
 $pwd=$_POST['password'];
   $query=mysqli_query($conn, "SELECT * from customer where username='".$usr."'") or die(mysqli_error());
   $queryadmin = mysqli_query($conn, "SELECT * from admin where username='".$usr."'") or die(mysqli_error());
   //$res=mysqli_fetch_all($query, MYSQLI_ASSOC);
   if(mysqli_num_rows($query)>0)
   {
       while($row = mysqli_fetch_assoc($query))
       {
           if($pwd == $row['password']){
            $_SESSION['first_name']=$row['first_name'];
            $_SESSION['customer_id'] = $row['customer_id'];
            header('location:index2.php');
           }
           else {
            echo '<div style = "margin-top: 105px;" class="alert alert-danger alert-dismissible fade show" role="alert">
                  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                  Incorrect username or password
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
               }
       }
   }
   if(mysqli_num_rows($queryadmin)>0)
   {
       header('location:search.html');
   }
}

if(isset($_POST['register']))
{
    header('location:index3.php');
}
mysqli_close($conn);
?>

</body>

</html>