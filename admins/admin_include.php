<div id="navbar" style="background-color: #03203a; height: 50px; color: white; padding-right: 10px;">
			<?php
				if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
				if(isset($_SESSION["admin_username"]) && $_SESSION["admin_username"]!=""){
                    echo '<h1>
                        <a href="../addr_index.php" style="color:white;">Home</a>
                        <span style="margin:0 30%;">Logged in as '.$_SESSION["admin_username"].'</span>
                        <a href="../logout.php" style="color:white; float:right;">Logout</a>
                    </h1>';
				}
				else{
                    echo '<h1>
                        <a href="../addr_index.php" style="color:white;">Home</a>
                        <a href="../user_login.php" style="color:white;">Login</a>
                        <a href="../user_register.php" style="color:white;">Register</a>
                    </h1>';
				}
			?>
			
		</div>