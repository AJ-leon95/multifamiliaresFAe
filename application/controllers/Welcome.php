<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();
		    
        $this->load->library('session');
        if (!$this->session->userdata('conectado')) {
            redirect('/Vista_general/login'); 
        }
		$this->load->model("Kpi");
		
	}


	public function index()
	{
		$data["cantidad_vehiculos"]= $this->Kpi->CantidadAutos();
		$data["Cantidad_Socios"]= $this->Kpi->CantidadSocios();
		$data["Cantidad_Clientes"]= $this->Kpi->cantidadClientes();
		$data["Cantidad_Chofer"]= $this->Kpi->cantidadChofer();
		$data["taxitas_masCarreras"]= $this->Kpi->taxistaConMasCarreras();
		$data["taxitas_masEncomiendas"]= $this->Kpi->taxistaConMasEncomiendas();
		$this->load->view('administracion/header');
		$this->load->view('welcome_message',$data);
		$this->load->view('administracion/footer');
	}
}
