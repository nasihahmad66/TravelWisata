<script src="<?= base_url() ?>assets/main/riwayat_transaksi.js"></script>


<!-- nav -->
<div class="row">
    <div class="col-md-12" data-bind="visible: !transaksi.ShowDetail()">
        <div class="col-md-3 pull-right">
            <div class="form-group input-group">
                <input id="textSearchID" type="text" class="form-control" data-bind="value : transaksi.textSearch">
                <span class="input-group-btn">
                    <button class="btn btn-default" onclick="transaksi.search()" type="button"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Grid -->
<div class="row" data-bind="visible: !transaksi.ShowDetail()">
    <div class="col-md-12" data-bind="visible: !model.Processing()">
        <div id="gridtransaksi"></div>
    </div>
    <?php 
        $this->load->view($loader);
     ?>
</div>
<div class="row" data-bind="visible: transaksi.ShowDetail()">
    <div class="col-md-12">
        <div class="card" data-bind="with: transaksi">
            <div class="card-header">Transaksi</div>
            <div class="card-body" data-bind="with: dataDetailTransaksi">
                <div class="row">
                    <div id="ticket" class="col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-sm-5">
                            <h6>Id Transaksi :</h6>
                            </div>
                            <div class="col-sm-7">
                                <b class="pull-right" data-bind="text: ID_ORDER"></b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                            <h6>Nama Wisata :</h6>
                            </div>
                            <div class="col-sm-7">
                                <b class="pull-right" data-bind="text: NAMA_WISATA"></b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                            <h6>Nama Paket :</h6>
                            </div>
                            <div class="col-sm-7">
                                <b class="pull-right" data-bind="text: NAMA_PAKET"></b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                            <h6>Kota :</h6>
                            </div>
                            <div class="col-sm-7">
                                <b class="pull-right" data-bind="text: KOTA"></b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                            <h6>Berangkat :</h6>
                            </div>
                            <div class="col-sm-7">
                                <b class="pull-right" data-bind="text: TANGGAL_BERANGKAT"></b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                            <h6>Kembali :</h6>
                            </div>
                            <div class="col-sm-7">
                                <b class="pull-right" data-bind="text: TANGGAL_KEMBALI"></b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                            <h6>Kuota :</h6>
                            </div>
                            <div class="col-sm-7">
                                <b class="pull-right" data-bind="text: KUOTA_PESAN"></b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                            <h6>Total Biaya :</h6>
                            </div>
                            <div class="col-sm-7">
                                <b class="pull-right"> Rp <span data-bind="text: TOTAL_TRANSAKSI"></span></b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                            <h6>Status :</h6>
                            </div>
                            <div class="col-sm-7">
                                <b class="pull-right" data-bind="text: STATUS"></b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-5">
                            <h6>Admin :</h6>
                            </div>
                            <div class="col-sm-7">
                                <b class="pull-right" data-bind="text: NAMA_ADMIN"></b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                            <h6>Nomor Telpon :</h6>
                            </div>
                            <div class="col-sm-7">
                                <b class="pull-right" data-bind="text: NOMOR_TELPON"></b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                            <h6>Alamat :</h6>
                            </div>
                            <div class="col-sm-7">
                                <b class="pull-right" data-bind="text: ALAMAT"></b>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group" data-bind="visible: transaksi.showOrder()">
                            <label>Pilih Gambar</label>
                            <input class="form-control input-form" type="file" id="inputImage"><br>
                            <button class="btn btn-success pull-right" type="submit" onclick="transaksi.kirimBuktiBayar()">Kirim Bukti Pembayaran</button>
                        </div>
                        <div class="card" data-bind="visible: !transaksi.showOrder()">
                            <div class="card-body">
                                <img id="imgShow" class="img-responsive" style="width:100%;max-height: 350px;" alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <!-- <div class="col-md-4"></div> -->
                    <div class="col-md-4">
                        <button class="btn btn-block" type="submit" data-bind="click: function(){transaksi.ShowDetail(false)}">Kembali</button>
                    </div>
                    <div class="col-md-4" data-bind="visible: transaksi.showBtnCancel()">
                        <button class="btn btn-danger btn-block" type="submit" onclick="transaksi.batalkanPesanan()">Batalakan</button>
                    </div>
                    <div class="col-md-4" data-bind="visible: transaksi.showBtnPrint()">
                        <button class="btn btn-success btn-block" type="submit" onclick="transaksi.printTiket('#ticket')">Print Ticket</button>
                    </div>
                    <div class="col-md-4" data-bind="visible: transaksi.showOrder()">
                        <button class="btn btn-warning btn-block" type="submit" onclick="transaksi.ubahTransaksi()">Ubah Transaksi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

