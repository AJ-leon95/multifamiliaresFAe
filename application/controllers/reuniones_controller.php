<?php
class Reuniones_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();      
        $this->load->library('session');
        if (!$this->session->userdata('conectado')) {
            redirect('/Vista_general/login'); 
        }
        $this->load->model("Empresa_model");
        $this->load->model("Reunion_model");
    }
    public function index()
    {
        if (
            $this->session->userdata("conectado")->perfil == "ADMINISTRADOR" ||
            $this->session->userdata("conectado")->perfil == "PRESIDENTE" ||
            $this->session->userdata("conectado")->perfil == "SECRETARIO" ||
            $this->session->userdata("conectado")->perfil == "GERENTE"
        ) {
            $data["reuniones"] = $this->Reunion_model->obtenerDatos();
            $this->load->view("administracion/header");
            $this->load->view("reunion/index", $data);
            $this->load->view("administracion/footer");
        }
    }
    public function nuevoReunion()
    {
        if (
            $this->session->userdata("conectado")->perfil == "ADMINISTRADOR" ||
            $this->session->userdata("conectado")->perfil == "PRESIDENTE" ||
            $this->session->userdata("conectado")->perfil == "SECRETARIO" ||
            $this->session->userdata("conectado")->perfil == "GERENTE"
        ) {
            $data["empresa"] = $this->Empresa_model->obtenerDatos();
            $this->load->view("administracion/header");
            $this->load->view("reunion/nuevo", $data);
            $this->load->view("administracion/footer");
        }
    }
    public function reuniones()
    {
        if (
            $this->session->userdata("conectado")->perfil == "ADMINISTRADOR" ||
            $this->session->userdata("conectado")->perfil == "PRESIDENTE" ||
            $this->session->userdata("conectado")->perfil == "SECRETARIO" ||
            $this->session->userdata("conectado")->perfil == "GERENTE"||
            $this->session->userdata("conectado")->perfil == "SOCIO"
        ) {
            $data["reunion"] = $this->Reunion_model->obtenerDatos();
            $this->load->view("administracion/header");
            $this->load->view("reunion/reuniones", $data);
            $this->load->view("administracion/footer");
        }
    }
    public function editarReunion($id_reu)
    {
        if (
            $this->session->userdata("conectado")->perfil == "ADMINISTRADOR" ||
            $this->session->userdata("conectado")->perfil == "PRESIDENTE" ||
            $this->session->userdata("conectado")->perfil == "SECRETARIO" ||
            $this->session->userdata("conectado")->perfil == "GERENTE"
        ) {
            $data["empresa"] = $this->Empresa_model->obtenerDatos();
            $data["reunion"] = $this->Reunion_model->obtenerRegistro($id_reu);
            $this->load->view("administracion/header");
            $this->load->view("reunion/editar", $data);
            $this->load->view("administracion/footer");
        }
    }
    public function guardarReunion()
    {
        try {
            $data = array(
                "fk_reu_emp" => $this->input->post("fk_reu_emp"),
                "lugar_reu" => $this->input->post("lugar_reu"),
                "fecha_reu" => $this->input->post("fecha_reu"),
                "hora_reu" => $this->input->post("hora_reu"),
                "punto1" => $this->input->post("punto1"),
                "punto2" => $this->input->post("punto2"),
                "punto3" => $this->input->post("punto3"),
                "punto4" => $this->input->post("punto4"),
                "punto5" => $this->input->post("punto5"),
                "punto6" => $this->input->post("punto6"),
                "punto7" => $this->input->post("punto7"),
                "asunto_reu" => $this->input->post("asunto_reu"),
            );
            print_r($data);
            if ($this->Reunion_model->insertar($data)) {
                $this->session->set_flashdata('correcto', "Registro Creado");
            } else {
                echo "hubo un error !!";
            }
            redirect("Reuniones_controller/index");
        } catch (\Throwable $th) {
            echo "el correo ya esta registrado.";
        }
    }
    public function eliminarReunion($id_reu)
    {
        if ($this->Reunion_model->borrar($id_reu)) {
            $this->session->set_flashdata('eliminar', "Registro eliminado");
        } else {
            echo "ocurrio un error";
        }
        redirect("Reuniones_controller/index");
    }
    public function actualizarReunion()
    {
        $data = array(
            "fk_reu_emp" => $this->input->post("fk_reu_emp"),
            "lugar_reu" => $this->input->post("lugar_reu"),
            "fecha_reu" => $this->input->post("fecha_reu"),
            "hora_reu" => $this->input->post("hora_reu"),
            "punto1" => $this->input->post("punto1"),
            "punto2" => $this->input->post("punto2"),
            "punto3" => $this->input->post("punto3"),
            "punto4" => $this->input->post("punto4"),
            "punto5" => $this->input->post("punto5"),
            "punto6" => $this->input->post("punto6"),
            "punto7" => $this->input->post("punto7"),
            "asunto_reu" => $this->input->post("asunto_reu"),
        );
        $id_reu = $this->input->post("id_reu"); 
        // print_r($id_not);
        if ($this->Reunion_model->procesoActu($id_reu, $data)) {
            $this->session->set_flashdata("actualizar", "Registro Actualizado correctamente.");
        } else {
            $this->session->set_flashdata("eliminar", "algo salio mal intente otra ves.");
            echo "no se pudo actualizar";
        }
        redirect("Reuniones_controller/index");
    }
    public function obtenerEventosModales() {
        
        if (
            $this->session->userdata("conectado")->perfil == "ADMINISTRADOR" ||
            $this->session->userdata("conectado")->perfil == "PRESIDENTE" ||
            $this->session->userdata("conectado")->perfil == "SECRETARIO" ||
            $this->session->userdata("conectado")->perfil == "GERENTE" ||
            $this->session->userdata("conectado")->perfil == "SOCIO"
        ) {
            $datos = $this->Reunion_model->obtenerDatos();
    
            if ($datos) {
                echo json_encode($datos);
            } else {
                echo json_encode([]);
            }
        } else {
            
            echo json_encode(['error' => 'Acceso no autorizado']);
        }
    }
}
