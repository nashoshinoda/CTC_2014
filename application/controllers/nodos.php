<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nodos extends CI_Controller{

	public function __construct(){
        parent::__construct();
        $this->load->model('NodosModel');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    
	public function index(){
        $data['title'] = '[SISTEMA GEOLOCALIZACIÓN]';
        $data['main_content'] = 'nodos/index';
        //$data['cResult'] = $this->showData();   //Aquí le mandamos a la vista la información del método showData por medio de la variable cResult
		$this->load->view('includes/template', $data);
    }

    public function showData(){
    	//Traigo la información del nodo y/o colonia por el método POST
    	$info = $this->input->post('nodos');
    	$colonia = $this->NodosModel->getInfo($info);
    	//Se crea el arreglo al comenzar la consulta
    	$coloniaArray = array();
    	foreach($colonia as $cResult){
    		$coloniaArray[] = array(
    			'numNodo'		=>	$cResult->numNodo,
    			'ubiCTC'		=>	$cResult->ubiCTC,
    			'nivelNodo'		=>	$cResult->nivelNodo,
    			'tipoNodo'		=>	$cResult->tipoNodo,
    			'direccionNodo'	=>	$cResult->direccionNodo,
    			'latNodo'		=>	$cResult->latNodo,
    			'lngNodo'		=>	$cResult->lngNodo
    		);
    	}
        //return $coloniaArray;
        $data['title'] = '[SISTEMA GEOLOCALIZACIÓN]';
        $data['main_content'] = 'nodos/index';
        $data['cResult'] = $coloniaArray;   //Aquí le mandamos a la vista la información del método userSearch por medio de la variable resultadoArray
        $this->load->view('includes/template', $data);

    }

    public function userSearch(){
        //Traigo la información del nodo y/o colonia por el método POST
        $busquedaNodo = $this->input->post('numNodos');
        $busquedaColonia = $this->input->post('nomColonias');
        $busquedaDireccion = $this->input->post('direccion');
        $resultadoBusqueda = $this->NodosModel->getInfoNodo($busquedaNodo, $busquedaDireccion, $busquedaColonia);
        //Se crea el arreglo al comenzar la consulta
        $resultadoArray = array();
        if($resultadoBusqueda){
            foreach ($resultadoBusqueda as $rBusqueda){
                $resultadoArray[] = array(
                    'numNodo'       =>  $rBusqueda->numNodo,
                    'ubiCTC'        =>  $rBusqueda->ubiCTC,
                    'nivelNodo'     =>  $rBusqueda->nivelNodo,
                    'tipoNodo'      =>  $rBusqueda->tipoNodo,
                    'direccionNodo' =>  $rBusqueda->direccionNodo,
                    'latNodo'       =>  $rBusqueda->latNodo,
                    'lngNodo'       =>  $rBusqueda->lngNodo,
                    'nombreColonia' =>  $rBusqueda->nombreColonia
                );
            }
        }
        //return $resultadoArray;
        //var_dump($resultadoArray);
        $data['title'] = '[SISTEMA GEOLOCALIZACIÓN]';
        $data['main_content'] = 'nodos/index';
        $data['rBusqueda'] = $resultadoArray;   //Aquí le mandamos a la vista la información del método userSearch por medio de la variable resultadoArray
        $this->load->view('includes/template', $data);
    }
    
}