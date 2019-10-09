<?php
//generating CSRF Token
// Ref : https://www.thecodedeveloper.com/generate-random-alphanumeric-string-with-php/

//generate token for money transfer
if(isset($_POST['token_gen'])){
    //check if the token for money transfer
    if($_POST['token_gen'] == "transfer"){
        //call function to generate token
        $token = csrf_token_gen();
    }
    //else
    else{
        $token = "Invalid request";
    }
    exit;
}

//function to generate csrf token
function csrf_token_gen(){
    //generate csrf token
    $token = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32);

    //save the csrf token in a cookie
	setcookie("csrf", $token, time() + (86400 * 30), "/");

	//return the csrf token
    return $token;
}
?>