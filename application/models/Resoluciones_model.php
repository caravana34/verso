<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Resoluciones_model extends MY_model
{

    public function get($id = null)
    {
        if (!empty($id)) {
            $query = $this->db->where("id", $id)->get('comercial_resolutions');
            return $query->row();
        } else {
            $query = $this->db->get("comercial_resolutions");
            return $query->result();
        }
    }

    public function resoluciones_valid($str)
    {
        $resolucion= $this->input->post('resolucion');
     
        $id   = $this->input->post('id');
        if (!isset($id)) {
            $id = 0;
        }
        if ($this->check_category_exists($resolucion, $id)) {
            $this->form_validation->set_message('check_exists', 'Record already exists');
            return false;
        } else {
            return true;
        }
    }

    public function check_category_exists($name, $id)
    {
      
    
        if ($id != 0) {
            $data  = array('id != ' => $id, 'resolution' => $name);
            $query = $this->db->where($data)->get('comercial_resolutions');
            if ($query->num_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            $this->db->where('resolution', $name);
            $query = $this->db->get('comercial_resolutions');
            if ($query->num_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function add($data)
    {
//            echo "<pre>";
//      print_r($data);
//      exit;
      
      
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['id']) && $data['id'] > 0 ) {
            $this->db->where('id', $data['id']);
            $this->db->update('comercial_resolutions', $data);
            $message = UPDATE_RECORD_CONSTANT . " On comercial_resolutions Units id " . $data['id'];
            $action = "Update";
            $record_id = $data['id'];
            $this->log($message, $record_id, $action);
        } else {
            unset($data["id"]); 
            $this->db->insert('comercial_resolutions', $data);
            $insert_id = $this->db->insert_id();
            $message = INSERT_RECORD_CONSTANT . " On comercial_resolutions Units id " . $insert_id;
            $action = "Insert";
            $record_id = $insert_id;
            $this->log($message, $record_id, $action);
        }
        //======================Code End==============================

        $this->db->trans_complete(); # Completing transaction
        /* Optional */

        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
        } else {
            return $record_id;
        }
    }

    public function delete($id)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where("id", $id)->delete("comercial_resolutions");
        
        $message = DELETE_RECORD_CONSTANT . " On Charge Units id " . $id;
        $action = "Delete";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        //======================Code End==============================

        $this->db->trans_complete(); # Completing transaction
        /* Optional */

        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
        } else {
            return $record_id;
        }
    }

    public function getAllRecord()
    {
        $this->datatables
            ->select('comercial_resolutions.*')
            ->searchable('comercial_resolutions.resolution')
            ->orderable('comercial_resolutions.prefix')
            ->sort('comercial_resolutions.id', 'asc')
            ->from('comercial_resolutions');
        return $this->datatables->generate('json');

    }
  
  public function getAllResolutions()
    {
        
     $query = $this->db->get('comercial_resolutions');
     $result = $query->result();
     return $result;
    }

}
