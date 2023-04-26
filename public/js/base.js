const modalUpdateProduct = $('#modalUpdateProduct');
$('.btn-edit').on('click', function (e) {
    e.preventDefault();
    const action = $(this).data('action');
    const product_name = $(this).data('name');
    const product_desc = $(this).data('desc');
    const product_image = $(this).data('image');
    const product_image_path = $(this).data('image_path');
    const product_price = $(this).data('price');
    const product_status = $(this).data('status');
    modalUpdateProduct.find('.product_image').val(product_image);
    modalUpdateProduct.find('.product_image_view img').attr('src', product_image_path);
    modalUpdateProduct.find('.product_name').val(product_name);
    modalUpdateProduct.find('.product_desc').val(product_desc);
    modalUpdateProduct.find('.product_price').val(product_price);
    if (parseInt(product_status)) {
        modalUpdateProduct.find('.product_status').prop('checked', true);
    } else {
        modalUpdateProduct.find('.product_status').prop('checked', false);
    }
    modalUpdateProduct.find('form').attr("action", action);
    modalUpdateProduct.modal('show');
});
$('.input-product-status').on('change', function (e) {
    e.preventDefault();
    const route = $(this).data('route');
    const status = $(this).data('status') && parseInt($(this).data('status')) === 1 ? 0 : 1;
    $.ajax({
        url: $(this).data('route'),
        data: { status, _token: $('meta[name="csrf-token"]').attr('content') },
        type: "PUT",
    }).done(function (result) {
        console.log(result);
    });
});
const rootDeleteOrder = $('#modalDeleteOrder');
$('.btn-remove-order').on('click', function (e) {
    e.preventDefault();
    const action = $(this).data('action');
    rootDeleteOrder.find('form').attr('action', action);
    rootDeleteOrder.modal('show');
});
