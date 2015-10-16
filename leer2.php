<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>::: RFID ACCESS CONTROL BASED ON B.B :::</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/JavaScript">
<!--

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
<link href="estilos.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="566" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td align="left" valign="top"><table width="566" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left" valign="top"><img name="cabezote" src="img/cabezote.jpg" width="566" height="113" border="0" id="cabezote" alt="company" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="bottom"><table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <td width="8" align="left" valign="top" background="img/izq.jpg"><img name="izq" src="img/izq.jpg" width="8" height="16" border="0" id="izq" alt="fondo" /></td>
        <td colspan="2" align="left" valign="bottom" class="textogris"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr class="textotablas">
            <td align="left" valign="top"><p align="center"><strong>BIENVENIDO ESTE ES EL REGISTRO DE LOS USUARIOS QUE HAN INGRESADO</strong></p></td> </tr> </table>          <br />          </td>
        <td width="8" rowspan="3" align="left" valign="top" background="img/der.jpg"><img name="der" src="img/der.jpg" width="8" height="16" border="0" id="der" alt="fondo" /></td>      </tr>
      <tr>
        <td align="left" valign="bottom" background="img/izq.jpg">&nbsp;</td>
        <td colspan="2" align="left" valign="bottom"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr class="textotablas">
            <td align="center" valign="top"><?php

    $columnas = 0;
       $server = "localhost";
    $username = "root";
    $password = "beagle";
    $database = "bdrfid";
    $enlace = mysql_connect($server, $username, $password);
    mysql_select_db($database,$enlace);
    $result = mysql_query("SELECT tabla.codigo, tabla.nombre, tabla.apellido, tabla3.hora FROM tabla, tabla3 WHERE tabla.codigo=tabla3.codigo;", 			$enlace);;

    echo "<table border = '0'>";
    echo "<tr>";
    echo "<td><b>codigo</b></td>";
    echo "<td><b>nombre</b></td>";
    echo "<td><b>apellido</b></td>";
    echo "<td><b>hora</b></td>";
#echo "<td><b>email</b></td>"; 
    #echo "<td><b>dependencia</b></td>";
    #echo "<td><b>edad</b></td>";
    echo "</tr>";
    while ($row = mysql_fetch_row($result)){
    	echo "<tr>";
    	echo "<td>$row[0]</td>";
    	echo "<td>$row[1]</td>";
	echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
	#echo "<td>$row[4]</td>";
    	#echo "<td>$row[5]</td>";
    	echo "</tr>";
    }
    echo "</table>";?></td>          </tr>
        </table></td>        </tr>      <tr>
        <td align="left" valign="bottom" background="img/izq.jpg"><a href="index.html"><img name="CASITA" src="img/leer2.jpg" width="8" height="163" border="0" id="CASITA" alt="casa" /></a></td>
        <td width="208" align="left" valign="bottom"><img name="CASITA" src="img/leer.jpg" width="208" height="163" border="0" id="CASITA" alt="casa" /></td>
        <td width="342" align="left" valign="bottom">&nbsp;</td>
      </tr>    </table></td>
  </tr>  <tr>    <td align="left" valign="top"><img src="img/footerleer.jpg" alt="company" name="cabezote" width="566" height="28" border="0" usemap="#cabezoteMap" id="cabezote" /></td>  </tr>
  <tr class="textofooter">
    <td align="center" valign="top" bgcolor="#000000" class="textofooter">Josafat Piraquive Triana  Ingenieria Electronica<br />
    Proyecto de grado Universidad Nacional De Colombia<br />
    ::Copyright:::Todos los derechos reservados :: @Unal</td>
  </tr> </table> <p>&nbsp;</p>  <p>&nbsp;</p>
<map name="cabezoteMap" id="cabezoteMap"><area shape="rect" coords="508,5,560,26" href="index.html" alt="Inicio" />
</map> </body>
</html>




