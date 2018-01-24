<div>
    <h2>Definir los criterios de decisión para las métricas</h2>
</div>
<hr>
<?php //Muestra cartel exito/error
		if ($this->session->flashdata('ExitoNiveles')) {
		?>
			<div class="alert alert-success">
				<?php echo $this->session->flashdata('ExitoNiveles'); ?>
			</div>
	<?php }
		?>
<div class="col-lg-12">
	<?php foreach ($subcaracteristicas->result_array() as $s){?>
	<div class="form-group">
		<span><?php echo $s['nombre']?>:</span>
	</div>
	<table class="table table-bordered">
		<thead class="color_panel4">
			<tr align="center">
				<td class="tamaño_criterio_decision">Inaceptable</td>
				<td class="tamaño_criterio_decision">Mínimamente aceptable</td>
				<td class="tamaño_criterio_decision">Rango objetivo</td>
				<td class="tamaño_criterio_decision">Excede los requerimientos</td>
				<td style="width: 30%"></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td align="center">
					Valor máximo: 
						<select class="form-control tamaño_criterio_select" id="inaceptable"> 
							 <?php for ($i=1; $i<=7; $i++){?> 
								<option value="0.<?php echo $i;?>" <?php if (($i) == $inaceptable){ echo "selected"; }?>>0.<?php echo $i;?></option> 
							 <?php } ?>
						</select>
				</td>
				<td align="center">
					Valor máximo: 
						<select class="form-control tamaño_criterio_select" id="min_aceptable"> 
							 <?php for ($i=2; $i<=8; $i++){?> 
								<option value="0.<?php echo $i;?>">0.<?php echo $i;?></option> 
							 <?php } ?>
						</select>
				</td>
				<td align="center">
					Valor máximo: 
						<select class="form-control tamaño_criterio_select" id="aceptable"> 
							 <?php for ($i=3; $i<=9; $i++){?> 
								<option value="0.<?php echo $i;?>">0.<?php echo $i;?></option> 
							 <?php } ?>
						</select>
				</td>
				<td align="center">
					Valor máximo: 
						<select class="form-control tamaño_criterio_select" id="excede"> 
							<option value="1" selected disabled>1</option>
						</select>
				</td>
				<td align="center" style="vertical-align: middle;">
					<button type="button" class="btn btn-success" id="guardar" onclick="guardar_niveles(<?php echo $s['idSubcaracteristica']?>)">Guardar</button>
				</td>
			</tr>			
		</tbody>		
	</table>
	<br>
	<?php } ?>
</div>