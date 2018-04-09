<?php
define ('BASEURL',$_SERVER['DOCUMENT_ROOT'].'/E-Shop/');
$CART_COOKIE='SBfi72UCklwiqzzz2';
define('CART_COOKIE_EXPIRE',time() + (86400 *30));
define ('TAXRATE',0.087);

define ('CURRENCY','usd');
define ('CHECKOUTMODE','TEST');

if(CHECKOUTMODE == 'TEST'){

  define ('STRIPE_PRIVATE','sk_test_9M1iqFmU6j3ZTsKLUCVtLJ4U');
  define ('STRIPE_PUBLIC','pk_test_NhLNq3Ssj3pyItLcvS9DO3kn');

}

if (CHECKOUTMODE =='LIVE'){
  define ('STRIPE_PRIVATE','');
  define ('STRIPE_PUBLIC','');
}
