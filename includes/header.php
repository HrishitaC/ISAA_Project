<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<title>Address Book</title>
		
		<!-- link to the stylesheets -->
		<link rel="stylesheet" type="text/css" href="./addr_style.css"></link>
	</head>
	
	<body>
		<div id="navbar" style="background-color: #03203a; height: 50px; color: white; padding-right: 10px;">
			<?php
				if (session_status() == PHP_SESSION_NONE) {
					session_start();
				}
				if(isset($_SESSION["username"]) && $_SESSION["username"]!=""){
					echo '<h1>
						<a href="./addr_index.php" style="color:white;">Home</a>
						<span style="margin:0 30%;">Logged in as '.$_SESSION["username"].'</span>
						<a href="./logout.php" style="color:white; float:right;">Logout</a>
					</h1>';
				}
				else{
					echo '<h1>
						<a href="./addr_index.php" style="color:white;">Home</a>
						<a href="./user_login.php" style="color:white;">Login</a>
						<a href="./user_register.php" style="color:white;">Register</a>
					</h1>';
				}
			?>
			
		</div>