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

	if (data.USERNAME_CUSTOMER == "") {
		return swal("error","Username belum diisi","error")
	}
	if (data.PASSWORD_CUSTOMER == "") {
		return swal("error","Password belum diisi","error")
	}
	if (data.NAMA_CUSTOMER == "") {
		return swal("error","Nama belum diisi","error")
	}
	if (data.NOMOR_TELPON_CUSTOMER == "") {
		return swal("error","Nomor Telpon belum diisi","error")
	}
	if (data.ALAMAT_CUSTOMER == "") {
		return swal("error","Alamat belum diisi","error")
	}
	url = "login_page/DoRegister"
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
                if (res != "OK") {
                    swal("Gagal", res, "error")
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

login.doLogin = function() {
	data = ko.mapping.toJS(login.recordLogin)

	if (data.USERNAME_CUSTOMER == "") {
		return swal("error","Username belum diisi","error")
	}
	if (data.PASSWORD_CUSTOMER == "") {
		return swal("error","Password belum diisi","error")
	}
	
	url = "login_page/DoLogin"
	param = {
		Data : data
	}


	model.Processing(true)
    ajaxFormPost(url, param, function(res){
        if (res != "OK") {
            swal("Gagal", res, "error")
        }else{
        	$("#loginModal").modal("hide")
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
}

login.modalClosed = function(){
    $('#loginModal').on('hidden.bs.modal', function () {
        ko.mapping.fromJS(login.newRecordLogin(), login.recordLogin)
    })
}

// login.init = function() {
// 	console.log("MASUK")
// }
$(function() {
	login.modalClosed()
})