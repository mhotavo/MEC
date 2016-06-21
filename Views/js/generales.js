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
	$.getJSON('asistencia/verJSON',{fecha:fecha}, function(resp){
		// console.log(resp.length);
		if (resp.length>0) {
			$("#alert").append('<div class="alert alert-success"><strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Asistencia registrada</strong> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </div>');
			for (var i in resp) {
				if (resp[i].ASISTENCIA==1) {
					$("#si_"+resp[i].ID_INTEGRANTE).attr('checked', true);
				} else {
					$("#no_"+resp[i].ID_INTEGRANTE).attr('checked', true);
				}
			}
		} else{
			$( "input[name^='asistencia']" ).attr('checked', false);
		}

	}).error(function(e){
		console.log(e);
	})


}



function asistencia(){
	$.getJSON('../Integrantes/listarJSON', function(resp){
		//console.log(resp);
		var fecha="";
		for (var i in resp) 
		{
			$("#tablaAsistencia > tbody").append("<tr id='"+resp[i].DOCUMENTO+"'><td>"+resp[i].NOMBRE+"</td></tr>");
			var id=resp[i].DOCUMENTO;
			$.getJSON('../asistencia/verJSONporID',{id:id}, function(data){

				for (var x in data) 
					/*if (fecha!=data[x].FECHA) {
						$("#tablaAsistencia > thead > tr").append("<th>"+data[x].FECHA+"</th>");
					}
					fecha=data[x].FECHA; */
					$("#"+data[x].ID_INTEGRANTE).append("<td>"+data[x].ASISTENCIA+"</td></tr>");
				}
			}).error(function(e){
				console.log(e);
			})
		}
	}).error(function(e){
		console.log(e);
	})



}


