<?php
session_start();
	//Define variables and initialize with empty values
    $csrf = $sid =  "";
	
	//check if the post data is set correctly
    if(isset($_POST["amount"]) && isset($_POST['csrf'])){
		//check if the csrf cookie is set
        if(isset($_COOKIE["csrf"])){
            $csrf = $_COOKIE["csrf"];
        }
		//compare the csrf token cookie and the post csrf token
        if($csrf != $_POST["csrf"]){
            $messege = "Invalid CSRF token. <br/> Please refresh the page and try again";
        }
		//validate entered amount
        elseif(!is_numeric($_POST["amount"])){
            $messege = "Please enter a valid amount";
        }
		//if no errors transfer money 
        else{
            $messege = "$".$_POST["amount"]." Transfered Successfully.";
        }
    }
    else{
        $messege = "Invalid request.";
    }
echo $messege;

//unset csrf token from cookies
$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        if($name == "csrf"){
            setcookie($name, '', time()-1000, "/");
        }
    }
?>