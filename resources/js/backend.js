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
                let evt = document.createEvent('HTMLEvents');
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
    form.find('input, textarea').on('change', function () {
        $('#type-' + this.name).text($(this).val());
    });
    form.find("input[type=radio]").on('change', function () {
        $('#type-' + this.name).text($(this).nextAll('.toggle-text').text());
    });
    form.find('.btn.btn_success:visible').click(function () {
        if ($(this).attr('href') === '#step2' && form.find('input[name=password]').length > 0) {
            axios.post('/checkout/user', {
                password: form.find('input[name=password]').val(),
                password_confirmation: form.find('input[name=password_confirmation]').val(),
                name: form.find('input[name=name]').val(),
                email: form.find('input[name=mail]').val(),
                phone: form.find('input[name=phone]').mask(),
            })
                .then(json => {
                    if (json.data.status) {
                        location.reload();
                    }

                })
                .catch(error => {
                    if (error.response.data.errors) {
                        $.each(error.response.data.errors, function (key, message) {
                            const field = form.find('input[name=' + key + ']');
                            field.addClass('form-input_error');
                            $(document.createElement('div')).addClass('form-error').text(message).insertAfter(field);
                        });
                        $('.Order-block_OPEN').removeClass('Order-block_OPEN');
                        $('.Order-block#step1').addClass('Order-block_OPEN');
                    }
                })
            ;
        }
    });

    form.find("input[name=mail]").change(function () {
        axios.get('/checkout/user/' + $(this).val())
            .then(json => {
                if (json.data.status) {
                    $('.Order-btnReg').click();
                }
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
