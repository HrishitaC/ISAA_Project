<?php
    session_start();
    if(!isset($_SESSION["admin_username"]) || $_SESSION["admin_username"]==''){
        header("location: ./admin_login.php");
    }
    include("../includes/addr_include.php");

    $db = mysqli_connect("localhost", "root", "", "address_book");
    
    if (isset($_POST['update_btn']) && isset($_GET["id"])){
        $id = trim($_GET["id"]);
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

        $sql = "UPDATE address_book set f_name='".$f_name."', l_name='".$l_name."', email='".$email."', phone='".$phone."', designation='".$designation."', address1='".$address1."', address2='".$address2."', city='".$city."', state='".$state."' WHERE id='".$id."'";
        mysqli_query($db, $sql);
        $_SESSION["message"] = "Entry updated!";
        $_SESSION["name"] = $name;
        header("location: ../addr_index.php"); //redirect to home page
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
					<h1><a href="#">Update</a></h1>
				</div>
			</div>

			<div id="main" class="shadow-box"><div id="content">
				
				<?php

					// CHECK TO SEE IF THE KEYWORDS WERE PROVIDED
					if (isset($_GET['id']) && $_GET['id'] != ''){
						
						// save the keywords from the url
						$id = trim($_GET['id']);

						// create a base query and words string
						$query_string = "SELECT * FROM address_book WHERE id LIKE '".$id."'";

						// connect to the database
						$conn = mysqli_connect("localhost", "root", "", "address_book");

						$query = mysqli_query($conn, $query_string);
						$result_count = mysqli_num_rows($query);

						// check to see if any results were returned
						if ($result_count > 0){

							echo '<form method="POST" action="./addr_update.php?id='.$id.'">';

							// display all the search results to the user
							while ($row = mysqli_fetch_assoc($query)){
								
								echo '<table>
                                <tr>
                                    <td>First Name: </td>
                                    <td><input type="text" name="f_name" class="textInput" placeholder='.$row['f_name'].' value='.$row['f_name'].'></td>
                                </tr>
                                <tr>
                                    <td>Last Name: </td>
                                    <td><input type="text" name="l_name" class="textInput" placeholder='.$row['l_name'].' value='.$row['l_name'].'></td>
                                </tr>
                                <tr>
                                    <td>Designation: </td>
                                    <td><input type="text" name="designation" class="textInput" placeholder='.$row['designation'].' value='.$row['designation'].'></td>
                                </tr>
                                <tr>
                                    <td>Address 1: </td>
                                    <td><input type="text" name="address1" class="textInput" placeholder='.$row['address1'].' value='.$row['address1'].'></td>
                                </tr>
                                <tr>
                                    <td>Address 2: </td>
                                    <td><input type="text" name="address2" class="textInput" placeholder='.$row['address2'].' value='.$row['address2'].'></td>
                                </tr>
                                <tr>
                                    <td>City: </td>
                                    <td><input type="text" name="city" class="textInput" placeholder='.$row['city'].' value='.$row['city'].'></td>
                                </tr>
                                <tr>
                                    <td>State: </td>
                                    <td><input type="text" name="state" class="textInput" placeholder='.$row['state'].' value='.$row['state'].'></td>
                                </tr>
                                <tr>
                                    <td>Email: </td>
                                    <td><input type="email" name="email" class="textInput" placeholder='.$row['email'].' value='.$row['email'].'></td>
                                </tr>
                                <tr>
                                    <td>Phone Number: </td>
                                    <td><input type="telephone" name="phone" class="textInput" placeholder='.$row['phone'].' value='.$row['phone'].'></td>
                                </tr>
                                <tr>
                                    <td><input type="submit" name="update_btn" value="Update!"></td>
                                </tr>
                            </table>';
							}

							echo '</form>';
						}
						else
							echo 'No results found. Please search something else.';
					}
					else
						echo '';
				?>

			</div></div>

		</div>

	</body>
</html>