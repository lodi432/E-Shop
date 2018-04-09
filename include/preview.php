<?php
      require_once 'konfiguracija.php';

      $cat_id=((isset($_REQUEST['price_sort']))?sanitize($_REQUEST['cat']):'');
      $price_sort=((isset($_REQUEST['price_sort']))?sanitize($_REQUEST['price_sort']):'');
      $min_price=((isset($_REQUEST['min_price']))?sanitize($_REQUEST['min_price']):'');
      $max_price=((isset($_REQUEST['max_price']))?sanitize($_REQUEST['max_price']):'');
      $b=((isset($_REQUEST['brand']))?sanitize($_REQUEST['brand']):'');
      $brandQ = $veza ->prepare("SELECT * FROM brand ORDER BY brand");
      $brandQ ->execute();
       ?>



<div class="row showcase">
  <div class="large-3 columns">
     <div class="showcase-menu">
        <h3>Browse By Brand</h3>

<form action="search.php" method ="post">
        <ul class="side-nav">

            <?php while ($brand = $brandQ->fetch(PDO::FETCH_ASSOC)): ?>
            <li> <a href="addidas.php" name="brand" value="<?=$brand['id'];?>"<?=(($b==$brand['id'])?' checked':'');?>><?=$brand['brand'];?></a>
            </li>
            <?php endwhile; ?>
         </ul>



            <h3>Search By Price </h3>
                <input type="hidden" name="cat" value ="<?=$cat_id;?>">
                <input type ="hidden" name="price_sort" value="0">

            <ul class="side-nav ">
           <input type ="radio" name ="price_sort" value="low"<?php echo(($price_sort=='low')?'checked':'');?>> Low to High<br>
          <input type ="radio" name ="price_sort" value="high"<?php echo(($price_sort=='high')?'checked':'');?>> High to Low

            <div class="columns large-12 ">
              <li>    <input type ="hidden" name ="min_price" class ="price-range"placeholder ="Min $" value="<?php echo $min_price?>">
                <input type ="hidden" name ="max_price" class ="price-range"placeholder ="Maximum $" value="<?php echo $max_price?>">

            </div>

           <br> <input type ="submit" value ="SET" class="button alert tiny right" >
           </ul>
          </form>
</div>


        </div>
  </div>
<!--
  <div class="large-9 columns">
    <ul class="example-orbit" data-orbit>

      <li>
       <img src="img/slide3.jpg" alt="slide 3" />
        <div class="orbit-caption">
          LG G2
        </div>
      </li>
</ul>
  </div> -->
</div>
