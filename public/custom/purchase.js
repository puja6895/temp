$(document).ready(function () {

    var counter = 0;
    // var subTotal = 0;
    // var totalGst = 0;
    // var grandTotal = 0;

    $("#addrow").on("click", function () {

        var newRow = $("<tr>");
        var cols = "";

        cols += '<td class="col-md-2"><input readonly  value="'+$('#product_id0').children("option:selected").text()+'" type="text" name="product_name[]" required="" placeholder="Product"><input type="hidden" value="'+$('#product_id0').children("option:selected").val()+'" name="product_id[]" value=""></td>';
        cols += '<td class="col-md-2"><input readonly class="col-sm-12" type="text" name="unit_name[]" placeholder="Unit" required value="'+$('#unit_id0').children("option:selected").text()+'"> <input type="hidden" name="unit_id[]" value="'+$('#unit_id0').children("option:selected").val()+'" ></td>';
        cols += '<td class="col-md-2"><div class="input-group"><span class="input-group-addon"><i class="fa fa-inr"></i></span><input readonly type="text" class="form-control" name="rate[]" required value="'+$('#rate0').val()+'"></div></td>';
        cols += '<td class="col-md-2"><input readonly class="col-sm-12" type="number" name="quantity[]" value="'+$('#quantity0').val()+'" required></td>';
        cols += '<td class="col-md-2"><div class="input-group"><input readonly type="text" class="form-control" name="gst[]" required value="'+$('#gst0').val()+'"><span class="input-group-addon">%</span></div></td>';
        cols += '<td class="col-md-2"><div class="input-group"><span class="input-group-addon"><i class="fa fa-inr"></i></span><input readonly type="text" class="form-control" name="total[]" required value="'+$('#total0').val()+'"></div></td>';

        cols += '<td class="col-md-1"><button type="button" class="btn btn-xs btn-danger ibtnDel"><i class="fa fa-trash"></i></button></td>';
        newRow.append(cols);
        $("#purchaseTable").append(newRow);
        counter++;

        // // Update Total 
        // subTotal = parseInt(subtotal) + (parseInt($("#rate0").val()) * parseInt($("#quantity0")));
        // $("#subTotal").text(subtotal);

        // totalGst = parseInt(totalGst)
        // $("#product_id0").val("0").change();
        // $("#product_id0").text("Product");
        $("#unit_id0").val("0").change();
        // $("#unit_id0").text('Unit');
        $('#rate0').val(0);
        $('#quantity0').val(1);
        $('#gst0').val(0);
        $('#total0').val(0);
    });



    $("#purchaseTable").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });


});

function setDefault(){
    var product_id = $('#product_id0').children("option:selected").val();
    var unit_id = $('#unit_id0').children("option:selected").val();
    $(".loading").show();
    $.ajax({
            type: "GET",
            url:'/product/default/'+product_id,
            dataType : 'json',
            success: function( response ) {
                // console.log(response);
                $(".loading").hide();
                $("#unit_id0").val(response.unit_id).change();
                $("#unit_id0").attr('disabled',true);
                $('#rate0').val(response.purchase_price);
                $('#gst0').val(response.gst ? response.gst : 0);
                $('#quantity0').val(1);
                var total = parseInt(response.purchase_price) + ((parseInt(response.gst) / 100) * parseInt(response.purchase_price));
                $('#total0').val($.isNumeric(total) ? total : 0);


            }
        });
    // console.log(unit_id);
}

function claculateTotal(){
    var rate = $('#rate0').val();
    var gst = $('#gst0').val();
    var quant = $('#quantity0').val();
    var total = (parseInt(rate) + ((parseInt(gst) / 100) * parseInt(rate))) * parseInt(quant);
    $('#total0').val($.isNumeric(total) ? total : 0);
}

function calculateRow(row) {
    var price = +row.find('input[name^="price"]').val();

}

function calculateGrandTotal() {
    var grandTotal = 0;
    $("table.order-list").find('input[name^="price"]').each(function () {
        grandTotal += +$(this).val();
    });
    $("#grandtotal").text(grandTotal.toFixed(2));
}