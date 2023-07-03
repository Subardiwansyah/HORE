					<div id="map" style="height: 500px;">MAP</div>

					<script>
						function initMap() {


							<?php
								$query = $this->db->query('
										SELECT
												longitude
												, latitude
										FROM
												fc_tracking_sales
										WHERE id_sales = "'.$id_sales.'"
												AND tanggal = "'.$tgl.'"
										ORDER BY lastmodified DESC
										LIMIT 1
								');

								if ($query->num_rows() > 0)
								{
									$row = $query->row_array();

									$lng = $row['longitude'];
									$lat = $row['latitude'];
									$zoom = 18;
								}
								else
								{
									$lng = '112.035726';
									$lat = '-8.000174';
									$zoom = 5;
								}
								?>

							var myLatLng = {lat: <?php echo $lat; ?>, lng: <?php echo $lng; ?>};

							  const symbolThree = {
							    path: "M -2,-2 2,2 M 2,-2 -2,2",
							    strokeColor: "#292",
							    strokeWeight: 4,
							  };

							const map = new google.maps.Map(document.getElementById("map"), {
								zoom: <?php echo $zoom; ?>,
								center: myLatLng,
								mapTypeId: "terrain",
							});

							const flightPlanCoordinates = [
								<?php
									$query = $this->db->query('
													SELECT
															t.*
													FROM
															fc_tracking_sales t
													WHERE t.id_sales = "'.$id_sales.'"
															AND t.tanggal = "'.$tgl.'"
										 ');
								foreach ($query->result_array() as $row)
								{
									echo "{ lat: ".$row['latitude'].", lng: ".$row['longitude']." },";
								}
								?>
						];

							const flightPath = new google.maps.Polyline({
								path: flightPlanCoordinates,
								geodesic: true,
								strokeColor: "#FF0000",
								strokeOpacity: 1.0,
								strokeWeight: 2,
								map: map,
 
								icons: [{
									icon: symbolThree,
									//repeat:'60px',
									offset: '100%'
								},],
							});


							//flightPath.setMap(map);
							setMarkers(map);
							setMarkers2(map);
						}

						var daftar_pjp = [

							<?php
								$query = $this->db->query('
												SELECT
														o.nama_outlet
														, o.id_digipos
														, d.no_kunjungan
														, d.longitude
														, d.latitude
														, (
																	SELECT
																			COUNT(h.id_history_pjp)
																	FROM
																			fb_histroy_pjp h
																	WHERE (h.id_sales = d.id_sales
																			AND h.id_tempat = d.id_tempat
																			AND h.id_jenis_lokasi = d.id_jenis_lokasi
																			AND h.tanggal = d.tanggal
																			AND h.jam_clock_in <> "00:00:00"
																			AND h.jam_clock_out <> "00:00:00")
															) AS kunjungan
												FROM
														fe_daftar_pjp d
														INNER JOIN eb_outlet o
																ON (d.id_tempat = o.id_outlet)
												WHERE (d.id_sales = "'.$id_sales.'"
														AND d.tanggal = "'.$tgl.'")
									 ');
							foreach ($query->result_array() as $row)
							{
							?>
								["<?php echo $row['nama_outlet']; ?>", <?php echo $row['latitude']; ?>, <?php echo $row['longitude']; ?>, <?php echo $row['kunjungan']; ?>, <?php echo $row['no_kunjungan']; ?>, <?php echo $row['id_digipos']; ?>],

							<?php
							}
							?>
						];


							var flightPlanCoordinates2 = [
								<?php
									$query = $this->db->query('
													SELECT
															t.*
													FROM
															fc_tracking_sales t
													WHERE t.id_sales = "'.$id_sales.'"
															AND t.tanggal = "'.$tgl.'"
										 ');
								foreach ($query->result_array() as $row)
							{
							?>
								["<?php echo $row['id_sales']; ?>", <?php echo $row['latitude']; ?>, <?php echo $row['longitude']; ?>],

							<?php
							}
								?>
						];

						function setMarkers2(map){
							const shape = {
								coords: [1, 1, 1, 20, 18, 20, 18, 1],
								type: "poly",
							};

							for (let i = 0; i < flightPlanCoordinates2.length; i++) {
								const flight = flightPlanCoordinates2[i];

								// console.log(daftar_pjp[i][3], '___daftar_pjp');

								new google.maps.Marker({							
									position: { lat: flight[1], lng: flight[2] },
									map,
									icon: {
										path: google.maps.SymbolPath.CIRCLE,
							    //path: "M -2,-2 2,2 M 2,-2 -2,2",
							    strokeColor: "#292",
							    strokeWeight: 4,
										fillOpacity: 1.0
									},
								});
							}
						}

						function setMarkers(map){
							const shape = {
								coords: [1, 1, 1, 20, 18, 20, 18, 1],
								type: "poly",
							};

							for (let i = 0; i < daftar_pjp.length; i++) {
								const outlet = daftar_pjp[i];

								// console.log(daftar_pjp[i][3], '___daftar_pjp');

								new google.maps.Marker({
									position: { lat: outlet[1], lng: outlet[2] },
									map,
									icon: {
										// path: google.maps.SymbolPath.CIRCLE,
										path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z',
										fillColor: daftar_pjp[i][3] ? 'green' : 'red',
										scale: 1,
										strokeColor: 'white',
										strokeWeight: 2,
										fillOpacity: 1.0
									},
									shape: shape,
									title: outlet[0],
									label: {
										text: '' + outlet[4] + '\n' + outlet[0] + ' - ' + outlet[5],
										fontFamily: "Material Icons",
										// color: "#ffffff",
										fontSize: "14px",
										fontWeight: 'bold',
										color: 'black'
									}
								});
							}
						}
					</script>

					<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgJLX103SPADy1bcMADjLtMB1jo2_SmDg&callback=initMap"></script>