function __(id){
	return document.getElementById(id);
}
function DeleteItem(contenido, url){
	var action= window.confirm(contenido);
	if (action) {
		window.location=url;
	}
}

function cargarAsistencia(){
	var fecha= $("#fechaAsistencia").val();
	$.getJSON('asistencia/listarAsistencia',{fecha:fecha}, function(resp){
		for (var i in resp) {
			console.log(resp[i].ID_INTEGRANTE);
			if (resp[i].ASISTENCIA==1) {
				$("#si_"+resp[i].ID_INTEGRANTE).attr('checked', true);
			} else {
				$("#no_"+resp[i].ID_INTEGRANTE).attr('checked', true);
			}
			
		}
	}).error(function(e){
		console.log(e);
		//$("#resultado").append('<br><div class="alert alert-info">  <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No hay salones disponibles</strong> para el profesor seleccionado. </div>');
	})


}




