$(document).ready(function() {

  //Guarda solicitud de retiro
  $(document).on('click','#confir-upgrade',function(e){
    e.preventDefault();
    e.stopImmediatePropagation();

    var iduserup = $(this).attr('data-iduserup');
    var idrefconup = $(this).attr('data-idrefconup');
    var idfinanzaupsm = $(this).attr('data-idfinanzaupmo');
    var upgradevalor = $('.upgrade_valor').val();
    var validate = false;
    var msj_error = '';
    var token = $('.modal-upgrade-contrato #token').val();

    if(upgradevalor != ''){
      if(validarSiNumero(upgradevalor) === true){
        if(multiplo100(upgradevalor) == true){
          var route = '/upgrade-contrato';
          $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: "POST",
            data: {iduserup,idrefconup,upgradevalor,idfinanzaupsm},
            beforeSend: function() {
              $('#confir-upgrade').attr('disabled', true);
              $('#request-upgrade').html("<div class='alert alert-info' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>Por favor espere un momento.</div>");
            },
            success: function(response) {
              $('#confir-upgrade').attr('disabled', true);
              if(response.envio == true){
                $('#request-upgrade').html("<div class='alert alert-success' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>"+response.mensaje+"</div>");
                //setTimeout('document.location.reload()', 2000);
              }else{
                $('#request-upgrade').html("<div class='alert alert-danger' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>"+response.mensaje+"</div>");
              }
            }
          });
        }else{
          validate = true;
          msj_error = 'El valor de su upgrade debe ser multiplo de 100.';
        }
      }else{
        validate = true;
        msj_error = 'Solo se permiten número enteros positivos.';
      }
    }else{
      validate = true;
      msj_error = 'Por favor ingrese el valor del upgrade.';
    }

    if(validate){
      $("#request-upgrade").fadeIn(1500);
      $("#request-upgrade").html("<div style='margin: 15px 0 5px;' class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>"+ msj_error +"</div>");
    }

  });

  $('#modal-upgrade-contrato').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var idUser = button.attr('data-iduser');
    var idreferidocontrato = button.attr('data-idreferidocontrato');
    var valorInver = button.attr('data-inveractual');
    var idFinanzaup = button.attr('data-idfinanzaup');
    
    var modal = $(this)
    modal.find('.modal-footer #confir-upgrade').attr('data-iduserup', idUser);
    modal.find('.modal-footer #confir-upgrade').attr('data-idrefconup', idreferidocontrato);
    modal.find('.modal-footer #confir-upgrade').attr('data-idfinanzaupmo', idFinanzaup);
  });

  $('.active-modal-soliret').click(function(e){
    $('#modalsoli-retiro').modal('show');
  });

  //Modal Retiros
  $('#modalsoli-retiro').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var modal = $(this)
    event.stopImmediatePropagation();
    var route = '/info-retiro/';
    var html = '';

    $.get(route, function(res){
      if(res.estado){
        modal.find('.modal-body #options-disponibles').empty();
        res.liscontrato.forEach( function(valor) {
          if(res.idsretexis != 0){
            console.log(1);
            //if(res.idsretexis.indexOf(valor.id_finanza) == -1){
              console.log(2);
              html += '<option data-idfinanza="'+valor.id_finanza+'" data-valutil="'+valor.valor_utilidad+'" value="'+valor.id_referidos_contratos+'">'+valor.nombre_contrato+' - '+valor.valor_inversion+' USD / Valor Utilidad: '+valor.valor_utilidad+'</option>';
            //}
          }else{
            html += '<option data-idfinanza="'+valor.id_finanza+'" data-valutil="'+valor.valor_utilidad+'" value="'+valor.id_referidos_contratos+'">'+valor.nombre_contrato+' - '+valor.valor_inversion+' USD / Valor Utilidad: '+valor.valor_utilidad+'</option>';
          }
        });
        modal.find('.modal-body #options-disponibles').html(
          '<select class="retirar_contrato form-control input-custom-app" name="retirar_contrato" id="retirar_contrato">'+
            '<option value="any">Seleccione la referencia del contrato a retirar</option>'+
            html+
          '</select>'
        );
        modal.find('.modal-body p').removeClass('hidden');
        modal.find('.modal-body .valor_soli_retiro').removeClass('hidden');
        modal.find('.modal-footer').removeClass('hidden');
      }else{
        modal.find('.modal-body #options-disponibles').empty();
        modal.find('.modal-body #options-disponibles').html(
          '<div style="margin: 0 0 5px;" class="alert alert-info background-info">'+
            '<strong>Lo sentimos!</strong> Es posible que no tengas contratos activos o su valor de utilidad hasta el momento sea menor a 20 USD. '+
          '</div>'
        );
        modal.find('.modal-body p').addClass('hidden');
        modal.find('.modal-body .valor_soli_retiro').addClass('hidden');
        modal.find('.modal-footer').addClass('hidden');
      }
    });
  });

  //Guarda solicitud de retiro
  $(document).on('click','#confir-soliretiro',function(e){
    e.preventDefault();
    e.stopImmediatePropagation();

    var valorRetiro = $('.valor_soli_retiro').val();
    var iduser = $(this).attr('data-idusersoli');
    var idContratoReferido = $('#retirar_contrato').val();
    var valorUtilidad = $('.retirar_contrato option:selected').attr('data-valutil');
    var idFinanza = $('.retirar_contrato option:selected').attr('data-idfinanza');

    var validate = false;
    var msj_error = '';
    var token = $('#token').val();

    if(valorRetiro != '' && idContratoReferido != 'any'){
      if(validarSiNumero(valorRetiro) === true){
        if(valorRetiro >= 20){
          //if(multiplo100(valorRetiro) == true || valorRetiro == 50){
            if(valorRetiro <= Math.round(valorUtilidad)){
              var route = '/guardar-retiro';
              $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: "POST",
                data: {iduser,valorRetiro,idContratoReferido, idFinanza},
                beforeSend: function() {
                  $('#confir-soliretiro').attr('disabled', true);
                  $('#request-valor_soli_retiro').html("<div class='alert alert-info' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>Por favor espere un momento.</div>");
                },
                success: function(response) {
                  $('#confir-soliretiro').attr('disabled', true);
                  if(response.envio == true){
                    $('#request-valor_soli_retiro').html("<div class='alert alert-success' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>"+response.mensaje+"</div>");
                    setTimeout('document.location.reload()', 2000);
                  }else{
                    $('#confir-soliretiro').attr('disabled', false);
                    $('#request-valor_soli_retiro').html("<div class='alert alert-danger' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>"+response.mensaje+"</div>");
                  }
                }
              });
            }else{
              validate = true;
              msj_error = 'El valor a retirar debe ser menor o igual al valor de la utilidad.';
            }
          // }else{
          //   validate = true;
          //   msj_error = 'Solo se acepta 20 USD como valor minimo de retiro de hay en adelante debe ser multiplo de 100';
          // }
        }else{
          validate = true;
          msj_error = 'El valor de su retiro debe ser igual o mayor a 20 USD.';  
        }
      }else{
        validate = true;
        msj_error = 'Solo se permiten número enteros positivos.';
      }
    }else{
      validate = true;
      msj_error = 'Por favor ingrese el valor de su retiro y contrato de retiro.';
    }

    if(validate){
      $("#request-valor_soli_retiro").fadeIn(1500);
      $("#request-valor_soli_retiro").html("<div style='margin: 15px 0 5px;' class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>"+ msj_error +"</div>");
    }

  });

  if($('.modaldirec-billetera').length > 0){
    $('#modaldirec-billetera').modal({
      backdrop: 'static',
      keyboard: false
    });
  }

  $(document).on('click','#confir-direcBill',function(e){
    var direcBilletera = $('.dire_billetera').val();
    var idUser = $(this).attr('data-iduserbilletera');
    var validate = false;
    var msj_error = '';
    var patt = new RegExp(/^[A-Za-z0-9]+$/);

    if(direcBilletera != ''){
      if(patt.test(direcBilletera) == true){
        var route = '/usuarios/d/'+direcBilletera+'/'+idUser;
        $.get(route, function(res){
          if(res.envio){
            $("#request-direcbillete").html("<div style='margin: 15px 0 5px;' class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Dirección de billetera guardada correctamente.</div>");    
            setTimeout('document.location.reload()', 1500);
          }else{
            validate = true;
            msj_error = 'No se ha podido guardar la dirección de billetera.';
          }
        });
      }else{
        validate = true;
        msj_error = 'Una dirección de billeterea solo tiene número y letras en minusculas o mayusculas y sin espacios.';
      }
    }else{
      validate = true;
      msj_error = 'Por favor ingrese la dirección de billetera.';
    }

    if(validate){
      $("#request-direcbillete").fadeIn(1500);
      $("#request-direcbillete").html("<div style='margin: 15px 0 5px;' class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>"+ msj_error +"</div>");
    }

  });


  $(document).on('click','.item-contrato',function(e){
    e.preventDefault();
    e.stopImmediatePropagation();

    var idContrato = $(this).attr("data-idcontrato");
    console.log(idContrato);
    $('.item-contrato').each(function(i,v){
      if($(v).hasClass('active')){
        $(v).removeClass('active');
        $(this).find('.job-badge').remove();
      }
    });
    $(this).addClass('active');
    $(this).find('.card-header-img').prepend('<div class="job-badge"><label class="label bg-primary">Seleccionado</label></div>');
    $('.contrato-selected').val(idContrato);

  });

  $(document).on('click','.guardar-firma',function(e){
    e.preventDefault();
    e.stopImmediatePropagation();

    var nombreCompleto = $('#nombre-firma').val();
    var numDocu = $('#numdoc-firma').val();
    var idUser = $('#id-user').val();
    var token = $('#token-firma').val();

    var validate = false;
    var validConInv = true;
    var msj_error = '';

    if(nombreCompleto != ''){
      if(numDocu != '' && validarSiNumero(numDocu) === true){
        $.ajax({
          url: '/firma-contato',
          headers: {'X-CSRF-TOKEN': token},
          type: "POST",
          data: {nombreCompleto,numDocu,idUser},
          beforeSend: function() {
            $('.guardar-firma').attr('disabled', true);
            $('.guardar-firma').append('<i style="margin-left: 5px;" class="fa fa-spinner fa-spin"></i>');
          },
          success: function(response) {
            $('.guardar-firma').attr('disabled', true);
            if(response.envio == true){
              $('.msn-firma').html("<div class='alert alert-success' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>"+response.mensaje+"</div>");
              $('#modal-terminos').modal('hide');
              $('#confirmar-pago-modal').modal('show');
              $('.btn-confirmarpago').attr('data-idfirma', response.idFirma);
            }else{
              $('.msn-firma').html("<div class='alert alert-danger' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>"+response.mensaje+"</div>");
            }
          }
        });
        
      }else{
        validate = true;
        msj_error = 'Por favor ingrese el número de documento, debe ser un número';
      }
    }else{
      validate = true;
      msj_error = 'Por favor ingrese el nombre completo';
    }

    if(validate){
      $('.msn-firma').fadeIn(1500);
      $(".msn-firma").html("<div style='margin-bottom: 0;' class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>"+ msj_error +"</div>");
    }

  });

  $(document).on('click','.btn-invertir',function(e){
    e.preventDefault();
    e.stopImmediatePropagation();

    var idUsu = $(this).attr("data-idusuinver");
    var contrato = $('.contrato-selected').val();
    var valorInversion = $('.inversion-valor').val();
    var validate = false;
    var validConInv = true;
    var msj_error = '';

    if(contrato != ''){
      if(valorInversion !=''){
        if(validarSiNumero(valorInversion) === true){

          if(contrato == 1){
            if(multiplo100(valorInversion) === true){
              if(valorInversion > 1000){
                validate = true;
                validConInv = false;
                msj_error = 'El contrato Basic tiene un maximo de 1.000 USD de inversión.';
              }else if(valorInversion == 0){
                validate = true;
                validConInv = false;
                msj_error = 'El contrato Basic tiene un minimo de 100 USD de inversión.';
              }

              if(validConInv){
                $('.mssge-request').fadeOut(1500);
                $('.mssge-request').html('');
                //$('#modal-terminos').modal('show');
                $('#confirmar-pago-modal').modal('show');
              }
            }else{
              validate = true;
              msj_error = 'Solo se permiten números multiplos de 100 para este contrato. Ejemplo: 100,200,300.';
            }
          }else if(contrato == 2){
            if(multiplo100(valorInversion) === true){
              if(valorInversion > 2000){
                validate = true;
                validConInv = false;
                msj_error = 'El contrato Pro tiene un maximo de 2.000 USD de inversión.';
              }else if(valorInversion < 1100){
                validate = true;
                validConInv = false;
                msj_error = 'El contrato Pro tiene un minimo de 1.100 USD de inversión.';
              }

              if(validConInv){
                $('.mssge-request').fadeOut(1500);
                $('.mssge-request').html('');
                //$('#modal-terminos').modal('show');
                $('#confirmar-pago-modal').modal('show');
              }
            }else{
              validate = true;
              msj_error = 'Solo se permiten números multiplos de 100 para este contrato. Ejemplo: 1100,1200,1300.';
            }
          }else{
            if(multiplo1000(valorInversion) === true){
              if(valorInversion > 20000){
                validate = true;
                validConInv = false;
                msj_error = 'El contrato Ultimate tiene un maximo de 20.000 USD de inversión.';
              }else if(valorInversion < 3000){
                validate = true;
                validConInv = false;
                msj_error = 'El contrato Ultimate tiene un minimo de 3.000 USD de inversión.';
              }

              if(validConInv){
                $('.mssge-request').fadeOut(1500);
                $('.mssge-request').html('');
                //$('#modal-terminos').modal('show');
                $('#confirmar-pago-modal').modal('show');
              }
            }else{
              validate = true;
              msj_error = 'Solo se permiten números multiplos de 1000 para este contrato. Ejemplo: 3000,4000,5000.';
            }
          }
        }else{
          validate = true;
          msj_error = 'Solo se permiten números positivos.';
        }
      }else{
        validate = true;
        msj_error = 'Por favor ingrese el valor de su inversión.';
      }
    }else{
      validate = true;
      msj_error = 'Por favor selecione el contrato.';
    }

    if(validate){
      $('.mssge-request').fadeIn(1500);
      $(".mssge-request").html("<div class='alert alert-danger background-danger m-b-20'><button type='button' class='close' data-dismiss='alert' aria-label='Cerrar'><i class='icofont icofont-close-line-circled text-white'></i></button>"+ msj_error +"</div>");
    }

  
  });

  function validarSiNumero(numero){
    var patron = /^\d*$/;
    if (patron.test(numero)) {            
      return true;
    }else {
      return false;
    }
  }

  function multiplo100($valorInver){
    var result = ($valorInver%100);
    if(result == 0){
      return true;
    }else{
      return false;
    }
  }

  function multiplo1000($valorInver){
    var result = ($valorInver%1000);
    if(result == 0){
      return true;
    }else{
      return false;
    }
  }

  //Muestra modal de confirmacion de eliminacion al dar click en boton de eliminar usuario.
  $('.btn-eliminar').click(function(e){
    e.preventDefault();
    var id = $(this).attr("data-ideliminar");
    //Valida cuantos contactos tiene un cliente
    var ruta = location.pathname;
    console.log(ruta);
    if(ruta == '/usuarios'){
      var route = '/usuarios/'+id+'';
      $.get(route, function(res){
        $('#modaleliminar .modal-body p').text('Estas seguro de eliminar este usuario?');
      });
    }
    //Termina validacion de contactos de un cliente

    $('#confirmacion-eliminar').attr('data-idconfieliminar',id);
  });


  var rut2a = location.pathname;
  if(rut2a.indexOf('listado-firmas-contrato') != -1){
    $('#modaleliminar .modal-body > p').remove();
  }

  //Valida que se ingrese la contraseña y posteriormente elimina el usuario confirmado.
  $('#confirmacion-eliminar').click(function(e){
    e.preventDefault();

    var ruta = location.pathname;
    var contrasena = $('#password-confi').val();
    var id = $(this).data("idconfieliminar");
    var tioeCo = "DELETE";

    if(contrasena != ''){
      if(contrasena == '12345'){
        if(ruta.indexOf('usuarios') != -1){
          ruta = '/usuarios';
        }else if(ruta.indexOf('referidos') != -1){
          ruta = '/referidos';
        }else if(ruta.indexOf('retiros') != -1){
          ruta = '/retiros';
        }else if(ruta.indexOf('listado-firmas-contrato') != -1){
          ruta = '/listado-firmas-contrato';
          tioeCo = "POST";
        }
        console.log(ruta);
        var route = ruta+"/"+id;
        var token = $('#token').val();
        
        $.ajax({
          url: route,
          headers: {'X-CSRF-TOKEN': token},
          type: tioeCo,
          data: {id:id},
          beforeSend: function() {
            $('#msg-eliminacion').html("<div class='alert alert-info' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>Por favor espere un momento estamos validando la información ingresada.</div>");
          },
          success: function(response) {
            if(response.borrado == true){
              $('#msg-eliminacion').html("<div class='alert alert-success' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>"+response.mensaje+"</div>");
              setTimeout('document.location.reload()', 1500);
            }else{
              $('#msg-eliminacion').html("<div class='alert alert-danger' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>Algo salio mal en la eliminación.</div>");
            }
          }
        });
      }else{
        $('#msg-eliminacion').html("<div class='alert alert-danger' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>Los digitos ingresados son incorrectos.</div>");        
      }
    }else{
      $('#msg-eliminacion').html("<div class='alert alert-danger' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>Por favor ingresa los digitos para confirmar la eliminación.</div>");
    }
  });

  $('.estado_refPagos').change(function(e){
    e.preventDefault();
    e.stopImmediatePropagation();

    var idConfigPago = $(this).attr('data-idconfpago');
    var estadoUpdate = $(this).val();

    var route = "/estado-confir-pago/";
    var token = $('#token').val();

    $.ajax({
      url: route,
      headers: {'X-CSRF-TOKEN': token},
      type: "POST",
      data: {idConfigPago, estadoUpdate},
      beforeSend: function() {
          $('#estado_refPago_'+idConfigPago).attr('disabled', true);
          $('#estado_refPago_'+idConfigPago).after('<i class="spiner-estado fa fa-spinner fa-spin"></i>');
        },
      success: function(response) {
        $('#estado_refPago_'+idConfigPago).attr('disabled', false);
        $('#estado_refPago_'+idConfigPago).siblings('.fa-spinner.fa-spin').remove();
        if(response.envio){
          if(estadoUpdate == 1){
            $('#estado_refPago_'+idConfigPago).addClass('success-est');
            $('#estado_refPago_'+idConfigPago).removeClass('default-est');
          }else{
            $('#estado_refPago_'+idConfigPago).addClass('default-est');
            $('#estado_refPago_'+idConfigPago).removeClass('default-est');
          }
        }else{
          $('#estado_refPago_'+idConfigPago).addClass('default-est');
        }
      }
    });
  });

  $('.estado_retiCo').change(function(e){
    e.preventDefault();
    e.stopImmediatePropagation();

    var idRetiros = $(this).attr('data-idretiros');
    var estadoUpdate = $(this).val();

    var route = "/estado-update-retiro/";
    var token = $('#token').val();

    $.ajax({
      url: route,
      headers: {'X-CSRF-TOKEN': token},
      type: "POST",
      data: {idRetiros, estadoUpdate},
      beforeSend: function() {
          $('#estado_retiCo_'+idRetiros).attr('disabled', true);
          $('#estado_retiCo_'+idRetiros).after('<i style="right: 6px;" class="spiner-estado fa fa-spinner fa-spin"></i>');
        },
      success: function(response) {
        $('#estado_retiCo_'+idRetiros).attr('disabled', false);
        $('#estado_retiCo_'+idRetiros).siblings('.fa-spinner.fa-spin').remove();
        if(response.envio){
          if(estadoUpdate == 1){
            $('#estado_retiCo_'+idRetiros).addClass('success-est');
            $('#estado_retiCo_'+idRetiros).removeClass('default-est');
          }else{
            $('#estado_retiCo_'+idRetiros).addClass('default-est');
            $('#estado_retiCo_'+idRetiros).removeClass('default-est');
          }
        }else{
          $('#estado_retiCo_'+idRetiros).addClass('default-est');
        }
      }
    });
  });

  $( ".hash_pago" ).click(function() {
    if($(this).val() != '' && $(this).val().length == 64){
      $('.btn-confirmarpago').prop( "disabled", false );
    }else{
      $('.btn-confirmarpago').prop( "disabled", true );
    }
  });

  $( ".hash_pago" ).keyup(function() {
    if($(this).val() != '' && $(this).val().length == 64){
      $('.btn-confirmarpago').prop( "disabled", false );
    }else{
      $('.btn-confirmarpago').prop( "disabled", true );
    }
  });

  $( ".hash_pago" ).keydown(function() {
    if($(this).val() != '' && $(this).val().length == 64){
      $('.btn-confirmarpago').prop( "disabled", false );
    }else{
      $('.btn-confirmarpago').prop( "disabled", true );
    }
  });

  $( ".hash_pago" ).change(function() {
    if($(this).val() != '' && $(this).val().length == 64){
      $('.btn-confirmarpago').prop( "disabled", false );
    }else{
      $('.btn-confirmarpago').prop( "disabled", true );
    }
  });

  function isUrl(s) {
    var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
    return regexp.test(s);
  }

  $('.btn-confirmarpago').click(function(e){
    e.preventDefault();
    e.stopImmediatePropagation();

    var idUser = $(this).attr("data-idusuario");
    //var idFirmaContrato = $(this).attr("data-idfirma");
    var idContrato = $('.contrato-selected').val();
    var valorInversion = $('.inversion-valor').val();

    var hashPago = $('.hash_pago').val();
    
    var route = "/confirmacion-pago/";
    var token = $('#token').val();

    if(hashPago != ''){
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: "POST",
        data: {idUser, idContrato, valorInversion,hashPago},
        beforeSend: function() {
            $('.listado-btn-inver > .text-center .inaler-ocnig').remove();
            $('.btn-confirmarpago').attr('disabled', true);
            $('.btn-confirmarpago').append('<i style="margin-left: 5px;" class="fa fa-spinner fa-spin"></i>');
          },
        success: function(response) {
          if(response.envio){
            $(".response-msg-modal-confi").fadeIn(1500);
            $(".response-msg-modal-confi").html("<div class='alert alert-success background-success m-b-0 m-t-10'>"+response.mensaje+"</div>");
            setTimeout('document.location.reload()', 2500);
          }else{
            $(".btn-confirmarpago > .fa-spinner.fa-spin").remove();
            $(".response-msg-modal-confi").fadeIn(1500);
            $(".response-msg-modal-confi").html("<div class='alert alert-danger background-danger m-b-0 m-t-10'>"+response.mensaje+"</div>");
          }
        }
      });
    }else{
      $(".response-msg-modal-confi").fadeIn(1500);
      $(".response-msg-modal-confi").html("<div class='alert alert-danger background-danger m-b-0 m-t-10' role='alert'>Por favor ingrese un hash de pago valido.</div>");
    }
  });

  /*JS PRESONALIZADOS*/

  $(document).on('click','.ver-balance',function(e){
    var idUser = $(this).attr('data-idusers');
    var route = $(this).attr('data-url');

    $('#verbalances #listado-balances > .row').html('');

    $.get(route, function(res){
      if(res.envio){
        console.log(res.mensaje);
        $.each(res.mensaje, function (i,v){
          $('#verbalances #listado-balances > .row').append(
            `
            <div class="col-md-6">
              <div class="card b-l-success business-info services m-b-20">
                <div class="card-header text-center p-l-10 p-b-10 p-t-10 p-r-10">
                  <div class="service-header">
                    <h3 class="card-header-text">`+v.nombre_contrato+`</h3>
                  </div>
                </div>
                <div class="card-block p-l-10 p-b-15 p-t-10 p-r-10">
                  <div class="row">
                    <div class="col-6 b-r-default m-b-10 text-center">
                      <h5>`+v.valor_utilidad+` USD</h5>
                      <p class="text-muted m-b-10 l-h-13">Valor utilidad</p>
                    </div>
                    <div class="col-6 m-b-10 text-center">
                      <h5>`+v.valor_diario+` USD</h5>
                      <p class="text-muted m-b-10 l-h-13">Valor diario ganado</p>
                    </div>
                    <div class="col-6 b-r-default text-center">
                      <h5>`+v.fecha_acti+`</h5>
                      <p class="text-muted m-b-10 l-h-13">Activación del contrato</p>
                    </div>
                    <div class="col-6 text-center">
                      <h5>`+v.fecha_venc+`</h5>
                      <p class="text-muted m-b-10 l-h-13">Vencimiento del contrato</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            `
          );
        });
      }else{
        $('#verbalances #listado-balances > .row').append(
          `
          <div class="col-md-12">
            <div class="alert alert-info background-info m-b-0">
              `+res.mensaje+`</code>
            </div>
          </div>
          `
        );
      }
    });

  });

});

function copyToClipBoard(){
  /* Get the text field */
  var copyText = document.getElementById("copy-link-ref");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text
  alert("Copiado: " + copyText.value);*/
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

/*
function archivo(evt) {
  var files = evt.target.files; // FileList object

  // Obtenemos la imagen del campo "file".
  for (var i = 0, f; f = files[i]; i++) {
  //Solo admitimos imágenes.
    if (!f.type.match('image.*')) {
    continue;
  }

  var reader = new FileReader();

  reader.onload = (function(theFile) {
    return function(e) {
      // Insertamos la imagen
      document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
    };
  })(f);

  reader.readAsDataURL(f);
  }
}
document.getElementById('files').addEventListener('change', archivo, false);
*/