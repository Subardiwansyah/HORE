/**
 *  Fungsi	: Custom message
 *  Module	: -
 */
function show_message(msg, title, type){
	toastr[type](msg, title)

	toastr.options = {
		"closeButton": true,
		"debug": false,
		"newestOnTop": true,
		"progressBar": true,
		"positionClass": "toast-top-right",
		"preventDuplicates": true,
		"onclick": null,
		"showDuration": 300,
		"hideDuration": 100,
		"timeOut": 5000,
		"extendedTimeOut": 1000,
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}
}

function show_info(msg, title){
	msg = msg || '';
	title = title || 'Info';
	show_message(msg, title, 'info');
}

function show_success(msg, title){
	msg = msg || '';
	title = title || 'Sukses';
	show_message(msg, title, 'success');
}

function show_warning(msg, title){
	msg = msg || '';
	title = title || 'Peringatan';
	show_message(msg, title, 'warning');
}

function show_error(msg, title){
	msg = msg || '';
	title = title || 'Error';
	show_message(msg, title, 'error');
}

// ================================================================================================================================

/**
 *  Fungsi	: Custom binding knockout
 *  Module	: -
 */

/* ko.bindingHandlers.select2 = {
	init: function(element, valueAccessor, allBindingsAccessor) {
		var obj = valueAccessor();
		$(element).select2(obj);

		ko.utils.domNodeDisposal.addDisposeCallback(element, function() {
			$(element).select2('destroy');
		});
	},
	update: function(element) {
		$(element).trigger('change');
	}
}; */

/* ko.bindingHandlers.select2 = {
	after: ["options", "value"],
	init: function (el, valueAccessor, allBindingsAccessor, viewModel) {
		$(el).select2(ko.unwrap(valueAccessor()));
		ko.utils.domNodeDisposal.addDisposeCallback(el, function () {
			$(el).select2('destroy');
		});
	},
	update: function (el, valueAccessor, allBindingsAccessor, viewModel) {
		var allBindings = allBindingsAccessor();
		var select2 = $(el).data("select2");
		if ("value" in allBindings) {
			var newValue = "" + ko.unwrap(allBindings.value);
			if ((allBindings.select2.multiple || el.multiple) && newValue.constructor !== Array) {
				select2.val([newValue.split(",")]);
			}
			else {
				select2.val([newValue]);
			}
		}
	}
}; */

ko.validation.init({
	insertMessages: false,
	decorateElement: true,
	errorElementClass: 'is-invalid',
});

// ================================================================================================================================
/**
 *  Fungsi	: Custom bootbox
 *  Module	: -
 */
 
var show_dialog = function(width, height, title, source, buttons)
{
	bootbox.dialog({
		title: title,
		onEscape: function()
		{
			return false; // true = not action esc for close form
		},
		closeButton: false, // true = show icon close from header, false = hide icon close from header
		message: "<div id='modal_default'></div>",
		buttons: buttons
	});

	$.post(source, {}, function(htm)
	{
		$("#modal_default").html(htm);
	}, "html");
};

var show_dialog_large = function(width, height, title, source, buttons)
{
	bootbox.dialog({
		title: title,
		size: 'large',
		onEscape: function()
		{
			return false; // true = not action esc for close form
		},
		closeButton: false, // true = show icon close from header, false = hide icon close from header
		message: "<div id='modal_large'></div>",
		buttons: buttons
	});

	$.post(source, {}, function(htm)
	{
		$("#modal_large").html(htm);
	}, "html");
};
 
// ================================================================================================================================

$(document).ready(function()
{
	//
});