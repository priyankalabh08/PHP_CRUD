<?php
require_once "pdo.php";
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Priyanka Labh edit</title>
</head>
<body>
<div class="container">
<h1>Autos Update Database</h1>

<?php

if ( isset($_POST['make']) && isset($_POST['year']) 
     && isset($_POST['mileage']) && isset($_POST['model']) && isset($_POST['auto_id']) ){ 
     
     if ( strlen($_POST['make']) < 1 || strlen($_POST['year']) < 1 
         || strlen($_POST['mileage']) < 1 || strlen($_POST['model']) < 1) {
        $_SESSION['error'] = "All values are required";
       header("Location: edit.php?auto_id=".$_POST['auto_id']);
        return;
    } 
    else{
	    if (!(is_numeric($_POST['mileage'])) || (!(is_numeric($_POST['year'])))){
	    	$_SESSION['error'] = "Mileage & Year must be numeric";
	    	header("Location: edit.php?auto_id=".$_POST['auto_id']);
               return;
	    }else{
		
	    $sql = "UPDATE autos SET make = :make, model = :model,
             	    year = :year, mileage = :mileage 
            	    WHERE auto_id = :auto_id ";
	    $stmt = $pdo->prepare($sql);
	    $stmt->execute(array(
		':make' => $_POST['make'],
		':model' => $_POST['model'],
		':year' => $_POST['year'],
		':mileage' => $_POST['mileage'],
		':auto_id' => $_POST['auto_id']));
		$_SESSION['success'] = "updated";
            header("Location: index.php");
            return;
        }
   }
}


               
$stmt = $pdo->prepare("SELECT * FROM autos where auto_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['auto_id'])); 
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ( isset($_SESSION['error']) ) {
    echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
    unset($_SESSION['error']);
}

$a = htmlentities($row['make']);
$b = htmlentities($row['model']);
$c = htmlentities($row['year']);
$d = htmlentities($row['mileage']);
$auto_id = $row['auto_id'];      
?>


<form method="post">
<p>Make:
<input type="text" name="make" value="<?= $a ?>"/></p>
<p>Model:
<input type="text" name="model" value="<?= $b ?>"/></p>
<p>Year:
<input type="text" name="year" value="<?= $c ?>"/></p>
<p>Mileage:
<input type="text" name="mileage" value="<?= $d ?>"/></p>
<input type="hidden" name="auto_id" value="<?= $auto_id ?>">
<input type="submit" value="Save">
<a href="index.php">Cancel</a></p>
</form>

<pre>

</pre>
</div>
</body>
</html>
