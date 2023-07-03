<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video_tutorial_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	var $fieldmap_daftar_1 = array('nama', 'deskripsi');
	var $column_order_1 = array(null, 'nama', 'deskripsi');
	var $column_search_1 = array('nama', 'deskripsi');

	function build_query_daftar_1()
	{
		$this->db->select('*');
		$this->db->from('qa_video_tutorial');
		$this->db->where('kategori', 'REGIONAL');
	}

	var $fieldmap_daftar_2 = array('nama', 'deskripsi');
	var $column_order_2 = array(null, 'nama', 'deskripsi');
	var $column_search_2 = array('nama', 'deskripsi');

	function build_query_daftar_2()
	{
		$this->db->select('*');
		$this->db->from('qa_video_tutorial');
		$this->db->where('kategori', 'BRANCH');
	}

	var $fieldmap_daftar_3 = array('nama', 'deskripsi');
	var $column_order_3 = array(null, 'nama', 'deskripsi');
	var $column_search_3 = array('nama', 'deskripsi');

	function build_query_daftar_3()
	{
		$this->db->select('*');
		$this->db->from('qa_video_tutorial');
		$this->db->where('kategori', 'CLUSTER');
	}

	var $fieldmap_daftar_4 = array('nama', 'deskripsi');
	var $column_order_4 = array(null, 'nama', 'deskripsi');
	var $column_search_4 = array('nama', 'deskripsi');

	function build_query_daftar_4()
	{
		$this->db->select('*');
		$this->db->from('qa_video_tutorial');
		$this->db->where('kategori', 'TAP');
	}

	var $fieldmap_daftar_5 = array('nama', 'deskripsi');
	var $column_order_5 = array(null, 'nama', 'deskripsi');
	var $column_search_5 = array('nama', 'deskripsi');

	function build_query_daftar_5()
	{
		$this->db->select('*');
		$this->db->from('qa_video_tutorial');
		$this->db->where('kategori', 'SALES');
	}

	function get_data_video($id)
	{
		$this->db->select('*');
		$this->db->from('qa_video_tutorial');
		$this->db->where('id', $id);

    $result = $this->db->get();

    return $result->row_array();
	}
}
?>