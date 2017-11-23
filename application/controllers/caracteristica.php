<?php

class Caracteristica extends CI_Controller{
    
    public function caracteristicas()
	{   
            $contenido = array('contenido' => $this->load->view('sitio/view_introduccionEvaluacion', '', true));
            $datos["cuerpo"] = $this->load->view('sitio/view_iniciarEvaluacion', $contenido, true);
            $this->load->view('sitio/view_index', $datos);
	}
        
}
