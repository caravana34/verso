<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Surgery extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->config->load("payroll");
        $this->config->load("image_valid");
        $this->config->load("mailsms");
        $this->notification            = $this->config->item('notification');
        $this->notificationurl         = $this->config->item('notification_url');
        $this->patient_notificationurl = $this->config->item('patient_notification_url'); 
        $this->load->library('Enc_lib');
        $this->load->library('encoding_lib');
        $this->load->library('mailsmsconf');
        $this->load->library('CSVReader');
        $this->load->library('Customlib');
        $this->load->library('system_notification');
        $this->load->library('datatables');
        $this->marital_status  = $this->config->item('marital_status');
        $this->payment_mode    = $this->config->item('payment_mode');
        $this->yesno_condition = $this->config->item('yesno_condition');
        $this->search_type     = $this->config->item('search_type');
        $this->blood_group     = $this->config->item('bloodgroup');
        $this->load->model(array('conference_model', 'transaction_model', 'casereference_model', 'patient_model', 'notificationsetting_model'));
        $this->load->model('finding_model');
        $this->load->model('Prescription_model');
        $this->charge_type          = $this->customlib->getChargeMaster();
        $data["charge_type"]        = $this->charge_type;
        $this->patient_login_prefix = "pat";
        $this->agerange             = $this->config->item('agerange');
        $this->load->helper('customfield_helper');
        $this->appointment_status = $this->config->item('appointment_status');
        $this->load->helper('custom');
        $this->opd_prefix          = $this->customlib->getSessionPrefixByType('opd_no');
        $this->blood_group         = $this->bloodbankstatus_model->get_product(null, 1);
        $this->time_format         = $this->customlib->getHospitalTimeFormat();
        $this->recent_record_count = 5;

    }
  
  
  public function surgeries(){
      
        if(!$this->rbac->hasPrivilege('cirugia', 'can_view')) {
              access_denied();
        }
        
        $app_data                      = $this->session->flashdata('app_data');
        $data['app_data']              = $app_data;
        $doctors                       = $this->staff_model->getStaffbyrole(3);
        $data["doctors"]               = $doctors;
        $patients                      = $this->patient_model->getPatientListall();
        $data["patients"]              = $patients;
        $data["appointment_status"]    = $this->appointment_status;
        $data["doctors"]               =  $this->staff_model->getStaffbyrole(3);
        $userdata                      = $this->customlib->getUserData();
        $data['user_role_id']          = $userdata['role_id'];

        $this->session->set_userdata('top_menu', 'surgery');

        $this->load->view('layout/header');
        $this->load->view('admin/patient/Surgery/surgeries_view', $data);
        $this->load->view('layout/footer');
      
    }
  
  
    function atention($id,$opdid){
      
        $data['medicineCategory']   = $this->medicine_category_model->getMedicineCategory();
        $data['intervaldosage']     = $this->medicine_dosage_model->getIntervalDosage();
        $data['durationdosage']     = $this->medicine_dosage_model->getDurationDosage();
        $data['dosage']             = $this->medicine_dosage_model->getMedicineDosage();
        $category_dosage            = $this->medicine_dosage_model->getCategoryDosages();
        $data['category_dosage']    = $category_dosage;
        $data['medicineName']       = $this->pharmacy_model->getMedicineName();
      
        $medicationreport           = $this->patient_model->getmedicationdetailsbydateopd($opdid);
        $max_dose                   = $this->patient_model->getMaxByopdid($opdid);
        $data['max_dose']           = $max_dose->max_dose;
        $data["medication"]         = $medicationreport;
      
//         $data['is_discharge']   = $this->customlib->checkDischargePatient($data["result"]['result']['discharged']);
      
        $nurse                      = $this->staff_model->getStaffbyrole(9);
        $data["nurse"]              = $nurse;
        $data["nurse_select"]       = $nurse;
        $result                     = $this->patient_model->getDetails($opdid);
        $data['result']             = $result;
        $data["id"]                 = $id;
        $data["opdid"]              = $opdid;
//         $data['custom_fields_data']    = get_custom_table_values($id, 'patient');

        $id_visit = $this->db->query("SELECT id
                                          FROM visit_details 
                                          WHERE opd_details_id = " . $opdid . ";")->result();
      
//         $data['custom_fields_value'] = display_custom_fields('opd', $id_visit);
      
//         echo "<pre>";
//         print_r($data['custom_fields_value']);
//         exit;
   
      
        $data['signos_vitales'] = $this->db->query("SELECT signos_vitales_report.* FROM signos_vitales_report 
                                                WHERE opd_details_id = " .$opdid. ";")->result();
  
        $case = $result['result']['case_reference_id'];
      
        $data['check_list_one'] = $this->db->query("SELECT surgery_check.* 
                                                    FROM check_list_surgery_one as surgery_check
                                                    WHERE opd_details_id = " .$opdid. ";")->row_array();
        
        $data['check_list_two'] = $this->db->query("SELECT surgery_check2.* 
                                              FROM check_list_surgery_two as surgery_check2
                                              WHERE opd_details_id = " .$opdid. ";")->row_array();

      
//         echo "<pre>";
//         print_r($data['check_list_one']);
//         exit;

        $data['doctor_app'] = $this->db->query("SELECT doctor, time,message, date, reason_consultation, cancel_person, date_cancel,surgery_name
                                                FROM appointment 
                                                WHERE case_reference_id = " .$case. ";")->result();

        $data['id_visit'] = $this->db->query("SELECT id FROM visit_details WHERE opd_details_id = " . $opdid . ";")->row();
      

        $data['procedures_opd'] = $this->db->query("SELECT procedures.id_procedures, procedures.procedure_name, procedures.specialities, procedures.code_cup, procedures.procedure_name, procedures.procedure_cant, procedures.appointment_priority, procedures.general_information, diagnosis.nombre_diag
                                                    FROM procedures_clini as procedures
                                                    LEFT JOIN opd_details ON opd_details.id = procedures.opd_details_id
                                                    LEFT JOIN diagnosis ON diagnosis.id_diagnosis = procedures.id_diagnosis
                                                    WHERE procedures.opd_details_id = " .$opdid. ";")->result();
      
      
       if($data['doctor_app']!=NULL){

              $id_doctor_shift = $data['doctor_app'][0]->doctor;

       }else{
              $data['doctor_app'] = $this->db->query("SELECT cons_doctor
                                                      FROM visit_details
                                                      WHERE id = " .$id_visit[0]->id. ";")->result();

              $id_doctor_shift = $data['doctor_app'][0]->cons_doctor;

       }
//               echo "<pre>";
//       print_r($data['doctor_app'][0]);
//       exit;


       $data['doctor_duration'] = $this->db->query("SELECT consult_duration
                                                      FROM shift_details 
                                                      WHERE staff_id = " .$id_doctor_shift. ";")->result();
      
      
      
       $nurse_note = $this->patient_model->getdatanursenote_surgeryopd($id, $opdid);
      
//             echo "<pre>";
//       print_r($max_dose );
//       exit;

       $data['recent_record_count'] = $this->recent_record_count;    
            foreach ($nurse_note as $key => $nurse_note_value) {
                $notecomment                        = $this->patient_model->getnurenotecomment($opdid, $nurse_note_value['id']);
                $nursenote[$nurse_note_value['id']] = $notecomment;
            }
            if (!empty($nursenote)) {
                $data["nursenote"] = $nursenote;
            }
        $data["nurse_note"]          = $nurse_note;
      
      
        if (!$this->rbac->hasPrivilege('cirugia', 'can_view')) {
              access_denied();
          }
      
        $this->session->set_userdata('top_menu', 'surgery');

        $this->load->view('layout/header');
        $this->load->view('admin/patient/Surgery/atention_surgery', $data);
        $this->load->view('layout/footer');
      
      
    }
  
  
  public function getsurgeryDatatable($fecha_inicial=null, $fecha_final=null,$doctor_id=null){
      
        $dt_response = $this->appointment_model->getAllappointmentRecord($fecha_inicial, $fecha_final,$doctor_id, 'surgery');
        $fields      = $this->customfield_model->get_custom_fields('appointment', 1);
//         $fields     = $this->customfield_model->get_custom_fields('patient');
        $dt_response = json_decode($dt_response);
//       echo "<pre>";
//       print_r($dt_response->data);
//       exit;
        $dt_data     = array();
        if (!empty($dt_response->data)) {
            foreach ($dt_response->data as $key => $value) {
              // edit by cliniverso desarrollo
              
              $this->db->where('patient_id', NULL);
              $this->db->delete('appointment');
              
              $this->db->select('*');
              $this->db->from('custom_field_values');
              $this->db->where('belong_table_id', $value->pid);
              $query2 = $this->db->get();
              $custom = $query2->result_object();
              $patient_detail = $this->patient_model->getpatientDetails($value->pid);
              
              
              $doctor_duration = $this->db->query("SELECT consult_duration
                                      FROM shift_details 
                                      WHERE staff_id = " .$value->doctor. ";")->result_object();

              $finish= $value->time;
              $doctor_duration[0]->consult_duration;
              if($value->appointment_status == "Aprobada"){
                
                  $query_pay['payment'] = $this->db->query("SELECT appointment_payment.*
                                            FROM appointment_payment
                                            where appointment_id = ".$value->id." ;")->result();

                  $query_pay['patient'] = $this->db->query("SELECT patients.*
                                              FROM patients
                                              where id = ".$value->patient_id." ;")->result();
                  $guardian_name = $patient_detail['guardian_name'];

                  $query_pay['patient_custom'] = get_custom_table_values($value->patient_id, 'patient');

                  $bill_appointment = json_encode($query_pay);
                  if(isset($value->visit_details_id)){
                         $query_visit = $this->db->query("SELECT opd_details_id
                                                          FROM visit_details
                                                          where id = ".$value->visit_details_id." ;")->row();

                         $visit = $query_visit->opd_details_id;
                 }
              }
                 
                foreach($custom as $key2=>$value2){
                  if($value2->custom_field_id == 12){
                      $eps = $value2->field_value;
                    }
                  if($value2->custom_field_id == 10){
                      $regimen = $value2->field_value;
                    }
                }

                $row = array();
                //====================================
              
                $label = "";
                if ($value->appointment_status == "Aprobada") {
                    $label  = "class='label cita_aprobada' style='width:80px;display: inline-block;'";
                  $status = "Aprobada";
                  $color_back = "cita_aprobada";
                } else if ($value->appointment_status == "Agendada") {
                    $label  = "class='label cita_agendada' style='width:80px;display: inline-block;'";
                    $status = "Agendada";
                    $color_back = "cita_agendada";
                } else if ($value->appointment_status == "Cancelada") {
                    $label  = "class='label cita_cancelada' style='width:80px;display: inline-block;'";
                    $status = "Cancelada";
                    $color_back = "cita_cancelada";
                }else if($value->appointment_status == "Confirmada"){
                   $label  = "class='label cita_confirmada' style='width:80px;display: inline-block;'";
                   $status = "Confirmada";
                   $color_back = "cita_confirmada";
                }else if($value->appointment_status == "Firmada"){
                   $label  = "class='label cita_firmada' style='width:80px;display: inline-block;'";
                   $status = "Firmada";
                   $color_back = "cita_firmada";
                }
              
                $style = "<div class='".$color_back."' style='padding:10px;color:#fff;height:90px;border-radius:5px;'>";

//                 $action .="<a href='#'  class='btn btn-default btn-xs btn btn-md ' data-toggle='tooltip' style=color:#000 !important; onclick=print_visit_bill(".$value->opd_details_id.") data-original-title=".$this->lang->line('print')."><i class='fa fa-print'></i></a>";
                if ($this->rbac->hasPrivilege('reschedule', 'can_view')) {
                }

               
                $action = "<div class='rowoptionview rowview-btn-top' >";
              if($value->appointment_status == "Aprobada"){
                $action .= "<a href=".site_url('admin/Surgery/atention')."/".$value->pid."/".$visit." data-toggle='tooltip' style='color:#000 !important;' title='" . $this->lang->line('show') . "' class='btn btn-default btn-xs'   data-target='#viewModal' >  <i class='fa fa-reorder'></i> </a>";
              
              }else{
                $action .= "<a href='#' data-toggle='tooltip' style='color:#000 !important;' title='" . $this->lang->line('show') . "' class='btn btn-default btn-xs'   data-target='#viewModal' >  <i class='fa fa-reorder'></i> </a>";
              
              }
               if ($value->appointment_status == 'Agendada') {
                    if ($value->source != 'Online') {
                        if ($this->rbac->hasPrivilege('appointment_approve', 'can_view') || $this->rbac->hasPrivilege('reschedule', 'can_view')) {
                            $action .= " <a href='#' data-toggle='tooltip'  style='color: black; !important;' title='" . $this->lang->line('reschedule') . "' class='btn btn-default btn-xs' data-target='#rescheduleModal' onclick='viewreschedule(".$value->id.")'>  <i class='fa fa-calendar'></i> </a>";
                            $action .= "<span class='large-tooltip'><a href='#' class='btn btn-default btn-xs' style='color: black; !important;' data-toggle='tooltip' title='' data-target='#rescheduleModal' onclick='viewreschedule(" . $value->id . ")' data-original-title='" . $this->lang->line('approve_appointment') . "'><i class='fa fa-check' aria-hidden='true'></i></a></span>";
    //                             $action .= "<span class='large-tooltip'><a href='#' class='btn btn-default btn-xs'  data-toggle='tooltip' title='' onclick='aproved(" . $value->id . ")' data-original-title='" . $this->lang->line('approve_appointment') . "'><i class='fa fa-check' aria-hidden='true'></i></a></span>";
                        }
                    }
               }
              
               if ($value->appointment_status == 'Confirmada') {
                    if ($value->source != 'Online') {
                        if ($this->rbac->hasPrivilege('appointment_approve', 'can_view') || $this->rbac->hasPrivilege('reschedule', 'can_view')) {
                            $action .= " <a href='#' data-toggle='tooltip'  style='color: black; !important;' title='" . $this->lang->line('reschedule') . "' class='btn btn-default btn-xs'   data-target='#rescheduleModal' onclick='viewreschedule(".$value->id.")'>  <i class='fa fa-calendar'></i> </a>";
                            $action .= "<span class='large-tooltip'><a href='#' class='btn btn-default btn-xs'  style='color: black; !important;' data-toggle='tooltip' title='' data-target='#rescheduleModal' onclick='viewreschedule(" . $value->id . ")' data-original-title='" . $this->lang->line('approve_appointment') . "'><i class='fa fa-check' aria-hidden='true'></i></a></span>";
  //                             $action .= "<span class='large-tooltip'><a href='#' class='btn btn-default btn-xs'  data-toggle='tooltip' title='' onclick='aproved(" . $value->id . ")' data-original-title='" . $this->lang->line('approve_appointment') . "'><i class='fa fa-check' aria-hidden='true'></i></a></span>";
                        }
                    } 
               }
              
              if ($value->appointment_status == 'Cancelada') {
                    if ($value->source != 'Online') {
                        
                    }
              }
              
              if ($value->appointment_status == 'Aprobada') {
                    if ($value->source != 'Online') {
                        if ($this->rbac->hasPrivilege('appointment_approve', 'can_view') || $this->rbac->hasPrivilege('reschedule', 'can_view')) {
                            $action .= "<span class='large-tooltip'><a href='#' class='btn btn-default btn-xs addpayment' style='color:#000 !important;' data-toggle='tooltip' title=''  data-original-title='Pagar'><i class='fa fa-dollar' aria-hidden='true'></i></a></span>";
                         }
                    }
              }
              
              if ($value->appointment_status == 'Firmada') {
                    if ($value->source != 'Online') {
                       $action .="<a href='#'  class='btn btn-default btn-xs btn btn-md ' data-toggle='tooltip' style='color: black; !important;' onclick=print_visit_bill($visit) data-original-title=".$this->lang->line('print')."><i class='fa fa-print'></i></a>";
                       $action.= "<span><a href='#' onclick='billopd_clini($bill_appointment)'  class='btn btn-default btn-xs' style='color: black; !important;' data-toggle='tooltip' data-original-title='Factura'><i class='fa fa-money-bill' aria-hidden='true'></i></a></span>";
                    }
               }
                 
// <a href="#" class="btn btn-sm dropdown-toggle addpayment" style="background:#1563b0;color:#fff;" data-toggle="modal"><i class="fa fa-plus"></i> Agregar pago</a>
               $action .= "</div>";
               $first_action = "<div class='name_link ".$color_back."' style='padding:10px;color: black;height:90px;border-radius:5px;font-weight:semibold;'><a  href='javascript:void(0)' style=color:#fff;  data-toggle='tooltip'  data-target='#viewModal' title='Ver detalles de la cita'  onclick='viewDetail(" . $value->id . ")'>";

               if (!empty($value->live_consult)) {$live_consult = $this->lang->line($value->live_consult);} else { $live_consult = '';};

                //==============================
               
                $row[] = $first_action."<i class='fa fa-user' aria-hidden='true'></i> " . composePatientName($result = isset($this->$guardian_name) ? $value->patient_name . " " . $guardian_name : $value->patient_name , $value->pid) . "</a>" . $action."</div>";
  //                 $row[] = $status;
                $row[] = $style.$patient_detail['identification_number']."</div>";
                $row[] = $style.$value->reason_consultation."<br>".$value->surgery_name."</div>";
//                 $row[] = $value->gender;
               
                 date_default_timezone_set("America/Bogota");
//                   $today =  date("y/m/d");
              
//                  $today = date("Y/m/d",mktime(0, 0, 0, date("m")  , date("d")+0, date("Y")));
//                  $ini = date('Y/m/d', strtotime($value->date));
              
                 $today = date("Y/m/d H:i:s", mktime(date("H"), date("i"), date("s"), date("m"), date("d")+0, date("Y")));
              
                 $fecha = new DateTime($value->time);
                 $fecha->add(new DateInterval('PT20M'));
                 $new_time = $fecha->format('H:i:s');
              
//                  // Convertir la hora original a objeto DateTime
//                  $hora_dt = DateTime::createFromFormat('H:i:s', $value->time);

//                  // Obtener la hora y los minutos
//                  $value_time = $hora_dt->format('H:i');
              
                 $ini = $style.date('Y/m/d H:i:s', strtotime($value->date.' '.$new_time))."</div>";


//                 echo "<pre>";
//                 print_r("today: ".$today.", ini: ".$ini." today_time: ".$value->time." new time: ".$new_time);
//                 exit;
              
                if($status != 'Cancelada' && $status != 'Aprobada' && $status != 'No Asistió' && $today > $ini){
                    $label  = "class='label cita_cancelada' style='width:80px;display: inline-block;'";
                    $status = "No asistio";
                    $color_back = "cita_cancelada";
                }
                
                $row[] = $style.$eps."</div>";
                $row[] = $style."<i class='fas fa-stethoscope'></i> " .composeStaffNameByString($value->name, $value->surname, $value->employee_id)."<br>Especialidad : <b>".$value->specialist_name."</b></div>";
                if($today == $ini){
                  $row[] = $style.date('Y/m/d', strtotime($value->date))."</div>";
                }else{
                  $row[] = $style.date('Y/m/d', strtotime($value->date))."</div>";
                }
                $row[] = $style.$value->time."</div>";
                if ($this->module_lib->hasActive('live_consultation')) {
                    $row[] = $live_consult;
                }
                //====================
                if (!empty($fields)) {
                    foreach ($fields as $fields_key => $fields_value) {
                        $display_field = $value->{"$fields_value->name"};
                        if ($fields_value->type == "link") {
                            $display_field = "<a href=" . $value->{"$fields_value->name"} . " target='_blank'>" . $value->{"$fields_value->name"} . "</a>";
                        }
                        $row[] = $display_field;
                    }
                }
                //====================
                $row[]     = $style.$value->time_finish."</div>";
//                 $row[]     = $style.date('Y/m/d', strtotime($value->created_at))."</div>";
                $row[]     = "<small " . $label . ">" . $status . "</small>";
                
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
  
  public function add_signos_vitales()
  {
    
    
     if (!$this->rbac->hasPrivilege('nurse_note', 'can_add')) {
            access_denied();
        }
     $this->form_validation->set_rules('date', $this->lang->line('date'), 'trim|required|xss_clean');
     $this->form_validation->set_rules('time', $this->lang->line('nurse'), 'trim|required|xss_clean');
    
    
    if ($this->form_validation->run() == false) {
            $msg = array(
                'date'    => form_error('date'),
                'time'   => form_error('time'),
            );
            
            if (!empty($error_msg2)) {
                $error_msg = array_merge($msg, $error_msg2);
            } else {
                $error_msg = $msg;
            }

            $array = array('status' => 'fail', 'error' => $error_msg, 'message' => '');
        } else {
      
          $date       = $this->input->post('date');
          $time      = $this->input->post('time');
          $Fase_Operatoria    = $this->input->post('Fase_Operatoria');
          $talla = $this->input->post('talla');
          $opd_id     = $this->input->post('surgery_id');
          $talla       = $this->input->post('talla');
          $peso    = $this->input->post('peso');
          $frec_card    = $this->input->post('frec_card');
          $frec_resp    = $this->input->post('frec_res');
          $temperatura      = $this->input->post('temperatura');
          $sat_oxi_con = $this->input->post('sat_oxi_con');
          $sat_oxi_sin     = $this->input->post('sat_oxi_sin');
          $presion_dia       = $this->input->post('presi_dia');
          $presion_sis    = $this->input->post('presi_sis');
          $glucometria    = $this->input->post('glucometria');
          $remark    = $this->input->post('remark');

          $data_array = array(
              'opd_details_id' => $opd_id,
              'date'       => $this->customlib->dateFormatToYYYYMMDDHis($date, $this->time_format),
              'time'    => $time,
              'report_type'    => $Fase_Operatoria,
              'talla' => $talla,
              'peso'  => $peso,
              'frec_card' => $frec_card,
              'frec_resp' => $frec_resp,
              'temperatura'    => $temperatura,
              'sat_oxi_con' => $sat_oxi_con,
              'sat_oxi_sin' => $sat_oxi_sin,
              'presion_dia'  => $presion_dia,
              'presion_sis' => $presion_sis,
              'glucometria' => $glucometria,
              'generated_by'       => $this->customlib->getLoggedInUserID(),
              'remark' => $remark
          );
//        echo "<pre>";
//     print_r($data_array);
//     exit;

        $this->db->insert('signos_vitales_report', $data_array);
        $sts = 'success';
        $msg = $this->lang->line('record_saved_successfully');
        $array = array('status' => $sts, 'error' => '', 'message' => $msg);
      
    }
    echo json_encode($array);
  }
  
  public function Save_Chequeo_One()
  {
        if (!$this->rbac->hasPrivilege('nurse_note', 'can_add')) {
            access_denied();
        } 
    
        $this->form_validation->set_rules([
           [
                'field' => 'remarks',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'el mensaje es requerido',
                ],
            ],

        ]);

    
       if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $array = array('status' => 'fail', 'error' => $errors, 'message' => '');
         
            echo json_encode($array);
         
            exit;

       } else {
    
      }
    
      echo "<pre>";
      print_r('entro aqui');
      exit;
    
      $opd_id = $this->input->post('surgery_id');
      $P1 = $this->input->post('respuesta[1]');
      $P2 = $this->input->post('respuesta[2]');
      $P3 = $this->input->post('respuesta[3]');
      $P4 = $this->input->post('respuesta[4]');
      $P5 = $this->input->post('respuesta[5]');
      $P6 = $this->input->post('respuesta[6]');
      $P7 = $this->input->post('respuesta[7]');
      $P8 = $this->input->post('respuesta[8]');
      $remarks = $this->input->post('remarks');
    
      $array_error = [];
    
//       echo "<pre>";
//       print_r($opd_id);
//       exit;
    
      $result = $this->db->query("SELECT surgery_check.opd_details_id 
                                  FROM check_list_surgery_one as surgery_check
                                  WHERE opd_details_id = " .$opd_id. ";")->row_array();
    
    

    
       if(count($result) > 0){
         
//             echo "<pre>";
//             print_r($this->input->post());
//             exit;

         
         
            $data_array = array( 
                'p_1' => $P1,
                'p_2' => $P2,
                'p_3' => $P3,
                'p_4' => $P4,
                'p_5' => $P5,
                'p_6' => $P6,
                'p_7' => $P7,
                'p_8' => $P8,
                'remarks' => $remarks
            );
         
         
          $this->db->where('opd_details_id', $opd_id);
          $this->db->update('check_list_surgery_one', $data_array);
         
          $array = array('status' => 'success', 'error' => '', 'message' => 'Se actualizó el registro con exíto');

       } else {
         
           $data_array = array( 
                'opd_details_id' => $opd_id,
                'p_1' => $P1,
                'p_2' => $P2,
                'p_3' => $P3,
                'p_4' => $P4,
                'p_5' => $P5,
                'p_6' => $P6,
                'p_7' => $P7,
                'p_8' => $P8,
                'remarks' => $remarks
           );
         
          $this->db->insert('check_list_surgery_one', $data_array);
          $sts = 'success';
          $msg = $this->lang->line('record_saved_successfully');
          $array = array('status' => $sts, 'error' => '', 'message' => $msg);
       }
    
//         echo "<pre>";
//         print_r($data['signos_vitales']);
//         exit;

//         echo "<pre>";
//         print_r($data_array);
//   //      exit;


        echo json_encode($array);

  }
  
  public function Save_Chequeo_Two()
  {
       if (!$this->rbac->hasPrivilege('nurse_note', 'can_add')) {
            access_denied();
        }
        $opd_id = $this->input->post('surgery_id');
        $P9 = $this->input->post('respuesta[9]');
        $P10 = $this->input->post('respuesta[10]');
        $P11 = $this->input->post('respuesta[11]');
        $P12 = $this->input->post('respuesta[12]');
        $P13 = $this->input->post('respuesta[13]');
        $P14 = $this->input->post('respuesta[14]');
        $P15 = $this->input->post('respuesta[15]');
        $P16 = $this->input->post('respuesta[16]');
        $P17 = $this->input->post('respuesta[17]');
        $P18 = $this->input->post('respuesta[18]');
        $remarks2 = $this->input->post('remarks2');
    
        $data_array = array( 
          'opd_details_id' => $opd_id,
          'p_9'  => $P9,
          'p_10' => $P10,
          'p_11' => $P11,
          'p_12' => $P12,
          'p_13' => $P13,
          'p_14' => $P14,
          'p_15' => $P15,
          'p_16' => $P16,
          'p_17' => $P17,
          'p_18' => $P18,
          'remarks' => $remarks2
        );
         echo "<pre>";
         print_r($data_array);
     //    exit;
        $this->db->insert('check_list_surgery_two', $data_array);
        $sts = 'success';
        $msg = $this->lang->line('record_saved_successfully');
        $array = array('status' => $sts, 'error' => '', 'message' => $msg);

        echo json_encode($array);
  }
  
  
  function add_pre_anesthetic($user_id, $visit_id, $opdid) {
    
        $this->form_validation->set_rules([
            [
                'field' => 'codigo_cups',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'El codigo cups es requerido.',
                ]
            ],
            [
                'field' => 'product_cups',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'La ayuda diagnostica es requerida.',
                ]
            ],
            [
                'field' => 'quantity_procedure',
                'rules' => 'trim|required|xss_clean|numeric',
                'errors' => [
                    'required' => 'La forma farmacéutica es requerida.',
                    'numeric' => 'La cantidad debe de ser un numero',
                ]
            ],
            [
                'field' => 'appointment_priority',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'La prioridad es requerida.',
                ]
            ],
            [
                'field' => 'general_information',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'La información general es requerida.',
                ]
            ],
            [
                'field' => 'preanesthetic_diagnosis',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'El diagnóstico es requerido.',
                ]
            ]
        ]);

        if ($this->form_validation->run() == FALSE) {

            $errors = $this->form_validation->error_array();
            $array = array('status' => 'fail', 'error' => $errors, 'message' => '');

            echo json_encode($array, JSON_UNESCAPED_UNICODE);
          
        } else {
          
            $diagnosis = [
              'nombre_diag' => $this->input->post('preanesthetic_diagnosis'),
              'id_patient' => $user_id,
              'categoria_diag' => 'secundario',
              'id_visit_details' => $visit_id
            ];
          
            $this->db->insert("diagnosis", $diagnosis);
            $id_diagnosis = $this->db->insert_id();

            $datos = array(
              "opd_details_id" => $opdid,
              "id_patient" => $user_id,
              "code_cup" => $this->input->post('codigo_cups'),
              "specialities" =>  $this->input->post('specialities_procedure'),
              "procedure_name" => $this->input->post('product_cups'),
              "procedure_cant" => $this->input->post('quantity_procedure'),
              "appointment_priority" => $this->input->post('appointment_priority'),
              "general_information" => $this->input->post('general_information'),
              "id_diagnosis" => $id_diagnosis,
            );

            $this->db->insert("procedures_clini", $datos);

            $message = array('status' => "success", "error" => "", "message" => "El procedimiento se registro con exito");

            echo json_encode($message);
        }
    }
}