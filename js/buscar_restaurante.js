$(document).ready(function() {
    $('.buscar-form').submit(function(e) {
      e.preventDefault();
      $.ajax({
        type: 'GET',
        url: '../php/buscar_restaurantes.php',
        data: $(this).serialize(),
        success: function(response) {
          $('.mostrar_restaurantes').html(response);
        }
      });
    });
  });