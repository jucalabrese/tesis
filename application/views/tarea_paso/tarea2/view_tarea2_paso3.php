<div>
    <h2>Criterios de decisión de las características</h2>
</div>
<hr>
<?php
//Muestra cartel exito/error
if ($this->session->flashdata('ExitoNivelesCar')) {
    ?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata('ExitoNivelesCar'); ?>
    </div>
    <?php
} else {
    if ($this->session->flashdata('ErrorNivelesCar')) {
        ?>
        <div class="alert alert-danger">
            <?php echo $this->session->flashdata('ErrorNivelesCar'); ?>    
        </div>
        <?php
    }
}
?>
<div class="col-lg-12">
    <?php
    if (!empty($caracteristicas)) {
        foreach ($caracteristicas as $c) {
            ?>
            <table class="table table-bordered">
                <thead class="color_panel4">
                    <tr align="center">
                        <td colspan="<?php echo $c['cantidad']; ?>"><?php echo $c['nombre']; ?></td>
                    </tr>
                    <tr align="center">
                        <?php foreach ($c['subcaracteristicas']->result_array() as $s) { ?>
                            <td style="font-size:80%;"><?php echo $s['nombre']; ?></td>
        <?php } ?>  
                    </tr>
                </thead>
                <tbody>
                    <tr>
        <?php foreach ($c['subcaracteristicas']->result_array() as $s) { ?>
                            <td align="center">
                                Esperado: 
                                <select class="form-control tamaño_criterio_select" id="nivel<?php echo $s['nombre']; ?>"> 
                                   <option value="0">Seleccionar</option>
                                   <option value="1">Inaceptable</option>
                                   <option value="2">Minimamente aceptable</option>
                                   <option value="3">Rango objetivo</option>
                                   <option value="4">Excede los requerimientos</option>
                                </select>
                            </td>
        <?php } ?>  
                    </tr>
                </tbody>
                
            </table>
    <button type="button" class="btn btn-success btn-sm" id="guardar" onclick="#">Guardar</button>
    <hr>
        <?php }
    } else {
        ?>
        <div class="form-group">
            <span>No se ha elegido ninguna característica completa para evaluar</span>
        </div> 
<?php } ?>
</div>