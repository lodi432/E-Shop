<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
require_once 'konfiguracija.php';



// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey(STRIPE_PRIVATE);

// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
$token = $_POST['stripeToken'];

//get the rest of the post data
$full_name = sanitize($_POST['full_name']);
$email = sanitize($_POST['email']);
$street = sanitize($_POST['street']);
$street2 = sanitize($_POST['street2']);
$city = sanitize($_POST['city']);
$state = sanitize($_POST['state']);
$zip_code = sanitize($_POST['zip_code']);
$country = sanitize($_POST['country']);
$tax = sanitize($_POST['tax']);
$sub_total = sanitize($_POST['sub_total']);
$grand_total = sanitize($_POST['grand_total']);
$cart_id = sanitize($_POST['cart_id']);
$description = sanitize($_POST['description']); var_dump($grand_total);
$charge_amount = number_format((float)$grand_total,2)*100;
$metadata = array(

  "cart_id"    =>   $cart_id,
  "tax"        =>   $tax,
  "sub_total"  =>   $sub_total,

);
try {
$charge = \Stripe\Charge::create(array(
    'amount' => $charge_amount,
    'currency' => CURRENCY,
    'source' => $token,
    'description' => $description,
    // "receipt_email" => $email,  works only on live mode
    "metadata" => $metadata)

);

$smth1=$veza->prepare("UPDATE cart SET paid = 1 WHERE id = '{$cart_id}'");
$smth1->execute();
$smth2=$veza->prepare("INSERT INTO transactions
(charge_id,cart_id,full_name,email,street,street2,city,state,zip_code,country,sub_total,tax,grand_total,description,txn_type)VALUES
('$charge->id','$cart_id','$full_name','$email','$street','$street2','$city','$state','$zip_code','$country','$sub_total','$tax','$grand_total','$description','$charge->object')");
$smth2->execute();
$domain = ($_SERVER['HTTP_HOST'] != 'localhost')? '.'.$_SERVER['HTTP_HOST']:false;
setcookie($CART_COOKIE,'',1,"/",$domain,false);
include 'include/head.php';
include 'include/izbornik.php';


?>

<h1 class="text center text-success">Thank You! </h1>
<p> Your card has been successfully charged <?=$grand_total;?>.</p>
<p>Your receipt number is <strong><?=$cart_id;?></strong></p>
<p>Your order will be shipped to the address below. </p>
<address>
<?=$full_name;?><br>
<?=$street;?><br>
<?=$city;?><br>
</address>
<?php
} catch (\Stripe\Error\Card $e){
echo $e;
}
 ?>
