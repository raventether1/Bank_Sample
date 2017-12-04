<?php

//#############################################################################################
//sets the users access level
function access_level($user_character){
	if($user_character=="new"){
	$user_level = "least-privileged";
	//sidenotes: the reason why the admin key is so long is to prevent hackers from guessing the
	//key to get admin privileges
	}elseif ($user_character=="super_duper_special_fight_the_power_thor_can_jump_off_a_cliff_admin") {
	$user_level = "most-privileged";
	}else{
		$user_level = "least-privileged";
	}
	return $user_level;
}
//#############################################################################################
//checks to make sure a username is valid
function username_check($username) {
    $ersUser = "";
    if ($username == "") {
        $ersUser .= "<p>Please enter a username</p>";
    } else {
        $arrUserCheck = str_split($username, 1);

        foreach ($arrPassCheck as $value) {
            if (!ctype_alnum($value)) {
                $ersUser .= "<p>Please only use alpha numeric characters into your username</p>";
            }
        }
    }
    return $ersUser;
}

//#############################################################################################
//#############################################################################################
//checks to make sure the password is valid
function password_check($passwordToCheck) {
    $ersPass = "";
    $pn = False;
    $pl = False;
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    //password cannot be blank
    if ($passwordToCheck == "") {
        $ersPass .= "<p>Please enter a Password</p>";
    } else {
        $arrPassCheck = str_split($passwordToCheck, 1);
        //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%    
        // length check
        if (count($arrPassCheck) < 8 or count($arrPassCheck) > 25) {
            $ersPass .= "<p>Password must be between 8 and 25 characters</p>";
        }
        foreach ($arrPassCheck as $value) {
            //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
            //acceptable characters check
            if (!ctype_alnum($value)) {
                $ersPass .= "<p>Please only enter a password that contains letters and numbers.</p>";
            }
            //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
            //makes sure password contains at least one letter and one number        
            if (ctype_digit($value)) {
                $pn = True;
            }
            if (ctype_alpha($value)) {
                $pl = True;
            }
        }
        if (($pn != True) or ( $pl != True)) {
            $ersPass .= "<p>Your Password must contain at least one letter and one number.</p>";
        }
    }
    return $ersPass;
}

function print_errors($value_check) {
    if ($value_check != False and $value_check!="") {
	print("<p>There Were Some Errors...</p>");
	print($value_check);
    return True;
    }
    return False;
}
//#############################################################################################
//checks to see if a user is in a csv file
function item_in_file($item, $filename, $columnNum) {
    $userExists = False;
    //Open the file.
    $fileHandle = fopen($filename, "r");

    if (!file_exists($filename)) {
        die("File not found");
    } else {


        //Loop through the CSV rows.
        while (($row = fgetcsv($fileHandle, 0, ",")) !== FALSE) {
            //Print out my column data.
            if ($item == $row[$columnNum]) {
                $userExists = True;
            }
        }
        fclose($fileHandle);
        return $userExists;
    }
}
//#################################################################################
// Generates a Random String
function generateRandomString() {

	//length of string to be generated
    $length = 20; 

	//characters that can be in string
    $characters = '!@#%^&*()_0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
	//create the random String
	$charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

//#################################################################################
//  Salts a String
function salted_hashbrowns($potato, $salt) {

    //adds the salt to the string that is to be salted
    $seasoned_potato = $potato . $salt;
		
    //uses the sha512 to salt the string
    $cooked_hashbrowns = hash('sha512', $potato);

    //returns the saltd string
    return $cooked_hashbrowns;
}

//#################################################################################
//  Enters a New User Into The Database
function enter_new_user($username, $encryptpswd, $access_lev, $salt, $filename) {

    //arrayify!!!
    $new_user = array($username, $encryptpswd, $access_lev, $salt);

    //opens the file for reading
    $handle = fopen($filename, "a");
    if (!file_exists($filename)) {
        die("File not found");
    }
    fputcsv($handle, $new_user); //$line is an array of string values here

    fclose($handle); // close close
    return;
}

//#################################################################################
//
function database_entry($userReg, $passReg, $user_access, $salt) {


	//Database info
    $user = 'root';
    $password = 'root';
    $db = 'yoursecurebank';
    $tb = $db_table;
    $host = 'localhost';
    $port = 8889;

    $transactionDisplay = FALSE;
    $userList = array();
    $link = mysqli_connect($host, $user, $password, $db);

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    //initialize the last element of the data array
    $lastElement = end($data_array);



	//add the user in the database
    $query = "INSERT INTO `bankusers`(`username`, `password`, `accesslev`, `salt`) VALUES ('".$userReg."','".$passReg."','".$user_access."','" . $salt ."')";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));


    mysqli_free_result($result);

    /* close connection */
    mysqli_close($link);
    mysqli_free_result($result);
}
?>