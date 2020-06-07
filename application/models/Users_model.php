<?php

// models/User.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {


    function __construct() {
        parent::__construct();
        $this->_tableName = 'rms_users';
        $this->load->database();
    }
    public function addRow($tableName, $insertData) {
        $this->db->insert($tableName, $insertData);
       
        return $this->db->insert_id();
    }

    public function updateRow($tableName, $updateData, $whereData) {
        return $this->db->update($tableName, $updateData, $whereData);
    }

    public function deleteRow($tableName, $whereData) {
        return $this->db->delete($tableName, $whereData);
    }
    public function getUserList($filter = array()) {

        $this->db->select('rms_id,rms_user,rms_status,rms_created_date,rms_full_name as name,rms_organization as organization,rms_designation as designation');


        if (isset($filter['rms_id']) && is_numeric($filter['rms_id'])) {
            $this->db->where('rms_id', $filter['rms_id']);
        }
        if (isset($filter['rms_user']) && !empty($filter['rms_user'])) {
            $this->db->where('rms_user', $filter['rms_user']);
        }
        if (isset($filter['rms_password']) && !empty($filter['rms_password'])) {
            $this->db->where('rms_password', $filter['rms_password']);
        }
        if (isset($filter['rms_status']) && !empty($filter['rms_status'])) {
            $this->db->where('rms_status', $filter['rms_status']);
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
    
    public function getLoginList($filter = array()) {

        $this->db->select('login_id,login_user_id,login_time,login_status');


        if (isset($filter['login_id']) && is_numeric($filter['login_id'])) {
            $this->db->where('login_id', $filter['login_id']);
        }
        if (isset($filter['login_user_id']) && !empty($filter['login_user_id'])) {
            $this->db->where('login_user_id', $filter['login_user_id']);
        }
        if (isset($filter['login_status']) && !empty($filter['login_status'])) {
            $this->db->where('login_status', $filter['login_status']);
        }
        if (isset($filter['login_time']) && !empty($filter['login_time'])) {
            $this->db->where('login_time', $filter['login_time']);
        }

        if (isset($filter['order_by']) && !empty($filter['order_by'])) {
            $this->db->order_by($filter['order_by']);
        }
        if (isset($filter['offset']) && isset($filter['limit'])) {
            $this->db->limit($filter['limit'], $filter['offset']);
        }
    
        $query = $this->db->get('rms_login');

        if (isset($filter['count']) && $filter['count']) {
            return $query->num_rows();
        }

        if (isset($filter['single']) && $filter['single']) {
            return $query->row();
        }

        return $query->result();
        
    }
     

}
