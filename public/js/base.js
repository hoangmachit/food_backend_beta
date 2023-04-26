const modalUpdateProduct = $("#modalUpdateProduct");
$(".btn-edit").on("click", function (e) {
    e.preventDefault();
    const action = $(this).data("action");
    const product_name = $(this).data("name");
    const product_desc = $(this).data("desc");
    const product_image = $(this).data("image");
    const product_image_path = $(this).data("image_path");
    const product_price = $(this).data("price");
    const product_status = $(this).data("status");
    modalUpdateProduct.find(".product_image").val(product_image);
    modalUpdateProduct
        .find(".product_image_view img")
        .attr("src", product_image_path);
    modalUpdateProduct.find(".product_name").val(product_name);
    modalUpdateProduct.find(".product_desc").val(product_desc);
    modalUpdateProduct.find(".product_price").val(product_price);
    if (parseInt(product_status)) {
        modalUpdateProduct.find(".product_status").prop("checked", true);
    } else {
        modalUpdateProduct.find(".product_status").prop("checked", false);
    }
    modalUpdateProduct.find("form").attr("action", action);
    modalUpdateProduct.modal("show");
});
$(".input-product-status").on("change", function (e) {
    e.preventDefault();
    const route = $(this).data("route");
    const status =
        $(this).data("status") && parseInt($(this).data("status")) === 1
            ? 0
            : 1;
    $.ajax({
        url: route,
        data: { status, _token: $('meta[name="csrf-token"]').attr("content") },
        type: "PUT",
    }).done(function (result) {
        console.log(result);
    });
});
const rootDeleteOrder = $("#modalDeleteOrder");
$(".btn-remove-order").on("click", function (e) {
    e.preventDefault();
    const action = $(this).data("action");
    rootDeleteOrder.find("form").attr("action", action);
    rootDeleteOrder.modal("show");
});
// remove product
$(".btn-remove").on("click", function (e) {
    e.preventDefault();
    if (confirm("Are you sure delete it!!!")) {
        const action = $(this).data("action");
        $("#form-remove-product").attr("action", action).submit();
    }
});
//
const tableOrder = $(".tableOrder");
$(".form-check-all").on("change", function (e) {
    e.preventDefault();
    const this_checkbox = $(this);
    tableOrder.find("tbody tr").each(function (index) {
        let checkbox = $(this).find(".form-checkbox-order input");
        if (this_checkbox.prop("checked")) {
            checkbox.prop("checked", true);
        } else {
            checkbox.prop("checked", false);
        }
    });
});

function getDataOrder() {
    return $("input[name='bulk[]']")
        .map(function () {
            if ($(this).prop("checked")) {
                return $(this).val();
            }
        })
        .get();
}
const rootBulk = $(".bulk-order");
rootBulk.find("button").on("click", function (e) {
    if (!getDataOrder().length) {
        return false;
    }
    const status = $(this).val();
    const redirect = rootBulk.data("redirect");
    $.ajax({
        url: rootBulk.data("route"),
        type: "POST",
        data: {
            status: status,
            ids: getDataOrder(),
            _method: "PUT",
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (result) {
            if (result) {
                window.location.href = redirect;
            }
        },
        complete: function (result) {},
        error: function (error) {
            console.log(error);
        },
    });
});
