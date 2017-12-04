        <?php
		include('top.php');
        if (isset($_POST['Submit'])) {
            $filename = 'bankusers.csv';
            $erMessage = "";

            //stores santized data in php variables 
            $userReg = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $passReg = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
			$salt = 

            //checks the username for errors
            $user_errs = username_check($userReg);

            //checks the password for errors
            $pass_errs = password_check($passReg);

            //adds the errors to the error array
			if($user_errs == "" and $pass_errs == ""){
				$erMessage =="";
			}else{
				$erMessage .= $user_errs;
				$erMessage .= $pass_errs;
			}

            //checks to see if user already exists in the file
            $user_check = item_in_file($userReg, $filename, 0);
            if ($user_check == True) {
                $erMessage['baduse'] = "You are ALREADY A user.";
            }


            $errit = print_errors($erMessage);

            //if there are no errors, enter the user
            if ($errit != True) {

			$pass_salt = generateRandomString();
			$np_pass = salted_hashbrowns($passReg,$pass_salt);

                $access_set = "new";
                $user_access = access_level($access_set);

                print '<p>Thank You For joining Our Site.</p>';
                enter_new_user($userReg, $passReg, $user_access, $pass_salt, $filename);


				


                database_entry($userReg, $np_pass, $user_access, $pass_salt);

            }
        }
        ?>

        <!-- **** BEGIN FORM **** -->
        <!-- note: form action should be post instead of get! -->
        <form action="create-user.php" method="POST" id='inputForm'>
            <fieldset>
                <legend>Create A New Account</legend>
				Thank You For Becoming a Member
                <label for="name">Username:</label><input type='text' id="name" name='name' required form='inputForm'>	
                <label for="name">Password:</label><input type='password' id="password" name='password' required form='inputForm'>
                <input type="submit" id="Submit" name = 'Submit' value = 'Submit'>
            </fieldset>
        </form>

        <!-- **** END OF FORM **** -->

        <?php
//footer with copyright symbol and php displaying the current year
        echo "<footer>&copy; Raven Tether - " . date("Y") . "</footer>";
        ?>

    </body>
</html>
