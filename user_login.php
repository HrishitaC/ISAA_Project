<?php
    include("./includes/header.php");
    include("./includes/addr_include.php");
    //connect to database

    $db = mysqli_connect("localhost", "root", "", "address_book");

    if (isset($_POST['login'])){
        session_start();
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $pass1 = mysqli_real_escape_string($db, $_POST['pass1']);

        $pass1 = md5($pass1);

        $sql = "SELECT * FROM users WHERE username='$username' AND password = '$pass1'";
        $result = mysqli_query($db, $sql);

        if(mysqli_num_rows($result) == 1){
            $_SESSION['message'] = "You are now logged in";
            $_SESSION['username'] = $username;
            header("location: ./addr_index.php"); //redirect to home page        
        }else{
             $_SESSION['message'] = "Username/password combination is incorrect";
        }
    }
?>

        <div id="wrapper">
            <div id="top_header">
				<div id="logo">
					<h1><a href="#">User Login</a></h1>
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
                <form method="post" action="user_login.php">
                    <table>
                        <tr>
                            <td>Username: </td>
                            <td><input type="text" name="username" class="textInput"></td>
                        </tr>
                        <tr>
                            <td>Password: </td>
                            <td><input type="password" name="pass1" class="textInput"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Login" name="login"></td>
                            <td><a href="user_register.php">Don't have an account?</a></td>
                        </tr>
                    </table>
                </form>
                </center>
            </div></div>
        </div>
    </body>
</html>