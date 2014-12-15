Boomshaka.Material.Carousel = function() { 
  this.material = new Boomshaka.Material();
  this.material.Layers = [new Layer(), null];
  this.material.Animation = {};
  this.material.native = null;
  this.material.deviceid = 0; // browser
  
  this.Animation.step = function(id, dx, dy, dz) { 
    var elem = document.getElementById(id);
    if ((!this.material.native) || (this.material.native == null)) {
      elem.style.x = elem.style.x + dx + ' px';
      elem.style.y = elem.style.y + dy + ' px';
      elem.style.z = elem.style.z + dz + ' px';
    }
    else { 
      // native
      elem.x += dx;
      elem.y += dy;
      elem.z += dz;
    }
    return elem;
  };
};
