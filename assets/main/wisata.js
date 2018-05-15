var wisata = {}

wisata.dataMasterWisata = ko.observableArray([])
wisata.textSearch = ko.observable("")
wisata.showAdd = ko.observable(true)
wisata.showEdit = ko.observable(false)
wisata.headerModalText = ko.observable("Tambah")
wisata.dataMasterPaketHarga = ko.observableArray([])
wisata.idWisata = ko.observable("")

wisata.newRecordWisata = function(){
    var data = {
        ID_WISATA : "",
        NAMA_WISATA : "",
        KOTA : "",
        KETERANGAN : "",

    }

    return data;
}
wisata.recordWisata = ko.mapping.fromJS(wisata.newRecordWisata())

wisata.getDataPaketHarga = function() {
	// model.Processing(true);
	ajaxPost("wisata/GetAllDataPaketHarga",{}, function(res) {
		var result = JSON.parse(res)
		wisata.dataMasterPaketHarga(result)
		// model.Processing(false)
	})
}

wisata.getDataWisata = function(callback) {
	model.Processing(true);
	ajaxPost("wisata/GetAllDataWisata",{},function(res) {
		var result = JSON.parse(res)
		wisata.dataMasterWisata(result);
		callback()
		model.Processing(false);
	})
}

wisata.rendergridWisata = function (textSearch) {
	var data = wisata.dataMasterWisata()

    if (textSearch != "") {
        var results = _.filter(data, function (item) {
            return _.includes(item.NAMA_WISATA.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.KOTA.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.KETERANGAN.toLowerCase(), textSearch.toLowerCase())
        });
        data = results
    }

	var columns = [{
        title: 'Nomor',
        width: 100,
        template : function(dataItem){
            var idxs = _.findIndex(data, function (d) {
                return d.ID_WISATA == dataItem.ID_WISATA
            })
            return idxs + 1
        }
    },
    {
        field: 'NAMA_WISATA',
        title: 'Nama Provinsi',
        width: 200
    }, {
        field: 'KOTA',
        title: 'Kota',
        width: 200
    }, {
        field: 'KETERANGAN',
        title: 'Keterangan',
        width: 300
    },{
        title: 'Action',
        width: 150,
        template: "<a href=\"javascript:wisata.editWisata('#: ID_WISATA #')\" class=\"btn btn-sm btn-warning\"><i class=\"fa fa-pencil\"></i></a> &nbsp;"+
                  "<a href=\"javascript:wisata.deleteWisata('#: ID_WISATA #')\" class=\"btn btn-sm btn-danger\"><i class=\"fa fa-trash\"></i></a> &nbsp;"+
                  "<a href=\"javascript:wisata.showModalUpload('#: ID_WISATA #')\" class=\"btn btn-sm btn-info\"><i class=\"fa fa-upload\"></i></a> &nbsp;"+
                  "<a href=\"javascript:wisata.showImage('#: ID_WISATA #')\" class=\"btn btn-sm btn-info\"><i class=\"fa fa-eye\"></i></a> &nbsp;"
        // template : function (d) {
        //     var dsb = ""
        //     var tooltip = ""
        //     var href = "href=\"javascript:wisata.deleteWisata('"+d.ID_WISATA+"')\""
        //     var subdata = _.filter(wisata.dataMasterPaketHarga(), ['ID_WISATA', d.ID_WISATA]);
        //     if (subdata.length > 0) {
        //         dsb = "disabled = \"disabled\""
        //         href = ""
        //         tooltip = "data-toggle=\"tooltip\" title=\"Data ini digunakan oleh data paket harga\""
        //     }
        //     return "<a href=\"javascript:wisata.editWisata('"+d.ID_WISATA+"')\" class=\"btn btn-sm btn-warning\"><i class=\"fa fa-pencil\"></i></a> &nbsp;"+
        //            "<a "+href+"class=\"btn btn-sm btn-danger\" "+tooltip+dsb+" ><i class=\"fa fa-trash\"></i></a>"
        // }
    }]

    $('#gridwisata').kendoGrid({
        dataSource: {
            data: data,
        },
        sortable: true,
        height: 400,
        // width: 140,
        filterable: false,
        scrollable: true,
        columns: columns,
        mobile : true,
        // pageable: {
        //     refresh: true,
        //     pageSizes: true,
        //     buttonCount: 5
        // }
    })
}

wisata.saveData = function() {
	var data = ko.mapping.toJS(wisata.recordWisata)
	if (data.NAMA_WISATA == "") {
		return swal("Error","Nama wisata tidak boleh kosong","error")
	}
	if (data.KOTA == "") {
		return swal("Error","Kota tidak boleh kosong","error")
	}if (data.KETERANGAN == "") {
		return swal("Error","Keterangan tidak boleh kosong","error")
	}

	url = "wisata/SaveData"
	param = {
		Data : data
	}

	swal({
	    title: "Apakah Anda yakin?",
	    text: wisata.headerModalText()+" data",
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
        	$("#wisataModal").modal("hide")
        	model.Processing(true)
            ajaxFormPost(url, param, function(res){
                if (!res) {
                    swal("Gagal", "Gagal menyimpan data", "error")
                }else{
                    swal({
                    title: "Berhasil!",
                    text: "Data berhasil disimpan!",
                    type: "success",
                    confirmButtonColor: "#3da09a"
                    }).then(() => {
                        wisata.getDataWisata(function() {
							wisata.rendergridWisata("")
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

wisata.deleteWisata = function($ID_WISATA) {
	url = "wisata/DeleteWisata"
	param = {
		ID : $ID_WISATA
	}

	swal({
	    title: "Apakah Anda yakin?",
	    text: wisata.headerModalText()+" data",
	    type: "warning",
	    showCancelButton: true,
	    confirmButtonColor: '#d33',
	    cancelButtonColor: '#3085d6',
	    confirmButtonText: 'Yes, Delete it!',
	    cancelButtonText: 'No, cancel!',
	    buttonsStyling: true,
	    reverseButtons: false
    }).then((result) => {
        if (result.value) {
        	model.Processing(true)
            ajaxFormPost(url, param, function(res){
                if (!res) {
                    swal("Gagal", "Gagal menghapus data", "error")
                }else{
                    swal({
                    title: "Berhasil!",
                    text: "Data berhasil dihapus!",
                    type: "success",
                    confirmButtonColor: "#3da09a"
                    }).then(() => {
                        wisata.getDataWisata(function() {
							wisata.rendergridWisata("")
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

wisata.editWisata = function(ID_WISATA) {
	var data = _.filter(wisata.dataMasterWisata(), ['ID_WISATA', ID_WISATA]);
    ko.mapping.fromJS(data[0], wisata.recordWisata)
    
    wisata.headerModalText("Edit")
    wisata.showAdd(false)
    wisata.showEdit(true)
    $("#wisataModal").modal("show")
}

wisata.modalClosed = function(){
    $('#wisataModal').on('hidden.bs.modal', function () {
        ko.mapping.fromJS(wisata.newRecordWisata(), wisata.recordWisata)

        wisata.headerModalText("Tambah")
        wisata.showAdd(true)
        wisata.showEdit(false)
    })
}

wisata.searchWhenEnterPressed = function(){
    $("#textSearchID").on('keyup', function (e) {
        if (e.keyCode == 13) {
            wisata.search()
        }
    });
}

wisata.textSearch.subscribe(function(e) {
	if (e == "") {
		wisata.rendergridWisata("")
	}
})

wisata.search = function() {
	wisata.rendergridWisata(wisata.textSearch())
}

wisata.showModalUpload = function(ID) {
    $("#uploadFileModal").modal("show")
    wisata.idWisata(ID)
}

wisata.uploadImage = function() {
    // console.log(wisata.idWisata);
    var formData = new FormData()
    var attachment = document.getElementById("inputImage")
    formData.append("fileUpload", attachment.files[0]);
    formData.append("ID", wisata.idWisata());
    if (attachment.files.length == 0) {
        return swal('Error', 'Anda belum menginputkan bukti transfer', 'error')
    }

    var url = base_url+"index.php/wisata/UploadImage"
    
    ajaxFilePost(url, formData, function(res) {
        if (res == "success") {
            $("#uploadFileModal").modal("hide")
            swal({
            title: "Berhasil!",
            text: "Data berhasil dihapus!",
            type: "success",
            confirmButtonColor: "#3da09a"
            }).then(() => {
                wisata.getDataWisata(function() {
                    wisata.rendergridWisata("")
                })
            });
        }else{
            swal("Error",res,"error")
        }
    })
}

wisata.showImage = function(ID) {
    var data = _.filter(wisata.dataMasterWisata(), ['ID_WISATA', ID]);
    url = base_url+"assets/uploads/"+data[0].GAMBAR
    // console.log(data)
    $( "#imageWisata" ).attr( "src", url);
    $("#lihatGambarModal").modal("show")
}

wisata.init = function () {
	wisata.getDataWisata(function() {
		wisata.rendergridWisata("")
	})
}

$(function() {
	wisata.init()
	wisata.searchWhenEnterPressed()
	wisata.modalClosed()
})