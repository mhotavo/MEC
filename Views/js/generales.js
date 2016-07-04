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
	//LISTAMOS INTEGRANTES
	$.getJSON('../Integrantes/listarJSON', function(resp){
		//console.log(resp);
		
		for (var i in resp) 
		{
			$("#tablaAsistencia > tbody").append("<tr id='"+resp[i].DOCUMENTO+"'><td>"+resp[i].NOMBRE+"</td></tr>");

		}
		$("#tablaAsistencia > tbody").append("<tr id='totalAsistencias'><td><b>ASISTENCIAS</b></td></tr>");
		$("#tablaAsistencia > tbody").append("<tr id='totalFallas'><td><b>FALLAS</b></td></tr>");

	}).error(function(e){
		console.log(e);
	})
	//LISTAMOS FECHAS
	$.getJSON('../asistencia/fechasJSON', function(data)
	{
		for (var x in data) 
		{	
			$("#tablaAsistencia > thead > tr").append("<th>"+data[x].FECHA+"</th>");
			var fecha=data[x].FECHA;
			var asistencias=0;
			var fallas=0;
				//LISTAMOS ASISTENCIA
				$.getJSON('../asistencia/verJSON',{fecha:fecha}, function(resp){
					//console.log(resp);
					var fecha="";
					for (var i in resp) 
					{
						if (resp[i].ASISTENCIA==1) {
							$("#"+resp[i].ID_INTEGRANTE).append("<td class='success'><b style='color:green;'>SI</b></td>");
							asistencias=asistencias+1;
						} else {
							$("#"+resp[i].ID_INTEGRANTE).append("<td class='danger'><b style='color:red;'>NO</b></td>");
							fallas=fallas+1;
						}
					}
					$("#totalAsistencias").append("<td class='success'><b style='color:green;'>"+asistencias+"</b></td>");
					$("#totalFallas").append("<td class='danger'><b style='color:red;'>"+fallas+"</b></td>");
					asistencias=0;
					fallas=0;

				}).error(function(e){
					console.log(e);
				})
			}

		}).error(function(e){
			console.log(e);
		})


	}