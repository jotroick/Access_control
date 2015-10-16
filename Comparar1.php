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
            <td align="left" valign="top"><p align="center"><strong>CONSULTE SU USUARIO ingresado</strong></p></td> </tr> </table>
          <br />          </td>
        <td width="8" rowspan="3" align="left" valign="top" background="img/der.jpg"><img name="der" src="img/der.jpg" width="8" height="16" border="0" id="der" alt="fondo" /></td>
      </tr>
      <tr>
        <td align="left" valign="bottom" background="img/izq.jpg">&nbsp;</td>
        <td colspan="2" align="left" valign="bottom"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr class="textotablas">
            <td align="center" valign="top"><?
 $columnas = 0;
    $server = "localhost";
    $username = "root";
    $password = "beagle";
    $database = "bdrfid";

   

if ($_POST['buscador'])
{       // Tomamos el valor ingresado
    $buscar1 = $_POST['palabra1'];      // Si está vacío, lo informamos, sino realizamos la búsqueda
      if(empty($buscar1))
      {
      echo "No se ha ingresado una cedula a buscar";
      }else{
      // Conexión a la base de datos y seleccion de registros
      $enlace = mysql_connect($server, $username, $password);
      $sql = "SELECT * FROM tabla WHERE codigo LIKE '%$buscar1%'";
mysql_select_db($database,$enlace); 
$result = mysql_query($sql, $enlace); 
// Tomamos el total de los resultados
$total = mysql_num_rows($result);
// Imprimimos los resultados
if ($row = mysql_fetch_array($result)){ 
echo "Resultados para: <b>V-$buscar</b>";
do { 
?>
<? echo $fetch[10]; ?>
<table border="1" width="362" id="table2" style="border-collapse: collapse">
                <tr>
                    <td width="144"><font face="Tahoma" style="font-size: 10pt">
                    codigo:</font></td>
                    <td align="left">
                    <font face="Tahoma" size="2" color="#008000"><?=$row['codigo'];?></font></td>
                </tr>
                <tr>
                    <td width="144"><font face="Tahoma" style="font-size: 10pt">
                    nombre:</font></td>
                    <td align="left">
                    <font face="Tahoma" size="2" color="#008000"><?=$row['nombre'];?></font></td>
                </tr>'
                <tr>
                    <td width="144"><font face="Tahoma" style="font-size: 10pt">
                    apellido:</font></td>
                    <td align="left">
                    <font face="Tahoma" size="2" color="#008000"><b><?=$row['apellido'];?></b></font></td>
                </tr>
                <tr>
                    <td width="144"><font face="Tahoma" style="font-size: 10pt">
                    email:</font></td>
                    <td align="left">
                    <font face="Tahoma" size="2" color="#008000"><?=$row['email'];?></font></td>
                </tr>

                
                <tr>
                    <td width="144"><font face="Tahoma" style="font-size: 10pt">
                    dependencia:</font></td>
                    <td align="left">
                    <font face="Tahoma" size="2" color="#CC0000"><b><?=$row['dependencia'];?></b></font></td>
                </tr>
                  <tr>
                    <td width="144"><font face="Tahoma" size="2">Porcentaje de 
                    edad:</font></td>
                    <td align="left">
                    <font face="Tahoma" size="2" color="#008000"><?=$row['edad'];?></font></td>
                </tr>
            </table>
                    </tr>
                            <?
} while ($row = mysql_fetch_array($result)); 
echo "<p>Resultados: $total</p>";
} else { 
// En caso de no encontrar resultados
echo "No se encontraron resultados para: <b>$buscar</b>"; 
}
}
}
?>
</td>          </tr>
        </table></td>
</tr>
      <tr>
        <td align="left" valign="bottom" background="img/izq.jpg"><a href="index.html"><img name="CASITA" src="img/contacto.jpg" width="8" height="163" border="0" id="CASITA" alt="casa" /></a></td>
        <td width="208" align="left" valign="bottom"><a href="index.html"><img name="CASITA" src="img/contacto2.jpg" width="240" height="163" border="0" id="CASITA" alt="casa" /></a></td>
        <td width="342" align="left" valign="bottom">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top"><img src="img/footercontacto.jpg" alt="company" name="cabezote" width="566" height="28" border="0" usemap="#cabezoteMap" id="cabezote" /></td>
  </tr>
  <tr align="center" class="textofooter">
    <td valign="top" class="textofooter">Josafat Piraquive Triana  Ingenieria Electronica<br />
   Proyecto de grado Universidad Nacional De Colombia<br />
    ::Copyright:::Todos los derechos reservados :: @Unal</td>
  </tr>
</table>
<p><map name="cabezoteMap" id="cabezoteMap">
    <area shape="rect" coords="508,5,560,26" href="index.html" alt="Inicio" />
  </map>
</p>
</body>
</html>

