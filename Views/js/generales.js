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

		if (resp.length>0) {
			$("#alert").append('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Asistencia registrada</strong> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </div>');
			var comentario="";
			for (var i in resp) {
				if (resp[i].ASISTENCIA==1) {
					$("#si_"+resp[i].ID_INTEGRANTE).attr('checked', true);
				} else {
					$("#no_"+resp[i].ID_INTEGRANTE).attr('checked', true);
				}
				comentario=resp[i].COMENTARIO;
			}
			$("#comentario").val(comentario);
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
		{console.log(data);
			for (var x in data) 
			{	
				if(data[x].COMENTARIO==null){
					data[x].COMENTARIO="";
				}
				$("#tablaAsistencia > thead > tr").append("<th>"+data[x].FECHA+" <br><span class='TextSmall'>"+data[x].COMENTARIO+"</span></th>");
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

	function birthday(){
		$("#alert").empty();
		var fecha= $("#fechaAsistencia").val();
		$.getJSON('Integrantes/birthdayJSON',{fecha:fecha}, function(resp){
			var esteMes=true;
			var hoyCumple=true;
			var proximos=true;
			for (var i in resp) 
			{	
				var date=  resp[i].FECHA_NACIMIENTO.split("-"); 
				var day=date[2];
				var month=date[1];

				var hoy = new Date();
				var dd = hoy.getDate();
				var mm = hoy.getMonth()+1;
				mm=("0" + mm).slice (-2); // devolverá “01” si h=1; “12” si h=12
				
				if ( mm==month && dd==day) {
					if (hoyCumple==true) {
						$("#birthdays > tbody").append("<tr  class='danger'><td colspan='4' align='center' style='font-weight:bold;color:#B21800'> HOY <i class='fa fa-phone' aria-hidden='true'></i></td></tr>");
						hoyCumple=false;
					}
					$("#birthdays > tbody").append("<tr id='"+resp[i].DOCUMENTO+"'><td><a href='Integrantes/ver/"+resp[i].DOCUMENTO+"'>"+resp[i].NOMBRES+" "+resp[i].PRIMER_APELLIDO+"</a></td><td>"+resp[i].FECHA_NACIMIENTO+" </td><td style='color:#ad3232; font-weight:bold;font-size:14px;'> "+(resp[i].EDAD-1)+" AÑOS  <i class='fa fa-birthday-cake' aria-hidden='true'></i></td></tr>");
				} else if (mm==month) {
					if (esteMes==true) {
						$("#birthdays > tbody").append("<tr class='warning'><td colspan='4' align='center' style='font-weight:bold;color:#897604'> ESTE MES <i class='fa fa-clock-o' aria-hidden='true'></td></tr>");
						esteMes=false;
					}
					var falta=dd-day;
					$("#birthdays > tbody").append("<tr id='"+resp[i].DOCUMENTO+"'><td><a href='Integrantes/ver/"+resp[i].DOCUMENTO+"'>"+resp[i].NOMBRES+" "+resp[i].PRIMER_APELLIDO+"</a></td><td>"+resp[i].FECHA_NACIMIENTO+" <span style='color:#48A8CC; font-size:14px;font-weight:bold;'> - Faltan "+Math.abs(falta)+" día(s) </span></td><td style='color:#ad3232; font-weight:bold;'>  "+resp[i].EDAD+" AÑOS <i class='fa fa-birthday-cake' aria-hidden='true'></i></td></tr>");
				} else {
					if (proximos==true) {
						$("#birthdays > tbody").append("<tr  class='info'><td colspan='4' align='center' style='font-weight:bold;color:#3B246A'> PROXIMOS <i class='fa fa-calendar' aria-hidden='true'></i></td></tr>");
						proximos=false;
					}
					$("#birthdays > tbody").append("<tr id='"+resp[i].DOCUMENTO+"'><td><a href='Integrantes/ver/"+resp[i].DOCUMENTO+"'>"+resp[i].NOMBRES+" "+resp[i].PRIMER_APELLIDO+"</a></td><td>"+resp[i].FECHA_NACIMIENTO+"</td><td style='color:#ad3232; font-weight:bold;'>"+resp[i].EDAD+" AÑOS <i class='fa fa-birthday-cake' aria-hidden='true'></i></td></tr>");

				}
			}
			$("#birthdays > tbody").append("<tr'><td colspan='4' align='left' style='font-weight:bold;color:#818181;font-size:13px;'> "+resp.length+" <i class='fa fa-birthday-cake' aria-hidden='true'></i> Pendientes.</td></tr>");

			console.log();

		}).error(function(e){
			console.log(e);
		})


	}

	function validarPasswords(){
		var nueva= $("#nueva").val();
		var confir= $("#confirmar").val();
		var actual= $("#actual").val();
		$("#msjConfirmar").empty();
		if (actual==nueva) {
			$("#actual").val("");
			$("#nueva").val("");
			$("#confirmar").val("");
			$( "#actual" ).focus();
			$("#msjConfirmar").append('<span style="color:orange;font-size:14px;font-weight:bold">La contraseña debe ser diferente a la anterior. <i class="fa fa-key" aria-hidden="true"></i></span>');
		}else{

			if($("#nueva").val().length < 5) {  
				$("#nueva").val("");
				$("#confirmar").val("");
				$( "#nueva" ).focus();
				$("#msjConfirmar").append('<span style="color:orange;font-size:14px;font-weight:bold">Min. 5 caracteres <i class="fa fa-key" aria-hidden="true"></i></span>');
			} else{
				if (nueva!=confir) {
					$("#nueva").val("");
					$("#confirmar").val("");
					$( "#nueva" ).focus();
					$("#msjConfirmar").append('<span style="color:orange;font-size:14px;font-weight:bold">Las contraseñas no coinciden <i class="fa fa-key" aria-hidden="true"></i></span>');
				} 
			}
		}
	}

	function validarPasswordActual(){
		$("#msjActual").empty();
		var actual= $("#actual").val();
		var id= $("#id").val();
		$.get('GoLogin/validarPassword',{actual:actual, id:id}, function(resp,estado,jqXHR){
			if (resp!=1) {
				$("#actual").val("");
				$( "#actual" ).focus();
				$("#msjActual").append('<span style="color:orange;font-size:14px;font-weight:bold">Contraseña incorrecta <i class="fa fa-key" aria-hidden="true"></i></span>');


			}  

		});
	}