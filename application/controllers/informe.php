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

        $this->pdf->AliasNbPages();
        $this->pdf->AddPage('P', 'A4'); //Vertical, A4
        $this->pdf->SetTitle('Informe');
        $this->pdf->Ln(10);
        if ($descripcionProd != '') {
            $this->pdf->SetFont('Arial', 'B', 12); //Arial,negrita, 12 puntos
            $this->pdf->Write(5, utf8_decode('Descripción: '));
            $this->pdf->SetFont('Arial', '', 12); //Arial, 12 puntos
            $this->pdf->Write(5, $descripcionProd);
            $this->pdf->Ln(10);
        }
        $this->pdf->SetFont('Arial', 'B', 12); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, utf8_decode('Propósito: '));
        $this->pdf->SetFont('Arial', '', 12); //Arial, 12 puntos
        $this->pdf->Write(5, $proposito);
        $this->pdf->Ln(10);

        $this->pdf->SetFont('Arial', 'B', 12); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, utf8_decode('Características: '));
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
        $this->pdf->Ln(10);
        $this->pdf->SetFont('Arial', 'B', 12); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, 'Fase en la que se encuentra el producto: ');
        $this->pdf->SetFont('Arial', '', 12); //Arial, 12 puntos
        $this->pdf->Write(5, utf8_decode($fase));
        $this->pdf->Ln(10);
        $this->pdf->SetFont('Arial', 'B', 12); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, utf8_decode('Rigor de la evaluación: '));
        $this->pdf->Ln(10);
        $cabecera = array(utf8_decode("Aspecto de seguridad física"), utf8_decode("Aspecto económico"), utf8_decode("Aspecto de seguridad de acceso"));
        $cuerpo = array($datosRigor);
        $this->pdf->FancyTableRigor($cabecera, $cuerpo);
//  FORMATO TABLA
//  $cabecera = array("Apellido", "Nombre","Matrícula","Usuario","Mail");
//  $pdf->FancyTableWithNItems($cabecera,$usuarios,$votos,38); //Método que integra a cabecera y datos
        $this->pdf->Output('informe.pdf', 'I'); //Salida al navegador del pdf
    }

}
