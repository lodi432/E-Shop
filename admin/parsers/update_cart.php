<?php


require_once $_SERVER['DOCUMENT_ROOT'].'/E-Shop/konfiguracija.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/E-Shop/config.php';


$mode = sanitize($_POST['mode']);
$edit_size= sanitize($_POST['edit_size']);
$edit_id = sanitize($_POST['edit_id']);
$item = array();

$cartQ = $veza->prepare("SELECT * FROM cart WHERE id = '{$cart_id}'");
$cartQ->execute();
$cart = $cartQ->fetchAll(PDO::FETCH_ASSOC);
//print_r($cart);
(array)$items = json_decode($cart[0]['items'],true);
$updated_items[] = $item;
$updated_items = array();

$domain = ($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false;

echo '<pre> Var_dump of ITEMS ';
var_dump ($items);
echo '</pre>';

if ($mode == 'removeone'){
foreach ($items as $item ){


  if ($item['id']==$edit_id && $item['size'] == $edit_size){
    $item['quantity'] = $item['quantity']-1;

  }
  if($item['quantity']>0){
    $updated_items[] = $item;

    }
  }
}



if ($mode == 'addone'){
foreach ($items as $item ){
  if ($item['id']==$edit_id && $item['size'] == $edit_size){
    $item['quantity'] = $item['quantity']+1;
  }
    $updated_items[] = $item;
    echo '<pre> Var_dump of OUT IN FOREACH ';
    var_dump ($items);
    echo '</pre>';
      echo '<pre> Var_dump of updated items inside loop ';
    var_dump ($updated_items);
      echo '</pre>';
  }
}



if(!empty($updated_items)){
    // $updated_items[] = $item;
  $json_updated = json_encode($updated_items);


        echo '<pre> Var_dump of json_updated before prepared ';
        var_dump($json_updated);
        echo '</pre>';

  $smth=$veza->prepare("UPDATE cart SET items = '{$json_updated}' WHERE id ='{$cart_id}'");
  echo '<pre> Var_dump of JSONUPDATED ';
var_dump ($json_updated);
  echo '</pre>';

  $smth->execute();
  $_SESSION['success_launch'] = 'Your shopping cart has been updated!';
  echo "not empty";
}


if(empty($updated_items)){
  // echo "not empty";
    $izraz =$veza->prepare("DELETE FROM cart WHERE id = '{$cart_id}'");
    $izraz ->execute();
    setcookie($CART_COOKIE,'',1,"/",$domain,false);
    echo " empty";
}
// var_dump ($items);


?>
