
<?php

include("funciones/menu.php");
session_start();

//seguridad extra
if ($_SESSION['nivel']== "1" || $_SESSION['nivel']=="2") {


if ($_SESSION['nivel'] == "1") {
    //asignamos menu
    $menu = getMenuAdmin();
    
}
else{   
    //asignamos menu
    $menu = getMenuUser();
}


require('funciones/conexion.php');
require('funciones/funcs.php');
if (!isset($_SESSION['nivel'])) {
    header('Location: ../index.php');
}
//



//$sql = "SELECT * FROM reparaciones";
//$sql = "SELECT c.cli_nom, c.cli_tel, r.rep_imp, r.rep_mod, r.rep_falla, r.rep_sta, t.trab_id, r.rep_diagnostico, r.rep_costo, r.rep_date, r.rep_aviso, r.rep_garantia FROM reparaciones r INNER JOIN clientes c ON r.cli_id = c.cli_id INNER JOIN trabajadores t ON r.trab_id = t.trab_id";
//$sql = "SELECT c.cli_nom, c.cli_ape, c.cli_tel, r.rep_id, r.rep_imp, r.rep_mod, r.rep_falla, r.rep_sta, r.rep_diagnostico, t.trab_nom, r.rep_costo, r.rep_date, r.rep_aviso, r.rep_garantia FROM reparaciones r INNER JOIN clientes c ON r.cli_id = c.cli_id INNER JOIN trabajadores t ON r.trab_id = t.trab_id";
$sql = "SELECT c.cli_nom, c.cli_ape, c.cli_tel, r.rep_id, r.rep_imp, r.rep_mod, r.rep_serial, r.rep_falla, r.rep_sta, r.rep_diagnostico,  r.rep_costo, r.rep_date, r.trab_id FROM reparaciones r INNER JOIN clientes c ON r.cli_id = c.cli_id WHERE r.rep_sta = 'p' OR r.rep_sta = 't'";


$res = $con->prepare($sql);
$res->execute();
$res->store_result();
$error = array();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="FormularioUsuarios" content="Inventario">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Intranet</title>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <link href="style.css" rel="stylesheet" type="text/css">
    <!--<link href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />-->
    <link href="fontawesomeweb/css/all.min.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="../intranet.js"> </script>
    <!--<script type="text/javascript" src="dataTables.bootstrap.js"></script>-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <!-- datatables extension SELECT -->
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    <!-- extension BOTONES -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">

   <style>
   table.dataTable thead, table.dataTable tfoot {
           background: linear-gradient(to right, #3F5EFB, #FC466B);
       }
   </style>


</head>
<body>
<div class="container">
<header>
<!--<div class="headerr"><img src="../img/logocopycentro.pn" alt=""></div>-->
<div class="logo">
    <a href="index.php"><img src="../img/logomasterp.png" alt=""></a>
</div>
    
    <h2>Bienvenido, Master <?php //($_SESSION['name'])?></h2>
    <div class="closeSession">
    <a href="../login/salir.php">Cerrar sesión</a>
    </div>
</header>
<?php
    echo $menu;
?>
</br>
<div class="menu2">
<?php 
    $mod = "clientes";
    $menu2 = dabase($mod);
    echo $menu2;

?>

</div>

<div class="jumbotron barra">
        <?php
       
        ?>
        <article class="center">
        <?php
            /*if ($resart) {*/
                //$resart->bind_result($rep_id,$cliente,$impresora,$modelo,$serial,$falla,$status,$tecnico,$diagnostico,$costo,$fechai,$aviso,$garantia,$fechaf);
                
           // } ?>
           <h1>Pendientes y taller</h1>

        </article>

        <article>

        

        <table id="example" class="table table-striped table-bordered" cellspading="0" width="100%">
                    <thead>
                        <th>Cliente</th>
                        <th>Impresora</th>  
                        <th>Falla</th>
                        <th>Status <br/><sub>Taller <br/>Bodega<br/>Entregado Garantia</sub></th>
                        
                        <th>Diagnostico</th>
                            
                        <th>Costo</th>
                        <th>Fecha</th>
                       
                    </thead>
                    <tbody>
                        <?php
                        if ($res->num_rows>0) {
                            //$res->bind_result($rep_id,$cliente,$impresora,$modelo,$serial,$falla,$status,$tecnico,$diagnostico,$costo,$fechai,$aviso,$garantia,$fechaf);
                            $res->bind_result($cliente,$apellido,$telefono,$rep_id,$imp_marca,$imp_modelo,$serial,$falla,$status,$diagnostico,$costo,$fecha,$trabajador);
                        while ($res->fetch()) { ?>
                            
                            <tr>
                            <td>
                                <?php echo $cliente.' '.$apellido. '</br> <h5>'.$telefono.'<h5>';?>
                                </td>
                                
                                
                                <td>
                                    <?php echo $imp_marca.' '.$imp_modelo.'</br> n/s '.$serial.'<br/>'; switch ($trabajador) {
                                        case 1:
                                            echo '<h5 class=\'red\'>Arturo<h5>';
                                            break;
                                        case 2:
                                            echo '<h5 class=\'red\'>Edibaldo<h5>';
                                            break;
                                        case 3:
                                            echo '<h5 class=\'red\'>Abimael<h5>';
                                            break;
                                        case 4:
                                            echo '<h5 class=\'red\'>Chuy<h5>';
                                            break;
                                        case 5:
                                            echo '<h5 class=\'red\'>Hipolito<h5>';
                                            break;
                                        default:
                                            echo '<h5 class=\'red\'>Sin revisar<h5>';
                                            break;
                                    } $trabajador;?>
                                </td>
                                <td>
                                
                                    <?php echo $falla;?>
                                    <form action="db/rep/modificar.php" method="POST">
                                    <textarea name="falla" maxlength="350" id="" cols="10" rows="1"></textarea></br>
                                    <input type="number" value="<?php echo $rep_id?>" name="id" hidden>
                                    <input type="submit" name="sendF" value="Modificar" id="">
                                    <!--<div class="action">
                                        <div class="sucessmn ns">
                                            <a href="db/rep/modificar.php?id=&fa=<?php // echo $falla?>"><i class="fas fa-retweet"></i></a>
                                        </div>
                                    </div>-->
                                    </form>
                                    
                                </td>
                                <td>
                                <h3><?php echo $status;?></h3>
                                <div class="action grid">
                                <div class="sucessmn ns">
                                    <a href="db/rep/statust.php?id= <?php echo $rep_id ;?>"><h3>  T</h3></a>
                                </div>
                                <div class="errormn ns">
                                    <a href="db/rep/statusb.php?id= <?php echo $rep_id;?>"><h3>  B</h3></a>
                                </div>
                                <div class="errormn ns te">
                                <a href="db/rep/statuse.php?id= <?php echo $rep_id ;?>"><h3>  E</h3></a>
                                <!--</div>
                                <div class="sucessmn ns">
                                    <a href="db/rep/statusg.php?id= <?php echo $rep_id ;?>"><h3>  G</h3></a>
                                </div>
                                </div>-->
                                </td>
                                 
                                <td>
                                <?php echo $diagnostico;?>
                                <form action="db/rep/modificar.php" method="POST">
                                    <textarea name="diagnostico" maxlength="180" id="" cols="10" rows="1"></textarea></br>
                                    <input type="number" value="<?php echo $rep_id?>" name="id" hidden>
                                    <input type="submit" name="sendD" value="Modificar" id="">
                                </form>
                                </td>
                                
                                <td> $ <?php echo $costo;?>
                                <form action="db/rep/modificar.php" method="POST">
                                        <input type="number" min="0" max="9999" class="short" name="precio">
                                        <input type="number" value="<?php echo $rep_id?>" name="id" hidden>
                                    
                                        <input type="submit" class="short" value="$$$" name="sendM">
                                </form>
                            
                                </td>
                                <td> <?php echo $fecha;?></td>
                            </tr>
                            
                            <?php
                }
                }else {$error[] = " no hay ninguna reparacion";}

                if (count($error)> 0) {
                    echo "<div class='error'>";
                    foreach ($error as $mal){
                        echo "<i class='fas fa-exclamation-circle'></i>".$mal."<br>";
                    }
                    echo "</div>";
                }
                        
                       // $con->close();
                        ?>
                    </tbody>
                    <tfoot>
                    <th>Cliente</th>
                        <th>Impresora</th>  
                        <th>Falla</th>
                        <th>Status</th>
                        
                        <th>Diagnostico</th>  
                         
                        <th>Costo</th>
                        <th>Fecha</th>
                    </tfoot>
                </table>
                </article>
               

    </div>

</div>  


            

<footer class="last">Bienvenido <?php echo $_SESSION['name']?></footer>

<!--<div class="btn-add">
        <a href="db/cli/insertar.php"><i class="fas fa-plus-circle"></i></a>
    </div>
            -->
<script>
const head = document.querySelector('.lisCli');
    head.classList.add('current');
    </script>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

     <!-- datatables-->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    
    <!-- datatables extension SELECT -->
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    
    <!-- extension BOTONES -->
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>

    <script>
     $(document).ready(function(){
         $("#example").dataTable({
             // 1 - inicializacion
              select:true,  
              
              //2 - tipo de selección 
              /*select:{
                  style:'sinlge' //single o multi
              }*/
                
               // 3 - fila o celda 
              /*select:{            
                items:'cell' //cell o row      
              }*/

            //4 - uso del checkbox
            /* columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            } ],
            select: {
                style:    'os',
                selector: 'td:first-child'
            },  */
            
            //5 - cambio de idioma     
            // language: {
            //     select: {
            //         rows: {
            //             _: "Ud. seleccionó %d registros", //msj cuando todavia no seleccionó nada
            //             0: "Haga clic en una fila para seleccionarla.", //aviso
            //             1: "Solo 1 fila seleccionada" //aviso
            //         }
            //     }
            // }


            // 6 - uso de botones
            /*dom: 'Bfrtip',
                buttons: [
                    'selected',
                    'selectedSingle',
                    'selectAll',
                    'selectNone',
                    'selectRows',
                    'selectColumns',
                    'selectCells'
                ],*/

         });
     })
     $(document).ready(function(){
         $("#examples").dataTable({
             // 1 - inicializacion
              select:true,  
              

         });
     })
    </script>
</body>
</html>
<?php


}else{
    define("inicio","../index.php?msj=id-denegado");
    header("location: ".inicio);
}
?>