var pesan = {}

pesan.dataMasterPaket = ko.observableArray([])
pesan.visibleKuota = ko.observable(true)

pesan.newRecordPesana = function() {
	var data = {
		ID_ORDER	: "",
		ID_CUSTOMER : "",
		ID_PAKET	: "",
		KUOTA_PESAN	: 1,
		TOTAL_TRANSAKSI		: 0,
		TANGGAL_TRANSAKSI	: "",
		TANGGAL_BERANGKAT	: "",
		TANGGAL_KEMBALI		: "",
		BUKTI_BAYAR			: "",

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
	ko.mapping.fromJS(data[0], pesan.recordPesan)
})

pesan.recordPesan.KUOTA_PESAN.subscribe(function(e) {
	tot = parseInt(e)*parseInt(pesan.recordPesan.HARGA())
	pesan.recordPesan.TOTAL_TRANSAKSI(ChangeToRupiah(tot))
})

pesan.init = function() {
	pesan.getDataPaket()
}

$(function() {
	pesan.init()
})