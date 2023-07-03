<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=".$nama.".xls" );
?>


<?php if ($nama == 'branch'){ ?>

<table border="1">
	<tr>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>NO</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>ID BRANCH</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>BRANCH</b></font></td>
	</tr>
	<?php $no = 1; ?>
	<?php foreach($list_download as $download) { ?>
	<tr>
		<td><?php echo $no ?></td>
		<td><?php echo $download->id_branch; ?></td>
		<td><?php echo $download->nama_branch; ?></td>
	</tr>
	<?php $no ++; ?>
	<?php } ?>
</table>

<?php } else if ($nama == 'cluster') { ?>

<table border="1">
	<tr>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>NO</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>ID CLUSTER</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>CLUSTER</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>BRANCH</b></font></td>
	</tr>
	<?php $no = 1; ?>
	<?php foreach($list_download as $download) { ?>
	<tr>
		<td><?php echo $no ?></td>
		<td><?php echo $download->id_cluster; ?></td>
		<td><?php echo $download->nama_cluster; ?></td>
		<td><?php echo $download->nama_branch; ?></td>
	</tr>
	<?php $no ++; ?>
	<?php } ?>
</table>

<?php } else if ($nama == 'tap') { ?>

<table border="1">
	<tr>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>NO</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>ID TAP</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>TAP</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>MANAGER</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>LEVEL</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>CLUSTER</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>BRANCH</b></font></td>
	</tr>
	<?php $no = 1; ?>
	<?php foreach($list_download as $download) { ?>
	<tr>
		<td><?php echo $no ?></td>
		<td><?php echo $download->id_tap; ?></td>
		<td><?php echo $download->nama_tap; ?></td>
		<td><?php echo $download->manager; ?></td>
		<td><?php echo $download->level_tap; ?></td>
		<td><?php echo $download->nama_cluster; ?></td>
		<td><?php echo $download->nama_branch; ?></td>
	</tr>
	<?php $no ++; ?>
	<?php } ?>
</table>

<?php } else if ($nama == 'salesforce') { ?>

<table border="1">
	<tr>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>NO</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>ID SALES</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>NAMA SALES</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>ID TAP</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>NAMA TAP</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>ID CLUSTER</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>ID BRANCH</b></font></td>
	</tr>
	<?php $no = 1; ?>
	<?php foreach($list_download as $download) { ?>
	<tr>
		<td><?php echo $no ?></td>
		<td><?php echo $download->id_sales; ?></td>
		<td><?php echo $download->nama_sales; ?></td>
		<td><?php echo $download->id_tap; ?></td>
		<td><?php echo $download->nama_tap; ?></td>
		<td><?php echo $download->id_cluster; ?></td>
		<td><?php echo $download->id_branch; ?></td>
	</tr>
	<?php $no ++; ?>
	<?php } ?>
</table>

<?php } else if ($nama == 'directsales') { ?>

<table border="1">
	<tr>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>NO</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>ID SALES</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>NAMA SALES</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>ID TAP</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>NAMA TAP</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>ID CLUSTER</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>ID BRANCH</b></font></td>
	</tr>
	<?php $no = 1; ?>
	<?php foreach($list_download as $download) { ?>
	<tr>
		<td><?php echo $no ?></td>
		<td><?php echo $download->id_sales; ?></td>
		<td><?php echo $download->nama_sales; ?></td>
		<td><?php echo $download->id_tap; ?></td>
		<td><?php echo $download->nama_tap; ?></td>
		<td><?php echo $download->id_cluster; ?></td>
		<td><?php echo $download->id_branch; ?></td>
	</tr>
	<?php $no ++; ?>
	<?php } ?>
</table>

<?php } else if ($nama == 'kabupaten') { ?>

<table border="1">
	<tr>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>NO</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>ID KABUPATEN</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>KABUPATEN</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>PROVINSI</b></font></td>
	</tr>
	<?php $no = 1; ?>
	<?php foreach($list_download as $download) { ?>
	<tr>
		<td><?php echo $no ?></td>
		<td><?php echo $download->id_kabupaten; ?></td>
		<td><?php echo $download->nama_kabupaten; ?></td>
		<td><?php echo $download->nama_provinsi; ?></td>
	</tr>
	<?php $no ++; ?>
	<?php } ?>
</table>

<?php } else if ($nama == 'kecamatan') { ?>

<table border="1">
	<tr>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>NO</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>ID KECAMATAN</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>KECAMATAN</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>KABUPATEN</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>PROVINSI</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>CLUSTER</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>BRANCH</b></font></td>
	</tr>
	<?php $no = 1; ?>
	<?php foreach($list_download as $download) { ?>
	<tr>
		<td><?php echo $no ?></td>
		<td><?php echo $download->id_kecamatan; ?></td>
		<td><?php echo $download->nama_kecamatan; ?></td>
		<td><?php echo $download->nama_kabupaten; ?></td>
		<td><?php echo $download->nama_provinsi; ?></td>
		<td><?php echo $download->nama_cluster; ?></td>
		<td><?php echo $download->nama_branch; ?></td>
	</tr>
	<?php $no ++; ?>
	<?php } ?>
</table>


<?php } else if ($nama == 'kelurahan') { ?>

<table border="1">
	<tr>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>NO</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>ID KELURAHAN</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>KELURAHAN</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>KECAMATAN</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>KABUPATEN</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>PROVINSI</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>CLUSTER</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>BRANCH</b></font></td>
	</tr>
	<?php $no = 1; ?>
	<?php foreach($list_download as $download) { ?>
	<tr>
		<td><?php echo $no ?></td>
		<td><?php echo $download->id_kelurahan; ?></td>
		<td><?php echo $download->nama_kelurahan; ?></td>
		<td><?php echo $download->nama_kecamatan; ?></td>
		<td><?php echo $download->nama_kabupaten; ?></td>
		<td><?php echo $download->nama_provinsi; ?></td>
		<td><?php echo $download->nama_cluster; ?></td>
		<td><?php echo $download->nama_branch; ?></td>
	</tr>
	<?php $no ++; ?>
	<?php } ?>
</table>

<?php } else if ($nama == 'jenjang') { ?>

<table border="1">
	<tr>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>NO</b></font></td>
		<td align="center" bgcolor="#005b99"><font color="#FFFFFF"><b>JENJANG</b></font></td>
	</tr>
	<?php $no = 1; ?>
	<?php foreach($list_download as $download) { ?>
	<tr>
		<td><?php echo $no ?></td>
		<td><?php echo $download->jenjang; ?></td>
	</tr>
	<?php $no ++; ?>
	<?php } ?>
</table>

<?php } ?>