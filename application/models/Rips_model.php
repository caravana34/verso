<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Rips_model extends MY_Model
{

    public function get_rips_datatable()
    {
          date_default_timezone_set("America/Bogota");
          $userdata           = $this->customlib->getUserData();
          $doctor_restriction = $this->session->userdata['hospitaladmin']['doctor_restriction']; 

//           if ($doctor_restriction == 'enabled' && $userdata["role_id"] == 3) {
//               $this->datatables->where('appointment.doctor', $userdata['id']);
//           }

          $this->datatables->select('rips.id, rips.delivery, rips.date, rips.folder, rips.responsible, rips.registers, rips.valor, rips.create_at');
          $this->datatables->join('patient_charges','patient_charges.id = rips.id_patient_charges', "inner");
          $this->datatables->searchable('rips.delivery, rips.date, rips.folder, rips.responsible, rips.registers');
          $this->datatables->orderable('rips.delivery, rips.date, rips.folder, rips.responsible, rips.registers');
          $this->datatables->sort('rips.create_at', 'DESC');
          $this->datatables->from('rips');
          return $this->datatables->generate('json');
    }

}
