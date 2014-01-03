$(document).ready(function() {
	//##### ESCONDE EL HEADER DEL REMITO #########
	$('#ocultar_header').live('click',function(){
		$( ".header_remito" ).hide( "slow", function() {
			$("#ocultar_header").attr('id', 'mostrar_header');
			$("#mostrar_header").removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
			$("#mostrar_header").attr('title', 'Mostrar encabezado');
  		});
	});
	$('#mostrar_header').live('click',function(){
		$( ".header_remito" ).show( "slow", function() {
			$("#mostrar_header").attr('id', 'ocultar_header');
			$("#ocultar_header").removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
			$("#ocultar_header").attr('title', 'Ocultar encabezado');
  		});
	});
});


