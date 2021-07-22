<?php
session_start();

/*if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) {
    die('ACCESS DENIED');
}*/

if ( ! isset($_SESSION['name']) ) {
  die('ACCESS DENIED');
}

if ( isset($_POST['cancel'] ) ) {
    header("Location: index.php");
    return;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Priyanka Labh added</title>
</head>
<body>
<div class="container">
<h1>Autos Database</h1>

<?php
require_once "pdo.php";
if ( isset($_REQUEST['name']) ) {
    echo "<p>Welcome: ";
    echo htmlentities($_REQUEST['name']);
    echo "</p>\n";
}

$failure = false; 


if ( isset($_POST['make']) && isset($_POST['year']) 
     && isset($_POST['mileage']) && isset($_POST['model'])){ 
     if ( strlen($_POST['make']) < 1 || strlen($_POST['year']) < 1 
         || strlen($_POST['mileage']) < 1 || strlen($_POST['model']) < 1) {
        $_SESSION['error'] = "All values are required";
        header("Location: add.php");
        return;
    } 
    else{
	    if (!(is_numeric($_POST['mileage'])) || (!(is_numeric($_POST['year'])))){
	    	$_SESSION['error'] = "Mileage & Year must be numeric";
	    	header("Location: add.php");
               return;
	    }else{
		
	    $sql = "INSERT INTO autos (make, model, year, mileage) 
		      VALUES (:make, :model, :year, :mileage)";
	    $stmt = $pdo->prepare($sql);
	    $stmt->execute(array(
		':make' => $_POST['make'],
		':model' => $_POST['model'],
		':year' => $_POST['year'],
		':mileage' => $_POST['mileage']));
		$_SESSION['success'] = "added";
            header("Location: index.php");
            return;
        }
   }
}
               
$stmt = $pdo->query("SELECT make, model, year, mileage FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);        
?>

<?php
if ( isset($_SESSION['success']) ) {
    echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
}
if ( isset($_SESSION['error']) ) {
    echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
    unset($_SESSION['error']);
}
?>

<form method="post">
<p>Make:
<input type="text" name="make" size="60"/></p>
<p>Model:
<input type="text" name="model"/></p>
<p>Year:
<input type="text" name="year"/></p>
<p>Mileage:
<input type="text" name="mileage"/></p>
<input type="submit" value="Add">
<input type="submit" name="cancel" value="Cancel">
</form>

<pre>

</pre>
</div>
</body>
</html>
