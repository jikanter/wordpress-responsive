// make sure boomshaka is loaded
if ((typeof Boomshaka == "undefined") || (BoomShaka == null)) { 
	var Boomshaka = {
	  createKioskView: function() { 
	    var BoomShakaWidgetContainer = document.createElement("div");
	    var BoomShakaInitializeKioskViewButton = document.createElement("button");
	    BoomShakaInitializeDisplayViewButton.value = "Click to begin Kiosk View with your archive of pieces";
	    BoomShakaInitializeDisplayViewButton.onClick = function() { 
	      var screenWidth = screen.width;
	      var screenHeight = screen.height;
	      window.open("/wp-content/themes/boomshaka/inc/kiosk", "kiosk", 
	      "width="+screenWidth+","+"height="+screenHeight+",status=no,resizable=no,fullscreen=yes");
	    };
	    return false;
	  },
	  createPieceView: function() { 
	    var BoomShakaCustomizerContainer = document.createElement("li");
	    BoomShakaCustomizerContainer.setAttribute("class", "control-section accordion-section top");
	    BoomShakaCustomizerContainer.setAttribute("id", "accordion-section-title_boomshaka");
	    var BoomShakaCustomizerTitle = document.createElement("h3");
	    BoomShakaCustomizerTitle.appendChild(document.createTextNode("Customize Gallery"));
	    
	    var BoomShakaPieceContainer = document.createElement("ul");
	    BoomShakaPieceContainer.setAttribute("accordion-section-content");
	    BoomShakaPieceContainer.setAttribute("style", "display: block");
	    
	    // piece height
	    var BoomShakaPieceHeightItem = document.createElement("li");
	    BoomShakaPieceHeightItem.setAttribute("id", "customize-control-piece-default-height");
	    BoomShakaPieceHeightItem.setAttribute("class", "customize-control customize-control-text");
	    var BoomShakaPieceHeightLabel = document.createElement("label");
	    BoomShakaPieceHeightLabel.appendChild(document.createTextNode("Piece Default Height"));
	    
	    // piece width
  		var BoomShakaPieceWidthItem = document.createElement("li");
  		BoomShakaPieceWidthItem.setAttribute("id", "customize-control-piece-default-width");
  		BoomShakaPieceWidthItem.setAttribute("class", "customize-contol customize-control-text");
  		var BoomShakaPieceWidthItemLabel = document.createElement("label");
  		BoomShakaPieceWidthItemLabel.appendChild(document.createTextNode("Piece Default Width"));
  		
  		// piece weight (lbs)
  		var BoomShakaPieceWeightItem = document.createElement("li");
  		BoomShakaPieceWeightItem.setAttribute("id", "customize-control-piece-default-weight");
  		BoomShakaPieceWeightItem.setAttribute("class", "customize-control customize-control-text");
  		var BoomShakaPieceWeightItemLabel = document.createElement("label");
  		BoomShakaPieceWeightItemLabel.appendChild(document.createTextNode("Piece Default Weight"));
  		
  		  		
  		// append the boomshaka piece items to the container
  		BoomShakaPieceContainer.appendChild(BoomShakaPieceHeightItem);
  		BoomShakaPieceContainer.appendChild(BoomShakaPieceWidthItem);
  		BoomShakaPieceContainer.appendChild(BoomShakaPieceWeightItem);
  		
  		// append piece container to the customizer
  		BoomShakaCustomizerContainer.appendChild(BoomShakaPieceContainer);
  		
  		return BoomShakaCustomizerContainer;
	  },
	  init: function(){
	    return BoomShaka.createPieceView();
	  },
	  _initializeFromDOM: function(domTree) { 
	    // internal method, used to tail recurse out of initializeFromDOM
	  },
	  initializeFromDOM: function(domTree) { 
	    for (elementName in domTree) { 
	      while (domTree[elementName].hasChildNodes()) {
	        this.initializeFromDom(domTree[elementName].firstChild);
	      }
	    }
	  },
    /* Boomshaka Material Design */
	  Material: function(name, id, layer, width, height) { 
	    // initial material design implementation
	    // material constructor. Convert object to a material
      // convert object to a material
	    if (!document.getElementById(id)) { id = Math.floor(Math.random()*1000000000); }
      return {type: "Material", name: name, id: id, layer: layer, width: width, height: height, x: 0, y: 0, z: 0, deviceid: null};
	  },
	};
};