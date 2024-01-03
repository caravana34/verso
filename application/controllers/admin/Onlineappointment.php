<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Onlineappointment extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("staff_model");
        $this->config->load("payroll");
        $this->load->model(array("onlineappointment_model", "charge_category_model"));
        $this->load->library("datatables");
        $this->time_format = $this->customlib->getHospitalTimeFormat();
        $this->load->library("customlib");
        $this->type_opd = $this->config->item('type_opd');
    }

    public function index()
    {

        $this->session->set_userdata('top_menu', 'setup');
        $this->session->set_userdata('sub_sidebar_menu', 'admin/onlineappointment');
        $this->session->set_userdata('sub_menu', 'admin/onlineappointment');
        $this->load->view('layout/header');
        $data['doctors']         = $this->staff_model->getStaffbyrole(3);
        $doctor                  = $this->input->post("doctor");
        $data['charge_category'] = $this->charge_category_model->getCategoryByModule("opd");
        $this->form_validation->set_rules("doctor", $this->lang->line("doctor"), "trim|required|xss_clean");
        $this->form_validation->set_rules("shift", $this->lang->line("shift"), "trim|required|xss_clean");
        $data["type_opd"]    = $this->type_opd;
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/onlineappointment/index', $data);
            $this->load->view('layout/footer');
        } else {
            $data["days"]               = $this->customlib->getDaysname();
            $doc_data                   = $this->onlineappointment_model->getDocData($doctor);
            $data['charge_id']          = isset($doc_data['charge_id']) ? $doc_data['charge_id'] : "";
            $charges                    = $this->charge_model->getChargeByChargeId($data['charge_id']);
            $data['charge_category_id'] = isset($charges['charge_category_id']) ? $charges['charge_category_id'] : "";
            $data['charge']             = $this->charge_model->getchargeDetails($data['charge_category_id']);
            $charges                    = $this->charge_model->getChargeByChargeId($data['charge_id']);
            $data['standard_charge']    = isset($charges['standard_charge']) ? $charges['standard_charge'] : 0;
            $data['percentage']         = isset($charges['percentage']) ? $charges['percentage'] : 0;
            $data['appointment_charge'] = $data['standard_charge'] + ($data['standard_charge'] * $data['percentage'] / 100);
            $data['duration']           = isset($doc_data['consult_duration']) ? $doc_data['consult_duration'] : "";
//           echo "<pre>";
//           print_r($data);
//           exit;
            $this->load->view('admin/onlineappointment/index', $data);
            $this->load->view('layout/footer');
        }
    }

    public function getShiftdata()
    {
        if (!$this->rbac->hasPrivilege('online_appointment_slot', 'can_view')) {
            access_denied();
        }
        $data                = array();
        $data['total_count'] = 1;
        $day                 = $this->input->post('day');
        $doctor_id           = $this->input->post("doctor");
        $shift               = $this->input->post("shift");

        $prev_record = $this->onlineappointment_model->getShiftdata($doctor_id, $day, $shift);
//         echo "<pre>";
//       print_r($prev_record);
//       exit;

        if (empty($prev_record)) {
            $data['prev_record'] = array();
        } else {
            $data['total_count'] = count($prev_record);
            $data['prev_record'] = $prev_record;
        }
        $data['day']    = $day;
        $data['doctor'] = $doctor_id;
        $data['shift']  = $shift;
        $data['status_blocked']  = $prev_record['status_blocked'];
        $data["doctors"]   = $this->staff_model->getStaffbyrole(3);
      
        $data['days_doctor'] = $this->db->query("SELECT distinct(doctor_shift.day) FROM doctor_shift WHERE doctor_shift.staff_id = '$doctor_id';")->result();
       
        $data['html'] = $this->load->view('admin/onlineappointment/addrow', $data, true);
        echo json_encode($data);
    }

    public function saveDoctorShift()
    {
      
//         echo "<pre>";
//         print_r($this->input->post());
//         exit;
      
        if (!$this->rbac->hasPrivilege('online_appointment_slot', 'can_edit')) {
            access_denied();
        }
        $json = array();
        $this->form_validation->set_rules('day', $this->lang->line('days'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('consult_time', $this->lang->line('consultation_duration'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('charge_id', $this->lang->line('charge_id'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('doctor', $this->lang->line("doctor"), 'trim|required|xss_clean');
        $this->form_validation->set_rules('shift', $this->lang->line('shift'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('doctor_start_date', 'doctor_start_date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('doctor_start_date', 'doctor_start_date', 'trim|required|xss_clean');
      
        $this->form_validation->set_rules('doctor_start_date', 'doctor_start_date', 'trim|required|xss_clean', array(
                'required'      => 'La fecha de inicio de la vigencia es requerida.',
        ));
      
        $this->form_validation->set_rules('doctor_end_date', 'end_start_date', 'trim|required|xss_clean', array(
                'required'      => 'La fecha final de la vigencia es requerida.',
        ));

        $total_rows = $this->input->post("total_row");
        if (!empty($total_rows)) {
            foreach ($this->input->post('total_row') as $key => $value) {
                $this->form_validation->set_rules('time_from_' . $value, 'Time From', 'trim|required|xss_clean');
                $this->form_validation->set_rules('time_to_' . $value, 'Time To', 'trim|required|xss_clean');
            }
        }
      
        $before_today = false;
        $start_date_greater = false;
      
        $today = (new DateTime())->format('Y-m-d');
        $input_start_date = (new DateTime($this->input->post('doctor_start_date')))->format('Y-m-d');
        $input_end_date = (new DateTime($this->input->post('doctor_end_date')))->format('Y-m-d');

//         if($input_start_date < $today || $input_end_date < $today){
//             $before_today = true;
//         }
      
        if($input_start_date > $input_end_date){
            $start_date_greater = true;
        }
      

        if (!$this->form_validation->run() || $before_today || $start_date_greater) {

            $json = array(
                'day'          => form_error('day'),
                'doctor'       => form_error('doctor'),
                'shift'        => form_error('shift'),
                'consult_time' => form_error('consult_time'),
                'charge_id'    => form_error('charge_id'),
                'doctor_start_date' => form_error('end_start_date'),
                'doctor_end_date'    => form_error('doctor_end_date')
            );
          
            if($before_today){
                $json['before_today'] = 'No es posible establecer una vigencia con una fecha anterior a la actual.';
            }
            
            if($start_date_greater){
                $json['start_date_greater'] = 'La fecha de inicio de la vigencia no puede ser mayor a la final.';
            }
          
            if (!empty($total_rows)) {
                foreach ($this->input->post('total_row') as $key => $value) {
                    $json['time_from_' . $value] = form_error('time_from_' . $value);
                    $json['time_to_' . $value]   = form_error('time_to_' . $value);
                }
            }
            $json_array = array('status' => '0', 'error' => $json);
        } else {

            /************************* Time Validation Code Start ******************************/
            $shift_id           = $this->input->post("shift");
            $global_shift       = $this->onlineappointment_model->getGlobalShift($shift_id);
            $global_shift_start = date("H:i:s", strtotime($global_shift["start_time"]));
            $global_shift_end   = date("H:i:s", strtotime($global_shift["end_time"]));
            if (!empty($total_rows)) {
                foreach ($total_rows as $total_key => $total_value) {
                    $first_start = date("H:i:s", strtotime($this->input->post('time_from_' . $total_value)));
                    $first_end   = date("H:i:s", strtotime($this->input->post('time_to_' . $total_value)));
                    if ($first_start >= $first_end) {
                        echo json_encode(array("status" => 3));
                        return;
                    }
                    if ($first_start < $global_shift_start || $first_end > $global_shift_end) {
                        echo json_encode(array("status" => 5));
                        return;
                    }
                    foreach ($total_rows as $total_key1 => $total_value1) {
                        if ($total_key < $total_key1) {
                            $second_start = date("H:i:s", strtotime($this->input->post('time_from_' . $total_value1)));
                            $second_end   = date("H:i:s", strtotime($this->input->post('time_to_' . $total_value1)));
                            if ($second_start >= $second_end) {
                                echo json_encode(array("status" => 3, "shift_one" => $total_value, "shift_two" => $total_value1));
                                return;
                            }
                            if ($first_start <= $second_end && $second_start <= $first_end) {
                                echo json_encode(array("status" => 4, "shift_one" => $total_value, "shift_two" => $total_value1));
                                return;
                            }
                        } else {
                            continue;
                        }
                    }
                }
            }
            /************************* Time Validation Code End ******************************/

            $consult_fee  = $this->input->post('consult_fee');
            $consult_time = $this->input->post('consult_time');
            $charge_id    = $this->input->post('charge_id');
            $day          = $this->input->post('day');
            $doctor_id    = $this->input->post('doctor');
            $type_agenda  = $this->input->post('type_opd');
            $total_row    = $this->input->post('total_row');
            $insert_array = array();
            $update_array = array();
            $old_input    = array();
            $prev_array   = $this->input->post('prev_array');
            if (isset($prev_array)) {
                foreach ($prev_array as $prev_arr_key => $prev_arr_value) {
                    $old_input[] = $prev_arr_value;
                }
            }
            $preserve_array = array();
            if (isset($total_row)) {
                foreach ($total_row as $total_key => $total_value) {
                    $prev_id = $this->input->post('prev_id_' . $total_value);

                    if ($prev_id == 0) {
                        $insert_array[] = array(
                            'day'             => $day,
                            'staff_id'        => $doctor_id,
                            'global_shift_id' => $shift_id,
                            'type_agenda'     => $type_agenda,
                            'start_time'      => date("H:i:s", strtotime($this->input->post('time_from_' . $total_value))),
                            'end_time'        => date("H:i:s", strtotime($this->input->post('time_to_' . $total_value))),
                            'start_date'      => date("Y-m-d", strtotime($this->input->post('doctor_start_date'))),
                            'end_date'        => date("Y-m-d", strtotime($this->input->post('doctor_end_date'))),
                        );
                    } else {
                        $preserve_array[] = $prev_id;
                        $update_array[]   = array(
                            'id'              => $prev_id,
                            'staff_id'        => $doctor_id,
                            'type_agenda'     => $type_agenda,
                            'global_shift_id' => $shift_id,
                            'day'             => $day,
                            'start_time'      => date("H:i:s", strtotime($this->input->post('time_from_' . $total_value))),
                            'end_time'        => date("H:i:s", strtotime($this->input->post('time_to_' . $total_value))),
                            'start_date'      => date("Y-m-d", strtotime($this->input->post('doctor_start_date'))),
                            'end_date'        => date("Y-m-d", strtotime($this->input->post('doctor_end_date'))),
                        );
                    }
                }
            }

            $delete_array = array_diff($old_input, $preserve_array);

            $insert_array = $this->security->xss_clean($insert_array);
            $update_array = $this->security->xss_clean($update_array);

            $result        = $this->onlineappointment_model->add($delete_array, $insert_array, $update_array);
            $shift_details = array(
                "staff_id"         => $doctor_id,
                "consult_duration" => $consult_time,
                "charge_id"        => $charge_id,
            );
            $prev_shift = $this->onlineappointment_model->getShiftDetails($doctor_id);

            $prev_shift = $this->security->xss_clean($prev_shift);

            if (!empty($prev_shift)) {
                $this->onlineappointment_model->updateShiftDetails($shift_details);
            } else {
                $this->onlineappointment_model->addShiftDetails($shift_details);
            }
            if ($result) {
                $json_array = array('status' => '1', 'error' => '', 'message' => $this->lang->line('success_message'));
            } else {
                $json_array = array('status' => '2', 'error' => '', 'message' => $this->lang->line('something_went_wrong'));
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json_array));
    }

    public function patientSchedule()
    {
        if (!$this->rbac->hasPrivilege('doctor_wise_appointment', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'appointment');
        $this->load->view('layout/header');
        $doctors         = $this->staff_model->getStaffbyrole(3);
        $data['doctors'] = $doctors;
        $this->form_validation->set_rules('doctor', $this->lang->line("doctor"), 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', $this->lang->line("date"), "trim|required|xss_clean");

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/onlineappointment/patientSchedule', $data);
            $this->load->view('layout/footer');
        } else {
            $doctors         = $this->staff_model->getStaffbyrole(3);
            $data['doctors'] = $doctors;
            $doctor_id       = $this->input->post("doctor");
            $date            = $this->input->post("date");
            if ($doctor_id == '') {
                $doctor_id = "null";
            }
            if ($date == '') {
                $date = "null";
            }
            $data['doctor_id'] = $doctor_id;
            $data['date']      = $date;
            $this->load->view('admin/onlineappointment/patientSchedule', $data);
            $this->load->view('layout/footer');
        }
    }

    public function getPatientSchedule()
    {
        $doctor_id = $this->input->get("doctor");
        $date      = $this->input->get("date");
        if ($date != "null") { 
            $date = $this->customlib->dateFormatToYYYYMMDD($date);
        }
        $dt_response = $this->onlineappointment_model->getPatientSchedule($doctor_id, $date);
        $dt_response = json_decode($dt_response);
        $dt_data     = array();
        if (!empty($dt_response->data)) {
            foreach ($dt_response->data as $key => $value) {

                $row = array();
                //====================================
                $column_first = '<a href="#" data-toggle="popover" class="detail_popover">' . $value->patient_name . " (" . $value->id . ") " . '</a>';

                //==============================

                $row[] = $column_first;
                $row[] = $value->mobileno;
                $row[] = $value->time != '' ? date("h:i A", strtotime($value->time)) : "Offline";
                $row[] = $value->email;
                $row[] = $this->customlib->YYYYMMDDHisTodateFormat($value->date, $this->time_format); 
                $row[]     = $value->source;
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

    public function getdoctor()
    {
        $spec_id = $this->input->post('id');
        $active  = $this->input->post('active');
        $result  = $this->staff_model->getdoctorbyspecilist($spec_id);
        echo json_encode($result);
    }

    public function patientQueue()
    {
        if (!$this->rbac->hasPrivilege('patient_queue', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'appointment');

        $data   = array();
        $queue  = array();
        $submit = $this->input->post("submit");
        if (isset($submit)) {
            $this->form_validation->set_rules('doctor', $this->lang->line('doctor'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('date', $this->lang->line('date'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('slot', $this->lang->line('slot'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('global_shift', $this->lang->line('shift'), 'trim|required|xss_clean');
            if ($this->form_validation->run() == false) {
                $data["resultlist"] = array();
            } else {
                $doctor       = $this->input->post("doctor");
                $date         = $this->input->post("date");
                $date         = $this->customlib->dateFormatToYYYYMMDD($date);
                $shift        = $this->input->post("slot");
                $global_shift = $this->input->post("global_shift");
                if ($submit == "regenerate") {
                    $this->deleteQueue($doctor, $date, $shift);
                }
                $online_data      = $this->onlineappointment_model->getPatientOnline($doctor, $date, $shift);
                $offline_data     = $this->onlineappointment_model->getPatientOffline($doctor, $date, $shift);
                $array_of_time    = $this->customlib->getSlotByDoctorShift($doctor, $shift);
                $online_time      = array_column($online_data, 'time');
                $iterator_online  = 0;
                $iterator_offline = 0;
                foreach ($array_of_time as $time_key => $time_value) {
                    if ($iterator_online < count($online_data)) {
                        if (in_array(date("H:i:s", strtotime($time_value)), $online_time)) {
                            array_push($queue, $online_data[$iterator_online]);
                            $iterator_online++;
                        } else {
                            if ($iterator_offline < count($offline_data)) {
                                $offline_data[$iterator_offline]["time"] = $time_value;
                                array_push($queue, $offline_data[$iterator_offline]);
                                $iterator_offline++;
                            }
                        }
                    } elseif ($iterator_offline < count($offline_data)) {
                        $offline_data[$iterator_offline]["time"] = $time_value;
                        array_push($queue, $offline_data[$iterator_offline]);
                        $iterator_offline++;
                    }
                }

                $appointments         = array_column($queue, "appointment_id");
                $insert_array         = array();
                $update_array         = array();
                $where_in             = array();
                $queue_position       = $this->onlineappointment_model->getLastQueuePosition($doctor, $date, $shift);
                $prev_queue_postition = $queue_position['position'];
                if (!empty($appointments)) {
                    foreach ($appointments as $a_key => $a_value) {
                        $appointment_queue = array(
                            "appointment_id" => $a_value,
                            "position"       => ++$prev_queue_postition,
                            "staff_id"       => $doctor,
                            "shift_id"       => $shift,
                            "date"           => $date,
                        );
                        $update_appointment = array(
                            "id"       => $a_value,
                            "is_queue" => 1,
                        );

                        array_push($insert_array, $appointment_queue);
                        array_push($update_array, $update_appointment);
                    }
                    $this->onlineappointment_model->insertQueuePositions($insert_array, $update_array);
                }
                $queue              = $this->onlineappointment_model->getPatientQueue($doctor, $date, $shift);
                $data["resultlist"] = $queue;
                $data["shift"]      = $shift;
            }
        }
        $doctors         = $this->staff_model->getStaffbyrole(3);
        $data['doctors'] = $doctors;
        $this->load->view('layout/header');
        $this->load->view('admin/onlineappointment/patientQueue', $data);
        $this->load->view('layout/footer');
    }

    public function deleteQueue($doctor, $date, $shift)
    {
        $appointments = $this->onlineappointment_model->getAppointmentFromQueue($doctor, $date, $shift);
        if (!empty($appointments)) {
            $appointemnt_id = array_column($appointments, "appointment_id");
            $this->onlineappointment_model->deleteQueue($appointemnt_id);
        }
    }

    public function globalShift()
    {
        if (!$this->rbac->hasPrivilege('online_appointment_shift', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'setup');
        $this->session->set_userdata('sub_sidebar_menu', 'admin/onlineappointment/globalshift');
        $this->session->set_userdata('sub_menu', 'admin/onlineappointment');
        $shift         = $this->onlineappointment_model->globalShift();
        $data["shift"] = $shift;
        $this->load->view('layout/header');
        $this->load->view('admin/onlineappointment/globalShift', $data);
        $this->load->view('layout/footer');
    }

    public function getGlobalShift($id)
    {
        $shift = $this->onlineappointment_model->getGlobalShift($id);
        echo json_encode($shift);
    }

    public function addGlobalShift()
    {
        if (!$this->rbac->hasPrivilege('online_appointment_shift', 'can_add')) {
            access_denied();
        }
        $data = array();
        $this->form_validation->set_rules("name", $this->lang->line('name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules("time_from", $this->lang->line('time_from'), 'trim|required|xss_clean');
        $this->form_validation->set_rules("time_to", $this->lang->line('time_to'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $msg  = array("name" => form_error('name'), "time_from" => form_error('time_from'), "time_to" => form_error('time_to'));
            $data = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $name      = $this->input->post("name");
            $time_from = date("H:i:s", strtotime($this->input->post("time_from")));
            $time_to   = date("H:i:s", strtotime($this->input->post("time_to")));
            if ($time_from < $time_to) {
                $shift = array(
                    "name"       => $name,
                    "start_time" => $time_from,
                    "end_time"   => $time_to,
                );
                $shift = $this->security->xss_clean($shift);
                $this->onlineappointment_model->addGlobalShift($shift);
                $data = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
            } else {
                $data = array('status' => 'invalid', 'error' => '', 'message' => $this->lang->line('time_from_should_be_greater_then_time_to'));
            }
        }
        echo json_encode($data);
    }

    public function updateGlobalShift()
    {
        if (!$this->rbac->hasPrivilege('online_appointment_shift', 'can_edit')) {
            access_denied();
        }
        $data  = array();
        $shift = array();
        $this->form_validation->set_rules("name", $this->lang->line('name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules("time_from", $this->lang->line('time_from'), 'trim|required|xss_clean');
        $this->form_validation->set_rules("time_to", $this->lang->line('time_to'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $msg  = array("name" => form_error('name'));
            $data = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $time_from = date("H:i:s", strtotime($this->input->post("time_from")));
            $time_to   = date("H:i:s", strtotime($this->input->post("time_to")));
            if ($time_from < $time_to) {
                $shift = array(
                    "id"         => $this->input->post('shiftid'),
                    "name"       => $this->input->post('name'),
                    "start_time" => $time_from,
                    "end_time"   => $time_to,
                );
                $shift = $this->security->xss_clean($shift);
                $this->onlineappointment_model->updateGlobalShift($shift);
                $data = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
            } else {
                $data = array('status' => 'invalid', 'error' => '', 'message' => $this->lang->line('time_from_should_be_greater_then_time_to'));
            }
        }
        echo json_encode($data);

    }

    public function doctorGlobalShift()
    {
        if (!$this->rbac->hasPrivilege('online_appointment_doctor_shift', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'setup');
        $this->session->set_userdata('sub_sidebar_menu', 'admin/onlineappointment/doctorglobalshift');
        $this->session->set_userdata('sub_menu', 'admin/onlineappointment');
        $shift = $this->onlineappointment_model->globalDoctorShift();
        foreach ($shift as $shift_key => $shift_value) {
            $shift[$shift_key]["doctor_shift"] = $this->onlineappointment_model->getGlobalDoctorShift($shift_value["id"]);
        }
        $data['shift']        = $shift;
        $doctors              = $this->staff_model->getStaffbyrole(3);
        $data['doctor']       = $doctors;
        $global_shift         = $this->onlineappointment_model->globalShift();
        $data["global_shift"] = $global_shift;
        $this->load->view('layout/header');
        $this->load->view('admin/onlineappointment/doctorGlobalShift', $data);
        $this->load->view('layout/footer');
    }

    public function getDoctorGlobalShfit($id)
    {
        $shift = $this->onlineappointment_model->getDoctorGlobalShift($id);
        echo json_encode($shift);
    }

    public function getGlobalDoctorShifts($doctor_id)
    {
        $shift = $this->onlineappointment_model->getGlobalDoctorShifts($doctor_id);
        echo json_encode($shift);
    }

    public function editDoctorGlobalShfit()
    {
        if (!$this->rbac->hasPrivilege('online_appointment_doctor_shift', 'can_edit')) {
            access_denied();
        }
        $doctor_id    = $this->input->post("doctor_id");
        $shift_id     = $this->input->post("shift_id");
        $status       = $this->input->post("status");
        $insert_array = array();
        $delete_array = array();
        if ($status == 1) {
            $insert_array = array(
                "staff_id"        => $doctor_id,
                "global_shift_id" => $shift_id,
            );
        } elseif ($status == 0) {
            $delete_array = array(
                "staff_id"        => $doctor_id,
                "global_shift_id" => $shift_id,
            );
        }
        $insert_array = $this->security->xss_clean($insert_array);
        $this->onlineappointment_model->editDoctorGlobalShift($insert_array, $delete_array);
        echo json_encode(array("status" => "success", "message" => $this->lang->line('doctor_shift_updated_successfully')));
    }

    public function doctorShiftById()
    {
        $doctor_id = $this->input->post("doctor_id");
        $shift     = $this->onlineappointment_model->doctorShiftById($doctor_id);
        echo json_encode($shift);
    }

    public function sortQueue()
    {
        if (!$this->rbac->hasPrivilege('patient_queue', 'can_edit')) {
            access_denied();
        }
        $position  = $this->input->post("position");
        $queueData = array();
        $data      = array();
        $i         = 1;
        foreach ($position as $position_key => $position_value) {
            $data = array(
                "id"       => $position_value,
                "position" => $i,
            );
            array_push($queueData, $data);
            $i++;
        }
        if ($this->onlineappointment_model->updateQueue($queueData)) {
            echo json_encode(array("status" => "success", "message" => $this->lang->line("success_message")));
        } else {
            echo json_encode(array("status" => "error", "message" => $this->lang->line("no_change_was_made")));
        }
    }

    public function getShift()
    {
        $dates        = $this->input->post("date");
        $date         = $this->customlib->dateFormatToYYYYMMDD($dates);
        $doctor       = $this->input->post("doctor");
        $global_shift = $this->input->post("global_shift");
        $day          = date("l", strtotime($date));
        $shift        = $this->onlineappointment_model->getShiftdata($doctor, $day, $global_shift);
        echo json_encode($shift);
    }

    public function getShiftById(){
        $shift_id = $this->input->post("id");
        $date = $this->customlib->dateFormatToYYYYMMDDHis($this->input->post("date"));
        $shift = $this->onlineappointment_model->getShiftById($shift_id);
        $end_time = date("Y-m-d",strtotime($date))." ".$shift['end_time'];
        $end_time = date("Y-m-d H:i:s" ,strtotime($end_time));
        $current_time = date("Y-m-d H:i:s");
        if($current_time>$end_time){
            echo json_encode(array("status" => 1));
        }else{
            echo json_encode(array("status" => 0));
        }
    }

    public function deleteglobalshift($id)
    {

        if (!$this->rbac->hasPrivilege('online_appointment_slot', 'can_delete')) {
            access_denied();
        }

        $this->onlineappointment_model->deleteGlobalShift($id);
        echo json_encode(array('status' => 1, 'msg' => $this->lang->line('delete_message')));
    }
  
    public function programming_settings(){
      
        if (!$this->rbac->hasPrivilege('online_appointment_shift', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'setup');
        $this->session->set_userdata('sub_sidebar_menu', 'admin/onlineappointment/programming_settings');
        $this->session->set_userdata('sub_menu', 'admin/onlineappointment');
//         $shift         = $this->onlineappointment_model->globalShift();
//         $data["shift"] = $shift;
      
        $doctors           = $this->staff_model->getStaffbyrole(3);
        $data["doctors"]   = $doctors;
      
        $this->load->view('layout/header');
        $this->load->view('admin/onlineappointment/programming_settings', $data);
        $this->load->view('layout/footer');
    }
    
  
    function blocked_calendar(){

        $id_doctor = $this->input->post('doctor');
        $start_date = $this->input->post('start');
        $end_date = $this->input->post('end');
        $day = $this->input->post('day');
        $reason = $this->input->post('reason');
        $array_errors = [];

      
        $this->form_validation->set_rules([
            [
                'field' => 'start',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'La fecha inicial es requerida.',
                ],
            ],
            [
                'field' => 'end',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'La fecha final es requerida.',
                ],
            ],
//             [
//                 'field' => 'day',
//                 'rules' => 'trim|required|xss_clean',
//                 'errors' => [
//                     'required' => 'El dia es requerido.',
//                 ],
//             ],
            [
                'field' => 'reason',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'La razón del bloqueo es requerida.',
                ],
            ]
        ]);
      
         $result_dates = $this->db
          ->select('lock.start_date, lock.end_date')
          ->from('lock_calendar as lock')
          ->where('id_doctor', $id_doctor)
          ->get()
          ->result();
      
          $date_in_range = false;
          $overlap = false;
          $before_today = false;
          $start_date_greater = false;
          $today = (new DateTime())->format('Y-m-d');
      
          $input_start_date = (new DateTime($start_date))->format('Y-m-d');
          $input_end_date = (new DateTime($end_date))->format('Y-m-d');

          if($input_start_date < $today || $input_end_date < $today){
                $array_errors['before_today'] = 'No es posible establecer un bloqueo con fecha anterior a la actual.';
          } 
      
          if($input_start_date > $input_end_date){
                $array_errors['start_date_greater'] = 'La fecha de inicio no puede ser posterior a la fecha de finalización.';
          }
      
          if(!empty($start_date) && !empty($end_date)){
            
              foreach ($result_dates as $key => $value) {
                  $db_start_date = (new DateTime($value->start_date))->format('Y-m-d');
                  $db_end_date = (new DateTime($value->end_date))->format('Y-m-d');

                  if ($input_start_date > $db_start_date && $input_start_date < $db_end_date || $input_end_date > $db_start_date && $input_end_date < $db_end_date) {
                      // Al menos una de las dos fechas está dentro del rango.
                      $array_errors['date_in_range'] = 'Al menos una de las dos fechas se encuentra dentro de un bloqueo existente.';
                      break;
                  }else if($input_start_date < $db_end_date && $input_end_date > $db_end_date){
                      // Esta superponiendo una fecha existente.
                      $array_errors['overlap'] = 'No se permite la superposición de bloqueos.';
                      break;
                 }

              }

          }


        if ($this->form_validation->run() == false || count($array_errors) > 0) {
          
            $validation_errors = $this->form_validation->error_array();
            $errors = array_merge($validation_errors, $array_errors);
            $array = array('state' => 'fail', 'msg' => '', 'errors' => $errors);  
          
       } else {

            $appointment_dates = $this->db->select('appointment.id, appointment.date, appointment.appointment_status')
            ->from('appointment')
            ->where("appointment.doctor", $id_doctor)
            ->where('DATE(appointment.date) BETWEEN "' .date("Y-m-d",strtotime($start_date)). '" AND "' .date("Y-m-d",strtotime($end_date)).'"')
            ->get()
            ->result();

             foreach($appointment_dates as $key => $value){
                  $this->db->where("appointment.id",$value->id);
                  $this->db->update("appointment",array('appointment_status' => 'Bloqueada'));
             }
          
            $lock_data = array(
                'start_date' =>  date("Y-m-d",strtotime($start_date)),
                'end_date' => date("Y-m-d",strtotime($end_date)),
                'blocking_reason' => $reason,
                'id_doctor' => $id_doctor,
                'create_at' => date('Y-m-d H:i:s'),
                'status' => '1'
            );

            $this->db->insert('lock_calendar', $lock_data); 
//             $result_id = $this->db->insert_id();
 
            $array = array('state' => 'success', 'msg' => 'Se registro el bloqueo correctamente!.', 'errors' => '');
       }

       echo json_encode($array);
      
    }
  
    function update_lock_calendar(){
      
//       echo "<pre>";
//       print_r($this->input->post());
//       exit;

        $id_lock = $this->input->post('id_lock');
        $id_doctor = $this->input->post('doctor');
        $start_date = $this->input->post('start');
        $end_date = $this->input->post('end');
        $status = $this->input->post('status');
//         $day = $this->input->post('day');
        $reason = $this->input->post('reason');
      
        $array_errors = [];
      
        if($status == 0){
            $lock_data = array(
               'status' => 0
            );

            $this->db->where('id_lock_calendar', $id_lock);
            $this->db->update('lock_calendar', $lock_data);
            $array = array('state' => 'success', 'msg' => 'Se actualizo el estado del bloqueo correctamente.', 'errors' => '');
            
            echo json_encode($array);  
            exit;
        }
      
        $this->form_validation->set_rules([
            [
                'field' => 'start',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'La fecha inicial es requerida.',
                ],
            ],
            [
                'field' => 'end',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'La fecha final es requerida.',
                ],
            ],
//             [
//                 'field' => 'day',
//                 'rules' => 'trim|required|xss_clean',
//                 'errors' => [
//                     'required' => 'El dia es requerido.',
//                 ],
//             ],
            [
                'field' => 'reason',
                'rules' => 'trim|required|xss_clean',
                'errors' => [
                    'required' => 'La razón del bloqueo es requerida.',
                ],
            ]
        ]);
      
        $result_dates = $this->db
        ->select('lock.start_date, lock.end_date')
        ->from('lock_calendar as lock')
        ->where('id_lock_calendar', $id_lock) 
        ->get()
        ->result();

//         $date_in_range = false;
//         $overlap = false;
//         $before_today = false;
//         $start_date_greater = false;
      
        $today = (new DateTime())->format('Y-m-d');
        $input_start_date = (new DateTime($start_date))->format('Y-m-d');
        $input_end_date = (new DateTime($end_date))->format('Y-m-d');

        if($input_start_date < $today || $input_end_date < $today){
              $array_errors['before_today'] = 'No es posible establecer un bloqueo con fecha anterior a la actual.';
        } 

        if($input_start_date > $input_end_date){
              $array_errors['start_date_greater'] = 'La fecha de inicio no puede ser posterior a la fecha de finalización.';
        }

        if(!empty($start_date) && !empty($end_date)){

            foreach ($result_dates as $key => $value) {
                $db_start_date = (new DateTime($value->start_date))->format('Y-m-d');
                $db_end_date = (new DateTime($value->end_date))->format('Y-m-d');

                if ($input_start_date > $db_start_date && $input_start_date < $db_end_date || $input_end_date > $db_start_date && $input_end_date < $db_end_date) {
                    // Al menos una de las dos fechas está dentro del rango.
                    $array_errors['date_in_range'] = 'Al menos una de las dos fechas se encuentra dentro de un bloqueo existente.';
                    break;
                }else if($input_start_date < $db_end_date && $input_end_date > $db_end_date){
                    // Esta superponiendo una fecha existente.
                    $array_errors['overlap'] = 'No se permite la superposición de bloqueos.';
                    break;
               }

            }

        }
      

        if ($this->form_validation->run() == false || count($array_errors) > 0) {
          
            $validation_errors = $this->form_validation->error_array();
            $errors = array_merge($validation_errors, $array_errors);
            $array = array('state' => 'fail', 'msg' => '', 'errors' => $errors);
          
        } else {
          
            
              $appointment_dates = $this->db->select('appointment.id, appointment.date, appointment.appointment_status')
              ->from('appointment')
              ->where("appointment.doctor", $id_doctor)
              ->where('DATE(appointment.date) BETWEEN "' .date("Y-m-d",strtotime($start_date)). '" AND "' .date("Y-m-d",strtotime($end_date)).'"')
              ->get()
              ->result();

               foreach($appointment_dates as $key => $value){
                    $this->db->where("appointment.id",$value->id);
                    $this->db->update("appointment",array('appointment_status' => 'Bloqueada'));
               }

              $lock_data = array(
                  'start_date' =>  date("Y-m-d",strtotime($start_date)),
                  'end_date' => date("Y-m-d",strtotime($end_date)),
                  'blocking_reason' => $reason,
                  'id_doctor' => $id_doctor,
                  'create_at' => date('Y-m-d H:i:s'),
                  'status' => $status
              );
          
              $this->db->where('id_lock_calendar', $id_lock);
              $this->db->update('lock_calendar', $lock_data);

              $array = array('state' => 'success', 'msg' => 'Se actualizo el bloqueo correctamente.', 'errors' => '');  
       }
      

        echo json_encode($array);

    }

    function blocked_datatable()
    {
        date_default_timezone_set("America/Bogota");
       
        $dt_response = $this->onlineappointment_model->getBlockedDatatable();
        $dt_response = json_decode($dt_response);
        $dt_data     = array();

        if (!empty($dt_response->data)) {
            foreach ($dt_response->data as $key => $value) {

                $row = array();
              
                $lock_data = json_encode($value);
              
                if($value->status == '1'){
                    $class_status = 'cita_aprobada';
                    $name_status = 'Activo';
                } else if($value->status == '0'){
                    $class_status = 'cita_cancelada';
                    $name_status = 'Inactivo';
                }
              
                $action  = "<small class='label $class_status' data-toggle='tooltip' title='' data-original-title='Agendamiento'>$name_status</small>";
                $action .= "<div class='rowoptionview rowview-btn-top'>";
                $action .= "<button type='button' data-toggle='modal' data-target='#edit_lock_modal' data-toggle='tooltip' title='Editar' class='btn btn-default btn-xs' onclick='get_lock_doctor($lock_data)'>
                              <i class='fa fa-pencil'></i>
                            </button>";         
                $action .= "</div>";

                $row[] = $value->id_lock_calendar;
                $row[] = $value->start_date;
                $row[] = $value->end_date;
                $row[] = $value->blocking_reason;
                $row[] = $value->name;
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
