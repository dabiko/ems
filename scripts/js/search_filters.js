

/**Function to get search results for Invoice by names **/
function searchResults() {
    var searchData = document.getElementById('searchData').value;
    var pagination = document.getElementById('pagination-setting').value;
    var rowCount = " ";
    if (searchData.length !== 0) {
        $.ajax({
            url: "searchResults",
            type: "GET",
            data: {"searchData": searchData, "pagination-setting": pagination, "searchCount": rowCount},
            beforeSend: function () {
                $("#overlay").show();
            },
            success: function (data) {
                $("#pagination-result").html(data);
                setInterval(function () {
                    $("#overlay").hide();
                }, 3000);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });

    } else {
        swal({
            position: 'canter',
            type: 'info',
            title: 'Sorry your search box is empty ',
            showConfirmButton: true
        });
    }

}
/**Function that searches base on the method of payment */
function paymentMethod(option){
    if (option === "all"){
        $("#refreshPage").trigger("click");
    }else{

        $.ajax({
            url: "searchFilters",
            type: "GET",
            data:  {"option":option,"payment_method":"payment_method"},
            beforeSend: function(){$("#overlay").show();},
            success: function(data){
                $("#pagination-result").html(data);
                setInterval(function() {
                    $("#overlay").hide();
                },3000);
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(thrownError);
            }
        });

    }

}


/**Function that searches base on the invoice status */
function searchStatus(option){
    if (option === "all"){
        $("#refreshPage").trigger("click");
    }else{

        $.ajax({
            url: "searchFilters",
            type: "GET",
            data:  {"option":option,"invoice_status":"invoice_status"},
            beforeSend: function(){$("#overlay").show();},
            success: function(data){
                $("#pagination-result").html(data);
                setInterval(function() {
                    $("#overlay").hide();
                },3000);
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(thrownError);
            }
        });

    }

}