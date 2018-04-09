<?php
      require_once 'konfiguracija.php';

      include 'include/head.php';
      // include 'includes/topnav.php';
      include 'include/logocart.php';
      include 'include/izbornik.php';
      // include 'include/preview.php';


         $featured = $veza->prepare("SELECT * FROM products WHERE featured = 1 ;");
         $featured->execute();
?>



    <div class="row">
      <h2 class="text-center" id="mk1">Featured Products</h2>
      <?php   while ($product = $featured->fetch(PDO::FETCH_ASSOC)): ?>


        <div class="large-3 columns">
            <div class="phone">
              <?php $photos =explode(',',$product['image']);?>
                <img src="<?php echo $photos[0];?>" alt="<?php echo $product['title']; ?>" class="img-thumb"/>
                <h5><?php echo $product['title']; ?></h5>
                  <p class="list-price">List Price: <s>$<?php echo $product['list_price'];?></s></p>
                  <p class="price">Our Price: $<?php echo $product['price'];?></p>
                <!-- <a href="#" button class="button tiny" data-dialog="somedialog" id="kol" >Detalji</a> -->
                  <div class="button-wrap"><button data-dialog="somedialog"  class="trigger" onclick="detailsmodal(<?echo $product['id'];?>)">Detalji</button></div>
            </div>
        </div>
      <?php endwhile; ?>

    <br><br>
    <hr>
</div>
    <?php
    include 'include/footer.php';
    ?>
    <?php
    include 'include/skripte.php';
    ?>
