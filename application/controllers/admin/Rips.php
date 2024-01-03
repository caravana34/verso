<?php
// CT Archivo de control
// AF Archivo de transacciones
// US Archivo de usuarios de los servicios de salud
// AD Archivo de descripción agrupada de los servicios de salud prestados
// AC Archivo de consulta
// AP Archivo de procedimientos
// AU Archivo de urgencias con observación
// AH Archivo de hospitalización
// AN Archivo de recién nacidos
// AM Archivo de medicamentos
// AT Archivo de otros servicio
// codigo: 050882158402
defined('BASEPATH') OR exit('No direct script access allowed');

class Rips extends Admin_Controller
{
    
    public function __construct(){
      parent::__construct();
      $this->load->helper('file');	
//       $this->load->model(array('rips_model'));
      $this->load->model('rips_model');
      $this->load->library('datatables');

    }

    public function index(){

         $data = "hjacer rips.";
         $directory_path = FCPATH . 'uploads/rips/';
         // Specify the file path
         $file_path = FCPATH . 'uploads/rips/file.txt';


    //         echo "<pre>";
    //         print_r($directory_path);
    //         exit;

        // Write to the file
        if (write_file($file_path, $data)) {
            echo 'File written successfully!';
        } else {
            echo 'Unable to write the file.';
        } 
    }
  
    function generate_bill_rips(){
      
        $json_data = json_decode($this->input->raw_input_stream, true);
      
        $array_bill_rips = $json_data['array_bill_rips'];
      
        if(count($array_bill_rips) > 0){
 
            $name = 'carpetin';
            $route = FCPATH . 'uploads/rips/';
          
            foreach($array_bill_rips as $value){
                    $this->db->select('appointment.responsible,charges.charge_category_id, 
                                      charges.description, charges.name,charges.cups,
                                      charges.sura_cups,charges.iss,charges.paquete,patient_charges.*,patients.*');
    //               $this->db->join('doctor_shift','doctor_shift.staff_id = appointment.doctor',"inner");
    //               $this->db->join('staff','staff.id = appointment.doctor',"inner");
                    $this->db->join('patients','patients.id = appointment.patient_id',"inner");
                    $this->db->join('opd_details','opd_details.case_reference_id = appointment.case_reference_id',"left");
                    $this->db->join('charges','charges.id = appointment.charge_id', "inner");
                    $this->db->join('patient_charges','patient_charges.opd_id = opd_details.id', "inner");

                    $this->db->where('opd_details.id', $value);
//                     $this->db->where('appointment.appointment_status', 'Firmada');
                    $this->db->from('appointment');
              
                    $patient_charge = $this->db->get()->result();
                    $getVisitDetailsid             = $this->patient_model->getVisitDetailsid($value);
                    echo "<pre>";
                    print_r($getVisitDetailsid);
                    exit;
                    $custom_fields_data            = get_custom_table_values($patient_charge[0]->id, 'patient');


            }
          


//             if (!is_dir($route . $name)) {
//                 if (mkdir($route . $name, 0755, true)) {
//                     echo 'Carpeta creada con éxito.';
//                 } else {
//                     echo 'Error al crear la carpeta.';
//                 }
//             } else {
//                 echo 'La carpeta ya existe.';
//             }

            echo "<pre>";
            print_r($json_data['array_bill_rips']);
            exit;
          
            $array = array('state' => 'success', 'msg' => 'Se registraron los rips.');
          
        } else {
            $array = array('state' => 'fail', 'msg' => 'Debe seleccionar las facturas para registrar los rips.');
        }
      

        echo json_encode($array);

    }
  
    public function rips_datatable(){
      
        date_default_timezone_set("America/Bogota");
       
        $dt_response = $this->rips_model->get_rips_datatable();
        $dt_response = json_decode($dt_response);
        $dt_data     = array();
      
//         echo "<pre>";
//         print_r($dt_response->data);
//         exit;

        if (!empty($dt_response->data)) {
            foreach ($dt_response->data as $key => $value) {

                $row = array();
              
              
                $rips_data = json_encode($value);
              
//                 if($value->status == '1'){
//                     $class_status = 'cita_aprobada';
//                     $name_status = 'Activo';
//                 } else if($value->status == '0'){
//                     $class_status = 'cita_cancelada';
//                     $name_status = 'Inactivo';
//                 }
              
                $action  = "<small class='label' data-toggle='tooltip' title='' data-original-title='Agendamiento'></small>";
                $action .= "<div class='rowoptionview rowview-btn-top'>";
                $action .= "<button type='button' data-toggle='modal' data-target='#edit_lock_modal' data-toggle='tooltip' title='Editar' class='btn btn-default btn-xs' onclick='get_bill_rips($rips_data)'>
                              <i class='fa fa-pencil'></i>
                            </button>";         
                $action .= "</div>";

                $row[] = $value->id;
                $row[] = $value->responsible;
                $row[] = $value->registers;
                $row[] = $value->valor;
                $row[] = $value->folder;
                $row[] = $value->create_at;
                $row[] = $action;
                
                $dt_data[] = $row;               
            }
        }
        $json_data = array(
            "draw"            => intval($dt_response->draw),
            "recordsTotal"    => intval($dt_response->recordsTotal),
            "recordsFiltered" => intval($dt_response->recordsFiltered),
            "data"            => $dt_data,
        );
      
      
        echo json_encode($json_data);

    }
}