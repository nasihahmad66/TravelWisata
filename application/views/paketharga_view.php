<script src="<?= base_url() ?>assets/main/paketwisata.js"></script>


<!-- nav -->
<div class="row">
	<div class="col-md-12">
		<div class="col-md-2 pull-right">
			<button class="btn btn-success pull-right" data-toggle="modal" data-target="#paketModal" id="addButton" type="button" onclick="">Tambah Paket</button>
		</div>
		<div class="col-md-3 pull-right">
            <div class="form-group input-group">
                <input id="textSearchID" type="text" class="form-control" data-bind="value : paketwisata.textSearch">
                <span class="input-group-btn">
                    <button class="btn btn-default" onclick="paketwisata.search()" type="button"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </div>
        <div class="col-md-3 pull-right">
			<div class="form-group input-group">
			    <select style="width: 100%;" id="dropdownWisata" data-bind="kendoDropDownList: { data: paketwisata.dataMasterWisata, dataValueField: 'NAMA_WISATA', dataTextField: 'NAMA_WISATA',optionLabel:'Pilih wisata',filter: 'contains'}, value: paketwisata.dropdownSearch"></select>
			</div>
		</div>
	</div>
</div>

<!-- Grid -->
<div class="row">
  <div class="col-md-12">
    <div class="col-md-12" data-bind="visible: !model.Processing()">
        <div id="gridpaketwisata"></div>
    </div>
    <?php 
        $this->load->view($loader);
     ?>
  </div>
</div>

<!-- Modal -->
<div id="paketModal" class="modal fade in" role="dialog">
    <div class="modal-dialog" data-bind="with: paketwisata">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pull-left"><span data-bind="text: headerModalText"></span> Paket</h4>
            </div>
            <div class="modal-body" data-bind="with: recordpaketwisata">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label>Wisata</label>
                            <br>
                            <select style="width: 100%;" id="dropdownWisata" data-bind="kendoDropDownList: { data: paketwisata.dataMasterWisata, dataValueField: 'ID_WISATA', dataTextField: 'NAMA_WISATA',optionLabel:'Pilih wisata',filter: 'contains'}, value: ID_WISATA"></select>
                        </div>

                        <div class="form-group">
                            <label>Nama Paket</label>
                            <input class="form-control input-form" data-bind="value: NAMA_PAKET">
                        </div>

                        <div class="form-group">
                            <label>Kuota Minimal</label>
                            <input type="number" class="form-control input-form" data-bind="value: KUOTA_MINIMAL">
                        </div>

                        <div class="form-group">
                            <label>Kuota Maksimal</label>
                            <input type="number" class="form-control input-form" data-bind="value: KUOTA_MAKSIMAL">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label>Jenis Harga</label><br>
                            <select style="width: 100%;" id="dropdownJenisHarga" data-bind="kendoDropDownList: { data: paketwisata.dataJenisHarga, dataValueField: 'VALUE', dataTextField: 'TEXT',optionLabel:'Pilih Jenis Harga'}, value: JENIS_HARGA"></select>
                        </div>

                        <div class="form-group">
                            <label>Harga</label>
                            <input type="number" class="form-control input-form" data-bind="value: HARGA">
                        </div>

                        <div class="form-group">
                            <label>Durasi Wisata (hari)</label>
                            <input type="number" class="form-control input-form" data-bind="value: DURASI_WISATA">
                         </div>

                        <div class="form-group">
                            <label>Status</label><br>
                            <!-- <input type="text" data-bind="value"> -->
                            <input data-width="100" id="status" type="checkbox" data-toggle="toggle" data-on="Aktif" data-off="Nonaktif" data-bind=" checked: STATUS">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="paketwisata.saveData()" data-bind="visible: showAdd">Submit</button>
                <button type="button" class="btn btn-warning" onclick="paketwisata.saveData()" data-bind="visible: showEdit">Change</button>
            </div>
        </div>

    </div>
</div>