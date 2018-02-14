<div>
    <h2>Criterios de decisión de las subcaracterísticas</h2>
</div>
<hr>
<?php
//Muestra cartel exito/error
if ($this->session->flashdata('ExitoNiveles')) {
    ?>
    <div class="alert alert-success">
    <?php echo $this->session->flashdata('ExitoNiveles'); ?>
    </div>
<?php } else {
    if ($this->session->flashdata('ErrorNiveles')) {
        ?>
        <div class="alert alert-danger">
        <?php echo $this->session->flashdata('ErrorNiveles'); ?>    
        </div>
    <?php
    }
}
?>
<div class="col-lg-12">	
    <div class="form-group">
        <span>Seleccione una característica:</span>
    </div>
    <div class="form-group">
        <select class="form-control" id="partes" onchange="cargarCriteriosSubcaracteristicas(value)">
            <option value="0">Seleccione una característica</option>
    <?php   foreach ($caracteristicas->result_array() as $c){ ?>
                <option value="<?php echo $c['idCaracteristica']?>"><?php echo $c['nombre']?></option>      
    <?php   } ?>       
        </select>
    </div>
    <hr> 
    <div id="criterios" style="display: none;">
         <div class="form-group">
            <span>Establezca los criterios de decisión para las subcaracterísticas de <strong><?php echo "acomodar"?></strong>:</span>
         </div> 
         <table class="table table-bordered">
            <thead class="color_panel4">
                <tr align="center">
                    <td class="tamaño_criterio_decision">Inaceptable</td>
                    <td class="tamaño_criterio_decision">Mínimamente aceptable</td>
                    <td class="tamaño_criterio_decision">Rango objetivo</td>
                    <td class="tamaño_criterio_decision">Excede los requerimientos</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="center">
                        Valor máximo: 
                        <select class="form-control tamaño_criterio_select" id="inaceptable"> 
<?php for ($i = 1; $i <= 7; $i++) { ?> 
                                <option value="0.<?php echo $i; ?>" <?php if ("0." . ($i) == $inaceptable) {
        echo "selected";
    } ?>>0.<?php echo $i; ?></option> 
                            <?php } ?>
                        </select>
                    </td>
                    <td align="center">
                        Valor máximo: 
                        <select class="form-control tamaño_criterio_select" id="min_aceptable"> 
<?php for ($i = 2; $i <= 8; $i++) { ?> 
                                <option value="0.<?php echo $i; ?>" <?php if ("0." . ($i) == $min_aceptable) {
        echo "selected";
    } ?>>0.<?php echo $i; ?></option> 
                            <?php } ?>
                        </select>
                    </td>
                    <td align="center">
                        Valor máximo: 
                        <select class="form-control tamaño_criterio_select" id="aceptable"> 
<?php for ($i = 3; $i <= 9; $i++) { ?> 
                                <option value="0.<?php echo $i; ?>" <?php if ("0." . ($i) == $aceptable) {
        echo "selected";
    } ?>>0.<?php echo $i; ?></option> 
<?php } ?>
                        </select>
                    </td>
                    <td align="center">
                        Valor máximo: 
                        <select class="form-control tamaño_criterio_select" id="excede"> 
                            <option value="1" selected disabled>1</option>
                        </select>
                    </td>
                </tr>			
            </tbody>		
        </table>
        <br>
        <table class="table table-bordered">
            <thead class="color_panel4">
                <tr align="center">
                    <td rowspan="2" style="vertical-align: middle;" >Subcaracterística</td>
                    <td colspan="4">Niveles</td>
                    <td rowspan="2" style="width: 15%"></td>
                </tr>
                <tr align="center">
                    <td style="font-size:80%; vertical-align: middle;">Inaceptable</td>
                    <td style="font-size:80%; vertical-align: middle;">Mín. aceptable</td>
                    <td style="font-size:80%; vertical-align: middle;">Aceptable</td>
                    <td style="font-size:80%; vertical-align: middle;">Excede los req.</td>
                </tr>
            </thead>
            <tbody>
<?php foreach ($subcaracteristicas->result_array() as $s) { ?>
                    <tr>				
                        <td align="center" style="vertical-align: middle;"><?php echo $s['nombre'] ?></td>
    <?php
    foreach ($asignado as $a) {
        if ($a['id'] == $s['idSubcaracteristica']) {
            $sub = $a;
        }
    }
    ?>
    <?php if ($sub['asignado']) { ?>
                            <td align="center" style="vertical-align: middle;"> 0.00 - <?php echo $sub['inaceptable'] ?>0</td>
                            <td align="center" style="vertical-align: middle;"> <?php echo ($sub['inaceptable'] + 0.01) ?> - <?php echo $sub['min_aceptable'] ?>0 </td>
                            <td align="center" style="vertical-align: middle;"> <?php echo ($sub['min_aceptable'] + 0.01) ?> - <?php echo $sub['aceptable'] ?>0 </td>
                            <td align="center" style="vertical-align: middle;"> <?php echo ($sub['aceptable'] + 0.01) ?> - <?php echo $sub['excede'] ?>.00 </td>
                            <td align="center" style="vertical-align: middle;">
                                <button type="button" class="btn btn-warning btn-sm" id="guardar" onclick="guardar_niveles(<?php echo $s['idSubcaracteristica'] ?>)">Modificar</button>
                            </td>
    <?php } else { ?>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="center" style="vertical-align: middle;">
                                <button type="button" class="btn btn-success btn-sm" id="guardar" onclick="guardar_niveles(<?php echo $s['idSubcaracteristica'] ?>)">Asignar</button>
                            </td>
    <?php } ?>	
                    </tr>	
<?php } ?>				
            </tbody>		
        </table>	
    </div>
</div>