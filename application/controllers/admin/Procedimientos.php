<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Procedimientos extends Admin_Controller
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
        $this->appointment_status = $this->config->item('appointment_status');
        $this->agerange             = $this->config->item('agerange');
        $this->load->helper('customfield_helper');
        $this->load->helper('custom');
        $this->opd_prefix          = $this->customlib->getSessionPrefixByType('opd_no');
        $this->blood_group         = $this->bloodbankstatus_model->get_product(null, 1);
        $this->time_format         = $this->customlib->getHospitalTimeFormat();
        $this->recent_record_count = 5;

    }
  

  
  
  
    public function procedures(){
      
        if (!$this->rbac->hasPrivilege('atencion', 'can_view')) {
            access_denied();
        }
        
        $app_data                      = $this->session->flashdata('app_data');
        $data['app_data']              = $app_data;
        $doctors                       = $this->staff_model->getStaffbyrole(3);
        $data["doctors"]               = $doctors;
        $patients                      = $this->patient_model->getPatientListall();
        $data["patients"]              = $patients;
        $data["appointment_status"]    = $this->appointment_status;
        $data["doctors"]      =  $this->staff_model->getStaffbyrole(3);
        $userdata             = $this->customlib->getUserData();
        $data['user_role_id'] = $userdata['role_id'];

        $this->session->set_userdata('top_menu', 'minor_procedures');

        $this->load->view('layout/header');
        $this->load->view('admin/patient/procedures/procedures_view', $data);
        $this->load->view('layout/footer');
      
    }
//   public function cualquiera(){

//     $this->load->view('layout/header');
//     $this->load->view('admin/patient/procedures/consult_gastroenterologist',$data);
//     $this->load->view('layout/footer');


//   }
  
   public function add_equipo()
   {
//       echo "<pre>";
//       print_r($operation_detail);
//       exit;
       
       $custom_fields = $this->customfield_model->getByBelong('operationtheatre');
        foreach ($custom_fields as $custom_fields_key => $custom_fields_value) {
            if ($custom_fields_value['validation']) {
                $custom_fields_id   = $custom_fields_value['id'];
                $custom_fields_name = $custom_fields_value['name'];
                $this->form_validation->set_rules("custom_fields[operationtheatre][" . $custom_fields_id . "]", $custom_fields_name, 'trim|required');
            }
        }

        $this->form_validation->set_rules('appointment_date', $this->lang->line('procedure_name'), 'required');
        $this->form_validation->set_rules('especialist', $this->lang->line("consultant_doctor"), 'trim|required');
        $this->form_validation->set_rules('opdid', $this->lang->line('operation_name'), 'required');
//         $this->form_validation->set_rules('operation_category', $this->lang->line('operation_category'), 'required');
        if ($this->form_validation->run() == false) {
            $msg = array(
                'operation_category' => form_error("operation_category"),
                'date'               => form_error('date'),
                'operation_name'     => form_error('operation_name'),
                'consultant_doctor'  => form_error("consultant_doctor"),

            );
            if (!empty($custom_fields)) {
                foreach ($custom_fields as $custom_fields_key => $custom_fields_value) {
                    if ($custom_fields_value['validation']) {
                        $custom_fields_id                                                         = $custom_fields_value['id'];
                        $custom_fields_name                                                       = $custom_fields_value['name'];
                        $error_msg2["custom_fields[operationtheatre][" . $custom_fields_id . "]"] = form_error("custom_fields[operationtheatre][" . $custom_fields_id . "]");
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

            $patientname          = $this->input->post('patientname');
            $opd_ipd_patient_type = $this->input->post('opd_ipd_patient_type');
            $opd_id               = $this->input->post('opdid');
            $date                 = $this->input->post("appointment_date");

            $operation_detail = array(
                'opd_details_id'    => $opd_id,
                'date'              => $this->customlib->dateFormatToYYYYMMDDHis($date, $this->time_format),
                
                'consultant_doctor'      => $this->input->post('especialist'),
                'operation_type'         => $this->input->post('procedure_name'),
                'ass_consultant_1'       => $this->input->post('nurse'),
                'ass_consultant_2'       => $this->input->post('ass_consultant_2'),
                'anesthetist'            => $this->input->post('anestesiologo'),
//                 'Via'                    => $this->input->post('via'),
                'Laterality'             => $this->input->post('lateralidad'),
                'complications'          => $this->input->post('complicationsData'),
//                 'ot_technician'          => $this->input->post('ot_technician'),
//                 'ot_assistant'           => $this->input->post('ot_assistant'),
                'descrition_anaethesia'  => $this->input->post('Des_anestecia'),
                'Surgery_conclusions'    => $this->input->post('Conclusionoes_sugerencias'),
                'remark'                 => $this->input->post('Des_procedimiento'),
                'result'                 => $this->input->post('ot_result'),
                'generated_by'           => $this->customlib->getLoggedInUserID(),
            );

            $insert_id = $this->operationtheatre_model->operation_detail($operation_detail);
          
            $array     = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'), 'id' => $insert_id);

           
//             $notificationurl = $this->notificationurl;
//             $url_link        = $notificationurl["ot"];
//             $doctor_list       = $this->patient_model->getDoctorsipd($ipd_id);
//             $operation_details = $this->operationtheatre_model->otdetails($insert_id);
//             $patient_details   = $this->patient_model->get_patientidbyIpdId($ipd_id);

//             $doctor_details    = $this->notificationsetting_model->getstaffDetails($this->input->post('consultant_doctor'));
//             $consultant_doctor = $this->patient_model->get_patientidbyIpdId($ipd_id);

//             $consultant_doctorarray[] = array('consult_doctor' => $this->input->post('consultant_doctor'), 'name' => $doctor_details['name'] . " " . $doctor_details['surname'] . "(" . $doctor_details['employee_id'] . ")");

//             $consultant_doctorarray[] = array('consult_doctor' => $consultant_doctor['cons_doctor'], 'name' => $consultant_doctor['doctor_name'] . " " . $consultant_doctor['doctor_surname'] . "(" . $consultant_doctor['doctor_employee_id'] . ")");
//             foreach ($doctor_list as $key => $value) {
//                 $consultant_doctorarray[] = array('consult_doctor' => $value['consult_doctor'], 'name' => $value['ipd_doctorname'] . " " . $value['ipd_doctorsurname'] . "(" . $value['employee_id'] . ")");
//             }

//             $event_data = array(
//                 'patient_id'     => $patient_details['patient_id'],
//                 'ipd_no'         => $this->customlib->getSessionPrefixByType('ipd_no') . $ipd_id,
//                 'case_id'        => $this->input->post('case_id'),
//                 'operation_name' => $operation_details->operation,
//                 'operation_date' => $this->customlib->YYYYMMDDHisTodateFormat($date, $this->customlib->getHospitalTimeFormat()),
//                 'doctor_name'    => composeStaffNameByString($doctor_details['name'], $doctor_details['surname'], $doctor_details['employee_id']),
//             );

//             $this->system_notification->send_system_notification('add_ipd_operation', $event_data, $consultant_doctorarray);
        }

        echo json_encode($array);
    }
  
  
   public function updata_operation_theatre(){
    
//     $post = $this->input->post();
     
        $OperTheatre_id = $this->input->post('otid');
//         $FaseOperatoria = $this->input->post('updataFaseOperatoria');
        if(strpos($this->input->post('OperTheatredate'), '/') !== false){
          $date = $this->customlib->dateFormatToYYYYMMDD($this->input->post('OperTheatredate'));
        }else{
          $date = $this->input->post('OperTheatredate');
        }
        $OperaName = $this->input->post('OperTheatrename');
        $Via = $this->input->post('OperTheatreVia');
        $Lateralidad = $this->input->post('OperTheatreLateralidad');
        $Anestesiologo = $this->input->post('OperTheatraAnestesiologo');
        $Nurse = $this->input->post('OperTheatraNurse');
        $Especialist = $this->input->post('OperTheatrEspecialist');
        $Result = $this->input->post('OperTheatraResult');
        $Procedimiento = $this->input->post('OperTheatraDesProcedimiento');
        $DesNestecia = $this->input->post('OperTheatraDesAnestecia');
        $ConclusionoesSugerencias = $this->input->post('OperTheatraConclusionoesSugerencias');
//         $posi_pres = $this->input->post('updataposi_pres');
//         $lugar_pres = $this->input->post('lugar_pres');
//         $remark = $this->input->post('remark');
//       $this->customlib->dateFormatToYYYYMMDD($this->input->post('updatadate'));

    $data = array(
        'id'                     => $OperTheatre_id,
        'date'                   => $date,
//         'report_type'            => $FaseOperatoria,
        'operation_type'         => $OperaName,
        'Via'                    => $Via,
        'Laterality'             => $Lateralidad,
        'consultant_doctor'      => $Especialist,
        'anesthetist'            => $Anestesiologo,
        'ass_consultant_1'       => $Nurse, 
        'result'                 => $Result,
        'remark'                 => $Procedimiento,
        'descrition_anaethesia'  => $DesNestecia,
        'Surgery_conclusions'    => $ConclusionoesSugerencias,
    );
     
//      echo "<pre>"; 
//      print_r($data);
//      exit;
      
    $this->db->where('id',$data['id']);
    $this->db->update('operation_theatre', $data);
//     -------Verificar si ocurrieron errores durante la actualización------------
    if ($this->db->affected_rows() > 0) {
        // ---------Éxito-------
        $array = array('status' => 'success', 'error' => '', 'message' => 'Registro actualizado exitosamente');
    } else {
        // ----------Error-------
        $array = array('status' => 'error', 'error' => 'Error en la actualización', 'message' => '');
    }
    // ------Devolver respuesta en formato JSON----------------
    echo json_encode($array);
}
  
  
  
    
  
  public function details_signos_vitales($id){
//     $post = $this->input->post();
    $data['id'] = $id;
    $data['signos_vitales'] = $this->db->query("SELECT signos_vitales_report.* FROM signos_vitales_report 
                                                WHERE id = " .$id. ";")->result(); 
    echo json_encode($data);
  }
  
      public function updataSignosVitales(){
        $data['signos_vitales'] = $this->db->query("SELECT signos_vitales_report.* FROM signos_vitales_report 
                                                WHERE opd_details_id = " .$opdid. ";")->result();
//       echo "<pre>";
//       print_r($data);
//       exit;
    }
  
  public function update_sig_vitales(){
    
//     $post = $this->input->post();
        $surgery_id = $this->input->post('updatasurgery_id');
        $FaseOperatoria = $this->input->post('updataFaseOperatoria');
        if(strpos($this->input->post('updatadate'), '/') !== false){
          $date = $this->customlib->dateFormatToYYYYMMDD($this->input->post('updatadate'));
        }else{
          $date = $this->input->post('updatadate');
        }
        $time = $this->input->post('updatatime');
        $talla = $this->input->post('updatatalla');
        $peso = $this->input->post('updatapeso');
        $frec_card = $this->input->post('updatafrec_card');
        $frec_res = $this->input->post('updatafrec_res');
        $temperatura = $this->input->post('updatatemperatura');
        $sat_oxi_sin = $this->input->post('updatasat_oxi_sin');
        $sat_oxi_con = $this->input->post('updatasat_oxi_con');
        $presi_sis = $this->input->post('updatapresi_sis');
        $presi_dia = $this->input->post('updatapresi_dia');
        $posi_pres = $this->input->post('updataposi_pres');
//         $lugar_pres = $this->input->post('lugar_pres');
        $remark = $this->input->post('remark');
//       $this->customlib->dateFormatToYYYYMMDD($this->input->post('updatadate'));

    $data = array(
        'id'               => $surgery_id,
        'report_type'      => $FaseOperatoria,
        'date'             => $date,
        'time'             => $time,
        'talla'            => $talla,
        'peso'             => $peso, 
        'frec_card'        => $frec_card,
        'frec_resp'        => $frec_res,
        'temperatura'      => $temperatura,
        'sat_oxi_sin'      => $sat_oxi_sin,
        'sat_oxi_con'      => $sat_oxi_con,
        'presion_sis'      => $presi_sis,
        'presion_dia'      => $presi_dia,
        'remark'           => $remark,
    );
//       echo "<pre>";
//       print_r($data);
//       exit;
      
    $this->db->where('id',$data['id']);
    $this->db->update('signos_vitales_report', $data);
//     -------Verificar si ocurrieron errores durante la actualización------------
    if ($this->db->affected_rows() > 0) {
        // ---------Éxito-------
        $array = array('status' => 'success', 'error' => '', 'message' => 'Registro actualizado exitosamente');
    } else {
// ----------Error-------
        $array = array('status' => 'error', 'error' => 'Error en la actualización', 'message' => '');
    }
// ------Devolver respuesta en formato JSON----------------
    echo json_encode($array);
}
        public function deleteSigVitales(){

             $SigVitales_id = $this->input->post('SigVitales_id');
            if (!empty($SigVitales_id)) {
                $this->db->where('id', $SigVitales_id);
                $this->db->delete('signos_vitales_report');

                    if ($this->db->affected_rows() > 0) {
                        $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('delete_message'));
                    } else {
                        $array = array('status' => 'fail', 'error' => 'Error en la eliminación', 'message' => '');
                    }
                    } else {
                        $array = array('status' => 'fail', 'error' => 'ID no proporcionado', 'message' => '');
                    }
            echo json_encode($array);
        }
    
    public function deleteDiagnosticos(){

             $Diagnosticos_id = $this->input->post('Diagnosticos_id');
            if (!empty($Diagnosticos_id)) {
                $this->db->where('id_diagnosis', $Diagnosticos_id);
                $this->db->delete('diagnosis');
                    if ($this->db->affected_rows() > 0) {
                        $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('delete_message'));
                    } else {
                        $array = array('status' => 'fail', 'error' => 'Error en la eliminación', 'message' => '');
                    }
                    } else {
                        $array = array('status' => 'fail', 'error' => 'ID no proporcionado', 'message' => '');
                    }
            echo json_encode($array);
        }
  
  
    public function procedures_details($id,$opdid){
      
      
        $data['medicineCategory']   = $this->medicine_category_model->getMedicineCategory();
        $data['intervaldosage']     = $this->medicine_dosage_model->getIntervalDosage();
        $data['durationdosage']     = $this->medicine_dosage_model->getDurationDosage();
        $data['dosage']             = $this->medicine_dosage_model->getMedicineDosage();
        $data['dose_list']          = $this->medicine_dosage_model->getMedicineDosage();
        $category_dosage            = $this->medicine_dosage_model->getCategoryDosages();
        $data['category_dosage']    = $category_dosage;
        $data['medicineName']       = $this->pharmacy_model->getMedicineName();
        $doctors                       = $this->staff_model->getStaffbyrole(3);
        $data["doctors"]               = $doctors;
        $medicationreport           = $this->patient_model->getmedicationdetailsbydateopd($opdid);
        $max_dose                   = $this->patient_model->getMaxByopdid($opdid);
        $data['max_dose']           = $max_dose->max_dose;
        $data["medication"]         = $medicationreport;
        $operation_theatre          = $this->operationtheatre_model->getopdoperationDetails($opdid);
        $data['operation_theatre']  = $operation_theatre;
        $data['is_discharge']   = $this->customlib->checkDischargePatient($data["result"]['result']['discharged']);
      
        $nurse                      = $this->staff_model->getStaffbyrole(9);
        $data["nurse"]              = $nurse;
        $data["nurse_select"]       = $nurse;
        $result                     = $this->patient_model->getDetails($opdid);
        $data['result']             = $result;
        $data["id"]                 = $id;
        $data["opdid"]              = $opdid;
        $visit_details = $this->db->query("SELECT visit_details.id as id_visit
                                          FROM visit_details 
                                          WHERE opd_details_id = " . $opdid . ";")->row_array();
        $data['id_visit'] = $visit_details['id_visit'];
        
        
//         $diagnosis = $this->db->query("SELECT categoria_diag, id_diagnosis
//                              FROM diagnosis    
//                              WHERE opd_id = ? AND categoria_diag = 'primario'", array($id))->result();
//          = $diagnosis;
        
        
        $data['diagnosis'] = $this->db->query("SELECT diagnosis.* FROM diagnosis 
                                                WHERE id_patient = " .$id. ";")->result();
        
        
        
//        $data["medication"]         =  $this->db->query("SELECT medicine_dosage_id, pharmacy_id, opd_details_id, ipd_id, report_type, date, time, remark,
//                                                     FROM medication_report 
//                                                     WHERE opd_details_id = " .$opdid. ";")->result();
       
      
//        echo "<pre>";
//       print_r($data['operation_theatre']);
//       exit;
      
      
        if($operation_theatre[0]['ass_consultant_1'] != "No aplica" && $operation_theatre[0]['ass_consultant_1'] != ""){ 
        
        
        $data["aux_enfermeria"]  = $this->db->query("SELECT staff.name,staff.surname FROM staff 
                                                WHERE id = ".$operation_theatre[0]['ass_consultant_1'].";")->result();
       }
      
        if($operation_theatre[0]['anesthetist'] != "No aplica" && $operation_theatre[0]['anesthetist'] != "" ){ 
        $data["anestesiologo"]  = $this->db->query("SELECT staff.name,staff.surname FROM staff 
                                                WHERE id = ".$operation_theatre[0]['anesthetist'].";")->result();
       
       }
      
      $DataSmall = array();
      foreach ($operation_theatre as $operationSmall) {
          if ($operationSmall['anesthetist'] == '' && $operationSmall['ass_consultant_1'] == '' && $operationSmall['Via'] == '' && $operationSmall['Laterality'] == '') {
              $DataSmall[] = $operationSmall;
          }
      }
      $data['DataSmall'] = $DataSmall;
      
      $DataAll = array();
      foreach ($operation_theatre as $operationSmall) {
          if ($operationSmall['anesthetist'] != '' && $operationSmall['ass_consultant_1'] != '' && $operationSmall['complications'] != '' && $operationSmall['Laterality'] != '') {
              $DataAll[] = $operationSmall;
          }
      }
      $data['DataAll'] = $DataAll;
      
      
//       echo "<pre>";
//         print_r($data['DataAll']);
//         exit;
      
      
      
//               $AdmisionMedication = [];
//         $TransoperatorioMedicatio = [];
//         $PostoperatorioMedicatio = [];
        
//             foreach ($data['medication'] as $medication) {
//                 switch ($medication->report_type) {
//                     case "Admision":
//                         $AdmisionMedication[] = $medication;
//                         break;
//                     case "Transoperatorio":
//                         $TransoperatorioMedicatio[] = $medication;
//                         break;
//                     case "Postoperatorio":
//                         $PostoperatorioMedicatio[] = $medication;
//                         break;
//                 }
//             }
        
//         $data['Admision_md'] = $AdmisionMedication;
//         $data['Transoperatorio_md'] = $TransoperatorioMedicatio;
//         $data['Postoperatorio_md'] = $PostoperatorioMedicatio;
      
        
//         echo "<pre>";
//         print_r($data["doctors"]);
//         exit;
        
        $anestesiologiaDoctors = array();
        foreach ($doctors as $Anestesiologia) {
            if ($Anestesiologia['specialist_doc'] == 'Anestesiologia') {
                $anestesiologiaDoctors[] = $Anestesiologia;
            }
        }
        $data['anestesiologiaDoctors'] = $anestesiologiaDoctors;
      
//            echo "<pre>";
//         print_r($data['anestesiologiaDoctors']);
//         exit;
        
        $data['signos_vitales'] = $this->db->query("SELECT signos_vitales_report.* FROM signos_vitales_report 
                                                WHERE opd_details_id = " .$opdid. ";")->result();
        
        $AdmisionSignosVital = [];
        $TransoperatorioSignosVital = [];
        $PostoperatorioSignosVitale = [];
        
            foreach ($data['signos_vitales'] as $SignosVitales) {
                switch ($SignosVitales->report_type) {
                    case "Admision":
                        $AdmisionSignosVital[] = $SignosVitales;
                        break;
                    case "Transoperatorio":
                        $TransoperatorioSignosVital[] = $SignosVitales;
                        break;
                    case "Postoperatorio":
                        $PostoperatorioSignosVitale[] = $SignosVitales;
                        break;
                }
            }
        
        $data['Admision_sv'] = $AdmisionSignosVital;
        $data['Transoperatorio_sv'] = $TransoperatorioSignosVital;
        $data['Postoperatorio_sv'] = $PostoperatorioSignosVitale;

        $case = $result['result']['case_reference_id'];
        $data['doctor_app'] = $this->db->query("SELECT doctor, time,message, date, reason_consultation, cancel_person, date_cancel, procedure_name
                                                FROM appointment 
                                                WHERE case_reference_id = " .$case. ";")->result();

       if($data['doctor_app']!=NULL){
              $id_doctor_shift = $data['doctor_app'][0]->doctor;
       }else{
              $data['doctor_app'] = $this->db->query("SELECT cons_doctor
                                                      FROM visit_details
                                                      WHERE id = " .$id_visit[0]->id. ";")->result();
           $id_doctor_shift = $data['doctor_app'][0]->cons_doctor;
       }
       $data['doctor_duration'] = $this->db->query("SELECT consult_duration
                                                      FROM shift_details 
                                                      WHERE staff_id = " .$id_doctor_shift. ";")->result();
      
      
      
       $nurse_note = $this->patient_model->getdatanursenote_opd($id, $opdid);

       $data['recent_record_count'] = $this->recent_record_count;    
            foreach ($nurse_note as $key => $nurse_note_value) {
                $notecomment                        = $this->patient_model->getnurenotecomment($opdid, $nurse_note_value['id']);
                $nursenote[$nurse_note_value['id']] = $notecomment;
            }
            if (!empty($nursenote)) {
                $data["nursenote"] = $nursenote;
            }
                $data["nurse_note"]= $nurse_note;
        
        
        
        
        $Admisionnursenote = [];
        $Transoperatorionursenote = [];
        $Postoperatorionursenote = [];

        foreach ($data["nurse_note"] as $nursenoteType) {
            switch ($nursenoteType['report_type']) {
                case "Admision":
                    $Admisionnursenote[] = $nursenoteType;
                    break;
                case "Transoperatorio":
                    $Transoperatorionursenote[] = $nursenoteType;
                    break;
                case "Postoperatorio":
                    $Postoperatorionursenote[] = $nursenoteType;
                    break;
            }
        }

        $data['Admision_nn'] = $Admisionnursenote;
        $data['Transoperatorio_nn'] = $Transoperatorionursenote;
        $data['Postoperatorio_nn'] = $Postoperatorionursenote;

//         echo "<pre>";
//         print_r($data);
//         exit;
 
       $this->load->view('layout/header');
       $this->load->view('admin/patient/procedures/consult_gastroenterologist',$data);
       $this->load->view('layout/footer');
      
    }
    
    public function getProcedureDatatable($fecha_inicial=null, $fecha_final=null,$doctor_id=null){
      
        $dt_response = $this->appointment_model->getAllappointmentRecord($fecha_inicial, $fecha_final,$doctor_id, 'procedures');
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
                $action .= "<a href=".site_url('admin/Procedimientos/procedures_details')."/".$value->pid."/".$visit." data-toggle='tooltip' style='color:#000 !important;' title='" . $this->lang->line('show') . "' class='btn btn-default btn-xs'   data-target='#viewModal' >  <i class='fa fa-reorder'></i> </a>";
              
             
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
                $row[] = $style.$value->reason_consultation."<br>".$value->procedure_name."</div>";
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
}