<?php
include('top.php');
//Display title

//set to 'TRUE' if you want to see the POST array values
$debug = FALSE;

if($debug == TRUE){
	print "<p>POST array from form input:<pre>"; print_r($_POST); print "</pre></p>";
}

echo "<hr><br>";
?>

<?php

//connect to database to authenticate if it was submitted from the form
if (isset($_POST['Submit'])){

	$user_input =  filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$user_pass =  filter_var($_POST['password'], FILTER_SANITIZE_STRING);


	$user = 'root';
	$password = 'root';
	$db = 'yourSecureBank';
	$tb = 'bankusers';
	$host = 'localhost';
	$port = 8889;
	
	$transactionDisplay = FALSE;
	$userList = array();
	$link = mysqli_connect($host, $user, $password, $db);
	
	if (mysqli_connect_errno()) {
		    printf("Connect failed: %s\n", mysqli_connect_error());
		    exit();
	}
		
	//SQL query to authenticate user name and password from form input
	$query = "Select * FROM ".$tb." WHERE username = '".$user_input."';";
		
	$result = mysqli_query($link, $query) or die(mysqli_error($link));

	if (mysqli_num_rows($result) > 0) {
	// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
		$hashed_pass = salted_hashbrowns($user_pass, $row['salt']);
		}
	}

	$user_db_pass = $hashed_pass;
	
		mysqli_free_result($result);
		/* close connection */
		mysqli_close($link);
		

	//note: these database credentials should not be stored here!
	$user = 'root';
	$password = 'root';
	$db = 'yourSecureBank';
	$tb = 'bankusers';
	$host = 'localhost';
	$port = 8889;
	
	$transactionDisplay = FALSE;
	$userList = array();
	$link = mysqli_connect($host, $user, $password, $db);
	
	if (mysqli_connect_errno()) {
		    printf("Connect failed: %s\n", mysqli_connect_error());
		    exit();
	}
		
	//SQL query to authenticate user name and password from form input
	$query = "Select * FROM ".$tb." WHERE username = '".$user_input."' AND password ='".$user_db_pass."';";
		
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	
	if (mysqli_num_rows($result) > 0) {
	// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
		 
		echo "<h2>Welcome back ".$row['username']."!</h2>";
		echo "<p id='customerID'>Customer ID: ".$row['CustomerID']."</p>";
		$userList[] = $row['CustomerID'];
		$transactionDisplay = TRUE;
		}
	}

	if($transactionDisplay == FALSE){
		echo "Unrecognized username and/or password.";
	}

	mysqli_free_result($result);

	/* close connection */
	mysqli_close($link);
	mysqli_free_result($result);

	if($transactionDisplay == TRUE){
		//note: these database credentials should not be stored here!
		$user = 'root';
		$password = 'root';
		$db = 'yourSecureBank';
		$tb = 'transactions';
		$host = 'localhost';
		$port = 8889;
		
		//display the records in a table
		echo "<hr>";
		echo "<h3>Transactions:</h3>";
		echo "<table>";
		
		//display table headers
		echo "<tr>
				<th>Customer ID</th>
				<th>DATE</th>
				<th>TYPE</th>
				<th class='small'>DESCRIPTION</th>
				<th>DEBIT</th>
				<th class='small'>CREDIT</th>
				<th class='small'>BALANCE</th>
			</tr>";

		if (mysqli_connect_errno()) {
			    printf("Connect failed: %s\n", mysqli_connect_error());
			    exit();
		}

		$link = mysqli_connect($host, $user, $password, $db);
		$query = "Select * FROM ".$tb.";";
		
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		
		if (mysqli_num_rows($result) > 0) {
		// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				
				if(in_array($row['CustomerID'], $userList)){
					echo "<tr>"
							."<td>".$row['CustomerID']."</td>"
							."<td>".$row['date']."</td>"
							."<td class='small left'>".$row['type']."</td>"
							."<td class='left'>" .$row['description']. "</td>"
							."<td class='small right'>".$row['debit']."</td>"
							."<td class='small right'>".$row['credit']."</td>"
							."<td class='small right'>".$row['balance']."</td>"
						."</tr>";
				}
			}
		}
		mysqli_free_result($result);
		/* close connection */
		mysqli_close($link);
		echo "</table>";
//end transaction display	
	}
//end isset
}

//footer with copyright symbol and php displaying the current year
echo "<footer>&copy; Raven Tether - ".date("Y")."</footer>";

?>

</body>
</html>