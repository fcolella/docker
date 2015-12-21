var destinoAC;

$(document).ready(function(){



    if($('#banner-slide-paquetes').length > 0) {
        $('#banner-slide-paquetes').flexslider({
            animation: "slide",
            start: function (slider) {

                $('#banner-slide-paquetes .flex-viewport').addClass('ui-corner-right');

                $('.loading-form').hide();
                $('.form-busquedas').fadeIn("fast", function () {
                    $('#banner-slide-paquetes img').fadeIn();
                    $('.loaderPkg').fadeIn();
                });
            }
        });
        $('#banner-slide-paquetes .flex-viewport').css('max-height', '353px');
    }
	 
	initChildSelect(0);

    if($('#form-paquetes').length > 0) {




        $('body').keyup(function(ev) {
            if($('#form-paquetes .destinoWrap table').is(':visible')) {
                disableScroll();
                ev.preventDefault();
                ev.stopPropagation();
                if (ev.keyCode == 38) {

                    // up arrow

                    if (!$('ul.ui-autocomplete').is(':visible')) {
                        $('#form-paquetes .destinoWrap table').show();
                        if ($('#form-paquetes .destinoWrap table td.selected').length > 0) {
                            var oldElemTr = $('#form-paquetes .destinoWrap table td.selected').parent();
                            oldElemTr.prev().find('td').addClass('selected');
                            oldElemTr.find('td').removeClass('selected');
                        }
                        else
                            $('#form-paquetes .destinoWrap table td').last().addClass('selected');

                        var valueSel = $('#form-paquetes .destinoWrap table td.selected').text();
                        $('#destino').val(valueSel);
                    }
                }

                if (ev.keyCode == 40) {

                    // down arrow

                    if (!$('ul.ui-autocomplete').is(':visible')) {
                        $('#form-paquetes .destinoWrap table').show();
                        if ($('#form-paquetes .destinoWrap table td.selected').length > 0) {
                            var oldElemTr = $('#form-paquetes .destinoWrap table td.selected').parent();
                            oldElemTr.next().find('td').addClass('selected');
                            oldElemTr.find('td').removeClass('selected');
                        }
                        else
                            $('#form-paquetes .destinoWrap table td').first().addClass('selected');

                        var valueSel = $('#form-paquetes .destinoWrap table td.selected').text();
                        $('#destino').val(valueSel);
                    }
                }

                if (ev.keyCode == 27) {

                    // esc

                    $('#form-paquetes .destinoWrap table').hide();
                    $('#form-paquetes .destinoWrap table td').removeClass('selected');
                    enableScroll();
                }

                if (ev.keyCode == 13) {

                    // enter

                    $destinoCode = $('#form-paquetes .destinoWrap table td.selected').attr('value');
                    $('#form-paquetes .destinoWrap table').hide();
                    $('#form-paquetes #destinoCodSel').val($destinoCode);
                    $('#form-paquetes #periodoViajeSel').val('');

                    enableScroll();
                    getPeriodos();
                }
            }

        });













        // destino

        var agregarBuscarMas = function () {
            return '';
        };
        var buscarMas = function () {
            return '';
        };

        $('#form-paquetes #destino').autocomplete({
            minLength: 3,
            select: function () {

                // rechazamos que busque ciudades cuando se hace un focusout (ya lo busca ni bien se ingresan las 3 letras)
                $(this).blur();

                var value = $(this).val();
                var pieces1 = value.split('(');
                $destinoCode = pieces1[1].substring(0, pieces1[1].length-1);

                $('#form-paquetes #destinoCodSel').val($destinoCode);
                $('#form-paquetes #periodoViajeSel').val('');

                getPeriodos();

                var valueAbbr = ($('.isListado').val() == '1' && value.length > 28) ? value.substring(0, 28) + '...' : value;
                $('#destinoSel').val(value);
                $('#form-paquetes #destino').val(valueAbbr);

                $('#form-paquetes #destino').removeClass('error');
                $('#form-paquetes #error_destino').hide();

            },
            open: function(){
                $('ul.ui-autocomplete li a').unbind('click');
                $('ul.ui-autocomplete li a').click(function () {
                    $('#form-paquetes #destino').val($(this).text());
                    $(this).parents('table').hide();
                    $('#form-paquetes .destinoWrap table').hide();
                    $('#form-paquetes .destinoWrap table td').removeClass('selected');
                    $('#form-paquetes #destino').autocomplete('option', 'select').call($('#form-paquetes #destino'));
                });

                $('ul.ui-autocomplete li a').hover(
                    function(){
                        $('#form-paquetes #destino').val($(this).text());
                        $(this).addClass('selected');
                    },
                    function(){
                        $(this).removeClass('selected');
                    }
                );
            }
        });

        $('#form-paquetes #destino').data('autocomplete')._agregaBuscarMas = agregarBuscarMas;
        $('#form-paquetes #destino').data('autocomplete').buscarMas = buscarMas;


        // origen


        $('#form-paquetes #origen').change(function () {

            $origenCode = $(this).val();

            $('#form-paquetes #origenCodSel').val($origenCode);

            getDestinos(true);

            var value = $(this).find('option:selected').text();
            $('#origenBase').val(value);
            value = ($('.isListado').val() == '1' && value.length > 28) ? value.substring(0, 28) + '...' : value;
            $(this).find('option:selected').text(value);

            $('#form-paquetes #origen').removeClass('error');
            $('#form-paquetes #error_origen').hide();

        });


        $('#form-paquetes #periodoViaje').change(function () {

            $('#form-paquetes #periodoViaje').removeClass('error');
            $('#form-paquetes #error_periodoViaje').hide();

        });

        $('#form-paquetes .sel_ninos').change(function () {

            $(this).removeClass('error');

        });


        $('#form-paquetes .plus_see').click(function () {

            $acomodations = $(this).parent().find('.plus_acomodation');
            $btn = $(this);
            $btn.hide();
            $acomodations.fadeToggle("fast", function () {
                // Animation complete.

                $('#form-paquetes .less_see').fadeToggle();
            });


        });
        $('#form-paquetes .less_see').click(function () {


            $acomodations = $(this).parent().find('.plus_acomodation');
            $btn = $(this);
            $btn.hide();
            $acomodations.fadeToggle("fast", function () {
                // Animation complete.

                $('#form-paquetes .plus_see').fadeToggle();
            });
        });

        $('#form-paquetes .consulta-oferta').click(function () {
            $('.loading').show();
            $('.home').hide();
        });

        // habitaciones
        $('#form-paquetes #select_habitaciones').change(function () {
            $nuevaCantidad = $(this).val();
            $viejaCantidad = $('#form-paquetes .habitacion').size();
            if ($nuevaCantidad > $viejaCantidad) {
                for ($i = $viejaCantidad; $i < $nuevaCantidad; $i++) {
                    $('#form-paquetes .habitacion.first').clone().insertAfter('.habitacion:last');
                    $('#form-paquetes .habitacion:last').removeClass('first').end().addClass('alpha');
                    $('#form-paquetes .habitacion:last').find('.title').text('Hab. ' + ($i + 1) + ':');
                    $('#form-paquetes .habitacion:last').find('.encontrar_edadNinos').hide();
                    $('#form-paquetes .habitacion:last').find('.error_edadmenores').hide();
                    $('#form-paquetes .habitacion:last').find('.adultos').attr('name', 'habitaciones[' + $i + '][adultos]');
                    $('#form-paquetes .habitacion:last').find('.select_menores').attr('id', 'select_menores_' + $i);
                    $('#form-paquetes .habitacion:last').find('.sel_ninos').remove();
                    initChildSelect($i);
                }
            }
            else if ($viejaCantidad > $nuevaCantidad) {
                $i = 1;
                $('#form-paquetes .habitacion').each(function () {
                    if ($i > $nuevaCantidad)
                        $(this).remove();
                    $i++;
                });
            }

        });


        $('#form-paquetes #btn_buscar').click(function () {

            $url = checkFormPaquetes();

            if ($url && $('.isListado').val() == '0')
                window.location = $url;

        });

    }

});


function initChildSelect(nro_hab){
	$('#form-paquetes #select_menores_'+nro_hab).change(function() {
		var cantidadMenores = $(this).find(':selected').val(),
			html = '';
		for (var i=1;i<=cantidadMenores;i++) {
            $adjust = ($('.isListado').val() == '0') ? 'prefix_1' : 'formPkg';
			campo = '<div class="clear margen">&nbsp;</div><div class="grid_2 edad_wrap alpha '+$adjust+'"><label class="grid_1 alpha top">Edad ni&ntilde;o '+i+':</label><select class="sel_ninos grid_1" style="margin-right:5px; margin-bottom:5px" name="habitaciones['+nro_hab+'][menores][]"><option value="">-</option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option></select></div>';
			html += campo;
		}
		var habitacion = $(this).parents('.habitacion');
		if (cantidadMenores>0) {
			$(habitacion).find('.labelKids').show();
			$(habitacion).find('.encontrar_edadNinos div').html(html);
			$(habitacion).find('.encontrar_edadNinos').show();
		}
		else {
			$(habitacion).find('.encontrar_edadNinos').hide();
			$(habitacion).find('.labelKids').hide();
			setTimeout(function() {
				$(habitacion).find('.encontrar_edadNinos div').html('');
			},1000)
		}
	});
}

function verifyChildsAge() {
    var response = true;
    $('#form-paquetes .habitacion').each(function(){
        var checked = true;
        var select_menores = $(this).find('.select_menores');
        if($(select_menores).val() > 0){
            $(this).find('.sel_ninos').each(function(){
                if ($(this).val() == ''){
                    $(this).addClass('error');
                    checked = false;
                }
                else
                    $(this).removeClass('error');
            });
        }
        var mensaje_error = $(this).find('.error_edadmenores');
        if(!checked){
            $(mensaje_error).show();
            response = false;
        }
        else
            $(mensaje_error).hide();
    });
    return response;
}


function checkFormPaquetes(isListado){

    var hasError = false;

    ( $('#form-paquetes #origen').val() == '' ) ? origen = '-' : origen = $('#origen').val();
    ( $('#form-paquetes #destino').val() == '' ) ? destino = '-' : destino = $('#destino').val();


    ( $('#form-paquetes #periodoViaje').val() == '' ) ? periodoViaje = '-' : periodoViaje = $('#periodoViaje').val();
    //( $('#form-paquetes #duracion').val() == '' ) ? duracion = '-' : duracion = $('#duracion').val();
    duracion = '-';

    if(origen == '-'){
        $('#form-paquetes #origen').addClass('error');
        $('#form-paquetes #error_origen').show();
        hasError = true;
    }else{
        $('#form-paquetes #origen').removeClass('error');
        $('#form-paquetes #error_origen').hide();
    }

    if(destino == '-'){
        $('#form-paquetes #destino').addClass('error');
        $('#form-paquetes #error_destino').show();
        hasError = true;
    }else{
        $('#form-paquetes #destino').removeClass('error');
        $('#form-paquetes #error_destino').hide();
    }

    if(!verifyChildsAge())
        hasError = true;
    else
        $('#form-paquetes #edades_menores_select').removeClass('error');


    if($('#form-paquetes #periodoViaje').val() == ''){
        $('#form-paquetes #periodoViaje').addClass('error');
        $('#form-paquetes #error_periodoViaje').show();
        hasError = true;
    }else{
        $('#form-paquetes #periodoViaje').removeClass('error');
        $('#form-paquetes #error_periodoViaje').hide();
    }


    // habitaciones
    occupation = [];
    $('#form-paquetes .habitacion').each(function(){
        adults = $(this).find('.adultos').val();
        chdQty = $(this).find('.select_menores').val();
        if(chdQty > 0){
            chdAges = [];
            $(this).find('.encontrar_edadNinos .edad_wrap').each(function(){
                chdAges.push($(this).find('.sel_ninos').val());
            });
            chdAges = chdAges.join('-');
        }
        room = adults + ((chdQty > 0) ? '-'+chdAges :'');

        occupation.push(room);
    });

    occupation = occupation.join('_');


    if (hasError != true){

        $origen     = $('#form-paquetes #origen').val();
        $destino    = $('#form-paquetes #destinoCodSel').val();

        if(isListado)
            uri = $origen + '/' + $destino + '/' + periodoViaje + '/' + duracion + '/' + occupation + '/1';
        else
            uri = '/paquetes/'+ $origen + '/' + $destino +'/'+ periodoViaje + '/' + duracion + '/' + occupation;
        return uri;

    }
    return null;
}


function getDestinos(changed){


    var accentMap = {
        "Ã¡": "a",
        "Ã©": "e",
        "Ã­": "i",
        "Ã³": "o",
        "Ãº": "u"
    };
    var normalize = function( term ) {
        var ret = "";
        for ( var i = 0; i < term.length; i++ ) {
            ret += accentMap[ term.charAt(i) ] || term.charAt(i);
        }
        return ret;
    };


    $originCode = $('#form-paquetes #origenCodSel').val();

    if($originCode != '') {

        $.getJSON('/paquetes_ajax.php?f=getDestinos&origen=' + $('#form-paquetes #origen').val(), function (res) {

            var ciudades_mas_buscadas = new Array();

            $htmlTable = '<table class="grid_4 alpha" style="display: none; position: absolute;top:62px;">';

            $.each(res, function (index, val) {
                ciudades_mas_buscadas.push(val);
                $htmlTable += '<tr><td value="' + index + '">' + val + '</td></tr>';
            });

            $htmlTable += '</table>';


            $('#form-paquetes #destino').autocomplete('option', 'source', function(request,response){
                var matcher = new RegExp( $.ui.autocomplete.escapeRegex( request.term ), "i" );
                response( $.grep( ciudades_mas_buscadas, function( value ) {
                    value = value.label || value.value || value;
                    return matcher.test( value ) || matcher.test( normalize( value ) );
                }));
            });

            $('#form-paquetes #destino').removeAttr('disabled');
            if (changed)
                $('#form-paquetes #destino').val('');

            $('#form-paquetes .destinoWrap').find('table').remove();
            $('#form-paquetes .destinoWrap').append($htmlTable);

            $('#form-paquetes .suggest-icons').unbind('click');
            $('#form-paquetes .suggest-icons').click(function (ev) {
                ev.preventDefault();
                ev.stopPropagation();
                if(!$('ul.ui-autocomplete').is(':visible')) {
                    var table = $(this).siblings('table');
                    if ($(table).is(':visible')) {
                        $(table).hide();
                        $(table).find('td').removeClass('selected');
                    }
                    else
                        $(table).show();
                }
            });


            $('#form-paquetes .destinoWrap table td').hover(
                function(){
                    $(this).addClass('selected');
                },
                function(){
                    $(this).removeClass('selected');
                }
            );


            $('body').click(function (ev) {
                var target = $(ev.target);
                if (!target.is('.suggest-icons') && !target.is('#form-paquetes .destinoWrap table'))
                    $('#form-paquetes .destinoWrap table').hide();
            });

            $('body').keypress(function(ev){

                if (ev.keyCode == 13) {
                    // enter
                    var target = $(ev.target);
                    if (target.is('#form-paquetes #destino')) {
                        ev.preventDefault();
                        $('#form-paquetes .destinoWrap table').hide();
                        $('#form-paquetes .destinoWrap table td').removeClass('selected');
                        $('#form-paquetes #destino').autocomplete('option', 'select').call($('#form-paquetes #destino'));
                    }
                    else{

                        $url = checkFormPaquetes();

                        if ($url && $('.isListado').val() == '0')
                            window.location = $url;
                    }
                }

            });


            $('#form-paquetes .destinoWrap table td').click(function () {
                $('#form-paquetes #destino').val($(this).text());
                $(this).parents('table').hide();
                $('#form-paquetes .destinoWrap table').hide();
                $('#form-paquetes .destinoWrap table td').removeClass('selected');
                $('#form-paquetes #destino').autocomplete('option', 'select').call($('#form-paquetes #destino'));
            });


        });
    }
    else{
        $('#form-paquetes #destino').attr('disabled', 'disabled');
        $('#form-paquetes #destino').val('');

        $('#form-paquetes #periodoViaje').attr('disabled', 'disabled').html('<option>-</option>').removeClass('error');
        $('#form-paquetes #error_periodoViaje').hide();
    }


}


function getPeriodos(){

    $.getJSON('/paquetes_ajax.php?f=getPeriodos&origen='+ $('#form-paquetes #origen').val()+'&destino='+$('#form-paquetes #destinoCodSel').val(), function(res){

        $periodoViajeSel = $('#form-paquetes #periodoViajeSel').val();
        $reset = ($periodoViajeSel == '') ? 'selected="selected"' : '';

        var options = $("#form-paquetes #periodoViaje");
        options.removeAttr("disabled");
        options.empty();
        options.append($('<option value="" '+$reset+'>-</option>'));

        $.each(res, function(index, val) {
            $isSelected = (index == $periodoViajeSel) ? 'selected="selected"' : '';
            options.append($('<option '+$isSelected+'></option>').attr("value", index).text(val));
        });

        options.focus();
        options.select();

    });

}


var keys = {37: 1, 38: 1, 39: 1, 40: 1};

function preventDefault(e) {
    e = e || window.event;
    if (e.preventDefault)
        e.preventDefault();
    e.returnValue = false;
}

function preventDefaultForScrollKeys(e) {
    if (keys[e.keyCode]) {
        preventDefault(e);
        return false;
    }
}

function disableScroll() {
    if (window.addEventListener) // older FF
        window.addEventListener('DOMMouseScroll', preventDefault, false);
    window.onwheel = preventDefault; // modern standard
    window.onmousewheel = document.onmousewheel = preventDefault; // older browsers, IE
    window.ontouchmove  = preventDefault; // mobile
    document.onkeydown  = preventDefaultForScrollKeys;
}

function enableScroll() {
    if (window.removeEventListener)
        window.removeEventListener('DOMMouseScroll', preventDefault, false);
    window.onmousewheel = document.onmousewheel = null;
    window.onwheel = null;
    window.ontouchmove = null;
    document.onkeydown = null;
}