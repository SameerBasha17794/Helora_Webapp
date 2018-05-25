// Prevent submitting form by clicking "Enter". Form submit only works when clicked on the submit button.
var $=jQuery;
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});