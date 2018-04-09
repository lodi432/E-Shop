<?php include_once "../konfiguracija.php";
// provjeraOvlasti();
// if (!is_logged_in()){
//       header('Location: login2.php');
// }
// session_destroy();
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
    <head>
         <?php
       include_once "includes/head.php"; ?>
    </head>

<body>
      <div class="grid-container">

    <?php include_once "includes/panel.php";
    ?><div class="app-dashboard-body-content off-canvas-content" data-off-canvas-content>



<div class="columns medium-12">
<h3 class="center"> Orders to Ship </h3>
<?php
     $txnQuery =$veza->prepare("SELECT t.id, t.cart_id,t.full_name,t.description,t.txn_date,t.grand_total,c.items,c.paid,c.shipped FROM transactions t
      LEFT JOIN cart c ON t.cart_id=c.id
      WHERE c.paid = 1 AND c.shipped = 0
      ORDER BY t.txn_date");
       $txnQuery->execute();


?>
<table class="table table-condensed table-bordered table-striped">
  <thead>
    <th></th><th>Name</th><th>Description</th><th>Total</th><th>Date</th>
  </thead>
  <tbody>
    <?php while ($order = $txnQuery->fetch(PDO::FETCH_ASSOC)):?>
    <tr>
      <td><a href="orders2.php?txn_id=<?=$order['id'];?>"class="button">Details</td>
      <td><?=$order['full_name'];?></td>
      <td><?=$order['description'];?></td>
      <td>$<?=$order['grand_total'];?></td>
      <td><?=$order['txn_date'];?></td>
    </tr>
  <?php endwhile;?>
  </tbody>
</table>
</div>


</div>
       </div>
     </div>

<?php include_once 'includes/podnozje.php'; ?>
     <?php include_once 'includes/scripts.php';?>
</body>

</html>
