<?php

// models/User.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Child_model extends CI_Model {


    function __construct() {
        parent::__construct();
        $this->_tableName = 'rms_child';
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
    public function getChildList($filter = array()) {

       
        if (isset($filter['join']) && $filter['join']) {
              $this->db->select('child_id as id, child_name as name, child_sex as sex, child_dob as dob, child_father_name as father_name, child_mother_name as mother_name, child_state as state_id, child_district as district_id, child_image as image, child_status as status, child_created_date as created_date,rms_state_name,district_name');

        }else{
              $this->db->select('child_id as id, child_name as name, child_sex as sex, child_dob as dob, child_father_name as father_name, child_mother_name as mother_name, child_state as state, child_district as district, child_image as image, child_status as status, child_created_date as created_date');

        }

        if (isset($filter['join']) && $filter['join']) {
             $this->db->join('rms_states', 'rms_states.rms_state_id = rms_child.child_state', 'left');
        }
        if (isset($filter['join']) && $filter['join']) {
             $this->db->join('rms_district', 'rms_district.district_id = rms_child.child_district', 'left');
        }

        if (isset($filter['child_id']) && is_numeric($filter['child_id'])) {
            $this->db->where('child_id', $filter['child_id']);
        }
        if (isset($filter['child_name']) && !empty($filter['child_name'])) {
            $this->db->where('child_name', $filter['child_name']);
        }
        if (isset($filter['child_sex']) && !empty($filter['child_sex'])) {
            $this->db->where('child_sex', $filter['child_sex']);
        }
        if (isset($filter['child_dob']) && !empty($filter['child_dob'])) {
            $this->db->where('child_dob', $filter['child_dob']);
        }
         if (isset($filter['child_father_name']) && !empty($filter['child_father_name'])) {
            $this->db->where('child_father_name', $filter['child_father_name']);
        }
         if (isset($filter['child_mother_name']) && !empty($filter['child_mother_name'])) {
            $this->db->where('child_mother_name', $filter['child_mother_name']);
        }
         if (isset($filter['child_state']) && !empty($filter['child_state'])) {
            $this->db->where('child_state', $filter['child_state']);
        }
         if (isset($filter['child_district']) && !empty($filter['child_district'])) {
            $this->db->where('child_district', $filter['child_district']);
        }
         if (isset($filter['child_image']) && !empty($filter['child_image'])) {
            $this->db->where('child_image', $filter['child_image']);
        }
         if (isset($filter['child_status']) && is_numeric($filter['child_status'])) {
            $this->db->where('child_status', $filter['child_status']);
        }
         if (isset($filter['child_created_date']) && !empty($filter['child_created_date'])) {
            $this->db->where('child_created_date', $filter['child_created_date']);
        }
         if (isset($filter['child_added_by']) && is_numeric($filter['child_added_by'])) {
            $this->db->where('child_added_by', $filter['child_added_by']);
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
