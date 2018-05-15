var home = {}

home.dataMasterWisata = ko.observableArray([])


// home.newDataItem = function() {
// 	var data = {
//         ID_WISATA : "",
//         NAMA_WISATA : "",
//         KOTA : "",
//         KETERANGAN : "",

//     }

//     return data;
// }
// home.dataItem = ko.mapping.fromJS(home.newDataItem())

home.getDataWisata = function() {
	model.Processing(true);
	ajaxPost("home/GetDataWisata",{},function(res) {
		var result = JSON.parse(res)
		var URL = base_url+"assets/uploads/"
		for (var i = 0; i < result.length; i++) {
			if (result[i].GAMBAR != null) {
				result[i].IMAGE_PATCH = URL+result[i].GAMBAR
			} else {
				result[i].IMAGE_PATCH = base_url+"assets/image/default.jpg"
			}
		}
		home.dataMasterWisata(result);
		model.Processing(false);
	})
}

home.pesan = function(data) {
	id = data.ID_WISATA
	window.location.assign(base_url+"index.php/pesan/index/"+id)
}

home.init = function () {
	home.getDataWisata()
}

$(function() {
	home.init()
})