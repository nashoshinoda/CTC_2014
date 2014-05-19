<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
        if(empty($busquedaNodo) && empty($busquedaDireccion) && empty($busquedaColonia)){
            $this->db->where('numNodo', $busquedaNodo);
            $this->db->where('direccionNodo', $busquedaDireccion);
            $this->db->where('nombreColonia', $busquedaColonia);
        }
        /*COMBINACIONES CON VARIABLE NODO*/
        //Si ingresan únicamente el nodo
        if($busquedaNodo >= 0 && empty($busquedaColonia) && empty($busquedaDireccion)){
            $this->db->where('numNodo', $busquedaNodo);
        }
        //Si ingresan únicamente el nodo y la colonia
        if(!empty($busquedaNodo) && !empty($busquedaColonia)){
            $this->db->where('numNodo', $busquedaNodo);
            $this->db->where('nombreColonia', $busquedaColonia);
        }

        /*COMBINACIONES CON VARIABLE COLONIA*/
        //Si ingresan únicamente la colonia
        if(empty($busquedaNodo) && !empty($busquedaColonia) && empty($busquedaDireccion)){
            $this->db->where('nombreColonia', $busquedaColonia);
        }
        //Si ingresan únicamente la colonia y la dirección
        if(!empty($busquedaColonia) && !empty($busquedaDireccion)){
            $this->db->where('nombreColonia', $busquedaColonia);    
            $this->db->where('direccionNodo', $busquedaDireccion);
        }

        /*COMBINACIONES CON VARIABLE DIRECCION*/
        //Si ingresan únicamente la dirección
        if(empty($busquedaNodo) && empty($busquedaColonia) && !empty($busquedaDireccion)){
            $this->db->where('direccionNodo', $busquedaDireccion);
        }
        //Si ingresan únicamente el nodo y la dirección
        if(!empty($busquedaNodo) && !empty($busquedaDireccion)){
            $this->db->where('numNodo', $busquedaNodo);    
            $this->db->where('direccionNodo', $busquedaDireccion);
        }
        $query = $this->db->get();
        echo $this->db->last_query()."<br>";
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }
    
}