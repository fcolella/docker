
$(document).ready(function(){
	InsuranceSearchBox.init()
});

//	Object Literal Definition
var InsuranceSearchBox = {
	init: function(settings) {
		InsuranceSearchBox.config = {
			formBase: $('form[name="form-seguros"]'),
			formfileds: {
				origin: $('select[name="origin"]',$(this).formBase),
				destination: $('select[name="destination"]',$(this).formBase),
				dateFrom: $('input[name="dateFrom"]',$(this).formBase),
				dateTo: $('input[name="dateTo"]',$(this).formBase),
				passengers: $('select[name="passengers"]',$(this).formBase)
			}
		}
		//	allow overriding the default config
		$.extend(InsuranceSearchBox.config, settings)
		InsuranceSearchBox.setup()
	},
	setup: function() {
		$.datepicker.setDefaults($.datepicker.regional['es'])
		InsuranceSearchBox.datePicker(InsuranceSearchBox.config.formfileds.dateFrom)
		InsuranceSearchBox.datePicker(InsuranceSearchBox.config.formfileds.dateTo)
		InsuranceSearchBox.passengersConfigure()
		InsuranceSearchBox.validateForm()
		InsuranceSearchBox.config.formBase.find(':button').show()
	},
	datePicker: function(inputField) {
		var newDate = new Date();
		inputField.datepicker({
			duration: 'fast',
			showAnim: '',
			hideIfNoPrevNext: true,
			numberOfMonths: 1,
			firstDay: 0,
			minDate: InsuranceSearchBox.config.formfileds.dateFrom.data('mindate'),
			maxDate: InsuranceSearchBox.config.formfileds.dateTo.data('maxdate'),
			defaultDate: newDate,
			dateFormat: 'dd/mm/yy',
			onSelect: function(selectedDate){
				if ('dateFrom'==this.name) {
					var CheckoutMinDate = InsuranceSearchBox.config.formfileds.dateFrom.datepicker('getDate')
					var checkoutSetDate = InsuranceSearchBox.config.formfileds.dateFrom.datepicker('getDate')
					checkoutSetDate.setDate(checkoutSetDate.getDate()+10)
					InsuranceSearchBox.config.formfileds.dateTo.datepicker('option',{minDate:CheckoutMinDate}).datepicker('setDate', checkoutSetDate)
					var timerId = setTimeout(function(){ clearTimeout(timerId); InsuranceSearchBox.config.formfileds.dateTo.focus() }, 250)
				}

			}
		});
		//
		if ('dateFrom'==inputField.attr('name')) {
			if (""==inputField.val()) {
				inputField.datepicker('option',{defaultDate:newDate}).datepicker('setDate',newDate)
			} else {
				var newDate=inputField.val().split('-'); newDate=new Date(newDate[0], newDate[1]-1, newDate[2]); inputField.datepicker('option',{defaultDate:newDate}).datepicker('setDate',newDate)
			}
		}
		if ('dateTo'==inputField.attr('name')) {
			if ("" == inputField.val()) {
				inputField.datepicker('option',{defaultDate:newDate}).datepicker('setDate',newDate)
			} else {
				var newDate=inputField.val().split('-');newDate=new Date(newDate[0], newDate[1]-1, newDate[2]); inputField.datepicker('option',{defaultDate:newDate}).datepicker('setDate',newDate)
			}
			var dateFromgetDate=InsuranceSearchBox.config.formfileds.dateFrom.datepicker('getDate')
				dateFromgetDate.setDate(dateFromgetDate.getDate()+1)
			inputField.datepicker('option',{minDate:dateFromgetDate})
		}
	},
	passengersConfigure: function () {
		InsuranceSearchBox.config.formfileds.passengers.on('change',function () {
			var total = $(this).children('option').length||0, passengersQty = $(this).val()||0;
			for (var qty = 1; qty < total; qty++) {
				if (qty>passengersQty){
					$('#ages-'+qty).addClass('hidden')
						.find('select').addClass('hidden') // for validator
				} else {
					$('#ages-'+qty).removeClass('hidden')
						.find('select').removeClass('hidden') // for validator
				}
			}
		//	$('.ages-container:gt('+ (passengersQty) +')').addClass('hidden'); $('.ages-container:lt('+ (passengersQty) +')').removeClass('hidden');
		}).trigger('change')
	},
	validateForm: function () {
		validator=InsuranceSearchBox.config.formBase.validate({
			onclick: false,
			onfocusout: false,
			focusCleanup: true,
			focusInvalid: false,
			onkeyup: false,
			errorClass: 'has-warning',
			success: 'has-success',
			ignore: '.hidden',
			rules: {
				origin: 'required',
				destination: 'required',
				dateFrom: 'required',
				dateTo: 'required',
				passengers: 'required'
			//	ages selector by class="required" **/
			},
			showErrors: function(errorMap, errorList) {
				$('div.text-danger').addClass('hidden');
				$.each(errorList,function (i,item) {
					if ($(item.element).hasClass('selectEdades')) {
						$(item.element).parent().parent().find('div.text-danger').removeClass('hidden')
					} else {
						$(item.element).parent().find('div.text-danger').removeClass('hidden')
					}
				});
			},
			submitHandler: function(form,el) {
				validator.currentForm.submit();
			}
		});
	}
};
