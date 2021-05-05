<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Default_model extends CI_Model {

    public function get_all($t) {
        return $this->db->get($t);
    }

    public function get_all_order($t, $o = '') {
        $o = !empty($o) ? $o : 'id DESC';
        return $this->db->select("*")->order_by($o)->get($t);
    }

    public function get_all_where($t, $w) {
        return $this->db->get_where($t, $w);
    }

    function get_all_where_order($t, $w, $o = '') {
        $o = !empty($o) ? $o : 'id DESC';
        return $this->db->select("*")->order_by($o)->get_where($t, $w);
    }
	
	function get_all_where_order_w_in($t, $f, $w,$o = '') {
        $o = !empty($o) ? $o : 'id DESC';
		return $this->db->select("*")->order_by($o)->where_in($f, $w)->get($t);
    }

    function get_all_where_order_not_in($t, $w, $f, $not, $o = '') {
        $o = !empty($o) ? $o : 'id DESC';
        return $this->db->select("*")->order_by($o)->where_not_in($f, $not)->get_where($t, $w);
    }

    function get_all_where_order_ntfs($t, $w, $o = '') {
        $o = !empty($o) ? $o : 'id DESC';
        return $this->db->select("*")->order_by($o)->get_where($t, $w, 5);
    }

    public function get_one_where($t, $w) {
        return $this->db->get_where($t, $w)->row();
    }

    public function add_item($t, $v = array()) {
        $this->db->insert($t, $v);
        return $this->db->insert_id();
    }

    public function add_items($t, $v = array()) {
        $this->db->insert_batch($t, $v);
    }

    public function update_item($t, $f, $c, $v) {
        $this->db->update($t, $v, array($f => $c));
    }

    public function delete_item($t, $f, $c) {
        $this->db->delete($t, array($f => $c));
    }

    function default_count_all_elements($t) {
        return $this->db->count_all($t);
    }

    function default_count_all_elements_where($t, $w) {
        $this->db->where($w);
        $this->db->from($t);
        return $this->db->count_all_results();
    }

    function query_execute($sql) {
        return $this->db->query($sql);
    }

}
