

<?php
include('top.php');
//Display title


?>

<!-- **** BEGIN FORM **** -->
<!-- note: form action should be post instead of POST! -->
<form action="accounts.php" method="POST" id='inputForm'>
	<fieldset>
		<legend>Secure Login</legend>
		<label for="name">Username:</label><input type='text' id="name" name='name' required form='inputForm'>	
		<label for="name">Password:</label><input type='password' id="password" name='password' required form='inputForm'>
		<input type="submit" id="submit1" name = 'Submit' value = 'Submit'>
	</fieldset>
</form>

<!-- **** END OF FORM **** -->

<?php

//footer with copyright symbol and php displaying the current year
echo "<footer>&copy; Raven Tether - ".date("Y")."</footer>";

?>

</body>
</html>