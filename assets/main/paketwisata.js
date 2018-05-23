var paketwisata = {}

paketwisata.dataMasterpPaketWisata = ko.observableArray([])
paketwisata.textSearch = ko.observable("")
paketwisata.showAdd = ko.observable(true)
paketwisata.showEdit = ko.observable(false)
paketwisata.headerModalText = ko.observable("Tambah")
paketwisata.dataMasterWisata = ko.observableArray([])
paketwisata.dropdownSearch = ko.observable("")

paketwisata.dataJenisHarga = ko.observableArray(
    [
        {
            VALUE: "perorangan",
            TEXT: "Perorangan"
        },
        {
            VALUE: "total",
            TEXT: "Total"
        }
    ]
)

paketwisata.newRecordPaketWisata = function() {
    var data = {
        ID_PAKET: "",
        ID_WISATA: "",
        NAMA_PAKET: "",
        KUOTA_MINIMAL: "",
        KUOTA_MAKSIMAL: "",
        HARGA: "",
        JENIS_HARGA: "",
        STATUS: true,
        DURASI_WISATA: "",

    }

    return data;
}
paketwisata.recordpaketwisata = ko.mapping.fromJS(paketwisata.newRecordPaketWisata())

paketwisata.getDataWisata = function() {
    // model.Processing(true);
    ajaxPost("paketharga/GetAllDataWisata", {}, function(res) {
        var result = JSON.parse(res)
        paketwisata.dataMasterWisata(result)
        // model.Processing(false)
    })
}

paketwisata.getDataPaketHarga = function(callback) {
    model.Processing(true);
    ajaxPost("paketharga/GetAllDataPaketwisata", {}, function(res) {
        var result = JSON.parse(res)
        paketwisata.dataMasterpPaketWisata(result);
        callback()
        model.Processing(false);
    })
}

paketwisata.rendergridPaketWisata = function(textSearch) {
    var data = paketwisata.dataMasterpPaketWisata()

    if (textSearch != "") {
        var results = _.filter(data, function (item) {
            return _.includes(item.NAMA_WISATA.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.NAMA_PAKET.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.KUOTA_MINIMAL.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.KUOTA_MAKSIMAL.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.HARGA.toLowerCase(), textSearch.toLowerCase())
        });
        data = results
    }

    var columns = [{
            title: 'Nomor',
            width: 70,
            template: function(dataItem) {
                var idxs = _.findIndex(data, function(d) {
                    return d.ID_PAKET == dataItem.ID_PAKET
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
            width: 200
        }, {
            field: 'KUOTA_MINIMAL',
            title: 'Min',
            width: 100
        }, {
            field: 'KUOTA_MAKSIMAL',
            title: 'Maks',
            width: 100
        }, {
            // field: 'HARGA',
            title: 'harga',
            width: 100,
            template: function(val) {
                return ChangeToRupiah(parseInt(val.HARGA));
            }
        }, {
            field: 'STATUS',
            title: 'status',
            width: 100,
            template: function(val) {
                if (parseInt(val.STATUS)) {
                    return "Aktif"
                } else {
                    return "Nonaktif"
                }
            }
        }, {
            field: 'DURASI_WISATA',
            title: 'Durasi',
            width: 100
        }, {
            title: 'Action',
            width: 70,
            template: "<a href=\"javascript:paketwisata.editPaket('#: ID_PAKET #')\" class=\"btn btn-sm btn-warning\"><i class=\"fa fa-pencil\"></i></a> &nbsp;"
        }
    ]

    $('#gridpaketwisata').kendoGrid({
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

paketwisata.saveData = function() {
    var data = ko.mapping.toJS(paketwisata.recordpaketwisata)
    if (data.ID_WISATA == "") {
        return swal("Error", "Anda belum memilih wisata", "error")
    }
    if (data.NAMA_PAKET == "") {
        return swal("Error", "Nama Paket tidak boleh kosong", "error")
    }
    if (data.KUOTA_MINIMAL == "") {
        return swal("Error", "Kuota Minimal tidak boleh kosong", "error")
    }
    if (data.KUOTA_MAKSIMAL == "") {
        return swal("Error", "Kuota Maksimal tidak boleh kosong", "error")
    }
    if (data.JENIS_HARGA == "") {
        return swal("Error", "Anda belum memilih jenis harga", "error")
    }
    if (data.HARGA == "") {
        return swal("Error", "harga tidak boleh kosong", "error")
    }
    if (data.DURASI_WISATA == "") {
        return swal("Error", "Durasi tidak boleh kosong", "error")
    }

    $status = $("#status").prop("checked")
    if ($status) {
        data.STATUS = 1
    } else {
        data.STATUS = 0
    }

    data.HARGA = FormatCurrency(data.HARGA)

    url = "paketharga/SaveData"
    param = {
        Data: data
    }


    swal({
        title: "Apakah Anda yakin?",
        text: paketwisata.headerModalText() + " data",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, save it!',
        cancelButtonText: 'No, cancel!',
        buttonsStyling: true,
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            model.Processing(true)
            ajaxFormPost(url, param, function(res) {
                // console.log(res)
                if (res != "") {
                    swal("Gagal", res, "error")
                } else {
                    $("#paketModal").modal("hide")
                    swal({
                        title: "Berhasil!",
                        text: "Data berhasil disimpan!",
                        type: "success",
                        confirmButtonColor: "#3da09a"
                    }).then(() => {
                        paketwisata.getDataPaketHarga(function() {
                            paketwisata.rendergridPaketWisata("")
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

paketwisata.editPaket = function(ID_PAKET) {
    var data = _.filter(paketwisata.dataMasterpPaketWisata(), ['ID_PAKET', ID_PAKET]);
    if (parseInt(data[0].STATUS)) {
        $('#status').bootstrapToggle('on')
    } else {
        $('#status').bootstrapToggle('off')
    }

    ko.mapping.fromJS(data[0], paketwisata.recordpaketwisata)

    $('#dropdownWisata').data('kendoDropDownList').value(data[0].ID_WISATA);
    $('#dropdownJenisHarga').data('kendoDropDownList').value(data[0].JENIS_HARGA);

    paketwisata.headerModalText("Edit")
    paketwisata.showAdd(false)
    paketwisata.showEdit(true)
    $("#paketModal").modal("show")
}

paketwisata.modalClosed = function() {
    $('#paketModal').on('hidden.bs.modal', function() {
        ko.mapping.fromJS(paketwisata.newRecordPaketWisata(), paketwisata.recordpaketwisata)

        $('#status').bootstrapToggle('on')
        $("#dropdownWisata").data('kendoDropDownList').value(-1)
        $("#dropdownJenisHarga").data('kendoDropDownList').value(-1)
        paketwisata.headerModalText("Tambah")
        paketwisata.showAdd(true)
        paketwisata.showEdit(false)
    })
}

paketwisata.searchWhenEnterPressed = function() {
    $("#textSearchID").on('keyup', function(e) {
        if (e.keyCode == 13) {
            paketwisata.search()
        }
    });
}

paketwisata.textSearch.subscribe(function(e) {
    if (e == "") {
        paketwisata.rendergridPaketWisata("")
    }
})

paketwisata.dropdownSearch.subscribe(function(text) {
    paketwisata.rendergridPaketWisata(text)
})


paketwisata.search = function() {
    paketwisata.rendergridPaketWisata(paketwisata.textSearch())
}

paketwisata.init = function() {
    paketwisata.getDataWisata()
    paketwisata.getDataPaketHarga(function() {
        paketwisata.rendergridPaketWisata("")
    })
}

paketwisata.maskingMoney = function () {
    $('.currency').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: 2,
        autoGroup: true,
        rightAlign: false,
        allowMinus: false
    });
}

$(function() {
    paketwisata.init()
    paketwisata.searchWhenEnterPressed()
    paketwisata.modalClosed()
    paketwisata.maskingMoney()
})