<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi_sekolah extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'lokasi_sekolah';
		$this->daftar_display = 'List Sekolah';
		$this->form_display = 'Form Sekolah';
		$this->modul_display = 'Sekolah';
		$this->view_list = 'lokasi_sekolah_list_view';
		$this->view_form = 'lokasi_sekolah_form_view';
		$this->view_view = 'lokasi_sekolah_view_view';
		$this->view_download = 'lokasi_sekolah_download_view';
		$this->load->model('Lokasi_sekolah_model', 'data_model');
	}

	function index()
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;
		$data['main_content'] = $this->view_list;

		$this->load->view('partial/template_view', $data);
	}

	function get_daftar_1()
	{
		$id_level = $this->session->userdata('ID_LEVEL');

		$list = $this->data_model->get_datatables_1();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_1;

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			// $row[] = $no;

			if ($id_level == 4)
			{
				$row[] = '<center><div style="width:40px;">
					<button onClick="lihat(\''.$field->id_sekolah.'\')" type="button" class="btn btn-primary btn-sm btn-icon waves-effect waves-themed" title="Lihat">
						<i class="fal fa-eye"></i>
					</button>
				</div></center>';
			}
			else
			{
				$row[] = '<center><div style="width:85px;">
					<a target="_blank" href="https://www.google.com/maps/place/'.$field->latitude.','.$field->longitude.'/@'.$field->latitude.','.$field->longitude.'">
						<button hidden type="button" class="btn btn-primary btn-sm btn-icon waves-effect waves-themed" id="btn-map" title="Lihat MAP">
							<i class="fal fa-map-marker-alt"></i>
						</button>
					</a>
					<button onClick="lihat(\''.$field->id_sekolah.'\')" type="button" class="btn btn-primary btn-sm btn-icon waves-effect waves-themed" title="Lihat">
						<i class="fal fa-eye"></i>
					</button>
					<button onClick="ubah(\''.$field->id_sekolah.'\')" type="button" class="btn btn-success btn-sm btn-icon waves-effect waves-themed" title="Ubah">
						<i class="fal fa-edit"></i>
					</button>
					<button onClick="hapus(\''.$field->id_sekolah.'\')" type="button" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed" title="Hapus">
						<i class="fal fa-trash-alt"></i>
					</button>
				</div></center>';
			}

			$row[] = "<div align='center'>".$field->no_npsn."</div>";
			$row[] = $field->nama_sekolah;
			$row[] = $field->nama_kecamatan;
			$row[] = $field->nama_cluster;
			$row[] = $field->nama_branch;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_1(),
			"recordsFiltered" => $this->data_model->count_filtered_1(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_daftar_2()
	{
		$id_level = $this->session->userdata('ID_LEVEL');

		$list = $this->data_model->get_datatables_2();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_2;

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			// $row[] = $no;

			if ($id_level == 4)
			{
				$row[] = '<center><div style="width:40px;">
					<button onClick="lihat(\''.$field->id_sekolah.'\')" type="button" class="btn btn-primary btn-sm btn-icon waves-effect waves-themed" title="Lihat">
						<i class="fal fa-eye"></i>
					</button>
				</div></center>';
			}
			else
			{
				$row[] = '<center><div style="width:85px;">
					<button onClick="lihat(\''.$field->id_sekolah.'\')" type="button" class="btn btn-primary btn-sm btn-icon waves-effect waves-themed" title="Lihat">
						<i class="fal fa-eye"></i>
					</button>
					<button onClick="approved(\''.$field->id_sekolah.'\')" type="button" class="btn btn-success btn-sm btn-icon waves-effect waves-themed" title="Approved">
						<i class="fal fa-check-square"></i>
					</button>
					<button onClick="rejected(\''.$field->id_sekolah.'\')" type="button" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed" title="Rejected">
						<i class="fal fa-window-close"></i>
					</button>
				</div></center>';
			}

			$row[] = "<div align='center'>".$field->no_npsn."</div>";
			$row[] = $field->nama_sekolah;
			$row[] = $field->nama_kecamatan;
			$row[] = $field->nama_cluster;
			$row[] = $field->nama_branch;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_2(),
			"recordsFiltered" => $this->data_model->count_filtered_2(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_daftar_3()
	{
		$id_level = $this->session->userdata('ID_LEVEL');

		$list = $this->data_model->get_datatables_3();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_3;

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			// $row[] = $no;

			if ($id_level == 4)
			{
				$row[] = '<center><div style="width:40px;">
					<button onClick="lihat(\''.$field->id_sekolah.'\')" type="button" class="btn btn-success btn-sm btn-icon waves-effect waves-themed" title="Lihat">
						<i class="fal fa-eye"></i>
					</button>
				</div></center>';
			}
			else
			{
				$row[] = '<center><div style="width:40px;">
					<button onClick="lihat(\''.$field->id_sekolah.'\')" type="button" class="btn btn-success btn-sm btn-icon waves-effect waves-themed" title="Lihat">
						<i class="fal fa-eye"></i>
					</button>
				</div></center>';
			}

			$row[] = "<div align='center'>".$field->no_npsn."</div>";
			$row[] = $field->nama_sekolah;
			$row[] = $field->nama_kecamatan;
			$row[] = $field->nama_cluster;
			$row[] = $field->nama_branch;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_3(),
			"recordsFiltered" => $this->data_model->count_filtered_3(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_daftar_4()
	{
		$list = $this->data_model->get_datatables_4();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_4;

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			// $row[] = $no;

			$row[] = "<div align='center'>".$field->no_npsn."</div>";;
			$row[] = $field->nama_sekolah;
			$row[] = $field->nama_kecamatan;
			$row[] = $field->nama_cluster;
			$row[] = $field->nama_branch;
			$row[] = "<div align='center'>".substr($field->tgl_close,8,2)."/".substr($field->tgl_close,5,2)."/".substr($field->tgl_close,0,4)."</div>";
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_4(),
			"recordsFiltered" => $this->data_model->count_filtered_4(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_daftar_5()
	{
		$list = $this->data_model->get_datatables_5();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_5;

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			// $row[] = $no;

			$row[] = "<div align='center'>".$field->tanggal."</div>";
			$row[] = "<div align='left'>".$field->nama_sales."</div>";
			$row[] = "<div align='center'>".$field->jam_clock_in."</div>";
			$row[] = "<div align='center'>".$field->jam_clock_out."</div>";
			$row[] = "<div align='center'>".$field->durasi."</div>";
			if($field->status == 'OPEN')
			{
			    $row[] = '<div align="center"><span class="badge badge-success badge-pill">'.$field->status.'</span></div>';
			}else{
			    $row[] = '<div align="center"><span class="badge badge-danger badge-pill">'.$field->status.'</span></div>';
			}

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_5(),
			"recordsFiltered" => $this->data_model->count_filtered_5(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_daftar_6()
	{
		$list = $this->data_model->get_datatables_6();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_6;

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			// $row[] = $no;

			$row[] = "<div align='center'>".$field->tanggal."</div>";
			$row[] = "<div align='left'>".$field->nama_sales."</div>";

			if ($field->total_perdana > 0)
			{
				$row[] = '<a href="javascript:void(0);" onClick="lihat_distribusi(\''.$field->tgl_transaksi.'\', \''.$field->id_sales.'\', \'perdana\')">
									<div align="right">'.format_integer($field->total_perdana).'</div>
								</a>';
			}
			else
			{
				$row[] = '<div align="right">0</div>';
			}

			if ($field->total_voucher > 0)
			{
				$row[] = '<a href="javascript:void(0);" onClick="lihat_distribusi(\''.$field->tgl_transaksi.'\', \''.$field->id_sales.'\', \'voucher\')">
									<div align="right">'.format_integer($field->total_voucher).'</div>
								</a>';
			}
			else
			{
				$row[] = '<div align="right">0</div>';
			}

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_6(),
			"recordsFiltered" => $this->data_model->count_filtered_6(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_daftar_7()
	{
		$list = $this->data_model->get_datatables_7();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_7;

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			// $row[] = $no;

			$row[] = "<div align='center'>".$field->tanggal."</div>";
			$row[] = "<div align='left'>".$field->nama_sales."</div>";

			$row[] = '<a href="javascript:void(0);" onClick="lihat_merchandising(\''.$field->tgl.'\', \''.$field->id_sales.'\', \'PERDANA\')">
									<div align="right">'.format_currency($field->total_perdana).' %</div>
								</a>';
			$row[] = '<a href="javascript:void(0);" onClick="lihat_merchandising(\''.$field->tgl.'\', \''.$field->id_sales.'\', \'VOUCHER_FISIK\')">
									<div align="right">'.format_currency($field->total_voucher_fisik).' %</div>
								</a>';
			$row[] = '<a href="javascript:void(0);" onClick="lihat_merchandising(\''.$field->tgl.'\', \''.$field->id_sales.'\', \'SPANDUK\')">
									<div align="right">'.format_currency($field->total_spanduk).' %</div>
								</a>';
			$row[] = '<a href="javascript:void(0);" onClick="lihat_merchandising(\''.$field->tgl.'\', \''.$field->id_sales.'\', \'POSTER\')">
									<div align="right">'.format_currency($field->total_poster).' %</div>
								</a>';
			$row[] = '<a href="javascript:void(0);" onClick="lihat_merchandising(\''.$field->tgl.'\', \''.$field->id_sales.'\', \'PAPAN_NAMA\')">
									<div align="right">'.format_currency($field->total_papan_nama).' %</div>
								</a>';
			$row[] = '<a href="javascript:void(0);" onClick="lihat_merchandising(\''.$field->tgl.'\', \''.$field->id_sales.'\', \'BACKDROP\')">
									<div align="right">'.format_currency($field->total_backdrop).' %</div>
								</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_7(),
			"recordsFiltered" => $this->data_model->count_filtered_7(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_daftar_8()
	{
		$list = $this->data_model->get_datatables_8();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_8;

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			// $row[] = $no;

			$row[] = "<div align='center'>".$field->tanggal."</div>";
			$row[] = "<div align='left'>".$field->nama_sales."</div>";

			$row[] = '<a href="javascript:void(0);" onClick="lihat_promotion(\''.$field->tgl.'\', \''.$field->id_sales.'\')">
									<div align="right">'.format_integer($field->jml_promotion).'</div>
								</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_8(),
			"recordsFiltered" => $this->data_model->count_filtered_8(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function form($id=0)
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;
		$data['main_content'] = $this->view_form;

		$id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

		if ($id !== 0)
		{
			$data['data'] = $this->data_model->get_data_by_id($id);
		}

		$this->load->view('partial/template_view', $data);
	}

	function lihat($id=0)
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;
		$data['main_content'] = $this->view_view;

		$id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

		if ($id !== 0)
		{
			$data['data'] = $this->data_model->get_data_by_id($id);
		}

		$this->load->view('partial/template_view', $data);
	}

	function distribusi()
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;
		$data['main_content'] = $this->view_view;

		$tgl = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$id_sales = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$id_lokasi = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$jns_produk = $this->uri->segment(6) ? $this->uri->segment(6) : 'perdana';

		$data['list_distribusi'] = $this->data_model->get_list_distribusi($tgl, $id_sales, $id_lokasi, $jns_produk);

		$this->load->view('distribusi_form_view', $data);
	}

	function merchandising($id=0)
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;
		$data['main_content'] = $this->view_view;

		$data['tgl'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['id_sales'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['id_lokasi'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['id_jenis_share'] = $this->uri->segment(6) ? $this->uri->segment(6) : '-';

		$data['data_merchandising'] = $this->data_model->get_data_merchandising_res($data['tgl'], $data['id_lokasi'], $data['id_jenis_share'], $data['id_sales']);

		$this->load->view('merchandising_form_view', $data);
	}

	function get_data_merchandising()
  {
    $result = $this->data_model->get_data_merchandising();

		$response = (object) NULL;
    $response->sql = $this->db->queries;
    $response->telkomsel = isset($result['telkomsel']) ? format_integer($result['telkomsel']) : 0;
    $response->isat = isset($result['isat']) ? format_integer($result['isat']) : 0;
    $response->xl = isset($result['xl']) ? format_integer($result['xl']) : 0;
    $response->tri = isset($result['tri']) ? format_integer($result['tri']) : 0;
    $response->smartfren = isset($result['smartfren']) ? format_integer($result['smartfren']) : 0;
    $response->axis = isset($result['axis']) ? format_integer($result['axis']) : 0;
    $response->other = isset($result['other']) ? format_integer($result['other']) : 0;
    $response->total = isset($result['total']) ? format_integer($result['total']) : 0;
    $response->foto_1 = isset($result['foto_1']) ? $result['foto_1'] : 0;
    $response->foto_2 = isset($result['foto_2']) ? $result['foto_2'] : 0;
    $response->foto_3 = isset($result['foto_3']) ? $result['foto_3'] : 0;

		echo json_encode($response);
  }

	function promotion($id=0)
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;

		$tgl = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$id_sales = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$id_lokasi = $this->uri->segment(5) ? $this->uri->segment(5) : 0;

		if ($tgl !== NULL)
		{
			$data['list_promotion'] = $this->data_model->get_list_promotion($tgl, $id_sales, $id_lokasi);
		}

		$this->load->view('promotion_form_view', $data);
	}

	function validasi_form()
	{
		$this->form_validation->set_rules('id', 'Id', 'required|trim');

		$this->form_validation->set_message('required', '%s tidak boleh kosong.');
		$this->form_validation->set_message('min_length', 'Minimal %s tiga (3) karakter.');
		$this->form_validation->set_message('max_length', '%s tidak boleh melebihi %s karakter.');
		$this->form_validation->set_message('integer', '%s harus angka.');
		$this->form_validation->set_message('_cek_duplikasi', '%s sudah ada.');
	}

	function _cek_duplikasi()
	{
		return $this->data_model->check_duplikasi();
	}

	function proses_reject()
	{
		$response = (object) NULL;
		$success = $this->data_model->save_data_reject();

		if($success)
		{
			$response->isSuccess = TRUE;
			$response->message = 'Data berhasil disimpan';
			$response->error = NULL;
			$response->sql = $this->db->queries;
		}
		else
		{
			$response->isSuccess = FALSE;
			$response->message = 'Data gagal disimpan';
			$response->error = $this->data_model->last_error_message;
			$response->sql = $this->db->queries;
		}

		echo json_encode($response);
	}

	function approved($id=0)
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;

		$data['id_sekolah'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

		$this->load->view('approved_form_view', $data);
	}

	function proses_approved()
	{
		$response = (object) NULL;
		$success = $this->data_model->save_data_approved();

		if($success)
		{
			$response->isSuccess = TRUE;
			$response->message = 'Data berhasil disimpan';
			$response->error = NULL;
			$response->sql = $this->db->queries;
		}
		else
		{
			$response->isSuccess = FALSE;
			$response->message = 'Data gagal disimpan';
			$response->error = $this->data_model->last_error_message;
			$response->sql = $this->db->queries;
		}

		echo json_encode($response);
	}
}
?>