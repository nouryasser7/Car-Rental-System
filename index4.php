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
    <title>Reserve Your Car</title>
    <script>

        function validate() { 
           let p_pickup = document.forms["search"]["pickup"].value;
           let p_return = document.forms["search"]["return"].value;

                 if (p_pickup > p_return){
                   alert("Invalid dates!");
                         return false;}
    
}

</script>
</head>

<?php  
session_start();
$cust_id=$_SESSION['customer_id']; 
$carRes = $_SESSION['totalresult']; 
// echo $carRes;

$servername = "localhost";
$database = "CarRentalSystem";
$user = "root";
$password = "root";

$conn = mysqli_connect($servername, $user, $password, $database);

// Check connection

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
} 
$qu = mysqli_query($conn,$carRes);
$count = mysqli_num_rows($qu);
if($count == 0){
     $output = 'No search results';
 }
else {
     while($row = mysqli_fetch_array($Totalquery)){
         $car_id = $row['car_id'];
     }
}


if(isset($_POST['reserve'])){
  $pickup = strtotime($_REQUEST['pickup']);
  $returndate = strtotime($_REQUEST['return']);
  // $pickuploc = $_REQUEST['pickuploc'];
  $pickuploc = mysqli_real_escape_string($conn,$_POST['pickuploc']);
  $car_id = 8;
  $new_pickup = date('Y-m-d', $pickup);
  $_SESSION['new_pickup'] = $new_pickup;
  $new_returndt = date('Y-m-d', $returndate);
  $sql = "INSERT INTO reservation (pickup_date, return_date,customer_id,car_id,branch_id,amount) VALUES ('".$new_pickup."','".$new_returndt."','".$cust_id."','".$car_id."','".$pickuploc."','0')";

  if(mysqli_query($conn, $sql)){
  header('location:index5.php');

  } else{
  echo "ERROR: Hush! Sorry $sql. " 
      . mysqli_error($conn);
  }

}

?>
<body style="background-image: url('speedline.jpeg'); height: 100%; background-repeat: no-repeat; background-size: cover;">

<div class="container w-100" style="text-align:center;">
<h3 style="color: aliceblue; margin-top: 30px;">Best Fit to your Specifications:</h3>
</div>

<form action="#"  onsubmit="return validate()" method="post" name="search">
<div class="container w-100">
<ul class="list-group">
    <?php $carResu=mysqli_query($conn,$carRes);
    while ($cars = mysqli_fetch_array($carResu,MYSQLI_ASSOC)){?>
    <?php $car_id = $cars['car_id'];
    $_SESSION['car_id'] = $car_id;
    ?>
  <li class="list-group-item"><h5><b><i><?php echo htmlspecialchars($cars['model']);?></i></b></h5>
<p>Year: <?php echo htmlspecialchars($cars['year']);?></p>
<p>Color: <?php echo htmlspecialchars($cars['color']);?></p>
<p>Number of Seats: <?php echo htmlspecialchars($cars['no_of_seats']);?></p>
<p>Price per Hour: $<?php echo htmlspecialchars($cars['price_hr']);?></p></li>
  <?php } ?>
</ul>
</div>
<br>
<div class="container w-300">
<div class="input-group">
  <div class="input-group-prepend">
  
    <span class="input-group-text">Pickup and Return dates</span>
  </div>
  <input type="text" name="pickup" class="form-control" placeholder="Pickup Date yyyy-mm-dd">
  <input type="text" name="return" class="form-control" placeholder="Return Date yyyy-mm-dd">
</div>
</div>
<br>
<div class="container w-150">
  <div class="input-group">
    <span class="input-group-text">Pickup Location</span>
    <select name="pickuploc" class="form-select h-50 w-30" aria-label="Pickup Location" >
    <option value="0">Location</option>
        <?php 
            $sql = "SELECT DISTINCT * FROM branch";
            $all_cars = mysqli_query($conn,$sql);
            while ($cust_loc = mysqli_fetch_array($all_cars,MYSQLI_ASSOC)):; 
        ?>
            <option value="<?php echo $cust_loc["branch_id"];?>">
                <?php echo $cust_loc["location"];?>
            </option>
        <?php 
            endwhile;?>

</select>
</div>
</div>
    <div class="second" style="margin-top: 250px;">
            <button type="submit" name="reserve" value="Submit" class="btn btn-primary">Reserve</button>
        </div>
</form>
</body>
</html>