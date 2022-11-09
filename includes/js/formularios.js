
 function encodeImagetoBase64(element) {

	  var file = element.files[0];

	  var reader = new FileReader();

	  reader.onloadend = function() {

	    redimensionar(reader.result,300,file.type,function(url){

		    $(".imgForm").css('background-image','url('+url+')');

		    $(".imgForm").html(" ");

		    $("input[name='foto']").val(url);
	    });

	  }

	  reader.readAsDataURL(file);

	}


	function redimensionar(dataUrl, newWidth, imageType,callback) {
	    "use strict";
	    var image, oldWidth, oldHeight, newHeight, canvas, ctx, newDataUrl;
	
	    // Create a temporary image so that we can compute the height of the downscaled image.
	    image = new Image();
	    image.src = dataUrl;
	    image.onload = function () {
		    oldWidth = image.width;
		    oldHeight = image.height;
		    newHeight = Math.floor(oldHeight / oldWidth * newWidth);
		    // Create a temporary canvas to draw the downscaled image on.
		    canvas = document.createElement("canvas");
		    canvas.width = newWidth;
		    canvas.height = newHeight;
		    // Draw the downscaled image on the canvas and return the new data URL.
		    ctx = canvas.getContext("2d");
		    ctx.drawImage(image, 0, 0, newWidth, newHeight);
		    newDataUrl = canvas.toDataURL(imageType, 0.7);
		    callback(newDataUrl);
		}
}



$(function() {



$('select').chosen({disable_search_threshold: 5});





});