


/**Function that prints the  all Main  category names */
function printMain() {
    swal({
        title: 'Confirm your request..',
        text: "You want a PDF file for all Main Categories?",
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Yes!!'+' <i class="icofont icofont-download-alt"></i>',
        cancelButtonText: 'No!!'+' <i class="icofont icofont-close-circled"></i>',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: true
    }).then(function () {

        var ajax = new XMLHttpRequest();
        ajax.open("GET", "pdfMain", true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                if (ajax.responseText) {
                    swal({
                        title: "Error.. !!!",
                        text: "PDF not printed.",
                        type: 'error',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            }

        };
        ajax.send();

    }, function (dismiss) {
        // dismiss can be 'cancel', 'overlay',
        // 'close', and 'timer'
        if (dismiss === 'cancel') {
            swal(
                'Cancelled',
                'Request Cancelled:)',
                'info'
            )
        }
    })

}



/**Function that prints the  all Sub  category names */
function printSub() {
    swal({
        title: 'Confirm your request..',
        text: "You want a PDF file for all Sub Categories?",
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Yes!!'+' <i class="icofont icofont-download-alt"></i>',
        cancelButtonText: 'No!!'+' <i class="icofont icofont-close-circled"></i>',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: true
    }).then(function () {

        var ajax = new XMLHttpRequest();
        ajax.open("GET", "pdfSub", true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                if (ajax.responseText) {
                    swal({
                        title: "Error.. !!!",
                        text: "PDF not printed.",
                        type: 'error',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            }

        };
        ajax.send();

    }, function (dismiss) {
        // dismiss can be 'cancel', 'overlay',
        // 'close', and 'timer'
        if (dismiss === 'cancel') {
            swal(
                'Cancelled',
                'Request Cancelled:)',
                'info'
            )
        }
    })

}



/**Function that prints the  all Equipments names */
function printEquipments() {
    swal({
        title: 'Confirm your request..',
        text: "You want a PDF file for all Equipments/Items?",
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Yes!!'+' <i class="icofont icofont-download-alt"></i>',
        cancelButtonText: 'No!!'+' <i class="icofont icofont-close-circled"></i>',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: true
    }).then(function () {

        var ajax = new XMLHttpRequest();
        ajax.open("GET", "pdfEquip", true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                if (ajax.responseText) {
                    swal({
                        title: "Error.. !!!",
                        text: "PDF not printed.",
                        type: 'error',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            }

        };
        ajax.send();

    }, function (dismiss) {
        // dismiss can be 'cancel', 'overlay',
        // 'close', and 'timer'
        if (dismiss === 'cancel') {
            swal(
                'Cancelled',
                'Request Cancelled:)',
                'info'
            )
        }
    })

}




/**Function that prints the  all System Logs names */
function printLogs() {
    swal({
        title: 'Confirm your request..',
        text: "You want a PDF file for all System Logs?",
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Yes!!'+' <i class="icofont icofont-download-alt"></i>',
        cancelButtonText: 'No!!'+' <i class="icofont icofont-close-circled"></i>',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: true
    }).then(function () {

        var ajax = new XMLHttpRequest();
        ajax.open("GET", "pdfLogs", true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                if (ajax.responseText) {
                    swal({
                        title: "Error.. !!!",
                        text: "PDF not printed.",
                        type: 'error',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            }

        };
        ajax.send();

    }, function (dismiss) {
        // dismiss can be 'cancel', 'overlay',
        // 'close', and 'timer'
        if (dismiss === 'cancel') {
            swal(
                'Cancelled',
                'Request Cancelled:)',
                'info'
            )
        }
    })

}



/**Function that prints the  all System Users */
function printUsers() {
    swal({
        title: 'Confirm your request..',
        text: "You want a PDF file for all System User?",
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Yes!!'+' <i class="icofont icofont-download-alt"></i>',
        cancelButtonText: 'No!!'+' <i class="icofont icofont-close-circled"></i>',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: true
    }).then(function () {

        var ajax = new XMLHttpRequest();
        ajax.open("GET", "pdfUsers", true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                if (ajax.responseText) {
                    swal({
                        title: "Error.. !!!",
                        text: "PDF not printed.",
                        type: 'error',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            }

        };
        ajax.send();

    }, function (dismiss) {
        // dismiss can be 'cancel', 'overlay',
        // 'close', and 'timer'
        if (dismiss === 'cancel') {
            swal(
                'Cancelled',
                'Request Cancelled:)',
                'info'
            )
        }
    })

}




/**Function that prints the Invoice*/
function printInvoice(ID) {

    swal({
        title: 'Confirm your request..',
        text: "You want to print this Invoice?",
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Yes!!'+' <i class="icofont icofont-download-alt"></i>',
        cancelButtonText: 'No!!'+' <i class="icofont icofont-close-circled"></i>',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: true
    }).then(function () {

        var formData = new FormData();
        formData.append("pri_id", ID);
        var ajax = new XMLHttpRequest();
        ajax.open("POST", "pdfInvoice", true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                if (ajax.responseText == 1) {
                    swal({
                        title: "Hmmm... !!!",
                        text: "You Must be a Robot.",
                        imageUrl: 'script/img/robot.jpg',
                        type: 'error',
                        timer: 9000,
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                    RedirectToPage('logOut');
                }
            }

        };
        ajax.send(formData);

    }, function (dismiss) {
        // dismiss can be 'cancel', 'overlay',
        // 'close', and 'timer'
        if (dismiss === 'cancel') {
            swal(
                'Cancelled',
                'Request Cancelled:)',
                'info'
            )
        }
    })

}