<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voice_of_reseller_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_list_pertanyaan_1($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
	{
		$where = '';

		if ($pilperiode == 'Yearly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'"';
		}
		else if ($pilperiode == 'Quartely')
		{
			if ($bulan_kuartal == '01-03')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (1, 2, 3)';
			}
			else if ($bulan_kuartal == '04-06')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (4, 5, 6)';
			}
			else if ($bulan_kuartal == '07-09')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (7, 8, 9)';
			}
			else if ($bulan_kuartal == '10-12')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (10, 11, 12)';
			}
		}
		else if ($pilperiode == 'Monthly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'"';
		}
		else if ($pilperiode == 'Weekly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'" AND xp.minggu = "'.(int) $minggu.'"';
		}

		$this->db->select('
			xx.id
			, xx.id_pertanyaan
			, xx.nama
			, xx.total
		');
		$this->db->from('
			(
					SELECT
							p.id
							, p.id_pertanyaan
							, p.pilihan AS nama
							, (
										SELECT
												COUNT(xp.id)
										FROM
												za_voiceofreseller xp
												INNER JOIN eb_outlet xo
														ON (xp.id_outlet = xo.id_outlet)
										WHERE ('.$where.'
												AND xo.id_tap = "'.$id_tap.'"
												AND xp.id_pilihan_1 = p.id)
								) AS total
					FROM
							za_voiceofreseller_pilihan p
					WHERE (p.id_pertanyaan = 1
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get();

		return $result->result();
	}

	function get_data_pertanyaan_1($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
	{
		$where = '';

		if ($pilperiode == 'Yearly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'"';
		}
		else if ($pilperiode == 'Quartely')
		{
			if ($bulan_kuartal == '01-03')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (1, 2, 3)';
			}
			else if ($bulan_kuartal == '04-06')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (4, 5, 6)';
			}
			else if ($bulan_kuartal == '07-09')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (7, 8, 9)';
			}
			else if ($bulan_kuartal == '10-12')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (10, 11, 12)';
			}
		}
		else if ($pilperiode == 'Monthly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'"';
		}
		else if ($pilperiode == 'Weekly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'" AND xp.minggu = "'.(int) $minggu.'"';
		}

		$this->db->select('
			COALESCE(SUM(xx.total), 0) AS x_total
		');
		$this->db->from('
			(
					SELECT
							p.id
							, p.id_pertanyaan
							, p.pilihan AS nama
							, (
										SELECT
												COUNT(xp.id)
										FROM
												za_voiceofreseller xp
												INNER JOIN eb_outlet xo
														ON (xp.id_outlet = xo.id_outlet)
										WHERE ('.$where.'
												AND xo.id_tap = "'.$id_tap.'"
												AND xp.id_pilihan_1 = p.id)
								) AS total
					FROM
							za_voiceofreseller_pilihan p
					WHERE (p.id_pertanyaan = 1
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get()->row_array();

    return $result;
	}

	function get_list_pertanyaan_2($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
	{
		$where = '';

		if ($pilperiode == 'Yearly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'"';
		}
		else if ($pilperiode == 'Quartely')
		{
			if ($bulan_kuartal == '01-03')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (1, 2, 3)';
			}
			else if ($bulan_kuartal == '04-06')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (4, 5, 6)';
			}
			else if ($bulan_kuartal == '07-09')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (7, 8, 9)';
			}
			else if ($bulan_kuartal == '10-12')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (10, 11, 12)';
			}
		}
		else if ($pilperiode == 'Monthly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'"';
		}
		else if ($pilperiode == 'Weekly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'" AND xp.minggu = "'.(int) $minggu.'"';
		}

		$this->db->select('
			xx.id
			, xx.id_pertanyaan
			, xx.nama
			, xx.total
		');
		$this->db->from('
			(
					SELECT
							p.id
							, p.id_pertanyaan
							, p.pilihan AS nama
							, (
										SELECT
												COUNT(xp.id)
										FROM
												za_voiceofreseller xp
												INNER JOIN eb_outlet xo
														ON (xp.id_outlet = xo.id_outlet)
										WHERE ('.$where.'
												AND xo.id_tap = "'.$id_tap.'"
												AND xp.id_pilihan_2 = p.id)
								) AS total
					FROM
							za_voiceofreseller_pilihan p
					WHERE (p.id_pertanyaan = 2
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get();

		return $result->result();
	}

	function get_data_pertanyaan_2($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
	{
		$where = '';

		if ($pilperiode == 'Yearly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'"';
		}
		else if ($pilperiode == 'Quartely')
		{
			if ($bulan_kuartal == '01-03')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (1, 2, 3)';
			}
			else if ($bulan_kuartal == '04-06')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (4, 5, 6)';
			}
			else if ($bulan_kuartal == '07-09')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (7, 8, 9)';
			}
			else if ($bulan_kuartal == '10-12')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (10, 11, 12)';
			}
		}
		else if ($pilperiode == 'Monthly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'"';
		}
		else if ($pilperiode == 'Weekly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'" AND xp.minggu = "'.(int) $minggu.'"';
		}

		$this->db->select('
			COALESCE(SUM(xx.total), 0) AS x_total
		');
		$this->db->from('
			(
					SELECT
							p.id
							, p.id_pertanyaan
							, p.pilihan AS nama
							, (
										SELECT
												COUNT(xp.id)
										FROM
												za_voiceofreseller xp
												INNER JOIN eb_outlet xo
														ON (xp.id_outlet = xo.id_outlet)
										WHERE ('.$where.'
												AND xo.id_tap = "'.$id_tap.'"
												AND xp.id_pilihan_2 = p.id)
								) AS total
					FROM
							za_voiceofreseller_pilihan p
					WHERE (p.id_pertanyaan = 2
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get()->row_array();

    return $result;
	}

	function get_list_pertanyaan_3($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
	{
		$where = '';

		if ($pilperiode == 'Yearly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'"';
		}
		else if ($pilperiode == 'Quartely')
		{
			if ($bulan_kuartal == '01-03')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (1, 2, 3)';
			}
			else if ($bulan_kuartal == '04-06')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (4, 5, 6)';
			}
			else if ($bulan_kuartal == '07-09')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (7, 8, 9)';
			}
			else if ($bulan_kuartal == '10-12')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (10, 11, 12)';
			}
		}
		else if ($pilperiode == 'Monthly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'"';
		}
		else if ($pilperiode == 'Weekly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'" AND xp.minggu = "'.(int) $minggu.'"';
		}

		$this->db->select('
			xx.id
			, xx.id_pertanyaan
			, xx.nama
			, xx.total
		');
		$this->db->from('
			(
					SELECT
							p.id
							, p.id_pertanyaan
							, p.pilihan AS nama
							, (
										SELECT
												COUNT(xp.id)
										FROM
												za_voiceofreseller xp
												INNER JOIN eb_outlet xo
														ON (xp.id_outlet = xo.id_outlet)
										WHERE ('.$where.'
												AND xo.id_tap = "'.$id_tap.'"
												AND xp.id_pilihan_3 = p.id)
								) AS total
					FROM
							za_voiceofreseller_pilihan p
					WHERE (p.id_pertanyaan = 3
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get();

		return $result->result();
	}

	function get_data_pertanyaan_3($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
	{
		$where = '';

		if ($pilperiode == 'Yearly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'"';
		}
		else if ($pilperiode == 'Quartely')
		{
			if ($bulan_kuartal == '01-03')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (1, 2, 3)';
			}
			else if ($bulan_kuartal == '04-06')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (4, 5, 6)';
			}
			else if ($bulan_kuartal == '07-09')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (7, 8, 9)';
			}
			else if ($bulan_kuartal == '10-12')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (10, 11, 12)';
			}
		}
		else if ($pilperiode == 'Monthly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'"';
		}
		else if ($pilperiode == 'Weekly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'" AND xp.minggu = "'.(int) $minggu.'"';
		}

		$this->db->select('
			COALESCE(SUM(xx.total), 0) AS x_total
		');
		$this->db->from('
			(
					SELECT
							p.id
							, p.id_pertanyaan
							, p.pilihan AS nama
							, (
										SELECT
												COUNT(xp.id)
										FROM
												za_voiceofreseller xp
												INNER JOIN eb_outlet xo
														ON (xp.id_outlet = xo.id_outlet)
										WHERE ('.$where.'
												AND xo.id_tap = "'.$id_tap.'"
												AND xp.id_pilihan_3 = p.id)
								) AS total
					FROM
							za_voiceofreseller_pilihan p
					WHERE (p.id_pertanyaan = 3
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get()->row_array();

    return $result;
	}

	function get_list_pertanyaan_4($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
	{
		$where = '';

		if ($pilperiode == 'Yearly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'"';
		}
		else if ($pilperiode == 'Quartely')
		{
			if ($bulan_kuartal == '01-03')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (1, 2, 3)';
			}
			else if ($bulan_kuartal == '04-06')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (4, 5, 6)';
			}
			else if ($bulan_kuartal == '07-09')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (7, 8, 9)';
			}
			else if ($bulan_kuartal == '10-12')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (10, 11, 12)';
			}
		}
		else if ($pilperiode == 'Monthly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'"';
		}
		else if ($pilperiode == 'Weekly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'" AND xp.minggu = "'.(int) $minggu.'"';
		}

		$this->db->select('
			xx.id
			, xx.id_pertanyaan
			, xx.nama
			, xx.total
		');
		$this->db->from('
			(
					SELECT
							p.id
							, p.id_pertanyaan
							, p.pilihan AS nama
							, (
										SELECT
												COUNT(xp.id)
										FROM
												za_voiceofreseller xp
												INNER JOIN eb_outlet xo
														ON (xp.id_outlet = xo.id_outlet)
										WHERE ('.$where.'
												AND xo.id_tap = "'.$id_tap.'"
												AND xp.id_pilihan_4 = p.id)
								) AS total
					FROM
							za_voiceofreseller_pilihan p
					WHERE (p.id_pertanyaan = 4
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get();

		return $result->result();
	}

	function get_data_pertanyaan_4($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
	{
		$where = '';

		if ($pilperiode == 'Yearly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'"';
		}
		else if ($pilperiode == 'Quartely')
		{
			if ($bulan_kuartal == '01-03')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (1, 2, 3)';
			}
			else if ($bulan_kuartal == '04-06')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (4, 5, 6)';
			}
			else if ($bulan_kuartal == '07-09')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (7, 8, 9)';
			}
			else if ($bulan_kuartal == '10-12')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (10, 11, 12)';
			}
		}
		else if ($pilperiode == 'Monthly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'"';
		}
		else if ($pilperiode == 'Weekly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'" AND xp.minggu = "'.(int) $minggu.'"';
		}

		$this->db->select('
			COALESCE(SUM(xx.total), 0) AS x_total
		');
		$this->db->from('
			(
					SELECT
							p.id
							, p.id_pertanyaan
							, p.pilihan AS nama
							, (
										SELECT
												COUNT(xp.id)
										FROM
												za_voiceofreseller xp
												INNER JOIN eb_outlet xo
														ON (xp.id_outlet = xo.id_outlet)
										WHERE ('.$where.'
												AND xo.id_tap = "'.$id_tap.'"
												AND xp.id_pilihan_4 = p.id)
								) AS total
					FROM
							za_voiceofreseller_pilihan p
					WHERE (p.id_pertanyaan = 4
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get()->row_array();

    return $result;
	}

	function get_list_pertanyaan_5($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
	{
		$where = '';

		if ($pilperiode == 'Yearly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'"';
		}
		else if ($pilperiode == 'Quartely')
		{
			if ($bulan_kuartal == '01-03')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (1, 2, 3)';
			}
			else if ($bulan_kuartal == '04-06')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (4, 5, 6)';
			}
			else if ($bulan_kuartal == '07-09')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (7, 8, 9)';
			}
			else if ($bulan_kuartal == '10-12')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (10, 11, 12)';
			}
		}
		else if ($pilperiode == 'Monthly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'"';
		}
		else if ($pilperiode == 'Weekly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'" AND xp.minggu = "'.(int) $minggu.'"';
		}

		$this->db->select('
			xx.id
			, xx.id_pertanyaan
			, xx.nama
			, xx.total
		');
		$this->db->from('
			(
					SELECT
							p.id
							, p.id_pertanyaan
							, p.pilihan AS nama
							, (
										SELECT
												COUNT(xp.id)
										FROM
												za_voiceofreseller xp
												INNER JOIN eb_outlet xo
														ON (xp.id_outlet = xo.id_outlet)
										WHERE ('.$where.'
												AND xo.id_tap = "'.$id_tap.'"
												AND xp.id_pilihan_5 = p.id)
								) AS total
					FROM
							za_voiceofreseller_pilihan p
					WHERE (p.id_pertanyaan = 5
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get();

		return $result->result();
	}

	function get_data_pertanyaan_5($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
	{
		$where = '';

		if ($pilperiode == 'Yearly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'"';
		}
		else if ($pilperiode == 'Quartely')
		{
			if ($bulan_kuartal == '01-03')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (1, 2, 3)';
			}
			else if ($bulan_kuartal == '04-06')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (4, 5, 6)';
			}
			else if ($bulan_kuartal == '07-09')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (7, 8, 9)';
			}
			else if ($bulan_kuartal == '10-12')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (10, 11, 12)';
			}
		}
		else if ($pilperiode == 'Monthly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'"';
		}
		else if ($pilperiode == 'Weekly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'" AND xp.minggu = "'.(int) $minggu.'"';
		}

		$this->db->select('
			COALESCE(SUM(xx.total), 0) AS x_total
		');
		$this->db->from('
			(
					SELECT
							p.id
							, p.id_pertanyaan
							, p.pilihan AS nama
							, (
										SELECT
												COUNT(xp.id)
										FROM
												za_voiceofreseller xp
												INNER JOIN eb_outlet xo
														ON (xp.id_outlet = xo.id_outlet)
										WHERE ('.$where.'
												AND xo.id_tap = "'.$id_tap.'"
												AND xp.id_pilihan_5 = p.id)
								) AS total
					FROM
							za_voiceofreseller_pilihan p
					WHERE (p.id_pertanyaan = 5
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get()->row_array();

    return $result;
	}

	function get_list_pertanyaan_6($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
	{
		$where = '';

		if ($pilperiode == 'Yearly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'"';
		}
		else if ($pilperiode == 'Quartely')
		{
			if ($bulan_kuartal == '01-03')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (1, 2, 3)';
			}
			else if ($bulan_kuartal == '04-06')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (4, 5, 6)';
			}
			else if ($bulan_kuartal == '07-09')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (7, 8, 9)';
			}
			else if ($bulan_kuartal == '10-12')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (10, 11, 12)';
			}
		}
		else if ($pilperiode == 'Monthly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'"';
		}
		else if ($pilperiode == 'Weekly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'" AND xp.minggu = "'.(int) $minggu.'"';
		}

		$this->db->select('
			xx.id
			, xx.id_pertanyaan
			, xx.nama
			, xx.total
		');
		$this->db->from('
			(
					SELECT
							p.id
							, p.id_pertanyaan
							, p.pilihan AS nama
							, (
										SELECT
												COUNT(xp.id)
										FROM
												za_voiceofreseller xp
												INNER JOIN eb_outlet xo
														ON (xp.id_outlet = xo.id_outlet)
										WHERE ('.$where.'
												AND xo.id_tap = "'.$id_tap.'"
												AND xp.id_pilihan_6 = p.id)
								) AS total
					FROM
							za_voiceofreseller_pilihan p
					WHERE (p.id_pertanyaan = 6
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get();

		return $result->result();
	}

	function get_data_pertanyaan_6($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
	{
		$where = '';

		if ($pilperiode == 'Yearly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'"';
		}
		else if ($pilperiode == 'Quartely')
		{
			if ($bulan_kuartal == '01-03')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (1, 2, 3)';
			}
			else if ($bulan_kuartal == '04-06')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (4, 5, 6)';
			}
			else if ($bulan_kuartal == '07-09')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (7, 8, 9)';
			}
			else if ($bulan_kuartal == '10-12')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (10, 11, 12)';
			}
		}
		else if ($pilperiode == 'Monthly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'"';
		}
		else if ($pilperiode == 'Weekly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'" AND xp.minggu = "'.(int) $minggu.'"';
		}

		$this->db->select('
			COALESCE(SUM(xx.total), 0) AS x_total
		');
		$this->db->from('
			(
					SELECT
							p.id
							, p.id_pertanyaan
							, p.pilihan AS nama
							, (
										SELECT
												COUNT(xp.id)
										FROM
												za_voiceofreseller xp
												INNER JOIN eb_outlet xo
														ON (xp.id_outlet = xo.id_outlet)
										WHERE ('.$where.'
												AND xo.id_tap = "'.$id_tap.'"
												AND xp.id_pilihan_6 = p.id)
								) AS total
					FROM
							za_voiceofreseller_pilihan p
					WHERE (p.id_pertanyaan = 6
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get()->row_array();

    return $result;
	}

	function get_list_pertanyaan_7($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
	{
		$where = '';

		if ($pilperiode == 'Yearly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'"';
		}
		else if ($pilperiode == 'Quartely')
		{
			if ($bulan_kuartal == '01-03')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (1, 2, 3)';
			}
			else if ($bulan_kuartal == '04-06')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (4, 5, 6)';
			}
			else if ($bulan_kuartal == '07-09')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (7, 8, 9)';
			}
			else if ($bulan_kuartal == '10-12')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (10, 11, 12)';
			}
		}
		else if ($pilperiode == 'Monthly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'"';
		}
		else if ($pilperiode == 'Weekly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'" AND xp.minggu = "'.(int) $minggu.'"';
		}

		$this->db->select('
			xx.id
			, xx.id_pertanyaan
			, xx.nama
			, xx.total
		');
		$this->db->from('
			(
					SELECT
							p.id
							, p.id_pertanyaan
							, p.pilihan AS nama
							, (
										SELECT
												COUNT(xp.id)
										FROM
												za_voiceofreseller xp
												INNER JOIN eb_outlet xo
														ON (xp.id_outlet = xo.id_outlet)
										WHERE ('.$where.'
												AND xo.id_tap = "'.$id_tap.'"
												AND xp.id_pilihan_7 = p.id)
								) AS total
					FROM
							za_voiceofreseller_pilihan p
					WHERE (p.id_pertanyaan = 7
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get();

		return $result->result();
	}

	function get_data_pertanyaan_7($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
	{
		$where = '';

		if ($pilperiode == 'Yearly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'"';
		}
		else if ($pilperiode == 'Quartely')
		{
			if ($bulan_kuartal == '01-03')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (1, 2, 3)';
			}
			else if ($bulan_kuartal == '04-06')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (4, 5, 6)';
			}
			else if ($bulan_kuartal == '07-09')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (7, 8, 9)';
			}
			else if ($bulan_kuartal == '10-12')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (10, 11, 12)';
			}
		}
		else if ($pilperiode == 'Monthly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'"';
		}
		else if ($pilperiode == 'Weekly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'" AND xp.minggu = "'.(int) $minggu.'"';
		}

		$this->db->select('
			COALESCE(SUM(xx.total), 0) AS x_total
		');
		$this->db->from('
			(
					SELECT
							p.id
							, p.id_pertanyaan
							, p.pilihan AS nama
							, (
										SELECT
												COUNT(xp.id)
										FROM
												za_voiceofreseller xp
												INNER JOIN eb_outlet xo
														ON (xp.id_outlet = xo.id_outlet)
										WHERE ('.$where.'
												AND xo.id_tap = "'.$id_tap.'"
												AND xp.id_pilihan_7 = p.id)
								) AS total
					FROM
							za_voiceofreseller_pilihan p
					WHERE (p.id_pertanyaan = 7
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get()->row_array();

    return $result;
	}

	var $fieldmap_daftar = array('nama_team', 'jabatan', 'id_digipos', 'nama_outlet', 'sales_sf');
	var $column_order = array(null, 'nama_team', 'jabatan', 'id_digipos', 'nama_outlet', 'sales_sf');
	var $column_search = array('nama_team', 'jabatan', 'id_digipos', 'nama_outlet', 'sales_sf');

	function build_query_daftar()
	{
		$id_tap = $this->input->post('id_tap') ? $this->input->post('id_tap') : 0;
		$pilperiode = $this->input->post('pilperiode') ? $this->input->post('pilperiode') : 0;
		$tahun_kuartal = $this->input->post('tahun_kuartal') ? $this->input->post('tahun_kuartal') : 0;
		$bulan_kuartal = $this->input->post('bulan_kuartal') ? $this->input->post('bulan_kuartal') : 0;
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : 0;
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : 0;
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : 0;

		$where = '';

		if ($pilperiode == 'Yearly')
		{
			$where .= 'v.tahun = "'.(int) $tahun.'"';
		}
		else if ($pilperiode == 'Quartely')
		{
			if ($bulan_kuartal == '01-03')
			{
				$where .= 'v.tahun = "'.(int) $tahun_kuartal.'" AND v.bulan IN (1, 2, 3)';
			}
			else if ($bulan_kuartal == '04-06')
			{
				$where .= 'v.tahun = "'.(int) $tahun_kuartal.'" AND v.bulan IN (4, 5, 6)';
			}
			else if ($bulan_kuartal == '07-09')
			{
				$where .= 'v.tahun = "'.(int) $tahun_kuartal.'" AND v.bulan IN (7, 8, 9)';
			}
			else if ($bulan_kuartal == '10-12')
			{
				$where .= 'v.tahun = "'.(int) $tahun_kuartal.'" AND v.bulan IN (10, 11, 12)';
			}
		}
		else if ($pilperiode == 'Monthly')
		{
			$where .= 'v.tahun = "'.(int) $tahun.'" AND v.bulan = "'.(int) $bulan.'"';
		}
		else if ($pilperiode == 'Weekly')
		{
			$where .= 'v.tahun = "'.(int) $tahun.'" AND v.bulan = "'.(int) $bulan.'" AND v.minggu = "'.(int) $minggu.'"';
		}

		$this->db->select('
			xx.id
			, xx.nama_team
			, xx.jabatan
			, xx.id_digipos
			, xx.nama_outlet
			, xx.nama_branch
			, xx.nama_cluster
			, xx.nama_tap
			, xx.sales_sf
			, xx.video
		');
		$this->db->from('
			(
					SELECT
							v.id
							, v.created_by AS nama_team
							, l.level AS jabatan
							, o.id_digipos
							, o.nama_outlet
							, b.nama_branch
							, c.nama_cluster
							, t.nama_tap
							, (
										SELECT
												s.nama_sales
										FROM
												fa_pjp p
												INNER JOIN db_sales s
														ON (p.id_sales = s.id_sales)
										WHERE (p.id_tempat = v.id_outlet
												AND p.id_jenis_lokasi = "OUT")
										LIMIT 1
								) AS sales_sf
							, v.video
					FROM
							za_voiceofreseller v
							INNER JOIN za_users u
									ON (v.created_by = u.username)
							INNER JOIN aa_users_level l
									ON (u.id_level = l.id_level)
							INNER JOIN eb_outlet o
									ON (v.id_outlet = o.id_outlet)
							INNER JOIN bd_tap t
									ON (o.id_tap = t.id_tap)
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
							INNER JOIN bb_branch b
									ON (c.id_branch = b.id_branch)
					WHERE ('.$where.'
							AND o.id_tap = "'.$id_tap.'")
			) xx
		');
	}

	function get_data_video($id)
	{
		$this->db->select('*');
		$this->db->from('za_voiceofreseller');
		$this->db->where('id', $id);

    $result = $this->db->get();

    return $result->row_array();
	}
}
?>