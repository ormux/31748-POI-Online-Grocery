function show(id, scaling) {
   let images = document.querySelectorAll('.img-category');
   for (let image of images) {
      if(image.style.display == "inline") {
         image.style.display = "none";
      } else {
         continue;
      }
   }
   document.getElementById(id).style.display = "inline";
   document.getElementById(id).style.width = "100%";
   scaling.resize();
}
