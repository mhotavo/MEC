<?php
//header('Content-Type: text/html; charset=ISO-8859-1');
define ('SIALT_PATH','../../sialt/');
define('SIAL_PATH','../../');
define('INICIO_PATH','../../Ingreso_Sistema/');
define('MENU_PATH','../sialt/');
require_once(SIAL_PATH.'Connections/conexion_sialt.php');
require_once(SIALT_PATH.'Clases PHP/session.php');

get_session('NIT_GENERADOR', $nit_empresa_generador);
get_session('PREFIJO_GENERADOR', $prefijo_empresa_generador);
get_session('DOC_USUARIO', $DOC_USUARIO);
$CODIGO_PRIV=7;
chk_priv($DOC_USUARIO,$CODIGO_PRIV,$database_conexion_sialt,$conexion_sialt);

$nit=split('-',$nit_empresa_generador);
require_once(SIAL_PATH.'Connections/conexion_sialc.php');

$fecha_ini=$_GET['FECHA_INI'];
$fecha_fin=$_GET['FECHA_FIN'];
$agencias=split('-',$_GET['AGENCIAS']);
$cliente=$_GET['DOC_CLIENTE'];


// Generar Excel
if(isset($_GET['TIPO_REP']) && $_GET['TIPO_REP']=='Excel')
	{
	header("Content-type: application/vnd.ms-excel");
	header('Content-Transfer-Encoding: Binary');
	header("Content-Disposition: attachment; filename=excel.xls");
	}

/*********************************
* complemento de la consulta para
* para filtrar por cliente
********************************/
if ($cliente != '')
	$filtCliente = " AND (DOC_PER_DEST = '$cliente' OR DOC_PER_REMI = '$cliente' OR NIT_EMPRESA_DEST = '$cliente' OR NIT_EMPRESA_REMI = '$cliente') ";
else
	$filtCliente = " ";
/********************************/


/********************************
* preparamos la cadena para las *
* agencias escojidos en el form *
********************************/
$cad_agencia_tmp2='';
for($i=0; $i<count($agencias); $i++)
	{
	$cad_agencia_tmp2.=" (PREFIJO_AGENCIA=$agencias[$i] AND e.NIT_EMPRESA_MANIFIESTO='$nit_empresa_generador') OR ";
	$cad_agencia_tmp1 .= " (e.PREFIJO_AGENCIA=$agencias[$i] AND e.NIT_EMPRESA_MANIFIESTO='$nit_empresa_generador') OR ";
	}
$cad_agencia_tmp2=substr($cad_agencia_tmp2,0,-3);
$cad_agencia_tmp1 = substr($cad_agencia_tmp1,0,-3);

mysql_select_db($database_conexion_sialt,$conexion_sialt);
$query_despacho="SELECT * FROM manifiesto e, remesa r
				 WHERE e.NUMERO_MANIFIESTO=r.NUMERO_MANIFIESTO AND e.FECHA_EXPEDICION_MANFIESTO BETWEEN '$fecha_ini' AND '$fecha_fin' AND ($cad_agencia_tmp1) $filtCliente
				 ORDER BY e.FECHA_EXPEDICION_MANFIESTO ";
$despacho=mysql_query($query_despacho,$conexion_sialt) or die(mysql_error());
$row_despacho=mysql_fetch_assoc($despacho);
$totalRows_despacho = mysql_num_rows($despacho);

//juego de registro de nombres de agencias seleccionadas
mysql_select_db($database_conexion_sialt, $conexion_sialt);
$query_emp= "SELECT * FROM empresa_orden_legal e, agencia a WHERE a.NIT_EMPRESA_MANIFIESTO=e.NIT_EMPRESA_MANIFIESTO AND ($cad_agencia_tmp2)";
$emp = mysql_query($query_emp, $conexion_sialc) or die(mysql_error());
$cad_nomAgen='';

// Recorremos el juego de registros para generar la cadena
// de todos los centros escojidos
while($row_emp = mysql_fetch_assoc($emp))
	{
	$cad_nomAgen.=$row_emp['NOMBRE_AGENCIA'].' - ';
	$nomEmp=$row_emp['NOMBRE_EMPRESA_MANIFIESTO'];
	}
$cad_nomAgen=substr($cad_nomAgen,0,-3);


$zona=1;
$nitTmp=split('-', $nit_empresa_generador);
$nitTmp=number_format($nitTmp[0],0,'.','.').'-'.$nitTmp[1];


// Consultamos todos los descuentos creados para
// la agencia actual con la que estamos trabajando
$idAgen=$prefijo_empresa_generador;
$idEmp=$nit_empresa_generador;
mysql_select_db($database_conexion_sialt, $conexion_sialt);
$queryDescuento="SELECT * FROM descuento WHERE ACTIVO='S' AND PREFIJO_AGENCIA=$idAgen AND NIT_EMPRESA_MANIFIESTO='$idEmp' ORDER BY NUMERO";
$Descuento=mysql_query($queryDescuento, $conexion_sialt) or die(mysql_error());
$totRowsDescuento=mysql_num_rows($Descuento);

$AcumDesc = array();
$AcumTotDesc = array();

/* @num_reg -> contador para los numeros de linea */
/* @num_cut -> variable para el numero de linea en el cual se debe saltar de pagina */
$num_reg=0;
$num_cut=40;
$pag=1;



/* funcion para buscar el nombre de la ciudad */
function buscaCiudad ($cod_ciu, $conex)
  {
  $sql_ciudad = "SELECT * FROM ciudad WHERE CODIGO_CIUDAD = $cod_ciu ";
  $Res_ciudad = mysql_query($sql_ciudad, $conex) or die(mysql_error());
  $row_ciudad = mysql_fetch_assoc($Res_ciudad);
  return $row_ciudad['NOMBRE_CIUDAD'];
  }

/**********************************************/

if ($totalRows_despacho=='0') {
	titulos();
	echo '<b>No se encontraron datos</b>';
	echo '<script>alert("No se encontraron datos");</script>';
	exit();
}

function titulos($flag=0)
	{
	global $nomEmp, $nitTmp, $cad_nomAgen, $fecha_ini, $fecha_fin, $pag, $Descuento, $AcumDesc, $AcumTotDesc;
	global $total_valor_flete, $total_pago_anti_pag, $total_vr_saldo, $total_vr_fact, $total_comision, $total_rentab;
	global $subtotal_valor_flete, $subtotal_pago_anti_pag, $subtotal_pago_2anti_pag, $subtotal_vr_saldo, $subtotal_vr_fact, $subtotal_comision, $subtotal_rentab, $num_cut;

	if($flag)
		{
		$pag++;
		echo "      <tr bgcolor='#E9E7E2' class='Imprimir_Sen2'>\n";
		echo "        <td>SUBTOTALES</td>\n";
		echo "        <td>&nbsp;</td>\n";
		echo "        <td>&nbsp;</td>\n";
		echo "        <td>&nbsp;</td>\n";
		echo "        <td>&nbsp;</td>\n";
		echo "        <td>&nbsp;</td>\n";
		echo "        <td>&nbsp;</td>\n";
		echo "        <td>&nbsp;</td>\n";
		echo "        <td align='right'>".number_format($subtotal_valor_flete,0,'.','.')."</td>\n";
		echo "        <td>&nbsp;</td>\n";
		echo "        <td align='right'>".number_format($subtotal_pago_anti_pag,0,'.','.')."</td>\n";
		echo "        <td align='right'>".number_format($subtotal_pago_2anti_pag,0,'.','.')."</td>\n";

		$i=0;
		mysql_data_seek($Descuento, 0);
		while($rowDescuento = mysql_fetch_assoc($Descuento))
			{
			echo "        <td align='right'>".number_format($AcumDesc[$i],0,'.','.')."</td>";
			$i++;
			}
		echo "        <td>&nbsp;</td>\n";
		echo "        <td>&nbsp;</td>\n";
		echo "        <td align='right'>".number_format($subtotal_vr_saldo,0,'.','.')."</td>\n";
		echo "        <td align='right'>&nbsp;</td>\n";
		echo "        <td align='right'>&nbsp;</td>\n";
		echo "        <td align='right'>".number_format($subtotal_vr_fact,0,'.','.')."</td>\n";
		echo "        <td align='right'>".number_format($subtotal_comision,0,'.','.')."</td>\n";
		echo "        <td align='right'>".number_format(($subtotal_rentab*100)/$num_cut,2,',','.')."</td>\n";
		echo "      </tr>\n";
		echo "    </table>\n";

		echo "    <div style='page-break-before:always'>&nbsp;</div>\n";
		echo "    <div align='center' class='Imprimir_Neg'>\n";
		echo "      $nomEmp&nbsp;Nit&nbsp$nitTmp<br>";
		echo "      Agencia(s)&nbsp;:&nbsp;".ucwords(strtolower($cad_nomAgen))."<br>";
		echo "      Fecha De : $fecha_ini A : $fecha_fin\n";
		echo "    </div>\n";
		echo "    <div align='left' class='Imprimir_Neg'>Relaci&oacute;n de Despachos </div>\n";
		echo "    <table border='1' cellpadding='0' cellspacing='0' style='cursor:pointer' onClick='window.print()' width='100%' align='center'>\n";
		echo "      <tr class='CabecTitu'>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Fecha<br>(aaaa-mm-dd)</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>M.C</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>R.M</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Remitente</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Destinatario</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Conductor</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Propietario</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Origen</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Destino</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Vlr.Flete</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>N&ordm; Egres<br>Ant.</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Vlr Ant.</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Vlr 2-Ant.</td>\n";

		mysql_data_seek($Descuento, 0);
		while($rowDescuento = mysql_fetch_assoc($Descuento))
			{
			echo "        <td bgcolor='#E9E7E2' align='center'>".ucwords(strtolower($rowDescuento['NOMBRE']))."</td>\n";
			}

		echo "        <td bgcolor='#E9E7E2' align='center'>Flete Reliquidado</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Fecha Saldo</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>N&ordm; Egreso</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Vlr Saldo</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>N&ordm;Fact</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Cliente</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Vr Fact</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Comision<br>C.E</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>% Rentab</td>\n";
		echo "      </tr>\n";

		$subtotal_valor_flete=0;
		$subtotal_pago_anti_pag=0;
		$subtotal_vr_saldo=0;
		$subtotal_vr_fact=0;
		$subtotal_comision=0;
		$subtotal_rentab=0;
		}
	else
		{
		echo "<html>\n";
		echo "  <head>\n";
		echo "    <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />\n";
		echo "    <title>Relacion de Despacho - Contenido - </title>\n";
		echo "    <link href='../css/estilos.css' rel='stylesheet' type='text/css'>\n";
		echo "  </head>\n";
		echo "  <body>\n";
		echo "    <div align='center' class='Imprimir_Neg'>\n";
		echo "      $nomEmp&nbsp;Nit&nbsp$nitTmp<br>";
		echo "      Agencia(s)&nbsp;:&nbsp;".ucwords(strtolower($cad_nomAgen))."<br>";
		echo "      Fecha De : $fecha_ini A : $fecha_fin\n";
		echo "    </div>\n";
		echo "    <div align='left' class='Imprimir_Neg'>Relaci&oacute;n de Despachos </div>\n";
		echo "    <table border='1' cellpadding='0' cellspacing='0' style='cursor:pointer' onClick='window.print()' width='100%' align='center'>\n";
		echo "      <tr class='CabecTitu'>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Fecha<br>(aaaa-mm-dd)</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>M.C</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>R.M</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Remitente</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Destinatario</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Conductor</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Propietario</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Origen</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Destino</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Vlr.Flete</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>N&ordm; Egres<br>Ant.</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Vlr Ant.</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Vlr 2-Ant.</td>\n";
		while($rowDescuento = mysql_fetch_assoc($Descuento))
			{
			echo "        <td bgcolor='#E9E7E2' align='center'>".ucwords(strtolower($rowDescuento['NOMBRE']))."</td>\n";
			}

		echo "        <td bgcolor='#E9E7E2' align='center'>Flete Reliquidado</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Fecha Saldo</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>N&ordm; Egreso</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Vlr Saldo</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>N&ordm;Fact</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Cliente</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Vr Fact</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>Comision<br>C.E</td>\n";
		echo "        <td bgcolor='#E9E7E2' align='center'>% Rentab</td>\n";
		echo "      </tr>\n";
		}
	}

/********************************************************
* Funcion para verificar el punto de corte de la pagina *
********************************************************/
function chkPag($numReg=0)
	{
	global $num_reg, $num_cut;

	if($num_reg > ( $num_cut - $numReg) )
		{
		titulos(1);
		$num_reg=0;
		}
	else
		$num_reg++;

	}


$cont=1;
$conts=1;

$total_valor_flete = 0;
$total_pago_anti_pag = 0;
$total_pago_2anti_pag = 0;
$total_vr_saldo = 0;
$total_vr_fact = 0;
$total_comision = 0;
$total_rentab = 0;

$subtotal_valor_flete=0;
$subtotal_pago_anti_pag=0;
$subtotal_pago_2anti_pag=0;
$subtotal_vr_saldo=0;
$subtotal_vr_fact=0;
$subtotal_comision=0;
$subtotal_rentab=0;

titulos();

$mcAct = '';
do{
	$centro=$row_despacho['PREFIJO_AGENCIA'];
	$numMc=split('-',$row_despacho['NUMERO_MANIFIESTO']);
	$numMc=$numMc[2];
	$codFletes=12;

	unset($row_antic);
	unset($row_canc);
	unset($row_retfnt);
	unset($row_retica);
	unset($row_egresoCanc);

	/* Parametros por cada agencia */
	mysql_select_db($database_conexion_sialc_puc,$conexion_sialc);
	$query_param="SELECT * FROM param_cancela WHERE CODIGO_CENTRO={$row_despacho['PREFIJO_AGENCIA']} AND CODIGO_ZONA=$zona
				  AND NIT='$nit_empresa_generador'";
	$param=mysql_query($query_param, $conexion_sialc) or die(mysql_error());
	$row_param=mysql_fetch_assoc($param);


	/* Egreso Anticipo*/
	$pagoAntic = 0;
	if($mcAct != $row_despacho['NUMERO_MANIFIESTO'])
		{
		mysql_select_db($database_conexion_sialc_puc, $conexion_sialc);
		$query_egresoAnt="SELECT DEBITO, NUM_TRANSACCION from detalle_transaccion dt
						  WHERE dt.ID_SUBCUENTA='{$row_param['ID_SUBCTA_ANTICIPO']}' AND dt.COD_CENTRO_TRAN='{$row_despacho['CENTRO_EGRESO']}' AND dt.COD_ZONA_TRAN=$zona
						  AND dt.NIT_TRAN='$nit_empresa_generador' AND dt.NUM_TRANSACCION='{$row_despacho['NUM_EGRESO']}' AND dt.CODIGO='{$row_despacho['TIPO_EGRESO']}'
						  AND dt.FECHA_TRANS='{$row_despacho['FECHA_EGRESO']}'";
		$egresoAnt=mysql_query($query_egresoAnt,$conexion_sialc) or die(mysql_error().' L117');
		$row_egresoAnt=mysql_fetch_assoc($egresoAnt);
		$pagoAntic = $row_despacho['PAGO_ANTICIPADO'];
		}

	// Sobreanticipo
	mysql_select_db($database_conexion_sialt, $conexion_sialt);
	$querySobreAntic = "SELECT SUM(SOBRE_ANTICIPO) AS SOBRE_ANTICIPO FROM orden_carga WHERE NUMERO_MANIFIESTO='{$row_despacho['NUMERO_MANIFIESTO']}'";
	$SobreAntic = mysql_query($querySobreAntic, $conexion_sialt) or die(mysql_error());
	$rowSobreAntic = mysql_fetch_assoc($SobreAntic);


	/* Egreso Cancelacion*/
	/******************************************
	* Buscamos primero la causacion del mc    *
	* si no existe seguimos con el parametro  *
	******************************************/
	if($mcAct != $row_despacho['NUMERO_MANIFIESTO'])
		{
		mysql_select_db($database_conexion_sialc_puc, $conexion_sialc);
		$query_egresoCanc="SELECT CREDITO, NUM_TRANSACCION, FECHA_TRANS from detalle_transaccion dt
						   WHERE dt.ID_SUBCUENTA='{$row_param['ID_SUBCTA_FLETEXPAG']}' AND dt.COD_CENTRO_TRAN='$centro' AND dt.COD_ZONA_TRAN=$zona
						   AND dt.NIT_TRAN='$nit_empresa_generador' AND dt.NUM_TRANSACCION='$numMc' AND dt.CODIGO='$codFletes'";
		$egresoCanc=mysql_query($query_egresoCanc,$conexion_sialc) or die(mysql_error().' L127');
		$row_egresoCanc=mysql_fetch_assoc($egresoCanc);
		$totalRows_Canc=mysql_num_rows($egresoCanc);

		if($totalRows_Canc == 0)
			{
			mysql_select_db($database_conexion_sialc_puc, $conexion_sialc);
			$query_egresoCanc="SELECT CREDITO, NUM_TRANSACCION, FECHA_TRANS from detalle_transaccion dt
							   WHERE dt.ID_SUBCUENTA='{$row_param['ID_SUBCTA_FLETEXPAG']}' AND dt.COD_CENTRO_TRAN='{$row_despacho['CENTRO_CANC']}' AND dt.COD_ZONA_TRAN=$zona AND dt.NIT_TRAN='$nit_empresa_generador'
							   AND dt.NUM_TRANSACCION='{$row_despacho['NUM_CANC']}' AND dt.CODIGO='{$row_despacho['TIPO_CANC']}' AND dt.FECHA_TRANS='{$row_despacho['FECHA_CANC']}'";
			$egresoCanc=mysql_query($query_egresoCanc,$conexion_sialc) or die(mysql_error().' L127');
			$row_egresoCanc=mysql_fetch_assoc($egresoCanc);
			$totalRows_Canc=mysql_num_rows($egresoCanc);
			}
		}

	// Factura del despacho
	$rela = "AND f.NUM_FACT = df.NUM_FACT AND f.CODIGO_CENTRO = df.CODIGO_CENTRO AND f.CODIGO_ZONA = df.CODIGO_ZONA AND df.NIT = f.NIT ";
	$campos = "df.NUM_FACT, SUM(df.SUB_TOTAL) SUB_TOTAL, f.DOCUMENT";
	$condicion = "df.NUM_MANIFIESTO='{$row_despacho['NUMERO_MANIFIESTO']}' AND df.NUM_REMESA='{$row_despacho['NUMERO_REMESA']}'";
	$query_fact="SELECT $campos FROM deta_fact AS df, factura AS f  WHERE $condicion AND df.SUB_TOTAL!=0 $rela GROUP BY df.NUM_MANIFIESTO";
	mysql_select_db($database_conexion_sialc_puc,$conexion_sialt);
	$fact=mysql_query($query_fact,$conexion_sialc) or die(mysql_error());
	$row_fact=mysql_fetch_assoc($fact);

	// Tercero de la factura
	$queryTercFact="SELECT CONCAT_WS(' ', P_NOMBRE, S_NOMBRE, P_APELLIDO, S_APELLIDO) AS TERCERO FROM terceros WHERE DOCUMENT='{$row_fact['DOCUMENT']}' ";
	mysql_select_db($database_conexion_sialc_puc,$conexion_sialt);
	$TercFact=mysql_query($queryTercFact,$conexion_sialc) or die(mysql_error());
	$rowTercFact=mysql_fetch_assoc($TercFact);

	//Remitente de la remesa
	if ($row_despacho['NIT_EMPRESA_REMI'] != '') $queryRemi = "SELECT NOMBRE_EMPRESA_SOLIC  AS REMITENTE, NIT_EMPRESA_SOLIC AS DOC FROM empresa_solicitante WHERE NIT_EMPRESA_SOLIC='{$row_despacho['NIT_EMPRESA_REMI']}'";
	if ($row_despacho['DOC_PER_REMI'] != '') $queryRemi = "SELECT CONCAT_WS(' ', P_APELL_PER, S_APELL_PER, NOM_PER) AS REMITENTE, DOC_PER AS DOC FROM persona WHERE DOC_PER='{$row_despacho['DOC_PER_REMI']}'";
	mysql_select_db($database_conexion_sialt,$conexion_sialt);
	$Remi = mysql_query($queryRemi, $conexion_sialt) or die (mysql_error());
	$rowRemi = mysql_fetch_assoc($Remi);

	//DESTINATARIO de la remesa
	if ($row_despacho['NIT_EMPRESA_DEST'] != '') $queryDest = "SELECT NOMBRE_EMPRESA_SOLIC  AS REMITENTE, NIT_EMPRESA_SOLIC AS DOC FROM empresa_solicitante WHERE NIT_EMPRESA_SOLIC='{$row_despacho['NIT_EMPRESA_DEST']}'";
	if ($row_despacho['DOC_PER_DEST'] != '') $queryDest = "SELECT CONCAT_WS(' ', P_APELL_PER, S_APELL_PER, NOM_PER) AS REMITENTE, DOC_PER AS DOC FROM persona WHERE DOC_PER='{$row_despacho['DOC_PER_DEST']}'";
	$Dest = mysql_query($queryDest, $conexion_sialt) or die (mysql_error());
	$rowDest = mysql_fetch_assoc($Dest);

	///NOMBRE DEL CONDUCTOR
	$queryCond = "SELECT CONCAT_WS(' ', P_APELL_PER, S_APELL_PER, NOM_PER) AS CONDUCTOR, DOC_PER AS DOC FROM persona WHERE DOC_PER='{$row_despacho['DOC_COND']}'";
	$Cond = mysql_query($queryCond, $conexion_sialt) or die (mysql_error());
	$rowCond = mysql_fetch_assoc($Cond);

	///NOMBRE DEL PROPIETARIO
	$query_vehiculo="SELECT DOC_PROPIE FROM vehiculo WHERE PLACA_VEHICULO= '".$row_despacho['PLACA_VEHICULO']."' ";
	$vehiculo=mysql_query($query_vehiculo, $conexion_sialt)or die("Error L403: ".mysql_error());
	$row_vehiculo=mysql_fetch_assoc($vehiculo);

	$queryPropie = "SELECT CONCAT_WS(' ', P_APELL_PER, S_APELL_PER, NOM_PER) AS PROPIETARIO, DOC_PER AS DOC FROM persona WHERE DOC_PER='{$row_vehiculo['DOC_PROPIE']}'";
	$Propie = mysql_query($queryPropie, $conexion_sialt) or die (mysql_error());
	$rowPropie = mysql_fetch_assoc($Propie);

	/*//remesas de cada manifiesto
	$queryRemesas = "SELECT NUMERO_REMESA FROM remesa where NUMERO_MANIFIESTO = '{$row_despacho['NUMERO_MANIFIESTO']}' ";
	$Remesas = mysql_query($queryRemesas, $conexion_sialt) or die (mysql_error());
	$totReme = '';
	while ($rowRemesas = mysql_fetch_assoc ($Remesas))
		{
		$totReme .= $rowRemesas['NUMERO_REMESA']." - ";
		}
	*/

	$VComision = $row_fact['SUB_TOTAL'] - $row_despacho['FLETE_TOTAL_TRANS'];
	$RentaPorcent = $VComision / (($row_fact['SUB_TOTAL']=='' || $row_fact['SUB_TOTAL']==0)? 1 : $row_fact['SUB_TOTAL']);

	$num=split('-',$row_despacho['NUMERO_MANIFIESTO']);

	// Despacho Anulado
	if($row_despacho['ESTADO_ACTUAL_MANIFIESTO'] == 'A')
		{
		$row_despacho['VALOR_FLETE']= " A ";
		$row_despacho['NUM_EGRESO']=" A ";
		$row_despacho['PAGO_ANTICIPADO']=" A ";
		$row_egresoCanc['FECHA_TRANS']=" A ";
		$row_egresoCanc['NUM_TRANSACCION']=" A ";
		$row_egresoCanc['CREDITO'] = " A ";
		$row_fact['NUM_FACT'] = " A ";
		$row_fact['SUB_TOTAL'] = " A ";
		$VComision = " A ";
		$RentaPorcent = " A ";
		}

	// Revisar la paginacion
	chkPag();

	//Valor del Flete
	if($row_despacho['FLETE_TOTAL_TRANS'] == '0' || $row_despacho['FLETE_TOTAL_TRANS'] == '0.00' || $row_despacho['FLETE_TOTAL_TRANS'] == '')
		$fleteTransp = $row_despacho['VALOR_FLETE'];
	else
		$fleteTransp = $row_despacho['FLETE_TOTAL_TRANS'];

	echo "      <tr>\n";
	echo "        <td class='Imprimir_Sen2' align='right'>{$row_despacho['FECHA_EXPEDICION_MANFIESTO']}</td>\n";
	echo "        <td class='Imprimir_Sen2' align='right'>{$num[2]}</td>\n";
	echo "        <td class='Imprimir_Sen2' align='right'>{$row_despacho['NUMERO_REMESA']}</td>\n";
	echo "        <td class='Imprimir_Sen2' align='right'>{$rowRemi['REMITENTE']}<br />{$rowRemi['DOC']}</td>\n";
	echo "        <td class='Imprimir_Sen2' align='right'>{$rowDest['REMITENTE']}<br />{$rowDest['DOC']}</td>\n";
	echo "        <td class='Imprimir_Sen2' align='right'>{$rowCond['CONDUCTOR']}<br />{$rowCond['DOC']}</td>\n";
	echo "        <td class='Imprimir_Sen2' align='right'>{$rowPropie['PROPIETARIO']}<br />{$rowPropie['DOC']}</td>\n";
	echo "        <td class='Imprimir_Sen2' align='right'>".buscaCiudad($row_despacho['ORIGEN'], $conexion_sialt)."</td>\n";
	echo "        <td class='Imprimir_Sen2' align='right'>".buscaCiudad($row_despacho['DESTINO'], $conexion_sialt)."</td>\n";
	echo "        <td class='Imprimir_Sen2' align='right'>".number_format($fleteTransp,0,'.','.')."</td>\n";
//	echo "        <td class='Imprimir_Sen2' align='right'>{$row_despacho['NUM_EGRESO']}</td>\n";
	echo "        <td class='Imprimir_Sen2' align='right'>".( ($row_despacho['NUM_EGRESO'] == '') ? '&nbsp;' : $row_despacho['NUM_EGRESO'] )."</td>\n";
	echo "        <td class='Imprimir_Sen2' align='right'>".number_format($pagoAntic,0,'.','.')."</td>\n";

	echo "        <td class='Imprimir_Sen2' align='right'>".number_format($rowSobreAntic['SOBRE_ANTICIPO'],0,'.','.')."</td>\n";

	// Descuentos Parametrizados
	$reli = $row_despacho['FLETE_TOTAL_TRANS'];
  $i=0;
	mysql_data_seek($Descuento, 0);
	while($rowDescuento = mysql_fetch_assoc($Descuento))
		{

		if($mcAct != $row_despacho['NUMERO_MANIFIESTO'])
			{
			mysql_select_db($database_conexion_sialt, $conexion_sialt);
			$queryDescMc = "SELECT * FROM desc_manif WHERE MANIFIESTO='{$row_despacho['NUMERO_MANIFIESTO']}' AND DESCUENTO='{$rowDescuento['NUMERO']}'";
			$DescMc = mysql_query($queryDescMc, $conexion_sialt);
			$rowDescMc = mysql_fetch_assoc($DescMc);
			}

		// Manifiesto Anulado
		if($row_despacho['ESTADO_ACTUAL_MANIFIESTO'] == 'A')
			echo "<td class='Imprimir_Sen2' align='center'> A </td>";
		else
			echo "<td class='Imprimir_Sen2' align='right'>".number_format($rowDescMc['VALOR'],0,'.','.')."</td>";

		$AcumDesc[$i] += $rowDescMc['VALOR'];
		$AcumTotDesc[$i] += $rowDescMc['VALOR'];
		$i++;

    /*valor flete reliquidado*/
     $reli -= $rowDescMc['VALOR'];
		}

	echo "        <td class='Imprimir_Sen2' align='right'>".number_format($reli,0,'.','.')."</td>\n";
	echo "        <td class='Imprimir_Sen2' align='right'>".( ($row_egresoCanc['FECHA_TRANS'] == '') ? '&nbsp;' : $row_egresoCanc['FECHA_TRANS'] )."</td>\n";
	echo "        <td class='Imprimir_Sen2' align='right'>".( ($row_egresoCanc['NUM_TRANSACCION'] == '') ? '&nbsp;' : $row_egresoCanc['NUM_TRANSACCION'] )."</td>\n";
//	echo "        <td class='Imprimir_Sen2' align='right'>{$row_egresoCanc['NUM_TRANSACCION']}</td>\n";
	echo "        <td class='Imprimir_Sen2' align='right'>".number_format($row_egresoCanc['CREDITO'],0,'.','.')."</td>\n";
	echo "        <td class='Imprimir_Sen2' align='right'>".$row_fact['NUM_FACT']."</td>\n";
	echo "        <td class='Imprimir_Sen2' align='left'>".$rowTercFact['TERCERO']."</td>\n";
	echo "        <td class='Imprimir_Sen2' align='right'>".number_format($row_fact['SUB_TOTAL'],0,'.','.')."</td>\n";
	echo "        <td class='Imprimir_Sen2' align='right'>".number_format($VComision,0,'.','.')."</td>\n";
	echo "        <td class='Imprimir_Sen2' align='right'>".number_format($RentaPorcent*100,2,',','.')."</td>\n";
	echo "      </tr>\n";


	$subtotal_valor_flete += $fleteTransp;
	$subtotal_pago_anti_pag += $pagoAntic;
	$subtotal_pago_2anti_pag += $rowSobreAntic['SOBRE_ANTICIPO'];
	$subtotal_vr_saldo += $row_egresoCanc['CREDITO'];
	$subtotal_vr_fact += $row_fact['SUB_TOTAL'];
	$subtotal_comision += $VComision;
	$subtotal_rentab += $RentaPorcent;

	$total_valor_flete += $row_despacho['FLETE_TOTAL_TRANS'];
	$total_pago_anti_pag += $row_despacho['PAGO_ANTICIPADO'];
	$total_pago_2anti_pag += $rowSobreAntic['SOBRE_ANTICIPO'];
	$total_vr_saldo += $row_egresoCanc['CREDITO'];
	$total_vr_fact += $row_fact['SUB_TOTAL'];
	$total_comision += $VComision;
	$total_rentab += $RentaPorcent;

	$cont++;
	$conts++;

	$mcAct = $row_despacho['NUMERO_MANIFIESTO'];

	}while($row_despacho=mysql_fetch_assoc($despacho));
	// <-- do{}while();

	echo "      <tr bgcolor='#E9E7E2' class='Imprimir_Sen2'>\n";
	echo "        <td>SUBTOTALES</td>\n";
	echo "        <td>&nbsp;</td>\n";
	echo "        <td>&nbsp;</td>\n";
	echo "        <td>&nbsp;</td>\n";
	echo "        <td>&nbsp;</td>\n";
	echo "        <td>&nbsp;</td>\n";
	echo "        <td>&nbsp;</td>\n";
	echo "        <td>&nbsp;</td>\n";
	echo "        <td align='right'>".number_format($subtotal_valor_flete,0,'.','.')."</td>\n";
	echo "        <td>&nbsp;</td>\n";
	echo "        <td align='right'>".number_format($subtotal_pago_anti_pag,0,'.','.')."</td>\n";
	echo "        <td align='right'>".number_format($subtotal_pago_2anti_pag,0,'.','.')."</td>\n";

	$i=0;
	mysql_data_seek($Descuento, 0);
	while($rowDescuento = mysql_fetch_assoc($Descuento))
		{
		echo "        <td align='right'>".number_format($AcumDesc[$i],0,'.','.')."</td>";
		$i++;
		}

	echo "        <td>&nbsp;</td>\n";
	echo "        <td>&nbsp;</td>\n";
	echo "        <td>&nbsp;</td>\n";
	echo "        <td align='right'>".number_format($subtotal_vr_saldo,0,'.','.')."</td>\n";
	echo "        <td align='right'>&nbsp;</td>\n";
	echo "        <td align='right'>&nbsp;</td>\n";
	echo "        <td align='right'>".number_format($subtotal_vr_fact,0,'.','.')."</td>\n";
	echo "        <td align='right'>".number_format($subtotal_comision,0,'.','.')."</td>\n";
	echo "        <td align='right'>".number_format(($subtotal_rentab*100)/$num_cut,2,',','.')."</td>\n";
	echo "      </tr>\n";

	echo "      <tr bgcolor='#E9E7E2' class='Imprimir_Sen2'>\n";
	echo "        <td>TOTALES</td>\n";
	echo "        <td>&nbsp;</td>\n";
	echo "        <td>&nbsp;</td>\n";
	echo "        <td>&nbsp;</td>\n";
	echo "        <td>&nbsp;</td>\n";
	echo "        <td>&nbsp;</td>\n";
	echo "        <td>&nbsp;</td>\n";
	echo "        <td>&nbsp;</td>\n";
	echo "        <td align='right'>".number_format($total_valor_flete,0,'.','.')."</td>\n";
	echo "        <td>&nbsp;</td>\n";
	echo "        <td align='right'>".number_format($total_pago_anti_pag,0,'.','.')."</td>\n";
	echo "        <td align='right'>".number_format($total_pago_2anti_pag,0,'.','.')."</td>\n";

	$i=0;
	mysql_data_seek($Descuento, 0);
	while($rowDescuento = mysql_fetch_assoc($Descuento))
		{
		echo "        <td align='right'>".number_format($AcumTotDesc[$i],0,'.','.')."</td>";
		$i++;
		}
	echo "        <td>&nbsp;</td>\n";
	echo "        <td>&nbsp;</td>\n";
	echo "        <td>&nbsp;</td>\n";
	echo "        <td align='right'>".number_format($total_vr_saldo,0,'.','.')."</td>\n";
	echo "        <td align='right'>&nbsp;</td>\n";
	echo "        <td align='right'>&nbsp;</td>\n";
	echo "        <td align='right'>".number_format($total_vr_fact,0,'.','.')."</td>\n";
	echo "        <td align='right'>".number_format($total_comision,0,'.','.')."</td>\n";
	echo "        <td align='right'>".number_format($total_rentab*100,2,',','.')."</td>\n";
	echo "      </tr>\n";

	echo "    </table>\n";
	echo "  </body>\n";
	echo "</html>\n";
?>