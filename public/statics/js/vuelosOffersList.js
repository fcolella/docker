$(document).ready(function(){

    $visibleItemsQty    = $('.visibleItemsQty').val();
    $landingType        = $('.landingType').val();

    $url = '/vuelos-box/ajax-offers.php?visibleItemsQty='+$visibleItemsQty+'&landingType='+$landingType;

    $.ajax({
        url: $url,
        dataType: 'json',
        success: function($data){
            $('.offers-list').find('.loading').remove();
            $('.offers-list h3').after($data.list);
        }
    });


});