$(document).ready(function() {
	$(".cantidad").change(function() {
    var cantidad = $(".cantidad").val();
    var valorprod = $('#valor_producto').val();    
    totalpagar(cantidad,valorprod);
  });

  $(function() {
    var id = $('#id_producto').val();
    var route = "/productos/"+id;
    var token = $('#token').val();

    $.ajax({
      url: route,
      headers: {'X-CSRF-TOKEN': token},
      type: "POST",
      data: {id:id},
      success: function(response) {
        $('#valor_producto').val(response['valorproducto']);
        var cantidad = $(".cantidad").val();
        totalpagar(cantidad,response['valorproducto']);
      }
    });
  });

  //Cargar Valor
  $("#id_producto").change(function() {
    var id = $('#id_producto').val();
    var route = "/productos/"+id;
    var token = $('#token').val();

    $.ajax({
      url: route,
      headers: {'X-CSRF-TOKEN': token},
      type: "POST",
      data: {id:id},
      success: function(response) {
        $('#valor_producto').val(response['valorproducto']);
        var cantidad = $(".cantidad").val();
        totalpagar(cantidad,response['valorproducto']);
      }
    });

  })
});

function totalpagar(cantidad, valorprod) {
  var total_pagar = cantidad * valorprod;
  if(isNaN(total_pagar) == false && cantidad !=''){
    if(cantidad >= 2){
      $("#valor_pagar").val(total_pagar);
      $("#text_valor").html('$'+number_format(total_pagar));
      $("#mensaje-request").html('');
      $("#text_valor").fadeIn();
      $(".content_btn_accion").fadeIn();
    }else{
      $("#text_valor").fadeOut();
      $(".content_btn_accion").fadeOut();
      $("#mensaje-request").html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> La cantidad minima de pedido via online es de 2 unidades.</div>");
    }
  }else{
    $("#text_valor").fadeOut();
    $(".content_btn_accion").fadeOut();
    $("#mensaje-request").html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Por favor ingresa un caracter numerico en la Cantidad.</div>");
  }
}


function number_format(amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0) 
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + '.' + '$2');

    return amount_parts.join('.');
}