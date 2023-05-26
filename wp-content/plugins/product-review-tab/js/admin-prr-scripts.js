jQuery(document).on("keyup", "#search_product", function () {
    var value = jQuery(this).val();
    var form_data = {
        action: "search_product_search_post_prr",
        value,
    }
    if(value.length < 3) {
        return false;
    }
    jQuery.ajax({
        url: jQuery("#search_product-ajax").val(),
        type: "POST",
        data: form_data,
        dataType: "json",
        async: true
    }).done(function ajaxDone(res) {
        console.log(res);
        var _container = jQuery(".search_product-container");
        if(res) {
            _container.html("");
            res.forEach(product => {
                _container.append(jQuery(`
                <label>
                <input type="radio" name="product_product_review" value="`+product.id+`" />

                `+product.title+`
                </label>
            `));
            })
        }
        
    }).fail(function ajaxFailed(error) {
        console.log(error);
    });
});