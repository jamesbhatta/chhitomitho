$(document).ready(function () {
    $('.qty-minus-btn').click(function () {
        var quantity = $(this).parent().parent().find('.quantity');
        var qty = parseInt(quantity.val());
        var min = parseInt(quantity.attr('min'));
        if(qty > 1 && qty > min){
            quantity.val(qty-1);
        }
    });
    
    $('.qty-plus-btn').click(function () {
        var quantity = $(this).parent().parent().find('.quantity');
        var qty = parseInt(quantity.val());
        if(qty < 99){
            quantity.val(qty+1);
        }
    });
    
    $('.add-to-cart-btn').click(function () {
        $(this).attr('disabled', 'true');
        $(this).html('<i class="fas fa-circle-notch fa-spin"></i> Adding');
        var id = $(this).data('product-id');
        var quantity = parseInt($(this).parent().find('.quantity').val()) ;
        var button = this;
        $.ajax({
            // url: "{{ route('cart.add') }}",
            url: '/cart/add',
            type: 'POST',
            data: {id: id, quantity: quantity},
        })
        .done(function(response) {
            console.log(response);
            if(response.status == 200) {
            }
        })
        .fail(function(response) {
            console.log("error");
            console.log(response);
        })
        .always(function() {
            App.loadCartSummary();
        });
        setTimeout(() => {
            $(this).html('<i class="fas fa-shopping-basket mr-2"></i> Add to Cart');
        }, 1000);
        $(this).removeAttr('disabled');
    });
});