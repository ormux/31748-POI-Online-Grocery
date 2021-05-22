<?php
include 'include/database.php';
session_start();

if (isset($_SESSION['cart'])) {
   $cart = $_SESSION['cart'];

   if (isset($_GET['action'])) {
      print '<script language="javascript">';
      print 'alert("'.$_POST['fname'].' your order is placed and receipt is emailed")';
      print '</script>';
   }

?>
<link rel="stylesheet" href="css/main.css">
<script src="js/validate.js"></script>

<form 
   action="checkout.php?action=purchase" 
   method="POST" 
   target="view" 
   onsubmit="return validateCheckout()"
>
   <table class="center">
   <tr>
      <td>email:</td>
      <td><input type="text" id="email" name="email" placeholder="enter email"/></td>
   </tr>
   <tr>
      <td>First Name:</td>
      <td><input type="text" id="fname" name="fname" placeholder="enter first name"/></td>
   </tr>
   <tr>
      <td>Last Name:</td>
      <td><input type="text" id="lname" name="lname" placeholder="enter last name"/></td>
   </tr>
   <tr>
      <td>Street:</td>
      <td><input type="text" id="street" name="street" placeholder="enter street"/></td>
   </tr>
   <tr>
      <td>City:</td>
      <td><input type="text" id="city" name="city" placeholder="enter city"/></td>
   </tr>
   <tr>
      <td>State:</td>
      <td><input type="text" id="state" name="state" placeholder="enter state"/></td>
   </tr>
   <tr>
      <td>Post Code:</td>
      <td><input type="text" id="postcode" name="postcode" placeholder="enter postcode"/></td>
   </tr>
   <tr>
      <td>Country:</td>
      <td><input type="text" id="country" name="country" placeholder="enter country"/></td>
   </tr>
   <tr>
      <td><input type="submit" value="Purchase"/></td>
   </tr>
   </table>
</form>

<table class="view-order">
   <caption>Order Details</caption>
   <thead>
      <tr>
         <th>Name</th>
         <th>Quantity</th>
         <th>Price</th>
      </tr>
   <thead>

   <tbody>
<?php
   $grand_total = 0;
   foreach($cart as $_id => $row) {
      $grand_total += $row['price'] * $row['quantity'];
      print '<tr>';
      print '<td>'.$row['name'].'</td>';
      print '<td>'.$row['price'].'</td>';
      print '<td>'.$row['quantity'].'</td>';
      print '</tr>';
   }
?>
      <tr class="grand-total">
         <td><strong>Total</strong></td>
         <td colspan=2><?php print $grand_total; ?></td>
      </tr>
   <tbody>
</table>

<?php

} else {
   print '<h1 align="center">Cannot checkout no products in cart</h1>';
}
?>
