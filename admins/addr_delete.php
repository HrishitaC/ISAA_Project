<?php
	session_start();
	if(!isset($_SESSION["admin_username"]) || $_SESSION["admin_username"]==''){
		header("location: ./admin_login.php");
	}
    include("../includes/addr_include.php");

    $db = mysqli_connect("localhost", "root", "", "address_book");
    
    if(isset($_POST['delete_btn']) && isset($_GET["id"])){
		session_start();
		$id = trim($_GET["id"]);
        $sql = "DELETE FROM address_book WHERE id='".$id."'";
        mysqli_query($db, $sql);
        header("location: ../addr_index.php");
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
				<div id="nav">
                    <a href="<?php echo '../'.NEW_ADDR;?>">New Entry</a>
                    <br/>
				</div>

				<div id="logo">
					<h1><a href="#">Delete</a></h1>
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
							
							// display search result count to user
							// echo '<br /><div class="right"><b><u>'.$result_count.'</u></b> results found</div>';
							echo 'Deleting the following user details: <hr /><br />';

							echo '<table class="search">
							<form method="POST" action="./addr_delete.php?id='.$id.'">';

							// display all the search results to the user
							while ($row = mysqli_fetch_assoc($query)){
								
								echo '<tr colspan="2">
    							<td><h3>'.$row['f_name'].' '.$row['l_name'].'</h3></td>
							</tr>
							<tr colspan="2">
								<td><em>'.$row['designation'].'</em></td>
                           </tr>
                            <tr colspan="2">
								<td>'.$row['email'].'</td>
                            </tr>
                            <tr colspan="2">
								<td>'.$row['phone'].'</td>
                            </tr>
                            <tr colspan="2">
								<td>'.$row['address1'].'</td>
                            </tr>
                            <tr colspan="2">
								<td>'.$row['address2'].'</td>
                            </tr>
                            <tr colspan="2">
								<td>'.$row['city'].', '.$row['state'].'</td>
							</tr>
							<tr colspan="2">
								<td><input type="submit" name="delete_btn" value="DELETE!" /></td>
							</tr>';
							}
							echo '</table>
							</form>';
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