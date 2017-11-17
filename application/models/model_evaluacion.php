<?php

class Model_evaluacion extends CI_Model { 
    
    function __construct(){
        parent::__construct();
    }
    
    function getAtributos(){
        $this->db->select('*');
        $this->db->from('atributo');
        $consulta = $this->db->get();
        return $consulta;
    }
    
    function getFuncionalidades($idEvaluacion){
        $this->db->select('*');
        $this->db->from('funcionalidad');
        $this->db->where('idEvaluacion', $idEvaluacion);
        $consulta = $this->db->get();
        return $consulta;
    }
    
    function agregarFuncionalidad($name, $description, $idEvaluacion){
        $this->db->trans_start();
        
        $data = array(
               'nombre' => $name,
               'descripcion' => $description,
               'idEvaluacion' => $idEvaluacion,
        );
        
        $this->db->insert('funcionalidad', $data); 
        $idFuncionalidad = $this->db->insert_id();
        $this->db->trans_complete();
        return $idFuncionalidad;
    }
    
    function getAtributosEvaluacion($idEvaluacion){
        $this->db->select('DISTINCT(a.nombre)');
        $this->db->from('evaluacion_atributo as ea, atributo as a');
        $this->db->where('ea.idEvaluacion', $idEvaluacion);
        $this->db->where('ea.idAtributo = a.idAtributo');
        $consulta = $this->db->get();
        return $consulta;
    }
    
    function getSubAtributos_Atributo($idAtributo){
        $this->db->select('*');
        $this->db->from('subatributo');
        $this->db->where('idAtributo', $idAtributo);
        $consulta = $this->db->get();
        return $consulta;
    }
    
    function getMetricas_SubAtributo($idSubatributo){
        $this->db->select('*');
        $this->db->from('metrica');
        $this->db->where('idSubatributo', $idSubatributo);
        $consulta = $this->db->get();
        return $consulta;
    }
    
    function guardarDefinicion($nombre, $descripcion){
        $this->db->trans_start();
        
        $data1 = array(
               'nombre' => $nombre,
               'descripcion' => $descripcion,
        );
        
        $this->db->insert('producto', $data1); 
        $idProducto = $this->db->insert_id();
        $this->db->trans_complete();
        
        $this->db->trans_start();
        
        $data2 = array(
            'idProducto' => $idProducto,
            'idUsuario' => $this->session->userdata('id'),
            'idEstado' => 1,
            'idParte' => 1,
        );
        
        $this->db->insert('evaluacion', $data2); 
        $idEvaluacion = $this->db->insert_id();
        $this->db->trans_complete();
        return $idEvaluacion;
    }
    
    function cargarProducto($idEvaluacion){
        $this->db->select('*');
        $this->db->from('producto as p, evaluacion as e');
        $this->db->where('e.idEvaluacion', $idEvaluacion);
        $this->db->where('e.idProducto = p.idProducto');
        $consulta = $this->db->get();
        return $consulta;
    }
    
    function editarDefinicion($nombre, $descripcion, $idEvaluacion){
        
        $this->db->select('*');
        $this->db->from('evaluacion as e');
        $this->db->where('e.idEvaluacion', $idEvaluacion);
        $query = $this->db->get();
        
        $this->db->trans_start();
        $data = array(
               'nombre' => $nombre,
               'descripcion' => $descripcion,
        );
        
        foreach ($query->result_array() as $q){
            $this->db->where('idProducto', $q['idProducto']);
        }
        $this->db->update('producto', $data); 
        $producto = $this->db->insert_id();
        $this->db->trans_complete();
        
        return $producto;
    }
    
    function cantEvaluaciones(){ 
        $consulta = $this->db->get('evaluacion');
        return $consulta->num_rows();
    }
    
    function getEvaluacionesPaginadas($limite, $start){
        $this->db->select('*');
        $this->db->from('producto as p, evaluacion as e, estado as es');
        $this->db->where('e.idProducto = p.idProducto');
        $this->db->where('e.idEstado = es.idEstado');
        $this->db->limit($limite, $start);
        $this->db->order_by("idEvaluacion", "desc");
        $query = $this->db->get();
        
        if($query->num_rows() == 0 ){
            return false;
        }else{
            return $query;
        }
    }
    
    function cargarProposito($idEvaluacion){
        $this->db->select('*');
        $this->db->from('evaluacion as e');
        $this->db->where('e.idEvaluacion', $idEvaluacion);
        $consulta = $this->db->get();
        return $consulta;
    }
    
    function guardarProposito($proposito, $idEvaluacion){
       $this->db->trans_start();

       $data1 = array(
              'proposito' => $proposito,
       );

       $this->db->where('idEvaluacion', $idEvaluacion);
       $this->db->update('evaluacion', $data1); 
       $this->db->trans_complete();

       return $idEvaluacion;
    }
    
    function editarProposito($proposito, $idEvaluacion){
        
        $this->db->trans_start();
        $data = array(
               'proposito' => $proposito,
        );

        $this->db->where('idEvaluacion', $idEvaluacion);
        $this->db->update('evaluacion', $data); 
        $producto = $this->db->insert_id();
        $this->db->trans_complete();
        
        return $producto;
    }
    
    function existeProposito($idEvaluacion){
        
        $this->db->select('*');
        $this->db->from('evaluacion as e');
        $this->db->where('e.idEvaluacion', $idEvaluacion);
        $query = $this->db->get();
        
        foreach ($query->result_array() as $q){
            if ($q['proposito'] <> null){
                return true;
            }else{
                return false;
            }
        }
    }
    
    function cargar_1_2($idEvaluacion){
        $this->db->select('*');
        $this->db->from('evaluacion_textos as et, evaluacion_atributo as at');
        $this->db->where('et.idEvaluacion', $idEvaluacion);
        $this->db->where('at.idEvaluacion', $idEvaluacion);
        $consulta = $this->db->get();
        return $consulta;
    }
    
    function existe_1_2($idEvaluacion){
        
        $this->db->select('*');
        $this->db->from('evaluacion_atributo as at');
        $this->db->where('at.idEvaluacion', $idEvaluacion);
        $query = $this->db->get();
        
        if($query->num_rows() == 0 ){
            return false;
        }else{
            return true;
        }
    }
    
    function editarTexto($texto, $idEvaluacion){
        $this->db->trans_start();
        
        $data = array(
               'texto' => $texto,
        );

        $this->db->where('idEvaluacion', $idEvaluacion);
        $this->db->update('evaluacion_textos', $data); 
        $idTexto = $this->db->insert_id();
        $this->db->trans_complete();
        
        return $idTexto;
    }
    
    
    function guardarTexto($texto, $idEvaluacion){
        $this->db->trans_start();

        $data1 = array(
            'idEvaluacion' => $idEvaluacion,
            'idItem' => 2,
            'texto' => $texto,
        );

        $this->db->insert('evaluacion_textos', $data1);  
        $this->db->trans_complete();

        return $idEvaluacion;
    }
    
    function guardarAtributos($idAtributo, $idEvaluacion){
        $this->db->trans_start();

       $data1 = array(
            'idEvaluacion' => $idEvaluacion,
            'idAtributo' => $idAtributo,
       );

       $this->db->insert('evaluacion_atributo', $data1); 
       $this->db->trans_complete();

       return $idEvaluacion;
    }
    
    function getAtributosSeleccionados($idEvaluacion){
        $this->db->select('*');
        $this->db->from('evaluacion_atributo');
        $this->db->where('idEvaluacion', $idEvaluacion);
        $consulta = $this->db->get();
        return $consulta;
    }
    
    function eliminarAtributos($idEvaluacion){
        $this->db->where('idEvaluacion', $idEvaluacion);
        $this->db->delete('evaluacion_atributo'); 
    }
    
    function eliminarTexto($idEvaluacion){
        $this->db->where('idEvaluacion', $idEvaluacion);
        $this->db->delete('evaluacion_textos'); 
    }
    
    function getPartes(){
        $this->db->select('*');
        $this->db->from('parte_evaluacion');
        $consulta = $this->db->get();
        return $consulta;
    }
    
    function getParteSeleccionada($idEvaluacion){
        $this->db->select('*');
        $this->db->from('evaluacion as e');
        $this->db->where('e.idEvaluacion', $idEvaluacion);
        $consulta = $this->db->get();
        return $consulta;
    }
    
    function agregarParte($parte, $idEvaluacion){
        $this->db->trans_start();

        $data = array(
             'idParte' => $parte,
        );

        $this->db->where('idEvaluacion', $idEvaluacion);
        $this->db->update('evaluacion', $data); 
        $this->db->trans_complete();
        
        return $parte;
    }
}