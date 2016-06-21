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
	$("#alert").empty();
	var fecha= $("#fechaAsistencia").val();
	$.getJSON('asistencia/listarAsistencia',{fecha:fecha}, function(resp){
			console.log(resp);
			$("#alert").append('<br><div class="alert alert-success"><strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Asistencia registrada</strong> </div>');
			for (var i in resp) {
				if (resp[i].ASISTENCIA==1) {
					$("#si_"+resp[i].ID_INTEGRANTE).attr('checked', true);
				} else {
					$("#no_"+resp[i].ID_INTEGRANTE).attr('checked', true);
				}
			}
 

	

	}).error(function(e){
		console.log(e);
	})


}




