<?php
    include("../includes/addr_include.php");
    //connect to database

    $db = mysqli_connect("localhost", "root", "", "address_book");

    if (isset($_POST['register'])){
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $pass1 = mysqli_real_escape_string($db, $_POST['pass1']);
        $pass2 = mysqli_real_escape_string($db, $_POST['pass2']);

        if($pass1 == $pass2){
            $pass1 = md5($pass1);
            $sql = "INSERT INTO admins(username, email, password) VALUES ('$username', '$email', '$pass1')";
            mysqli_query($db, $sql);
            
            $sql = "INSERT INTO users(username, email, password) VALUES ('$username', '$email', '$pass1')";
            mysqli_query($db, $sql);
            
            $_SESSION["message"] = "New entry made!";
            $_SESSION["username"] = $username;
            $_SESSION["admin_username"] = $username;
            header("location: ../addr_index.php"); //redirect to home page
        }
        else{
            $_SESSION["message"] = "Passwords don't match!";
        }
       
        
    }
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		
		<title><?php echo SITE_NAME; ?></title>
		
		<!-- link to the stylesheets -->
		<link rel="stylesheet" type="text/css" href="../addr_style.css"></link>
	</head>
    <body>
		<?php include("./admin_include.php"); ?>

        <div id="wrapper">
            <div id="top_header">
				<div id="logo">
					<h1><a href="#">Add a new admin</a></h1>
				</div>
			</div>
            <?php
                if(isset($_SESSION['message'])){
                    echo "<div id='error_msg'>".$_SESSION['message']."</div>";
                    unset($_SESSION['message']);
                }
            ?>
            <div id="main" class="shadow-box"><div id="content">
            <center>
                <form method="post" action="admin_register.php">
                    <table>
                        <tr>
                            <td>Username: </td>
                            <td><input type="text" name="username" class="textInput"></td>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td><input type="email" name="email" class="textInput"></td>
                        </tr>
                        <tr>
                            <td>Password: </td>
                            <td><input type="password" name="pass1" class="textInput"></td>
                        </tr>
                        <tr>
                            <td>Re-enter password: </td>
                            <td><input type="password" name="pass2" class="textInput"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="register" value="Register!"></td>
                            <td><a href="./admin_login.php">Already have an account?</a></td>
                        </tr>
                    </table>
                </form>
                </center>
            </div></div>
        </div>
    </body>
</html>