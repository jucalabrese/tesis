<div>
    <h2>Tarea 1.4: Definir el rigor de la evaluación</h2>
</div>
<hr>
<?php //Muestra cartel exito/error
        if ($this->session->flashdata('ExitoRigor')){ ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('ExitoRigor'); ?>
            </div>
        <?php } 
 ?>
<div class="col-lg-12">
	<form class="form-horizontal" role="form">
		<h4>Asignación de rigor de la evaluación</h4> <!-- TABLA DONDE SE ELIGE EL RIGOR -->
		<br>
		<table class="table table-bordered">
			<thead class="color_panel4">
				<tr align="center">
				  <td class="tamaño_rigor_nivel">Aspecto de seguridad física <img src="<?php echo base_url('assets/images/ayuda.jpg')?>" title=" <?php echo ("Consecuencias: \n A: Las personas pueden morir \n B: Amenaza contra vidas humanas \n C: Daños materiales. Amenaza de daño a personas \n D: Pequeños daños materiales. No hay riesgo para las personas"); ?>" width="13px" class="img-rounded" alt="help"></td>
				  <td class="tamaño_rigor_nivel">Aspecto económico <img src="<?php echo base_url('assets/images/ayuda.jpg')?>" title=" <?php echo ("Consecuencias: \n A: Desastre financiero (la compañía no puede seguir funcionando) \n B: Pérdidas económicas importantes \n C: Pérdidas económicas significantes \n D: Pérdidas económicas insignificantes"); ?>" width="13px" class="img-rounded" alt="help"></td>
				  <td class="tamaño_rigor_nivel2">Aspecto de seguridad de acceso <img src="<?php echo base_url('assets/images/ayuda.jpg')?>" title=" <?php echo ("Consecuencias: \n A: Riesgo de protección de datos y servicios estratégicos \n B: Riesgo de protección de datos y servicios críticos \n C: Riesgo de protección de datos \n D: No se identifican riesgos"); ?>" width="13px" class="img-rounded" alt="help"></td>
				</tr>
			</thead>
			<tbody>
				<tr>
				  <td align="center">
					  <?php echo $seguridad_fisica;?>
					  <select class="form-control tamaño_rigor_select" id="seguridad_fisica">
							<option value="N/A">N/A</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
					  </select>
				  </td>
				  <td align="center">
					  <?php echo $economico;?>
					  <select class="form-control tamaño_rigor_select" id="economico">
							<option value="N/A">N/A</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
					  </select>
				  </td>
				  <td align="center">
					  <?php echo $seguridad_acceso;?>
					  <select class="form-control tamaño_rigor_select" id="seguridad_acceso">
							<option value="N/A">N/A</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
					  </select>
				  </td>
				</tr>
			</tbody>
		</table>
		<a href="#" onclick="ocultarTablasRigor()">Referencias - Anexo A (ISO 25040)</a>
		<div id="tablas" style="display: none; padding-top: 3%">
		<table class="table table-bordered">
			<thead class="color_panel1">
				<tr align="center">
				  <td class="tamaño_rigor_aspecto">Aspecto</td>
				  <td class="tamaño_rigor_nivel">Nivel de rigor de evaluación</td>
				  <td>Consecuencias</td>
				</tr>
			</thead>
			<tbody>
				<tr>
				  <td rowspan="4" align="center">Seguridad física</td>
				  <td align="center">A</td>
				  <td>Las personas pueden morir</td>
				</tr>
				<tr>
				  <td align="center">B</td>
				  <td>Amenaza contra vidas humanas</td>
				</tr>
				<tr>
				  <td align="center">C</td>
				  <td>Daños materiales. Amenaza de daño a personas.</td>
				</tr>
				<tr>
				  <td align="center">D</td>
				  <td>Pequeños daños materiales. No hay riesgo para las personas.</td>
				</tr>
			</tbody>
		</table>
		
		<table class="table table-bordered">
			<thead class="color_panel2">
				<tr align="center">
				  <td class="tamaño_rigor_aspecto">Aspecto</td>
				  <td class="tamaño_rigor_nivel">Nivel de rigor de evaluación</td>
				  <td>Consecuencias</td>
				</tr>
			</thead>
			<tbody>
				<tr>
				  <td rowspan="4" align="center">Económico</td>
				  <td align="center">A</td>
				  <td>Desastre financiero (la compañía no puede seguir funcionando)</td>
				</tr>
				<tr>
				  <td align="center">B</td>
				  <td>Pérdidas económicas importantes</td>
				</tr>
				<tr>
				  <td align="center">C</td>
				  <td>Pérdidas económicas significantes</td>
				</tr>
				<tr>
				  <td align="center">D</td>
				  <td>Pérdidas económicas insignificantes</td>
				</tr>
			</tbody>
		</table>
		
		<table class="table table-bordered">
			<thead class="color_panel3">
				<tr align="center">
				  <td class="tamaño_rigor_aspecto">Aspecto</td>
				  <td class="tamaño_rigor_nivel">Nivel de rigor de evaluación</td>
				  <td>Consecuencias</td>
				</tr>
			</thead>
			<tbody>
				<tr>
				  <td rowspan="4" align="center">Seguridad de acceso</td>
				  <td align="center">A</td>
				  <td>Riesgo de protección de datos y servicios estratégicos</td>
				</tr>
				<tr>
				  <td align="center">B</td>
				  <td>Riesgo de protección de datos y servicios críticos</td>
				</tr>
				<tr>
				  <td align="center">C</td>
				  <td>Riesgo de protección de datos</td>
				</tr>
				<tr>
				  <td align="center">D</td>
				  <td>No se identifican riesgos</td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="form-group">
			<div class="col-lg-6 col-lg-offset-4">
				<div class="btn-group">
					<button type="button" class="btn btn-danger">Atrás</button>
					<button type="button" class="btn btn-warning">Agregar nota</button>
					<button type="button" class="btn btn-success" id="guardar" onclick="guardar_1_4()">Guardar</button>
				</div>
			</div>
		</div>
	</form>
</div>