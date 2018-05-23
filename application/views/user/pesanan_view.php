<script src="<?= base_url() ?>assets/main/pesan.js"></script>

<div class="row">
	<div class="col-md-5">
		<div class="card">
			<div class="card-header">Preview</div>
			<div class="card-body">
				<img src="<?= base_url() ?>/assets/uploads/<?= $data[0]->GAMBAR ?>" class="img-responsive" style="width:100%;" alt="Image">
			</div> 
		</div>
	</div>
	<div class="col-md-7">
		<div class="card">
			<div class="card-header">Data</div>
			<div class="card-body">
				<form class="form-horizontal">
				    <div class="form-group">
				        <label class="control-label col-sm-4" for="email">Nama Wisata:</label>
				        <div class="col-sm-8">
				            <p class="form-control-static"><?= $data[0]->NAMA_WISATA ?></p>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="control-label col-sm-4" for="email">Kota :</label>
				        <div class="col-sm-8">
				            <p class="form-control-static"><?= $data[0]->KOTA ?></p>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="control-label col-sm-4" for="email">Keterangan :</label>
				        <div class="col-sm-8">
				            <p class="form-control-static"><?= $data[0]->KETERANGAN ?></p>
				        </div>
				    </div>
				</form>
			</div> 
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card" data-bind="with: pesan">
			<div class="card-header">Transaksi</div>
			<div class="card-body" data-bind="with: recordPesan">
				<div class="row">
					<div class="col-md-6 col-sm-6">
		                <div class="form-group">
		                    <label>Paket</label>
		                    <br>
		                    <select style="width: 100%;" id="dropdownPaket" data-bind="kendoDropDownList: { data: pesan.dataMasterPaket, dataValueField: 'ID_PAKET', dataTextField: 'NAMA_PAKET',optionLabel:'Pilih paket',filter: 'contains'}, value: ID_PAKET"></select>
		                </div>

		                <div class="form-group">
		                    <label>Kuota Minimal</label>
		                    <input type="number" class="form-control input-form" data-bind="value: KUOTA_MINIMAL" disabled>
		                </div>

		                <div class="form-group">
		                    <label>Kuota Tersisa</label>
		                    <input type="number" class="form-control input-form" data-bind="value: KUOTA_MAKSIMAL" disabled>
		                </div>
		            </div>
		            <div class="col-md-6 col-sm-6">
		                <div class="form-group">
		                    <label>Harga</label>
		                    <input type="text" class="form-control input-form currency" data-bind="value: HARGA" disabled>
		                </div>

		                <div class="form-group">
		                    <label>Jenis Harga</label><br>
		                    <input type="text" class="form-control input-form" data-bind="value: JENIS_HARGA" disabled>
		                </div>

		                <div class="form-group">
		                    <label>Durasi Wisata (hari)</label>
		                    <input type="number" class="form-control input-form" data-bind="value: DURASI_WISATA" disabled>
		                 </div>
		            </div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group" data-bind="visible: pesan.visibleKuota()">
		                    <label>Kuota Pesan</label>
		                    <input type="number" id="kuotaPesan" class="form-control input-form" data-bind="value: KUOTA_PESAN">
		                </div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
		                    <label>Tanggal keberangkatan</label>
		                    <input style="width: 100%" type="text" name="depart" class="form-control" data-bind="value:TANGGAL_BERANGKAT, kendoDatePicker:{value: setDateMin(), min: setDateMin() ,format:'yyyy-MM-dd'}">
		                </div>
		                <div class="form-group">
		                	<div class="row">
		                		<div class="col-sm-5">
					        	<h5>Total Bayar:</h5>
						        </div>
						        <div class="col-sm-7">
						            <b class="pull-right">Rp <span data-bind="text: TOTAL_TRANSAKSI"></span></b>
						        </div>
		                	</div>
					    </div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<?php if ($this->session->flashdata('ID_PAKET') == null): ?>
					<button class="btn btn-success pull-right" type="submit" onclick="pesan.prosesPesan()">Pesan</button>
				<?php else: ?>
					<button class="btn btn-warning pull-right" type="submit" onclick="pesan.prosesUbah()">Ubah Pesanan</button>
					<a href="<?= base_url() ?>index.php/riwayat_transaksi" class="btn btn-info" role="button">Kembali</a>
					<script type="text/javascript">
						var dataorder = <?= $dataorder ?>
					</script>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>