<div class="container">
    <div class="row misEval_padding">
        <div class="col-md-12">
            <h1 class="page-header">Evaluaciones de <?php echo $this->session->userdata('nombre');?></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>/../inicio/index">Inicio</a></li>
                <li class="active">Mis evaluaciones</li>
            </ol>
        </div>
    </div>
    <div class="row"> 
        <div class="col-md-10 col-md-offset-1">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="css_centrarTabla">Número</th>
                            <th class="css_centrarTabla">Producto</th>
                            <th class="css_centrarTabla">Estado</th>
                            <th class="css_centrarTabla">Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($evaluaciones == false){ ?>
                        <tr>
                            <td colspan="4" align="center">No hay evaluaciones realizadas</td>
                        </tr>
                        <?php }else{
                            foreach ($evaluaciones->result_array() as $e){ 
                                if ($e['estado'] == "Pendiente"){ ?>
                                    <tr class="warning css_centrarTabla">
                          <?php }else{
                                    if ($e['estado'] == "Finalizada"){ ?>
                                        <tr class="success css_centrarTabla">
                              <?php }else{ ?>
                                        <tr class="danger css_centrarTabla">
                              <?php }
                                } ?>
                              <td class="css_tabla_numProd"><?php echo $e['idEvaluacion']?></td>
                              <td class="css_tabla_producto"><?php echo $e['nombre']?></td>
                              <td class="css_tabla_estadoVer"><?php echo $e['estado']?></td>
                              <?php if ($e['estado'] == "Archivada"){ ?>
                                <td class="css_tabla_estadoVer"><a href=# onclick="window.location.href='<?php echo base_url()?>informe/generarInforme/<?php echo $e['idEvaluacion']?>'">Ver</a></td>
                              <?php }else{ ?>
                                <td class="css_tabla_estadoVer"><a href=# onclick="window.location.href='<?php echo base_url()?>evaluacion/ver_evaluacion/<?php echo $e['idEvaluacion']?>'">Ver</a></td>
                              <?php } ?>
                            </tr>
                            <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
            <button class="btn btn-danger" onclick="window.location.href='<?php echo base_url()?>evaluacion/iniciar_evaluacion'">Crear evaluación</button>
        </div>
    </div>
    <div class="col-md-offset-3">
        <div class="pagination">
            <!-- Show pagination links -->
            <?php foreach ($links as $link) {
                echo "<li class='pagination' style='margin-left: 10%'>". $link."</li>";
            } ?>
        </div>
    </div>
</div>