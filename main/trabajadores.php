<?php

require("funciones/menu.php");

session_start();

//seguridad extra
if ($_SESSION['nivel']== "1" || $_SESSION['nivel']=="2") {


    if ($_SESSION['nivel'] == "1") {
    //asignamos menu
    $menu = getMenuAdmin();
    
    }else{   
    //asignamos menu
    $menu = getMenuUser();
    }



    try {
    require_once('funciones/conexion.php');
    require_once('funciones/funcs.php');
    if (!isset($_SESSION['nivel'])) {
        header('Location: ../index.php');
    }
    $arturo = 1;
    $edi = 2;
    $abi = 3;
    $chu = 4;
    $hip = 5;
    $timeobj = new DateTimeZone('America/Mexico_City');
    $timeobjeto = new DateTime('now', $timeobj);
    $timetrab = $timeobjeto->format('m-j-y');

   $sqcountgod = "SELECT COUNT(*) AS buenas FROM `reparaciones` WHERE rep_daterev LIKE '01%' AND trab_id = 1 AND rep_costo > 0;";
   $coutmasArt = $con->prepare($sqcountgod);
    $coutmasArt->execute();
    $coutmasArt->store_result();

    $sqcountbad = "SELECT COUNT(*) AS cero FROM `reparaciones` WHERE rep_daterev LIKE '01%' AND trab_id = 1 AND rep_costo = 0;";
   $coutcerArt = $con->prepare($sqcountbad);
    $coutcerArt->execute();
    $coutcerArt->store_result();

    $sqcountsum = "SELECT SUM(rep_costo) FROM `reparaciones` WHERE rep_daterev LIKE '01%' AND trab_id = 1 AND rep_costo > 0";
    $coutsumArt = $con->prepare($sqcountsum);
    $coutsumArt->execute();
    $coutsumArt->store_result();
    
    
   /*
SELECT COUNT(*) FROM `reparaciones` WHERE rep_date LIKE '01%' AND trab_id = 0 AND rep_costo = 0;
SELECT COUNT(*) FROM `reparaciones` WHERE rep_date LIKE '01%' AND trab_id = 0 AND rep_costo > 0;
SELECT COUNT(*) FROM `reparaciones` WHERE rep_date LIKE '01%' AND trab_id = 1;
SELECT COUNT(*) FROM `reparaciones` WHERE rep_date LIKE '01%' AND trab_id = 1 AND rep_costo = 0;
SELECT COUNT(*) FROM `reparaciones` WHERE rep_date LIKE '01%' AND trab_id = 1 AND rep_costo > 0;
SELECT COUNT(*) FROM `reparaciones` WHERE rep_date LIKE '01%' AND trab_id = 2;
SELECT COUNT(*) FROM `reparaciones` WHERE rep_date LIKE '01%' AND trab_id = 2 AND rep_costo = 0;
SELECT COUNT(*) FROM `reparaciones` WHERE rep_date LIKE '01%' AND trab_id = 2 AND rep_costo > 0;";*/
    

    $sqAr = "SELECT rep_imp, rep_mod, rep_diagnostico, rep_costo FROM `reparaciones` WHERE trab_id = 1 AND rep_daterev like '%$timetrab%' ORDER BY rep_daterev DESC";
    $sqEd = "SELECT rep_imp, rep_mod, rep_diagnostico, rep_costo FROM `reparaciones` WHERE trab_id = 2 AND rep_daterev like '%$timetrab%' ORDER BY rep_daterev DESC";
    $sqAb = "SELECT rep_imp, rep_mod, rep_diagnostico, rep_costo FROM `reparaciones` WHERE trab_id = 3 AND rep_daterev like '%$timetrab%' ORDER BY rep_daterev DESC";
    $sqCh = "SELECT rep_imp, rep_mod, rep_diagnostico, rep_costo FROM `reparaciones` WHERE trab_id = 4 AND rep_daterev like '%$timetrab%' ORDER BY rep_daterev DESC";
    $sqHi = "SELECT rep_imp, rep_mod, rep_diagnostico, rep_costo FROM `reparaciones` WHERE trab_id = 5 AND rep_daterev like '%$timetrab%' ORDER BY rep_daterev DESC";
    /*$sq = "SELECT COUNT(*) FROM `reparaciones` WHERE trab_id = 1 AND rep_daterev LIKE '%$timetrab%';";
    $sq .= "SELECT rep_imp, rep_mod, rep_diagnostico, rep_costo FROM `reparaciones` WHERE trab_id = 2 AND rep_daterev LIKE '%$timetrab%';";
    $sq .= "SELECT COUNT(*) FROM `reparaciones` WHERE trab_id = 2 AND rep_daterev LIKE '%$timetrab%';";
    $sq .= "SELECT rep_imp, rep_mod, rep_diagnostico, rep_costo FROM `reparaciones` WHERE trab_id = 3 AND rep_daterev LIKE '%$timetrab%';";
    $sq .= "SELECT COUNT(*) FROM `reparaciones` WHERE trab_id = 3 AND rep_daterev LIKE '%$timetrab%';";
    $sq .= "SELECT rep_imp, rep_mod, rep_diagnostico, rep_costo FROM `reparaciones` WHERE trab_id = 4 AND rep_daterev LIKE '%$timetrab%';";
    $sq .= "SELECT COUNT(*) FROM `reparaciones` WHERE trab_id = 4 AND rep_daterev LIKE '%$timetrab%';";
    $sq .= "SELECT rep_imp, rep_mod, rep_diagnostico, rep_costo FROM `reparaciones` WHERE trab_id = 5 AND rep_daterev LIKE '%$timetrab%';";
    $sq .= "SELECT COUNT(*) FROM `reparaciones` WHERE trab_id = 5 AND rep_daterev LIKE '%$timetrab%';";*/

    
    $sql = "SELECT * FROM trabajadores";
    //$sql = "SELECT l.nombre, l.autor, l.editorial, l.edicion, l.archivo, l.precio, u.nombre FROM libros l INNER JOIN clientes u ON l.clienteid = u.clienteid";
    $res = $con->prepare($sql);
    $res->execute();
    $res->store_result();

    $resAr = $con->prepare($sqAr);
    $resAr->execute();
    $resAr->store_result();

    $resEd = $con->prepare($sqEd);
    $resEd->execute();
    $resEd->store_result();

    $resAb = $con->prepare($sqAb);
    $resAb->execute();
    $resAb->store_result();

    $resCh = $con->prepare($sqCh);
    $resCh->execute();
    $resCh->store_result();

    $resHi = $con->prepare($sqHi);
    $resHi->execute();
    $resHi->store_result();
    $error = array();
    } catch (\Throwable $th) {
    //throw $th;
    }
    ?>
    <!doctype html>
    <html lang="en">
  <head>
  <meta charset="UTF-8">
    <meta name="FormularioUsuarios" content="Usuarios">
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
        <!--<div class="headerr"><img src="../img/logoMaster.jpg" alt=""></div>
    -->
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
            $mod = "libros";
            $menu2 = dabase($mod);
            echo $menu2;
        
            ?>
        </div>

<!-- para ejemplo simple -->

<article class="reparaciones">
<div class="trabajador">
    <h1>Arturo</h1>
    
    <?php
    $coutmasArt->bind_result($maqmas);
    $coutcerArt->bind_result($maqcer);
    $coutsumArt->bind_result($suma);

    if ($resAr->num_rows>0 && $coutmasArt->num_rows>0 && $coutcerArt->num_rows>0) {
        $resAr->bind_result($imp,$mod,$diag,$cost);
       /*$coutmasArt->bind_result($maqmas);*/
       
        
        ?>

        <?php
        $i=1;
        while ($resAr->fetch()){
            
            
            echo '<div class="sendGreen">'.$i.' </div>'.$imp .' '. $mod. ' '. $diag . ' $' . $cost . '</br>';
            $i++;
        }
        ?>
         <div class="action3">
        <div class="sendinline">
            <h2>
                <?php while ($coutmasArt->fetch()){
                    echo $maqmas;
                } ?>
            
             </h2>
        </div>
        <div class="sendinlinegreen">
            <h3>
                <?php while ($coutsumArt->fetch()){
                    echo '$'. $suma;
                } ?>
            
             </h3>
        </div>
        <div class="sendinlinered">
            <h2>
                <?php while ($coutcerArt->fetch()){
                    echo $maqcer;
                } ?>
            
             </h2>
        </div>
         </div>
        
        <?php
        
        
    }else echo 'No ha trabajado'; 
    ?>   
</div>
<div class="trabajador">
    <h1>Edibaldo</h1>
    
    <?php
    if ($resEd->num_rows>0) {
        $resEd->bind_result($imp,$mod,$diag,$cost);
        ?>

        <?php
        while ($resEd->fetch()){
            
            
            echo '■ '.$imp .' '. $mod. ' '. $diag . ' $' . $cost . '</br>';
                
        }
        ?>
        
        <?php
        
    }else echo 'No ha trabajado';   
    ?>   
    </br>
</div>
<div class="trabajador">
    <h1>Abimael</h1>
    
    <?php
    if ($resAb->num_rows>0) {
        $resAb->bind_result($imp,$mod,$diag,$cost);
        ?>

        <?php
        while ($resAb->fetch()){
            
            
            echo '■ '.$imp .' '. $mod. ' '. $diag . ' $' . $cost . '</br>';
                
        }
        ?>
        
        <?php
        
    }else echo 'No ha trabajado';   
    ?>   
</div>
<div class="trabajador">
    <h1>Chuy</h1>
    
    <?php
    if ($resCh->num_rows>0) {
        $resCh->bind_result($imp,$mod,$diag,$cost);
        ?>

        <?php
        while ($resCh->fetch()){
            
            
            echo '■ '.$imp .' '. $mod. ' '. $diag . ' $' . $cost . '</br>';
                
        }
        ?>
        
        <?php
        
    }else echo 'No ha trabajado';   
    ?>   
</div>
<div class="trabajador">
    <h1>Hipolito</h1>
    
    <?php
    if ($resHi->num_rows>0) {
        $resHi->bind_result($imp,$mod,$diag,$cost);
        ?>

        <?php
        while ($resHi->fetch()){
            
            
            echo '■ '.$imp .' '. $mod. ' '. $diag . ' $' . $cost . '</br>';
                
        }
        ?>
        
        <?php
        
    }else echo 'No ha trabajado';   
    ?>   
</div>
<div class="trabajador">
    <h1>-----</h1>
</div>

     
    
    <!--<div class="trabajador">
    </div>-->
</article>


<table id="example" class="display" style="width:100%">
        <thead>
            <tr>                
                
                
                <th>Nombre</th>
                <th>reparaciones</th>
                <!--<th>Salary</th>-->
            </tr>
        </thead>
        <tbody>
        <?php


                        if ($res->num_rows>0) {
                            $res->bind_result($id,$nombre,$reparaciones);
                            //$res->bind_result($nombre,$autor,$editorial,$edicion,$archivo,$precio,$idcli);
                            while ($res->fetch()) {
                             ?>
                            
                            <!--<th>-->
                            <tr>
                                
                                
                                <td>
                                    <?php echo $nombre;?>
                                </td>
                                <td>
                                    <?php echo $reparaciones;?>
                                </td>
                                
                            </tr>
                            <!--</th>-->
                            <?php
                } }else {$error[] = " no hay ningun trabajador guardado";}

                if (count($error)> 0) {
                    echo "<div class='error'>";
                    foreach ($error as $mal){
                        echo "<i class='fas fa-exclamation-circle'></i>".$mal."<br>";
                    }
                    echo "</div>";
                }
                        
                        $con->close();
                        ?>
            
        </tbody>
        <tfoot>
            <tr>
                <!--<th>Id</th>-->
                <th>Nombre</th>
                <th>reparaciones</th>
                <!--<th>Salary</th>-->
            </tr>
        </tfoot>
    </table>
  </div>
  <div class="btn-add">
        <a href="$"><i class="fas fa-plus-circle"></i></a>
    </div>

<footer class="last">Bienvenido <?php echo strtoupper($_SESSION['name'])?></footer>

<!--<script src="" async defer></script>-->

<div class="btn-add">
        <a href="db/trab/insertar.php"><i class="fas fa-plus-circle"></i></a>
    </div>

    <script>
const head = document.querySelector('.lisTrab');
    head.classList.add('current');
    console.log(head);</script>



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
    </script>
  </body>
</html>
<?php } else{
    define("inicio","../index.php?msj=id-denegado");
    header("location: ".inicio);
}?>