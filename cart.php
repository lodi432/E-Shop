<?php
include_once $_SERVER['DOCUMENT_ROOT']."/E-Shop/konfiguracija.php";
require_once $_SERVER['DOCUMENT_ROOT'].'/E-Shop/config.php';

include 'include/head.php';
include 'include/izbornik.php';


if($cart_id != ''){
  $cartQ = $veza->prepare("SELECT * FROM cart WHERE id = '$cart_id';");
  $cartQ->execute();
  $result= $cartQ->fetch(PDO::FETCH_ASSOC);
  $items = json_decode($result['items'],true);
  $i = 1;
  $sub_total = 0;
  $item_count = 0;
}

?>

<div class="col-md-12">

  <div class="row">
<h2 class ="text-center">Your Shopping Cart </h2><hr>
<?php if($cart_id =='') :?>



  <div class="bg-danger">
   <p class="text-center text-danger">
     Your shopping cart is empty!
 </p>
  </div>
<?php else: ?>
<table class="table" >
<thead><th>#</th><th>Item</th><th>Price</th><th>Quantity</th><th>Size</th><th>Sub Total</th></thead>
<tbody>

  <?php
  foreach ((array)$items as $item){
        $product_id =$item['id'];
        $productQ = $veza ->prepare("SELECT * FROM products WHERE id = '$product_id'");
        $productQ ->execute();
        $product= $productQ->fetch(PDO::FETCH_ASSOC);
        $sArray = explode (',',$product['sizes']);
        foreach($sArray as $sizeString){
          $s = explode(':',$sizeString);
          if($s[0] ==$item['size']){
            $available = $s[1];
          }
        }
            ?>
            <tr>
            <td><?=$i;?></td>
            <td><?=$product['title'];?></td>
            <td><?=$product['price'];?></td>
            <td><?=$item['quantity'];?></td>
            <td><?=$item['size'];?></td>
            <td><?=$item['quantity'] * $product['price'];?></td>
            </t>
      <?php } ?>

</tbody>
</table>
<?php endif; ?>
  </div>

<?php include 'include/footer.php';?>
