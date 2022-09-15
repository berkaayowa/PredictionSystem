var App = {};

App.InitControls = function () {

    $('[data-date]').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $('[data-timepicker]').timepicker({
        showInputs: false
    });

    $('[data-text-editor]').each(function () {
        CKEDITOR.replace($(this).attr('id'))
    })

    $('#tableContent').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': false
    });

    $('[data-confirmation]').each(function () {
        $(this).on('click', function () {
            $.confirm($(this).attr('confirmation-message'), $(this).attr('data-title'));
        });

    });
    
    $('[data-dropdown]').each(function () {

        var url = $(this).data('dropdown');
        var map = $(this).data('map').split("/");

        $(this).select2({
            minimumInputLength: 0,
            //delay: 250,
            ajax: {
                url: url,
                dataType: 'json',
                placeholder: 'Search',
                allowClear: true,
                data: function (params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        page: params.page || 1
                    }
                    return query;
                },
                processResults: function (data) {
                    console.log(data)
                    return {
                        results: data.map(function (item) {
                            return {
                                id: item[map[1]],
                                text: item[map[0]]
                            };
                        })
                    };
                }
            }
        });
    })

    $('[dropdown]').each(function () {
        $(this).select2();
    })


}

App.ShowNotification = function (message, type) {
    $.bootstrapGrowl(message, {
        type: type,
        align: 'right',
        width: 'auto',
        offset: { from: 'bottom', amount: 20 },
        //stackup_spacing: 30,
        allow_dismiss: false
    });
}

App.InitAjaxController = function () {
    $('#ajaxLoader').loader({
        gifUrl: "~/Content/Images/loader.gif"
    });
}

App.InitAjaxForm = function () {
    $('[data-ajaxform]').each(function () {
        $(this).on('submit', function (e) {

            e.preventDefault();

            var url = $(this).attr('action');
            var type = $(this).attr('method');
            var message = $(this).attr('message');
            var id = $(this).attr('id');
            var formId = $(this).attr('id');
            var requireConfirmation = typeof $(this).attr('confirmation-required') !== 'undefined' ? true : false;

            var data = {};

            var form = $(this);
            var formdata = false;

            if (window.FormData) {
                formdata = new FormData(form[0]);
            }

            if (requireConfirmation) {
                $.confirm({
                    title: 'Saving Confirmatiom!',
                    content: 'Are you sure you want to save changes ?!',
                    buttons: {
                        confirm: {
                            btnClass: 'btn-red',
                            action: function () {
                                App.AjaxRequest({
                                    url: url,
                                    type: type,
                                    data: formdata ? formdata : form.serialize(),
                                    hasFile: true,
                                    message: message
                                }, function (success, result) {
                                });
                            }
                        },
                        cancel: function () {
                            $.alert('Canceled!');
                        }
                    }
                });
            } else {
                App.AjaxRequest({
                    url: url,
                    type: type,
                    data: formdata ? formdata : form.serialize(),
                    hasFile: true,
                    message: message
                }, function (success, result) {
                });
            }

        });
    });
}

//App.AjaxRequest = function (request, callback) {
//
//    var settings = {
//        url: null,
//        type: 'GET',
//        data: {},
//        message: 'Processing...',
//        showLoader: true,
//        hasFile: false
//    };
//
//    request = $.extend(settings, request);
//
//    if (request.showLoader) {
//        $('#ajaxLoader').loader('setMessage', request.message).loader('show');
//    }
//
//    function FormDataToJSON(formData) {
//        var ConvertedJSON = {};
//        for (const [key, value] of formData.entries()) {
//            ConvertedJSON[key] = value;
//        }
//
//        return ConvertedJSON
//    }
//
//    var data = FormDataToJSON(request.data);
//
//    encodeURIComponent(JSON.stringify(data));
//
//    var ajaxBody = {
//        url: request.url,
//        type: request.type,
//        data: request.data,
//        success: function (response) {
//
//            $('#ajaxLoader').loader('hide');
//            //response = $.parseJSON(response);
//
//            if (response.success === true && response.message.length > 3) {
//                App.ShowNotification(response.message, 'success')
//            } else if (response.error === true && response.message !== false) {
//                App.ShowNotification(response.message, 'danger')
//            }
//
//            callback(true, response);
//        },
//        error: function () {
//            $('#ajaxLoader').loader('hide');
//            App.ShowNotification('Oops could not connect to the server, try again', 'warning')
//            callback(false, null);
//        }
//    };
//
//    if (request.hasFile) {
//
//        ajaxBody.cache = false;
//        ajaxBody.contentType = false;
//        ajaxBody.processData = false;
//    } else {
//        //ajaxBody.dataType = 'json';
//    }
//
//    $.ajax(ajaxBody);
//}

$(document).ready(function () {
    App.InitControls();
    App.InitAjaxForm();
});

//https://craftpip.github.io/jquery-confirm/
//http://jsfiddle.net/ifightcrime/Us6WX/1008/
//https://github.com/ifightcrime/bootstrap-growl
//https://www.cssscript.com/minimal-notification-popup-pure-javascript/
// https://select2.org/data-sources/ajax
