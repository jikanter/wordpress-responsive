// make sure boomshaka is loaded
if (typeof Boomshaka == "undefined") { 
	var Boomshaka = {
	  init: function() { 
	      return jQuery(document).ready(function() { 
	        this.createBoomshakaCustomizer = function() {
        		var boomshakaCustomizerContainer = document.createElement("li");
        		boomshakaCustomizerContainer.setAttribute("class", "control-section accordion-section top");
        		// set the id to boomshaka
        		boomshakaCustomizerContainer = boomshakaContainer.attr("id", "accordion-section-title_boomshaka");
        		boomshakaCustomizerTitle = document.createElement("h3");
        		boomshakaCustomizerTitle.appendChild(document.createTextNode("Customize Gallery"));

        		boomshakaCustomizerContentContainer = document.createElement("ul");
        		boomshakaCustomizerContentContainer.setAttribute("class", "accordion-section-content");
        		boomshakaCustomizerContentContainer.setAttribute("style", "display: block");

        		// piece height
        		boomshakaCustomizerHeightItem = document.createElement("li");
        		boomshakaCustomizerHeightItem.setAttribute("id", "customize-control-piece-default-height");
        		boomshakaCustomizerHeightItem.setAttribute("class", "customize-control customize-control-text");
        		boomshakaCustomizerHeightLabel = document.createElement("label");
        		boomshakaCustomizerHeightLabel.appendChild(document.createTextNode("Piece Default Height"));

        		// piece width
        		boomshakaCustomizerWidthItem = document.createElement("li");
        		boomshakaCustomizerWidthItem.setAttribute("id", "customize-control-piece-default-weight");
        		boomshakaCustomizerWidthItem.setAttribute("class", "customize-contol customize-control-text");
        		boomshakaCustomizerWidthLabel = document.createElement("label");
        		boomshakaCustomizerWidthLabel.appendChild(document.createTextNode("Piece Default Width"));

        		// append the boomshaka items to the container
        		boomshakaCustomizerContentContainer.appendChild(boomshakaCustomizerHeightItem);
        		boomshakaCustomizerContentContainer.appendChild(boomshakaCustomizerWidthItem);

        		// this doesn't work yet.
        		jQuery("#customize-theme-controls ul").append(boomshakaCustomizerContainer);
        		jQuery("#customize-theme-controls ul").append(boomshakaCustomizerTitle);
        		jQuery("#customize-theme-controls ul").append(boomshakaCustomizerContentContainer);
          };
      });
	  },
	  Material: function() { 
	    // initial material design implementation
	    this.content = null;
	    this.device = null;
	    return this;
	  }
	};
};