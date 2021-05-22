function validateAdd(stock) {
   let string   = document.getElementById('quantity').value;
   let number    = new RegExp(/^[0-9]+$/);
   let other     = new RegExp(/[^0-9]+/);  

   if (string.match(number)) { 
      let quantity = parseInt(string);
      if (quantity < 0) {
         alert('specified quantity MUST NOT be negative');
         return false;
      } 
      if (quantity > stock) {
         alert('specified quantity MUST NOT exceed stocked amount');
         return false;
      }
   } else if (string.match(other)) {
      alert('specified quantity MUST NOT contain letters or symbols');
      return false;
   } else {
      alert('please enter a specific quantity');
      return false;
   }

   return true;
}

function validateCheckout() {
   let email    = document.getElementById('email').value;
   let fname    = document.getElementById('fname').value;
   let lname    = document.getElementById('lname').value;
   let street   = document.getElementById('street').value;
   let city     = document.getElementById('city').value;
   let state    = document.getElementById('state').value;
   let postCode = document.getElementById('postcode').value;
   let country  = document.getElementById('country').value;

   if (email == '' || fname == '' || lname == '' || street == '' ||
      city == '' || state == '' || postCode == '' || country == '') {
      alert('all fields must be completed');
      return false;
   }

   let username = email.split('@')[0];
   console.log('user:',username);
   if (!username) {
      alert('invalid email address');
      return false;
   } 

   let domain = email.split('@')[1];
   console.log('domain:',domain);
   if (!domain) {
      alert('invalid email address');
      return false;
   }

   if (!domain.match(/\./g)) {
      alert('top level domain CAN NOT be blank');
      return false;
   }

   return true;
}
