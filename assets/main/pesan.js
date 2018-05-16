var pesan = {}

pesan.dataMasterPaket = ko.observableArray([])
pesan.visibleKuota = ko.observable(true)
pesan.maksimal = ko.observable()

pesan.newRecordPesana = function() {
	var data = {
		ID_ORDER	: "",
		ID_CUSTOMER : "",
		ID_PAKET	: "",
		KUOTA_PESAN	: 1,
		TOTAL_TRANSAKSI		: 0,
		TANGGAL_TRANSAKSI	: "",
		TANGGAL_BERANGKAT	: moment(setDateMin()).format("YYYY-MM-DD"),
		TANGGAL_KEMBALI		: "",
		BUKTI_BAYAR			: "",
		STATUS				: "",

		KUOTA_MINIMAL	: "",
		KUOTA_MAKSIMAL	: "",
		HARGA			: 0,
		JENIS_HARGA		: "",
		DURASI_WISATA	: 0
	}

	return data;
}
pesan.recordPesan = ko.mapping.fromJS(pesan.newRecordPesana())

pesan.getDataPaket = function() {
	var str = window.location.href;
	str = str.split("/");
	var id = str[7];

	var url = base_url+"index.php/pesan/GetPaket/"+id;
	$.getJSON(url,function(data) {
		pesan.dataMasterPaket(data)
	})
}

pesan.recordPesan.ID_PAKET.subscribe(function(e) {
	var data = _.filter(pesan.dataMasterPaket(), ['ID_PAKET', e]);
	pesan.maksimal(data[0].KUOTA_MAKSIMAL)
	if (data[0].JENIS_HARGA == "total") {
		// $("#kuotaPesan").attr("disabled","disabled")
		pesan.visibleKuota(false)
		tot = parseInt(data[0].HARGA)
		pesan.recordPesan.TOTAL_TRANSAKSI(ChangeToRupiah(tot))
	}else{
		// $("#kuotaPesan").removeAttr("disabled")
		pesan.visibleKuota(true)
		tot = parseInt(data[0].HARGA)*parseInt(pesan.recordPesan.KUOTA_PESAN())
		pesan.recordPesan.TOTAL_TRANSAKSI(ChangeToRupiah(tot))
	}

	dateStart = new Date(pesan.recordPesan.TANGGAL_BERANGKAT());
	dateStart.setDate(dateStart.getDate()+parseInt(data[0].DURASI_WISATA));
	data[0].TANGGAL_KEMBALI = moment(dateStart).format("YYYY-MM-DD");
	ko.mapping.fromJS(data[0], pesan.recordPesan)

	pesan.getKuotaTerpakai()
})

pesan.recordPesan.KUOTA_PESAN.subscribe(function(e) {
	tot = parseInt(e)*parseInt(pesan.recordPesan.HARGA())
	pesan.recordPesan.TOTAL_TRANSAKSI(ChangeToRupiah(tot))
})

pesan.recordPesan.TANGGAL_BERANGKAT.subscribe(function (e) {
	dateStart = new Date(e);
	dateStart.setDate(dateStart.getDate()+parseInt(pesan.recordPesan.DURASI_WISATA()));
	tglkembali = moment(dateStart).format("YYYY-MM-DD");
	pesan.recordPesan.TANGGAL_KEMBALI(tglkembali)

	pesan.getKuotaTerpakai()
})


pesan.prosesPesan = function() {
	var data = ko.mapping.toJS(pesan.recordPesan)

	if (data.ID_PAKET == "") {
		swal("error","anda memilh paket","error")
	}
	if (data.JENIS_HARGA == "perorangan") {
		if (parseInt(data.KUOTA_PESAN) < parseInt(data.KUOTA_MINIMAL)) {
			return swal("error","kuota anda kurang dari kuota minimal","error")
		}
		if (parseInt(data.KUOTA_PESAN) > parseInt(data.KUOTA_MAKSIMAL)) {
			return swal("error","kuota anda melebihi batas maksimal","error")
		}
	}else{
		data.KUOTA_PESAN = data.KUOTA_MAKSIMAL
	}

	data.TOTAL_TRANSAKSI = FormatCurrency(data.TOTAL_TRANSAKSI)

	url = base_url+"index.php/pesan/ProsesPesan"
    param = {
        Data: data
    }


    swal({
        title: "Apakah Anda yakin?",
        text: "Memesan memesan pake ini",
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
                    	window.location.assign(base_url+"index.php/home")
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

pesan.getKuotaTerpakai = function() {
	var data = {
		ID_PAKET			: pesan.recordPesan.ID_PAKET(),
		TANGGAL_BERANGKAT	: pesan.recordPesan.TANGGAL_BERANGKAT(),
		TANGGAL_KEMBALI		: pesan.recordPesan.TANGGAL_KEMBALI()
	}

	var url = base_url+"index.php/pesan/GetKuota"

	var param = {
		Data : data
	}

	ajaxFormPost(url,param,function(data) {
		// var kuota = pesan.recordPesan.KUOTA_MAKSIMAL();
		var terpakai = parseInt(data.TERPAKAI)
		var maks = parseInt(data.KUOTA_MAKSIMAL)
		var min = parseInt(data.KUOTA_MINIMAL)
		// console.log(data)
		if (terpakai > 0) {
			if ((maks - terpakai) > min) {
				pesan.recordPesan.KUOTA_MAKSIMAL(maks - terpakai)
			}else{
				pesan.recordPesan.KUOTA_MAKSIMAL(maks - terpakai)
				swal("Warning","paket telah habis, silahkan mengganti tanggal atau paket","warning")
			}
		}else{
			pesan.recordPesan.KUOTA_MAKSIMAL(pesan.maksimal())
		}
	})
}

pesan.init = function() {
	pesan.getDataPaket()
}

$(function() {
	pesan.init()
})