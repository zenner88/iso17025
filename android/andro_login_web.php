<?php

	$host="sql212.0fees.net"; // Host name
	$username="fees0_11934924"; // Mysql username
	$password="71balsga"; // Mysql password
	$db_name="fees0_11934924_iso17025"; // Database name
	$tbl_name="toko"; // Table name

	// Connect to server and select databse.
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

	// username and password sent from form
	$myusername=$_POST['username'];
	$mypassword=$_POST['password'];

	// To protect MySQL injection
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$myusername = mysql_real_escape_string($myusername);
	$mypassword = mysql_real_escape_string($mypassword);

	$sql="SELECT * FROM $tbl_name WHERE ID='$myusername' and PASSWORD=md5('$mypassword')";
	$result=mysql_query($sql);

	// Mysql_num_row is counting table row
	$count=mysql_num_rows($result);

	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count==1){
		echo "true";
	}
	else {
		echo "Login Failed";
	}
?>