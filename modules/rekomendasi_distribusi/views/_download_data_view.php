<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=eksport_per_".$eksport_per.".xls" );
?>

<strong>DATA REKOMENDASI DISTRIBUSI PER <?php echo strtoupper($eksport_per); ?></strong><br>
<strong>CLUSTER : <?php echo strtoupper($id_cluster); ?></strong><br>
<strong>TAHUN : <?php echo isset($tahun) ? $tahun : ''; ?>,&nbsp;
BULAN : <?php echo isset($bulan) ? strtoupper(nama_bulan($bulan)) : ''; ?>,&nbsp;
MINGGU : <?php echo isset($minggu) ? $minggu : ''; ?></strong><br><br>

<table border="1">
	<thead>
		<tr>
			<td style="background-color:#beaed7" rowspan="3"><div align="center"><strong>DATA</strong></div></td>
			<td style="background-color:#beaed7" colspan="6"><div align="center"><strong>SEGEL</strong></div></td>
			<td style="background-color:#beaed7" colspan="3"><div align="center"><strong>SA</strong></div></td>
			<td style="background-color:#beaed7" colspan="3"><div align="center"><strong>VOUCHER INTERNET</strong></div></td>
			<td style="background-color:#beaed7" colspan="3"><div align="center"><strong>VOUCHER GAME</strong></div></td>
			<td style="background-color:#beaed7" rowspan="3"><div align="center" style="margin-top:40px"><strong>TOTAL</strong></div></td>
		</tr>
		<tr>
			<td style="background-color:#beaed7" colspan="2"><div align="center"><strong>PERDANA</strong></div></td>
			<td style="background-color:#beaed7" rowspan="2"><div align="center"><strong>VOUCHER INTERNET</strong></div></td>
			<td style="background-color:#beaed7" colspan="3"><div align="center"><strong>VOUCHER GAME</strong></div></td>
			<td style="background-color:#beaed7" rowspan="2"><div align="center"><strong>LD</strong></div></td>
			<td style="background-color:#beaed7" rowspan="2"><div align="center"><strong>MD</strong></div></td>
			<td style="background-color:#beaed7" rowspan="2"><div align="center"><strong>HD</strong></div></td>
			<td style="background-color:#beaed7" rowspan="2"><div align="center"><strong>LD</strong></div></td>
			<td style="background-color:#beaed7" rowspan="2"><div align="center"><strong>MD</strong></div></td>
			<td style="background-color:#beaed7" rowspan="2"><div align="center"><strong>HD</strong></div></td>
			<td style="background-color:#beaed7" rowspan="2"><div align="center"><strong>LD</strong></div></td>
			<td style="background-color:#beaed7" rowspan="2"><div align="center"><strong>MD</strong></div></td>
			<td style="background-color:#beaed7" rowspan="2"><div align="center"><strong>HD</strong></div></td>
		</tr>
		<tr>
			<td style="background-color:#beaed7"><div align="center"><strong>PREPAID</strong></div></td>
			<td style="background-color:#beaed7"><div align="center"><strong>USIM</strong></div></td>
			<td style="background-color:#beaed7"><div align="center"><strong>SILVER</strong></div></td>
			<td style="background-color:#beaed7"><div align="center"><strong>GOLD</strong></div></td>
			<td style="background-color:#beaed7"><div align="center"><strong>PLATINUM</strong></div></td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($list_download as $download) { ?>
		<tr>
			<td><?php echo $download->nama; ?></td>
			<td><div align="right">0</div></td> <!-- SEGEL - PERDANA - PREPAID -->
			<td><div align="right">0</div></td> <!-- SEGEL - PERDANA - OTA -->
			<td><div align="right">0</div></td> <!-- SEGEL - VOUCHER INTERNET -->
			<td><div align="right">0</div></td> <!-- SEGEL - VOUCHER GAME - SILVER -->
			<td><div align="right">0</div></td> <!-- SEGEL - VOUCHER GAME - GOLD -->
			<td><div align="right">0</div></td> <!-- SEGEL - VOUCHER GAME - PLATINUM -->
			<td><div align="right">0</div></td> <!-- SA - LD -->
			<td><div align="right">0</div></td> <!-- SA - MD -->
			<td><div align="right">0</div></td> <!-- SA - HD -->
			<td><div align="right">0</div></td> <!-- VOUCHER INTERNET - LD -->
			<td><div align="right">0</div></td> <!-- VOUCHER INTERNET - MD -->
			<td><div align="right">0</div></td> <!-- VOUCHER INTERNET - HD -->
			<td><div align="right">0</div></td> <!-- VOUCHER GAME - LD -->
			<td><div align="right">0</div></td> <!-- VOUCHER GAME - MD -->
			<td><div align="right">0</div></td> <!-- VOUCHER GAME - HD -->
			<td style="background-color:#f2f2f2"><div align="right"><strong>0</strong></div></td>
		</tr>
		<?php } ?>
		<tr>
			<td style="background-color:#f2f2f2"><div align="center"><strong>TOTAL DISTRIBUSI</strong></div></td>
			<td style="background-color:#f2f2f2"><div align="right"><strong>0</strong></td> <!-- SEGEL - PERDANA - PREPAID -->
			<td style="background-color:#f2f2f2"><div align="right"><strong>0</strong></td> <!-- SEGEL - PERDANA - OTA -->
			<td style="background-color:#f2f2f2"><div align="right"><strong>0</strong></td> <!-- SEGEL - VOUCHER INTERNET -->
			<td style="background-color:#f2f2f2"><div align="right"><strong>0</strong></td> <!-- SEGEL - VOUCHER GAME - SILVER -->
			<td style="background-color:#f2f2f2"><div align="right"><strong>0</strong></td> <!-- SEGEL - VOUCHER GAME - GOLD -->
			<td style="background-color:#f2f2f2"><div align="right"><strong>0</strong></td> <!-- SEGEL - VOUCHER GAME - PLATINUM -->
			<td style="background-color:#f2f2f2"><div align="right"><strong>0</strong></td> <!-- SA - LD -->
			<td style="background-color:#f2f2f2"><div align="right"><strong>0</strong></td> <!-- SA - MD -->
			<td style="background-color:#f2f2f2"><div align="right"><strong>0</strong></td> <!-- SA - HD -->
			<td style="background-color:#f2f2f2"><div align="right"><strong>0</strong></td> <!-- VOUCHER INTERNET - LD -->
			<td style="background-color:#f2f2f2"><div align="right"><strong>0</strong></td> <!-- VOUCHER INTERNET - MD -->
			<td style="background-color:#f2f2f2"><div align="right"><strong>0</strong></td> <!-- VOUCHER INTERNET - HD -->
			<td style="background-color:#f2f2f2"><div align="right"><strong>0</strong></td> <!-- VOUCHER GAME - LD -->
			<td style="background-color:#f2f2f2"><div align="right"><strong>0</strong></td> <!-- VOUCHER GAME - MD -->
			<td style="background-color:#f2f2f2"><div align="right"><strong>0</strong></td> <!-- VOUCHER GAME - HD -->
			<td style="background-color:#f2f2f2"><div align="right"><strong>0</strong></td> <!-- TOTAL -->
		</tr>
	</tbody>
</table>