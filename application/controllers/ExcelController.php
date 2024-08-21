<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelController extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        // Carga el modelo que contiene los datos de la tabla
        $this->load->model('Usuario_model');
        $this->load->model('Empresa_model');
        $this->load->model('Chofer_model');
        $this->load->model('Vehiculo_model');
        $this->load->model('Carreras_encomiendas_model');
    }

    public function generateExcel() {
        // Obtener los datos de la tabla desde el modelo
        $socio = $this->Usuario_model->obtenerDatosUsu();
      
        // ordena por orden alfabetico el array 
        usort($socio, function ($a, $b) {
            return strcmp($a->apellidos, $b->apellidos);
        });

        // Crear una nueva hoja de cálculo
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Establecer los encabezados de las columnas
        $sheet->setCellValue('A1', 'Multifamiliares Fae N°26');
        $sheet->setCellValue('B1', 'Lista de socios');
        $sheet->setCellValue('A2', 'Nº');
        $sheet->setCellValue('B2', 'Nombre');
        $sheet->setCellValue('C2', 'Apellidos');
        $sheet->setCellValue('D2', 'Cédula');
        $sheet->setCellValue('E2', 'Correo');
        $sheet->setCellValue('F2', 'Teléfono');
        $sheet->setCellValue('G2', 'Dirección');
        $sheet->setCellValue('H2', 'Perfil');

        // Añadir los datos de los socios
        $rowNumber = 3;
        $count = 1;
        foreach ($socio as $socios) {
            if($socios->perfil=="SOCIO"||$socios->perfil=="PRESIDENTE"||$socios->perfil=="SECRETARIO"||$socios->perfil=="GERENTE"){
            $sheet->setCellValue('A' . $rowNumber, $count);
            $sheet->setCellValue('B' . $rowNumber, $socios->nombres);
            $sheet->setCellValue('C' . $rowNumber, $socios->apellidos);
            $sheet->setCellValue('D' . $rowNumber, $socios->cedula_usu);
            $sheet->setCellValue('E' . $rowNumber, $socios->correo);
            $sheet->setCellValue('F' . $rowNumber, $socios->telefono);
            $sheet->setCellValue('G' . $rowNumber, $socios->direccion);
            $sheet->setCellValue('H' . $rowNumber, $socios->perfil);
            $rowNumber++;
            $count++;
            }
        }

        // Crear un escritor de Xlsx
        $writer = new Xlsx($spreadsheet);

        // Enviar el archivo al navegador para la descarga
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="socios.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
    public function generateExcelClientes() {
        // Obtener los datos de la tabla desde el modelo
        $cliente = $this->Usuario_model->obtenerDatosUsu();
      
        // ordena por orden alfabetico el array 
        usort($cliente, function ($a, $b) {
            return strcmp($a->apellidos, $b->apellidos);
        });

        // Crear una nueva hoja de cálculo
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Establecer los encabezados de las columnas
        $sheet->setCellValue('A1', 'Multifamiliares Fae N°26');
        $sheet->setCellValue('B1', 'Lista de cliente');
        $sheet->setCellValue('A2', 'Nº');
        $sheet->setCellValue('B2', 'Nombre');
        $sheet->setCellValue('C2', 'Apellidos');
        $sheet->setCellValue('D2', 'Correo');
        $sheet->setCellValue('E2', 'Teléfono');
        $sheet->setCellValue('F2', 'Dirección');

        // Añadir los datos de los cliente
        $rowNumber = 3;
        $count = 1;
        foreach ($cliente as $clientes) {
            if($clientes->perfil=="CLIENTE"){
            $sheet->setCellValue('A' . $rowNumber, $count);
            $sheet->setCellValue('B' . $rowNumber, $clientes->nombres);
            $sheet->setCellValue('C' . $rowNumber, $clientes->apellidos);
            $sheet->setCellValue('D' . $rowNumber, $clientes->correo);
            $sheet->setCellValue('E' . $rowNumber, $clientes->telefono);
            $sheet->setCellValue('F' . $rowNumber, $clientes->direccion);
            $rowNumber++;
            $count++;
            }
        }

        // Crear un escritor de Xlsx
        $writer = new Xlsx($spreadsheet);

        // Enviar el archivo al navegador para la descarga
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="cliente.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
    public function generateExcelChofer() {
        // Obtener los datos de la tabla desde el modelo
        $choferes = $this->Chofer_model->obtenerDatos();
      
        // ordena por orden alfabetico el array 
        usort($choferes, function ($a, $b) {
            return strcmp($a->apellidos, $b->apellidos);
        });

        // Crear una nueva hoja de cálculo
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Establecer los encabezados de las columnas
        $sheet->setCellValue('A1', 'Multifamiliares Fae N°26');
        $sheet->setCellValue('B1', 'Lista de choferes');
        $sheet->setCellValue('A2', 'Nº');
        $sheet->setCellValue('B2', 'Nombre');
        $sheet->setCellValue('C2', 'Apellidos');
        $sheet->setCellValue('D2', 'Telefono');
        $sheet->setCellValue('E2', 'Direccion');
        $sheet->setCellValue('F2', 'Estado');
        $sheet->setCellValue('G2', 'Experiencia');

        // Añadir los datos de los choferes
        $rowNumber = 3;
        $count = 1;
        foreach ($choferes as $choferess) {
           
            $sheet->setCellValue('A' . $rowNumber, $count);
            $sheet->setCellValue('B' . $rowNumber, $choferess->nombres_cho);
            $sheet->setCellValue('C' . $rowNumber, $choferess->apellidos_cho);
            $sheet->setCellValue('D' . $rowNumber, $choferess->telefono_cho);
            $sheet->setCellValue('E' . $rowNumber, $choferess->direccion_cho);
            $sheet->setCellValue('F' . $rowNumber, $choferess->estado_cho);
            $sheet->setCellValue('G' . $rowNumber, $choferess->experiencia_cho);
            $rowNumber++;
            $count++;
            
        }

        // Crear un escritor de Xlsx
        $writer = new Xlsx($spreadsheet);

        // Enviar el archivo al navegador para la descarga
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="choferes.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
    public function generateExcelVehiculos() {
        // Obtener los datos de la tabla desde el modelo
        $vehiculos = $this->Vehiculo_model->obtenerDatos();
      
        // ordena por orden alfabetico el array 
        usort($vehiculos, function ($a, $b) {
            return strcmp($a->apellidos, $b->apellidos);
        });

        // Crear una nueva hoja de cálculo
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Establecer los encabezados de las columnas
        $sheet->setCellValue('A1', 'Multifamiliares Fae N°26');
        $sheet->setCellValue('B1', 'Lista de vehiculos');
        $sheet->setCellValue('A2', 'Nº');
        $sheet->setCellValue('B2', 'Placa');
        $sheet->setCellValue('C2', 'Marca');
        $sheet->setCellValue('D2', 'Año Fabricación');
        $sheet->setCellValue('E2', 'Modelo');
        $sheet->setCellValue('F2', 'N° Unidad');
        $sheet->setCellValue('G2', 'Propietario');

        // Añadir los datos de los vehiculos
        $rowNumber = 3;
        $count = 1;
        foreach ($vehiculos as $vehiculoss) {
           
            $sheet->setCellValue('A' . $rowNumber, $count);
            $sheet->setCellValue('B' . $rowNumber, $vehiculoss->placa_veh);
            $sheet->setCellValue('C' . $rowNumber, $vehiculoss->marca_veh);
            $sheet->setCellValue('D' . $rowNumber, $vehiculoss->anio_veh);
            $sheet->setCellValue('E' . $rowNumber, $vehiculoss->modelo_veh);
            $sheet->setCellValue('F' . $rowNumber, $vehiculoss->numero);
            $sheet->setCellValue('G' . $rowNumber, $vehiculoss->nombres ." ".$vehiculoss->apellidos);
            $rowNumber++;
            $count++;
            
        }

        // Crear un escritor de Xlsx
        $writer = new Xlsx($spreadsheet);

        // Enviar el archivo al navegador para la descarga
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="vehiculos.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
    public function generateCarrerasPasadas() {
        // Obtener los datos de la tabla desde el modelo
      
        $id_usu= $this->session->userdata("conectado")->id_usu;
        $servicios = $this->Carreras_encomiendas_model->carrerasPasadas($id_usu);
       

        // Crear una nueva hoja de cálculo
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Establecer los encabezados de las columnas
        $sheet->setCellValue('A1', 'Multifamiliares Fae N°26');
        $sheet->setCellValue('B1', 'Lista mis carreras');
        $sheet->setCellValue('A1', 'Lista mis carreras');
        $sheet->setCellValue('B2', 'Fecha de creacion');
        $sheet->setCellValue('C2', 'Hora de creacion');
        $sheet->setCellValue('D2', 'Fecha de entrega');
        $sheet->setCellValue('E2', 'Hora de entrega');
        $sheet->setCellValue('F2', 'Servicio');
        $sheet->setCellValue('G2', 'Distancia');
        $sheet->setCellValue('H2', 'Precio');
        $sheet->setCellValue('I2', 'Solicitante');
        $sheet->setCellValue('J2', 'Telefono Solicitate');
        $sheet->setCellValue('K2', 'estado carrera');

        // Añadir los datos de los vehiculos
        $rowNumber = 3;
        $count = 1;
        foreach ($servicios as $servicioss) {
           
            $sheet->setCellValue('A' . $rowNumber, $count);
            $sheet->setCellValue('B' . $rowNumber, $servicioss->fecha_carrera);
            $sheet->setCellValue('C' . $rowNumber, $servicioss->hora_carrera);
            $sheet->setCellValue('D' . $rowNumber, $servicioss->fecha_entrega  );
            $sheet->setCellValue('E' . $rowNumber, $servicioss->hora_entrega);
            $sheet->setCellValue('F' . $rowNumber, $servicioss->tipo_ce);
            $sheet->setCellValue('G' . $rowNumber, $servicioss->distancia);
            $sheet->setCellValue('H' . $rowNumber, $servicioss->precio_carrera);
            $sheet->setCellValue('I' . $rowNumber, $servicioss->solicitante_nombres." ".$servicioss->solicitante_apellidos);
            $sheet->setCellValue('J' . $rowNumber, $servicioss->solicitante_telefono);
            $sheet->setCellValue('K' . $rowNumber, $servicioss->estadoCarrera);
            $rowNumber++;
            $count++;
            
        }

        // Crear un escritor de Xlsx
        $writer = new Xlsx($spreadsheet);

        // Enviar el archivo al navegador para la descarga
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="servicios.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}