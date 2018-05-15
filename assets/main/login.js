var login = {}

login.newRecordRegister = function() {
	var data = {
		ID_CUSTOMER : "",
		USERNAME_CUSTOMER : "",
		PASSWORD_CUSTOMER : "",
		NOMOR_TELPON_CUSTOMER : "",
		NAMA_CUSTOMER : "",
		ALAMAT_CUSTOMER : ""
	}
	return data;
}
login.recordRegister = ko.mapping.fromJS(login.newRecordRegister())

login.newRecordLogin = function() {
	var data = {
		USERNAME_CUSTOMER : "",
		PASSWORD_CUSTOMER : ""
	}

	return data;
}
login.recordLogin = ko.mapping.fromJS(login.newRecordLogin())

login.doRegister = function() {
	data = ko.mapping.toJS(login.recordRegister)
	url = "login/DoRegister"
	param = {
		Data : data
	}

	swal({
	    title: "Apakah Anda yakin?",
	    text: "menyimpan data",
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
        	// $("#wisataModal").modal("hide")
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

// login.init = function() {
// 	console.log("MASUK")
// }
// $(function() {
// 	login.init()
// })