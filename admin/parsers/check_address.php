<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/konfiguracija.php';
$name = sanitize($_POST['full_name']);
$email = sanitize($_POST['email']);
$street = sanitize($_POST['street']);
$street2 = sanitize($_POST['street2']);
$city = sanitize($_POST['city']);
$state = sanitize($_POST['state']);
$zip_code = sanitize($_POST['zip_code']);
$country = sanitize($_POST['country']);
$greske=array();
$required=array(
    'full_name' => 'Full Name',
    'email' => 'Surname',
    'street' => 'Street Address',
    'city' => 'City',
    'state' => 'State',
    'zip_code' => 'Zip Code',
    'country' => 'Country',
);

//check if all required fieds were filled out
foreach($required as $f => $d){
    if(empty($_POST[$f]) || $_POST[$f]==''){
        $greske[] = $d.' is required!<br>';
    }
}


//check if Email is valid

if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
  $greske [] = 'Please enter a vaild Email.' ;
}

if(!empty($greske)){
    echo display_greske($greske);
}else{
    echo 'passed';
}?>
