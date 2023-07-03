<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_Model extends CI_Model {
	var $id;
	var $nomor;
	var $fieldmap_daftar;
	var $fieldmap_filter;
	var $last_changed;
	var $last_error_id;
	var $last_error_message;

	function __construct()
	{
		parent::__construct();
	}

  function get_data_fields()
  {
		// di override
  }

  function fill_data()
  {
		// di override
  }

	function cek_exist()
	{
		// di override
	}

	function cek_changed()
	{
		// di override
	}

  function check_trans_status($exception)
  {
    if ($this->db->trans_status() === FALSE){
      throw new Exception($exception);
    }
  }

  function save_data()
  {
    $this->db->trans_begin();
    try {
      $this->save_detail();
    }
    catch(Exception $e){
      // TODO : log error to file
    }

    if ($this->db->trans_status() === FALSE)
    {
      $this->id = NULL;
			$this->nomor = NULL;
      $this->last_error_message = $this->db->error();
      $this->db->trans_rollback();
      return FALSE;
    }

    $this->db->trans_commit();

    return TRUE;
  }

  function delete_data($id)
  {
    $this->db->trans_begin();
    try {
      $this->build_query_hapus($id);
    }
    catch(Exception $e){
      // TODO : log error to file
    }

    if ($this->db->trans_status() === FALSE)
    {
			$this->last_error_message = $this->db->error();
      $this->db->trans_rollback();
      return FALSE;
    }

    $this->db->trans_commit();
    return TRUE;
  }

  function build_query_daftar()
  {
    // di override di modul
  }

  function build_query_form($id=0)
  {
    // di override di modul
  }

  function build_query_hapus()
  {
    // di override di modul
  }

  function _get_datatables_query()
  {
    $this->build_query_daftar();

		$i = 0;

		foreach ($this->column_search as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i)
				$this->db->group_end();
			}

			$i++;
		}

		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
  }

	function get_datatables()
	{
		$this->_get_datatables_query();

		if($_POST['length'] != -1)
		{
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();

		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();

		return $query->num_rows();
	}

	function count_all()
	{
		$this->build_query_daftar();

		return $this->db->count_all_results();
	}

	function _get_datatables_query_1()
  {
    $this->build_query_daftar_1();

		$i = 0;

		foreach ($this->column_search_1 as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search_1) - 1 == $i)
				$this->db->group_end();
			}

			$i++;
		}

		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_1[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
  }

	function get_datatables_1()
	{
		$this->_get_datatables_query_1();

		if($_POST['length'] != -1)
		{
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();

		return $query->result();
	}

	function count_filtered_1()
	{
		$this->_get_datatables_query_1();
		$query = $this->db->get();

		return $query->num_rows();
	}

	function count_all_1()
	{
		$this->build_query_daftar_1();

		return $this->db->count_all_results();
	}

	function _get_datatables_query_2()
  {
    $this->build_query_daftar_2();

		$i = 0;

		foreach ($this->column_search_2 as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search_2) - 1 == $i)
				$this->db->group_end();
			}

			$i++;
		}

		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
  }

	function get_datatables_2()
	{
		$this->_get_datatables_query_2();

		if($_POST['length'] != -1)
		{
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();

		return $query->result();
	}

	function count_filtered_2()
	{
		$this->_get_datatables_query_2();
		$query = $this->db->get();

		return $query->num_rows();
	}

	function count_all_2()
	{
		$this->build_query_daftar_2();

		return $this->db->count_all_results();
	}

	function _get_datatables_query_3()
  {
    $this->build_query_daftar_3();

		$i = 0;

		foreach ($this->column_search_3 as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search_3) - 1 == $i)
				$this->db->group_end();
			}

			$i++;
		}

		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_3[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
  }

	function get_datatables_3()
	{
		$this->_get_datatables_query_3();

		if($_POST['length'] != -1)
		{
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();

		return $query->result();
	}

	function count_filtered_3()
	{
		$this->_get_datatables_query_3();
		$query = $this->db->get();

		return $query->num_rows();
	}

	function count_all_3()
	{
		$this->build_query_daftar_3();

		return $this->db->count_all_results();
	}

	function _get_datatables_query_4()
  {
    $this->build_query_daftar_4();

		$i = 0;

		foreach ($this->column_search_4 as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search_4) - 1 == $i)
				$this->db->group_end();
			}

			$i++;
		}

		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_4[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
  }

	function get_datatables_4()
	{
		$this->_get_datatables_query_4();

		if($_POST['length'] != -1)
		{
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();

		return $query->result();
	}

	function count_filtered_4()
	{
		$this->_get_datatables_query_4();
		$query = $this->db->get();

		return $query->num_rows();
	}

	function count_all_4()
	{
		$this->build_query_daftar_4();

		return $this->db->count_all_results();
	}

	function _get_datatables_query_5()
  {
    $this->build_query_daftar_5();

		$i = 0;

		foreach ($this->column_search_5 as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search_5) - 1 == $i)
				$this->db->group_end();
			}

			$i++;
		}

		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_5[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
  }

	function get_datatables_5()
	{
		$this->_get_datatables_query_5();

		if($_POST['length'] != -1)
		{
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();

		return $query->result();
	}

	function count_filtered_5()
	{
		$this->_get_datatables_query_5();
		$query = $this->db->get();

		return $query->num_rows();
	}

	function count_all_5()
	{
		$this->build_query_daftar_5();

		return $this->db->count_all_results();
	}

	function _get_datatables_query_6()
  {
    $this->build_query_daftar_6();

		$i = 0;

		foreach ($this->column_search_6 as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search_6) - 1 == $i)
				$this->db->group_end();
			}

			$i++;
		}

		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_6[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
  }

	function get_datatables_6()
	{
		$this->_get_datatables_query_6();

		if($_POST['length'] != -1)
		{
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();

		return $query->result();
	}

	function count_filtered_6()
	{
		$this->_get_datatables_query_6();
		$query = $this->db->get();

		return $query->num_rows();
	}

	function count_all_6()
	{
		$this->build_query_daftar_6();

		return $this->db->count_all_results();
	}

	function _get_datatables_query_7()
  {
    $this->build_query_daftar_7();

		$i = 0;

		foreach ($this->column_search_7 as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search_7) - 1 == $i)
				$this->db->group_end();
			}

			$i++;
		}

		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_7[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
  }

	function get_datatables_7()
	{
		$this->_get_datatables_query_7();

		if($_POST['length'] != -1)
		{
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();

		return $query->result();
	}

	function count_filtered_7()
	{
		$this->_get_datatables_query_7();
		$query = $this->db->get();

		return $query->num_rows();
	}

	function count_all_7()
	{
		$this->build_query_daftar_7();

		return $this->db->count_all_results();
	}

	function _get_datatables_query_8()
  {
    $this->build_query_daftar_8();

		$i = 0;

		foreach ($this->column_search_8 as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search_8) - 1 == $i)
				$this->db->group_end();
			}

			$i++;
		}

		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_8[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
  }

	function get_datatables_8()
	{
		$this->_get_datatables_query_8();

		if($_POST['length'] != -1)
		{
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();

		return $query->result();
	}

	function count_filtered_8()
	{
		$this->_get_datatables_query_8();
		$query = $this->db->get();

		return $query->num_rows();
	}

	function count_all_8()
	{
		$this->build_query_daftar_8();

		return $this->db->count_all_results();
	}

	function _get_datatables_query_9()
  {
    $this->build_query_daftar_9();

		$i = 0;

		foreach ($this->column_search_9 as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search_9) - 1 == $i)
				$this->db->group_end();
			}

			$i++;
		}

		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_9[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
  }

	function get_datatables_9()
	{
		$this->_get_datatables_query_9();

		if($_POST['length'] != -1)
		{
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();

		return $query->result();
	}

	function count_filtered_9()
	{
		$this->_get_datatables_query_9();
		$query = $this->db->get();

		return $query->num_rows();
	}

	function count_all_9()
	{
		$this->build_query_daftar_9();

		return $this->db->count_all_results();
	}

	function _get_datatables_query_10()
  {
    $this->build_query_daftar_10();

		$i = 0;

		foreach ($this->column_search_10 as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search_10) - 1 == $i)
				$this->db->group_end();
			}

			$i++;
		}

		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_10[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
  }

	function get_datatables_10()
	{
		$this->_get_datatables_query_10();

		if($_POST['length'] != -1)
		{
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();

		return $query->result();
	}

	function count_filtered_10()
	{
		$this->_get_datatables_query_10();
		$query = $this->db->get();

		return $query->num_rows();
	}

	function count_all_10()
	{
		$this->build_query_daftar_10();

		return $this->db->count_all_results();
	}

	function _get_datatables_query_11()
  {
    $this->build_query_daftar_11();

		$i = 0;

		foreach ($this->column_search_11 as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search_11) - 1 == $i)
				$this->db->group_end();
			}

			$i++;
		}

		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_11[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
  }

	function get_datatables_11()
	{
		$this->_get_datatables_query_11();

		if($_POST['length'] != -1)
		{
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();

		return $query->result();
	}

	function count_filtered_11()
	{
		$this->_get_datatables_query_11();
		$query = $this->db->get();

		return $query->num_rows();
	}

	function count_all_11()
	{
		$this->build_query_daftar_11();

		return $this->db->count_all_results();
	}

	function _get_datatables_query_12()
  {
    $this->build_query_daftar_12();

		$i = 0;

		foreach ($this->column_search_12 as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search_12) - 1 == $i)
				$this->db->group_end();
			}

			$i++;
		}

		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_11[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
  }

	function get_datatables_12()
	{
		$this->_get_datatables_query_12();

		if($_POST['length'] != -1)
		{
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();

		return $query->result();
	}

	function count_filtered_12()
	{
		$this->_get_datatables_query_12();
		$query = $this->db->get();

		return $query->num_rows();
	}

	function count_all_12()
	{
		$this->build_query_daftar_12();

		return $this->db->count_all_results();
	}

	function _get_datatables_query_13()
  {
    $this->build_query_daftar_13();

		$i = 0;

		foreach ($this->column_search_13 as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search_13) - 1 == $i)
				$this->db->group_end();
			}

			$i++;
		}

		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_13[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
  }

	function get_datatables_13()
	{
		$this->_get_datatables_query_13();

		if($_POST['length'] != -1)
		{
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();

		return $query->result();
	}

	function count_filtered_13()
	{
		$this->_get_datatables_query_13();
		$query = $this->db->get();

		return $query->num_rows();
	}

	function count_all_13()
	{
		$this->build_query_daftar_13();

		return $this->db->count_all_results();
	}

	function _get_datatables_query_14()
  {
    $this->build_query_daftar_14();

		$i = 0;

		foreach ($this->column_search_14 as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search_14) - 1 == $i)
				$this->db->group_end();
			}

			$i++;
		}

		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_14[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
  }

	function get_datatables_14()
	{
		$this->_get_datatables_query_14();

		if($_POST['length'] != -1)
		{
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();

		return $query->result();
	}

	function count_filtered_14()
	{
		$this->_get_datatables_query_14();
		$query = $this->db->get();

		return $query->num_rows();
	}

	function count_all_14()
	{
		$this->build_query_daftar_14();

		return $this->db->count_all_results();
	}

	function _get_datatables_query_15()
  {
    $this->build_query_daftar_15();

		$i = 0;

		foreach ($this->column_search_15 as $item)
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search_15) - 1 == $i)
				$this->db->group_end();
			}

			$i++;
		}

		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order_15[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
  }

	function get_datatables_15()
	{
		$this->_get_datatables_query_15();

		if($_POST['length'] != -1)
		{
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();

		return $query->result();
	}

	function count_filtered_15()
	{
		$this->_get_datatables_query_15();
		$query = $this->db->get();

		return $query->num_rows();
	}

	function count_all_15()
	{
		$this->build_query_daftar_15();

		return $this->db->count_all_results();
	}

  function get_data_by_id($id)
  {
    $this->build_query_form($id);
    $result = $this->db->get()->row_array();

    return $result;
  }

	function format_nomor($nomor, $panjang)
	{
    $pjg_kar = strlen($nomor);
    $rpt = $panjang - $pjg_kar;
    $prev = '';

    if($rpt > 0)
		{
      for($u=0;$u<$rpt;$u++)
			{
        $prev.="0";
      }
      $no_transaksi = $prev.$nomor;
    }
    else
		{
      $no_transaksi = $nomor;
    }

    return $no_transaksi;
  }

	function check_length_sn($no, $panjang)
  {
		$length = strlen((string)$no);

		for($i=$length;$i<$panjang;$i++)
		{
			$no = '0'.$no;
		}

		return $no;
	}

	function get_ip_address()
	{
    if(!empty($_SERVER['HTTP_CLIENT_IP']))
		{
      $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    }
		else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
      $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
		else
		{
      $ip_address = $_SERVER['REMOTE_ADDR'];
    }

    $this->ip_address = $ip_address;
  }

	function bd_main_tap($modul, $aksi, $aktivitas, $created_by)
  {
		date_default_timezone_set('Asia/Jakarta');

		$this->get_ip_address();

		$ip_address = $this->ip_address ? $this->ip_address : 0;

		$data_x = array(
			'modul' => $modul,
			'aksi' => $aksi,
			'aktivitas' => $aktivitas,
			'ip_address' => $ip_address,
			'created_by' => $created_by,
			'created_time' => date('Y-m-d H:i:s')
		);

		$this->db->insert('bd_main_tap', $data_x);
  }
}