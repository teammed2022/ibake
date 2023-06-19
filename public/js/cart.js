/**
 *  For updating the quantity of an itme
 * in the user cart page.
 * Updates the item quantity and
 * total item price
 *
 */
function updateQuantity(e) {
    e.preventDefault();
    // Get cart item information
    let quantity = $(e).val();
    let productId = $(e).data("productid");
    let cartId = $(e).data("cartid");
    let productPrice = $(e).data("productprice");
    let token = $(e).data("token");
    let total = quantity * productPrice;

    let totalPrice = 0;

    // Update cart item quantity
    $.ajax({
        url: "/cart/update-cart-quantity",
        type: "PUT",
        data: {
            quantity: quantity,
            productId: productId,
            cartId: cartId,
            _token: token,
        },
        success: function (response) {
            $(
                'span.item-total-price[data-cartId="' +
                    cartId +
                    '"][data-productId="' +
                    productId +
                    '"]'
            ).text("Php " + total);
            $("span.amount").each(function () {
                let amount = parseInt($(this).text().replace("Php", "").trim());
                totalPrice += amount;
            });
            $("span.col.price").text("Php " + totalPrice);
            $("span.col.total-price").text("Php " + totalPrice);
            console.log(totalPrice);
        },
        error: function (xhr) {
            // Handle error response
            console.log(`error\n` + xhr);
        },
    });
}

$(document).ready(function () {
    $("#addToCartForm").on("submit", function (e) {
        e.preventDefault();
        let formData = $(this).serialize();
        console.log(formData);
        let successMsg =
            '<div class="alert alert-success" role="alert">Item successfully added to cart!</div>';
        let failedMsg =
            '<div class="alert alert-danger" role="alert">Failed to add item to cart!</div>';

        $.ajax({
            url: "/cart/add-to-cart",
            type: "POST",
            data: formData,
            success: function (response) {
                console.log(`response\n` + JSON.stringify(response));
                $("#cart-widget-container").html(response.cartWidget);
                $(".cart-msg-container").html(successMsg);

                // Handle the response from the server
            },
            error: function (xhr, status, error) {
                $(".cart-msg-container").html(failedMsg);
                // Handle error response
                console.log(xhr.responseJSON);
                console.log("status: " + status);
                console.log("error: " + error);
            },
        });
    });
});