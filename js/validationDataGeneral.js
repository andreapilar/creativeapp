
	// validacion para tipos de texto, si es false el borde bottom se vuelve rojo y devuelve tru o false segun el csao,
	// los parametros son la clase del input y la cantidad mxima de letras y la leyenda es lo que va adecir si es error
	var numeros="0123456789";
	var MessageError="Error en la validacion del campo";

	//Inicialización de métodos
	validationNumberCLI();
	validationNumberNIT();
	regex_validations();

	function remover_clase(index,clase){
		$(index).removeClass(clase)
	}

	function asignar_clase(index,clase){
		$(index).addClass(clase)
	}

	function validateTextAllText(text_input, lengh_max, leyenda = MessageError) {

		var text=$("." + text_input).val();
		if(text==null  || text.length==0 || /[¿!"#$%&/()=?¡'{}_+´´*;:., ']/.test(text)){
			//llamamos la alerta para poner los bordes rojos y en ella llama la funcion para generar la alerta segun la leyenda escrita
			validationErrorInput('Solo debe permitir letras, A - Z sin espacios', leyenda);
			return false;
		}else if (text.length>lengh_max) {
			validationErrorInput('No superar ' + lengh_max + ' caracteres', leyenda);
			return false;
		}else if(isNaN(text)==false){
			validationErrorInput('No admite numeros', leyenda)
			return false;
		} else{
			for(i=0; i<text.length; i++){
				if (numeros.indexOf(text.charAt(i),0)!=-1){
					validationErrorInput('No admite numeros', leyenda);
					return false;
				}
			}
			//llamamos la funcion para eliminar los bordes rojos
			validateSuccess(leyenda);
			return true;
		}
	}

	function validateText(text_input, lengh_max, leyenda = MessageError) {

		var text = $("." + text_input).val();
		if(text == null || text.length === 0 || /[¿!"#$%&/()=?¡'{}+´´*;:.,']/.test(text)){
			validationErrorInput(leyenda, text_input);
			return false;
		}
		else if (text.length > lengh_max) {
			validationErrorInput('No superar ' + lengh_max + ' caracteres', text_input);
			return false;
		}
		else{
			validateSuccess(text_input);
			return true;
		}
	}

	function validateDateTime(text_input, lengh_max, leyenda = MessageError){
		var texto=text_input.split(' '),
			fecha=texto[0],
			hora=texto[1];
		if (validateDate(fecha,leyenda)==false || validate_time(hora,leyenda)==false){validationMessageError(leyenda);return false;}

		return true;
	}

	function validateDate(text_input, leyenda = MessageError){
		var texto=new Date(text_input);
		if (texto=="Invalid Date"){return false;}
		return true;
	}

	function validateTextString(text_input, lengh_max = 50, leyenda = MessageError) {

		if(text_input == null  || text_input.length == 0 ){
			validationMessageError(leyenda);
			return false;
		}
		else if (text_input.length > lengh_max) {
			validationMessageError('No superar ' + lengh_max + ' caracteres');
			return false;
		}
		return true;
	}

	function validateDateTimeRange(Fecha_ini, Fecha_fina, leyenda = MessageError) {

		var fecha_inicial_split=Fecha_ini.split(' '),
			fecha_final_split=Fecha_fina.split(' '),
			hora_inicio=fecha_inicial_split[1],
			hora_final=fecha_final_split[1],
			Fecha_ini= new Date(Fecha_ini),
			Fecha_fina= new Date(Fecha_fina);

		// Comparamos solo las fechas => no las horas!!
		if (Fecha_ini > Fecha_fina) {
			validationMessageWarning(leyenda);
			return false;
		}else if (fecha_inicial_split[0] == fecha_final_split[0]){

			return validate_time_diferent(hora_inicio,hora_final,'La hora inicial no puede ser mayor a la final cuando las fechas son el mismo dia');
		}else{
			return true;
		}
	}

	function validatePassword(text_input, lengh_max, leyenda = MessageError) {
		text=$("." + text_input).val();
		// set password variable
		//validate the length
		if ( text.length < 8 ) {
			validationErrorInput('La contraseña debería tener <strong>8 carácteres</strong> como mínimo', text_input);
			return false;
		}
		else{
			//llamamos la funcion para eliminar los bordes rojos como parametro el identificador de clase
			validateSuccess(text_input);
			return true;
		}
		/*if ( text.match(/[A-z]/)==false) {
			validationErrorInput('La contraseña al menos debería tener <strong>una letra</strong>', text_input);
			return false;
		}*/

		/*if ( text.match(/\d/)==false) {
			validationErrorInput('La contraseña al menos debería tener <strong>un número</strong>', text_input);
			return false;
		}*/
	}

	function validateFullString(text_input, lengh_max, leyenda = null) {

		text = $("." + text_input).val();

		if (text.length > lengh_max){
			validationErrorInput(`No debe superar los ${lengh_max} caracteres.`, text_input);
			return false;
		}
		else if ( text.match(/[A-z]/) === false) {
			validationErrorInput(leyenda, text_input);
			return false;
		}
		else if( text.match(/\d/) === false) {
			validationErrorInput(leyenda, text_input);
			return false;
		}
		else {
			validateSuccess(text_input);
			return true;
		}
	}

	function validateSomePasswords(element_pass, element_pass_repeat) {

		//Obtenemos los valores de los elementos recibidos
		let val_password = $('.'+element_pass).val();
		let val_password_repeat = $('.'+element_pass_repeat).val();

		//Validamos si son iguales
		if (val_password === val_password_repeat){
			validateSuccess(element_pass);
			validateSuccess(element_pass_repeat);
			return true;
		}
		else{
			validationErrorInput(null, element_pass);
			validationErrorInput('Las contraseñas no coinciden.', element_pass_repeat);

			return false;
		}
	}

	function validate_time(valor, leyenda = MessageError) {

		if(valor.indexOf(":") != -1) {

			const hora = valor.split(":")[0];
			const minuto = valor.split(":")[1];

			if(parseInt(hora) > 23 ) {
				validationMessageError(leyenda);
				return false;
			}

			if(parseInt(minuto) > 59 ) {
				validationMessageError(leyenda);
				return false;
			}
		}
		else{
			validationMessageError(leyenda);
			return false;
		}
		return true;
	}

	function validate_time_chatbot(valor, leyenda = MessageError, element) {

		if(valor.indexOf(":") != -1) {

			const hora = valor.split(":")[0];
			const minuto = valor.split(":")[1];

			if(parseInt(hora) > 23 ) {
				element.addClass('border border-danger');
				return false;
			}

			if(parseInt(minuto) > 59 ) {
				element.addClass('border border-danger');
				return false;
			}
			element.removeClass('border border-danger');
			return true;
		}
		element.addClass('border border-danger');
		return false;
	}

	function countRepeatPointCharacter(string){
		var regularExpression = new RegExp("[^.]","g");
		var numberRepetitions = string.replace(regularExpression, "").length;
		return numberRepetitions;
	}

	function validateDecimal(num){
		var numberRepetitions = countRepeatPointCharacter(num);
		var numberPositionPointCharacter = num.indexOf('.');
		var validateValue = true;
		if (num.length > 21){
			validateValue = false;
		}
		else if (numberRepetitions >1){
			validationMessageWarning('El precio del producto sólo debe tener un punto (.) decimal.', 3500);
			validateValue = false;
		}
		else if (isNaN(num)) {
			validationMessageWarning('El precio del producto debe ser un número válido.', 3500);
			validateValue = false;
		}
		else if ((numberPositionPointCharacter > 16) || (num.length > 16 && num.indexOf('.') == -1)){
			validationMessageWarning('Sólo se permiten (16) números enteros.', 3500);
			validateValue = false;
		}
		return validateValue;
	}

	function validate_time_diferent(inicial,final, leyenda = MessageError) {

		let inicial1=inicial.split(":"),
			final1=final.split(":"),
			hora_inicial=inicial1[0],
			hora_final=final1[0],
			minuto_inicial=inicial1[1],
			minuto_final=final1[1];
		if (hora_inicial==hora_final && minuto_inicial==minuto_final){
			validationMessageWarning('Las Horas no pueden ser iguales');
			return false;
		}else
		if (hora_inicial>hora_final){
			validationMessageWarning(leyenda);
			return false;
		}else if(minuto_inicial>minuto_final && hora_inicial==hora_final ){
			validationMessageWarning(leyenda);
			return false;
		}else{
			return true;
		}
	}

	function validateSelect(text_input, lengh_max = null, leyenda = MessageError, selec= '') {

		let text = $("." + text_input).val();

		if(text === 'Selecciona' || text === ''){
			validationErrorInput(leyenda, text_input);
			return false;
		}
		validateSuccess(text_input);
		return true;
	}

	function validateSelectString(text_input, lengh_max, leyenda = MessageError, selec='Selecciona') {
		var text = text_input;
		if(text == selec){
			validationMessageError(leyenda);
			return false;
		}
		return true;
	}

	function validateRangeInt(inicio, final, valor, leyenda) {
		if (valor < inicio || valor > final){
			validationMessageWarning(leyenda)
			return false;
		}else{return true;}
	}

	function validateInt(text_input, lengh_max, leyenda = MessageError) {

		var text = $("." + text_input).val();

		if(text == null || text.length === 0 || /^\s+$/.test(text) || text < 0){
			validationErrorInput(leyenda, text_input);
			return false;
		}
		else if (text === '0') {
			validationErrorInput('Debe ingresar un valor diferente de 0.', text_input);
			return false;
		}
		else if (text.length > lengh_max) {
			validationErrorInput('No superar ' + lengh_max + ' caracteres', text_input);
			return false;
		}
		else if (isNaN(text)) {
			validationErrorInput('El campo debe contener sólo numeros.', text_input);
			return false;
		}
		else{
			validateSuccess(text_input);
			return true;
		}
	}

	function validateIntString(text_input, lengh_max, leyenda = MessageError) {

		var text=text_input;
		if(text==null  || text.length==0 || /^\s+$/.test(text) || text<0){
			validationMessageError(leyenda);
			return false;
		}
		else if (text.length>lengh_max) {
			validationMessageError('No superar ' + lengh_max + ' caracteres');
			return false;
		}
		else if (isNaN(text)) {
			validationMessageError('El campo debe conteneder solo numeros');
			return false;
		}
		else{
			return true;
		}
	}

	function validateMail(text_input,leyenda = MessageError){
		text=$("." + text_input).val();
		if (text.search(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/)){
			validationErrorInput(leyenda, text_input);
			return false;
		} else {
			validateSuccess(text_input);
			return true;
		}
	}

	function validationErrorInput(leyenda = "Error en la validacion", text_input) {
		$("." + text_input).css({'border-bottom' : '2px solid red'});
		$("." + text_input).focus();

		if (leyenda !== null) validationMessageError(leyenda, 4000);
	}

	function validationMessageError(leyenda = 'Accion Fallida', time = 4000) {
		if ($('body .alert-danger').length === 0){
			$.notify({
				icon: "",
				message: leyenda
			},{
				type: 'danger',
				timer: 4000,
				placement: {
					from: 'top',
					align: 'right'
				},
				z_index: 9000
			});

			setTimeout(function () {
				$('body .alert-danger').hide('slow', function(){ $('body .alert-danger').remove(); });
			}, 2500);
		}
	}

	function validationMessageSuccess(leyenda = 'Accion Realizada', time = 4000) {
		if ($('body .alert-success').length === 0){
			$.notify({
				icon: "check_circle",
				message: leyenda
			},{
				type: 'success',
				timer: time,
				placement: {
					from: 'top',
					align: 'right'
				},
				z_index: 9000
			});
		}

		setTimeout(function () {
			$('body .alert-success').hide('slow', function(){ $('body .alert-success').remove(); });
		}, 4000);
	}

	function validationMessageWarning(leyenda = 'Accion Realizada', time = 4000) {
		if ($('body .alert-warning').length === 0){
			$.notify({
				icon: "warning",
				message: leyenda
			},{
				type: 'warning',
				timer: time,
				placement: {
					from: 'top',
					align: 'right'
				},
				z_index: 9000
			});
		}

		setTimeout(function () {
			$('body .alert-warning').hide('slow', function(){ $('body .alert-warning').remove(); });
		}, 4000);
	}

	function validateSuccess(text_input) {
		$("." + text_input).css({'border-bottom':'2px solid transparent'});
	}

	function focusInputIndex0(index) {
		$(index).focus();
	}

	setTimeout(function () {
		$('body .alert-warning').hide('slow', function(){ $('body .alert-warning').remove(); });
	}, 4000);

	function validateSuccess(text_input) {
		$("." + text_input).css({'border-bottom':'2px solid transparent'});
	}

	function focusInputIndex0(index) {
		$(index).focus();
	}

	function updateNumR(numero) {
		$('.card-body h2').html(numero);
	}

	function number_format_js(number, decimals, dec_point, thousands_point) {

		if (number == null || !isFinite(number)) {
			throw new TypeError("number is not valid");
		}

		if (!decimals) {
			var len = number.toString().split('.').length;
			decimals = len > 1 ? len : 0;
		}

		if (!dec_point) {
			dec_point = '.';
		}

		if (!thousands_point) {
			thousands_point = ',';
		}

		number = parseFloat(number).toFixed(decimals);

		number = number.replace(".", dec_point);

		var splitNum = number.split(dec_point);
		splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
		number = splitNum.join(dec_point);

		return number;
	}

	function numberFormatNoApproximationJs(valueBalanceAfiliate){

		//We capture the 'value of the affiliate' in a variable to facilitate access to it
		var valueBalance = valueBalanceAfiliate;
		//Formatting the value, we show 4 decimals, separate the decimals with (,) and separate with space the units of a thousand
		valueBalance = number_format_js(valueBalance,2,'.',',');
		//We obtain and save the last 4 characters of the received value as parameter
		var correctDecimals = valueBalanceAfiliate.substr(valueBalanceAfiliate.length-2);
		//We obtain and save the last 5 characters of the formatted value, also obtaining the comma (,) that separates the decimals
		var decimalsToEliminate = valueBalance.substr(valueBalance.length-3);
		//We search and delete the last 5 characters obtained to leave only the whole part of the value
		var valueWithoutDecimals = valueBalance.replace(decimalsToEliminate,'');
		//The value of integers is concatenated with decimals of the original value
		var formattedValue = valueWithoutDecimals+'.'+correctDecimals;
		//We return the formatted value of the member's obligation and with the correct decimals
		return formattedValue;
	}

	function addOrRemoveDecimalsToAffiliateValue(valueBalanceAffiliate){
		//We obtain and save the total balance of the affiliate
		var valueBalance = valueBalanceAffiliate;
		//We obtain the position in which the last point is found (.)
		var positionCharacterLastPoint = valueBalance.lastIndexOf('.');
		//We get the last 4 characters of the value, which are the decimals
		var lastFourChararcters = valueBalance.substr(positionCharacterLastPoint+1,4);

		//Initialize variable that will contain the definitive value
		var formattedValue ='';
		//We evaluate if the different decimals of the number end in '0000', '000', '00' or '0'; and hide them respectively
		if (lastFourChararcters === '0000'){
			//We format the value and we do not show decimals
			formattedValue = number_format_js(valueBalance,2,'.',',');
			//We search and delete the last 3 characters to delete the comma (,) and the zeros (00) that are added by default (, 00)
			//formattedValue = formattedValue.replace(formattedValue.substr(-3),'');
		}
		else if (lastFourChararcters.substr(-3) === '000'){
			//We format the value and we do show one decimal
			formattedValue = number_format_js(valueBalance,2,'.',',');
		}
		else if (lastFourChararcters.substr(-2) === '00'){
			//We format the value and we do show two decimals
			formattedValue = number_format_js(valueBalance,2,'.',',');
		}
		else if (lastFourChararcters.substr(-1) === '0'){
			//We format the value and we do show three decimals
			formattedValue = number_format_js(valueBalance,2,'.',',');
		}
		else{
			//We save the formatted value that returns the method that takes away the approximation
			formattedValue = numberFormatNoApproximationJs(valueBalance);
			// formattedValue = valueBalanceAffiliate + '.00';
		}
		//We return the value with or without decimals
		return formattedValue;
	}



	<!-- javascript for detroying the Perfect Scrollbar -->


	// function addOrRemoveDecimalsToeValue(valueBalanceAffiliate){
	// console.log('el numero ' + valueBalanceAffiliate + ' es un numero entero= ' + Number.isInteger(valueBalanceAffiliate));
	//
	// 	if (!decimals) {
	// 		var len = number.toString().split('.').length;
	// 		decimals = len > 1 ? len : 0;
	// 	}
	//
	// 	if (!dec_point) {
	// 		dec_point = '.';
	// 	}
	//
	// 	if (!thousands_point) {
	// 		thousands_point = ',';
	// 	}
	//
	// 	number = parseFloat(number).toFixed(decimals);
	//
	// 	number = number.replace(".", dec_point);
	//
	// 	var splitNum = number.split(dec_point);
	// 	splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
	// 	number = splitNum.join(dec_point);
	//
	// 	return number;
	// }

	function numberFormatNoApproximationJs(valueBalanceAfiliate){

		//We capture the 'value of the affiliate' in a variable to facilitate access to it
		var valueBalance = valueBalanceAfiliate;
		//Formatting the value, we show 4 decimals, separate the decimals with (,) and separate with space the units of a thousand
		valueBalance = number_format_js(valueBalance,2,'.',',');
		//We obtain and save the last 4 characters of the received value as parameter
		var correctDecimals = valueBalanceAfiliate.substr(valueBalanceAfiliate.length-2);
		//We obtain and save the last 5 characters of the formatted value, also obtaining the comma (,) that separates the decimals
		var decimalsToEliminate = valueBalance.substr(valueBalance.length-3);
		//We search and delete the last 5 characters obtained to leave only the whole part of the value
		var valueWithoutDecimals = valueBalance.replace(decimalsToEliminate,'');
		//The value of integers is concatenated with decimals of the original value
		var formattedValue = valueWithoutDecimals+'.'+correctDecimals;
		//We return the formatted value of the member's obligation and with the correct decimals
		return formattedValue;
	}

	function addOrRemoveDecimalsToAffiliateValue(valueBalanceAffiliate){
		// console.log(valueBalanceAffiliate);
		//We obtain and save the total balance of the affiliate
		var valueBalance = valueBalanceAffiliate;
		//We obtain the position in which the last point is found (.)
		var positionCharacterLastPoint = valueBalance.lastIndexOf('.');
		//We get the last 4 characters of the value, which are the decimals
		var lastFourChararcters = valueBalance.substr(positionCharacterLastPoint+1,4);

		//Initialize variable that will contain the definitive value
		var formattedValue ='';
		//We evaluate if the different decimals of the number end in '0000', '000', '00' or '0'; and hide them respectively
		if (lastFourChararcters === '0000'){
			//We format the value and we do not show decimals
			formattedValue = number_format_js(valueBalance,2,'.',',');
			//We search and delete the last 3 characters to delete the comma (,) and the zeros (00) that are added by default (, 00)
			//formattedValue = formattedValue.replace(formattedValue.substr(-3),'');
		}
		else if (lastFourChararcters.substr(-3) === '000'){
			//We format the value and we do show one decimal
			formattedValue = number_format_js(valueBalance,2,'.',',');
		}
		else if (lastFourChararcters.substr(-2) === '00'){
			//We format the value and we do show two decimals
			formattedValue = number_format_js(valueBalance,2,'.',',');
		}
		else if (lastFourChararcters.substr(-1) === '0'){
			//We format the value and we do show three decimals
			formattedValue = number_format_js(valueBalance,2,'.',',');
		}
		else{

			if (positionCharacterLastPoint!== -1){
				formattedValue = numberFormatNoApproximationJs(valueBalance);
			}else{
				formattedValue =numberFormatNoApproximationJs(valueBalance + '.00');
			}

		}
		//We return the value with or without decimals
		return formattedValue;
	}

	function reiniciar_progress_bar() {
		$('.progress-bar').css('width', '0%').attr('aria-valuenow', 0);
		$('.progress').hide();
	}

	<!-- javascript for detroying the Perfect Scrollbar -->


	function addOrRemoveDecimalsToeValue(valueBalanceAffiliate){

		// console.log(valueBalanceAffiliate)
		//We obtain and save the total balance of the affiliate
		var valueBalance = valueBalanceAffiliate;
		//We obtain the position in which the last point is found (.)
		var positionCharacterLastPoint = valueBalance.lastIndexOf('.');
		//We get the last 4 characters of the value, which are the decimals
		var lastFourChararcters = valueBalance.substr(positionCharacterLastPoint+1,4);
		//Initialize variable that will contain the definitive value
		var formattedValue ='';
		//We evaluate if the different decimals of the number end in '0000', '000', '00' or '0'; and hide them respectively
		if (lastFourChararcters === '0000'){
			//We format the value and we do not show decimals
			formattedValue = number_format_js(valueBalance,2,'.',',');
			//We search and delete the last 3 characters to delete the comma (,) and the zeros (00) that are added by default (, 00)
			//formattedValue = formattedValue.replace(formattedValue.substr(-3),'');
		}
		else if (lastFourChararcters.substr(-3) === '000'){
			//We format the value and we do show one decimal
			formattedValue = number_format_js(valueBalance,2,'.',',');
		}
		else if (lastFourChararcters.substr(-2) === '00'){
			//We format the value and we do show two decimals
			formattedValue = number_format_js(valueBalance,2,'.',',');
		}
		else if (lastFourChararcters.substr(-1) === '0'){
			//We format the value and we do show three decimals
			formattedValue = number_format_js(valueBalance,2,'.',',');
		}
		else{

			if (positionCharacterLastPoint!== -1){
				formattedValue = numberFormatNoApproximationJs(valueBalance);
			}else{
				formattedValue =numberFormatNoApproximationJs(valueBalance + '.00');
			}
			//We save the formatted value that returns the method that takes away the approximation


		}
		//We return the value with or without decimals
		return formattedValue;
	}

	function validateIsGreaterDate(element_initial_date, element_final_date, value_initial_date, value_final_date) {

		if (Date.parse(value_initial_date) > Date.parse(value_final_date)){
			element_initial_date.addClass('border border-danger');
			element_final_date.addClass('border border-danger');
			validationMessageError('La "Fecha Inicial" debe se menor que la "Fecha Final"');
			return false;
		}
		element_initial_date.removeClass('border border-danger');
		element_final_date.removeClass('border border-danger');
		return true;
	}

	function validateURL(url){
		return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?|\[|\])*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
	}

	function validateWildcardsCLI(value){

		//Proceso para saber cuantos comodines(X) tiene el CLI
		let number_of_wildcards = [];
		for(let i = 0; i < value.length; i++) {
			if (value[i].toUpperCase() === 'X') number_of_wildcards.push(i);
		}
		let wildcards = number_of_wildcards.length;

		if (value.length > 0 && wildcards < 2){
			validationMessageError('El CLI debe contener al menos 2 comodines(X).');
			return false;
		}
		else if (value.length > 0 && value.length <= 6){
			validationMessageError('El CLI debe ser mayor a 6 dígitos.');
			return false;
		}
		else if (value.length > 0 && value.length > 16){
			validationMessageError('El CLI no debe superar los 16 dígitos.');
			return false;
		}
		else return true;
	}

	function validationNumberCLI(){
		$('.js-input-CLI').on('input', function () {
			this.value = this.value.replace(/[^0-9Xx]/g,'');
		});
	}

	function validationNumberNIT(){
		$('.js-input-NIT').on('input', function () {
			this.value = this.value.replace(/[^0-9-]/g,'');
		});
	}

	function characterCounter(element, type = null, summernote = false){

		//We get the content of 'Summernote'
		let numberOfCharacters;

		if (!summernote)
			numberOfCharacters =  element.val();
		else
			numberOfCharacters =  element.summernote('code');

		//We eliminate the HTML tags and all the content in them so that the default tags of the summernote are not counted '<p> <br> </ p>'
		numberOfCharacters = numberOfCharacters.replace(/(?:<[^>]+>)/gi,'');

		//We replace the original HTML entities' &gt; &lt; &amp; &nbsp; ' for legible symbols '<> &'
		numberOfCharacters = numberOfCharacters.replace(/&lt;/g,'<');
		numberOfCharacters = numberOfCharacters.replace(/&gt;/g,'>');
		numberOfCharacters = numberOfCharacters.replace(/&amp;/g,'&');
		numberOfCharacters = numberOfCharacters.replace(/&nbsp;/g,' ');

		//We replace the consecutive blank spaces, by one single
		numberOfCharacters = numberOfCharacters.replace(/\s\s+/g,' ');

		//We get the total length of the characters of the content
		numberOfCharacters = numberOfCharacters.length;

		// Initialize variable that will count the number of messages to send.
		var messageCounter = 0;

		//We validate if the number of characters exceeds 160
		if(parseInt(numberOfCharacters) > 160 && type == null){

			//We get the number of messages to send
			messageCounter = Math.ceil(numberOfCharacters/160);

			//We multiply the number of messages to send by the number of characters allowed
			var charactersByMessages = (messageCounter*160);

			// We subtract the previous result by the current number of characters, to reset the counter to '159'
			var characterCounter = charactersByMessages-parseInt(numberOfCharacters);

			//We subtract 160 from the previous result to start the counter at '1'
			characterCounter = 160-parseInt(characterCounter);
		}
		else if (parseInt(numberOfCharacters > 160) && type === 'queue'){
			return false;
		}
		else{
			//Validate that the characters are greater than '0'
			if (parseInt(numberOfCharacters) >= 1){

				//The messages to send start at '1'
				messageCounter = 1;

				//We start the counter in 1 up
				characterCounter = (parseInt(numberOfCharacters));
			}
			//We validate that the characters are equal to '0'
			else if (numberOfCharacters === 0){

				//Messages to send start at '0'
				messageCounter = 0;

				//We start the counter in 1 up
				characterCounter = (parseInt(numberOfCharacters));
			}
		}

		//We save the text that will show the counted characters and the summed messages
		var msn =  characterCounter + " Caracteres / " + messageCounter + " Mensajes" ;

		//We obtain the element corresponding to the label that will load the counter text
		var label = $('label[data-name=text-character-counter]');

		//We load the text that contains the counter to the element (label)
		label.text(msn);
		$(element).addClass('valid');
	}

	function show_next_step(element_current_step, element_next_step){

		//Ocultamos y mostramos los contenedores (steps)
		element_current_step
			.removeClass('animated fadeInLeft')
			.addClass('elementHide');

		element_next_step
			.addClass('animated fadeInRight')
			.removeClass('elementHide');
	}

	function show_prev_step(element_current_step, element_prev_step){

		//Ocultamos y mostramos los contenedores (steps)
		element_current_step
			.removeClass('animated fadeInLeft')
			.addClass('elementHide');

		element_prev_step
			.addClass('animated fadeInRight')
			.removeClass('elementHide');
	}

	function modifyDays(date, number_days){
		date.setDate(date.getDate() + number_days);
		return date;
	}

	function regex_validations(){

		// Sólo letras, números y guiones bajos (_)
		$('.js-regex-route-name').on('input', (elem) => {
			let current_element = $(elem.target);
			let value = current_element.val();
			let reg_ex = /[^a-zA-Z0-9_]/g;
			let new_value = value.replace(reg_ex, '');
			return current_element.val(new_value);
		});

		// Sólo números
		$('.js-regex-only-numbers').on('input', (elem) => {
			let current_element = $(elem.target);
			let value = current_element.val();
			let reg_ex = /[^0-9]/g;
			let new_value = value.replace(reg_ex, '');
			return current_element.val(new_value);
		});
	}

	function copyToClipboard(element, type){

		//Definimos variable en el que se obtendrá el valor
		let value_copied = '';

		//Evaluamos qué tipo de elemento es
		if (type !== 'input')
			value_copied = $(element).text().trim();
		else
			value_copied = $(element).val().trim();

		var $temp = $("<input>");

		$("body").append($temp);

		$temp.val(value_copied).select();

		document.execCommand("copy");

		$temp.remove();
	}

	function shootTooltip(element){

		$(element).attr('title','Texto copiado!');

		$(element).tooltip();
		$(element).mouseover();

		setTimeout(function(){
			$(element).tooltip('dispose');
		},3000);
	}