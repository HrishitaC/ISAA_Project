<?php
    include("./includes/header.php");
    include("./includes/addr_include.php");
?>


    <div id="wrapper">
    
    <div id="top_header">
        <div id="nav">
                    <a href="<?php echo NEW_ADDR;?>">New Entry</a>
				</div>
        <div id="logo">
			<h1><a href="#">User Details</a></h1>
		</div>
    </div>
    <div id="main" class="shadow-box"><div id="content">
        <table class="search">
            <?php
                if(isset($_GET["id"])){
                    $id = trim($_GET["id"]);
                    $query_string = "SELECT * FROM address_book WHERE id LIKE '".$id."'";
                    $conn = mysqli_connect("localhost", "root", "", "address_book");

					$query = mysqli_query($conn, $query_string);
                    
                    echo '<table class="search">';

					// display all the search results to the user
					while ($row = mysqli_fetch_assoc($query)){					
						echo '<tr colspan="2">
    							<td><h3>'.$row['f_name'].' '.$row['l_name'].'</h3></td>
							</tr>
							<tr colspan="2">
								<td><strong>Designation:</strong><br/>'.$row['designation'].'</td>
                           </tr>
                            <tr colspan="2">
								<td><strong>Email:</strong><br/>'.$row['email'].'</td>
                            </tr>
                            <tr colspan="2">
								<td><strong>Contact No:</strong><br/>'.$row['phone'].'</td>
                            </tr>
                            <tr colspan="2">
								<td><strong>Address:</strong> <br/>'.$row['address1'].'<br/>'.$row['address2'].'<br/>'.$row['city'].', '.$row['state'].'</td>
                            </tr>';
                            echo '<tr>
                                <td><button><a href="./admins/addr_update.php?id='.$row["id"].'">UPDATE</a></button></td>
                                <td><button><a href="./admins/addr_delete.php?id='.$row["id"].'">DELETE</a></button></td>
                            </tr>';
                        }
                    
					echo '</table>';
                }
            ?>
        </table>
    </div></div>
    </div>
    </body>
</html>