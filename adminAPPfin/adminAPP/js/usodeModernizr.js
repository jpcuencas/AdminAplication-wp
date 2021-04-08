function compatibilidadFormularios(form)
{
	// obtiene el form y sus elementos input
	//if(document.forms[0]!=null)
	//{
		//var form = document.forms[0],inputs = form.elements;
	//}
	var inputs = form.elements;
	// Si no soporta autofocus, pone el foco en el primer campo
	///////compatibilidad con auto focus//////
	if (!Modernizr.input.autofocus) {
		inputs[0].focus();
	}
	////////////////////////////////////////
	///////compatibilidad con required//////
	// obtiene el form y sus elementos input
	//var form = document.forms[0],
	//inputs = form.elements;
	
	// Si no soporta required, lo emula
	if (!Modernizr.input.required) {
		form.onsubmit = function() {
			var required = [], att, val;
			// ciclo con el cual se busca la propiedad required
			for (var i = 0; i < inputs.length; i++) 
			{
				att = inputs[i].getAttribute('required');
				// si se encuentra required, obtiene el valor del campo y elimina los espacios en blanco
				if (att != null) 
				{
					val = inputs[i].value;
					// Si el campo esta vacio, lo agrega al arreglo required
					if (val.replace(/^\s+|\s+$/g, '') == '') 
					{
						required.push(inputs[i].name);
					}
				}
			}
			// muestra una alerta si el arreglo required contiene algun elemento
			if (required.length > 0) 
			{
				alert('Los siguientes campos son requeridos: ' +
				required.join(', '));
				// previene que se envie el form
				return false;
			}
		};
	}
	////////compatibilidad con input type number//////////////
		var initSpinner = function() {         
			$('input[type=number]').each(function() {
				var $input = $(this);
				$input.spinner({
					min: $input.attr('min'),
					max: $input.attr('max'),
					step: $input.attr('step')
				});
				if(isNaN($input.val()))$input.val(0)
			});
		};
		 
		if(!Modernizr.inputtypes.number){
			$(document).ready(initSpinner);
		};
	////////////////////////////////
	//////////Compatibilidad datepiker//////////
	var initDatepicker = function() {
		$('input[type=date]').each(function() {
			var $input = $(this);
			$input.datepicker({
				minDate: $input.attr('min'),
				maxDate: $input.attr('max'),
				dateFormat: 'yy-mm-dd'
			});
		});
	};
	 
	if(!Modernizr.inputtypes.date){
		$(document).ready(initDatepicker);
	};
	////////////////////////////////
	/////////compatibilidad con color//////
	var initColorpicker = function() {
		$('input[type=color]').each(function() {
			var $input = $(this);
			$input.ColorPicker({
				onSubmit: function(hsb, hex, rgb, el) {
					$(el).val(hex);
					$(el).ColorPickerHide();
				}
			});
		});        
	};
	 
	if(!Modernizr.inputtypes.color){
		$(document).ready(initColorpicker);
	};
	////////////////////////
	//////////compatibilidad con placeholder
	var initPlaceholder = function() {
		$('input[placeholder]').placehold();
	};
	 
	if(!Modernizr.input.placeholder){
		$(document).ready(initPlaceholder);
	};
	$("#"+document.forms[0].id).validate();
}