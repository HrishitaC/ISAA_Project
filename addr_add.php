<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!isset($_SESSION['username']) || $_SESSION['username']==''){
        header("location: ./user_login.php");
    }
    include("./includes/header.php");
    include("./includes/addr_include.php");
    //connect to database

    $db = mysqli_connect("localhost", "root", "", "address_book");

    if (isset($_POST['add_btn'])){
        session_start();
        $f_name = mysqli_real_escape_string($db, $_POST['f_name']);
        $l_name = mysqli_real_escape_string($db, $_POST['l_name']);
        $designation = mysqli_real_escape_string($db, $_POST['designation']);
        $address1 = mysqli_real_escape_string($db, $_POST['address1']);
        $address2 = mysqli_real_escape_string($db, $_POST['address2']);
        $city = mysqli_real_escape_string($db, $_POST['city']);
        $state = mysqli_real_escape_string($db, $_POST['state']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $phone = mysqli_real_escape_string($db, $_POST['phone']);

        $sql = "INSERT INTO address_book(f_name, l_name, designation, address1, address2, city, state, email, phone) VALUES ('$f_name', '$l_name', '$designation', '$address1', '$address2', '$city', '$state', '$email', '$phone')";
        mysqli_query($db, $sql);
        $_SESSION["message"] = "New entry made!";
        $_SESSION["name"] = $name;
        header("location: ./addr_index.php"); //redirect to home page
    }
?>

        <div id="wrapper">
            <div id="top_header">
				<div id="logo">
					<h1><a href="#">Add a new Entry</a></h1>
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
                <form method="post" action="">
                    <table>
                        <tr>
                            <td>First Name: </td>
                            <td><input type="text" name="f_name" class="textInput"></td>
                        </tr>
                        <tr>
                            <td>Last Name: </td>
                            <td><input type="text" name="l_name" class="textInput"></td>
                        </tr>
                        <tr>
                            <td>Designation: </td>
                            <td><input type="text" name="designation" class="textInput"></td>
                        </tr>
                        <tr>
                            <td>Address 1: </td>
                            <td><input type="text" name="address1" class="textInput"></td>
                        </tr>
                        <tr>
                            <td>Address 2: </td>
                            <td><input type="text" name="address2" class="textInput"></td>
                        </tr>
                        <tr>
                            <td>City: </td>
                            <td><input type="text" name="city" class="textInput"></td>
                        </tr>
                        <tr>
                            <td>State: </td>
                            <td><input type="text" name="state" class="textInput"></td>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td><input type="email" name="email" class="textInput"></td>
                        </tr>
                        <tr>
                            <td>Phone Number: </td>
                            <td><input type="telephone" name="phone" class="textInput"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" name="add_btn" value="Add!"></td>
                        </tr>
                    </table>
                </form>
                </center>
            </div></div>
        </div>
    </body>
</html>