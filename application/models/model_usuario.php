<?php

class Model_inicio extends CI_Model { 
    
    function __construct() {
        parent::__construct();
    }
   
    function login($email, $clave){
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('email', $email);
        $this->db->where('clave', $clave);
        $consulta = $this->db->get();
        return $consulta->row();
    }
    
    function getUsuario($email){
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('email', $email);
        $consulta = $this->db->get();
        return $consulta->row();
    }
}
