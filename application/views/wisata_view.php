<script src="<?= base_url() ?>assets/main/wisata.js"></script>


<!-- nav -->
<div class="row">
	<div class="col-md-12">
		<div class="col-md-2 pull-right">
			<button class="btn btn-success pull-right" data-toggle="modal" data-target="#wisataModal" id="addButton" type="button" onclick="">Tambah Wisata</button>
		</div>
		<div class="col-md-3 pull-right">
			<div class="form-group input-group">
			    <input id="textSearchID" type="text" class="form-control" data-bind="value : wisata.textSearch">
			    <span class="input-group-btn">
			    	<button class="btn btn-default" onclick="wisata.search()" type="button"><i class="fa fa-search"></i></button>
			    </span>
			</div>
		</div>
	</div>
</div>

<!-- Grid -->
<div class="row">
  <div class="col-md-12">
    <div class="col-md-12" data-bind="visible: !model.Processing()">
        <div id="gridwisata"></div>
    </div>
    <?php 
        $this->load->view($loader);
     ?>
  </div>
</div>

<!-- Modal -->
<div id="wisataModal" class="modal fade in" role="dialog">
    <div class="modal-dialog" data-bind="with: wisata">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pull-left"><span data-bind="text: headerModalText"></span> Wisata</h4>
            </div>
            <div class="modal-body" data-bind="with: recordWisata">
                <div class="form-group">
                    <label>Nama Wisata</label>
                    <input class="form-control input-form" data-bind="value: NAMA_WISATA">
                </div>

                <div class="form-group">
                    <label>kota</label>
                    <input class="form-control input-form" data-bind="value: KOTA">
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" rows="3" placeholder="Masukan Keterangan" data-bind="value: KETERANGAN"></textarea>
                 </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="wisata.saveData()" data-bind="visible: showAdd">Submit</button>
                <button type="button" class="btn btn-warning" onclick="wisata.saveData()" data-bind="visible: showEdit">Change</button>
            </div>
        </div>

    </div>
</div>

<div id="uploadFileModal" class="modal fade in" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pull-left">Upload Gambar</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Pilih Gambar</label>
                    <input class="form-control input-form" type="file" id="inputImage">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="wisata.uploadImage()">Submit</button>
            </div>
        </div>

    </div>
</div>

<div id="lihatGambarModal" class="modal fade in" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <img id="imageWisata" class="img-responsive" style="width:100%" alt="Image">
            </div>
        </div>
    </div>
</div>