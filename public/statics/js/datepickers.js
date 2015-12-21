var rangeToPaint= [];

function setDatepickers(form){

    $currentTime = new Date();

    if(form == '#hotel-busqueda' || form == '#form-seguros')
        $currentTime.setDate($currentTime.getDate() + 2);


    $threeHundred = new Date();
    $threeHundred.setDate($currentTime.getDate() + 330);



    if($(form).find('.fecha_desde').length > 0) {


        $(form+' .fecha_desde').datepicker({
            numberOfMonths: 2,
            minDate: $currentTime,
            maxDate: $threeHundred,
            showOn: 'both',
            buttonImage: false,
            buttonImageOnly: false,
            onClose: function () {
                $fechaDesdeMasUno = modifyDate($(form+' .fecha_desde').val(), 1);
                $(form+' .fecha_hasta').datepicker("option", "minDate", $fechaDesdeMasUno);
                $(form+' .fecha_hasta').siblings('.ui-datepicker-trigger').trigger('click');
                setSpecialsDatesRangeTo(form);
                setMouseOverCellDate(form);

                var startDate   = $(form+' .fecha_desde').val();
                var topDate     = $(form+' .fecha_hasta').val();

                if (startDate != '' && topDate != '')
                    setRangeDates(form);

            },
            beforeShowDay: function (date) {

                var startDate   = $(form+' .fecha_desde').val();
                var topDate     = $(form+' .fecha_hasta').val();

                if (startDate != '' && topDate != '') {

                    setRangeDates(form);

                    var datesQty    = rangeToPaint.length;
                    var maxIndex    = datesQty - 1;
                    var day         = date.getDate();
                    var month       = date.getMonth() + 1;
                    var year        = date.getFullYear();

                    day = (day > 9) ? day : '0' + day;
                    month = (month > 9) ? month : '0' + month;

                    var fecha = day + '/' + month + '/' + year;
                    var pos = $.inArray(fecha, rangeToPaint);

                    if (pos >= 0) {
                        if (pos == 0 || pos == maxIndex)
                            return [true, "specialDate leaf"];  // selectable + special + leaf
                        else
                            return [true, "specialDate"];       // selectable + special
                    }
                    else
                        return [true, ''];                      // selectable only
                }

                return [true, ''];
            },
            beforeShow: function () {

                var startDate   = $(form+' .fecha_desde').val();
                var topDate     = $(form+' .fecha_hasta').val();

                if (startDate != '' && topDate != '') {
                    setTimeout(function () {
                        setMouseOverCellDateFrom(form);
                    }, 0);
                }
            }
        });

    }


    if($(form).find('.fecha_hasta').length > 0) {

        $(form+' .fecha_hasta').datepicker({
            numberOfMonths: 2,
            minDate: $currentTime,
            maxDate: $threeHundred,
            showOn: 'both',
            buttonImage: false,
            buttonImageOnly: false,
            onChangeMonthYear: function () {
                setTimeout(function () {
                    setSpecialsDatesRangeTo(form);
                    setMouseOverCellDate(form);
                }, 0);
            },
            onClose: function () {
                var startDate   = $(form+' .fecha_desde').val();
                var topDate     = $(form+' .fecha_hasta').val();

                if (startDate != '' && topDate != '')
                    setRangeDates(form);
            },
            beforeShowDay: function (date) {
                var datesQty    = rangeToPaint.length;
                var maxIndex    = datesQty - 1;
                var day         = date.getDate();
                var month       = date.getMonth() + 1;
                var year        = date.getFullYear();
                day             = (day > 9) ? day : '0' + day;
                month           = (month > 9) ? month : '0' + month;
                var fecha       = day + '/' + month + '/' + year;
                var pos         = $.inArray(fecha, rangeToPaint);

                if (pos >= 0) {
                    if (pos == 0 || pos == maxIndex)
                        return [true, "specialDate leaf"];  // selectable + special + leaf
                    else
                        return [true, "specialDate"];       // selectable + special
                }
                else
                    return [true, ''];                      // selectable only
            },
            beforeShow: function () {
                setTimeout(function () {
                    setSpecialsDatesRangeTo(form);
                    setMouseOverCellDate(form);
                }, 0);
            }
        });

    }

}



function setRangeDates(form){
    var startDate   = $(form+' .fecha_desde').val();
    var topDate     = $(form+' .fecha_hasta').val();
    var currDate    = startDate;
    var dateFound   = false;

    rangeToPaint    = [];
    rangeToPaint.push(startDate);


    // compare startDate with topDate
    var startDateObj, topDateObj, startDatePcs, topDatePcs;
    startDatePcs    = startDate.split('/');
    topDatePcs      = topDate.split('/');
    startDateObj    = new Date();
    topDateObj      = new Date();
    startDateObj.setFullYear(startDatePcs[2], startDatePcs[1]-1, startDatePcs[0]);
    topDateObj.setFullYear(topDatePcs[2], topDatePcs[1]-1, topDatePcs[0]);

    if(startDateObj < topDateObj)
        while(!dateFound) {
            currDate = modifyDate(currDate, 1);
            rangeToPaint.push(currDate);
            if (currDate == topDate)
                dateFound = true;
        }

}






function setSpecialsDatesRangeTo(form){

    var formClass = form.replace(/#/,'');

    // set start
    var startElem = $('td.ui-datepicker-unselectable.ui-state-disabled').has('span').last();


    // set top
    var topElem, topDay, topMonth, topYear;
    $top = $(form+' .fecha_hasta').val();
    if($top == '')
        topElem = $('td.ui-datepicker-days-cell-over').first();
    else
        topElem = $('td.ui-datepicker-current-day').first();

    topDay      = topElem.find('a.ui-state-default').text();
    topMonth    = topElem.attr('data-month');
    topYear     = topElem.attr('data-year');


    // paint range
    paintRangeTo(topDay,topMonth,topYear);


    // paint start
    startElem.addClass('specialDate leaf');


    // paint top
    topElem.addClass('specialDate leaf');

}


function paintRangeTo(topDay, topMonth, topYear){

    var currDay, currMonth, currYear;

    $('td').removeClass('specialDate');
    $('td').removeClass('leaf');
    $('td[data-handler="selectDay"]').each(function(){

        currDay     = $(this).find('a.ui-state-default').text();
        currMonth   = $(this).attr('data-month');
        currYear    = $(this).attr('data-year');

        if(currDay == topDay && currMonth == topMonth && currYear == topYear)
            return false;
        else
            $(this).addClass('specialDate');
    });
}


function setMouseOverCellDate(form){

    $('a.ui-state-default').mouseover(function() {

        var topDay, topMonth, topYear;

        topDay     = $(this).text();
        topMonth   = $(this).parent().attr('data-month');
        topYear    = $(this).parent().attr('data-year');

        paintRangeTo(topDay, topMonth, topYear);

        // paint start
        $('td.ui-datepicker-unselectable.ui-state-disabled').has('span').last().addClass('specialDate leaf');

        // paint top
        $(this).parent().addClass('specialDate leaf');

    });
}





function setMouseOverCellDateFrom(form){

    var formClass   = form.replace(/#/,'');

    var topDateP    = $(form+' .fecha_hasta').val().split('/');
    var topDay      = topDateP[0];
    var topMonth    = topDateP[1]-1;
    var topYear     = topDateP[2];
    var topDateObj  = new Date();
    topDateObj.setFullYear(topYear,topMonth,topDay);


    var startDay, startMonth, startYear;
    var startDateObj = new Date();


    $('a.ui-state-default').mouseover(function() {

        $(this).parent().addClass('specialDate leaf');

        startDay     = $(this).text();
        startMonth   = $(this).parent().attr('data-month');
        startYear    = $(this).parent().attr('data-year');
        startDateObj.setFullYear(startYear,startMonth,startDay);

        if(startDateObj < topDateObj)
            paintRangeFrom(formClass, startDateObj, topDateObj);
        else{
            $('td').removeClass('specialDate');
            $('td').removeClass('leaf');
            $(this).parent().addClass('specialDate leaf');
            $('td[data-month="'+topMonth+'"][data-year="'+topYear+'"] a').filter(function(){return $(this).text() === topDay}).parent().addClass('specialDate leaf');
        }


    });
}


function paintRangeFrom(formClass, startDateObj, topDateObj){

    var currDay, currMonth, currYear;
    var currDateObj = new Date();

    startDateObj.setHours(0,0,0,0);
    topDateObj.setHours(0,0,0,0);

    $(' td[data-handler="selectDay"]').each(function(){

        currDay     = $(this).find('a.ui-state-default').text();
        currMonth   = $(this).attr('data-month');
        currYear    = $(this).attr('data-year');
        currDateObj.setFullYear(currYear,currMonth,currDay);
        currDateObj.setHours(0,0,0,0);


        if(currDateObj < startDateObj){
            $(this).removeClass('specialDate');
            $(this).removeClass('leaf');
            return;
        }

        if(currDateObj <= startDateObj)
            return;


        if(startDateObj < currDateObj && currDateObj < topDateObj){
            $(this).removeClass('leaf');
            $(this).addClass('specialDate');
            return;
        }
        else
            return false;

    });
}


function modifyDate( $dateString, $daysDifference ){
    if ($daysDifference == 0){
        return $dateString;
    }
    $dateSplitted 	= $dateString.split('/');
    $date 			= new Date( $dateSplitted[2], $dateSplitted[1]-1, $dateSplitted[0]  );
    $one_day		= 1000*60*60*24;
    $dateModified   = new Date( $date.getTime() + ($one_day*$daysDifference) );
    $day = $dateModified.getDate();
    if ( $day < 10 )
        $day = '0' + $day;
    $month = $dateModified.getMonth() + 1;
    if ( $month < 10 )
        $month = '0' + $month;
    $year = $dateModified.getFullYear();
    return $day + '/' + $month + '/' + $year;
}



