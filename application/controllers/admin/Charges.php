<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Charges extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('unittype_model');
        $this->load->model('taxcategory_model');
        $this->load->library('datatables');
        $this->load->library('system_notification');
        $this->load->library('CSVReader');
        $this->config->load("image_valid");
        $this->load->library('encoding_lib');
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('hospital_charges', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'setup');
        $this->session->set_userdata('sub_sidebar_menu', 'admin/charges/index');
        $this->session->set_userdata('sub_menu', 'charges/index');
        $this->config->load("payroll");
        $charge_type         = $this->chargetype_model->get();
        $data["charge_type"] = $charge_type;
        $data['unit_type']   = $this->unittype_model->get();
        $data['schedule']    = $this->organisation_model->get();
        $data['taxcategory'] = $this->taxcategory_model->get();
        $search_text         = $this->input->post('search_text');
        $this->load->view("layout/header");
        $this->load->view("admin/charges/charge", $data);
        $this->load->view("layout/footer");
    }

  
  public function import()
{
    $fields = array('identification_number', 'insurance_validity', 'patient_name', 'otro_asegurador', 'departamento', 'ciudad', 'phone_principal', 'mobileno', 'email', 'address', 'ocupacion', 'gender', 'dob', 'age', 'regimen', 'responsable', 'responsable_numero', 'acompanante', 'acompanante_numero');
    $data["fields"] = $fields;

    $this->form_validation->set_rules('file', $this->lang->line('file'), 'callback_handle_csv_upload');

    if ($this->form_validation->run() == false) {
        echo "Error en la validación del archivo CSV";
    } else {
      
        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
  
            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

            if ($ext == 'csv') {
                $file = $_FILES['file']['tmp_name'];
                $delimiter = ";";

                $handle = fopen($file, "r");
                $firstLine = fgets($handle);

                $der = strpos($firstLine, $delimiter);
                if ($der > 0) {
                    $import_data = [];
                    $charges_organisation_data = [];

                    while (($datos = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
                          echo "<pre>";
                      print_r($datos);
                      exit;
                      
                        if ($datos[0] != '') {
                            
                            $search = array (" " , "$", "," , "." );    
                            $change = array ("","","","");
                            $valor = str_replace($search, $change,$datos[5]);


                            $tax = 5;


                            $nit = $datos[1];
                            if($datos[6] == "PAQUETES OTORRINOLARINGOLOGIA"){
                              $category_id = 27;
                            }else if($datos[6] == "PAQUETES ORTOPEDIA") {
                              $category_id = 29;
                            }else if($datos[6] == "PAQUETE DE CIRUGIA GENERAL") {
                              $category_id = 38;
                            }else if($datos[6] == "PAQUETE DE UROLOGIA") {
                              $category_id = 28;
                            }


                            $standard_charge = $datos[5];

                            $standard_charge = str_replace(['$', '.', ','], '', $standard_charge);

                            $charges = [];
                            $charges["charge_category_id"] = $category_id;
                            $charges["tax_category_id"] = $tax;
                            $charges["charge_unit_id"] = 5;
                            $charges["name"] = $datos[4];
                            $charges["description"] = $datos[7];
                            $charges["cups"] = $datos[1];
                            $charges["sura_cups"] = $datos[0];
                            $charges["paquete"] = $datos[3];
                            $charges["iss"] = $datos[2];
                            $charges["standard_charge"] = $standard_charge;
                            $charges["status"] = "vigente";
                            $charges["fecha_inicio"] = "2023-10-01";
                            $charges["fecha_final"] = "2024-01-31";
                              
//                             echo "<pre>";
//                             print_r($charges);
//                             exit;
                          
                          
                          
                            // Insertar en la tabla 'charges'
                            $this->db->insert('charges', $charges);
                            $charge_id = $this->db->insert_id();

                            // Insertar en la tabla 'charges_organisation'
                            $charges_organisation_data[] = array(
                                'org_id' => 1,
                                'charge_id' => $charge_id,
                                'org_charge' => $standard_charge
                            );
                        }
                    }

                    fclose($handle);

                    // Insertar en la tabla 'charges_organisation'
                    if (!empty($charges_organisation_data)) {
                        $this->db->insert_batch('organisations_charges', $charges_organisation_data);
                    }

                    // Redirigir después de la importación
                    redirect('admin/charges/charge');
                }
            } else {
                echo "El archivo debe tener extensión CSV";
            }
        }
    }
}
  
  
  
  
  public function import_incodol(){
    $fields        = array('identification_number','insurance_validity','patient_name','otro_asegurador','departamento','ciudad','phone_principal','mobileno','email','address','ocupacion','gender','dob','age','regimen','responsable','responsable_numero','acompanante','acompanante_numero' );
    $data["fields"] = $fields;
//     echo "<pre>";
//           print_r("hola");
//           exit;
       $this->form_validation->set_rules('file', $this->lang->line('file'), 'callback_handle_csv_upload');
    
         
//          echo "<pre>";
//           print_r("true");
//           exit;
    
       if ($this->form_validation->run() == false) {
          
//           echo "<pre>";
//           print_r("false");
//           exit;
 
        } else{
         
              if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $ext        = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

                if ($ext == 'csv') {
                  
                  $file   = $_FILES['file']['tmp_name'];
                  $delimiter= ";";

                  $handle = fopen($file,"r");
                  $firstLine = fgets($handle);

                  $der = strpos($firstLine, $delimiter);
                  echo "<pre>";
                  print_r($der);
                  exit;
                  if ($der>0){
                  $import_data = [];
                  while (($datos = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
                    
                    
                    
                    
                    
                    
                      if( $datos[0] != ''){
                        
                        $search = array (" " , "$", "," , "." );    
                        $change = array ("","","","");
                        $valor = str_replace($search, $change,$datos[5]);
                        
                        $nit = $datos[1];
                        if($datos[12] == 0){
                          $tax = 5;
                        }else {
                          $tax = 5;
                        }
                        
                        $nit = $datos[1];
                        if($datos[3] == "ANTICIPO"){
                          $category_id = 15;
                        }else if($datos[3] == "COPAGO") {
                          $category_id = 16;
                        }else if($datos[3] == "CUOTA MODERADORA") {
                          $category_id = 17;
                        }else if($datos[3] == "DERECHO DE SALA") {
                          $category_id = 18;
                        }else if($datos[3] == "ESTANCIA") {
                          $category_id = 19;
                        }else if($datos[3] == "IMAGENOLOGIA") {
                          $category_id = 20;
                        }else if($datos[3] == "INSUMOS") {
                          $category_id = 21;
                        }else if($datos[3] == "LABORATORIO") {
                          $category_id = 22;
                        }else if($datos[3] == "MATERIALES") {
                          $category_id = 23;
                        }else if($datos[3] == "MEDICAMENTOS") {
                          $category_id = 24;
                        }else if($datos[3] == "ORTOPEDIA") {
                          $category_id = 25;
                        }else if($datos[3] == "PROCEDIMIENTOS") {
                          $category_id = 26;
                        }
                        if($datos[3] == "ANTICIPO"){
                          $category_id = 15;
                        }else{
                          
                        }
                        $standard_charge = $datos[11];
                        $valor_ajustado = $datos[13];
                        
                        $standard_charge = str_replace(['$', '.'], '', $standard_charge);
                        $standard_charge = str_replace(',', '.', $standard_charge);
                        $standard_charge = preg_replace('/\.0+$/', '', $standard_charge);
                        
                        $valor_ajustado = str_replace(['$', '.'], '', $valor_ajustado);
                        $valor_ajustado = str_replace(',', '.', $valor_ajustado);
                        $valor_ajustado = preg_replace('/\.0+$/', '', $valor_ajustado);
                        
                        $charges = [];
                        $charges_organisation = [];
                        $charges["charge_category_id"] = $category_id;
                        $charges["tax_category_id"] = $tax;
                        $charges["charge_unit_id"] = 5;
                        $charges["code"] = $datos[0];
                        $charges["name"] = $datos[1];
                        $charges["grupo_quirurgico"] = $datos[6];
                        $charges["uni_ref"] = $datos[7];
                        $charges["uvr"] = $datos[8];
                        $charges["factor_sml"] = $datos[9];
                        $charges["type_plan"] = $datos[5];
                        $charges["standard_charge"] = $standard_charge;
                        $charges["porcentaje_cargo"] = $datos[12];
                        $charges["valor_ajustado"] = $valor_ajustado;
                        $charges["autorizacion"] = $datos[14];
                        $charges["status"] = $datos[15];
                        $charges["plan_tarifa"] = $datos[16];
                        $charges["date"] = $datos[10];
                        array_push($import_data, $charges);
                        
                       
                        
                      }
//  echo "<pre>";
//           print_r($import_data);
//           exit;
                }
                fclose($handle);
                $this->db->insert_batch('charges', $import_data);
                $affected_rows = $this->db->affected_rows();
//          echo "<pre>";
//           print_r($import_data);
//           exit;

           
                    

          // Get the number of affected rows

            // Check if the update was successful
           if ($affected_rows > 0) {
                // Update was successful
                echo "Update successful for ID {$value->id}. $affected_rows row(s) updated.<br>";
            } else {
                // No rows were updated
                echo "Update failed for ID {$value->id}. No rows were updated.<br>";
            }
               
               
              }else{
               
               
              }  
                 
                     
                            
                    }
                }
                redirect('admin/patient/import');
            
       
         
       }
  }
  
      public function handle_csv_upload()
    {

        $image_validate = $this->config->item('filecsv_validate');
        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {

            $file_type         = $_FILES["file"]['type'];
            $file_size         = $_FILES["file"]["size"];
            $file_name         = $_FILES["file"]["name"];
            $allowed_extension = $image_validate['allowed_extension'];
            $ext               = pathinfo($file_name, PATHINFO_EXTENSION);
            $allowed_mime_type = $image_validate['allowed_mime_type'];
            if ($files = filesize($_FILES['file']['tmp_name'])) {

                if (!in_array($file_type, $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_csv_upload', $this->lang->line('file_type_not_allowed'));
                    return false;
                }

                if (!in_array($ext, $allowed_extension) || !in_array($file_type, $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_csv_upload', $this->lang->line('file_extension_not_allowed'));
                    return false;
                }
                    $this->form_validation->set_message('handle_csv_upload', $this->lang->line('file_size_shoud_be_less_than') . number_format($image_validate['upload_size'] / 1048576, 2) . " MB");
                if ($file_size > $image_validate['upload_size']) {
          
                    return false;
                }
            } else {
                $this->form_validation->set_message('handle_csv_upload', $this->lang->line('file_type_extension_not_allowed'));
                return false;
            }

            return true;
        } else {
            $this->form_validation->set_message('handle_csv_upload', $this->lang->line('the_file_field_is_required'));
            return false;
        }
        return true;
    }
  
  
  
    public function getDatatable()
    {
        $dt_response = $this->charge_model->getDatatableAllRecord($search_text);
        $search_text = $this->input->post('search_text');
//         $dt_response = $this->patient_model->searchDataTablePatientRecord($search_text);
        $dt_response = json_decode($dt_response);
//           echo "<pre>";
//     print_r($dt_response);
//     exit;
      
        $dt_data     = array();
        $style = "<div class='".$color_back."' style='width:200px;padding:15px;height:auto;border-radius:5px;'>";
        $style_codes = "<div class='".$color_back."' style='width:50px;padding:15px;height:auto;border-radius:5px;'>";
        $style_descriptions = "<div class='".$color_back."' style='width:260px;padding:10px;height:auto;border-radius:5px;'>";
        if (!empty($dt_response->data)) {
            foreach ($dt_response->data as $charge_key => $charge_value) {

                $row    = array();
                $action = "<div class='rowoptionview rowview-mt-19'>";
                $action .= "<a href='#' onclick='viewDetail(" . $charge_value->id . ")' class='btn btn-default btn-xs'  data-toggle='tooltip' title='" . $this->lang->line('show') . "' > <i class='fa fa-reorder'></i></a>";

                if ($this->rbac->hasPrivilege('hospital_charges', 'can_edit')) {
                    $action .= "<a  href='javascript:void(0)' class='btn btn-default btn-xs edit_record edit_charge_modal' data-loading-text='" . $this->lang->line('please_wait') . "' data-toggle='tooltip' data-record-id=" . $charge_value->id . "  title='" . $this->lang->line('edit') . "'><i class='fa fa-pencil'></i></a>";
                }

                if ($this->rbac->hasPrivilege('hospital_charges', 'can_delete')) {
                    $action .= "<a class='btn btn-default btn-xs' data-toggle='tooltip' title='' onclick='delete_recordById(\"admin/charges/delete/" . $charge_value->id . "\", \"" . $this->lang->line('delete_message') . "\")' data-original-title='" . $this->lang->line('delete') . "'> <i class='fa fa-trash'></i></a>";
                }

                $action .= "</div>";

                $row[] = $style.$charge_value->name . $action."</div>";
                $row[] = $style.$charge_value->charge_type_name."<br>".$charge_value->charge_category_name."</div>";
                $row[] = $style_descriptions.$charge_value->description."</div>";
                $row[] = $style_codes.$charge_value->paquete."<div>";
                $row[] = $style_codes.$charge_value->cups."<div>";
                $row[] = $style_codes.$charge_value->sura_cups."<div>";
                $row[] = $style_codes.$charge_value->iss."<div>";
                $row[] = $charge_value->standard_charge." ".$charge_value->unit;

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
  
  
  public function getchargesListAjax()
    {
    
        $search_term = $this->input->post("searchTerm");
        if (isset($search_term) && $search_term != '') {
            $result = $this->charge_model->getcharges_fy($search_term);

//     echo "<pre>";
//     print_r($result);
//     exit;
            $data   = array();
            if (!empty($result)) {

                foreach ($result as $value) {
//                    $data[] = array("id" => $value->id, "type"=>$value->charge_category_id,"text" => $value->name);
                    $data[] = array("id" => $value->id, "type"=>$value->charge_category_id,"especialidad"=>$value->especialidad,"text" => $value->cups. " " . $value->name." ".$value->sura_cups );}
                  
//                   if($value->charge_category_id == 14){
//                       $data[] = array("id" => $value->id, "type"=>$value->charge_category_id,"text" => $value->cups." ".$value->name." ".$value->iss." ".$value->cups." ".$value->sura_cups);
                    
//                   }else{
//                      $data[] = array("id" => $value->id, "type"=>$value->charge_category_id,"text" => $value->cups. " " . $value->name." ".$value->sura_cups );}
                    
//                   }
                }
            }
            echo json_encode($data);
        }
    
  public function getchargesListAjax_id($id)
    {
    
      
        if (isset($id) && $id != '') {
            $result = $this->charge_model->getcharges_fy_id($id);

//     echo "<pre>";
//     print_r($result);
//     exit;
            $data   = array();
            if (!empty($result)) {

                foreach ($result as $value) {
                  if($value->charge_category_id == 14){
                      $data[] = array("id" => $value->id, "type"=>$value->charge_category_id,"text" => $value->name." ".$value->plan." ".$value->iss." ".$value->cups." ".$value->sura_cups);
                    
                  }else{
                     $data[] = array("id" => $value->id, "type"=>$value->charge_category_id,"text" => $value->description. " " . $value->cups." ".$value->sura_cups );
                    
                  }
                }
            }
            echo json_encode($data);
        }
    }

    public function add_charges()
    {
        if (!$this->rbac->hasPrivilege('hospital_charges', 'can_add')) {
            access_denied();
        }

        $this->form_validation->set_rules('charge_type', $this->lang->line('charge_type'), 'required');
        $this->form_validation->set_rules('charge_category', $this->lang->line('charge_category'), 'required');
        $this->form_validation->set_rules('unit_type', $this->lang->line('unit_type'), 'required');
        $this->form_validation->set_rules('charge_name', $this->lang->line('charge_name'), 'required');
        $this->form_validation->set_rules('taxcategory', $this->lang->line('tax_category'), 'required');
        $this->form_validation->set_rules('standard_charge', $this->lang->line('standard_charge'), 'required');

        if ($this->form_validation->run() == false) {
            $msg = array(
                'charge_type'     => form_error('charge_type'),
                'charge_category' => form_error('charge_category'),
                'unit_type'       => form_error('unit_type'),
                'charge_name'     => form_error('charge_name'),
                'taxcategory'     => form_error('taxcategory'),
                'standard_charge' => form_error('standard_charge'),

            );
            $json_array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {

            $data = array(
                'id'                 => $this->input->post('id'),
                'charge_category_id' => $this->input->post('charge_category'),
                'name'               => $this->input->post('charge_name'),
                'description'        => $this->input->post('description'),
                'standard_charge'    => $this->input->post('standard_charge'),
                'charge_unit_id'     => $this->input->post('unit_type'),
                'tax_category_id'    => $this->input->post('taxcategory'),
                'cups'               => $this->input->post('codigo_cups'),
                'sura_cups'          => $this->input->post('codigo_sura_cups'),
                'paquete'            => $this->input->post('paquetes'),
                'uvr'                => $this->input->post('uvr')
            );
        

            $schedule_charge      = $this->input->post('schedule_charge_id');
            $i                    = 0;
            $organisation_charges = array();
            if (!empty($schedule_charge)) {
                foreach ($schedule_charge as $key => $value) {
                    $org_charge    = $this->input->post("schedule_charge_" . $value);
                    $schedule_data = array(
                        'charge_id'  => null,
                        'org_id'     => $value,
                        'org_charge' => $org_charge,
                    );

                    $organisation_charges[] = $schedule_data;
                }
            }
            $insert_id  = $this->charge_model->add($data, $organisation_charges);
            $json_array = array('status' => 1, 'error' => '', 'message' => $this->lang->line('success_message'));
        }

        echo json_encode($json_array);
    }

    public function get_charge_category()
    {
        $charge_type = $this->input->post("charge_type");
        $data        = $this->charge_model->getChargeCategory($charge_type);
        echo json_encode($data);
    }

    public function getChargeByModule()
    {
        $module_shortcode = $this->input->post("module");
        $charge_category  = $this->charge_category_model->getCategoryByModule($module_shortcode);
        echo json_encode($charge_category);
    }

    public function getDetails()
    {
        if (!$this->rbac->hasPrivilege('hospital_charges', 'can_view')) {
            access_denied();
        }
        $id           = $this->input->post("charges_id");
        $organisation = $this->input->post("organisation");
        $result       = $this->charge_model->getDetails($id, $organisation);
        $json_array   = array('status' => '1', 'error' => '', 'result' => $result);
        echo json_encode($json_array);
    }

    public function viewDetails()
    {
        if (!$this->rbac->hasPrivilege('hospital_charges', 'can_view')) {
            access_denied();
        }
        $id             = $this->input->post("charges_id");
        $data['result'] = $this->charge_model->getDetails($id, "");
        $page           = $this->load->view("admin/charges/_viewDetails", $data, true);
        echo json_encode(array('status' => 1, 'page' => $page));
    }

    public function getScheduleChargeBatch()
    {
        $id                = $this->input->post("charges_id");
        $result            = $this->charge_model->getScheduleChargeBatch($id);
        $data["result"]    = $result;
        $allCharge         = $this->charge_model->getOrganisationCharges($id);
        $data["allCharge"] = $allCharge;
        $this->load->view('admin/charges/schedulechargeDetail', $data);
    }

    public function delete($id)
    {
        if (!$this->rbac->hasPrivilege('hospital_charges', 'can_delete')) {
            access_denied();
        }
        $result = $this->charge_model->delete($id);
        echo json_encode(array('status' => 1, 'msg' => $this->lang->line('delete_message')));
    }

    public function scheduleChargeBatchGet()
    {
        $id                = $this->input->post("charges_id");
        $result            = $this->charge_model->getScheduleChargeBatch($id);
        $data["result"]    = $result;
        $allCharge         = $this->charge_model->getOrganisationCharges($id);
        $data["allCharge"] = $allCharge;
        $this->load->view('admin/charges/schedulechargeEdit', $data);
    }

    public function add_ipdcharges()
    {
        $add_type = $this->input->post('add_type');
        if ($add_type == 'save') {
            $total_rows = $this->input->post('pre_charge_id');

            if (!isset($total_rows)) {
                $msg        = array('no_records' => $this->lang->line('please_add_charge_details'));
                $json_array = array('status' => 'fail', 'error' => $msg, 'message' => '');
            } else {
                $charge_data = $this->input->post('pre_charge_id');
                foreach ($charge_data as $key => $value) {
                    $date              = $this->input->post('pre_date')[$key];
                    $patient_charge_id = $this->input->post('patient_charge_id');
                    $insert_data       = array(
                        'date'            => $this->customlib->dateFormatToYYYYMMDDHis($date, $this->customlib->getHospitalTimeFormat()),
                        'charge_id'       => $this->input->post('pre_charge_id')[$key],
                        'qty'             => $this->input->post('pre_qty')[$key],
                        'ipd_id'          => $this->input->post('ipdid'),
                        'tpa_charge'      => $this->input->post('pre_tpa_charges')[$key],
                        'apply_charge'    => $this->input->post('pre_apply_charge')[$key],
                        'standard_charge' => $this->input->post('pre_standard_charge')[$key],
                        'amount'          => $this->input->post('pre_net_amount')[$key],
                        'created_at'      => date('Y-m-d'),
                        'note'            => $this->input->post('pre_note')[$key],
                        'tax'             => $this->input->post('pre_tax_percentage')[$key],
                    );

                    if ($patient_charge_id > 0) {
                        $insert_data['id'] = $patient_charge_id;
                    }
 
                    $this->charge_model->add_charges($insert_data);
                    
                  $preview_data = $this->charge_model->getDetails($this->input->post('pre_charge_id')[$key], "");
                  
                $doctor_list       = $this->patient_model->getDoctorsipd($this->input->post('ipdid'));
                $consultant_doctor = $this->patient_model->get_patientidbyIpdId($this->input->post('ipdid'));
                $consultant_doctorarray[] = array('consult_doctor' => $consultant_doctor['cons_doctor'], 'name' =>$consultant_doctor['doctor_name'] . " " . $consultant_doctor['doctor_surname'] . "(" . $consultant_doctor['doctor_employee_id'] . ")");
                foreach ($doctor_list as $key => $value) {
                    $consultant_doctorarray[] = array('consult_doctor' => $value['consult_doctor'], 'name' => $value['ipd_doctorname'] . " " . $value['ipd_doctorsurname'] . "(" . $value['employee_id'] . ")");
                }

                $event_data = array(
                    'patient_id'      => $consultant_doctor['patient_id'],
                    'ipd_no'          => $this->customlib->getSessionPrefixByType('ipd_no') . $this->input->post('ipdid'),
                    'charge_type'     => $preview_data->charge_type_name,
                    'charge_category' => $preview_data->charge_category_name,
                    'charge_name'     => $preview_data->name,
                    'qty'             => $this->input->post('pre_qty')[$key],
                    'net_amount'      => $this->input->post('pre_net_amount')[$key],
                    'edit_note'      => $this->input->post('pre_note')[$key],
                    'date'            => $this->customlib->YYYYMMDDHisTodateFormat($this->input->post('pre_date')[$key], $this->customlib->getHospitalTimeFormat()),
                );

                $this->system_notification->send_system_notification('add_ipd_patient_charge', $event_data, $consultant_doctorarray);                   
                    
                }
                $json_array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('record_saved_successfully'));
            }
        } else {

            $this->form_validation->set_rules('charge_type', $this->lang->line('charge_type'), 'required');
            $this->form_validation->set_rules('qty', $this->lang->line('qty'), 'required');
            $this->form_validation->set_rules('charge_category', $this->lang->line('charge_category'), 'required');
            $this->form_validation->set_rules('apply_charge', $this->lang->line('applied_charge'), 'required');
            $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'required');
            $this->form_validation->set_rules('charge_id', $this->lang->line('charge_name'), 'required');
            $this->form_validation->set_rules('date', $this->lang->line('date'), 'required');
 
            if ($this->form_validation->run() == false) {
                $msg = array(
                    'qty'             => form_error('qty'),
                    'date'            => form_error('date'),
                    'charge_type'     => form_error('charge_type'),
                    'charge_category' => form_error('charge_category'),
                    'apply_charge'    => form_error('apply_charge'),
                    'amount'          => form_error('amount'),
                    'charge_id'       => form_error('charge_id'),
                );
                $json_array = array('status' => 'fail', 'error' => $msg, 'message' => '');
            } else {

                $preview_data = $this->charge_model->getDetails($_POST['charge_id'], "");
                $data   =  $this->input->post('date');
                $temp_data = array(
                    'charge_id'          => $preview_data->id,
                    'charge_name'        => $preview_data->name,
                    'charge_type_id'     => $preview_data->charge_type_master_id,
                    'charge_type_name'   => $preview_data->charge_type_name,
                    'charge_category'    => $preview_data->charge_category_name,
                    'charge_category_id' => $preview_data->charge_category_id,
                    'qty'                => $this->input->post('qty'),
                    'apply_charge'       => $this->input->post('apply_charge'),
                    'standard_charge'    => $this->input->post('standard_charge'),
                    'tpa_charge'         => $this->input->post('schedule_charge'),
                    'amount'             => $this->input->post('apply_charge'),
                    'tax'                => $this->input->post('tax'),
                    'net_amount'         => $this->input->post('amount'),
                    'tax_percentage'     => $this->input->post('charge_tax'),
                    'note'               => $this->input->post('note'),
                    'date'               => $this->customlib->YYYYMMDDHisTodateFormat($data,$this->customlib->getHospitalTimeFormat())
                );
 
               
                $json_array = array('status' => 'new_charge', 'error' => '', 'data' => $temp_data);
            }
        }
        echo json_encode($json_array);
    }

    public function edit_ipdcharges()
    {
        $this->form_validation->set_rules('charge_type', $this->lang->line('charge_type'), 'required');
        $this->form_validation->set_rules('charge_category', $this->lang->line('charge_category'), 'required');
        $this->form_validation->set_rules('apply_charge', $this->lang->line('applied_charge'), 'required');
        $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'required');
        $this->form_validation->set_rules('charge_id', $this->lang->line('charge_name'), 'required');
        $this->form_validation->set_rules('qty', $this->lang->line('qty'), 'required');
        $this->form_validation->set_rules('date', $this->lang->line('date'), 'required');
        $this->form_validation->set_rules('charge_tax', $this->lang->line('tax'), 'required');
        if ($this->form_validation->run() == false) {
            $msg = array(
                'date'            => form_error('date'),
                'charge_type'     => form_error('charge_type'),
                'charge_category' => form_error('charge_category'),
                'apply_charge'    => form_error('apply_charge'),
                'amount'          => form_error('amount'),
                'qty'             => form_error('qty'),
                'charge_id'       => form_error('charge_id'),
                'charge_tax'      => form_error('charge_tax'),
            );
            $json_array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $patient_charge_id = $this->input->post('patient_charge_id');
            $date              = $this->input->post('date');
            $insert_data       = array(
                'date'            => $this->customlib->dateFormatToYYYYMMDDHis($date, $this->customlib->getHospitalTimeFormat()),
                'charge_id'       => $this->input->post('charge_id'),
                'qty'             => $this->input->post('qty'),
                'ipd_id'          => $this->input->post('ipdid'),
                'apply_charge'    => $this->input->post('apply_charge'),
                'amount'          => $this->input->post('amount'),
                'standard_charge' => $this->input->post('standard_charge'),
                'tpa_charge'      => $this->input->post('schedule_charge'),
                'created_at'      => date('Y-m-d'),
                'note'            => $this->input->post('note'),
                'tax'             => $this->input->post('charge_tax'),
            );
            if ($patient_charge_id > 0) {
                $insert_data['id'] = $patient_charge_id;
            }
            $this->charge_model->add_charges($insert_data);
            $json_array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('record_saved_successfully'));
        }
        echo json_encode($json_array);
    }

    public function edit_opdcharges()
    {
        $this->form_validation->set_rules('charge_type', $this->lang->line('charge_type'), 'required');
        $this->form_validation->set_rules('qty', $this->lang->line('qty'), 'required');
        $this->form_validation->set_rules('charge_category', $this->lang->line('charge_category'), 'required');
        $this->form_validation->set_rules('apply_charge', $this->lang->line('applied_charge'), 'required');
        $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'required');
        $this->form_validation->set_rules('charge_id', $this->lang->line('charge_name'), 'required');
        $this->form_validation->set_rules('date', $this->lang->line('date'), 'required');
        if ($this->form_validation->run() == false) {
            $msg = array(
                'qty'             => form_error('qty'),
                'date'            => form_error('date'),
                'charge_type'     => form_error('charge_type'),
                'charge_category' => form_error('charge_category'),
                'apply_charge'    => form_error('apply_charge'),
                'amount'          => form_error('amount'),
                'charge_id'       => form_error('charge_id'),
            );
            $json_array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $date              = $this->input->post('date');
            $patient_charge_id = $this->input->post('patient_charge_id');
            $insert_data       = array(
                'date'            => $this->customlib->dateFormatToYYYYMMDDHis($date, $this->customlib->getHospitalTimeFormat()),
                'charge_id'       => $this->input->post('charge_id'),
                'qty'             => $this->input->post('qty'),
                'opd_id'          => $this->input->post('opd_id'),
                'apply_charge'    => $this->input->post('apply_charge'),
                'standard_charge' => $this->input->post('standard_charge'),
                'tpa_charge'      => $this->input->post('schedule_charge'),
                'amount'          => $this->input->post('amount'),
                'created_at'      => date('Y-m-d'),
                'note'            => trim($this->input->post('note')),
                'tax'             => $this->input->post('charge_tax'),
            );

            if ($patient_charge_id > 0) {
                $insert_data['id'] = $patient_charge_id;
            }

            $this->charge_model->add_charges($insert_data);
            $json_array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('record_saved_successfully'));
        }
        echo json_encode($json_array);
    }
  
  
  
  
   public function charges_clini(){
     $data = $this->input->post('data');
     $result          = $this->charge_model->getchargeDetails_clini($data['charge_id']);
//                       echo "<pre>";
//           print_r($result[0]['standard_charge'] );
//           exit;
     $date = $data['date'];
        $insert_data       = array(
              'date'            => $this->customlib->dateFormatToYYYYMMDDHis($date, $this->customlib->getHospitalTimeFormat()),
              'charge_id'       => $data['charge_id'],
              'qty'             => 1,
              'opd_id'          => $data['opd_details_id'],
              'tpa_charge'      => 0,
              'apply_charge'    =>$result[0]['standard_charge'],
              'standard_charge' => $result[0]['standard_charge'],
              'amount'          => $result[0]['standard_charge'],
              'created_at'      => date('Y-m-d'),
              'tax'             => 0,
          );

         
     $this->charge_model->add_charges($insert_data);
     
//      echo "<pre>";
//      print_r($data);
//      exit;
    
     echo json_encode($date);
   }

    public function add_opdcharges()
    {
        $add_type = $this->input->post('add_type');
      
      
        if ($add_type == 'save') {
            $total_rows = $this->input->post('pre_charge_id');
            if (!isset($total_rows)) {
                $msg        = array('no_records' => $this->lang->line('please_add_charge_details'));
                $json_array = array('status' => 'fail', 'error' => $msg, 'message' => '');
             
            } else {
                $charge_data = $this->input->post('pre_charge_id');
                foreach ($charge_data as $key => $value) {
//                     $date              = $this->input->post('pre_date')[$key];
                    $date              = $this->input->post('date');
                    $patient_charge_id = $this->input->post('patient_charge_id');
                    $insert_data       = array(
                        'date'            => $this->customlib->dateFormatToYYYYMMDDHis($date, $this->customlib->getHospitalTimeFormat()),
                        'charge_id'       => $this->input->post('pre_charge_id')[$key],
                        'qty'             => $this->input->post('pre_qty')[$key],
                        'opd_id'          => $this->input->post('opd_id'),
                        'tpa_charge'      => $this->input->post('pre_tpa_charges')[$key],
                        'apply_charge'    => $this->input->post('pre_apply_charge')[$key],
                        'standard_charge' => $this->input->post('pre_standard_charge')[$key],
                        'amount'          => $this->input->post('pre_net_amount')[$key],
                        'created_at'      => date('Y-m-d'),
                        'note'            => $this->input->post('note'),
                        'tax'             => $this->input->post('pre_tax_percentage')[$key],
                    );
//                   echo "<pre>";
//       print_r($insert_data );
//       exit;

                    if ($patient_charge_id > 0) {
                        $insert_data['id'] = $patient_charge_id;
                    }
                  
                    $preview_data   = $this->charge_model->getDetails($this->input->post('pre_charge_id')[$key], "");
                    $patient_data   = $this->patient_model->get_patientidbyopdid($this->input->post('opd_id'));
                    $doctor_details = $this->notificationsetting_model->getstaffDetails($patient_data['doctor_id']);

                    $event_data = array(
                        'patient_id'      => $patient_data['patient_id'],
                        'doctor_id'       => $patient_data['doctor_id'],
                        'doctor_name'     => composeStaffNameByString($doctor_details['name'], $doctor_details['surname'], $doctor_details['employee_id']),
                        'opd_no'          => $this->customlib->getSessionPrefixByType('opd_no') . $this->input->post('opd_id'),
                        'charge_type'     => $preview_data->charge_type_name,
                        'charge_category' => $preview_data->charge_category_name,
                        'charge_name'     => $preview_data->name,
                        'qty'             => $this->input->post('pre_qty')[$key],
                        'net_amount'      => $this->input->post('pre_net_amount')[$key],
                        'edit_note'      => $this->input->post('pre_note')[$key],                        
                        'date'            => $this->customlib->YYYYMMDDHisTodateFormat($this->input->post('pre_date')[$key], $this->customlib->getHospitalTimeFormat()), 
                    );

                    $this->system_notification->send_system_notification('add_opd_patient_charge', $event_data);
                    $this->charge_model->add_charges($insert_data);
      

                }
                $json_array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('record_saved_successfully'));
            }

        } else {

            $this->form_validation->set_rules('charge_type', $this->lang->line('charge_type'), 'required');
            $this->form_validation->set_rules('qty', $this->lang->line('qty'), 'required');
            $this->form_validation->set_rules('charge_category', $this->lang->line('charge_category'), 'required');
            $this->form_validation->set_rules('apply_charge', $this->lang->line('applied_charge'), 'required');
            $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'required');
            $this->form_validation->set_rules('charge_id', $this->lang->line('charge_name'), 'required');
//             $this->form_validation->set_rules('date', $this->lang->line('date'), 'required');

            if ($this->form_validation->run() == false) {
                $msg = array(
                    'qty'             => form_error('qty'),
                    'date'            => form_error('date'),
                    'charge_type'     => form_error('charge_type'),
                    'charge_category' => form_error('charge_category'),
                    'apply_charge'    => form_error('apply_charge'),
                    'amount'          => form_error('amount'),
                    'charge_id'       => form_error('charge_id'),
                );
                $json_array = array('status' => 'fail', 'error' => $msg, 'message' => '');
            } else {
                $preview_data = $this->charge_model->getDetails($_POST['charge_id'], "");
                $data   =  $this->input->post('date');
                $temp_data = array(
                    'charge_id'          => $preview_data->id,
                    'charge_name'        => $preview_data->name,
                    'charge_type_id'     => $preview_data->charge_type_master_id,
                    'charge_type_name'   => $preview_data->charge_type_name,
                    'charge_category'    => $preview_data->charge_category_name,
                    'charge_category_id' => $preview_data->charge_category_id,
                    'qty'                => $this->input->post('qty'),
                    'apply_charge'       => $this->input->post('apply_charge'),
                    'standard_charge'    => $this->input->post('standard_charge'),
                    'tpa_charge'         => $this->input->post('schedule_charge'),
                    'amount'             => $this->input->post('apply_charge'),
                    'tax'                => $this->input->post('tax'),
                    'tax_percentage'     => $this->input->post('charge_tax'),
                    'net_amount'         => $this->input->post('amount'),
                    'note'               => $this->input->post('note'),
                    'date'               => $this->customlib->YYYYMMDDHisTodateFormat($data,$this->customlib->getHospitalTimeFormat())
                );
//  echo "<pre>";
//       print_r($temp_data);
//       exit;

                $json_array = array('status' => 'new_charge', 'error' => '', 'data' => $temp_data);
            }
        }
        echo json_encode($json_array);
    }

    public function getchargeDetails()
    {
      $charge_category = $this->input->post("charge_category");
        $result          = $this->charge_model->getchargeDetails($charge_category);
//       echo "<pre>";
//       print_r($result);
//       exit;
        echo json_encode($result);
    }

    public function deleteOpdPatientCharge($pateint_id, $id, $opdid)
    {
        if (!$this->rbac->hasPrivilege('charges', 'can_delete')) {
            access_denied();
        }
        $this->charge_model->deleteOpdPatientCharge($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success">Patient Charges deleted successfully</div>');
        redirect('admin/patient/visitDetails/' . $pateint_id . '/' . $opd_id . '#charges');
    }
  
  
    

}
