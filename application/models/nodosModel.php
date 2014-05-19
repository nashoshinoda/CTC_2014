<?php

class NodosModel extends CI_Model{
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
        //$this->load->helper('security');
    }
    
    public function getInfo($info){
        //SELECT numNodo, ubiCTC, nivelNodo, tipoNodo, direccionNodo, latNodo, lngNodo FROM nodos n INNER JOIN colonias c ON n.nodoId = c.coloniaId WHERE nombreColonia = 'Alcala';
        $this->db->select('numNodo, ubiCTC, nivelNodo, tipoNodo, direccionNodo, latNodo, lngNodo');
        $this->db->from('nodos');
        //$this->db->join('nodos n', 'reIdNodo = nodoId', 'inner');
        //$this->db->join('colonias c', 'reIdColonia = coloniaId', 'inner');
        //$this->db->where('NombreColonia', $info);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
        //var_dump($query);
    }

    public function getInfoNodo($busquedaNodo, $busquedaDireccion, $busquedaColonia){
        /*$this->db->select('numNodo, ubiCTC, nivelNodo, tipoNodo, direccionNodo, latNodo, lngNodo');
        $this->db->from('nodos');
        $this->db->where('numNodo', $busquedaNodo);
        $this->db->or_where('direccionNodo', $busquedaDireccion);*/
        $this->db->select('numNodo, ubiCTC, nivelNodo, tipoNodo, direccionNodo, latNodo, lngNodo, nombreColonia');
        $this->db->from('relaciones r');
        $this->db->join('colonias c', 'r.reIdColonia = c.coloniaId', 'inner');
        $this->db->join('nodos n', 'r.reIdNodo = n.nodoId', 'inner');
        if(!empty($busquedaNodo) && !empty($busquedaDireccion) && !empty($busquedaColonia)){
            $this->db->where('numNodo', $busquedaNodo);
            $this->db->where('direccionNodo', $busquedaDireccion);
            $this->db->where('nombreColonia', $busquedaColonia);
        }
        if($busquedaNodo >= 0 && empty($busquedaColonia) && empty($busquedaDireccion)){
            $this->db->where('numNodo', $busquedaNodo);
        }
        if(empty($busquedaNodo) && !empty($busquedaColonia)  && empty($busquedaDireccion)){
            $this->db->where('nombreColonia', $busquedaColonia);
        }
        if(empty($busquedaNodo) && empty($busquedaColonia)  && !empty($busquedaDireccion)){
            $this->db->where('direccionNodo', $busquedaDireccion);
        }
        $query = $this->db->get();
        //echo $this->db->last_query()."<br>";
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }
    
}
