<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_download_sn_model extends Base_Model {

	var $fieldmap_daftar = array();
	var $column_order = array(null);
	var $column_search = array();

	function __construct()
	{
		parent::__construct();
	}
	
	function build_query_daftar()
	{
		//
	}

	function build_query_form($id=NULL)
	{
		//
	}

	function cek_exist()
	{
		return FALSE;
	}

	function check_duplikasi()
	{
		return TRUE;
	}

	function check_dependency($id)
	{
		return TRUE;
	}
}
?>