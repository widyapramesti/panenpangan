<!-- fh5co-content-section -->		
<div class="container" style="margin-top: 130px; margin-bottom: 100px">

				<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
				<?php foreach($dataKategori as $data){ ?>
					<!-- edit disini -->
				<a href="<?php blink('C_DaftarBarang/sort/'.$data->id_kategori.''); ?>" class="btn btn-secondary"><?php echo $data->nm_kategori; ?></a> 
				<?php }?> 
				</div>
				<hr>

<?php if($dataBarang != null) { ?>

					<div class="row text-center">
					<?php foreach($dataBarang as $data){?>
					<div class="col-sm-4">
						<div class="animate-box">
							<div class="thumbnail">
								<img src="<?php blink('assets/img/'.$data->gambar_barang.''); ?>" class="img-rounded" alt="Cinque Terre" style="width:100%; height:250px">
								<div class="caption">
								<h3 align="center"><?php echo $data->nm_brg; ?></h3>
								<p align="center"><?php echo $data->harga; ?> /karung</p><hr>
								<p align="center">
								<a href="#" class="btn btn-primary" role="submit">Tambah Ke Cart</a> |
								<a href="#modalform" class="btn btn-primary" data-toggle="modal" role="button">Pesan</a></p>
					 			</div>
							</div>
				    	</div>
					</div>			
					<?php } ?>
					</div>
<?php } else { ?>
	<div class="animate-box">
		<center>Data Barang Kosong</center>
	</div>
<?php } ?>
				
				</div>
			</div>
		</div>
		<!-- END fh5co-services-section -->

		<!-- modal view Form Pesan -->
				<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="modalform" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h3 id="myModalLabel" align="center">Form Pesan Barang</h3>
							</div>
							<div class="modal-body">
								<form method="POST" action="" enctype="multipart/form-data">
									 <table class="table table-striped" border="0">
									  <thead>
										<td width="20%" ></td>
									  <td width="10%"  ></td>
									  <td width="60%" ></td>
									</thead>
									<tbody>
										<tr>
										  <td>Item</td>
										<td>:</td>
										<td style="text-transform:capitalize;">Jagung</td>
									  </tr>
										 <tr>
										  <td>quantity</td>
										<td>:</td>
										<td style="text-transform:capitalize;"><input type="text" nama=""></td>
										 </tr>
											<tr>
										  <td>Price</td>
										  <td>:</td>
										<td style="text-transform:capitalize;">Rp 20.000</td>
									  </tr>
											<tr>
										  <td>Description</td>
										<td>:</td>
										<td style="text-transform:capitalize;">Baru metik kemaren</td>
									  </tr>
									  </tbody>
									</table>
								</form>
							</div>
							<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
								  <p class="help-block pull-left text-danger hide" id="form-error">&nbsp; The form is not valid. </p>
							</div>
						</div>
					</div>
				</div>
			<!-- end modal view buku -->
		<!-- end modal view Form Pesan -->