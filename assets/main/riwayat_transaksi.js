var transaksi = {}

transaksi.dataMasterTransaksi = ko.observableArray([])
transaksi.textSearch = ko.observable("")
transaksi.ShowDetail = ko.observable(false)
transaksi.showOrder = ko.observable(true)
transaksi.showBtnCancel = ko.observable(true)
transaksi.showBtnPrint = ko.observable(false)


transaksi.newDataDetailTransaksi = function() {
    data = {
        ID_ORDER : "", 
        ID_WISATA : "",
        NAMA_WISATA : "",
        NAMA_PAKET : "",
        KOTA : "",
        TANGGAL_BERANGKAT : "",
        TANGGAL_KEMBALI : "",
        KUOTA_PESAN : "",
        TOTAL_TRANSAKSI : "",
        STATUS : "",
        NAMA_ADMIN : "",
        NOMOR_TELPON : "",
        ALAMAT : "",
        BUKTI_BAYAR : ""
    }
    return data
}
transaksi.dataDetailTransaksi = ko.mapping.fromJS(transaksi.newDataDetailTransaksi())

transaksi.getDataTransaksi = function(callback) {
    model.Processing(true);
    ajaxPost("riwayat_transaksi/GetTransaksiUser",{},function(res) {
        var result = JSON.parse(res)
        transaksi.dataMasterTransaksi(result);
        callback()
        model.Processing(false);
    })
}

transaksi.renderGridTransaksi = function(textSearch) {
    var data = transaksi.dataMasterTransaksi()

    if (textSearch != "") {
        var results = _.filter(data, function (item) {
            return _.includes(item.NAMA_WISATA.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.NAMA_PAKET.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.STATUS.toLowerCase(), textSearch.toLowerCase())
        });
        data = results
    }

    var columns = [{
            title: 'Nomor',
            width: 70,
            template: function(dataItem) {
                var idxs = _.findIndex(data, function(d) {
                    return d.ID_ORDER == dataItem.ID_ORDER
                })
                return idxs + 1
            }
        }, {
            field: 'NAMA_WISATA',
            title: 'Nama Wisata',
            width: 150
        }, {
            field: 'NAMA_PAKET',
            title: 'Nama Paket',
            width: 150
        }, {
            field: 'TANGGAL_BERANGKAT',
            title: 'Berangkat',
            width: 100
        }, {
            field: 'TANGGAL_KEMBALI',
            title: 'Kembali',
            width: 100
        }, {
            field: 'TANGGAL_TRANSAKSI',
            title: 'Transaksi',
            width: 100
        }, {
            field: 'KUOTA_PESAN',
            title: 'Jumlah',
            width: 80
        }, {
            field: 'STATUS',
            title: 'status',
            width: 80
        }, {
            title: 'Action',
            width: 70,
            template: "<a href=\"javascript:transaksi.showEdit('#: ID_ORDER #')\" class=\"btn btn-sm btn-info\"><i class=\"fa fa-eye\"></i></a> &nbsp;"
        }
    ]

    $('#gridtransaksi').kendoGrid({
        dataSource: {
            data: data,
        },
        sortable: true,
        height: 350,
        // width: 140,
        filterable: false,
        scrollable: true,
        columns: columns,
    })
}

transaksi.searchWhenEnterPressed = function(){
    $("#textSearchID").on('keyup', function (e) {
        if (e.keyCode == 13) {
            transaksi.search()
        }
    });
}

transaksi.textSearch.subscribe(function(e) {
    if (e == "") {
        transaksi.renderGridTransaksi("")
    }
})

transaksi.search = function() {
    transaksi.renderGridTransaksi(transaksi.textSearch())
}

transaksi.showEdit = function(ID_ORDER) {
    var url = "riwayat_transaksi/GetDetailTransaksi/"+ID_ORDER
    $.getJSON(url, function(data) {
        if (data.STATUS == "order") {
            transaksi.showOrder(true)
        }else if (data.STATUS == "confirmed") {
            $("#imgShow").attr( "src", base_url+"assets/uploads/"+data.BUKTI_BAYAR)
            transaksi.showBtnPrint(true)
            transaksi.showOrder(false)
            transaksi.showBtnCancel(false)
        }else if (data.STATUS == "waiting") {
            $("#imgShow").attr( "src", base_url+"assets/uploads/"+data.BUKTI_BAYAR)
            transaksi.showOrder(false)
            transaksi.showBtnCancel(true)
        }else{
            transaksi.showBtnPrint(false)
            transaksi.showOrder(false)
            transaksi.showBtnCancel(false)
        }

        data.TANGGAL_BERANGKAT = moment(data.TANGGAL_BERANGKAT).format("DD-MM-YYYY")
        data.TANGGAL_KEMBALI = moment(data.TANGGAL_KEMBALI).format("DD-MM-YYYY")
        data.TOTAL_TRANSAKSI = ChangeToRupiah(parseInt(data.TOTAL_TRANSAKSI))
        
        ko.mapping.fromJS(data, transaksi.dataDetailTransaksi)
    })
    transaksi.ShowDetail(true)
}

transaksi.kirimBuktiBayar = function() {
    var url = "riwayat_transaksi/UploadImage"
    var ID_ORDER = transaksi.dataDetailTransaksi.ID_ORDER()
    var formData = new FormData()
    var attachment = document.getElementById("inputImage")
    formData.append("fileUpload", attachment.files[0]);
    formData.append("ID", ID_ORDER);
    if (attachment.files.length == 0) {
        return swal('Error', 'Anda belum menginputkan bukti transfer', 'error')
    }

    swal({
        title: "Apakah Anda yakin?",
        text: "Mengkonfirmasi pesanan dengan ID "+ID_ORDER,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, confirm it!',
        cancelButtonText: 'No, cancel!',
        buttonsStyling: true,
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            model.Processing(true)
            ajaxFilePost(url, formData, function(res){
                if (res != "") {
                    swal("Gagal", res, "error")
                }else{
                    swal({
                    title: "Berhasil!",
                    text: "Pesanan telah dikonfirmasi!",
                    type: "success",
                    confirmButtonColor: "#3da09a"
                    }).then(() => {
                        transaksi.ShowDetail(false)
                        transaksi.getDataTransaksi(function() {
                            transaksi.renderGridTransaksi("")
                        })
                    });
                }
                model.Processing(false)
            })
        } else if (result.dismiss === 'cancel') {
            swal(
                'Dibatalkan',
                '',
                'info'
            )
        }
    })
}

transaksi.batalkanPesanan = function() {
    var ID_ORDER = transaksi.dataDetailTransaksi.ID_ORDER()
    var url = "riwayat_transaksi/CancelOrder"
    var param = {
            ID : ID_ORDER
        }

    swal({
        title: "Apakah Anda yakin?",
        text: "Membatalkan pesanan dengan id "+ID_ORDER,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, do it!',
        cancelButtonText: 'No, cancel!',
        buttonsStyling: true,
        reverseButtons: false
    }).then((result) => {
        if (result.value) {
            model.Processing(true)
            ajaxFormPost(url, param, function(res){
                if (!res) {
                    swal("Gagal", "Gagal membatalkan pesanan", "error")
                }else{
                    swal({
                    title: "Berhasil!",
                    text: "pesanan berhasil dibatalkan!",
                    type: "success",
                    confirmButtonColor: "#3da09a"
                    }).then(() => {
                        transaksi.ShowDetail(false)
                        transaksi.getDataTransaksi(function() {
                            transaksi.renderGridTransaksi("")
                        })
                    });
                }
                model.Processing(false)
            })
        } else if (result.dismiss === 'cancel') {
            swal(
                'Dibatalkan',
                '',
                'info'
            )
        }
    })
}

transaksi.printTiket = function(selector) {
    var date = moment(new Date()).format('DD-MMM-YYYY-HH-mm')
    kendo.drawing.drawDOM($(selector)).then(function(group){
        kendo.drawing.pdf.saveAs(group, "Transaksi"+date+".pdf");
    });
}

transaksi.ubahTransaksi = function() {
    var ID_ORDER = transaksi.dataDetailTransaksi.ID_ORDER()
    window.location.assign(base_url+"index.php/pesan/UbahPesanan/"+ID_ORDER)
}

transaksi.init = function() {
    transaksi.getDataTransaksi(function() {
        transaksi.renderGridTransaksi("")
    })
}

$(function() {
    transaksi.init()
    transaksi.searchWhenEnterPressed()
})