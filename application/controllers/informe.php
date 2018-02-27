<?php

class Informe extends CI_Controller {

    public function generarInforme() {

        $this->load->model('model_evaluacion');
        $idEvaluacion = $this->session->userdata('idEvaluacion');
        global $nombreProd;
        $producto = $this->model_evaluacion->cargarProducto($idEvaluacion);
        foreach ($producto->result_array() as $p) {
            $nombreProd = utf8_decode($p['nombre']);
            $descripcionProd = utf8_decode($p['descripcion']);
        }
        $evaluacion = $this->model_evaluacion->cargarProposito($idEvaluacion);
        foreach ($evaluacion->result_array() as $e) {
            $proposito = utf8_decode($e['proposito']);
            $parte = $this->model_evaluacion->getParte($e['idParte']);
            foreach ($parte->result_array() as $p) {
                $fase = $p['parte'];
            }
            $rigor = $this->model_evaluacion->getEvaluacionRigor($e['idEvaluacionRigor']);
            foreach ($rigor->result_array() as $r) {
                $seguridad_fisica = $r['seguridad_fisica'];
                $economico = $r['economico'];
                $seguridad_acceso = $r['seguridad_acceso'];
            }
            $actividades = $e['actividades'];
            $feedback = $e['feedback'];
        }
        $caracteristicas = $this->model_evaluacion->getCaracteristicasEvaluacion($idEvaluacion);
        switch ($seguridad_fisica) {
            case 'A':
                $seguridad_fisica = utf8_decode('A: Las personas pueden morir                 ');
                break;
            case 'B':
                $seguridad_fisica = utf8_decode('B: Amenaza contra vidas humanas               ');
                break;
            case 'C':
                $seguridad_fisica = utf8_decode('C: Daños materiales. Amenaza de daño a personas');
                break;
            case 'D':
                $seguridad_fisica = utf8_decode('D: Pequeños daños materiales. No hay riesgo para las personas');
                break;
            case 'N/A':
                $seguridad_fisica = 'N/A                                                               ';
                break;
        }
        switch ($economico) {
            case 'A':
                $economico = utf8_decode('A: Desastre financiero                    ');
                break; 
            case 'B':
                $economico = utf8_decode('B: Pérdidas económicas importantes');
                break;
            case 'C':
                $economico = utf8_decode('C: Pérdidas económicas significantes');
                break;
            case 'D':
                $economico = utf8_decode('D: Pérdidas económicas insignificantes');
                break;
            case 'N/A':
                $economico = 'N/A                                                            ';
                break;
        }
        switch ($seguridad_acceso) {
            case 'A':
                $seguridad_acceso = utf8_decode('A: Riesgo de protección de datos y servicios estratégicos');
                break;
            case 'B':
                $seguridad_acceso = utf8_decode('B: Riesgo de protección de datos y servicios críticos');
                break;
            case 'C':
                $seguridad_acceso = utf8_decode('C: Riesgo de protección de datos                        ');
                break;
            case 'D':
                $seguridad_acceso = utf8_decode('D: No se identifican riesgos                             ');
                break;
            case 'N/A':
                $seguridad_acceso = 'N/A                                                              ';
                break; 
        }
        $datosRigor = array($seguridad_fisica, $economico, $seguridad_acceso);

        $this->load->library('PDF');
        $this->pdf = new PDF();
        //GENERO PDF
        $this->pdf->AliasNbPages();
        $this->pdf->AddPage('P', 'A4'); //Vertical, A4
        $this->pdf->SetTitle('Informe');
        
        //IMPRIMO DESCRIPCION (SI EXISTE!)
        if ($descripcionProd != '') {
            $this->pdf->SetFont('Arial', 'UB', 12); //Arial,negrita, 12 puntos
            $this->pdf->Write(5, utf8_decode('Descripción:'));
            $this->pdf->Ln(10);
            $this->pdf->SetFont('Arial', '', 12); //Arial, 12 puntos
            $this->pdf->Write(5, $descripcionProd);
            $this->pdf->Ln(15);
        }
        
        //IMPRIMO ETAPA DE LA EVALUACIÓN
        $this->pdf->SetFont('Arial', 'UB', 14); //Arial,negrita, 12 puntos
        $this->pdf->Cell(50);
        $this->pdf->Write(5, utf8_decode('REQUISITOS DE LA EVALUACIÓN'));
        $this->pdf->Ln(13);
        
        //IMPRIMO PROPOSITO
        $this->pdf->SetFont('Arial', 'B', 11); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, utf8_decode('Propósito: '));
        $this->pdf->SetFont('Arial', '', 11); //Arial, 12 puntos
        $this->pdf->Write(5, $proposito);
        $this->pdf->Ln(11);
        
        //IMPRIMO CARACTERISTICAS
        $this->pdf->SetFont('Arial', 'B', 11); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, utf8_decode('Características: '));
        $this->pdf->SetFont('Arial', '', 11); //Arial, 12 puntos
        if ($caracteristicas->num_rows() == 1) {
            $this->pdf->Write(5, utf8_decode('La característica seleccionada para la evaluación es '));
        } else {
            $this->pdf->Write(5, utf8_decode('Las características seleccionadas para la evaluación son '));
        }
        foreach ($caracteristicas->result_array() as $c) {
            $this->pdf->SetFont('Arial', 'I', 11); //Arial, italica, subrayada, 12 puntos
            $this->pdf->Write(5, utf8_decode($c['nombre']));
            $this->pdf->SetFont('Arial', '', 12); //Arial, 12 puntos
            if ($c != $caracteristicas->result_array()[$caracteristicas->num_rows() - 1]) {
                $this->pdf->Write(5, ' - ');
            } else {
                $this->pdf->Write(5, '.');
            }
        }
        $this->pdf->Ln(11);
        
        //IMPRIMO FASE
        $this->pdf->SetFont('Arial', 'B', 11); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, 'Fase en la que se encuentra el producto: ');
        $this->pdf->SetFont('Arial', '', 11); //Arial, 12 puntos
        $this->pdf->Write(5, utf8_decode($fase) . ".");
        $this->pdf->Ln(11);
        
        //IMPRIMO RIGOR
        $this->pdf->SetFont('Arial', 'B', 11); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, utf8_decode('Rigor de la evaluación: '));
        $this->pdf->SetFont('Arial', '', 11); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, utf8_decode('La siguiente tabla indica el rigor de la evaluación bajo diferentes aspectos.'));
        $this->pdf->Ln(11);
        
        $cabecera = array(utf8_decode("Aspecto de seguridad física"), utf8_decode("Aspecto económico"), utf8_decode("Aspecto de seguridad de acceso"));
        $cuerpo = array($datosRigor);
        $this->pdf->FancyTableRigor($cabecera, $cuerpo);
        $this->pdf->Ln(13);
        
        //IMPRIMO ETAPA DE LA EVALUACIÓN
        $this->pdf->SetFont('Arial', 'UB', 14); //Arial,negrita, 12 puntos
        $this->pdf->Cell(45);
        $this->pdf->Write(5, utf8_decode('ESPECIFICACIÓN DE LA EVALUACIÓN'));
        $this->pdf->Ln(13);
        
        //IMPRIMO SUBCARACTERISTICAS (CON LAS TABLAS DE LAS METRICAS)
        $this->pdf->SetFont('Arial', 'B', 11); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, utf8_decode('Métricas: '));
        $this->pdf->SetFont('Arial', '', 11); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, utf8_decode('En base a las características y subcaracterísticas elegidas, las métricas a evaluar son: '));
        $this->pdf->Ln(11);
        foreach ($caracteristicas->result_array() as $c) {
            $this->pdf->SetFont('Arial', 'BU', 11); //Arial, italica, subrayada, 12 puntos
            $this->pdf->Write(5, utf8_decode('Característica ' . $c['nombre']));
            $this->pdf->Ln(11);
            $subcaracteristicas = $this->model_evaluacion->getSubcaracteristicasEvaluacionCaracteristica($idEvaluacion, $c['idCaracteristica']);
            foreach ($subcaracteristicas->result_array() as $s) {
                $this->pdf->SetFont('Arial', 'U', 11);
                $this->pdf->Write(5, utf8_decode('Métrica'));
                $this->pdf->SetFont('Arial', '', 11);
                $this->pdf->Write(5, utf8_decode(': ' . $s['nombre']));
                $this->pdf->Ln(5);
                $this->pdf->SetFont('Arial', 'U', 11);
                $this->pdf->Write(5, utf8_decode('Propósito'));
                $this->pdf->SetFont('Arial', '', 11);
                $this->pdf->Write(5, utf8_decode(': ' . $s['proposito']));
                $this->pdf->Ln(5);
                $this->pdf->SetFont('Arial', 'U', 11);
                $this->pdf->Write(5, utf8_decode('Método de aplicación'));
                $this->pdf->SetFont('Arial', '', 11);
                $this->pdf->Write(5, utf8_decode(': ' . $s['metodo']));
                $this->pdf->Ln(5);
                $this->pdf->SetFont('Arial', 'U', 11);
                $this->pdf->Write(5, utf8_decode('Entradas'));
                $this->pdf->SetFont('Arial', '', 11);
                $this->pdf->Write(5, utf8_decode(': ' . $s['entradas']));
                $this->pdf->Ln(5);
                $this->pdf->SetFont('Arial', 'U', 11);
                $this->pdf->Write(5, utf8_decode('Fórmula'));
                $this->pdf->SetFont('Arial', '', 11);
                $this->pdf->Write(5, utf8_decode(': ' . $s['formula']));
                $this->pdf->Ln(11);
            }
            $this->pdf->Ln(5);
        }
        
        //IMPRIMO NIVELES DE ACEPTACION DE SUBCARACTERISTICAS
        $this->pdf->SetFont('Arial', 'B', 11); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, utf8_decode('Criterios de decisión de las subcaracterísticas: '));
        //$this->pdf->Ln(10);
        $this->pdf->SetFont('Arial', '', 11); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, utf8_decode('Para cada una de las subcaracterísticas, se estableció el siguiente criterio de decisión:'));
        $this->pdf->Ln(11);
        $caracteristicasCompletas = array();
        foreach ($caracteristicas->result_array() as $c) {
            $this->pdf->SetFont('Arial', 'I', 11); //Arial, italica, subrayada, 12 puntos
            $this->pdf->Write(5, utf8_decode('Característica ' . $c['nombre']));
            $this->pdf->Ln(11);
            $subcaracteristicas = $this->model_evaluacion->getSubcaracteristicasEvaluacionCaracteristica($idEvaluacion, $c['idCaracteristica']);
            $cantSubcaracteristicas = $subcaracteristicas->num_rows();
            switch ($c['idCaracteristica']) {
                case 1:
                    if ($cantSubcaracteristicas == 3) {
                        $caracteristicasCompletas[] = $c;
                    }
                    break;
                case 2:
                    if ($cantSubcaracteristicas == 3) {
                        $caracteristicasCompletas[] = $c;
                    }
                    break;
                case 3:
                    if ($cantSubcaracteristicas == 2) {
                        $caracteristicasCompletas[] = $c;
                    }
                    break;
                case 4:
                    if ($cantSubcaracteristicas == 6) {
                        $caracteristicasCompletas[] = $c;
                    }
                    break;
                case 5:
                    if ($cantSubcaracteristicas == 4) {
                        $caracteristicasCompletas[] = $c;
                    }
                    break;
                case 6:
                    if ($cantSubcaracteristicas == 5) {
                        $caracteristicasCompletas[] = $c;
                    }
                    break;
                case 7:
                    if ($cantSubcaracteristicas == 5) {
                        $caracteristicasCompletas[] = $c;
                    }
                    break;
                case 8:
                    if ($cantSubcaracteristicas == 3) {
                        $caracteristicasCompletas[] = $c;
                    }
                    break;
            }
            $cabecera = array(utf8_decode("Subcaracterística"), "Inaceptable", utf8_decode("Mín. aceptable"), "Rango objetivo", "Excede los req.");
            $cuerpo = array();
            foreach ($subcaracteristicas->result_array() as $s) {
                $subcar = $this->model_evaluacion->getEvaluacionSubcaracteristica($idEvaluacion, $s['idSubcaracteristica']);
                foreach ($subcar->result_array() as $sub) {
                    $subc_nivel = $this->model_evaluacion->getSubcaracteristicaNivel($sub['idEvaluacionSubcaracteristica']);
                }
                foreach ($subc_nivel->result_array() as $sn) {
                    switch ($sn['idNivel']) {
                        case 1:
                            $inaceptable = $sn['valorMaximo'];
                            break;
                        case 2:
                            $min_aceptable = $sn['valorMaximo'];
                            break;
                        case 3:
                            $aceptable = $sn['valorMaximo'];
                            break;
                        case 4:
                            $excede = $sn['valorMaximo'];
                            break;
                    }
                }
                $cuerpo[] = array(utf8_decode($s['nombre']), '0.00 - ' . $inaceptable . '0', $inaceptable + 0.01 . ' - ' . $min_aceptable . '0', $min_aceptable + 0.01 . ' - ' . $aceptable . '0', $aceptable + 0.01 . ' - ' . $excede . '.00');
            }
            $this->pdf->FancyTableNivelesSubcaracteristicas($cabecera, $cuerpo);
            $this->pdf->Ln(5);
        }
        $this->pdf->Ln(5);
        
        //IMPRIMO NIVELES DE ACEPTACION DE CARACTERISTICAS (SI HAY!)
        if (!empty($caracteristicasCompletas)) {
            $this->pdf->SetFont('Arial', 'UB', 12); //Arial,negrita, 12 puntos
            $this->pdf->Write(5, utf8_decode('Criterios de decisión de las características:'));
            $this->pdf->Ln(10);
            foreach ($caracteristicasCompletas as $c) {
                $this->pdf->SetFont('Arial', 'UI', 12); //Arial, italica, subrayada, 12 puntos
                $this->pdf->Write(5, utf8_decode('Característica ' . $c['nombre']));
                $this->pdf->Ln(10);
                $subcaracteristicas = $this->model_evaluacion->getSubcaracteristicasEvaluacionCaracteristica($idEvaluacion, $c['idCaracteristica']);
                $cabecera = array();
                $inac = array();
                $minac = array();
                $acep = array();
                $excede = array();
                $cabecera[] = "";
                $inac[] = "Inaceptable";
                $minac[] = utf8_decode("Mín. Aceptable");
                $acep[] = "Aceptable";
                $excede[] = "Excede los req.";
                foreach ($subcaracteristicas->result_array() as $s) {
                    $nombre = $s['nombre'];
                    switch ($s['idSubcaracteristica']){
                        case 12:
                            $nombre = "Prot. errores usuario";
                            break;
                        case 27:
                            $nombre = "Cap. de ser mod.";
                            break;
                        case 28:
                            $nombre = "Cap. de ser prob.";
                            break;
                    }
                    $cabecera[] = utf8_decode($nombre);
                    $subcar = $this->model_evaluacion->getEvaluacionSubcaracteristica($idEvaluacion, $s['idSubcaracteristica']);
                    foreach ($subcar->result_array() as $sub) {
                        switch ($sub['nivel_inac']){
                            case 1:
                                $inac[] = "Inaceptable";
                                break;
                            case 2:
                                $inac[] = utf8_decode("Mín. Aceptable");
                                break;
                            case 3:
                                $inac[] = "Rango objetivo";
                                break;
                            case 4:
                                $inac[] = "Excede los req.";
                                break;
                        }
                        switch ($sub['nivel_minac']){
                            case 1:
                                $minac[] = "Inaceptable";
                                break;
                            case 2:
                                $minac[] = utf8_decode("Mín. Aceptable");
                                break;
                            case 3:
                                $minac[] = "Rango objetivo";
                                break;
                            case 4:
                                $minac[] = "Excede los req.";
                                break;
                        }
                        switch ($sub['nivel_acep']){
                            case 1:
                                $acep[] = "Inaceptable";
                                break;
                            case 2:
                                $acep[] = utf8_decode("Mín. Aceptable");
                                break;
                            case 3:
                                $acep[] = "Rango objetivo";
                                break;
                            case 4:
                                $acep[] = "Excede los req.";
                                break;
                        }
                        switch ($sub['nivel_excede']){
                            case 1:
                                $excede[] = "Inaceptable";
                                break;
                            case 2:
                                $excede[] = utf8_decode("Mín. Aceptable");
                                break;
                            case 3:
                                $excede[] = "Rango objetivo";
                                break;
                            case 4:
                                $excede[] = "Excede los req.";
                                break;
                        }
                    }
                }
                $cuerpo = array($inac, $minac, $acep, $excede);
                $this->pdf->FancyTableNivelesCaracteristicas($cabecera, $cuerpo);
               // EN VEZ DE NUMEROS TIENEN QUE SER LOS NOMBRES DE LOS NIVELES
                
                $this->pdf->Ln(10);
            }
        }

        //IMPRIMO ETAPA DE LA EVALUACIÓN
        $this->pdf->SetFont('Arial', 'UB', 14); //Arial,negrita, 12 puntos
        $this->pdf->Cell(55);
        $this->pdf->Write(5, utf8_decode('DISEÑO DE LA EVALUACIÓN'));
        $this->pdf->Ln(13);
        
        //IMPRIMO PLAN DE ACTIVIDADES
        $this->pdf->SetFont('Arial', 'B', 11); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, utf8_decode('Plan de actividades: '));
        $this->pdf->SetFont('Arial', '', 11); //Arial, 12 puntos
        $this->pdf->Write(5, $actividades);
        $this->pdf->Ln(13);
        
        //IMPRIMO ETAPA DE LA EVALUACIÓN
        $this->pdf->SetFont('Arial', 'UB', 14); //Arial,negrita, 12 puntos
        $this->pdf->Cell(50);
        $this->pdf->Write(5, utf8_decode('EJECUCIÓN DE LA EVALUACIÓN'));
        $this->pdf->Ln(13);
        
        //IMPRIMO RESULTADOS
        $this->pdf->SetFont('Arial', 'B', 11); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, utf8_decode('Resultados: '));
        $this->pdf->SetFont('Arial', '', 11); //Arial, 12 puntos
        $this->pdf->Write(5, utf8_decode("Se llevó a cabo la ejecución de la evaluación, en la cual se respondieron las diferentes preguntas presentadas por el sistema. Las respuestas fueron analizadas, obteniendo los siguientes resultados: "));
        $this->pdf->Ln(11);
        foreach ($caracteristicas->result_array() as $c) {
            $this->pdf->SetFont('Arial', 'U', 11); //Arial, italica, subrayada, 12 puntos
            $this->pdf->Write(5, utf8_decode("Característica"));
            $this->pdf->SetFont('Arial', 'B', 11); //Arial, italica, subrayada, 12 puntos
            $this->pdf->Write(5, utf8_decode(': ' . $c['nombre']));
            $this->pdf->Ln(11);
            $subcaracteristicas = $this->model_evaluacion->getSubcaracteristicasEvaluacionCaracteristica($idEvaluacion, $c['idCaracteristica']);
            foreach ($subcaracteristicas->result_array() as $s) {
                $total = 0;
                $cantCriterios = 0;
                $nivel_total = '';
                $cuerpo = array();
                $nivel = $this->model_evaluacion->getNivel($idEvaluacion, $s['idSubcaracteristica']);
                foreach ($nivel->result_array() as $n){
                    $totalSubcaracteristica = $n['puntajeObtenido'];
                    if ($totalSubcaracteristica <= $n['valorMaximo']){
                        $nivel_total = $n['nivel'];
                    };
                };
                $this->pdf->SetFont('Arial', 'I', 11); //Arial, italica, subrayada, 12 puntos
                $this->pdf->Write(5, utf8_decode("Subcaracterística"));
                $this->pdf->SetFont('Arial', 'I', 11); //Arial, italica, subrayada, 12 puntos
                $this->pdf->Write(5, utf8_decode(': ' . $s['nombre']));
                $this->pdf->Ln(11);
                $criterios = $this->model_evaluacion->getCriteriosEvaluacion($idEvaluacion,$s['idSubcaracteristica']);
                $cabecera = array(utf8_decode("Criterio"), utf8_decode("Valor obtenido"), utf8_decode("Valor máximo"), utf8_decode("Subcaracterística"));
                foreach ($criterios->result_array() as $cri){
                    $cuerpo[] = array(utf8_decode($cri['nombre']), utf8_decode($cri['puntaje']), 1, '-');
                    $total = $total + $cri['puntaje'];
                    $cantCriterios++;
                }
                $cuerpo[] = array(utf8_decode('Total'),$total, $cantCriterios, $totalSubcaracteristica . " (Nivel: " . $nivel_total . ")");
                $this->pdf->FancyTableNivelesCaracteristicas($cabecera, $cuerpo);
            }
        }
        
        $this->pdf->Ln(13);
        
        //IMPRIMO ETAPA DE LA EVALUACIÓN
        $this->pdf->SetFont('Arial', 'UB', 14); //Arial,negrita, 12 puntos
        $this->pdf->Cell(44);
        $this->pdf->Write(5, utf8_decode('CONCLUSIONES DE LA EVALUACIÓN'));
        $this->pdf->Ln(13);
        
        //IMPRIMO FEEDBACK (SI HAY)
        if ($feedback != '') {
            $this->pdf->SetFont('Arial', 'B', 11); //Arial,negrita, 12 puntos
            $this->pdf->Write(5, utf8_decode('Feedback de la evaluación: '));
            $this->pdf->SetFont('Arial', '', 11); //Arial, 12 puntos
            $this->pdf->Write(5, $feedback);
            $this->pdf->Ln(13);
        }else{
            $this->pdf->SetFont('Arial', '', 11); //Arial, 12 puntos
            $this->pdf->Write(5, utf8_decode("NOTA: Dicho informe se encuentra en modo de revisión por el evaluador. No se ha ingresado ningún feedback sobre los resultados obtenidos."));
            $this->pdf->Ln(13);
        }
        
            
//  FORMATO TABLA
//  $cabecera = array("Apellido", "Nombre","Matrícula","Usuario","Mail");
//  $pdf->FancyTableWithNItems($cabecera,$usuarios,$votos,38); //Método que integra a cabecera y datos
        $this->pdf->Output('informe.pdf', 'I'); //Salida al navegador del pdf
    }

}
