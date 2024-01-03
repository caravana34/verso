<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Appointment extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->config->load("payroll");
        $this->config->load("mailsms");
        $this->notification            = $this->config->item('notification');
        $this->notificationurl         = $this->config->item('notification_url');
        $this->yesno_condition         = $this->config->item('yesno_condition');
        $this->patient_notificationurl = $this->config->item('patient_notification_url');
        $this->search_type             = $this->config->item('search_type');
        $this->load->library('mailsmsconf');
        $this->load->library('Enc_lib');
        $this->load->library('datatables');
        $this->load->library('system_notification');
        $this->load->model(array('appoint_priority_model', 'onlineappointment_model', 'transaction_model','conference_model'));
        $this->appointment_status = $this->config->item('appointment_status');
        $this->load->helper('customfield_helper');
        $this->time_format = $this->customlib->getHospitalTimeFormat();
        $this->config->load('image_valid');
        $this->payment_mode = $this->config->item('payment_mode');
    }

    public function unauthorized()
    {
        $data = array();
        $this->load->view('layout/header', $data);
        $this->load->view('unauthorized', $data);
        $this->load->view('layout/footer', $data);
    }

    public function index()
    {
        $this->session->set_userdata('top_menu', 'appointment');
        $app_data                      = $this->session->flashdata('app_data');
        $data['app_data']              = $app_data;
        $doctors                       = $this->staff_model->getStaffbyrole(3);
        $data["doctors"]               = $doctors;
        $patients                      = $this->patient_model->getPatientListall();
        $data["patients"]              = $patients;
        $data["appointment_status"]    = $this->appointment_status;
        $data["yesno_condition"]       = $this->yesno_condition;
        $userdata                      = $this->customlib->getUserData();
        $role_id                       = $userdata['role_id'];
        $data["bloodgroup"]            = $this->bloodbankstatus_model->get_product(null, 1);
        $doctorid                      = "";
        $data['appoint_priority_list'] = $this->appoint_priority_model->appoint_priority_list();
        $doctor_restriction            = $this->session->userdata['hospitaladmin']['doctor_restriction'];
        $disable_option                = false;
        $data['user_role_id'] = $userdata['role_id'];
        $charge_category            = $this->charge_category_model->getCategoryByModule("opd");
        $data['charge_category']    = $charge_category;
        $data['charges'] = $this->db->query("select charges.*,charge_categories.name
                                            FROM charges
                                            left join charge_categories on charges.charge_category_id = charge_categories.id;")->result();
      
        $data['responsibles_esp'] = $this->db->query("SELECT organisation.id, organisation.organisation_name FROM organisation;")->result();
      
        $data['nursing_assistant'] = $this->staff_model->getStaffbyrole(9);
      
      
        $data['roles'] = $this->db->query("select roles.id, roles.name FROM roles")->result();

        if ($doctor_restriction == 'enabled') {
            if ($role_id == 3) {
                $disable_option = true;
                $doctorid       = $userdata['id']; 
            }
        }

        $data["doctor_select"]  = $doctorid;
        $data["disable_option"] = $disable_option;
        $data['fields']         = $this->customfield_model->get_custom_fields('appointment', 1);
        $data['payment_mode']   = $this->payment_mode;
        $data['userdata']   = $userdata;

//               echo "<pre>";
//               print_r($data);
//               exit();
        $this->load->view('layout/header');
        $this->load->view('admin/appointment/index', $data);
        $this->load->view('layout/footer');
  }
  public function check_slot($slot, $params)
  {
        
//           print_r($params);
        if ($slot == '') {
            $this->form_validation->set_message('check_slot', $this->lang->line("available_slots_field_is_required"));
            return false;
        }
        list($doctor_id, $shift, $date, $global_shift) = explode(',', $params);
        $appointments                                  = $this->onlineappointment_model->getAppointments($doctor_id, $shift, $date);
        $time                                          = $this->customlib->getSlotByDoctorShift($doctor_id, $shift);
        $array                                         = array_column($appointments, 'time');
        if ($slot != '' && $doctor_id != '' && $shift != '' && $date != '') {
            if (count($time) > $slot) {
                $shift_time = date("H:i:s", strtotime($time[$slot]));
                if (in_array($shift_time, $array)) {
                    $this->form_validation->set_message('check_slot', $this->lang->line('this_slot_is_already_booked'));
                  return false;
                  
                } else {
//                   print_r("aqui");
                    return true;
                }
            }
        }
    }
    public function add()
    {
      
//         echo "<pre>";
//         print_r($this->input->post("add_slot"));
//         exit;
        
        date_default_timezone_set("America/Bogota");
        $doctor_restriction = $this->session->userdata['hospitaladmin']['doctor_restriction'];
        $userdata = $this->customlib->getUserData();

        $staff_id     = $this->customlib->getLoggedInUserID();
        $date         = $this->input->post('date');
        $date_appoint = (new DateTime($date))->format('Y-m-d');
        $patient_id   = $this->input->post('patient_id');
        $consult      = $this->input->post('live_consult');
        $slots        = $this->customlib->getSlotByDoctorShift($this->input->post('doctorid'), $this->input->post('slot'));
        $slot         = $slots[$this->input->post("slot1")];
        $time         = date("H:i:s", strtotime($slot));
        $cheque_date  = $this->customlib->dateFormatToYYYYMMDD($this->input->post("cheque_date"));
        $today_date = (new DateTime())->format('Y-m-d H:i:s');
        $add_slot = $this->input->post("add_slot");
        $appointments   = $this->onlineappointment_model->getAppointments($this->input->post('doctorid'), $this->input->post("slot"), $date_appoint);
        $array_dates = [];
        $custom_errors = [];
        $slot = $this->input->post('slot');
        $custom_fields = $this->customfield_model->getByBelong('appointment');
        $params = $this->input->post('doctorid') . ',' . $slot . ',' . $this->customlib->dateFormatToYYYYMMDD($this->input->post("date")) . ',' . $this->input->post("global_shift");
      
        foreach ($custom_fields as $custom_fields_key => $custom_fields_value) {
            if ($custom_fields_value['validation']) {
                $custom_fields_id   = $custom_fields_value['id'];
                $custom_fields_name = $custom_fields_value['name'];
                $this->form_validation->set_rules("custom_fields[appointment][" . $custom_fields_id . "]", $custom_fields_name, 'trim|required');
            }
        }
      
       foreach($add_slot as $key => $value){
              $slot = $slots[$value];
              $array_dates[] = date("H:i:s", strtotime($slot));
//                     array_push($array_dates, date("H:i:s", strtotime($slots[$value])));
        }

        $horaMayor = reset($array_dates); // Inicializamos con la primera hora en el array
        $horaMenor = reset($array_dates); // Inicializamos con la primera hora en el array

        foreach ($array_dates as $hora) {
            if (strtotime($hora) > strtotime($horaMayor)) {
                $horaMayor = $hora;
            }
            if (strtotime($hora) < strtotime($horaMenor)) {
                $horaMenor = $hora;
            }
        }

        if($horaMenor == $horaMayor){
            $custom_errors['error_slot'] = 'Debe seleccionar una hora de incio y de finalización';
        }

        foreach ($appointments as $appointment_slot) {
            if($horaMenor <= $appointment_slot->time && $horaMayor >= $appointment_slot->time_finish && $appointment_id != $appointment_slot->id ){
                $custom_errors['time_overlay'] = 'No se puede asignar horarios superpuestos con citas existentes al reprogramar';
            }
        }
      
        $this->form_validation->set_rules([
            [
                'field' => 'date',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'La fecha es requerida.',
                ],
            ],
            [
                'field' => 'doctorid',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'El doctor es requerido.',
                ],
            ],
            [
                'field' => 'responsible_eps',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'El responsable de la consulta es requerido.',
                ],
            ],
            [
                'field' => 'charge_list_ajax',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'El motivo de la consulta es requerida.',
                ],
            ],
//             [
//                 'field' => 'order_code',
//                 'rules' => 'trim|required|xss_clean|min_length[5]|max_length[60]',
//                 'errors' => [
//                     'required' => 'El codigo de orden es requerido',
//                     'min_length' => 'El código de orden debe tener al menos 5 caracteres',
//                     'max_length' => 'El código de orden no debe superar los 60 caracteres',
//                 ],
//             ],
        ]);
      
//         if ($this->input->post("payment_mode") == "Cheque") {
//             $this->form_validation->set_rules('cheque_no', $this->lang->line('cheque_no'), 'trim|required');
//             $this->form_validation->set_rules('cheque_date', $this->lang->line('cheque_date'), 'trim|required');
//             $this->form_validation->set_rules('document', $this->lang->line("document"), 'callback_handle_doc_upload[document]');
//         }
      
        $today = (new DateTime())->format('Y-m-d');
        $appointment_date = (new DateTime($date))->format('Y-m-d');

        if ($appointment_date < $today) {
              $custom_errors['before_today'] = 'No puedes agendar una cita un dia anterior a hoy.';
        }
      

        if ($this->form_validation->run() == false || count($custom_errors) > 0) {
          
            $errors = $this->form_validation->error_array();
            $msg = array_merge($errors, $custom_errors);

            if (!empty($custom_fields)) {
                foreach ($custom_fields as $custom_fields_key => $custom_fields_value) {
                    if ($custom_fields_value['validation']) {
                        $custom_fields_id                                                    = $custom_fields_value['id'];
                        $custom_fields_name                                                  = $custom_fields_value['name'];
                        $error_msg2["custom_fields[appointment][" . $custom_fields_id . "]"] = form_error("custom_fields[appointment][" . $custom_fields_id . "]");
                    }
                }
            }

            if (!empty($error_msg2)) {
                $error_msg = array_merge($msg, $error_msg2);
            } else {
                $error_msg = $msg;
            }
          
            $array = array('status' => 'fail', 'error' => $error_msg, 'message' => '');
          
        } else {
          
           $get_charge = $this->db->query("SELECT charges.*, charge_categories.name as category_name, charge_type_master.charge_type, charge_type_master.id as id_type_master
                                           FROM charges
                                           INNER JOIN charge_categories ON charge_categories.id = charges.charge_category_id
                                           INNER JOIN charge_type_master ON charge_type_master.id = charge_categories.charge_type_id
                                           WHERE charges.id = ".$this->input->post('charge_list_ajax').";")->row();
          
//            echo "<pre>";
//            print_r($get_charge->charge_type);
//            exit;
          


            $appointment = array(
                'patient_id'         => $patient_id,
                'date'               => $date_appoint,
                'priority'           => $this->input->post('priority'),
                'doctor'             => $this->input->post('doctorid'),
                'message'            => $this->input->post('message'),
                'global_shift_id'    => $this->input->post('global_shift'),
                'shift_id'           => $this->input->post('slot'),
                'is_queue'           => 0,
                "time"               => $horaMenor,
                'time_finish'        => $horaMayor,   
                'live_consult'       => $consult,
                'source'             => 'Offline',
                'appointment_status' => 'Agendada',
                'id_organizations' =>  $this->input->post('responsible_eps'),
                'type_visit'        => $get_charge->charge_type,
                'charge_id' => $this->input->post('charge_list_ajax'),
                'reason_consultation' => $get_charge->name,
                'medical_message' => $this->input->post('medical_message'),
                'order_code' => $this->input->post('order_code'),
                'created_at' => $today_date,
            );
          
            if($get_charge->id_type_master == 3){
                $appointment['is_operation'] = "yes";
            } else if($get_charge->id_type_master == 2){
                $appointment['is_opd'] = "yes";
            } else if($get_charge->id_type_master == 8){
                $appointment['is_procedure'] = "yes";
            } 


           $insert_id = $this->appointment_model->add($appointment);

          
           if(!empty($this->input->post('operation_anesthetist')) || !empty($this->input->post('nursing_assistant'))){

                $appointment_team = [
                    'appointment_id' => $insert_id,
                    'anesthetist' =>  $this->input->post('operation_anesthetist'),
                    'ass_consultant_1' =>  $this->input->post('nursing_assistant'),
                    'generated_by' =>  $userdata['id'],
                    'date' =>  date('Y-m-d'),
                ];  
             
                $this->db->insert('operation_theatre', $appointment_team);
           }
          

            $payment_data = array(
                'appointment_id' => $insert_id,
                'paid_amount'    => $this->input->post('amount'),
                'charge_id'      => $this->input->post('charge_id'),
                'payment_type'   => 'Offline',
                'date'           => date("Y-m-d H:i:s"),
            );
            $payment_section   = $this->config->item('payment_section');
            $transaction_array = array(
                'amount'         => $this->input->post("amount"),
                'patient_id'     => $patient_id,
                'section'        => $payment_section['appointment'],
                'type'           => 'payment',
                'appointment_id' => $insert_id,
                'payment_mode'   => $this->input->post("payment_mode"),
                'payment_date'   => date('Y-m-d H:i:s'),
                'received_by'    => $staff_id,
            );

            $attachment      = "";
            $attachment_name = "";
            if (isset($_FILES["document"]) && !empty($_FILES['document']['name'])) {
                $fileInfo        = pathinfo($_FILES["document"]["name"]);
                $attachment      = uniqueFileName() . '.' . $fileInfo['extension'];
                $attachment_name = $_FILES["document"]["name"];
                move_uploaded_file($_FILES["document"]["tmp_name"], "./uploads/payment_document/" . $attachment);
            }

            if ($this->input->post('payment_mode') == "Cheque") {
                $transaction_array['cheque_date']     = $cheque_date;
                $transaction_array['cheque_no']       = $this->input->post('cheque_no');
                $transaction_array['attachment']      = $attachment;
                $transaction_array['attachment_name'] = $attachment_name;
            }

            $appointment_id      = $insert_id;
            $appointment_details = $this->appointment_model->getDetails($appointment_id);
            $transaction_data    = $this->transaction_model->getTransactionByAppointmentId($appointment_id);
            $appointment_payment = $this->appointment_model->getPaymentByAppointmentId($appointment_id);            
            
            if($this->input->post('appointment_status') == 'Aprobada'){
            /* OPD Insert Code*/
            $this->appointment_model->saveAppointmentPayment($payment_data, $transaction_array);
            
            $charges             = $this->charge_model->getChargeByChargeId($appointment_payment->charge_id);
            $apply_charge        = $charges['standard_charge'] + ($charges['standard_charge'] * ($charges['percentage'] / 100));
            $opd_details         = array(
                'patient_id'   => $appointment_details['patient_id'],
                'generated_by' => $this->customlib->getStaffID(),
            );
            
            $visit_details = array(
                'appointment_date'  => date("Y-m-d H:i:s"),
                'opd_details_id'    => 0,
                'cons_doctor'       => $appointment_details['doctor'],
                'generated_by'      => $this->customlib->getLoggedInUserID(),
                'patient_charge_id' => null,
                'transaction_id'    => $transaction_data->id,
                'can_delete'        => 'no',
                'live_consult'      => $consult,
            );
            $staff_data = $this->staff_model->getStaffByID($appointment_details['doctor']);
            $staff_name = composeStaffName($staff_data);
            $charge     = array(
                'opd_id'          => 0,
                'date'            => date('Y-m-d H:i:s'),
                'charge_id'       => $appointment_payment->charge_id,
                'qty'             => 1,
                'apply_charge'    => 0,
                'standard_charge' => $charges['standard_charge'],
                'amount'          => $appointment_payment->paid_amount,
                'created_at'      => date('Y-m-d H:i:s'),
                'note'            => null,
                'tax'             => $charges['percentage'],
            );
            $opd_visit_id = $this->appointment_model->moveToOpd($opd_details, $visit_details, $charge, $appointment_id,'');
            /* OPD Insert Code*/           
            
            $visit_detail=$this->patient_model->getVisitDetailByid($opd_visit_id);
            $setting_result   = $this->setting_model->getzoomsetting();
            $opdduration      = $setting_result->opd_duration;
            if ($consult == 'yes') {
                $api_type = 'global';
                $params   = array(
                    'zoom_api_key'    => "",
                    'zoom_api_secret' => "",
                );

                $title = 'Online consult for ' . $this->customlib->getSessionPrefixByType('opd_no') . $visit_detail->opd_details_id . " Checkup ID " . $visit_detail->id;
                $this->load->library('zoom_api', $params);
                $insert_array = array(
                    'staff_id'         => $this->input->post('doctorid'),
                    'visit_details_id' => $visit_detail->id,
                    'title'            => $title,
                    'date'             => $date_appoint,
                    'duration'         => 60,
                    'created_id'       => $this->customlib->getStaffID(),
                    'password'         => random_string(),
                    'api_type'         => $api_type,
                    'host_video'       => 1,
                    'client_video'     => 1,
                    'purpose'          => 'consult',
                    'timezone'         => $this->customlib->getTimeZone(),
                );

                $response = $this->zoom_api->createAMeeting($insert_array);

                if (!empty($response)) {
                    if (isset($response->id)) {
                        $insert_array['return_response'] = json_encode($response);
                        $this->conference_model->add($insert_array);
                    }
                }
            }
            }
            $custom_field_post  = $this->input->post("custom_fields[appointment]");
            $custom_value_array = array();
            if (!empty($custom_field_post)) {
                foreach ($custom_field_post as $key => $value) {
                    $check_field_type = $this->input->post("custom_fields[appointment][" . $key . "]");
                    $field_value      = is_array($check_field_type) ? implode(",", $check_field_type) : $check_field_type;
                    $array_custom     = array(
                        'belong_table_id' => 0,
                        'custom_field_id' => $key,
                        'field_value'     => $field_value,
                    );
                    $custom_value_array[] = $array_custom;
                }
            }

            if (!empty($custom_value_array)) {
                $this->customfield_model->insertRecord($custom_value_array, $insert_id);
            }

            $doctor_details = $this->notificationsetting_model->getstaffDetails($this->input->post('doctorid'));
            $event_data     = array(
                'appointment_date' => $this->customlib->YYYYMMDDHisTodateFormat($date_appoint, $this->customlib->getHospitalTimeFormat()),
                'patient_id'       => $patient_id,
                'doctor_id'        => $this->input->post('doctorid'),
                'doctor_name'      => composeStaffNameByString($doctor_details['name'], $doctor_details['surname'], $doctor_details['employee_id']),
                'message'          => $this->input->post('message'),
                'appointment_status' => $this->input->post('appointment_status'),
            );

            $sender_details = array('patient_id' => $appointment_details["patient_id"], 'appointment_id' => $appointment_id);  

        if($this->input->post('appointment_status') == 'Aprobada'){
            $this->mailsmsconf->mailsms('appointment_approved', $sender_details);
            $this->system_notification->send_system_notification('notification_appointment_created', $event_data);           
            $this->system_notification->send_system_notification('appointment_approved', $event_data);
        }

            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'), 'patient_id' => $appointment_details['patient_id'],'appointment_id'=>$appointment_id);
        }
        
        
        echo json_encode($array);
    }
    public function add_calendar(){
      
//       date_default_timezone_set("America/Bogota");
//       $today_date_time = (new DateTime())->format('Y-m-d H:i:s');
      
      $now_utc = new DateTime('now', new DateTimeZone('UTC'));
      $now_bogota = $now_utc->setTimezone(new DateTimeZone('America/Bogota'));
      $bogota_time = $now_bogota->format('Y-m-d H:i:s');

      $date = $this->input->post('date');
      $date = date("Y-m-d",strtotime($date));

      $query = [];
      
      $doctor =  $this->input->post('doctorid');
      $query = $this->db->select('appointment.*')
        ->from('appointment')
        ->where('doctor', $doctor)
        ->where('date', $date)
        ->where('time', $this->input->post('time'))
        ->where('time_finish', $this->input->post('time_finish'))
        ->where('appointment_status !=', "Cancelada")
        ->get()
        ->result();
      
      
      if(count($query) > 0){
        $insert_id = 0;
        echo json_encode($insert_id);
      }else{
         $appointment = array(
                'date'               => $date,
                'doctor'             => $this->input->post('doctorid'),
                'global_shift_id'    => $this->input->post('global_shift_id'),
                'shift_id'           => $this->input->post('slot'),
                'is_queue'           => 0,
                'appointment_status'           => "Agendada",
                "time"               => $this->input->post('time'),
                'time_finish'        => $this->input->post('time_finish'),  
                'source'             => 'Offline',
                'created_at' => $bogota_time
            );
          
            $insert_id = $this->appointment_model->add($appointment);
            echo json_encode($insert_id);
      }
    }
      
    // desarrollo cliniverso
    
    public function case_reference(){
        
        $sender_details = array(
          'id' => NULL,
          'created_at' => NULL,
        ); 
        $this->db->insert('case_references',$sender_details);
        $insert_id = $this->db->insert_id();
       
        echo json_encode($insert_id); 
    }
    
    public function add_alternative(){
                
        $data = $this->input->post();
        $data = array_values($data);
        
//         echo "<pre>";
//         $data['2'] = $data['2'];
//         $dattime =  strtotime($data['2']);
//         print_r(date("Y-m-d H:i:s",strtotime($data['2'])));
//         exit;
        $date = date("Y-m-d H:i:s",strtotime($data['2']));
        $appointment = array(
                'patient_id'         => $data['0'],
                'date'               => $date,
                'doctor'             => $data['1'],
                'message'            => $data['3'],
                'is_queue'           => 0,
                'source'             => 'Offline',
                'case_reference_id'   => $data['4'],
                'visit_details_id' => $data['5'],
            );
//         echo "<pre>";
//         print_r($appointment);
//         exit;
        
        
        
        $this->db->insert('appointment',$appointment);
        $insert_id = $this->db->insert_id();
//        
        echo json_encode($insert_id);
    }
    
    public function visit_det(){
        $data = $this->input->post();
        $data = array_values($data);
        $visit_detail_id_appointment = array ('opd_details_id' => $data['0']);
        $this->db->insert('visit_details',$visit_detail_id_appointment);
          
          $insert_id = $this->db->insert_id();
//        
        echo json_encode($insert_id);
    }
    
    public function add_opd_details(){
        $data = $this->input->post();
        $data = array_values($data);
        $opd_detail = array(
                'patient_id'         => $data['0'],
                'generated_by'      => $data['1'],
                'case_reference_id'   => $data['2'],
                'is_ipd_moved' => 0,
                 'discharged' => "no"
                
            );
        
        $visit_detail = array(
                'opd_details_id'         => $data['2'],
                
            );
        $this->db->insert('opd_details',$opd_detail);
        $insert_id = $this->db->insert_id();
        
//        
        echo json_encode($insert_id);
        
    }
    
    
    

    public function printAppointmentBill()
    {
        $print_details         = $this->printing_model->get('', 'opd');
        $data["print_details"] = $print_details;
        $id     = $this->input->post("appointment_id");
        $result = $this->appointment_model->getDetailsAppointment($id);
        if ($result['appointment_status'] == 'Aprobada') {
            $result['appointment_no'] = $this->customlib->getSessionPrefixByType('appointment') . $id;
        }

        $result["patients_name"]       = composePatientName($result['patients_name']." ".$result['guardian_name'], $result['patient_id']);
        $result["edit_live_consult"]   = $this->lang->line($result['live_consult']);
//         $result["responsible"]         = $result['responsible'];
        $result["reason_consultation"] = $result['reason_consultation'];
        $result["type_visit"]          = $result['type_visit'];
        $result["date"]                = $this->customlib->YYYYMMDDHisTodateFormat($result['date'], $this->time_format);
        $result['custom_fields_value'] = display_custom_fields('appointment', $id);
        $cutom_fields_data             = get_custom_table_values($id, 'appointment');
        $result['field_data']          = $cutom_fields_data;
        $result['patients_gender']     = $result['patients_gender'];
        $result['appointment_status']     = $result['appointment_status'];
        $result['transaction_id']      = $this->customlib->getSessionPrefixByType('transaction_id').$result['transaction_id'];
        $data['appointment_id']        = $id ;
        $data['fields']                = $this->customfield_model->get_custom_fields('appointment');
        $data['result']                = $result;
        $page = $this->load->view('patient/printAppointment', $data, true);
        echo json_encode(array('status' => 1, 'page' => $page));
    }
    /*
    This Function is Used to Update Records

     */
    public function update()
    {
        $custom_fields = $this->customfield_model->getByBelong('appointment');
        if (!empty($custom_fields)) {
            foreach ($custom_fields as $custom_fields_key => $custom_fields_value) {
                if ($custom_fields_value['validation']) {
                    $custom_fields_id   = $custom_fields_value['id'];
                    $custom_fields_name = $custom_fields_value['name'];

                    $this->form_validation->set_rules("custom_fields[appointment][" . $custom_fields_id . "]", $custom_fields_name, 'trim|required');

                }
            }
        }
        $this->form_validation->set_rules('date', $this->lang->line('appointment_date'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('doctor', $this->lang->line('doctor'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('amount', $this->lang->line('doctor_fees'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('message', $this->lang->line('message'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('patient_id', $this->lang->line('patient'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('global_shift', $this->lang->line('shift'), 'trim|required');
        $this->form_validation->set_rules('slot', $this->lang->line('slot'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $msg = array(
                'patient_id'         => form_error('patient_id'),
                'doctor'             => form_error('doctorid'),
                'amount'             => form_error('amount'),
                'global_shift'       => form_error('global_shift'),
                'date'               => form_error('date'),
                'slot'               => form_error('slot'),
                'message'            => form_error('message'),
                'appointment_status' => form_error('appointment_status'),

            );
            if (!empty($custom_fields)) {
                foreach ($custom_fields as $custom_fields_key => $custom_fields_value) {
                    if ($custom_fields_value['validation']) {
                        $custom_fields_id                                                    = $custom_fields_value['id'];
                        $custom_fields_name                                                  = $custom_fields_value['name'];
                        $error_msg2["custom_fields[appointment][" . $custom_fields_id . "]"] = form_error("custom_fields[appointment][" . $custom_fields_id . "]");
                    }
                }
            }
            if (!empty($error_msg2)) {
                $error_msg = array_merge($msg, $error_msg2);
            } else {
                $error_msg = $msg;
            }
            $array = array('status' => 'fail', 'error' => $error_msg, 'message' => '');
        } else {

          
          
          
            $id                  = $this->input->post('id');
            $appointment_details = $this->appointment_model->getDetails($id);
            $date                = $this->input->post('date');
            $custom_field_post   = $this->input->post("custom_fields[appointment]");
            $consult             = $this->input->post('live_consult');
            $appointment_payment = $this->appointment_model->getPaymentByAppointmentId($id);
            $charges             = $this->charge_model->getChargeByChargeId($appointment_payment->charge_id);
            $apply_charge        = $charges['standard_charge'] + ($charges['standard_charge'] * ($charges['percentage'] / 100));

            $appointment = array(
                'id'              => $id,
                'patient_id'      => $this->input->post('patient_id'),
                'date'            => $this->customlib->dateFormatToYYYYMMDDHis($date, $this->time_format),
                'priority'        => $this->input->post('priority'),
                'doctor'          => $this->input->post('doctor'),
                'message'         => $this->input->post('message'),
                'global_shift_id' => $this->input->post('global_shift'),
                'shift_id'        => $this->input->post('slot'),
                'is_queue'        => 0,
                'live_consult'    => $consult,
            );
            $payment_data = array(
                'appointment_id' => $id,
                'paid_amount'    => $this->input->post('amount'),
                'charge_id'      => $this->input->post('charge_id'),
                'payment_type'   => 'Offline',
                'date'           => date("Y-m-d H:i:s"),
            );
            $payment_section   = $this->config->item('payment_section');
            $transaction_array = array(
                'amount'         => $this->input->post("amount"),
                'patient_id'     => $this->input->post('patient_id'),
                'section'        => $payment_section['appointment'],
                'type'           => 'payment',
                'appointment_id' => $id,
                'payment_mode'   => "Offline",
                'payment_date'   => date('Y-m-d H:i:s'),
                'received_by'    => $this->customlib->getLoggedInUserID(),
            );
            $visit_data  = $this->patient_model->getVisitdataDetails($appointment_details['visit_details_id']);
            $opd_details = array(
                'id'           => $visit_data['opdid'],
                'patient_id'   => $appointment_details['patient_id'],
                'generated_by' => $this->customlib->getStaffID(),
            );
            $visit_details = array(
                'id'               => $appointment_details['visit_details_id'],
                'appointment_date' => date("Y-m-d H:i:s"),
                'opd_details_id'   => $visit_data['opdid'],
                'cons_doctor'      => $appointment_details['doctor'],
                'generated_by'     => $this->customlib->getLoggedInUserID(),
                'can_delete'       => 'no',
            );
            $staff_data = $this->staff_model->getStaffByID($appointment_details['doctor']);
            $staff_name = composeStaffName($staff_data);
            $charge     = array(
                'date'            => date('Y-m-d'),
                'charge_id'       => $appointment_payment->charge_id,
                'qty'             => 1,
                'apply_charge'    => $apply_charge,
                'standard_charge' => $charges['standard_charge'],
                'amount'          => $appointment_payment->paid_amount,
                'created_at'      => date('Y-m-d H:i:s'),
                'note'            => $staff_name,
                'tax'             => $charges['percentage'],
            );
//                     echo "<pre>";
//           print_r($payment_data);
//           exit;

            $this->appointment_model->updateAppointment($appointment, $payment_data, $transaction_array, $opd_details, $visit_details, $charge);
            if (!empty($custom_fields)) {
                foreach ($custom_field_post as $key => $value) {
                    $check_field_type = $this->input->post("custom_fields[appointment][" . $key . "]");
                    $field_value      = is_array($check_field_type) ? implode(",", $check_field_type) : $check_field_type;
                    $array_custom     = array(
                        'belong_table_id' => $id,
                        'custom_field_id' => $key,
                        'field_value'     => $field_value,
                    );
                    $custom_value_array[] = $array_custom;
                }
                $this->customfield_model->updateRecord($custom_value_array, $id, 'appointment');
            }
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        }
        echo json_encode($array);
    }   

    public function search()
    {
        $this->session->set_userdata('top_menu', 'front_office');
        $app_data                      = $this->session->flashdata('app_data');
        $data['app_data']              = $app_data;
        $doctors                       = $this->staff_model->getStaffbyrole(3);
        $data["doctors"]               = $doctors;
        $patients                      = $this->patient_model->getPatientListall();
        $data["patients"]              = $patients;
        $data["appointment_status"]    = $this->appointment_status;
        $userdata                      = $this->customlib->getUserData();
        $role_id                       = $userdata['role_id'];
        $data["yesno_condition"]       = $this->yesno_condition;
        $doctorid                      = "";
        $data['appoint_priority_list'] = $this->appoint_priority_model->appoint_priority_list();
        $doctor_restriction            = $this->session->userdata['hospitaladmin']['doctor_restriction'];
        $disable_option                = false;
        if ($doctor_restriction == 'enabled') {
            if ($role_id == 3) {
                $disable_option = true;
                $doctorid       = $userdata['id'];
            }
        }
        $data["doctor_select"]  = $doctorid;
        $data["disable_option"] = $disable_option;
        $data['fields']         = $this->customfield_model->get_custom_fields('appointment', 1);
        $this->load->view('layout/header');
        $this->load->view('admin/appointment/search.php', $data);
        $this->load->view('layout/footer');
    }
 
    /*
    This Function is Used to get appointment records for datatable
     */
    //cliniverso_datables

//     public function getappointmentdatatable($fecha_inicial=null, $fecha_final=null,$doctor_id=null)
//     {
      
//         date_default_timezone_set("America/Bogota");

//         $dt_response = $this->appointment_model->getAllappointmentRecord($fecha_inicial, $fecha_final,$doctor_id);
//         $fields      = $this->customfield_model->get_custom_fields('appointment', 1);
// //         $fields     = $this->customfield_model->get_custom_fields('patient');
//         $dt_response = json_decode($dt_response);
      
// //         echo "<pre>";
// //         print_r($dt_response->data);
// //         exit; responsible
      
//         $dt_data     = array();
//         if (!empty($dt_response->data)) {
//             foreach ($dt_response->data as $key => $value) {

//                 // edit by cliniverso desarrollo
              
//                 $this->db->where('patient_id', NULL);
//                 $this->db->delete('appointment');

//                 $this->db->select('*');
//                 $this->db->from('custom_field_values');
//                 $this->db->where('belong_table_id', $value->pid);
//                 $query2 = $this->db->get();
//                 $custom = $query2->result_object();
//                 $patient_detail = $this->patient_model->getpatientDetails($value->pid);


//                 $doctor_duration = $this->db->query("SELECT consult_duration
//                                         FROM shift_details 
//                                         WHERE staff_id = " .$value->doctor. ";")->result_object();

//                 $finish= $value->time;
//                 $doctor_duration[0]->consult_duration;
              
//                 if($value->appointment_status == "Aprobada" || $value->appointment_status == "Firmada" ){

//                     $query_pay['payment'] = $this->db->query("SELECT appointment_payment.*
//                                               FROM appointment_payment
//                                               where appointment_id = ".$value->id." ;")->result();

//                     $query_pay['patient'] = $this->db->query("SELECT patients.* FROM patients WHERE id = ".$value->patient_id)->row();

//                     $query_pay['appointment'] = $this->db->query("SELECT appointment.*
//                                                 FROM appointment
//                                                 where id = ".$value->id." ;")->result();

//                     $guardian_name = $patient_detail['guardian_name'];

//                     $query_pay['patient_custom'] = get_custom_table_values($value->patient_id, 'patient');

//                     $bill_appointment = json_encode($query_pay);
//                 }

//                 foreach($custom as $key2=>$value2){  
//                     if($value2->custom_field_id == 12){
//                         $eps = $value2->field_value;
//                     }
//                     if($value2->custom_field_id == 10){
//                         $regimen = $value2->field_value;
//                     }
//                 }

//                 $row = array();

//                   $label = "";
//                   if ($value->appointment_status == "Aprobada") {
//                       $label  = "class='label cita_aprobada' style='display: flex; justify-content: center; align-items: center;'";
//                       $status = "Por Atender";
//                       $color_back = "cita_aprobada";
//                   } else if ($value->appointment_status == "Agendada") {
//                       $label  = "class='label cita_agendada' style='display: flex; justify-content: center; align-items: center;'";
//                       $status = "Agendada";
//                       $color_back = "cita_agendada";
//                   }else if ($value->appointment_status == "Bloqueada") {
//                       $label  = "class='label cita_bloqueada' style='display: flex; justify-content: center; align-items: center;'";
//                       $status = "Bloqueada";
//                       $color_back = "cita_bloqueada";
//                   } else if ($value->appointment_status == "Cancelada") {
//                       $label  = "class='label cita_cancelada' style='display: flex; justify-content: center; align-items: center;'";
//                       $status = "Cancelada";
//                       $color_back = "cita_cancelada";
//                   }else if($value->appointment_status == "Confirmada"){
//                      $label  = "class='label cita_confirmada' style='display: flex; justify-content: center; align-items: center;'";
//                      $status = "Confirmada";
//                      $color_back = "cita_confirmada";
//                   }else if($value->appointment_status == "Firmada"){
//                      $label  = "class='label cita_firmada' style='display: flex; justify-content: center; align-items: center;'";
//                      $status = "Firmada";
//                      $color_back = "cita_firmada";
//                   }

//                   $style = "<div class='".$color_back."' style='padding:10px;color:#fff;height:90px;border-radius:5px;'>";
//                   $style_identification = "<div class='".$color_back."' style='padding:10px;color:#fff;height:90px;border-radius:5px;'>";

//                   $action = "<div class='rowoptionview rowview-btn-top' >";
//                   $action .= "<a href=".site_url('admin/patient/profile').'/'.$value->patient_id." data-toggle='tooltip' style=color:#000 !important; title='Paciente' class='btn btn-default btn-xs' data-target='#viewModal'><i class='fas fa-user'></i></a>";
//   //                 $action .="<a href='#'  class='btn btn-default btn-xs btn btn-md ' data-toggle='tooltip' style=color:#000 !important; onclick=print_visit_bill(".$value->opd_details_id.") data-original-title=".$this->lang->line('print')."><i class='fa fa-print'></i></a>";
//                   if ($this->rbac->hasPrivilege('reschedule', 'can_view')) {
//                   }

//                  if(isset($value->visit_details_id)){
//                          $query_visit = $this->db->query("SELECT opd_details_id
//                                                           FROM visit_details
//                                                           where id = ".$value->visit_details_id." ;")->row();

//                          $visit = $query_visit->opd_details_id;
//                  }


//                  if ($value->appointment_status == 'Agendada') {
//                       if ($value->source != 'Online') {
//                           if ($this->rbac->hasPrivilege('appointment_approve', 'can_view') || $this->rbac->hasPrivilege('reschedule', 'can_view')) {
//                               $action .= "<a href='#' data-toggle='tooltip' style='color: black; !important;' title='Actualizar' class='btn btn-default btn-xs' data-target='#rescheduleModal' onclick='viewreschedule(".$value->id.")'><i class='fa fa-calendar'></i></a>";
//                           }
//                       }
//                  }

//                  if ($value->appointment_status == 'Bloqueada') {
//                       if ($value->source != 'Online') {
//                           if ($this->rbac->hasPrivilege('appointment_approve', 'can_view') || $this->rbac->hasPrivilege('reschedule', 'can_view')) {
//                               $action .= "<a href='#' data-toggle='tooltip' style='color: black; !important;' title='Actualizar' class='btn btn-default btn-xs' data-target='#rescheduleModal' onclick='viewreschedule(".$value->id.")'><i class='fa fa-calendar'></i></a>";
//                           }
//                       }
//                  }


//                  if ($value->appointment_status == 'Confirmada') {
//                       if ($value->source != 'Online') {
//                           if ($this->rbac->hasPrivilege('appointment_approve', 'can_view') || $this->rbac->hasPrivilege('reschedule', 'can_view')) {
//                               $action .= " <a href='#' data-toggle='tooltip'  style='color: black; !important;' title='" . $this->lang->line('reschedule') . "' class='btn btn-default btn-xs' data-target='#rescheduleModal' onclick='viewreschedule(".$value->id.")'><i class='fa fa-calendar'></i></a>";
//                               $action .= "<span class='large-tooltip'><a href='#' class='btn btn-default btn-xs'  style='color: black; !important;' data-toggle='tooltip' title='' data-target='#rescheduleModal' onclick='viewreschedule(" . $value->id . ")' data-original-title='" . $this->lang->line('approve_appointment') . "'><i class='fa fa-check' aria-hidden='true'></i></a></span>";
//                           }
//                       } 
//                  }

//                 if ($value->appointment_status == 'Cancelada') {
//                       if ($value->source != 'Online') {

//                       }
//                 }

//                 if ($value->appointment_status == 'Aprobada') {
//                       if ($value->source != 'Online') {
//                           if ($this->rbac->hasPrivilege('appointment_approve', 'can_view') || $this->rbac->hasPrivilege('reschedule', 'can_view')) {
//                               $action .= "<span class='large-tooltip'><a href='#' class='btn btn-default btn-xs addpayment' style='color:#000 !important;' data-toggle='tooltip' title=''  data-original-title='Pagar'><i class='fa fa-dollar' aria-hidden='true'></i></a></span>";
//                               $action .="<a href='#'  class='btn btn-default btn-xs btn btn-md ' data-toggle='tooltip' style='color: black; !important;' onclick=print_visit_bill($visit) data-original-title=".$this->lang->line('print')."><i class='fa fa-print'></i></a>";
//                               $action.= "<span><a href='#' onclick='billopd_clini($bill_appointment,$visit)'  class='btn btn-default btn-xs' style='color: black; !important;' data-toggle='tooltip' data-original-title='Factura'><i class='fa fa-money-bill' aria-hidden='true'></i></a></span>";
//                            }
//                       }
//                 }

//                 if ($value->appointment_status == 'Firmada') {
//                       if ($value->source != 'Online') {
//                          $action .="<a href='#'  class='btn btn-default btn-xs btn btn-md ' data-toggle='tooltip' style='color: black; !important;' onclick=print_visit_bill($visit) data-original-title=".$this->lang->line('print')."><i class='fa fa-print'></i></a>";
//                          $action.= "<span><a href='#' onclick='billopd_clini($bill_appointment,$visit)'  class='btn btn-default btn-xs' style='color: black; !important;' data-toggle='tooltip' data-original-title='Factura'><i class='fa fa-money-bill' aria-hidden='true'></i></a></span>";
//                       }
//                  }

//                  $action .= "</div>";
//                  $first_action = "<div class='name_link ".$color_back."' style='padding:10px;color: black;height:90px;border-radius:5px;font-weight:semibold;'><a  href='javascript:void(0)' style=color:#fff;  data-toggle='tooltip'  data-target='#viewModal' title='Ver detalles de la cita'  onclick='viewDetail(" . $value->id . ")'>";

//                  if(!empty($value->live_consult)) {
//                      $live_consult = $this->lang->line($value->live_consult);
//                  } else { 
//                     $live_consult = '';
//                  };

//                   $row[] =  $first_action."<i class='fa fa-user' aria-hidden='true'></i> " . composePatientName($value->patient_name." ".$value->guardian_name,$value->pid) . "</a>" . $action."</div>";
//                   $row[] = $style.$patient_detail['identification_number']."</div>";
//                   $row[] =  $style.$value->reason_consultation."</div>";

//   //                   $today =  date("y/m/d");

//   //                  $today = date("Y/m/d",mktime(0, 0, 0, date("m")  , date("d")+0, date("Y")));
//   //                  $ini = date('Y/m/d', strtotime($value->date));

//                    $today = date("Y/m/d H:i:s", mktime(date("H"), date("i"), date("s"), date("m"), date("d")+0, date("Y")));

//                    $fecha = new DateTime($value->time);
//                    $fecha->add(new DateInterval('PT20M'));
//                    $new_time = $fecha->format('H:i:s');

//   //                  // Convertir la hora original a objeto DateTime
//   //                  $hora_dt = DateTime::createFromFormat('H:i:s', $value->time);

//   //                  // Obtener la hora y los minutos
//   //                  $value_time = $hora_dt->format('H:i');

//   //                  $ini = $style.date('Y/m/d H:i:s', strtotime($value->date.' '.$new_time))."</div>";


//   //                 echo "<pre>";
//   //                 print_r("today: ".$today.", ini: ".$ini." today_time: ".$value->time." new time: ".$new_time);
//   //                 exit;

//   //                 if($status != 'Cancelada' && $status != 'Aprobada' && $status != 'No Asistió' && $today > $ini){
//   //                     $label  = "class='label cita_cancelada' style='width:80px;display: inline-block;'";
//   //                     $status = "No asistio";
//   //                     $color_back = "cita_cancelada";
//   //                 }

//                   $row[] = '<div style="max-width:130px">'.$style.$eps."</div>";
//                   $row[] = '<div style="min-width:10px;max-width:380px">'.$style."<i class='fas fa-stethoscope'></i> " .composeStaffNameByString($value->name, $value->surname, $value->employee_id)."<br>Especialidad : <b>".$value->specialist_name."</b></div>";
//                   $time_total = $value->time." ".$value->time_finish;
//                   if($today == $ini){
//                     $row[] =  '<div style="min-width:70px">'.$style.date('Y/m/d', strtotime($value->date))."<br>  ".$time_total."</div>";
//                   }else{
//                     $row[] =  '<div style="min-width:70px">'.$style.date('Y/m/d', strtotime($value->date))."<br> ".$time_total."</div>";
//                   }
              
              
//                   if ($this->module_lib->hasActive('live_consultation')) {
//                       $row[] = $live_consult;
//                   }

//                   if (!empty($fields)) {
//                       foreach ($fields as $fields_key => $fields_value) {
//                           $display_field = $value->{"$fields_value->name"};
//                           if ($fields_value->type == "link") {
//                               $display_field = "<a href=" . $value->{"$fields_value->name"} . " target='_blank'>" . $value->{"$fields_value->name"} . "</a>";
//                           }
//                           $row[] = $display_field;
//                       }
//                   }
              
//                   $row[] = $value->type_visit;

//                   $row[] = "<div><small " . $label . ">" . $status . "</small></div>";

//                   if($status == "Aprobada") {
//                       $row[] = "<small " . $label . ">Por Atender</small>";
//                   }
              

//                   $dt_data[] = $row;

//           }
//         }
      
      
//         $json_data = array(
//             "draw"            => intval($dt_response->draw),
//             "recordsTotal"    => intval($dt_response->recordsTotal),
//             "recordsFiltered" => intval($dt_response->recordsFiltered),
//             "data"            => $dt_data,
//         );
      
//         echo json_encode($json_data);
    
//     }
  
  
    public function get_appointment_datatable($fecha_inicial = null, $fecha_final = null, $doctor_id = null)
    {
      
        date_default_timezone_set("America/Bogota");
      
        $view = $this->input->get('view');

        $dt_response = $this->appointment_model->getAllappointmentRecord($fecha_inicial, $fecha_final, $doctor_id, $view);
        $fields      = $this->customfield_model->get_custom_fields('appointment', 1);
//         $fields     = $this->customfield_model->get_custom_fields('patient');
        $dt_response = json_decode($dt_response);
      
//         echo "<pre>";
//         print_r($dt_response);
//         exit; 
      
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
              
                if($value->appointment_status == "Aprobada" || $value->appointment_status == "Firmada" ){

                    $query_pay['payment'] = $this->db->query("SELECT appointment_payment.*
                                              FROM appointment_payment
                                              where appointment_id = ".$value->id." ;")->result();

                    $query_pay['patient'] = $this->db->query("SELECT patients.* FROM patients WHERE id = ".$value->patient_id)->row();

  //                   $query_pay['patient'] = $this->db->query("SELECT patients.*
  //                                               FROM patients
  //                                               where id = ".$value->patient_id." ;")->result();
                    $query_pay['appointment'] = $this->db->query("SELECT appointment.*
                                                FROM appointment
                                                where id = ".$value->id." ;")->result();

                    $guardian_name = $patient_detail['guardian_name'];

                    $query_pay['patient_custom'] = get_custom_table_values($value->patient_id, 'patient');

                    $bill_appointment = json_encode($query_pay);
                }
  //               echo "<pre>";
  //               print_r($bill_appointment);
  //               exit;
                foreach($custom as $key2=>$value2){  
                    if($value2->custom_field_id == 12){
                        $eps = $value2->field_value;
                    }
                    if($value2->custom_field_id == 10){
                        $regimen = $value2->field_value;
                    }
                }

                $row = array();

                  $label = "style='display: flex; justify-content: center;'";
                  if ($value->appointment_status == "Aprobada") {
                      $label  = "class='label cita_aprobada'";
                      $status = "Por Atender";
                      $color_back = "cita_aprobada";
                  } else if ($value->appointment_status == "Agendada") {
                      $label  = "class='label cita_agendada'";
                      $status = "Agendada";
                      $color_back = "cita_agendada";
                  }else if ($value->appointment_status == "Bloqueada") {
                      $label  = "class='label cita_bloqueada'";
                      $status = "Bloqueada";
                      $color_back = "cita_bloqueada";
                  } else if ($value->appointment_status == "Cancelada") {
                      $label  = "class='label cita_cancelada'";
                      $status = "Cancelada";
                      $color_back = "cita_cancelada";
                  }else if($value->appointment_status == "Confirmada"){
                     $label  = "class='label cita_confirmada'";
                     $status = "Confirmada";
                     $color_back = "cita_confirmada";
                  }else if($value->appointment_status == "Firmada"){
                     $label  = "class='label cita_firmada'";
                     $status = "Firmada";
                     $color_back = "cita_firmada";
                  } else if($value->appointment_status == "No Asistida"){
                     $label  = "class='label cita_no_asistida'";
                     $status = "No Asistida";
                     $color_back = "cita_no_asistida";
                  }

                  $style = "<div class='".$color_back." text-ellipsis' style='padding:10px;color:#fff; height: 90px; border-radius:5px;'>";
                  $style_identification = "<div class='".$color_back."' style='padding:10px;color:#fff;height:90px;border-radius:5px;'>";

                  $action = "<div class='rowoptionview rowview-btn-top' >";
                  $action .= "<a href=".site_url('admin/patient/profile').'/'.$value->patient_id." data-toggle='tooltip' style='color:#000 !important;' title='Paciente' class='btn btn-default btn-xs' data-target='#viewModal'><i class='fas fa-user'></i></a>";
  //                 $action .="<a href='#'  class='btn btn-default btn-xs btn btn-md ' data-toggle='tooltip' style=color:#000 !important; onclick=print_visit_bill(".$value->opd_details_id.") data-original-title=".$this->lang->line('print')."><i class='fa fa-print'></i></a>";
                  if ($this->rbac->hasPrivilege('reschedule', 'can_view')) {
                  }

                 if(isset($value->visit_details_id)){
                         $query_visit = $this->db->query("SELECT opd_details_id
                                                          FROM visit_details
                                                          where id = ".$value->visit_details_id." ;")->row();

                         $visit = $query_visit->opd_details_id;
                 }


                 if ($value->appointment_status == 'Agendada') {
                      if ($value->source != 'Online') {
                          if ($this->rbac->hasPrivilege('appointment_approve', 'can_view') || $this->rbac->hasPrivilege('reschedule', 'can_view')) {
                              $action .= "<a href='#' data-toggle='tooltip' style='color: black; !important;' title='Actualizar' class='btn btn-default btn-xs' data-target='#rescheduleModal' onclick='viewreschedule(".$value->id.")'><i class='fa fa-calendar'></i></a>";
                          }
                      }
                 }

                 if ($value->appointment_status == 'Bloqueada') {
                      if ($value->source != 'Online') {
                          if ($this->rbac->hasPrivilege('appointment_approve', 'can_view') || $this->rbac->hasPrivilege('reschedule', 'can_view')) {
                              $action .= "<a href='#' data-toggle='tooltip' style='color: black; !important;' title='Actualizar' class='btn btn-default btn-xs' data-target='#rescheduleModal' onclick='viewreschedule(".$value->id.")'><i class='fa fa-calendar'></i></a>";
                          }
                      }
                 }


                 if ($value->appointment_status == 'Confirmada') {
                      if ($value->source != 'Online') {
                          if ($this->rbac->hasPrivilege('appointment_approve', 'can_view') || $this->rbac->hasPrivilege('reschedule', 'can_view')) {
                              $action .= " <a href='#' data-toggle='tooltip'  style='color: black; !important;' title='" . $this->lang->line('reschedule') . "' class='btn btn-default btn-xs' data-target='#rescheduleModal' onclick='viewreschedule(".$value->id.")'><i class='fa fa-calendar'></i></a>";
                              $action .= "<span class='large-tooltip'><a href='#' class='btn btn-default btn-xs'  style='color: black; !important;' data-toggle='tooltip' title='' data-target='#rescheduleModal' onclick='viewreschedule(" . $value->id . ")' data-original-title='" . $this->lang->line('approve_appointment') . "'><i class='fa fa-check' aria-hidden='true'></i></a></span>";
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
                              $action .="<a href='#'  class='btn btn-default btn-xs btn btn-md ' data-toggle='tooltip' style='color: black; !important;' onclick=print_visit_bill($visit) data-original-title=".$this->lang->line('print')."><i class='fa fa-print'></i></a>";
                              $action.= "<span><a href='#' onclick='billopd_clini($bill_appointment,$visit)'  class='btn btn-default btn-xs' style='color: black; !important;' data-toggle='tooltip' data-original-title='Factura'><i class='fa fa-money-bill' aria-hidden='true'></i></a></span>";
                           }
                      }
                }

                if ($value->appointment_status == 'Firmada') {
                      if ($value->source != 'Online') {
                         $action .="<a href='#'  class='btn btn-default btn-xs btn btn-md ' data-toggle='tooltip' style='color: black; !important;' onclick=print_visit_bill($visit) data-original-title=".$this->lang->line('print')."><i class='fa fa-print'></i></a>";
                         $action.= "<span><a href='#' onclick='billopd_clini($bill_appointment,$visit)'  class='btn btn-default btn-xs' style='color: black; !important;' data-toggle='tooltip' data-original-title='Factura'><i class='fa fa-money-bill' aria-hidden='true'></i></a></span>";
                      }
                 }

                 $action .= "</div>";
                 $first_action = "<div class='name_link ".$color_back."' style='padding:10px;color: black;height:90px;border-radius:5px;font-weight:semibold;'><a  href='javascript:void(0)' style=color:#fff;  data-toggle='tooltip'  data-target='#viewModal' title='Ver detalles de la cita'  onclick='viewDetail(" . $value->id . ")'>";

                 if(!empty($value->live_consult)) {
                     $live_consult = $this->lang->line($value->live_consult);
                 } else { 
                    $live_consult = '';
                 };

                  $row[] =  $first_action."<i class='fa fa-user' aria-hidden='true'></i> " . composePatientName($value->patient_name." ".$value->guardian_name,$value->pid) . "</a>" . $action."</div>";
                  $row[] = $style.$patient_detail['identification_number']."</div>";
                  $row[] =  $style.$value->reason_consultation."</div>";

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

  //                  $ini = $style.date('Y/m/d H:i:s', strtotime($value->date.' '.$new_time))."</div>";


  //                 echo "<pre>";
  //                 print_r("today: ".$today.", ini: ".$ini." today_time: ".$value->time." new time: ".$new_time);
  //                 exit;

  //                 if($status != 'Cancelada' && $status != 'Aprobada' && $status != 'No Asistió' && $today > $ini){
  //                     $label  = "class='label cita_cancelada' style='width:80px;display: inline-block;'";
  //                     $status = "No asistio";
  //                     $color_back = "cita_cancelada";
  //                 }

                  $row[] = '<div>'.$style.$eps."</div>";
                  $row[] = '<div>'.$style."<i class='fas fa-stethoscope'></i> " .composeStaffNameByString($value->name, $value->surname, $value->employee_id)."<br>Especialidad : <b>".$value->specialist_name."</b></div>";
                  $time_total = $value->time." ".$value->time_finish;
                  if($today == $ini){
                    $row[] =  '<div>'.$style.date('Y/m/d', strtotime($value->date))."<br>  ".$time_total."</div>";
                  }else{
                    $row[] =  '<div>'.$style.date('Y/m/d', strtotime($value->date))."<br> ".$time_total."</div>";
                  }
              
              
                  if ($this->module_lib->hasActive('live_consultation')) {
                      $row[] = $live_consult;
                  }

                  if (!empty($fields)) {
                      foreach ($fields as $fields_key => $fields_value) {
                          $display_field = $value->{"$fields_value->name"};
                          if ($fields_value->type == "link") {
                              $display_field = "<a href=" . $value->{"$fields_value->name"} . " target='_blank'>" . $value->{"$fields_value->name"} . "</a>";
                          }
                          $row[] = $display_field;
                      }
                  }
                  $row[] = "<div style='min-width:10px;max-width:380px'>$style<h6>$value->type_visit</h6></div>";

                  $row[] = "<div><small " . $label . ">" . $status . "</small></div>";

                  if($status == "Aprobada") {
                      $row[] = "<small " . $label . ">Por Atender</small>";
                  }
              

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

    public function getDetails()
    {
        $id             = $this->input->post("appointment_id");
        $result         = $this->appointment_model->getDetails($id);
        $result["date"] = $this->customlib->YYYYMMDDHisTodateFormat($result['date'], $this->time_format);
        echo json_encode($result);
    }

    public function getDetailsAppointment()
    {
        $id     = $this->input->get("appointment_id");
        $result = $this->appointment_model->getDetailsAppointment($id);

//         $this->db->select('o.*');
//         $this->db->from('operation_theatre');
//         $this->db->where('operation_theatre.appointment_id', $id);
//         $result['id'] =  $this->db->query("SELECT operation_theatre.id
//                                                       FROM operation_theatre
//                                                       WHERE operation_theatre.appointment_id = ".$id.";")->row();
      

          $this->db->select('operation_theatre.anesthetist, staff_anesthetist.name as name_anesthetist, staff_anesthetist.surname as surname_anesthetist, operation_theatre.ass_consultant_1, staff_ass_consultant_1.name as name_consultant_1, staff_ass_consultant_1.surname as surname_consultant_1');
          $this->db->from('operation_theatre');
          $this->db->join('staff as staff_anesthetist', 'staff_anesthetist.id = operation_theatre.anesthetist', 'left');
          $this->db->join('staff as staff_ass_consultant_1', 'staff_ass_consultant_1.id = operation_theatre.ass_consultant_1', 'left');

//           $this->db->join('roles', 'roles.id = operation_theatre.ass_consultant_1', 'left');
          $this->db->where('appointment_id', $id);

          $result_get = $this->db->get();
      
          $result['doctors_team'] = $result_get->row_array();
      
//           echo '<pre>';
//           print_r($result['doctors_team']);
//           exit;

        if ($result['appointment_status'] == 'Aprobada') {
            $result['appointment_no'] = $this->customlib->getSessionPrefixByType('appointment') . $id;
        }

        $result["patients_name"]       = composePatientName($result['patients_name']." ".$result['guardian_name'], $result['patient_id']);
        $result["identification_number"] =  $result["identification_number"];
        $result["edit_live_consult"]   = $this->lang->line($result['live_consult']);
        $result["live_consult"]        = $result['live_consult'];
        $result["patient_id"]          = $result['patient_id'];
        $result["reason_consultation"] = $result['reason_consultation'];
        $result["procedure_name"] = $result['procedure_name'];
//         $result["responsible_consult"] = $result['responsible'];
        $result["patients_name"]       = $result['patients_name'];
        $result["type_visit"]          = $result['type_visit'];
        $result["opd_details_id"]      = $result['opd_details_id'];
//         $result["date"]                = $this->customlib->YYYYMMDDHisTodateFormat($result['date'], $this->time_format);
        $result["date"]                = $result['date'];
        $result['custom_fields_value'] = display_custom_fields('appointment', $id);
        $cutom_fields_data             = get_custom_table_values($result['patient_id'], 'patient');
        $result['field_data']          = $cutom_fields_data;
        $result['patients_gender']     = $result['patients_gender'];
        $result['amount']              = amountFormat($result['paid_amount']);
        $result['payment_mode']        = $this->lang->line(strtolower($result['payment_mode']));
        $result['cheque_no']           = $result['cheque_no'];
        $result['time_finish']           = $result['time_finish'];
        $result['cheque_date']         = $this->customlib->YYYYMMDDTodateFormat($result['cheque_date']);
        $result['attachment']          = $result['attachment'];
        $transaction_id                = $result['transaction_id'];
        if($result['transaction_id']!=""){
            $result['transaction_id'] = $this->customlib->getSessionPrefixByType('transaction_id').$result['transaction_id'];
        }else{
            $result['transaction_id']="";
        }
      
        
       $query_pay['payment'] = $this->db->query("SELECT appointment_payment.*
                                  FROM appointment_payment
                                  where appointment_id = ".$id ." ;")->result();
      
        if ($result['appointment_status'] == 'Aprobada') {
            $query_pay['patient'] = $this->db->query("SELECT patients.* FROM patients WHERE id = ".$result["patient_id"])->row();
        }


        $query_pay['patient_custom'] = get_custom_table_values($id, 'patient');
     
//         echo "<pre>";
//         print_r($result["patient_id"]); <-- not exist!
//         exit;
      
        $query_pay['appointment'] = $this->db->query("SELECT appointment.*
                                              FROM appointment
                                              where id = ".$id." ;")->result();

        $bill_appointment = $query_pay;
        $result['bill_appointment'] = $bill_appointment;
      

        
        $result['department_name']     = $result['department_name'];
        $result['age']                 = $result['age'];
        $result['day']                 = $result['day'];
        $result['month']               = $result['month'];
        $result['patient_age']         = $this->customlib->getPatientAge($result['age'],$result['month'],$result['day']);
        $this->db->select('*');
        $this->db->from('custom_field_values');
        $this->db->where('belong_table_id', $result['patient_id']);
        $query2 = $this->db->get();
        $result['custom_fields_patient'] = $query2->result_object();
      
        if ($result['attachment'] != "") {
            $result["doc"] = "<a href='" . site_url('admin/transaction/download/') .  $transaction_id . "' class='btn btn-default btn-xs'  title=" . $this->lang->line('download') . "><i class='fa fa-download'></i></a>";
        } else {
            $result["doc"] = "";
        }

        echo json_encode($result);
    }

    public function getappDetails($id)
    {
        $result         = $this->appointment_model->getDetails($id);
        $result["date"] = $this->customlib->YYYYMMDDHisTodateFormat($result['date'], $this->time_format);
        echo json_encode($result);
    }

/*
This Function is Used to Delete created Appointment patient
 */
    public function delete($id)
    {
        if (!empty($id)) {
            $appointment_details = $this->appointment_model->getDetails($id);
            $visit_details_id    = $appointment_details['visit_details_id'];
            $visit_data          = $this->patient_model->getVisitdataDetails($visit_details_id);
            $opd_id              = $visit_data['opdid'];
            $this->appointment_model->delete($id, $visit_details_id, $opd_id);
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('delete_message'));
        } else {
            $array = array('status' => 'fail', 'error' => '', 'message' => '');
        }
        echo json_encode($array);
    }
    
/*
This Function is Used to move patient from appointment to other module

 */
    public function move($id)
    {
        $appointment_details = $this->appointment_model->getDetails($id);
        $patient_name        = $appointment_details['patient_name'];
        $gender              = $appointment_details['gender'];
        $email               = $appointment_details['email'];
        $phone               = $appointment_details['mobileno'];
        $doctor              = $appointment_details['doctor'];
        $note                = $appointment_details['message'];
        $appointment_date    = $appointment_details['date'];
        $amount              = $appointment_details['amount'];
        $live_consult        = $appointment_details['live_consult'];

        $check_patient_id = $this->patient_model->getMaxId();
        if (empty($check_patient_id)) {
            $check_patient_id = 1000;
        }
        $patient_id   = $check_patient_id + 1;
        $patient_data = array(
            'patient_name'      => $patient_name,
            'mobileno'          => $phone,
            'email'             => $email,
            'gender'            => $gender,
            'patient_unique_id' => $patient_id,
            'note'              => $note,
            'is_active'         => 'yes',
        );

        $insert_id          = $this->patient_model->add_patient($patient_data);
        $user_password      = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
        $data_patient_login = array(
            'username' => $this->patient_login_prefix . $insert_id,
            'password' => $user_password,
            'user_id'  => $insert_id,
            'role'     => 'patient',
        );
        $this->user_model->add($data_patient_login);
        $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
            $fileInfo = pathinfo($_FILES["file"]["name"]);
            $img_name = $insert_id . '.' . $fileInfo['extension'];
            move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/patient_images/" . $img_name);
            $data_img = array('id' => $insert_id, 'image' => 'uploads/patient_images/' . $img_name);
            $this->patient_model->add($data_img);
        }
        if (isset($insert_id)) {
            $check_opd_id = $this->patient_model->getMaxOPDId();
            $opdnoid      = $check_opd_id + 1;

            $opd_data = array(
                'appointment_date' => $appointment_date,
                'opd_no'           => 'OPDN' . $opdnoid,
                'cons_doctor'      => $doctor,
                'patient_id'       => $insert_id,
                'amount'           => $amount,
                'live_consult'     => $live_consult,
            );
            $opd_id = $this->patient_model->add_opd($opd_data);

            if (isset($opd_id)) {
                $this->appointment_model->delete($id);
            }
        }

        redirect('admin/appointment/search');
    }

    public function moveipd()
    {
        $custom_fields = $this->customfield_model->getByBelong('ipd');

        foreach ($custom_fields as $custom_fields_key => $custom_fields_value) {
            if ($custom_fields_value['validation']) {
                $custom_fields_id   = $custom_fields_value['id'];
                $custom_fields_name = $custom_fields_value['name'];
                $this->form_validation->set_rules("custom_fields[ipd][" . $custom_fields_id . "]", $custom_fields_name, 'trim|required');
            }
        }
        $this->form_validation->set_rules('bed_no', $this->lang->line('bed_no'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('appointment_date', $this->lang->line('appointment_date'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('consultant_doctor', $this->lang->line('consultant_doctor'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $msg = array(
                'appointment_date'  => form_error('appointment_date'),
                'bed_no'            => form_error('bed_no'),
                'consultant_doctor' => form_error('consultant_doctor'),
                'opd_id'            => form_error('opd_id'),

            );
            if (!empty($custom_fields)) {
                foreach ($custom_fields as $custom_fields_key => $custom_fields_value) {
                    if ($custom_fields_value['validation']) {
                        $custom_fields_id                                            = $custom_fields_value['id'];
                        $custom_fields_name                                          = $custom_fields_value['name'];
                        $error_msg2["custom_fields[ipd][" . $custom_fields_id . "]"] = form_error("custom_fields[ipd][" . $custom_fields_id . "]");
                    }
                }
            }

            if (!empty($error_msg2)) {
                $error_msg = array_merge($msg, $error_msg2);
            } else {
                $error_msg = $msg;
            }
            $array = array('status' => 'fail', 'error' => $error_msg, 'message' => '');

        } else {

            $appointment_id      = $this->input->post('appointment_id');
            $appointment_details = $this->appointment_model->getDetails($appointment_id);
            $ipd_details         = array(
                'patient_id'      => $appointment_details['patient_id'],
                'bed'             => $this->input->post('bed_no'),
                'bed_group_id'    => $this->input->post('bed_group_id'),
                'height'          => $this->input->post('height'), 
                'weight'          => $this->input->post('weight'), 
                'pulse'           => $this->input->post('pulse'), 
                'temperature'     => $this->input->post('temperature'), 
                'respiration'     => $this->input->post('respiration'), 
                'bp'              => $this->input->post('bp'), 
                'case_type'       => $this->input->post('case'), 
                'casualty'        => $this->input->post('casualty'), 
                'symptoms'        => $this->input->post('symptoms'), 
                'known_allergies' => $this->input->post('symptoms'), 
                'date'            => $this->customlib->dateFormatToYYYYMMDDHis($this->input->post('appointment_date'), $this->time_format), 
                'refference'      => $this->input->post('refference'), 
                'cons_doctor'     => $this->input->post('consultant_doctor'), 
                'live_consult'    => $this->input->post('live_consult'),
                'discharged'      => 'no',
            );
            $bed_history = array(
                "bed_group_id" => $this->input->post("bed_group_id"),
                "bed_id"       => $this->input->post("bed_no"),
                "from_date"    => date("Y-m-d H:i:s"),
                "is_active"    => "yes",
            );
            $ipd_id = $this->appointment_model->moveToIpd($ipd_details, $bed_history, $appointment_id);
            if ($ipd_id) {
                $array = array('status' => 'success', 'message' => $this->lang->line('success_message'), 'ipd_id' => $ipd_id);

            } else {
                $msg   = array('no_insert' => $this->lang->line('something_went_wrong'));
                $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
            }
        }
        echo json_encode($array);
    }

    public function getpatientDetails()
    {
        $id     = $this->input->post("patient_id");
        $result = $this->appointment_model->getpatientDetails($id);
        echo json_encode($result);
    }

    public function checkvalidation()
    {
        $search = $this->input->post('search');
        $this->form_validation->set_rules('search_type', $this->lang->line('search_type'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $msg = array(
                'search_type' => form_error('search_type'),
            );
            $json_array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $param = array(
                'search_type'      => $this->input->post('search_type'),
                'collect_staff'    => $this->input->post('collect_staff'),
                'date_from'        => $this->input->post('date_from'),
                'date_to'          => $this->input->post('date_to'),
                'shift'            => $this->input->post('shift'),
                'priority'         => $this->input->post('priority'),
                'appointment_type' => $this->input->post('appointment_type'),
            );

            $json_array = array('status' => 'success', 'error' => '', 'param' => $param, 'message' => $this->lang->line('success_message'));
        }
        echo json_encode($json_array);
    }

    public function appointmentreport()
    {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'admin/appointment/appointmentreport');
        $doctorlist                    = $this->staff_model->getEmployeeByRoleID(3);
        $data['doctorlist']            = $doctorlist;
        $custom_fields                 = $this->customfield_model->get_custom_fields('appointment', '', '', 1);
        $data['fields']                = $custom_fields;
        $data['appoint_priority_list'] = $this->appoint_priority_model->appoint_priority_list();
        $data['appointment_type']      = $this->config->item('appointment_type');
        $data["searchlist"]            = $this->search_type;
        $this->load->view('layout/header');
        $this->load->view('admin/appointment/appointmentReport', $data);
        $this->load->view('layout/footer');
    }

    public function appointmentreports()
    {
        $search['search_type']   = $this->input->post('search_type');
        $search['collect_staff'] = $this->input->post('collect_staff');
        $search['date_from']     = $this->input->post('date_from');
        $search['date_to']       = $this->input->post('date_to');
        $shift                   = $this->input->post('shift');
        $priority                = $this->input->post('priority');
        $appointment_type        = $this->input->post('appointment_type');
        $start_date              = '';
        $end_date                = '';
        $fields                  = $this->customfield_model->get_custom_fields('appointment', '', '', 1);
        if ($search['search_type'] == 'period') {

            $start_date = $this->customlib->dateFormatToYYYYMMDD($search['date_from']);
            $end_date   = $this->customlib->dateFormatToYYYYMMDD($search['date_to']);

        } else {

            if (isset($search['search_type']) && $search['search_type'] != '') {
                $dates               = $this->customlib->get_betweendate($search['search_type']);
                $data['search_type'] = $search['search_type'];
            } else {
                $dates               = $this->customlib->get_betweendate('this_year');
                $data['search_type'] = '';
            }

            $start_date = $dates['from_date'];
            $end_date   = $dates['to_date'];
        }

        $reportdata  = $this->report_model->appointmentRecord($start_date, $end_date, $search['collect_staff'], $shift, $priority, $appointment_type);
        $reportdata  = json_decode($reportdata);
      
      
//       echo "<pre>";
//       print_r($reportdata);
//       exit;
        
        $dt_data     = array();
        $paid_amount = 0;
        $paid_doctor = 0;
        $currency_symbol = $this->customlib->getHospitalCurrencyFormat();
        if (!empty($reportdata->data)) {
            foreach ($reportdata->data as $key => $value) {
                $paid_amount += $value->paid_amount;
 //
                 $paid_doctor += $value->paid_doctor;
                 $label = "class='label label-success'";
             
                $row = array();
                $row[] = $value->id;
                $row[] = composePatientName($value->patient_name." ".$value->guardian_name, $value->patient_id);
                $row[] = $this->customlib->YYYYMMDDHisTodateFormat($value->date, $this->time_format);
                $row[] = $value->reason_consultation;
                $row[] = $value->cups;
                $row[] = $value->iss;
                $row[] = composeStaffNameByString($value->name, $value->surname, $value->employee_id);
                $row[] = $value->organisation_name;
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
                $row[]     = $value->paid_amount;
                $row[]     = $value->paid_doctor;
                $row[]     = "<small " . $label . " >" . $value->appointment_status . "</small>";
                $dt_data[] = $row;
            }
            $footer_row   = array();
            $footer_row[] = "";
            $footer_row[] = "";
            $footer_row[] = "";
            $footer_row[] = "";
            $footer_row[] = "";
            $footer_row[] = "";
            $footer_row[] = "";
            if (!empty($fields)) {
                foreach ($fields as $fields_key => $fields_value) {

                    $footer_row[] = "";
                }
            }
            $footer_row[] = "<b>" . $this->lang->line('total_amount') . "</b>" . ':';
            $footer_row[] = "<b>" .$currency_symbol. (number_format($paid_amount, 2, '.', '')) . "<br/>";
            $footer_row[] = "<b>" .$currency_symbol. (number_format($paid_doctor, 2, '.', '')) . "<br/>";
            $footer_row[] = "";
            $dt_data[]    = $footer_row;
        }

        $json_data = array(
            "draw"            => intval($reportdata->draw),
            "recordsTotal"    => intval($reportdata->recordsTotal),
            "recordsFiltered" => intval($reportdata->recordsFiltered),
            "data"            => $dt_data,
        );
        echo json_encode($json_data);
    }

    public function getDoctorFees()
    {
        $doctor_id      = $this->input->post("doctor_id");
        $shift_details  = $this->onlineappointment_model->getShiftDetails($doctor_id);
        $charge_details = $this->charge_model->getChargeDetailsById($shift_details['charge_id']);
        echo json_encode(
            array(
                "fees"      => isset($charge_details->standard_charge) ? amountFormat($charge_details->standard_charge + ($charge_details->standard_charge * $charge_details->percentage / 100)) : "",
                "charge_id" => $shift_details['charge_id'])
        );
    }

    /**
     * This function is used to validate document for upload
     **/
    public function handle_doc_upload($str, $var)
    {
        $image_validate = $this->config->item('file_validate');

        if (isset($_FILES[$var]) && !empty($_FILES[$var]['name'])) {

            $file_type = $_FILES[$var]['type'];
            $file_size = $_FILES[$var]["size"];
            $file_name = $_FILES[$var]["name"];

            $allowed_extension = $image_validate["allowed_extension"];
            $allowed_mime_type = $image_validate["allowed_mime_type"];
            $ext               = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            if ($files = filesize($_FILES[$var]['tmp_name'])) {
                if (!in_array($file_type, $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_doc_upload', $this->lang->line('file_type_extension_error_uploading_document'));
                    return false;
                }

                if (!in_array($ext, $allowed_extension) || !in_array($file_type, $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_doc_upload', $this->lang->line('extension_error_while_uploading_document'));
                    return false;
                }
                if ($file_size > 2097152) {
                    $this->form_validation->set_message('handle_doc_upload', $this->lang->line('file_size_shoud_be_less_than') . "2MB");
                    return false;
                }
            } else {
                $this->form_validation->set_message('handle_doc_upload', $this->lang->line('error_while_uploading_document'));
                return false;
            }

            return true;
        }
        return true;
    }

    public function reschedule()
    {

//         $userdata           = $this->customlib->getUserData();
//         $doctor_restriction = $this->session->userdata['hospitaladmin']['doctor_restriction'];
      
//         echo "<pre>";
//         print_r($this->input->post());
//       exit;

        date_default_timezone_set("America/Bogota");
        $doctor_restriction = $this->session->userdata['hospitaladmin']['doctor_restriction'];
        $userdata = $this->customlib->getUserData();
      
      
        $appointment_date = $this->input->post('appointment_date');
        $staff_id     = $this->customlib->getLoggedInUserID();
        $date_appoint = (new DateTime($appointment_date))->format('Y-m-d');
        $today_date_time = (new DateTime())->format('Y-m-d H:i:s');
        $id_patient = $this->input->post('patient_id');
        $appointment_id = $this->input->post('appointment_id');
        $slots          = $this->customlib->getSlotByDoctorShift($this->input->post('rdoctor'), $this->input->post('rslot'));
        $edit_slot = $this->input->post("edit_slot");
        $edit_appointment_status = $this->input->post('edit_appointment_status');
        $person_cancel = $this->input->post('person_cancel');
        $person_confirm = $this->input->post('person_confirm');
        $charge_list_ajax_edit = $this->input->post('charge_list_ajax_edit');
        $responsible =  $this->input->post('edit_responsible_eps');
        $appointments   = $this->onlineappointment_model->getAppointments($this->input->post('rdoctor'), $this->input->post('rslot'), $date_appoint);
        $array_dates    = [];
        $custom_errors   = [];

       if($id_patient == "" && $this->input->post('edit_patient_id') != ""){
          $id_patient = $this->input->post('edit_patient_id');
       }
  
        $custom_fields = $this->customfield_model->getByBelong('appointment');
        if (!empty($custom_fields)) {
            foreach ($custom_fields as $custom_fields_key => $custom_fields_value) {
                if ($custom_fields_value['validation']) {
                    $custom_fields_id   = $custom_fields_value['id'];
                    $custom_fields_name = $custom_fields_value['name'];

                    $this->form_validation->set_rules("custom_fields[appointment][" . $custom_fields_id . "]", $custom_fields_name, 'trim|required');

                }
            }
        }
      

        if(!empty($edit_slot)){
          
                foreach($edit_slot as $key => $value){
                      $slot = $slots[$value];
                      $array_dates[] = date("H:i:s", strtotime($slot));
        //                     array_push($array_dates, date("H:i:s", strtotime($slots[$value])));
                }

                $horaMayor = reset($array_dates); // Inicializamos con la primera hora en el array
                $horaMenor = reset($array_dates); // Inicializamos con la primera hora en el array

                foreach ($array_dates as $hora) {
                    if (strtotime($hora) > strtotime($horaMayor)) {
                        $horaMayor = $hora;
                    }

                    if (strtotime($hora) < strtotime($horaMenor)) {
                        $horaMenor = $hora;
                    }
                }
          
                if($horaMenor == $horaMayor){
                      $custom_errors['time_error'] = 'Debe seleccionar una hora de incio y de finalización';
                }
         }
           
          
        foreach ($appointments as $appointment_slot) {
              if($horaMenor <= $appointment_slot->time && $horaMayor >= $appointment_slot->time_finish && $appointment_id != $appointment_slot->id){
                    $custom_errors['time_overlay'] = 'No se puede asignar horarios superpuestos con citas existentes al reprogramar';
              }
        }
      
//         $is_approved =  $this->db->query("SELECT appointment.appointment_status
//                                              FROM appointment
//                                              WHERE appointment.id = ?", array($appointment_id))->row();

//         echo "<pre>";
//         print_r($is_approved->appointment_status);
//         exit;
      

        $this->form_validation->set_rules([
           [
                'field' => 'edit_patient_id',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'El paciente es requerido.',
                ],
            ],
            [
                'field' => 'rglobal_shift',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'El responsable de la consulta es requerido.',
                ],
            ],
            [
                'field' => 'edit_responsible_eps',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'El responsable de la consulta es requerido.',
                ],
            ],
            [
                'field' => 'rdoctor',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'El doctor es requerido.',
                ],
            ],
            [
                'field' => 'rslot',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'El tiempo de consulta es requerido.',
                ],
            ],
            [
                'field' => 'appointment_date',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'La fecha de la cita es requerida.',
                ],
            ],
            [
                'field' => 'edit_appointment_status',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'El estado de la consulta es requerido.',
                ],
            ],
            [
                'field' => 'charge_list_ajax_edit',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'El tipo de atención es requerido.',
                ],
            ],
//             [
//                 'field' => 'edit_order_code',
//                 'rules' => 'trim|required|xss_clean|min_length[5]|max_length[60]',
//                 'errors' => [
//                     'required' => 'El codigo de la orden es requerido.',
//                     'min_length' => 'El código de orden debe tener al menos 5 caracteres.',
//                     'max_length' => 'El código de orden no debe superar los 60 caracteres.'
//                 ],
//             ],
            [
                'field' => 'person_cancel',
                'rules' => $edit_appointment_status === "Cancelada" ? 'trim|required|xss_clean' : "",
                'errors' => [
                    'required' => 'La persona que cancela es requerida.',
                ],
            ],
            [
                'field' => 'id_role_cancel',
                'rules' => $edit_appointment_status === "Cancelada" ? 'trim|required|xss_clean' : "",
                'errors' => [
                    'required' => 'El rol que cancela es requerido.',
                ],
            ],
            [
                'field' => 'payment_type',
                'rules' => $edit_appointment_status === "Aprobada" ? 'trim|required|xss_clean' : "",
                'errors' => [
                    'required' => 'El tipo de pago es requerido.',
                ],
            ],
            [
                'field' => 'category_visit',
                'rules' => $edit_appointment_status === "Aprobada" ? 'trim|required|xss_clean' : "",
                'errors' => [
                    'required' => 'La categoria del paciente es requerida.',
                ],
            ],
//             [
//                 'field' => 'edit_slot',
//                 'rules' => 'trim|required|xss_clean',
//                 'errors' => [
//                     'required' => 'La duración de la consulta es requerida.',
//                 ],
//             ],
        ]);

        $today = (new DateTime())->format('Y-m-d');
        $appointment_date = (new DateTime($this->input->post('dates')))->format('Y-m-d');

        if ($appointment_date < $today) {
              $custom_errors['before_today'] = 'No puedes agendar una cita un dia anterior a hoy.';
        }

        if ($this->form_validation->run() == false || count($custom_errors) > 0) {

            $errors = $this->form_validation->error_array();
            // Junta los dos array
            $msg = array_merge($errors, $custom_errors);

            if (!empty($custom_fields)) {
                foreach ($custom_fields as $custom_fields_key => $custom_fields_value) {
                    if ($custom_fields_value['validation']) {
                        $custom_fields_id                                                    = $custom_fields_value['id'];
                        $custom_fields_name                                                  = $custom_fields_value['name'];
                        $error_msg2["custom_fields[appointment][" . $custom_fields_id . "]"] = form_error("custom_fields[appointment][" . $custom_fields_id . "]");
                    }
                }
            }
            if (!empty($error_msg2)) {
                $error_msg = array_merge($msg, $error_msg2);
            } else {
                $error_msg = $msg;
            }
          
            $array = array('status' => 'fail', 'error' => $error_msg, 'message' => '');
      
        } else {


           $get_charge = $this->db->query("SELECT charges.*, charge_categories.name as category_name, charge_type_master.charge_type, charge_type_master.id as id_type_master
                                            FROM charges
                                            INNER JOIN charge_categories ON charge_categories.id = charges.charge_category_id
                                            INNER JOIN charge_type_master ON charge_type_master.id = charge_categories.charge_type_id
                                            WHERE charges.id = ?", array($charge_list_ajax_edit))->row();

           $appointment = [
                'id'              => $appointment_id,
                'date'            => $date_appoint,
                'patient_id'      => $id_patient,
                'priority'        => $this->input->post('priority'),
                'global_shift_id' => $this->input->post('rglobal_shift'),
                'shift_id'        => $this->input->post('rslot'),
                'live_consult'    => $this->input->post('live_consult'),
                'created_at'      => $today_date_time,
                'appointment_status'    => $this->input->post('edit_appointment_status'),
                'message'         => $this->input->post('message'),
                'reason_consultation' => $get_charge->name,
                'id_organizations' => $this->input->post('edit_responsible_eps'),
                'doctor'=> $this->input->post('rdoctor'),
                'cat_cuota_moderadora'=> $this->input->post('category_visit'),
                'type_visit' => $get_charge->charge_type,
                'charge_id' => $get_charge->id,
                'reason_consultation' => $get_charge->name,
                'id_role_cancel' => $this->input->post('id_role_cancel'),
                'medical_message' => $this->input->post('edit_medical_message'),
                'order_code' => $this->input->post('edit_order_code'),
                'receipt_code' => $this->input->post('receipt_code')
           ];      

            if($edit_appointment_status == 'Aprobada'){
                $appointment['payment_type'] = $this->input->post('payment_type');
            }

          
             $theatre_exist = $this->db->query("SELECT operation_theatre.*
                                                FROM operation_theatre
                                                WHERE appointment_id = ?", array($appointment_id))->row();

             $appointment_team = [];

              if(!empty($this->input->post('edit_operation_anesthetist'))){
                    $appointment_team['ass_consultant_1'] = $this->input->post('edit_nursing_assistant');
              }

              if(!empty($this->input->post('edit_operation_anesthetist'))){
                    $appointment_team['anesthetist'] = $this->input->post('edit_operation_anesthetist');
              }

          
             if(!empty($theatre_exist)){
                  $this->db->where('appointment_id', $appointment_id);
                  $this->db->update('operation_theatre', $appointment_team);
             } else if(!empty($appointment_team)){
                  $appointment_team['appointment_id'] = $appointment_id;
                  $appointment_team['generated_by'] = $userdata['id'];
                  $appointment_team['date'] = date("Y-m-d");
                  $this->db->insert('operation_theatre', $appointment_team);
             }

          
            if($get_charge->id_type_master == 3){
                $appointment['is_operation'] = "yes";
            } else if($get_charge->id_type_master == 2){
                $appointment['is_opd'] = "yes";
            } else if($get_charge->id_type_master == 8){
                $appointment['is_procedure'] = "yes";
            } 

          
          if(!empty($person_cancel)){
                $appointment['cancel_person'] = $person_cancel;
                $appointment['date_cancel'] = $today_date_time;
          }
          if(!empty($person_confirm)){
                  $appointment['confirm_person'] = $person_cancel;
                  $appointment['date_confirm'] = $today_date_time;
            }
          
           if(!empty($edit_slot)){  
                $appointment['time'] = $horaMenor;
                $appointment['time_finish'] = $horaMayor;
           }

            $this->appointment_model->update($appointment); 
          
//              echo '<pre>';
//              print_r('error');
//              exit;

            $appointment_details = $this->appointment_model->getDetails($appointment_id);
            $transaction_data    = $this->transaction_model->getTransactionByAppointmentId($appointment_id);
            $appointment_payment = $this->appointment_model->getPaymentByAppointmentId($appointment_id);       

            if($appointment_details['visit_details_id'] == '' && $edit_appointment_status == 'Aprobada'){


                  $category_visit = $this->input->post('category_visit');
              
                  if($category_visit=='A'){
                      $charges = $this->charge_model->getChargeByChargeId(2542);
                      $charge_id =  2542;
                  }else if($category_visit=='B'){
                      $charges = $this->charge_model->getChargeByChargeId(2543);
                      $charge_id =  2543;
                  }else{
                      $charges = $this->charge_model->getChargeByChargeId(2544);
                      $charge_id =  2544;
                  }

                  if(!empty($this->input->post('copayment_value'))){
                      $apply_charge_mod = $this->input->post('copayment_value');
                  } else {
                      if($this->input->post('payment_type') === 'exempt_from_payment'){
                          $apply_charge_mod = 0;
                      } else {
                          $apply_charge_mod = $charges['standard_charge'] + ($charges['standard_charge'] * ($charges['percentage'] / 100));
                      }
                  }

                  $apply_charge = $this->charge_model->getChargeByChargeId($appointment_details['charge_id']);
//                     $apply_charge = $apply_charge['standard_charge'];

                  $opd_details = array(
                      'patient_id'   => $appointment_details['patient_id'],
                      'generated_by' => $this->customlib->getStaffID(),
                  );

                  $consult      = $this->input->post('live_consult');
                  $visit_details = array(
                      'appointment_date'  => date("Y-m-d H:i:s"),
                      'opd_details_id'    => 0,
                      'cons_doctor'       => $appointment_details['doctor'],
                      'generated_by'      => $this->customlib->getLoggedInUserID(),
                      'patient_charge_id' => null,
                      'transaction_id'    => $transaction_data->id,
                      'can_delete'        => 'no',
                      'live_consult'      => $consult,
                  );

                  $staff_data = $this->staff_model->getStaffByID($appointment_details['doctor']);
                  $staff_name = composeStaffName($staff_data);
                  $doctor_fees   =    $apply_charge_mod;
                  $charge     = array(
                      'opd_id'          => 0,
                      'date'            => date('Y-m-d H:i:s'),
                      'charge_id'       => $apply_charge['id'],
                      'qty'             => 1,
                      'apply_charge'    => $apply_charge['standard_charge'],
                      'tpa_charge'      => $apply_charge['standard_charge'],     
                      'standard_charge' => $apply_charge['standard_charge'],
                      'amount'          => $apply_charge['standard_charge'],
                      'created_at'      => date('Y-m-d H:i:s'),
                      'note'            => null,
                      'tax'             => $charges['percentage'],
                  );

                  $payment_data = array(
                      'appointment_id' => $appointment_id,
                      'paid_amount'    => $apply_charge_mod,
                      'charge_id'      => $charge_id,
                      'payment_type'   => 'Offline',
                      'date'           => date("Y-m-d H:i:s"),
                  );

                  if(!empty($this->input->post('payment_mode'))){
                        $payment_data['payment_mode'] = $this->input->post('payment_mode');
                  }

                  $payment_section   = $this->config->item('payment_section');
                  $transaction_array = array(
                      'amount'         => $apply_charge_mod,
                      'patient_id'     => $patient_id,
                      'section'        => $payment_section['appointment'],
                      'type'           => 'payment',
                      'appointment_id' => $appointment_id,
                      'payment_mode'   => $this->input->post("payment_mode"),
                      'payment_date'   => date('Y-m-d H:i:s'),
                      'received_by'    => $staff_id,
                  );

                  if(!empty($this->input->post('payment_mode'))){
                       $transaction_array['payment_mode'] = $this->input->post('payment_mode');
                  }

                  $this->appointment_model->saveAppointmentPayment($payment_data, $transaction_array);
//                       echo "<pre>";
//                     print_r($apply_charge['id']);
//                     exit; 
                  $opd_visit_id = $this->appointment_model->moveToOpd($opd_details, $visit_details, $charge, $appointment_id, $doctor_fees);            
                  $this->appointment_model->updateappointmentpayment($appointment_id, $apply_charge_mod, $doctor_fees );

                    if($get_charge->id_type_master == 3){
                        $this->db->where('appointment_id', $appointment_id);
                        $this->db->update('operation_theatre', [
                            'opd_details_id' => $opd_visit_id
                        ]);
                    }

                    $payment_section = $this->config->item('payment_section');
                    $data_pay            = array(
                        'case_reference_id' => $appointment_details['case_reference_id'],
                        'patient_id'        => $id_patient,
                        'section'           => $payment_section['opd'],
                        'amount'            => $apply_charge,
                        'type'              => 'payment',
                        'opd_id'            => $opd_visit_id,
                        'payment_mode'      => 'Cash',
                        'note'              => 'pago_admision',
                        'payment_date'      => date('Y-m-d H:i:s'),
                        'received_by'       => $this->customlib->getLoggedInUserID(),
                    );

//                     if(){
                      
//                     }
 
        //           echo "<pre>";
        //           print_r($data);
        //           exit;
                    $cheque_date = $this->input->post("cheque_date");
                    $insert_id       = $this->transaction_model->add($data);
      //               $insert_id = $this->appointment_model->add($appointment);
      //              print_r($insert_id);


                  /* OPD Insert Code*/          

                    $visit_detail=$this->patient_model->getVisitDetailByid($opd_visit_id);
                    $setting_result   = $this->setting_model->getzoomsetting();
                    $opdduration      = $setting_result->opd_duration;
                    if ($consult == 'yes') {
                        $api_type = 'global';
                        $params   = array(
                            'zoom_api_key'    => "",
                            'zoom_api_secret' => "",
                        );

                        $title = 'Online consult for ' . $this->customlib->getSessionPrefixByType('opd_no') . $visit_detail->opd_details_id . " Checkup ID " . $visit_detail->id;
                        $this->load->library('zoom_api', $params);
                        $insert_array = array(
                            'staff_id'         => $appointment_details['doctor'],
                            'visit_details_id' => $visit_detail->id,
                            'title'            => $title,
                            'date'             => $date_appoint,
                            'duration'         => 60,
                            'created_id'       => $this->customlib->getStaffID(),
                            'password'         => random_string(),
                            'api_type'         => $api_type,
                            'host_video'       => 1,
                            'client_video'     => 1,
                            'purpose'          => 'consult',
                            'timezone'         => $this->customlib->getTimeZone(),
                        );

                        $response = $this->zoom_api->createAMeeting($insert_array);

                        if(!empty($response)) {
                            if (isset($response->id)) {
                                $insert_array['return_response'] = json_encode($response);
                                $this->conference_model->add($insert_array);
                            }
                        }
                    }
            }           
            
            $custom_field_post = $this->input->post("custom_fields[appointment]");
            if (!empty($custom_fields)) {
                foreach ($custom_field_post as $key => $value) {
                    $check_field_type = $this->input->post("custom_fields[appointment][" . $key . "]");
                    $field_value      = is_array($check_field_type) ? implode(",", $check_field_type) : $check_field_type;
                    $array_custom     = array(
                        'belong_table_id' => $appointment_id,
                        'custom_field_id' => $key,
                        'field_value'     => $field_value,
                    );
                    $custom_value_array[] = $array_custom;
                }
                $this->customfield_model->updateRecord($custom_value_array, $appointment_id, 'appointment');
            }         
         
          $sender_details = array('patient_id' => $appointment_details["patient_id"], 'appointment_id' => $appointment_id);
          
          
        if($this->input->post('appointment_status') == 'Aprobada'){
            $this->mailsmsconf->mailsms('appointment_approved', $sender_details);
            $this->system_notification->send_system_notification('notification_appointment_created', $event_data);           
            $this->system_notification->send_system_notification('appointment_approved', $event_data);
        }
        
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        }
      

        echo json_encode($array);
    }
    
    public function resupdate($id){
        $data['id'] = $id;
        $data['message'] = "enttamaon";
      
        echo json_encode($data);
    }
  
    public function appointment_calendar($doctor_id=null){
      $calendar_date_start = $this->input->get('start');
      $calendar_date_end = $this->input->get('end');

      $format_date_start = (new DateTime($calendar_date_start))->format('Y-m-d');
      $format_date_end = (new DateTime($calendar_date_end))->format('Y-m-d');
          
      $userdata           = $this->customlib->getUserData();
      $doctor_restriction = $this->session->userdata['hospitaladmin']['doctor_restriction'];
      if($doctor_id != null){
          $this->db->select('doctor_shift.start_date, doctor_shift.end_date, doctor_shift.type_agenda');
          $this->db->where("doctor_shift.staff_id",$doctor_id);
          $this->db->from('doctor_shift');
          $query_vigencia =  $this->db->get()->result();
      }
      
//       echo "<pre>";
//       print_r($doctor_id);
//       exit;

      $this->db->select('appointment.id as id_appointment,appointment.visit_details_id as visit, appointment.date, time, time_finish, reason_consultation, patient_id, doctor, appointment_status, patient_id, charges.name as charge_name, appointment.type_visit,
                         staff.name,staff.id, staff.surname, patients.patient_name, patients.guardian_name,patients.identification_number');
      
      if($doctor_id != null){
          $this->db->where("appointment.doctor",$doctor_id);
          $this->db->where('DATE(appointment.date) BETWEEN "' .$query_vigencia[0]->start_date. '" AND "' .$query_vigencia[0]->end_date.'"');
      }
      
      $this->db->where('appointment.appointment_status !=', 'Cancelada');
      $this->db->where('DATE(appointment.date) BETWEEN "' .$format_date_start. '" AND "' .$format_date_end.'"');
      
      if ($doctor_restriction == 'enabled') {
            if ($userdata["role_id"] == 3) {
                $this->db->where('appointment.doctor', $userdata['id']);
            }
      }
 
      $this->db->join('staff','staff.id = appointment.doctor',"inner");
      $this->db->join('patients','patients.id = appointment.patient_id',"inner");
      $this->db->join('charges', 'charges.id = appointment.charge_id');
//       $this->db->join('charge_categories', 'charge_categories.id = charges.charge_category_id');
//       $this->db->join('charge_type_master', 'charge_type_master.id = charge_categories.charge_type_id');



      $this->db->from('appointment');
      $query =  $this->db->get()->result();                  
      $events = array();

//       echo "<pre>";
//       print_r($format_date_start.' '.$format_date_end);
//       exit;

      foreach ($query as $row) {
        
            // Formatea la fecha y hora en formato ISO 8601
            $start = $row->date . 'T' . $row->time;
            $end = $row->date . 'T' . $row->time_finish;
            $visit_row= $row->visit;
            $profile_url = site_url('admin/patient/profile')."/".$row->patient_id;
        
            if ($row->appointment_status == "Aprobada" || $row->appointment_status == "Firmada" ) {

                  $query_pay['payment'] = $this->db->query("SELECT appointment_payment.*
                                FROM appointment_payment
                                where appointment_id = ".$row->id_appointment." ;")->result();

                  $query_pay['patient'] = $this->db->query("SELECT patients.*
                                              FROM patients
                                              where id = ".$row->patient_id." ;")->result();

                  $query_pay['patient_custom'] = get_custom_table_values($row->patient_id, 'patient');

                  $query_pay['appointment'] = $this->db->query("SELECT appointment.*
                                              FROM appointment
                                              where id = ".$row->id_appointment." ;")->result();

                  $bill_appointment = json_encode($query_pay);


          
                if(isset($row->visit)){

                   $query_visit = $this->db->query("SELECT opd_details_id
                                                    FROM visit_details
                                                    where id = ".$row->visit." ;")->row();

                   $visit = $query_visit->opd_details_id;
                }
              
//                 echo "<pre>";
//                 print_r($bill_appointment);
//                 exit;     
              
          }
                      
          if ($row->appointment_status == "Aprobada") {
               $options_html = "<a href='#' data-toggle='tooltip' style='color:#fff !important;' title='Actualizar' class='btn btn-default btn-xs' data-target='#rescheduleModal' onclick='viewreschedule($row->id_appointment)'> <i class='fa fa-calendar'></i></a>
                                <a href='#' class='btn btn-default btn-xs' data-toggle='tooltip' style='color:#fff !important; z-index: 1000;' onclick='print_visit_bill($visit)' data-original-title='Imprimir'><i class='fa fa-print'></i></a>
                                <a href='#' data-toggle='tooltip' style='color:#fff !important;' class='btn btn-default btn-xs' data-target='#viewModal' title='Detalle'  onclick='viewDetail($row->id_appointment)'><i class='fa fa-reorder'></i></a>
                                <span><a href='#' class='btn btn-default btn-xs addpayment' style=color:#fff !important; data-toggle='tooltip' data-original-title='Pagar'><i class='fa fa-dollar' aria-hidden='true'></i></a></span>
                                <a onclick='view_appointment($row->id_appointment)' data-toggle='tooltip' style=color:#fff !important; title='Cita' class='btn btn-default btn-xs' data-target='#viewModal'><i class='fas fa-file-medical'></i></a>";

               $status_color = "cita_aprobada";
          } else if ($row->appointment_status == "Bloqueada") {
               $options_html = "<a href='#' data-toggle='tooltip' style='color:#fff !important;' title='Actualizar' class='btn btn-default btn-xs' data-target='#rescheduleModal' onclick='viewreschedule($row->id_appointment)'> <i class='fa fa-calendar'></i></a>
                                <a href='#' data-toggle='tooltip' style='color:#fff !important;' class='btn btn-default btn-xs' data-target='#viewModal' title='Detalle'  onclick='viewDetail($row->id_appointment)'><i class='fa fa-reorder'></i></a>
                                <a onclick='view_appointment($row->id_appointment)' data-toggle='tooltip' style=color:#fff !important; title='Cita' class='btn btn-default btn-xs' data-target='#viewModal'><i class='fas fa-file-medical'></i></a>";

               $status_color = "cita_bloqueada";
          }else if ($row->appointment_status == "Agendada") {
               $options_html = "<a href='#' data-toggle='tooltip' style='color:#fff !important;' title='Actualizar' class='btn btn-default btn-xs' data-target='#rescheduleModal' onclick='viewreschedule($row->id_appointment)'> <i class='fa fa-calendar'></i></a>
                                <a href='#' data-toggle='tooltip' style='color:#fff !important;' class='btn btn-default btn-xs' data-target='#viewModal' title='Detalle'  onclick='viewDetail($row->id_appointment)'><i class='fa fa-reorder'></i></a>
                                <a onclick='view_appointment($row->id_appointment)' data-toggle='tooltip' style=color:#fff !important; title='Cita' class='btn btn-default btn-xs' data-target='#viewModal'><i class='fas fa-file-medical'></i></a>";

               $status_color = "cita_agendada";
          } else if ($row->appointment_status == "Cancelada") {
               $options_html = " <span><a href='#' class='btn btn-default btn-xs addpayment' style=color:#fff !important; data-toggle='tooltip' data-original-title='Pagar'><i class='fa fa-dollar' aria-hidden='true'></i></a></span>
                                 <a onclick='view_appointment($row->id_appointment)' data-toggle='tooltip' style=color:#fff !important; title='Cita' class='btn btn-default btn-xs' data-target='#viewModal'><i class='fas fa-file-medical'></i></a>";

               $status_color = "cita_cancelada";
          }else if($row->appointment_status == "Confirmada"){
            
               $options_html = "<a href='#' data-toggle='tooltip' style='color:#fff !important;' title='Actualizar' class='btn btn-default btn-xs' data-target='#rescheduleModal' onclick='viewreschedule($row->id_appointment)'> <i class='fa fa-calendar'></i></a>
                               <a href='#' class='btn btn-default btn-xs' data-toggle='tooltip' style='color:#fff !important; z-index: 1000;' onclick='printAppointment($row->id_appointment)' data-original-title='Imprimir'><i class='fa fa-print'></i></a>
                               <a href='#' data-toggle='tooltip' style='color:#fff !important;' class='btn btn-default btn-xs' data-target='#viewModal' title='Detalle'  onclick='viewDetail($row->id_appointment)'><i class='fa fa-reorder'></i></a>
                               <span><a href='#' class='btn btn-default btn-xs addpayment' style=color:#fff !important; data-toggle='tooltip' data-original-title='Pagar'><i class='fa fa-dollar' aria-hidden='true'></i></a></span>
                               <a onclick='view_appointment($row->id_appointment)' data-toggle='tooltip' style=color:#fff !important; title='Cita' class='btn btn-default btn-xs' data-target='#viewModal'><i class='fas fa-file-medical'></i></a>";

               $status_color = "cita_confirmada";
          }else if($row->appointment_status == "Firmada"){
               $options_html = "<a href='#' class='btn btn-default btn-xs' data-toggle='tooltip' style='color:#fff !important; z-index: 1000;' onclick='print_visit_bill($visit)' data-original-title='Imprimir'><i class='fa fa-print'></i></a>
                                <a href='#' data-toggle='tooltip' style='color:#fff !important;' class='btn btn-default btn-xs' data-target='#viewModal' title='Detalle'  onclick='viewDetail($row->id_appointment)'><i class='fa fa-reorder'></i></a>
                                <span><a href='#' class='btn btn-default btn-xs addpayment' style=color:#fff !important; data-toggle='tooltip' data-original-title='Pagar'><i class='fa fa-dollar' aria-hidden='true'></i></a></span>
                                <span><a href='#' onclick='billopd_clini($bill_appointment)'  class='btn btn-default btn-xs' style=color:#fff !important; data-toggle='tooltip' data-original-title='Factura'><i class='fa fa-money-bill' aria-hidden='true'></i></a></span>
                                <a onclick='view_appointment($row->id_appointment)' data-toggle='tooltip' style=color:#fff !important; title='Cita' class='btn btn-default btn-xs' data-target='#viewModal'><i class='fas fa-file-medical'></i></a>";

               $status_color = "cita_firmada";
          }
        
          $event = array(
              'id' => $row->id,
              'title' => $row->reason_consultation,
              'start' => $start,
              'end' => $end,
              'classNames' => ['custom-calendar', $status_color],
              'data' => $row,
              'options_html' => $options_html,
              'doctor_days' => $doctor_days,
              'status_color' => $status_color,
               
//               allDay: false,
//               editable: true,
//               backgroundColor: 'blue',
//               borderColor: 'black',
//               textColor: 'white',
//               extendedProps: {
//                 description: 'Descripción del evento'
//               },
//               rendering: 'background'
//               'display' => 'background',
//               'color' => '#ff9f89',
          );
        

//           if (in_array($row->date, $holidays)) {
//               $event['display'] = 'background';
//               $event['className'][] = 'holiday-event';
//               $event['allDay'] = true;
//               $event['selectable'] = false;
//           }

          $events[] = $event;
      }
      
      
      echo json_encode($events);
      
    }
  
  
   public function closed_days(){
     
      $json_data = json_decode($this->input->raw_input_stream, true);
      $id_doctor = $json_data['id_doctor'];
     
      $result['update_block_days'] = $this->db->query("SELECT lock_calendar.start_date,lock_calendar.end_date FROM lock_calendar WHERE id_doctor = ".$id_doctor." AND status = 1 ;")->result();

      $this->db->select('doctor_shift.start_date, doctor_shift.end_date');
      $this->db->where("doctor_shift.staff_id",$id_doctor);
      $this->db->from('doctor_shift');
      $result['valid_days'] =  $this->db->get()->row(); 

      $query = $this->db->select('staff.id, staff.name, staff.surname, staff.employee_id, staff_designation.designation as designation, staff_roles.role_id, department.department_name as department, roles.name as user_type, specialist.specialist_name as specialist_doc, ')
      ->from('staff')
      ->join("staff_designation", "staff_designation.id = staff.staff_designation_id", "left")
      ->join("department", "department.id = staff.department_id", "left")
      ->join("staff_roles", "staff_roles.staff_id = staff.id", "left")
      ->join("roles", "staff_roles.role_id = roles.id", "left")
      ->join('specialist', "specialist.id = staff.specialist", "LEFT")
      ->where("staff_roles.role_id", 3)
      ->where("staff.is_active", "1")
      ->where('staff.id', $id_doctor)
      ->order_by("staff.name", 'asc')
      ->get();

      $result['doctor'] = $query->row();
   
      $this_day = $json_data['this_date'];

      $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
      $day = isset($daysOfWeek[$this_day]) ? $daysOfWeek[$this_day] : '';

      $this->db->select('doc.DAY, doc.start_time, doc.end_time, doc.start_date, doc.end_date, doc.status_blocked, doc.type_agenda');
      $this->db->from('doctor_shift as doc');
      $this->db->where('doc.staff_id', $id_doctor);
      $this->db->where('doc.DAY', $day);
      $result['doctor_slots'] = $this->db->get()->result();
     
      echo json_encode($result);
      
   }
  
   public function vigencia($id){
          $this->db->select('doctor_shift.start_date, doctor_shift.end_date');
          $this->db->where("doctor_shift.staff_id",$id);
          $this->db->from('doctor_shift');
          $query_vigencia =  $this->db->get()->result();
    
      echo json_encode($query_vigencia);
   }
  
   public function hidden_days(){
     
      $id_doctor = $this->input->post('id_doctor');

//       $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
      $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
      $doctor_days = [];
     
      $result['doctor_slots'] = $this->db->query("SELECT doc.DAY, doc.start_time, doc.end_time, doc.start_date, doc.end_date, doc.status_blocked FROM doctor_shift AS doc WHERE doc.staff_id = ".$id_doctor." ;")->result();
        

     
      $doctor_shift = $this->db->query("SELECT DISTINCT DAY FROM doctor_shift AS d WHERE d.staff_id = ".$id_doctor." ;")->result();
     
     
      foreach($doctor_shift as $key => $value){
          array_push($doctor_days, $value->DAY);
      }
     
      $result['doctor_days'] = array_diff($days, $doctor_days);
//                 echo "<pre>";
//                 print_r($result['doctor_days']);
//                 exit; 
     
      echo json_encode($result);

   }
  
  public function update_block_days($id){
    
    $result['update_block_days'] = $this->db->query("SELECT lock_calendar.start_date,lock_calendar.end_date FROM lock_calendar WHERE id_doctor = ".$id." AND status = 1 ;")->result();
          
//            echo "<pre>";
//                 print_r($result['update_block_days']);
//                 exit; 
//     $db_start_date = (new DateTime($result['update_block_days'][0]->start_date))->format('Y-m-d');
//     $db_end_date = (new DateTime($result['update_block_days'][0]->start_date))->format('Y-m-d');
    
    echo json_encode($result);
    
  }

  
   public function update_event(){
      
        $post = $this->input->post();

        $data = [
          'date' => $post['start_date'],
          'time' => $post['start_time'],
          'time_finish' => $post['end_time'],
        ];
      
        $this->db->set($data);
        $this->db->where('id', $post['id_appointment']);
        $this->db->update('appointment');
      
        $result = array('state' => 'success', 'msg' => 'Se actualizo la fecha con exito.');
      
        echo "<pre>";
        print_r($result);
        exit;
      
        return json_encode($result);
        
    }
  
    function getpatient_id(){
      
        $id = $this->input->get("appointment_id");
        $this->db->select('patient_id');
        $this->db->from('appointment');
        $this->db->where('id', $id);
        $query2 = $this->db->get();
        $custom = $query2->result_object();
    //     echo "<pre>";
    //         print_r($custom['0']->patient_id);
    //         exit;
        $data['resp'] = "si existe";
        if($custom['0']->patient_id == ""){
          $this->db->where('id', $id);
          $this->db->delete('appointment');
          $data['resp'] = "elinminado";
        }
        echo json_encode($data);

    }
  
  function vigencia_check(){
    
      $id_doctor = $this->input->post('id_doctor');

      $data['vigencia'] = $this->db->query("SELECT doc.start_date, doc.end_date, MAX(doc.status_blocked) AS status_blocked
                                      FROM doctor_shift AS doc
                                      WHERE doc.staff_id = ".$id_doctor."
                                      GROUP BY doc.start_date, doc.end_date;")->result();
      
     
  }
  
  function agendas_clinicas(){
    $date_agenda = $this->input->post('date_agenda');
    $date_dia = $this->input->post('date_dia');
    // Convert the string to a DateTime object
//     $date = new DateTime($date_agenda);
    $timestamp = strtotime($date_agenda);
    // Get the day name
    $dayName = date('l', $timestamp);
    
    $this->db->select('appointment.id as id_appointment,appointment.visit_details_id as visit,date, time, time_finish, reason_consultation,  doctor, 
                                 appointment_status, appointment.patient_id,appointment.case_reference_id,opd_details.id,opd_details.case_reference_id,
                                  staff.name,staff.id, staff.surname,doctor_shift.start_time,doctor_shift.end_time,patients.*');
    $this->db->join('doctor_shift','doctor_shift.staff_id = appointment.doctor',"inner");
    $this->db->join('staff','staff.id = appointment.doctor',"inner");
    $this->db->join('patients','patients.id = appointment.patient_id',"inner");
    $this->db->join('opd_details','opd_details.case_reference_id = appointment.case_reference_id',"left");
    $this->db->where('appointment.date' , $date_agenda);
    $this->db->where('doctor_shift.day' , $dayName);
    $this->db->from('appointment');
    $query['appointments'] =  $this->db->get()->result();
    $query['doctor_slots'] = $this->db->query("
    SELECT doc.start_time, doc.id, doc.end_time, 
           doc.staff_id, doc.start_date, doc.type_agenda, 
           doc.end_date, doc.status_blocked, staff.*
              FROM doctor_shift AS doc
              LEFT JOIN staff ON staff.id = doc.staff_id
              WHERE doc.day = '".$dayName."' and staff.is_active = 1
              GROUP BY doc.staff_id, doc.id;")->result();
//     echo "<pre>";
//     print_r($query['doctor_slots'] );
//     exit;
    

//     $query['patient_custom'] = get_custom_table_values($value->patient_id, 'patient');
    
    echo json_encode($query);
    
    
  }
  
  
   function agendas_clinicas_quirofano(){
    $date_agenda = $this->input->post('date_agenda');
    $date_dia = $this->input->post('date_dia');
    // Convert the string to a DateTime object
//     $date = new DateTime($date_agenda);
    $timestamp = strtotime($date_agenda);
    // Get the day name
    $dayName = date('l', $timestamp);
    
    $this->db->select('appointment.id as id_appointment,appointment.visit_details_id as visit,date, time, time_finish, reason_consultation,  doctor, 
                                 appointment_status, appointment.patient_id,appointment.case_reference_id,opd_details.id,opd_details.case_reference_id,
                                  staff.name,staff.specialist,staff.id, staff.surname,doctor_shift.start_time,doctor_shift.end_time,patients.*');
    $this->db->join('doctor_shift','doctor_shift.staff_id = appointment.doctor',"inner");
    $this->db->join('staff','staff.id = appointment.doctor',"inner");
    $this->db->join('patients','patients.id = appointment.patient_id',"inner");
    $this->db->join('opd_details','opd_details.case_reference_id = appointment.case_reference_id',"left");
    $this->db->where('appointment.date' , $date_agenda);
    $this->db->where('doctor_shift.day' , $dayName);
    $this->db->where('staff.specialist' , 15);
    $this->db->from('appointment');
    $query['appointments'] =  $this->db->get()->result();
    $query['doctor_slots'] = $this->db->query("
    SELECT doc.start_time, doc.id, doc.end_time, 
           doc.staff_id, doc.start_date, doc.type_agenda, 
           doc.end_date, doc.status_blocked, staff.*
              FROM doctor_shift AS doc
              LEFT JOIN staff ON staff.id = doc.staff_id
              WHERE doc.day = '".$dayName."' and staff.is_active = 1 and staff.specialist = 15
              GROUP BY doc.staff_id, doc.id;")->result();
//     echo "<pre>";
//     print_r($query);
//     exit;
    

//     $query['patient_custom'] = get_custom_table_values($value->patient_id, 'patient');
    
    echo json_encode($query);
    
    
  }

  function get_doctor(){
    
      $json_data = json_decode($this->input->raw_input_stream, true);
      $id_doctor = $json_data['id_doctor'];

//       $query = $this->db->query("SELECT staff.* FROM staff WHERE staff.id = ?", array($id_doctor));
//       $result = $query->row();

      $query = $this->db->select('staff.id, staff.name, staff.surname, staff.employee_id, staff_designation.designation as designation, staff_roles.role_id, department.department_name as department, roles.name as user_type, specialist.specialist_name as specialist_doc, ')
      ->from('staff')
      ->join("staff_designation", "staff_designation.id = staff.staff_designation_id", "left")
      ->join("department", "department.id = staff.department_id", "left")
      ->join("staff_roles", "staff_roles.staff_id = staff.id", "left")
      ->join("roles", "staff_roles.role_id = roles.id", "left")
      ->join('specialist', "specialist.id = staff.specialist", "LEFT")
      ->where("staff_roles.role_id", 3)
      ->where("staff.is_active", "1")
      ->where('staff.id', $id_doctor)
      ->order_by("staff.name", 'asc')
      ->get();

      $result['doctor'] = $query->row();
   
      $this_day = $json_data['this_date'];

      $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
      $day = isset($daysOfWeek[$this_day]) ? $daysOfWeek[$this_day] : '';

      $this->db->select('doc.DAY, doc.start_time, doc.end_time, doc.start_date, doc.end_date, doc.status_blocked, doc.type_agenda');
      $this->db->from('doctor_shift as doc');
      $this->db->where('doc.staff_id', $id_doctor);
      $this->db->where('doc.DAY', $day);
      $result['doctor_slots'] = $this->db->get()->result();

//       echo '<pre>';
//       print_r($day);
//       exit;

      echo json_encode($result);
  }
  
  function type_appointment(){
    
      $json_data = json_decode($this->input->raw_input_stream, true);
      $id_appointment = $json_data['id_appointment'];

      $query = $this->db->select('appointment.appointment_status, appointment.patient_id, charges.*, charge_type_master.id as id_charge, charge_type_master.charge_type, charge_categories.*, visit_details.id as id_visit, visit_details.opd_details_id as opd_id')
      ->from('appointment')
      ->where('appointment.id', $id_appointment)
      ->join('charges', 'charges.id = appointment.charge_id')
      ->join('charge_categories', 'charge_categories.id = charges.charge_category_id')
      ->join('charge_type_master', 'charge_type_master.id = charge_categories.charge_type_id')
      ->join('visit_details', 'visit_details.id = appointment.visit_details_id')  
      ->get();
      $result = $query->row_array();

//       echo "<pre>";
//       print_r($result);
//       exit;
    

      if($result['appointment_status'] == "Aprobada" || $result['appointment_status'] == "Firmada"){

           if($result['charge_type_id'] === '2'){
              $url = base_url('admin/patient/visitdetails/'. $result['patient_id'] . '/' . $result['opd_id']);
           }else if($result['charge_type_id'] === '3'){
              $url = base_url('admin/Surgery/atention/'. $result['patient_id'] . '/' . $result['opd_id']);
           }else if($result['charge_type_id'] === '8'){
              $url = base_url('admin/Procedimientos/procedures_details/'. $result['patient_id'] . '/' . $result['opd_id']);
           }
           
//           echo "<pre>";
//           print_r($result['charge_type_id']);
//           exit;

           $array = array('state' => 'success', 'msg' => '', 'url' => $url);
        
      } else {
          $array = array('state' => 'fail', 'msg' => 'Es necesario aprobar la cita antes de poder visualizarla.', 'url' => '');
      }

      echo json_encode($array);
  }

}
