<?php

class Evaluacion extends CI_Controller{

	public function iniciar_evaluacion()
	{   
            $evaluacion_data = array(
                'idEvaluacion' => null,
                'creada' => false,
            );
            $this->session->set_userdata($evaluacion_data);
            $contenido = array('contenido' => $this->load->view('sitio/view_introduccionEvaluacion', '', true));
            $datos["cuerpo"] = $this->load->view('sitio/view_iniciarEvaluacion', $contenido, true);
            $this->load->view('sitio/view_index', $datos);
	}
        
        public function introduccion_evaluacion()
	{   
            $this->load->view('sitio/view_introduccionEvaluacion', '');
	}
        
        public function evaluaciones(){
            
            $this->load->model('model_evaluacion');
            $this->load->library('pagination');

            $opciones = array();
            $desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            
            $opciones['per_page'] = 10;
            $opciones['base_url'] = base_url().'evaluacion/evaluaciones/';
            //$opciones['use_page_numbers'] = true;
            $opciones['total_rows'] = $this->model_evaluacion->cantEvaluaciones();
            $opciones['num_links'] = 3;
            $opciones['uri_segment'] = 3;
                    
            $opciones['full_tag_open'] = '<ul class="pagination">';
            $opciones['full_tag_close'] = '</ul>';
            $opciones['first_link'] = 'Primero';
            $opciones['first_tag_open'] = '<li>';
            $opciones['first_tag_close'] = '</li>';
            $opciones['last_link'] = 'Ultimo';
            $opciones['last_tag_open'] = '<li>';
            $opciones['last_tag_close'] = '</li>';
            $opciones['next_link'] = '&gt;';
            $opciones['next_tag_open'] = '<li>';
            $opciones['next_tag_close'] = '</li>';
            $opciones['prev_link'] = '&lt;';
            $opciones['prev_tag_open'] = '<li>';
            $opciones['prev_tag_close'] = '</li>';
            $opciones['cur_tag_open'] = '<li class="active"><a><b>';
            $opciones['cur_tag_close'] = '</b></a></li>';
            $opciones['num_tag_open'] = '<li>';
            $opciones['num_tag_close'] = '</li>';
            
            $this->pagination->initialize($opciones);
                        
            $datos_listado['evaluaciones'] = $this->model_evaluacion->getEvaluacionesPaginadas($opciones['per_page'],$desde);
            $str_links = $this->pagination->create_links();
            $datos_listado['links'] = explode('&nbsp;',$str_links );
     
            $datos["cuerpo"] = $this->load->view('sitio/view_evaluaciones', $datos_listado, true);
            $this->load->view('sitio/view_index', $datos);
	}
        
        public function definicion_producto()
	{
            $this->load->model('model_evaluacion');
            $nombre = '';
            $descripcion = '';
            if ($this->session->userdata('idEvaluacion') <> null){
                $idEvaluacion = $this->session->userdata('idEvaluacion');
                $data = $this->model_evaluacion->cargarProducto($idEvaluacion);
                foreach ($data->result_array() as $dato){
                    $nombre = $dato['nombre'];
                    $descripcion = $dato['descripcion'];
                }
            }
            $datos = array('nombre' => $nombre, 'descripcion' => $descripcion);
            $this->load->view('sitio/view_definicionProducto', $datos);
	}
        
        public function guardarProducto(){
            $this->load->model('model_evaluacion');
            if($this->input->post()){
                $nombre = $this->input->post('nombre');
                $descripcion = $this->input->post('descripcion');
                
                if ($nombre == ''){
                    unset($_SESSION['Exito']);
                    $this->session->set_flashdata('Error', 'El nombre del producto no puede estar vacío');
                    $resul = $this->model_evaluacion->cargarProducto($this->session->userdata('idEvaluacion'));
                    foreach ($resul->result_array() as $r){
                        $nombre = $r['nombre'];
                    }
                }else{
                    if ($this->session->userdata('idEvaluacion') <> null){
                        $idEvaluacion = $this->session->userdata('idEvaluacion');
                        $this->model_evaluacion->editarDefinicion($nombre, $descripcion, $idEvaluacion);
                        $this->session->set_flashdata('Exito', '¡Se editaron los datos exitosamente!');
                    }else{
                        $guardarDefinicion = $this->model_evaluacion->guardarDefinicion($nombre, $descripcion);
                        if ($guardarDefinicion){
                            $evaluacion_data = array(
                                'idEvaluacion' => $guardarDefinicion,
                                'creada' => true,
                            );
                            $this->session->set_userdata($evaluacion_data);
                            $this->session->set_flashdata('Exito', '¡Se guardaron los datos exitosamente! Los ítems de la evaluación se encuentran habilitados.');
                        }else{
                            $this->session->set_flashdata('Error', 'Ocurrió un error al guardar los datos');
                        }
                    }
                }
                
                $datos = array('nombre' => $nombre, 'descripcion' => $descripcion);
                $this->load->view('sitio/view_definicionProducto', $datos);
            }
        }
        
        public function tarea_paso($tarea,$paso)
	{
            $datos = null;
            $datos2 = null;
            $idEvaluacion = $this->session->userdata('idEvaluacion');
            $this->load->model('model_evaluacion');
            switch ($tarea){
                case 1:
                    switch ($paso) {
                        case 0:
                        break;
                        case 1:
                            $proposito = '';
                            $data = $this->model_evaluacion->cargarProposito($idEvaluacion);
                            foreach ($data->result_array() as $dato){
                                $proposito = $dato['proposito'];
                            }
                            $datos = array('proposito' => $proposito); 
                        break;
                        case 2:
                            $texto = '';
                            $cant = 0;
                            $arregloCaracteristicas = array(); //ARREGLO CON CARACTERISTICAS ELEGIDAS POR EL USUARIO
                            $caracteristicas = $this->model_evaluacion->getCaracteristicas(); //TODAS LAS CARACTERISTICAS
                            $data = $this->model_evaluacion->cargar_1_2($idEvaluacion);
                            foreach ($data->result_array() as $dato){
                                $arregloCaracteristicas[$cant] = $dato['idCaracteristica'];
                                $texto = $dato['texto'];
                                $cant++;
                            };

                            $datos = array('caracteristicas' => $caracteristicas, 'caracteristicas_seleccionadas' => $arregloCaracteristicas, 'texto' => $texto); //Guardo el resultado de la consulta en un arreglo para pasar a la vista
                            break;
                        case 3:
                            $partes = $this->model_evaluacion->getPartes();
                            $parteSeleccionada = $this->model_evaluacion->getParteSeleccionada($idEvaluacion);
                            foreach ($parteSeleccionada->result_array() as $p){
                                $idParte = $p['idParte'];
                            }
 
                            $datos = array('partes' => $partes, 'parte_seleccionada' => $idParte); //Guardo el resultado de la consulta en un arreglo para pasar a la vista
                            break;
                        case 4:

                        break;
                    };
                
                case 2:
                    switch ($paso) {
                        case 0:
                        
                        break;
                        case 1:

                        break;
                        case 2:
                           
                        break;
                        case 3:
                        
                        break;
                    };
                    
                case 3:
                    switch ($paso) {
                        case 0:
                        
                        break;
                        case 1:
                        
                        break;
                    };
                    
                case 4:
                    switch ($paso) {
                        case 0:
                        
                        break;
                        case 1:
                        
                        break;
                        case 2:
                        
                        break;
                        case 3:
                        
                        break;
                    };
                    
                case 5:
                    switch ($paso) {
                        case 0:
                        
                        break;
                        case 1:
                        
                        break;
                        case 2:
                        
                        break;
                        case 3:
                        
                        break;
                        case 4:
                        
                        break;
                    };
            }
            
            if ($datos == null){
                $this->load->view('tarea_paso/tarea'.$tarea.'/view_tarea'.$tarea.'_paso'.$paso, $datos2);
            }else{
                $this->load->view('tarea_paso/tarea'.$tarea.'/view_tarea'.$tarea.'_paso'.$paso, $datos);
            }
	}
        
        public function guardarFuncionalidad(){
            $this->load->model('model_evaluacion');
            $idEvaluacion = $this->session->userdata('idEvaluacion');
            if($this->input->post()){ //SE RECIBEN DATOS
                $nombre = $this->input->post('name');
                $descripcion = $this->input->post('description');
                $parte = $this->input->post('parte');
                unset($_SESSION['ExitoAtr']);
                unset($_SESSION['ErrorAtr']);
            }

            $partes = $this->model_evaluacion->getPartes();

            $datos = array('partes' => $partes, 'parte_seleccionada' => $parte);
            $this->load->view('tarea_paso/tarea1/view_tarea1_paso3', $datos);
        }

        public function guardado($tarea,$paso)
	{
            $this->load->model('model_evaluacion');
            $idEvaluacion = $this->session->userdata('idEvaluacion');
            switch ($tarea){
                case 1:
                    switch ($paso) {
                        case 0:
                        break;
                        case 1:
                            if($this->input->post()){
                                $proposito = $this->input->post('proposito');

                                if ($proposito == ''){
                                    unset($_SESSION['Exito']);
                                    $this->session->set_flashdata('ErrorProposito', 'El propósito no puede estar vacío');
                                    $resul = $this->model_evaluacion->cargarProposito($this->session->userdata('idEvaluacion'));
                                    foreach ($resul->result_array() as $e){
                                        $proposito = $e['proposito'];
                                    }
                                }else{
                                    $idEvaluacion = $this->session->userdata('idEvaluacion');
                                    $existeProposito = $this->model_evaluacion->existeProposito($idEvaluacion);
                                    if ($existeProposito){ //SE FIJA SI ES UNA EDICIÓN O LA PRIMERA VEZ
                                        $idEvaluacion = $this->session->userdata('idEvaluacion');
                                        $this->model_evaluacion->editarProposito($proposito, $idEvaluacion);
                                        $this->session->set_flashdata('ExitoProposito', '¡Se editaron los datos exitosamente!');
                                    }else{
                                        $guardarProposito = $this->model_evaluacion->guardarProposito($proposito, $this->session->userdata('idEvaluacion'));
                                        if ($guardarProposito){
                                            $this->session->set_flashdata('ExitoProposito', '¡Se cargó el propósito exitosamente!');
                                        }else{
                                            $this->session->set_flashdata('ErrorProposito', 'Ocurrió un error al guardar los datos');
                                        }
                                    }
                                }
                            }
                            $datos = array('proposito' => $proposito);
                            
                        break;
                        case 2:
                            $arregloCaracteristicas = array();
                            $cant = 0;
                            $idEvaluacion = $this->session->userdata('idEvaluacion');
                            $texto = '';
                            
                            if($this->input->post()){ //SE RECIBEN DATOS
                                $textoNuevo = $this->input->post('text');
                                $atributos = $this->input->post('atr');
                                
                                if ($atributos == ''){ //SI ESTÁ VACÍO EL ARREGLO DE CARACTERISTICAS
                                    unset($_SESSION['ExitoAtr']);
                                    $this->session->set_flashdata('ErrorAtr', 'Debe seleccionar al menos una característica');
                                }else{ //SI NO ESTÁ VACÍO EL ARREGLO DE CARACTERISTICAS
                                    $existe12 = $this->model_evaluacion->existe_1_2($idEvaluacion); //SI EXISTE AL MENOS UNA CARACTERISTICA EN LA BASE
                                    if ($existe12){ //SI EXISTE, ES UNA EDICIÓN
                                        $resul = $this->model_evaluacion->cargar_1_2($idEvaluacion); //TRAE TODOS LOS DATOS (ATRIBUTOS+TEXTO)
                                        foreach ($resul->result_array() as $e){ //GUARDA TODOS LOS ATRIBUTOS DE LA BASE Y EL TEXTO PARA LA VISTA
                                            $arregloAtributos[$cant] = $e['idAtributo'];
                                            $cant++;
                                        }
                                        $this->model_evaluacion->eliminarAtributos($idEvaluacion);
                                        foreach ($atributos as $a){ //POR CADA ATRIBUTO SELECCIONADO POR EL USUARIO
                                            $this->model_evaluacion->guardarAtributos($a, $idEvaluacion); //LOS ACTUALIZA
                                        }
                                        $this->model_evaluacion->editarTexto($textoNuevo, $idEvaluacion); 
                                        $this->session->set_flashdata('ExitoAtr', '¡Se editaron los datos exitosamente!');
                                    }else{ //SI ES LA PRIMERA VEZ
                                        $this->model_evaluacion->guardarTexto($textoNuevo, $idEvaluacion);
                                        foreach ($atributos as $a){
                                            $this->model_evaluacion->guardarAtributos($a, $idEvaluacion);
                                        }
                                        $this->session->set_flashdata('ExitoAtr', '¡Se cargaron los datos exitosamente!');
                                    }
                                }
                            }
                            
                            $resul = $this->model_evaluacion->cargar_1_2($idEvaluacion);
                            foreach ($resul->result_array() as $e){
                                $arregloCaracteristicas[$cant] = $e['idCaracteristica'];
                                $texto = $e['texto'];
                                $cant++;
                            }
                            
                            $caracteristicas = $this->model_evaluacion->getCaracteristicas();
                            $datos = array('caracteristicas' => $caracteristicas, 'caracteristicas_seleccionadas' => $arregloCaracteristicas, 'texto' => $texto); //Guardo el resultado de la consulta en un arreglo para pasar a la vista        
                        break;
                        case 3:
                            if($this->input->post()){ //SE RECIBEN DATOS
                                $parte = $this->input->post('parte');
                                unset($_SESSION['ExitoAtr']);
                                if ($parte==1){
                                    unset($_SESSION['ExitoAtr']);
                                    $this->session->set_flashdata('ErrorPart', 'Debe seleccionar la parte del sistema a evaluar');
                                }else{
                                    unset($_SESSION['ErrorAtr']);
                                    $evaluacion = $this->model_evaluacion->getParteSeleccionada($idEvaluacion);
                                    foreach ($evaluacion->result_array() as $e){
                                        $idParte = $e['idParte'];
                                    }
                                    $evaluacion = $this->model_evaluacion->agregarParte($parte, $idEvaluacion);
                                    if ($idParte == 1){
                                        $this->session->set_flashdata('ExitoPart', '¡Se cargaron los datos exitosamente!');
                                    }else{
                                        $this->session->set_flashdata('ExitoPart', '¡Se editaron los datos exitosamente!');
                                    }
                                    
                                }
                            }
                            
                            $partes = $this->model_evaluacion->getPartes();
                            $datos = array('partes' => $partes, 'parte_seleccionada' => $parte);
                            
                        break;
                        case 4:        
                        
                        break;
                    };
                
                case 2:
                    switch ($paso) {
                        case 0:
                        
                        break;
                        case 1:

                        break;
                        case 2:
                            
                        break;
                        case 3:
                        
                        break;
                    };
                    
                case 3:
                    switch ($paso) {
                        case 0:
                        
                        break;
                        case 1:
                        
                        break;
                    };
                    
                case 4:
                    switch ($paso) {
                        case 0:
                        
                        break;
                        case 1:
                        
                        break;
                        case 2:
                        
                        break;
                        case 3:
                        
                        break;
                    };
                    
                case 5:
                    switch ($paso) {
                        case 0:
                        
                        break;
                        case 1:
                        
                        break;
                        case 2:
                        
                        break;
                        case 3:
                        
                        break;
                        case 4:
                        
                        break;
                    }
            }
            
            if ($datos == null){
                $this->load->view('tarea_paso/tarea'.$tarea.'/view_tarea'.$tarea.'_paso'.$paso, $datos2);
            }else{
                $this->load->view('tarea_paso/tarea'.$tarea.'/view_tarea'.$tarea.'_paso'.$paso, $datos);
            }
	}
}