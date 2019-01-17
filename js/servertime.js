$(document).ready(function() {
    function update() {
      $.ajax({
       type: 'POST',
       url: 'inc/servertime.php',
       timeout: 10000,
       success: function(data) {
          $("#timer").html(data); 
          window.setTimeout(update, 1000);
       }
      });
     }
     update();
});
 