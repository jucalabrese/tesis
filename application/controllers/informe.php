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
        }
        $caracteristicas = $this->model_evaluacion->getCaracteristicasEvaluacion($idEvaluacion);
        switch ($seguridad_fisica) {
            case 'A':
                $seguridad_fisica = utf8_decode('A: Las personas pueden morir          ');
                break;
            case 'B':
                $seguridad_fisica = utf8_decode('B: Amenaza contra vidas humanas         ');
                break;
            case 'C':
                $seguridad_fisica = utf8_decode('C: Daños materiales. Amenaza de daño a personas');
                break;
            case 'D':
                $seguridad_fisica = utf8_decode('D: Pequeños daños materiales. No hay riesgo para las personas');
                break;
            case 'N/A':
                $seguridad_fisica = 'N/A                                                    ';
                break;
        }
        switch ($economico) {
            case 'A':
                $economico = utf8_decode('A: Desastre financiero              ');
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
                $economico = 'N/A                                                    ';
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
                $seguridad_acceso = utf8_decode('C: Riesgo de protección de datos                    ');
                break;
            case 'D':
                $seguridad_acceso = utf8_decode('D: No se identifican riesgos                         ');
                break;
            case 'N/A':
                $seguridad_acceso = 'N/A                                                    ';
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
        //IMPRIMO PROPOSITO
        $this->pdf->SetFont('Arial', 'UB', 12); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, utf8_decode('Propósito:'));
        $this->pdf->Ln(10);
        $this->pdf->SetFont('Arial', '', 12); //Arial, 12 puntos
        $this->pdf->Write(5, $proposito);
        $this->pdf->Ln(15);
        //IMPRIMO CARACTERISTICAS
        $this->pdf->SetFont('Arial', 'UB', 12); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, utf8_decode('Características:'));
        $this->pdf->Ln(10);
        $this->pdf->SetFont('Arial', '', 12); //Arial, 12 puntos
        if ($caracteristicas->num_rows() == 1) {
            $this->pdf->Write(5, utf8_decode('Se evaluará la característica '));
        } else {
            $this->pdf->Write(5, utf8_decode('Se evaluarán las características '));
        }
        foreach ($caracteristicas->result_array() as $c) {
            $this->pdf->SetFont('Arial', 'IU', 12); //Arial, italica, subrayada, 12 puntos
            $this->pdf->Write(5, utf8_decode($c['nombre']));
            $this->pdf->SetFont('Arial', '', 12); //Arial, 12 puntos
            if ($c != $caracteristicas->result_array()[$caracteristicas->num_rows() - 1]) {
                $this->pdf->Write(5, ' - ');
            } else {
                $this->pdf->Write(5, '.');
            }
        }
        $this->pdf->Ln(15);
        //IMPRIMO FASE
        $this->pdf->SetFont('Arial', 'UB', 12); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, 'Fase en la que se encuentra el producto:');
        $this->pdf->Ln(10);
        $this->pdf->SetFont('Arial', '', 12); //Arial, 12 puntos
        $this->pdf->Write(5, utf8_decode($fase));
        $this->pdf->Ln(15);
        //IMPRIMO RIGOR
        $this->pdf->SetFont('Arial', 'UB', 12); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, utf8_decode('Rigor de la evaluación:'));
        $this->pdf->Ln(10);
        $cabecera = array(utf8_decode("Aspecto de seguridad física"), utf8_decode("Aspecto económico"), utf8_decode("Aspecto de seguridad de acceso"));
        $cuerpo = array($datosRigor);
        $this->pdf->FancyTableRigor($cabecera, $cuerpo);
        $this->pdf->Ln(15);
        //IMPRIMO SUBCARACTERISTICAS (CON LAS TABLAS DE LAS METRICAS)
        $this->pdf->SetFont('Arial', 'UB', 12); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, utf8_decode('Métricas (subcaracterísticas) elegidas:'));
        $this->pdf->Ln(10);
        foreach ($caracteristicas->result_array() as $c) {
            $this->pdf->SetFont('Arial', 'UI', 12); //Arial, italica, subrayada, 12 puntos
            $this->pdf->Write(5, utf8_decode('Característica ' . $c['nombre']));
            $this->pdf->Ln(10);
            $subcaracteristicas = $this->model_evaluacion->getSubcaracteristicasEvaluacionCaracteristica($idEvaluacion, $c['idCaracteristica']);
            foreach ($subcaracteristicas->result_array() as $s) {
                $this->pdf->SetFont('Arial', 'U', 12);
                $this->pdf->Write(5, utf8_decode('Métrica'));
                $this->pdf->SetFont('Arial', '', 12);
                $this->pdf->Write(5, utf8_decode(': ' . $s['nombre']));
                $this->pdf->Ln(5);
                $this->pdf->SetFont('Arial', 'U', 12);
                $this->pdf->Write(5, utf8_decode('Propósito'));
                $this->pdf->SetFont('Arial', '', 12);
                $this->pdf->Write(5, utf8_decode(': ' . $s['proposito']));
                $this->pdf->Ln(5);
                $this->pdf->SetFont('Arial', 'U', 12);
                $this->pdf->Write(5, utf8_decode('Método de aplicación'));
                $this->pdf->SetFont('Arial', '', 12);
                $this->pdf->Write(5, utf8_decode(': ' . $s['metodo']));
                $this->pdf->Ln(5);
                $this->pdf->SetFont('Arial', 'U', 12);
                $this->pdf->Write(5, utf8_decode('Entradas'));
                $this->pdf->SetFont('Arial', '', 12);
                $this->pdf->Write(5, utf8_decode(': ' . $s['entradas']));
                $this->pdf->Ln(5);
                $this->pdf->SetFont('Arial', 'U', 12);
                $this->pdf->Write(5, utf8_decode('Fórmula'));
                $this->pdf->SetFont('Arial', '', 12);
                $this->pdf->Write(5, utf8_decode(': ' . $s['formula']));
                $this->pdf->Ln(10);
            }
            $this->pdf->Ln(5);
        }
        //IMPRIMO NIVELES DE ACEPTACION DE SUBCARACTERISTICAS
        $this->pdf->SetFont('Arial', 'UB', 12); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, utf8_decode('Criterios de decisión de las subcaracterísticas:'));
        $this->pdf->Ln(10);
        foreach ($caracteristicas->result_array() as $c) {
            $this->pdf->SetFont('Arial', 'UI', 12); //Arial, italica, subrayada, 12 puntos
            $this->pdf->Write(5, utf8_decode('Característica ' . $c['nombre']));
            $this->pdf->Ln(10);
            $subcaracteristicas = $this->model_evaluacion->getSubcaracteristicasEvaluacionCaracteristica($idEvaluacion, $c['idCaracteristica']);
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
                $cuerpo[] = array(utf8_decode($s['nombre']),'0.00 - '.$inaceptable.'0',$inaceptable+0.01.' - '.$min_aceptable.'0',$min_aceptable+0.01.' - '.$aceptable.'0',$aceptable+0.01.' - '.$excede.'.00');
               }
            $this->pdf->FancyTableNivelesSubcaracteristicas($cabecera, $cuerpo);
            $this->pdf->Ln(10);
        }
        //IMPRIMO NIVELES DE ACEPTACION DE CARACTERISTICAS (SI HAY!)

//  FORMATO TABLA
//  $cabecera = array("Apellido", "Nombre","Matrícula","Usuario","Mail");
//  $pdf->FancyTableWithNItems($cabecera,$usuarios,$votos,38); //Método que integra a cabecera y datos
        $this->pdf->Output('informe.pdf', 'I'); //Salida al navegador del pdf
    }

}
