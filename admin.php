<?php
$servername = "localhost";
$username = "henvelt";
$password = "henvelt";
$dbname = "bootcamp";
?>
<!doctype html>
<html lang="en">
   <head>

<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, 
shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" 
href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" 
integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" 
crossorigin="anonymous">

<!-- Fontawesome CSS -->
<link rel="stylesheet" 
href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" 
integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" 
crossorigin="anonymous">

<!-- In Out CSS -->
<link rel="stylesheet" type="text/css" href="css/inout.css">

<title>In Out</title>
</head>

<body style="background-color:#e1e1e1;">

<nav class="navbar navbar-expand-lg navbar-light bg-light container">
<a class="navbar-brand" href="index.php">In Out</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" 
data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
   <div class="collapse navbar-collapse" id="navbarNav">
     <ul class="navbar-nav">
       <li class="nav-item">
         <a class="nav-link" href="admin.php" class="active">Admin</a>
       </li>
     </ul>
   </div>
</nav>


<div class="container" style="background-color:#ffffff;">
<div class="row">
<div class="col-lg-12 text-center">
     <h1>Admin </h1>
</div><!--/col-->
</div><!--/row-->
</div><!--/container-->

<div class="container" style="background-color:#ffffff;">
<div class="row">
<div class="col-lg-12"><br><br>

<!-- Add Employee Form -->
<form action="admin.php" method="POST">
   <div class="row">
     <div class="col">
        <input type="text" name="username" class="form-control 
form-control-sm" id="username" aria-describedby="username" 
placeholder="Enter User Name">
     </div>
     <div class="col">
       <button type="submit" name="action" value="Submit" class="btn 
btn-success btn-sm"><i class="fas fa-plus"></i> 
Employee</button><br><br>
     </div>
   </div>
</form>
<!-- /Add Employee Form -->

<!-- Responsive Table Div -->
<div class="table-responsive">
<!-- Table of Employees -->
<table class="table table-hover">
   <thead>
     <tr>
       <th>User ID</th>
       <th>Employee</th>
       <th class="text-center">Status</th>
       <th>Message</th>
       <th class="text-center">Update</th>
       <th class="text-center">Delete</th>
     </tr>
   </thead>
   <tbody>


<?php

/////////////////////////////////////////////////////////////////////////////////////////
// Update USER
/////////////////////////////////////////////////////////////////////////////////////////


if($_POST['action'] == 'Update') {
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE io_employees SET user='{$_POST['user']}', 
io='{$_POST['io']}', message='{$_POST['message']}' WHERE 
userid={$_POST['userid']}";

if ($conn->query($sql) === TRUE) {
     echo '<div class="alert alert-success alert-dismissible fade show" 
role="alert">
    Record updated successfully!
   <button type="button" class="close" data-dismiss="alert" 
aria-label="Close">
     <span aria-hidden="true">&times;</span>
   </button>
</div>';
} else {
     echo "Error updating record: " . $conn->error;
}

$conn->close();


}


/////////////////////////////////////////////////////////////////////////////////////////
// Add USER
/////////////////////////////////////////////////////////////////////////////////////////

if($_POST['action'] == 'Submit') {


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO io_employees (user, io)
VALUES ('{$_POST['username']}', '1')";

if (mysqli_query($conn, $sql)) {

echo '<div class="alert alert-success alert-dismissible fade show" 
role="alert">
    Employee Added!
   <button type="button" class="close" data-dismiss="alert" 
aria-label="Close">
     <span aria-hidden="true">&times;</span>
   </button>
</div>';

} else {
     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);



}


/////////////////////////////////////////////////////////////////////////////////////////
// Delete USER
/////////////////////////////////////////////////////////////////////////////////////////


if($_GET['action'] == 'delete') {




// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
}

// sql to delete a record
$sql = "DELETE FROM io_employees WHERE userid={$_GET['userid']}";

if (mysqli_query($conn, $sql)) {
     echo '<div class="alert alert-danger alert-dismissible fade show" 
role="alert">
    Employee deleted.
   <button type="button" class="close" data-dismiss="alert" 
aria-label="Close">
     <span aria-hidden="true">&times;</span>
   </button>
</div>';
} else {
     echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);


}


/////////////////////////////////////////////////////////////////////////////////////////
// Select USERS
/////////////////////////////////////////////////////////////////////////////////////////

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM io_employees ORDER BY userid DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {

// if Update display the data in a form
     if($row['userid'] == $_GET['usertoupdate']) {
     ?>
     <form action="admin.php" method="POST">
     <tr>
        <td><?=$row['userid']?><input type="hidden" name="userid" 
value="<?=$row['userid']?>"></td>
        <td><input type="text" name="user" value="<?=$row['user']?>"></td>
        <td class="text-center"><select name="io"><option value="0" <? 
if($row['io'] == '0') { echo 'selected'; }?>>0</option><option value="1" 
<? if($row['io'] == '1') { echo 'selected'; }?>>1</option></select></td>
        <td><input type="text" name="message" 
value="<?=$row['message']?>"></td>
        <td class="text-center"><input type="submit" class="btn 
btn-outline-info btn-sm" name="action" value="Update"></form> <a 
class="btn btn-outline-secondary btn-sm" href="admin.php" 
role="button">Cancel</a></td>

        <td class="text-center"><a 
href="admin.php?action=delete&userid=<?=$row["userid"]?>"><i class="fas 
fa-times" style="color:red;"></i> </td>
     </tr>

     <? } else { ?>

        <tr>
        <td><?=$row['userid']?></td>
        <td><?=$row['user']?></td>
        <td class="text-center"><?=$row['io']?></td>
        <td><?=$row['message']?></td>
        <td class="text-center"><a 
href="admin.php?usertoupdate=<?=$row["userid"]?>"><i class="fas fa-edit" 
style="color:green;"></i> </td>
        <td class="text-center"><a 
href="admin.php?action=delete&userid=<?=$row["userid"]?>"><i class="fas 
fa-times" style="color:red;"></i> </td>
     </tr>


     <?
     }
     }
} else {
     echo "0 results";
}
$conn->close();
?>

</tbody>
   <thead>
     <tr>
       <th>User ID</th>
       <th>Employee</th>
       <th class="text-center">Status</th>
       <th>Message</th>
       <th class="text-center">Update</th>
       <th class="text-center">Delete</th>
     </tr>
   </thead>
</table>

<!-- /Table of Employees -->
</div><!-- /Responsive Table Div -->


<br><br>



</div><!--/col-->
</div><!--/row-->
</div><!--/container-->








<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
crossorigin="anonymous"></script>
<script 
src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" 
integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" 
crossorigin="anonymous"></script>
<script 
src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" 
integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" 
crossorigin="anonymous"></script>
</body>
</html>
