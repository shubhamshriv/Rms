<?php

// models/User.php
defined('BASEPATH') OR exit('No direct script access allowed');

class District_model extends CI_Model {


    function __construct() {
        parent::__construct();
        $this->_tableName = 'rms_district';
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
    public function getDistrictList($filter = array()) {

       
         if (isset($filter['join_select']) && $filter['join_select']) {
             $this->db->select('rms_states.rms_state_name state_name,rms_district.district_name as district_name');
        }else{
             $this->db->select('district_id as id,district_name as name,district_status,created_date,state_id');
        }

        if (isset($filter['join']) && $filter['join']) {
             $this->db->join('rms_states', 'rms_states.rms_state_id = rms_district.state_id', 'inner');
        }

        if (isset($filter['rms_state_id']) && is_numeric($filter['rms_state_id'])) {
            $this->db->where('rms_state_id', $filter['rms_state_id']);
        }
        if (isset($filter['district_name']) && !empty($filter['district_name'])) {
            $this->db->where('district_name', $filter['district_name']);
        }
        if (isset($filter['created_date']) && !empty($filter['created_date'])) {
            $this->db->where('created_date', $filter['created_date']);
        }
        if (isset($filter['district_ststus']) && !empty($filter['district_ststus'])) {
            $this->db->where('district_ststus', $filter['district_ststus']);
        }
        if (isset($filter['state_id']) && !empty($filter['state_id'])) {
            $this->db->where('state_id', $filter['state_id']);
        }
        if (isset($filter['district_added_by']) && !empty($filter['district_added_by'])) {
            $this->db->where('district_added_by', $filter['district_added_by']);
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
    
    function fetch_district($state_id)
 {
    
    $this->db->select('rms_states.rms_state_name state_name,rms_district.district_name as district_name,rms_district.district_id as district_id');
    $this->db->join('rms_states', 'rms_states.rms_state_id = rms_district.state_id', 'inner');
  $this->db->where('rms_states.rms_state_id', $state_id);
  $this->db->order_by('state_name', 'ASC');
  $query = $this->db->get('rms_district');
  $output = '<option value="">District</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->district_id.'">'.$row->district_name.'</option>';
  }
  return $output;
 }
     

}
