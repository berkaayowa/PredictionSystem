/**
 * Created by berka on 2017/12/31.
 */
var bluetech = {};

bluetech.initLogin = function (){

    $('#login-form').validate({
        rules:{
            Email:{required:true},
            Password:{required:true}
        },
        messages: {
            Email:{required:'Email is required'},
            Password:{required:'Password is required'}
        },
        submitHandler: function(form) {

            return true;
        }
    });

    $('#login-form').validate({
        rules:{
            Email:{required:true},
            Password:{required:true}
        },
        messages: {
            Email:{required:'Email is required'},
            Password:{required:'Password is required'}
        },
        submitHandler: function(form) {

            return true;
        }
    });
};

bluetech.initSignup = function (){

    $('#register-form').validate({
        rules:{
            FirstName:{required:true},
            LastName:{required:true},
            Email:{required:true},
            Password:{required:true, minlength: 5},
            ConfirmPassword:{required:true, minlength: 5, equalTo: "#Password-register"}
        },
        messages: {
            FirstName:{required:'First name is required'},
            LastName:{required:'Last name is required'},
            Email:{required:'Email address is required'},
            Password:{required:'Password is required'},
            ConfirmPassword:{required:'Please confirm your password', equalTo:'Passwords does not match!'}
        },
        submitHandler: function(form) {

            $('#ajaxLoader').loader('setMessage', 'Registering...').loader('show');

            var data = {};

            $('#register-form input').each(function() {
                data[$(this).attr('name')] = $(this).val();
            });

            berkaPhpJs.request({
                url:'/users/signup',
                type: 'POST',
                data: data,
                message: 'Registering...'
            }, function(success, result) {

                if(result.success) {
                    $('#register-form input').each(function() {
                        $(this).val('');
                    });

                    $('#information').modal('show');
                }

            });

            return false;
        }
    });
};

bluetech.initContactUs = function (){

    $('#contact-form').validate({
        rules:{
            Name:{required:true},
            Title:{required:true},
            Email:{required:true},
            Message:{required:true, minlength: 10}
        },
        messages: {
            Name:{required:'Name is required'},
            Title:{required:'Title is required'},
            Email:{required:'Email address is required'},
            Message:{required:'Message is required'}
        },
        submitHandler: function(form) {

            var data = {};

            $('#contact-form input').each(function() {
                data[$(this).attr('name')] = $(this).val();
            });

            $('#contact-form textarea').each(function() {
                data[$(this).attr('name')] = $(this).val();
            });

            berkaPhpJs.request({
                url:'/contacts/email',
                type: 'POST',
                data: data
            }, function(success, result) {

                if(success) {
                    $('#contact-form textarea').each(function() {
                        $(this).val('');
                    })
                }

            });

            return false;
        }
    });
};

bluetech.initSubscribe = function (){

    $('#subscribe-form').validate({
        rules:{
            SubscriberEmail:{required:true}
        },
        messages: {
            SubscriberEmail:{required:'Email address is required'}
        },
        submitHandler: function(form) {

            var data = {};

            $('#subscribe-form input').each(function() {
                data[$(this).attr('name')] = $(this).val();
            });

            berkaPhpJs.request({
                url:'/contacts/subscribe',
                type: 'POST',
                data: data,
                message: 'Processing...'
            }, function(success, result) {
                console.log(result) ;
            });

            return false;
        }
    });
};

bluetech.initAddToCart = function(){
    if($('[data-add-to-cart]').length > 0) {
        $('[data-add-to-cart]').each(function(e) {
            var productID = $(this).data('add-to-cart');
            $(this).on('click', function(e) {

                var productName = $('[data-product-name="'+productID+'"]').text();

                berkaPhpJs.request({
                    url:'/cart/add',
                    type: 'POST',
                    data: {
                        ProductID: productID
                    },
                    message: 'Adding '+productName+' to your cart...'
                }, function(success, result) {
                    console.log(result) ;
                    $('#headerCart').trigger('request');
                });

            })
        })
    }
};

bluetech.initRemoveFromCart = function(){
    if($('[data-remove-item]').length > 0) {
        $('[data-remove-item]').each(function(e) {
            var productID = $(this).data('remove-item');
            var page = $('#page').val();
            $(this).on('click', function(e) {

                var productName = $('[data-item-name="'+productID+'"]').text();

                berkaPhpJs.request({
                    url:'/cart/remove',
                    type: 'POST',
                    data: {
                        ProductID: productID
                    },
                    message: 'Removing '+productName+' from your cart...'
                }, function(success, result) {

                    $('#headerCart').trigger('request');

                    if(page == 'cart') {
                        window.location.reload();
                    }

                });

            })
        })
    }
};

bluetech.initCurrency = function(){

    if($('[data-update-currency]').length > 0) {
        $('[data-update-currency]').each(function(e) {
            var currency = $(this).data('update-currency');
            $(this).on('click', function(e) {
                berkaPhpJs.request({
                    url:'/currency/update/' + currency,
                    message: 'Changing currency...'
                }, function(success, result) {
                    if(result.success) {
                        window.location.reload();
                    }
                });
            })
        })
    }

};

bluetech.initPayment = function(){

    $('#paymentMethod').on('change', function(e) {

        var method = $(this).val();
        var orderCode = $(this).data('order-code');
        var url = '/checkout/update_method/'+method+'/?orderCode='+orderCode;

        $('#paymentMethodPanel').data('ajax-onload', url).trigger('request');

        $('.method').each(function(e) {
            if($(this).hasClass(method)) {
                $(this).removeClass('hidden');
            } else {
                $(this).addClass('hidden');
            }
        })
    });

};

bluetech.initPlaceOrder = function(){

    if($('[data-place-order]').length > 0) {

        $('[data-place-order]').each(function(e) {

            $(this).on('click', function(e) {

                if($('[type="radio"][checked]').length > 0) {

                    $('.shipping-dalivery-price').removeClass('error-box');

                    berkaPhpJs.request({
                        url: '/checkout/placeorder/',
                        message: 'Placing your order...',
                        data: {
                            RefDeliveryID: $('#RefDeliveryID:checked').val(),
                            FullAddress: $('#FullAddress').val()
                        }
                    }, function (success, result) {

                        $('#headerCart').trigger('request');

                        if (result.success || result.url) {
                            //'bluetech-address-price';
                            $.removeCookie('bluetech-address-price');
                            window.location = result.url;
                        }

                    });

                } else {
                    $('.shipping-delivery-price').addClass('error-box').delay(100).fadeOut(100).fadeIn('slow')
                }

            })
        });

        bluetech.initUpdateShoppingCart();
    }

};

bluetech.initUpdateShoppingCart = function() {
    var notifier = true;
    var warningMsg = 'We noticed you made changes in your cart, please click "UPDATE SHOPPING CART" below you cart to save changes';
    $('.arrow').each(function(e) {
        $(this).on('click', function(event) {

            var targetID = $(this).attr('target-item');
            var inputQuantity = $('[data-target-item="'+targetID+'"]');
            var inoutValue = parseInt(inputQuantity.val());

            if($(this).hasClass('plus')) {
                if (inoutValue > 0 && inoutValue < 5) {
                    inoutValue++;
                    inputQuantity.val(inoutValue);
                }
            } else if($(this).hasClass('minus')) {
                if (inoutValue > 1 && inoutValue <= 5) {

                    inoutValue--;
                    inputQuantity.val(inoutValue);
                }
            }

            if(notifier) {
                $('#notification').notification('setMessage', warningMsg);
                $('#notification').notification('show', 'warning');
                notifier = false;
            }

            $('a').confirmation({
                message: "Do you want to continue without save your cart changes ?",
                title: "Unsaved changes in your cart",
                onClick: function(id, event) {
                    if(id == 'yes') {
                        location.href = event.target.getAttribute('href');;
                    }
                }
            });

            //$(window).on('beforeunload', function(){
            //    // your logic here
            //});
            //$(window).on('load', function(){
            //    // your logic here`enter code here`
            //});

        })
    });

    $('#updateShoppingCart').on('click', function(e) {

        var items = [];

        $('[data-target-item]').each(function(e) {
            var item = {
                productID: $(this).data('target-item'),
                quantity: $(this).val()
            };

            items.push(item);
        });

        berkaPhpJs.request({
            url:'/checkout/updatecart',
            type: 'POST',
            message: 'Updating your cart...',
            data: {Items:items}
        }, function(success, result) {

            if(result.success) {
                window.location.reload();
            }

        });
    });
};

bluetech.initShipping = function() {

    var orderAddressCookie = 'bluetech-address-price';
    var orderDeliveryAddress = 'bluetech-delivery';

    $('[type="radio"]').on('change', function() {

        $.cookie(orderAddressCookie, $(this).val());

        if($(this).val() != "") {

            var value = $(this).val();

            berkaPhpJs.request({
                url: '/checkout/delivery',
                type: 'POST',
                message: 'Updating delivery address...',
                data: {
                    RefDeliveryID: value
                }
            }, function (success, result) {

                $('#headerCart').trigger('request');

                if(value != $('#shop-pick-up').val()) {
                    $('.shipping-price').hide();
                    $('.shipping-address').show();
                }

                if(result.success) {
                    window.location.reload();
                }
            });
        }
    });

    $('#myAddress').on('change', function(){
        if($(this).is(':checked')) {
            $('#FullAddress').val($('#userAddress').val());
        } else {
            $('#FullAddress').val('');
        }
    });

    $('[data-confirm-address]').on('click', function() {

        $.cookie(orderDeliveryAddress, $('#FullAddress').val());

        $('#notification').notification('setMessage', 'Your delivery address is your confirmed');
        $('#notification').notification('show', 'success');

    });

    function checkAddressCookie() {

        var cookieValue = $.cookie(orderAddressCookie);
        if (typeof cookieValue === 'undefined'|| cookieValue == $('#shop-pick-up').val()) {
           $('.shipping-price').show();
           $('.shipping-address').hide();
        } else {
            $('.shipping-price').hide();
            $('.shipping-address').show();
        }

        $('[type="radio"]').each(function() {
            if(cookieValue == $(this).val()) {
                $(this).attr('checked',true);
            }
        });

        var cookieDeliveryValue = $.cookie(orderDeliveryAddress);

        if (typeof cookieDeliveryValue !== 'undefined') {
            $('#FullAddress').val(cookieDeliveryValue);
        }

    }

    checkAddressCookie();
};

$(document).ready(function() {
    bluetech.initCurrency();
    bluetech.initAddToCart();
    bluetech.initRemoveFromCart();
});