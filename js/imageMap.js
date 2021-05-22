class ImageMapScale {
   constructor(map, image, width) {
      this.image = image;
      this.objects = [];
      this.pixelWidth = width;

      let areas = map.getElementsByTagName('area');

      for (let i = 0; i < areas.length; i++) {
         let area = areas[i];
         this.objects.push(
            {
               tag: area,
               coords: area.coords.split(',')
            }
         );
      }


      let self = this;
      window.addEventListener('resize', function(event) {
         self.resize(event);
      });

      this.resize();
   }

   resize() {
      let scale = this.image.offsetWidth / this.pixelWidth;

      for (let i = 0; i < this.objects.length; i++) {
         let area = this.objects[i];
         let positions = [];

         for (let j = 0; j < area.coords.length; j++) {
            let prevCoord = area.coords[j];
            let newCoord = Math.round(prevCoord * scale);
            positions.push(newCoord);
         }
         area.tag.coords = positions.join(',');
      }

      return true;

   }

}


/*class ImageMapScale {
   constructor(map, image, width) {
      this.areas = [];
      this.image = image;
      this.pixelWidth = width;

      for (let area of map.getElementsByTagName('area')) {
         this.areas.push({
            tag: area,
            coords: area.coords.split(',')
         });
      }

      let self = this;
      window.addEventListener('resize', function(event) {self.resize()});
      this.resize();
   }

   resize() {
      let scale = this.image.offsetWidth / this.pixelWidth;

      for (let area of this.areas) {
         let positions = [];
         for (let prevCoord of area.coords) {
            positions.push(Math.round(prevCoord * scale));
         }
         area.tag.coords = positions.join(',');
      }

      return true;
   };
}
*/
