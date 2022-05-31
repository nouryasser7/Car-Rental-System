<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "CarRentalSystem";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



//


if(isset($_POST['Reservation_number']) /*&& isset($_POST['Visa Number']) && isset($_POST['Card CVV'])*/)
{
  
     
     $regNo= $_POST['Reservation_number'];
     //$regvisa = $_POST["Visa Number"];
     //$regcvv = $_POST["Card CVV"];
     //$regpassword1md5 = MD5($regpassword1);
echo "REG  " . $regNo. "<br>";

     $sql = "SELECT * FROM reservation r join car c on c.car_id=r.car_id WHERE r.reserve_no = '".$regNo."'";
     $result = mysqli_query($conn, $sql);

     if(mysqli_num_rows($result) > 0)
      {
           while($row = mysqli_fetch_assoc($result)) 
           {
               //echo "Welcome  " . $row["name"]. "<br>";
            $regPRICE = $row["price_hr"];
            $regRETURN = /*new DateTime(*/$row["return_date"];
            $regPICKUP = $row["pickup_date"];
            $diff = abs(strtotime($regPICKUP)-strtotime($regRETURN));

            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            $regAMOUNT = $days *$regPRICE;

//echo "PRICE  " . $regPRICE. "<br>";
//echo "RETURN  " . $regRETURN. "<br>";
//echo "PICKUP  " . $regPICKUP. "<br>";
//echo "days  " . $days. "<br>";

            $sql = "UPDATE reservation
                    SET amount = '".$regAMOUNT."'"."
                     WHERE reserve_no = '".$regNo."'";

             if ($conn->query($sql) === TRUE) 
             {
               echo "Successful Payment"; 
             } 
             else 
             {
               echo "Error: " . $sql . "<br>" . $conn->error;
             }

           }  
      }      
      else 
      {
           echo "Reservation doesn't exist! ";
      } 

      
      
}
/*else
{
   //echo "login";
      //old user
      $logemail = $_POST["email"];
      $logpassword =  $_POST["password"];
      $logpasswordmd5 =  MD5($_POST["password"]);

      $sql = "SELECT * FROM USER WHERE EMAIL = '".$logemail."' AND PASSWORD = '".$logpasswordmd5."'  ";
      $result = mysqli_query($conn, $sql);

      if(mysqli_num_rows($result) > 0)
      {
           while($row = mysqli_fetch_assoc($result)) 
           {
               echo "Welcome  " . $row["name"]. "<br>";
           }  
      }      
      else 
      {
           echo "Invalid Username or Password! ";
           //echo "Error: " . $sql . "<br>" . $conn->error;
      } 
       //echo $_POST['number'] . " - 10 = " . ($_POST['number']-10); 
     
}*/
    



$conn->close();
?>