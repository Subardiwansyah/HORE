<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('hari_list'))
{
  function hari_list()
  {
    $result['Monday'] = 'Senin';
    $result['Tuesday'] = 'Selasa';
    $result['Wednesday'] = 'Rabu';
    $result['Thursday'] = 'Kamis';
    $result['Friday'] = 'Jumat';
    $result['Saturday'] = 'Sabtu';
    $result['Sunday'] = 'Minggu';

    return $result;
  }
}

if ( ! function_exists('nama_hari'))
{
  function nama_hari($hari)
  {
    $array_hari = hari_list();

    return $array_hari[$hari];
  }
}

if ( ! function_exists('bulan_list'))
{
  function bulan_list()
  {
    $result['01'] = 'Januari';
    $result['02'] = 'Februari';
    $result['03'] = 'Maret';
    $result['04'] = 'April';
    $result['05'] = 'Mei';
    $result['06'] = 'Juni';
    $result['07'] = 'Juli';
    $result['08'] = 'Agustus';
    $result['09'] = 'September';
    $result['10'] = 'Oktober';
    $result['11'] = 'November';
    $result['12'] = 'Desember';

    return $result;
  }
}

if ( ! function_exists('nama_bulan'))
{
  function nama_bulan($bulan)
  {
    $array_bulan = bulan_list();

    if(strlen($bulan) == 1)
		{
			$bulan = '0'.$bulan;
		}

    return $array_bulan[$bulan];
  }
}

if ( ! function_exists('bln_list'))
{
  function bln_list()
  {
    $result['01'] = 'Jan';
    $result['02'] = 'Feb';
    $result['03'] = 'Mar';
    $result['04'] = 'Apr';
    $result['05'] = 'Mei';
    $result['06'] = 'Jun';
    $result['07'] = 'Jul';
    $result['08'] = 'Ags';
    $result['09'] = 'Sep';
    $result['10'] = 'Okt';
    $result['11'] = 'Nov';
    $result['12'] = 'Des';

    return $result;
  }
}

if ( ! function_exists('nama_bln'))
{
  function nama_bln($bulan)
  {
    $array_bulan = bln_list();

    if(strlen($bulan) == 1)
		{
			$bulan = '0'.$bulan;
		}

    return $array_bulan[$bulan];
  }
}

if ( ! function_exists('get_where_str'))
{
  function get_where_str($param, $fieldmap)
  {
    $wh = array();
    foreach($param as $key => $value){
      if (array_key_exists($key, $fieldmap))
      {
        $fld = "";
        $datatype = isset($value['search_datatype']) ? $value['search_datatype'] : null;
        $op = $value['search_op'];
        if ($datatype === 'date')
        {
          $fld = $fieldmap[ $key ];
          $str = isset($value['search_str']) ? strtoupper(prepare_date($value['search_str'])) : null;
          $str2 = isset($value['search_str2']) ? strtoupper(prepare_date($value['search_str2'])) : null;
        }
        else
        {
          $fld = "UPPER(".$fieldmap[ $key ].")";
          $str = isset($value['search_str']) ? addslashes(strtoupper($value['search_str'])) : null;
          $str2 = isset($value['search_str2']) ? addslashes(strtoupper($value['search_str2'])) : null;
        }

        if ($datatype === 'numeric')
        {
          switch($op)
          {
            case "eq" : $fld .= " = "; $str = $str; $wh[ $fld ] = (double)$str; break;
            case "ne" : $fld .= " != "; $str = $str; $wh[ $fld ] = (double)$str; break;
            case "lt" : $fld .= " < "; $str = $str; $wh[ $fld ] = (double)$str; break;
            case "le" : $fld .= " <= "; $str = $str; $wh[ $fld ] = (double)$str; break;
            case "gt" : $fld .= " > "; $str = $str; $wh[ $fld ] = (double)$str; break;
            case "ge" : $fld .= " <= "; $str = $str; $wh[ $fld ] = (double)$str; break;
            case "in" : $fld .= " >= "; $fld1 = $fieldmap[ $key ]." <= "; $wh[ $fld ] = (double)$str; $wh[ $fld1 ] = (double)$str2; break;
            default : ;
          }
        }
				else if ($datatype === 'time')
        {
          switch($op)
          {
            case "cn" : $fld .= " LIKE "; $str = "%".$str."%"; $wh[ $fld ] = $str; break;
            case "ne" : $fld .= " != "; $str = $str; $wh[ $fld ] = $str; break;
            case "lt" : $fld .= " < "; $str = $str; $wh[ $fld ] = $str; break;
            case "le" : $fld .= " <= "; $str = $str; $wh[ $fld ] = $str; break;
            case "gt" : $fld .= " > "; $str = $str; $wh[ $fld ] = $str; break;
            case "ge" : $fld .= " <= "; $str = $str; $wh[ $fld ] = $str; break;
            case "in" : $fld .= " >= "; $fld1 = $fieldmap[ $key ]." <= "; $wh[ $fld ] = $str; $wh[ $fld1 ] = $str2; break;
            default : ;
          }
				}
        else if ($datatype === 'date')
        {
          switch($op)
          {
            case "eq" : $fld .= " = "; $str = $str; $wh[ $fld ] = $str; break;
            case "ne" : $fld .= " != "; $str = $str; $wh[ $fld ] = $str; break;
            case "lt" : $fld .= " < "; $str = $str; $wh[ $fld ] = $str; break;
            case "le" : $fld .= " <= "; $str = $str; $wh[ $fld ] = $str; break;
            case "gt" : $fld .= " > "; $str = $str; $wh[ $fld ] = $str; break;
            case "ge" : $fld .= " <= "; $str = $str; $wh[ $fld ] = $str; break;
            case "in" : $fld .= " >= "; $fld1 = $fieldmap[ $key ]." <= "; $wh[ $fld ] = $str; $wh[ $fld1 ] = $str2; break;
            default : ;
          }
        }
        else if ($datatype === 'datetime')
        {
					$str = strtotime($str);
					$str = date('dd.mm.Y H:i:s', $str);
          switch($op)
          {
            case "eq" : $fld .= " = "; $str = $str; $wh[ $fld ] = $str; break;
            case "ne" : $fld .= " != "; $str = $str; $wh[ $fld ] = $str; break;
            case "lt" : $fld .= " < "; $str = $str; $wh[ $fld ] = $str; break;
            case "le" : $fld .= " <= "; $str = $str; $wh[ $fld ] = $str; break;
            case "gt" : $fld .= " > "; $str = $str; $wh[ $fld ] = $str; break;
            case "ge" : $fld .= " <= "; $str = $str; $wh[ $fld ] = $str; break;
            case "in" : $fld .= " >= "; $fld1 = $fieldmap[ $key ]." <= "; $wh[ $fld ] = $str; $wh[ $fld1 ] = $str2; break;
            default : ;
          }
        }
        else
        {
          switch($op)
          {
            case "eq" : $fld .= " = "; $str = $str; $wh[ $fld ] = $str; break;
            case "ne" : $fld .= " != "; $str = $str; $wh[ $fld ] = $str; break;
            case "lt" : $fld .= " < "; $str = $str; $wh[ $fld ] = $str; break;
            case "le" : $fld .= " <= "; $str = $str; $wh[ $fld ] = $str; break;
            case "gt" : $fld .= " > "; $str = $str; $wh[ $fld ] = $str; break;
            case "ge" : $fld .= " <= "; $str = $str; $wh[ $fld ] = $str; break;
            case "bw" : $fld .= " LIKE "; $str = $str."%"; $wh[ $fld ] = $str; break;
            case "bn" : $fld .= " NOT LIKE "; $str = $str."%"; $wh[ $fld ] = $str; break;
            case "in" : $fld .= " >= "; $fld1 = "UPPER(".$fieldmap[ $key ].") <= "; $wh[ $fld ] = $str; $wh[ $fld1 ] = $str2; break;
            case "ew" : $fld .= " LIKE "; $str = "%".$str; $wh[ $fld ] = $str; break;
            case "en" : $fld .= " NOT LIKE "; $str = "%".$str; $wh[ $fld ] = $str; break;
            case "cn" : $fld .= " LIKE "; $str = "%".$str."%"; $wh[ $fld ] = $str; break;
            case "nc" : $fld .= " NOT LIKE "; $str = "%".$str."%"; $wh[ $fld ] = $str; break;
            case "nu" : $str = " NULL "; $wh[ $fld ] = $str; break;
            case "nn" : $str = " NOT NULL "; $wh[ $fld ] = $str; break;
            default : ;
          }
        }
      }
    }
    return $wh;
  }
}

if ( ! function_exists('get_order_by_str'))
{
  function get_order_by_str($param, $fieldmap)
  {
    $ob = '';
    if (array_key_exists($param, $fieldmap))
    {
      $ob = $fieldmap[ $param ];
    }
    return $ob;
  }
}

if ( ! function_exists('build_or_where'))
{
  function build_or_where($param)
  {
    $str = '';
    $prefix = ' OR ';
    foreach ($param as $k => $v)
    {
      if ($str !== '') $str .= $prefix;

      $str .= "(".$k." '".$v."')";
    }
    return "(".$str.")";
  }
}

if ( ! function_exists('format_rupiah'))
{
  function format_rupiah($value)
  {
    if($value < 0)
    {
      return '( Rp '.number_format(abs($value), 0, ',', '.').' )';
    }
    else
    {
      return 'Rp '.number_format($value, 0, ',', '.').'  ';
    }
  }
}

if ( ! function_exists('format_currency'))
{
  function format_currency($value)
  {
    if($value < 0)
    {
      return '( '.number_format(abs($value), 2, ',', '.').' )';
    }
    else
    {
      return number_format($value, 2, ',', '.');
    }
  }
}

if ( ! function_exists('format_integer'))
{
  function format_integer($value)
  {
    if($value < 0)
    {
      return '( '.number_format(abs($value), 0, ',', '.').' )';
    }
    else
    {
      return number_format($value, 0, ',', '.');
    }
  }
}

if ( ! function_exists('format_date'))
{
  function format_date($date, $style='d/m/Y')
  {
    if (isset($date))
      return date($style, strtotime( $date ) );
    return '';
  }
}

if ( ! function_exists('prepare_integer'))
{
  function prepare_integer($value, $default = null)
  {
    if(isset($value) && $value != '')
      return floatval(str_replace('.','',$value)) * 1;
    return $default;
  }
}

if ( ! function_exists('prepare_date'))
{
  function prepare_date($date)
  {
		if (isset($date) && $date != '')
      return implode( "-", array_reverse( explode("/", $date ) ) );
    return null;
  }
}

if ( ! function_exists('prepare_currency'))
{
  function prepare_currency($value, $default = null)
  {
    if(isset($value) && $value != '')
			return str_replace(',','.',str_replace('.','',$value)) * 1;
		return $default;

  }
}

if ( ! function_exists('prepare_nilai'))
{
  function prepare_nilai($value, $default = null)
  {
    if(isset($value) && $value != '')
      return floatval(str_replace(',', '.', $value)) * 1;
    return $default;
  }
}

if ( ! function_exists('prepare_currency2'))
{
  function prepare_currency2($value, $default = null)
  {
    if(isset($value) && $value != '')
      return str_replace(',','.',str_replace('Rp. ','',$value)) * 1;
    return $default;
  }
}

if ( ! function_exists('jumlah_hari'))
{
  function jumlah_hari($bulan = 0, $tahun = 0)
  {
		if ($bulan < 1 OR $bulan > 12)
		{
			return 0;
		}

		if ( ! is_numeric($tahun) OR strlen($tahun) != 4)
		{
			$tahun = date('Y');
		}

		if ($bulan == 2)
		{
			if ($tahun % 400 == 0 OR ($tahun % 4 == 0 AND $tahun % 100 != 0))
			{
			return 29;
			}
		}

		$jumlah_hari = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		return $jumlah_hari[$bulan - 1];
  }
}

if ( ! function_exists('get_auto_logout'))
{
  function get_auto_logout()
  {
    $ci =& get_instance();
    $ci->load->database();
    $id = $ci->db->query("SELECT nilai FROM cc_konfigurasi WHERE kode_konfigurasi = 'AUTO_LOGOUT'")->row_array();
    return $id['nilai'];
  }
}