﻿<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/konfiguracija.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
include 'include/head.php';
include 'include/logocart.php';

$format = new NumberFormatter("en_US",NumberFormatter::CURRENCY);

if($cart_id != ''){
  $cartQ = $veza->prepare("SELECT * FROM cart WHERE id = '$cart_id';");
  $cartQ->execute();
  $result= $cartQ->fetch(PDO::FETCH_ASSOC);
  $items = json_decode($result['items'],true);
  //   echo '<pre> Var_dump of $cart_id = ';
  //   var_dump($cart_id);
  //   echo '</pre>';
  //
  // echo '<pre> var_dump $result = ';
  // var_dump($result);
  // echo '</pre>';
  //
  // echo '<pre> var_dump $items =  ';
  // var_dump($items);
  // echo '</pre>';
  //
  $i = 1;
  $sub_total = 0;
  $item_count = 0;
}

include 'include/izbornik.php'
?>



<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>| Your Cart</title>








    <!-- <link rel="stylesheet" href="stylesheets/app.css" /> -->
    <!-- <script src="bower_components/modernizr/modernizr.js"></script> -->
  </head>
  <body>

          </section>
        </nav>
      </div>
    </div> -->

    <div class="row cart">
    <h3>Your Cart</h3>
    <table>
      <thead>

        <tr>
          <th width="100">#</th>
          <th width="400">Item</th>
          <th width="100">Size</th>
          <th width="100">Price</th>
          <th width="100">Quantity</th>
          <th width="200">Total</th>
          <th width="100"></th>
        </tr>
      </thead>
      <tbody>

        <?php if($cart_id =='') :?>


          <div class="bg-danger">
           <p class="text-center text-danger">
             Your shopping cart is empty!
         </p>
          </div>
        <?php else: ?>
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
          <td><?php echo $i;?></td>
          <td>

            <img src="<?php echo $product['image'];?>">
            <p class="text-center"><a href="product.php"><?php echo $product['title'];?></a></p>
          </td>
          <td><?php echo $item['size'];?></td>
          <td><?php echo $format->format ($product['price']); ?></td>
          <td><style>
          button, .button {
          background: #258faf;
          background-color: rgb(37, 143, 175);
}
          </style>

            <button class="button tiny" onclick="update_cart('removeone','<?php echo $product['id'];?>','<?php echo $item['size'];?>');"><i class="fas fa-minus"></i></button>

            <select>
              <?php if($item['quantity']< $available):?>
              <option><?php echo $item['quantity'];?></option>
              <?php else: ?>
              <option>Max</option>
                <?php endif; ?>
            </select>
            <?php if($item['quantity']< $available):?>
              <button class="button tiny" onclick="update_cart('addone','<?php echo $product['id'];?>','<?php echo $item['size'];?>');"><i class="fas fa-plus"></i></button>
          <?php else: ?>
               <span class="text-danger"></span>
          <?php endif; ?>
          </td>
          <td><?php echo $format->format( $item['quantity'] * $product['price']);?></td>
          <td><a href="delete_cart.php?sifra=<?php echo $i; ?>" class="button tiny danger">Remove</a></td>
        </tr>

    <?php
                  $i++;
                  $item_count += $item['quantity'];
                  $sub_total += ($product['price'] * $item['quantity']);
  }
$tax = TAXRATE * $sub_total;
$tax = number_format($tax,2);
$grand_total =$tax+$sub_total; var_dump($grand_total);
  ?>


      </tbody>


    </table>

    <table>
      <thead>
      <th>Total items</th>
      <th>Sub Total</th>
      <th>Tax</th>
      <th>Grand total</th>
      </thead>
      <tbody>
       <tr>
         <td><?=$item_count;?></td>
         <td><?=$sub_total;?></td>
         <td><?=$tax;?></td>
         <td class=""><?=$grand_total;?></td>
       </tr>
      </tbody>
    </table>
      <a href="#" class="button large success pull-right"data-toggle="modal" data-target="#checkoutModal">Checkout
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>


  </a>
  <a href="index.php" class="button large info pull-right" >Continue Shopping</a>



    <!-- Modal -->
    <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="checkoutModalLabel">Shipping Address</h4>
          </div>
          <div class="modal-body">
                <form action ="thankYou.php" method="post" id="payment-form">
                  <span class="bg-danger" id="payment-errors"></span>
                  <input type="hidden" name ="tax" value="<?=$tax;?>">
                  <input type="hidden" name ="sub_total" value="<?=$sub_total;?>">
                  <input type="hidden" name ="grand_total" value="<?=$grand_total;?>">
                  <input type="hidden" name ="cart_id" value="<?=$cart_id;?>">
                  <input type="hidden" name ="description" value="<?=$item_count.'item'.(($item_count>1)?'s':'').'from Trgovinica.';?>">
                       <div id ="step1" style="display:block;">
                        <div class="form-group large-6 columns">
                         <label for="full_name">Full Name:</label>
                         <input class="form-control" id="full_name" name="full_name" type ="text">
                        </div>
                        <div class="form-group large-6 columns">
                         <label for="email">Email:</label>
                         <input class="form-control" id="email" name="email" type ="email">
                        </div>
                        <div class="form-group large-6 columns">
                         <label for="street">Street Adress:</label>
                         <input class="form-control" id="street" name="street" type ="text" data-stripe="address_line1">
                        </div>
                        <div class="form-group large-6 columns">
                         <label for="street2">Street Adress 2:</label>
                         <input class="form-control" id="street2" name="street2" type ="text"data-stripe="address_line2">
                        </div>
                        <div class="form-group large-6 columns">
                         <label for="city">City:</label>
                         <input class="form-control" id="city" name="city" type ="text" data-stripe="address_city">
                        </div>
                        <div class="form-group large-6 columns">
                         <label for="state">State:</label>
                         <input class="form-control" id="state" name="state" type ="text"data-stripe="address_state">
                        </div>
                        <div class="form-group large-6 columns">
                         <label for="zip_code">Zip Code:</label>
                         <input class="form-control" id="zip_code" name="zip_code" type ="text"data-stripe="address_zip">
                        </div>
                        <div class="form-group large-6 columns">
                         <label for="country">Country:</label>
                         <input class="form-control" id="country" name="country" type ="text"data-stripe="address_country">
                        </div>
                       </div>
                       <div id="step2" style="display:none;">
                       <div class="form-group large-3 columns">
                         <label for ="name">Name on Card: <label>
                           <input type="text" id="name" class="form-control" data-stripe="name">
                         </div>
                       <div class="form-group large-3 columns">
                         <label for ="number">Card Number: <label>
                           <input type="text" id="name" class="form-control" data-stripe="number">
                         </div>
                         <div class="form-group large-2 columns">
                           <label for ="cvc">CVC: <label>
                             <input type="text" id="cvc" class="form-control" data-stripe="cvc">
                           </div>
                       <div class="form-group large-2 columns">
                         <label for ="exp-month">Expire Month: <label>
                           <select id ="exp-month"class="form-control" data-stripe="exp_month">
                              <option value=""></option>
                              <?php for ($i=1;$i<13;$i++): ?>
                               <option value="<?php echo $i;?>"><?php echo $i;?></option>

                              <?php endfor; ?>
                           </select>
                         </div>

                       <div class="form-group large-2 columns">
                         <label for ="exp-year">Expire Year: <label>
                           <select id ="exp-year" cčass="form-control"data-stripe ="exp_year">
                             <option value=""></option>
                             <?php $yr =date("Y");?>
                             <?php for($i = 0;$i<11;$i++): ?>
                               <option value="<?=$yr+$i;?>"><?=$yr+$i;?></option>

                             <?php endfor; ?>

                           </select>
                         </div>
                         </div>


          </div>
          <br>  <br>  <br>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="check_address();" id="next_button">Next >></button>
            <button type="button" class="btn btn-primary" onclick="back_address();" id="back_button" style="display:none;">Back <<</button>

            <button type="submit" class="btn btn-primary" id="checkout_button" style="display:none;">Check Out >></button>
          </form>


          </div>
        </div>
      </div>
    </div>





    </div>

    <hr>
    <!-- <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/foundation/js/foundation.min.js"></script> -->
    <?php include 'include/footer.php';?>
    <?php endif;?>

        <!-- <script src="js/app.js"></script> -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src="stylesheets/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>

    <script>

    function back_address(){
      jQuery('#payment-errors').html("");
      jQuery ('#step1').css("display","block");
      jQuery ('#step2').css("display","none");
      jQuery('#next_button').css("display","inline-block");
      jQuery('#back_button').css("display","none");
      jQuery('#checkout_button').css("display","none");
      jQuery('#checkoutModalLabel').html("Shipping Address")
    }
    function check_address(){
  var data={
      'full_name' : jQuery('#full_name').val(),
      'email' : jQuery('#email').val(),
      'street' : jQuery('#street').val(),
      'street2' : jQuery('#street2').val(),
      'city' : jQuery('#city').val(),
      'state' : jQuery('#state').val(),
      'zip_code' : jQuery('#zip_code').val(),
      'country' : jQuery('#country').val(),

  };
  jQuery.ajax({
      url : '/admin/parsers/check_address.php',
      method: 'POST',
      data : data,
      success : function(data){ //this data is what is forwarded back from the parser file
          if(data != 'passed'){

              jQuery ('#payment-errors').html(data);
                console.log(data)
          }
          if(data == 'passed'){
// data = data.trim()
              jQuery('#payment-errors').html("");
              jQuery ('#step1').css("display","none");
              jQuery ('#step2').css("display","block");
              jQuery('#next_button').css("display","none");
              jQuery('#back_button').css("display","inline-block");
              jQuery('#checkout_button').css("display","inline-block");
              jQuery('#checkoutModalLabel').html("Enter Your Card Details")


          }

      },
      error : function(){alert("An error occured!");},
  });
  }

    Stripe.setPublishableKey('<?=STRIPE_PUBLIC;?>');


    function stripeResponseHandler(status, response) {

      // Grab the form:
      var $form = $('#payment-form');

      if (response.error) { // Problem!

        // Show the errors on the form
        $form.find('#payment-errors').text(response.error.message);
        $form.find('button').prop('disabled', false); // Re-enable submission

      } else { // Token was created!

        // Get the token ID:
        var token = response.id;

        // Insert the token into the form so it gets submitted to the server:
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));

        // Submit the form:
        $form.get(0).submit();

      }
    }

    jQuery (function($){
      $('#payment-form').submit(function(event) {
        var $form  = $(this);

        $form.find('button').prop('disabled',true);

        Stripe.card.createToken($form, stripeResponseHandler);

        return false;
      });
    });
    </script>



  </body>
</html>
