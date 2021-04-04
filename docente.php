<?php
include "cabecera.inc.php";
include "menu.inc2.php";
include "conexion.inc.php";

    session_start();

    if(!isset($_SESSION['rol'])){
        header('location: login.php');
    }else{
        if($_SESSION['rol'] != 1){
            header('location: login.php');
        }
    }
    if(isset($_SESSION['ci'])){
        $ci = $_SESSION['ci'];
        
    }
    $rescolor = mysqli_query($con, "select * from color");

    //pregunta 4, sin case-when

    $persona = mysqli_query($con, "select * from persona");
    $nota = mysqli_query($con, "select * from nota");
    $siglas = mysqli_query($con, "SELECT distinct sigla FROM nota");
    $sigla = array('INF-111','INF-324');
    $pos=0;
    //pregunta 5, con case-when


    $con_casewhen = mysqli_query($con, "SELECT
		AVG(case WHEN departamento='01' then (SELECT notafinal from nota where ci=p.ci and sigla='inf-111') end) CH,
		AVG(case WHEN departamento='02' then (SELECT notafinal from nota where ci=p.ci and sigla='inf-111') end) LP,
		AVG(case WHEN departamento='03' then (SELECT notafinal from nota where ci=p.ci and sigla='inf-111') end) CB,
		AVG(case WHEN departamento='04' then (SELECT notafinal from nota where ci=p.ci and sigla='inf-111') end) as 'OR',
		AVG(case WHEN departamento='05' then (SELECT notafinal from nota where ci=p.ci and sigla='inf-111') end) PT,
		AVG(case WHEN departamento='06' then (SELECT notafinal from nota where ci=p.ci and sigla='inf-111') end) TJ,
		AVG(case WHEN departamento='07' then (SELECT notafinal from nota where ci=p.ci and sigla='inf-111') end) SC,
		AVG(case WHEN departamento='08' then (SELECT notafinal from nota where ci=p.ci and sigla='inf-111') end) BE,
		AVG(case WHEN departamento='09' then (SELECT notafinal from nota where ci=p.ci and sigla='inf-111') end) PD
		from persona p
		union all
		select
		AVG(case WHEN departamento='01' then (SELECT notafinal from nota where ci=p.ci and sigla='inf-324') end) CH,
		AVG(case WHEN departamento='02' then (SELECT notafinal from nota where ci=p.ci and sigla='inf-324') end) LP,
		AVG(case WHEN departamento='03' then (SELECT notafinal from nota where ci=p.ci and sigla='inf-324') end) CB,
		AVG(case WHEN departamento='04' then (SELECT notafinal from nota where ci=p.ci and sigla='inf-324') end) as 'OR',
		AVG(case WHEN departamento='05' then (SELECT notafinal from nota where ci=p.ci and sigla='inf-324') end) PT,
		AVG(case WHEN departamento='06' then (SELECT notafinal from nota where ci=p.ci and sigla='inf-324') end) TJ,
		AVG(case WHEN departamento='07' then (SELECT notafinal from nota where ci=p.ci and sigla='inf-324') end) SC,
		AVG(case WHEN departamento='08' then (SELECT notafinal from nota where ci=p.ci and sigla='inf-324') end) BE,
		AVG(case WHEN departamento='09' then (SELECT notafinal from nota where ci=p.ci and sigla='inf-324') end) PD
		from persona p");

?>

<div id="right" style="background-color:#<?php echo $_SESSION['color'];?>;">
    <h2>Bienvenido a la Facultad de Ciencias Puras y Naturales</h2>
    <table style="font-size:25px">
            <tr>
                <td>
                <a href="informatica/">Informática</a>
                </td>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td>
                <a href="quimica/">Química</a>
                </td>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td colspan="2">
                <a href="fisica/">Física</a>
                </td>
            </tr>
            
        </table>
    <div id="welcome"> 
      
      
      <p class="more"></p>
      <form action="cambiar_color.php" method="POST">
        <select id="color" name="color">
          
         <?php
while ($filacolor = mysqli_fetch_array($rescolor))
{
?>
<option value="<?php echo $filacolor[0];?>"><?php echo $filacolor[2];?></option>
<?php
};
?>
        </select>
        <input type="submit" value="cambiar color">
      </form>
      <h1>PROMEDIO NOTAS</h1>
     

  



      <h2 style="color:red;"><strong>5. <u>Con case-when</u></strong></h2>
      
      <div>
      	<table style="width:100%; border="1px solid black"; ">
        <tr bgcolor="orange">
            <th></th>
            <th>CH</th>
            <th>LP</th>
            <th>CB</th>
            <th>OR</th>
            <th>PT</th>
            <th>TJ</th>
            <th>SC</th>
            <th>BE</th>
            <th>PD</th>
            
        </tr>
        <?php
        while ($ccase = mysqli_fetch_array($con_casewhen))
        {
        echo "<tr bgcolor='white'>";
        echo "<td>".$sigla[$pos]."</td>";
        echo "<td>".$ccase["CH"]."</td>";
        echo "<td>$ccase[LP]</td>";
        echo "<td>$ccase[CB]</td>";
        echo "<td>$ccase[OR]</td>";
        echo "<td>$ccase[PT]</td>";
        echo "<td>$ccase[TJ]</td>";
        echo "<td>$ccase[SC]</td>";
        echo "<td>$ccase[BE]</td>";
        echo "<td>$ccase[PD]</td>";

        echo "</tr>";
        $pos=$pos+1;
        }
        ?>
      </table>
      </div>
    </div>
   
  </div>

  <div class="clear"> </div>
  <div id="spacer"> </div>
    
<?php

include "pie.inc.php";
?>