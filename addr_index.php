<?php
    include("./includes/addr_include.php");
    include("./includes/header.php");
?>

		
		<div id="wrapper">
			
			<div id="top_header">
				<div id="nav">
					<a href="<?php echo NEW_ADDR;?>">New Entry</a>
				</div>

				<div id="logo">
					<h1><a href="<?php echo INDEX_ADDR;?>">Search</a></h1>

				</div>
			</div>

			<div id="main" class="shadow-box"><div id="content">
				
				<center>
				<form action="" method="GET" name="">
					<table>
						<tr>
							<td><input type="text" name="k" placeholder="Enter Name..." autocomplete="off"></td>
							<td><input type="submit" name="" value="Search" ></td>
						</tr>
					</table>
				</form>
				</center>

				<?php

					// CHECK TO SEE IF THE KEYWORDS WERE PROVIDED
					if (isset($_GET['k']) && $_GET['k'] != ''){
						
						// save the keywords from the url
						$k = trim($_GET['k']);

						// create a base query and words string
						$query_string = "SELECT * FROM address_book WHERE f_name LIKE '%".$k."%'";

						// connect to the database
						$conn = mysqli_connect("localhost", "root", "", "address_book");

						$query = mysqli_query($conn, $query_string);
						$result_count = mysqli_num_rows($query);

						// check to see if any results were returned
						if ($result_count > 0){
							
							// display search result count to user
							echo '<br /><div class="right"><b><u>'.$result_count.'</u></b> results found</div>';
							echo 'Your search for <i>'.$k.'</i> <hr /><br />';

							echo '<table class="search">';

							// display all the search results to the user
							while ($row = mysqli_fetch_assoc($query)){
								
								echo '<tr colspan="2">
										<td><a href="./addr_profile_view.php?id='.$row['id'].'">'.$row['f_name'].' '.$row['l_name'].'</a></td>
									</tr>';
							}

							echo '</table>';
						}
						else{
							$query_string = "SELECT * FROM address_book WHERE l_name LIKE '%".$k."%'";

							// connect to the database
							$conn = mysqli_connect("localhost", "root", "", "address_book");
	
							$query = mysqli_query($conn, $query_string);
							$result_count = mysqli_num_rows($query);
	
							// check to see if any results were returned
							if ($result_count > 0){
								
								// display search result count to user
								echo '<br /><div class="right"><b><u>'.$result_count.'</u></b> results found</div>';
								echo 'Your search for <i>'.$k.'</i> <hr /><br />';
	
								echo '<table class="search">';
	
								// display all the search results to the user
								while ($row = mysqli_fetch_assoc($query)){
									
									echo '<tr colspan="2">
										<td><a href="./addr_profile_view.php?id='.$row['id'].'">'.$row['f_name'].' '.$row['l_name'].'</a></td>
									</tr>';
								}
	
								echo '</table>';
							}
							else{
								echo 'No results found. Please search something else.';
							}
						}
					}
					else
						echo '';
				?>

			</div></div>

		</div>

	</body>
</html>