<!DOCTYPE html>
<html>
<head>
<title>Priyanka Labh view</title>
</head>
<body>
<div class="container">
<?php 
session_start();

if ( isset($_POST['cancel'] ) ) {
    header("Location: welcome.php");
    return;
}

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // Pw is php123
$_SESSION['failure'] = false;  



if ( isset($_POST['email']) && isset($_POST['pass']) ) {
    if ( strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1) {
        $_SESSION['error'] = "User name and password are required";
        header("Location: login.php");
	 return;   
    } 
    if ( strpos($_POST['email'],'@') === false ) {
        $_SESSION['error'] = 'User name must have @ included';
        header("Location: login.php");
        return;
    }
    else {
        $check = hash('md5', $salt.$_POST['pass']);
        if ( $check == $stored_hash ) {
            // Redirect the browser to view.php
            //header("Location: view.php?name=".urlencode($_POST['email']));
             $_SESSION['name'] = $_POST['email'];
	     header("Location: index.php");
	     return;
        } else {
            //$failure = "Incorrect password";
            $_SESSION['error'] = "Incorrect password";
            header("Location: login.php");
	    return;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<title>Priyanka Labh</title>
</head>

<body>
<div class="container">
<h1>Please Log In</h1>

<?php
/*if ( $failure !== false ) {
    echo('<p style="color: red;">'.htmlentities($failure)."</p>\n");
}*/

if ( isset($_SESSION['error']) ) {
    echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
    unset($_SESSION['error']);
}
?>

<form method="POST">
<label for="nam">User Name</label>
<input type="text" name="email" id="nam"><br/>
<label for="id_1723">Password</label>
<input type="text" name="pass" id="id_1723"><br/>
<input type="submit" value="Log In">
<input type="submit" name="cancel" value="Cancel">
</form>
</div>
</body>
</html>
