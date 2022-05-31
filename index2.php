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
    <title>Your Car Specifications</title>
</head>
<?php
session_start();
$name=$_SESSION['first_name']; 
// $_SESSION['superhero'] = "batman";
// $_SESSION['super'] = "nour";
        $servername = "localhost";
        $database = "CarRentalSystem";
        $user = "root";
        $password = "root";
        
        $conn = mysqli_connect($servername, $user, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            } 

if(isset($_POST['search']))
{  
$whereClause ="WHERE car_id <> '0' ";
$whereClause1 ='';
$whereClause2 ='';
$whereClause3 ='';
$whereClause4 ='';
$whereClause5 ='';
$model = mysqli_real_escape_string($conn,$_POST['Model']);
$color = mysqli_real_escape_string($conn,$_POST['Color']);
$mode = mysqli_real_escape_string($conn,$_POST['Mode']);
$seats = mysqli_real_escape_string($conn,$_POST['No_of_seats']);
$price = mysqli_real_escape_string($conn,$_POST['Price']);
 if(!empty($model))
 {
 $whereClause1 .="&& model="."'$model' ";
 }
 if(!empty($mode))
 {
 $whereClause2 .="&& mode="."'$mode' ";
 }
 if(!empty($color))
 {
    $whereClause3 .="&& color="."'$color' ";
 }
 if($seats != 0)
 {
   $whereClause4 .= "&& no_of_seats='$seats '";
 }
 if($price != 0)
 {
   $whereClause5 .= "&& price_hr='$price'";
 }
 $whereClause .= $whereClause1;
 $whereClause .= $whereClause2;
 $whereClause .= $whereClause3;
 $whereClause .= $whereClause4;
 $whereClause .= $whereClause5;
 $querytot = "SELECT * FROM car ".$whereClause;
//  echo $querytot;
 $_SESSION['totalresult'] = $querytot;
 header('location: index4.php');
// $Totalquery = mysqli_query($conn,$querytot);

// $count = mysqli_num_rows($Totalquery);
// if($count == 0){
//      $output = 'No search results';
//  }
// else {
//      while($row = mysqli_fetch_array($Totalquery)){
//          $model0 = $row;
//          $output = '<div>'.$model0.'</div>';
//      }
// }
}
?>
         
<body style="background-image: url('car.jpg');">
<h2>Welcome <?php echo htmlspecialchars($name);?>!</h2>
<br>

<div class="container w-30" style="text-align: center">
<h3 style="color: aliceblue">What Do You Need In Your Car?</h3>
</div>
<!-- <div > -->
<form action="#" method="post" class="container w-25">

    <label style="color: aliceblue">Model</label>
    <select name="Model" class="form-select h-50 w-30" aria-label="Default select example" >
    <option value="0">Any</option>
        <?php 
            $sql = "SELECT DISTINCT model FROM car";
            $all_cars = mysqli_query($conn,$sql);
            while ($carModel = mysqli_fetch_array($all_cars,MYSQLI_ASSOC)):; 
        ?>
            <option value="<?php echo $carModel["model"];?>">
                <?php echo $carModel["model"];?>
            </option>
        <?php 
            endwhile;?>

</select>

<br>

    <label style="color: aliceblue">Mode</label>
    <select name="Mode" class="form-select h-50 w-30" aria-label="Default select example" >
    <option value="0">Any</option>
        <?php 
            $sql = "SELECT DISTINCT mode FROM car";
            $all_cars = mysqli_query($conn,$sql);
            while ($carModel = mysqli_fetch_array($all_cars,MYSQLI_ASSOC)):; 
        ?>
            <option value="<?php echo $carModel["mode"];?>">
                <?php echo $carModel["mode"];?>
            </option>
        <?php 
            endwhile;?>

</select>

<br>

<label style="color: aliceblue">Color</label>
<select name="Color" class="form-select" aria-label="Default select example" data-width="100%">
<option value="0">Any</option>
        <?php 
                $sql = "SELECT DISTINCT color FROM car";
	            $all_cars = mysqli_query($conn,$sql);
                while ($carColor = mysqli_fetch_array($all_cars,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $carColor["color"];
                ?>">
                    <?php echo $carColor["color"];

                    ?>
                </option>
            <?php 
                endwhile; 
            ?>

</select>

<br>

<label style="color: aliceblue">Number of Seats</label>
<select name="No_of_seats" class="form-select" aria-label="Default select example">
            <option value="0">Any</option>
            <?php 
                $sql = "SELECT DISTINCT no_of_seats FROM car";
	            $all_cars = mysqli_query($conn,$sql);
                
                while ($carSeats = mysqli_fetch_array($all_cars,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $carSeats["no_of_seats"];
                ?>">
                    <?php echo $carSeats["no_of_seats"];
                    ?>
                </option>
            <?php 
                endwhile; 
            ?>

</select>
<br>

<label style="color: aliceblue">Price per Hour</label>
<select name="Price" class="form-select" aria-label="Default select example">
            <option value="0">Any</option>
            <?php 
                $sql = "SELECT DISTINCT price_hr FROM car";
	            $all_cars = mysqli_query($conn,$sql);
                
                while ($carSeats = mysqli_fetch_array($all_cars,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $carSeats["price_hr"];
                ?>">
                    <?php echo $carSeats["price_hr"];
                    ?>
                </option>
            <?php 
                endwhile; 
            ?>

</select>
    <div class="second" style="margin-top: 300px">
            <button type="submit" name="search" value="Submit" class="btn btn-primary">Search</button>
        </div>
</form>



</body>  

</html>