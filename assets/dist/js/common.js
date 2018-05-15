function ajaxPost(url, data, fnOk, fnNok) {
    $.ajax({
        url: url,
        type: 'POST',
        data: ko.mapping.toJSON(data),
        //data: data, 
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            if (typeof fnOk == "function") fnOk(data);
            koResult = "OK";
        },
        error: function (error) {
            if (typeof fnNok == "function") {
                fnNok(error);
            }
            else {
                alert("There was an error posting the data to the server: " + error.responseText);
            }
        }
    });
}

function ajaxFormPost(url, data, fnOk, fnNok) {
    $.ajax({
        url: url,
        type: 'POST',
        data: data, 
        dataType: "JSON",
        success: function (data) {
            if (typeof fnOk == "function") fnOk(data);
            koResult = "OK";
        },
        error: function (error) {
            if (typeof fnNok == "function") {
                fnNok(error);
            }
            else {
                alert("There was an error posting the data to the server: " + error.responseText);
            }
        }
    });
}

function ajaxFilePost(url, formData, fnOk, fnNok) {
    $.ajax({
        url: url,
        data: formData,
        contentType: false,
        dataType: "json",
        mimeType: 'multipart/form-data',
        processData: false,
        type: 'POST',
        success: function (data) {
            if (typeof fnOk == "function") fnOk(data);
            koResult = "OK";
        },
        error: function (error) {
            if (typeof fnNok == "function") {
                fnNok(error);
            }
            else {
                alert("There was an error posting the data to the server: " + error.responseText);
            }
        }
    });
}


function firstLetterUpparcase(str) {
    // var str = "test AAALL data NGwir AVLE";
    str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
    return letter.toUpperCase();
    });

    return str;
}

function ChangeToRupiah(angka) {
    if (angka >= 0) {
        var TotString = kendo.toString(angka, "n");
        return TotString;
    } else {
        var TotminString = kendo.toString(Math.abs(angka), "n");
        return "(" + TotminString + ")";
    }
}

function FormatCurrency(angka) {
    var nilaiangka = kendo.toString(angka, "n");
    var nom = Number(nilaiangka.replace(/[^0-9\.]+/g, ""));
    return nom
}

function SetTenggangWaktu(dateorder, datedepart, time) {
    var deadline = 0;
    var date1 = new Date(dateorder);
    var date2 = new Date(datedepart);
    var timeDiff = Math.abs(date2.getTime() - date1.getTime());
    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

    if (diffDays > 2) {
        deadline = 12
    }
    if (diffDays == 2) {
        deadline = 6
    } if (diffDays == 1) {
        deadline = 2
    }

    // var newdate = new Date(dateorder+"  "+time).addHours(deadline);

    var newdate = new Date(dateorder+" "+time);
    var nextdate = new Date(newdate.setHours(newdate.getHours()+deadline));
    // return moment(nextdate).format("YYYY-MM-DD hh:mm:ss");
    return nextdate
}

function setDateMin() {
    var date = new Date();
    date.setDate(date.getDate() + 2);

    return date
}

function countDownTime(dateToCount, id) {
    // console.log(dateToCount)
    var DateToCount = new Date(dateToCount)
    var x = setInterval(function() {
        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = DateToCount - now;

        // Time calculations for days, hours, minutes and seconds
        // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById(id).innerHTML = hours + "jam "+ minutes + "menit " + seconds+"detik";

        // If the count down is finished, write some text 
        if (distance < 0) {
        clearInterval(x);
            window.location.assign(base_url+"index.php/history")
            // document.getElementById(id).innerHTML = "EXPIRED";
        }
    }, 1000);
}


