<?php

// models/User.php
defined('BASEPATH') OR exit('No direct script access allowed');

class State_model extends CI_Model {


    function __construct() {
        parent::__construct();
        $this->_tableName = 'rms_States';
        $this->load->database();
    }
    public function addRow($tableName, $insertData) {
        $this->db->insert($this->_tableName, $insertData);
       
        return $this->db->insert_id();
    }

    public function updateRow($tableName, $updateData, $whereData) {
        return $this->db->update($tableName, $updateData, $whereData);
    }

    public function deleteRow($tableName, $whereData) {
        return $this->db->delete($tableName, $whereData);
    }
    public function getStateList($filter = array()) {

        $this->db->select('rms_state_id as id,rms_state_name as state_name,state_status,rms_createdate');


        if (isset($filter['rms_state_id']) && is_numeric($filter['rms_state_id'])) {
            $this->db->where('rms_state_id', $filter['rms_state_id']);
        }
        if (isset($filter['rms_state_name']) && !empty($filter['rms_state_name'])) {
            $this->db->where('rms_state_name', $filter['rms_state_name']);
        }
        if (isset($filter['rms_createdate']) && !empty($filter['rms_createdate'])) {
            $this->db->where('rms_createdate', $filter['rms_createdate']);
        }
        if (isset($filter['status']) && !empty($filter['status'])) {
            $this->db->where('status', $filter['status']);
        }
       
        if (isset($filter['order_by']) && !empty($filter['order_by'])) {
            $this->db->order_by($filter['order_by']);
        }
        if (isset($filter['offset']) && isset($filter['limit'])) {
            $this->db->limit($filter['limit'], $filter['offset']);
        }
    
        $query = $this->db->get($this->_tableName);

        if (isset($filter['count']) && $filter['count']) {
            return $query->num_rows();
        }

        if (isset($filter['single']) && $filter['single']) {
            return $query->row();
        }

        return $query->result();
        
    }
    
     

}
