<?php
      require_once 'konfiguracija.php';
      include 'include/head.php';
      include 'include/logocart.php';
      include 'include/izbornik.php';


      $sql =  "SELECT * FROM products";
      $cat_id = (($_POST['cat']!= '')?sanitize($_POST['cat']):'');
      if($cat_id == ''){
        $sql .= ' WHERE deleted = 0';
      }else{
        // $sql .= "WHERE categories = '{$cat_id}' AND DELETED = 0";
        $sql .= "WHERE categories = :cat_id AND DELETED = 0";
      }
      $price_sort =(($_POST['price_sort'] != '')?sanitize($_POST['price_sort']):'');
      $min_price =(($_POST['min_price'] != '')?sanitize($_POST['min_price']):'');
      $max_price =(($_POST['max_price'] != '')?sanitize($_POST['max_price']):'');
      // $brand =(($_POST['brand'] != '')?sanitize($_POST['brand']):'');
      if($min_price != ''){
        $sql .= " AND price >= :min_price";
        $sql->bindParam( ":min_price", $min_price, PDO::PARAM_STR );

      }

      if($max_price != ''){
        $sql .= " AND price <= :max_price";
        $sql->bindParam( ":max_price", $max_price, PDO::PARAM_STR );

      }

      // if($brand != ''){
      //   $sql .= " AND brand = :brand";
      //
      // }


      if($price_sort == 'low'){
        $sql .= " ORDER BY price";
      }
      if($price_sort == 'high'){
        $sql .= " ORDER BY price DESC";
      }


      // $veza->query($sql);
      $productQ =$veza->prepare($sql);
      // $productQ->bindParam( ":brand",$brand, PDO::PARAM_INT );
      $productQ->bindParam( ":cat_id", $cat_id, PDO::PARAM_STR );

      // $productQ->execute();

    $productQ -> execute( array(":max_price" => $_POST['max_price'],
                        ":min_price" => $_POST['min_price'],
                        // ":brand" => $_POST['brand']
                        )
                );

      $category = get_category($cat_id);

?>



<div class="row">
  <?php if($cat_id != ''):?>


  <h2 class="text-center" id="mk1"><?=$category['parent']. ' '.$category['child'];?></h2>
<?php else: ?>
        <h2 class="text=center">Trgovina E-Shopper</h2>
<?php endif; ?>


  <?php   while ($product = $productQ->fetch(PDO::FETCH_ASSOC)): ?>


            <div class="large-3 columns">
            <div class="phone">
              <?php $photos = explode(',',$product['image']);?>
            <img src="<?php echo $photos[0];?>" alt="<?php echo $product['title']; ?>" class="img-thumb"/>
            <h5><?php echo $product['title']; ?></h5>
              <p class="list-price">List Price: <s>$<?php echo $product['list_price'];?></s></p>
              <p class="price">Our Price: $<?php echo $product['price'];?></p>
              <div class="button-wrap"><button data-dialog="somedialog"  class="trigger" onclick="detailsmodal(<?echo $product['id'];?>)">Detalji</button></div>
        </div>
    </div>

  <?php endwhile; ?>

<br><br>
<hr>

</div>

      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
      <script src="stylesheets/bootstrap.min.js"></script>
      <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
      </body>
      <?php
      include 'include/footer.php';
      ?>
