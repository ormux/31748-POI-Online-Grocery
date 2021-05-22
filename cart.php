<?php
include 'include/database.php';
session_start();

if (isset($_GET['action'])) {
   $action = $_GET['action'];

   switch ($action) {
      case 'add':
         $product_id  = $_GET['id'];
         $quantity    = $_POST['quantity'];

         $query  = "SELECT product_name, unit_price, in_stock FROM Products ";
         $query .= "WHERE product_id=".$product_id.";";
         $result = mysqli_query($db_link, $query);

         $name = ''; $price = 0; $stock = 0;
         while($row = mysqli_fetch_assoc($result)) {
            $name  = $row['product_name'];
            $price = $row['unit_price'];
            $stock = $row['in_stock'];
         }

         if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();

            $record = array(
               'name'     => $name,
               'quantity' => $quantity,
               'price'    => $price
            );

            $_SESSION['cart']['_'.$product_id] = $record;

         } else {

            $record = array(
               'name'     => $name,
               'quantity' => $quantity,
               'price'    => $price
            );

            if (!isset($_SESSION['cart']['_'.$product_id])) {
               $_SESSION['cart']['_'.$product_id] = $record;

            } else {
               $newQuantity = $_SESSION['cart']['_'.$product_id]['quantity'] + $quantity;

               if ($newQuantity <= $stock) {
                  $_SESSION['cart']['_'.$product_id]['quantity'] = $newQuantity;
               } else if ($newQuantity < 0) {
                  print '<script language="javascript">';
                  print 'alert("quantities CAN NOT be a negative value")';
                  print '</script>';
               } else {
                  print '<script language="javascript">';
                  print 'alert("specified quantity MUST NOT exceed the inventory size")';
                  print '</script>';
               }
            }
         }
         break;

      case 'del':
         $product_id  = $_GET['id'];
         $length      = sizeof($_SESSION['cart']);

         if ($length <= 1)
            unset($_SESSION['cart']);
         else
            unset($_SESSION['cart'][$product_id]);
         break;

      case 'clear':
         unset($_SESSION['cart']);
         break;
   }
}

?>
<link rel='stylesheet' href='css/main.css'>
<table class='cart-table'>
   <thead>
<?php
   if (isset($_SESSION['cart'])) {
      print '<tr>';
      print '<th>Name</th>';
      print '<th>Price</th>';
      print '<th>Quantity</th>';
      print '<th>Total</th>';
      print '<th>Remove</th>';
      print '</tr>';
   }
?>
   </thead>

   <tbody>
<?php 
   if (isset($_SESSION['cart'])) {
      $cart = $_SESSION['cart'];
      $grand_total = 0;

      foreach ($cart as $_id => $record) {
         $total = $record['quantity'] * $record['price'];
         $grand_total += $total;
         //$id = str_replace('_', '', $_id);
         $image = '<img width="32px" height="32px" src="images/delete.png"/>';
         $delete = '<a href=cart.php?action=del&id='.$_id.'>'.$image.'</a>';

         print '<tr>';
         print '<td>'.$record['name'].'</td>';
         print '<td>'.$record['price'].'</td>';
         print '<td>'.$record['quantity'].'</td>';
         print '<td>'.$total.'</td>';
         print '<td>'.$delete.'</td>';
         print '</tr>';
      }

      print '<tr class="grand-total">';
      print '<td></td>';
      print '<td><strong>Grand Total</strong></td>';
      print '<td></td>';
      print '<td>'.$grand_total.'</td>';
      print '<td></td>';
      print '</tr>';
      
   } else {
      print '<tr>';
      print '<td colspan=5><h1>Cart Is Empty</h1></td>';
      print '</tr>';
   }
?>
   </tbody>
</table>
<div class="center">
<?php 
   $clear    = '<a href="cart.php?action=clear"><button>Clear</button></a>';
   $checkout = '<a href="checkout.php" target="view"><button>Checkout</button></a>';
   print $clear;
   print $checkout;
?>
</div>
