function getProduct(id) {
   let xhttp = new XMLHttpRequest();
   let url = "view.php?id=" + id;
   xhttp.onreadystatechange = function() {
      if(xhttp.readState == 4 && xhttp.status == 200)
         parent.document.getElementById('view').innerHTML = xhttp.responseText;
   }
   xhttp.open('GET', url, false);
   xhttp.send();
   return xhttp.responseText;
}
