<?php
require_once "pdo.php";
session_start();

/*if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) {
    die('Not logged in');
}*/

if ( ! isset($_SESSION['name']) ) {
  die('Not logged in');
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Priyanka Labh index</title>
</head>
<body>
<div class="container">
<h1>Automobiles Database</h1>


<?php
if ( isset($_SESSION['name']) ) {
    echo "<p>Welcome: ";
    echo '<p style="color:green">'.$_SESSION['name']."</p>\n";
}
?>

<?php
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

if ( isset($_SESSION['success']) ) {
    echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
}
?>

<table border="1">
<thead><tr>
<th>Make</th>
<th>Model</th>
<th>Year</th>
<th>Mileage</th>
<th>Action</th>
</tr></thead>
<?php
//echo('<table border="1">'."\n");
$stmt = $pdo->query("SELECT auto_id,make, model, year, mileage FROM autos");
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    echo "<tr><td>";
    echo(htmlentities($row['make']));
    echo("</td><td>");
    echo(htmlentities($row['model']));
    echo("</td><td>");
    echo(htmlentities($row['year']));
    echo("</td><td>");
    echo(htmlentities($row['mileage']));
    echo("</td><td>");
    echo('<a href="edit.php?auto_id='.$row['auto_id'].'">Edit</a> / ');
    echo('<a href="delete.php?auto_id='.$row['auto_id'].'">Delete</a>');
    echo("</td></tr>\n");
}
?>
</tr>
</table>

<p><a href="add.php">Add New Entry</a></p>
<p><a href="logout.php">Logout</a></p>
<pre>

</pre>
</div>
</body>
</html>
