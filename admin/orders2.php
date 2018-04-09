<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/E-Shop/konfiguracija.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/E-Shop/config.php';
if(!is_logged_in()){
  header("Location login2.php");
}
?>
    <head>
         <?php
       include_once "includes/head.php"; ?>
    </head>

<body>
      <div class="grid-container">
    <div class="app-dashboard-body-content off-canvas-content" data-off-canvas-content>
    <?php include_once "includes/panel.php";

   //Complete orders

   if (isset($_GET['complete']) && $_GET['complete'] ==1) {
     $cart_id = sanitize((int)$_GET['cart_id']);
     $qtx2 = $veza->prepare("UPDATE cart SET shipped =1 WHERE id =:cart_id");
     $qtx2->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
     $qtx2->execute();
     $_SESSION['success_launch'] = "The order has been Completed!";
     header('Location: orders.php');
     

   }



    $txn_id=sanitize((int)$_GET['txn_id']);
    $txnQuery = $veza ->prepare("SELECT * FROM transactions WHERE id =:txn_id");
    $txnQuery->bindParam(':txn_id', $txn_id, PDO::PARAM_INT);
    $txnQuery->execute();
    $txn= $txnQuery->fetch(PDO::FETCH_ASSOC);
    $cart_id = $txn['cart_id'];
    $cartQ = $veza->prepare("SELECT * FROM cart WHERE id =:cart_id");
    $cartQ->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
    $cartQ->execute();
    $cart= $cartQ->fetchAll(PDO::FETCH_ASSOC);

    (array)$items = json_decode($cart[0]['items'],true);
    $idArray = array();
    $products= array();
    foreach($items as $item){
      $idArray[] = $item['id'];
    }
    $ids = implode(',',$idArray);

    $productQ =$veza->prepare("SELECT i.id as 'id', i.title as 'title', c.id as 'cid', c.category as 'child', p.category as 'parent'
    FROM products i
    LEFT JOIN categories c ON i.categories=c.id
    LEFT JOIN categories p ON c.parent = p.id
    WHERE i.id IN ({$ids})
    ");
    $productQ->execute();

    while ($p = $productQ->fetch(PDO::FETCH_ASSOC)){
           foreach($items as $item){
             if($item['id']== $p['id']){
               $x=$item;
               continue;
             }

           }
      $products[] = array_merge($x,$p);
    }
    ?>

<h2 class="table-center">Items Ordered </h2>
<table class="stack">
  <thead>
    <th>Quantity</th>
    <th>Title</th>
    <th>Category</th>
    <th>Size</th>
  </thead>
  <tbody>
    <?php foreach($products as $product): ?>
      <tr>
          <td><?=$product['quantity'];?></td>
          <td><?=$product['title'];?></td>
          <td><?=$product['parent'].' ~ '.$product['child'];?></td>
          <td><?=$product['size'];?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="row">
<div class="column medium-6">
<h3 text="center">Order Detais</h3>
<table class="stripe">
  <tbody>
    <tr>
        <tr>
           <td>Sub Total</td>
           <td><?=$txn['sub_total'];?></td>
        </tr>
        <tr>
           <td>Tax</td>
           <td><?=$txn['tax'];?></td>
        </tr>
        <tr>
           <td>Grand Total</td>
           <td><?=$txn['grand_total'];?></td>
        </tr>
        <tr>
           <td>Order Date</td>
           <td><?=$txn['txn_date'];?></td>
        </tr>
    </tr>
  </tbody>
</table>
</div>

<div class="column medium-6"><br>
  <h3 text="center">Shipping Address</h3>
  <address>
    <?=$txn['full_name'];?><br>
    <?=$txn['street'];?><br>
    <?=($txn['street2']!= '')?$txn['street2'].'<br>':'';?>
    <?=$txn['city'].', '.$txn['state'].' '.$txn['zip_code'];?><br>
    <?=$txn['country'];?><br>
  </address>
</div>
</div>
<div class="float-right">
  <a href ="index.php" class="button large alert">Cancel</a>
    <a href="orders2.php?complete=1&cart_id=<?=$cart_id;?>" class="button large">Complete Order</a>
