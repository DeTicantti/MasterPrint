// Función autocompletar
function autocompletar() {
	var minimo_letras = 0; // minimo letras visibles en el autocompletar
	var palabra = $('#pais_id').val();
	//Contamos el valor del input mediante una condicional
	if (palabra.length >= minimo_letras) {
		$.ajax({
			url: 'mostrar.php',
			type: 'POST',
			data: {palabra:palabra},
			success:function(data){
				$('#lista_id').show();
				$('#lista_id').html(data);
			}
		});
	} else {
		//ocultamos la lista
		$('#lista_id').hide();
	}
}

function autocompletarmod() {
	var minimo_letras = 0; // minimo letras visibles en el autocompletar
	var palabra = $('#imp_mod').val();
	//Contamos el valor del input mediante una condicional
	if (palabra.length >= minimo_letras) {
		$.ajax({
			url: 'mostrar2.php',
			type: 'POST',
			data: {palabra:palabra},
			success:function(data){
				$('#lista_id_mod').show();
				$('#lista_id_mod').html(data);
			}
		});
	} else {
		//ocultamos la lista
		$('#lista_id_mod').hide();
	}
}

// Funcion Mostrar valores
function set_item(opciones) {
	// Cambiar el valor del formulario input
	$('#pais_id').val(opciones);
	// ocultar lista de proposiciones
	$('#lista_id').hide();
}