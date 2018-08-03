<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/inout.css">


    <title>In Out</title>
  </head>
  <body style="background-color:#e1e1e1;">
  
  <nav class="navbar navbar-expand-lg navbar-light bg-light container">
  <a class="navbar-brand" href="#">In Out</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href="#">Admin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">Refresh</a>
      </li>
      
    </ul>
  </div>
</nav>


  
  
  <div class="container" style="background-color:#ffffff;">
    <div class="row">
    <div class="col-lg-12 text-center">
  
    <h1>Jaxcode Academy</h1>
	</div> <!--/col-->
    </div> <!--.row-->
    </div> <!--/container-->
    
    <div class="container" style="background-color:#ffffff;">
    <div class="row">
    <div class="col-lg-12">
    
    <table class="table table-bordered">
  <thead>
    <tr>
      <th >Employee</th>
      <th class="text-center">In</th>
      <th class="text-center">Out</th>
      <th >Message</th>
    </tr>
  </thead>

 <tbody>

<?php
$servername = "localhost";
$username = "henvelt";
$password = "henvelt";
$dbname = "bootcamp";

// Change Message

if(isset($_POST['message'])) {
function scrub($string) {
$string = htmlspecialchars(trim(strip_tags(addslashes($string))));
return $string;
}

$_POST['message'] = scrub($_POST['message']);
$_POST['message'] = filter_input(INPUT_POST, 'message');
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$_POST['message'] = preg_replace('/\'/', "'", $_POST['message']);
$sql = "UPDATE io_employees SET message ='{$_POST['message']}' WHERE userid={$_POST['userid']}";

if (mysqli_query($conn, $sql)) {
   
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
}


// Change In Out Status

if(isset($_GET['io'])) {
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "UPDATE io_employees SET io ='{$_GET['io']}' WHERE userid={$_GET['userid']}";

if (mysqli_query($conn, $sql)) {
   
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
}




// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM io_employees";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
?>
 <tr>
      <td class="align-middle lead"><?=$row['user']?></td>
      <? if($row['io'] == '0') { ?>
      <td class="text-center"><a href="index.php?userid=<?=$row['userid']?>&io=1"><img src="images/circle_green.png" class="hidden"></a></td>
      <td class="text-center"><img src="images/circle_red.png"></td>
      <? } else { ?>
      <td class="text-center"><img src="images/circle_green.png"></td>
      <td class="text-center"><a href="index.php?userid=<?=$row['userid']?>&io=0"><img src="images/circle_red.png" class="hidden"></a></td>
      <? } ?>
      <td>
      <? if($row['message'] != '') { ?>
      <a data-toggle="collapse" href="#collapse<?=$row['userid']?>" aria-expanded="false" aria-controls="collapse<?=$row['userid']?>" style="color:#000000;">
      <?=$row['message']?>
      </a>
      <? } else {?>
      <a data-toggle="collapse" href="#collapse<?=$row['userid']?>" aria-expanded="false" aria-controls="collapse<?=$row['userid']?>" class="text-muted float-right" style="text-decoration-style: dashed;font-style: italic;font-size:12px;text-decoration: underline;"><i class="far fa-edit"></i></a>
      <? } ?>
      
  
</p>
<div class="collapse" id="collapse<?=$row['userid']?>">
  <div>
	<form action="index.php" method="POST">
	<input type="text" name="message" value="<?=$row['message']?>">
	<input type="hidden" name="userid" value="<?=$row['userid']?>">
	<input class="btn btn-secondary btn-md" style="padding:0 4px;" type="submit" value="Submit">
	</form>
  </div>
</div>
      
      

      </td>
    </tr>
<?
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
  

  </tbody>
    
    
    <thead>
    <tr>
      <th >Employee</th>
      <th class="text-center">In</th>
      <th class="text-center">Out</th>
      <th >Message</th>
    </tr>
  </thead>
  
</table>
    
    
    </div> <!--/col-->
    </div> <!--.row-->
    </div> <!--/container-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </body>
</html>