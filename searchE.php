<?php
      require_once 'konfiguracija.php';
      include 'include/head.php';
      include 'include/logocart.php';
      include 'include/izbornik.php';


      if(isset($_GET['search'])){
      $user_query = $_GET['user_query'];
      $search = $veza->prepare("select * from products where title like '%$user_query%'");
      $search->setFetchMode(PDO:: FETCH_ASSOC);
      $search ->execute();
      if ($search->rowCount()==0){
        echo "<h2>Product was Not found inside our store.</h2>";
      }

}
?>



<div class="row">


  <!-- <h2 class="text-center" id="mk1"><?=$category['parent']. ' '.$category['child'];?></h2> -->
        <h2 class="text=center">Trgovina E-Shopper</h2>


  <?php        while ($row = $search->fetch()): ?>



            <div class="large-3 columns">
            <div class="phone">
              <?php $photos = explode(',',$row['image']);?>
            <img src="<?php echo $photos[0];?>" alt="<?php echo $row['title']; ?>" class="img-thumb"/>
            <h5><?php echo $row['title']; ?></h5>
               <p class="list-price">List Price: <s>$<?php echo $row['list_price'];?></s></p>
               <p class="price">Our Price: $<?php echo $row['price'];?></p>
              <div class="button-wrap"><button data-dialog="somedialog"  class="trigger" onclick="detailsmodal(<?echo $row['id'];?>)">Detalji</button></div> -->
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
