document.addEventListener('DOMContentLoaded', function () {
    //Delete Product
    const deleteButtons = document.querySelectorAll('.Cart-delete');
    Array.prototype.forEach.call(deleteButtons, function (item) {
        item.addEventListener('click', function (event) {
            event.preventDefault();
            axios.delete(item.closest('[data-link]').dataset.link)
                .then(response => {
                    if (response.data.status) {
                        location.reload();
                    }
                })
            ;
        });
    });

    //Change Seller
    const sellerSelectElements = document.querySelectorAll('.Cart-block_seller .form-select');
    Array.prototype.forEach.call(sellerSelectElements, function (item) {
        item.addEventListener('change', function (event) {
            updateProduct(item, {'seller': event.target.value})
        });
    });

    //Change Quantity
    const amountElements = document.querySelectorAll('.Amount');
    Array.prototype.forEach.call(amountElements, function (item) {
        Array.prototype.forEach.call(item.querySelectorAll('button'), function (button) {
            button.addEventListener('click', function () {
                evt = document.createEvent('HTMLEvents');
                evt.initEvent("change", false, true)
                setTimeout(() => item.querySelector('input').dispatchEvent(evt), 0);
            })
        });
        item.querySelector('input').addEventListener('change', function (event) {
            updateProduct(item, {'quantity': event.target.value});
        });
    });

    function updateProduct(item, data) {
        axios.put(item.closest('[data-link]').dataset.link, data)
            .then(response => {
                if (response.data.status) {
                    location.reload();
                }
            })
        ;
    }
});

$(document).ready($ => {
    const form = $('form#checkout');
    form.find('input, textarea').on('change', function (event) {
        $('#type-' + this.name).text($(this).val());
    });
    form.find("input[type=radio]").on('change', function (event) {
        $('#type-' + this.name).text($(this).nextAll('.toggle-text').text());
    });
    form.find('.btn.btn-success').click(function (event) {
        console.log(event);
    });

    form.find("input[name=mail]").change(function (event){
        axios.get('/checkout/user/'+$(this).val())
            .then(json => {
               console.log(json);
            });
    });

    form.keydown(function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            form.find('.btn.btn_success:visible').click();
            return false;
        }
    });
});
