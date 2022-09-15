/**
 * Created by berka on 2017/11/05.
 */
var sct = {};

sct.showProgress = function(text) {
    $('.processing_msg').text(text);
    $('.loading').fadeIn(120);
    $('body').addClass('hover-f-hidden');
}

sct.hideProgress = function() {
    $('.loading').fadeOut(120);
    $('body').removeClass('hover-f-hidden');
}

sct.InfoBar = function(messageType, text) {

    var infobar = $('.alert.alert-success.info-message');
    infobar.text('');
    infobar.text(text);

    if(messageType == 'error') {
        infobar.removeClass('alert-success').addClass('alert-danger')
    } else {
        infobar.removeClass('alert-danger').addClass('alert-success')
    }

    if(infobar.text().trim() != "") {
        infobar.removeClass("hide").delay(3000).fadeOut(150);
    }
};

sct.initTask = function (){

    $('#newtask').validate({
        rules:{
            TaskName:{required:true},
            TaskDescription:{required:true}
        },
        messages: {
            TaskName:{required:'Task name is required'},
            TaskDescription:{required:'Description is required'}
        },
        submitHandler: function(form) {
            $('#newTaskModel').hide();
            sct.showProgress("Task saving ...");

            var fields = {};

            $('#newtask input').each(function() {
                fields[$(this).attr('name')] = $(this).val();
            })

            $('#newtask textarea').each(function() {
                fields[$(this).attr('name')] = $(this).val();
            })

            $('#newtask select').each(function() {
                fields[$(this).attr('name')] = $(this).val();
            })

            $.ajax({
                url:'/admin/tasks/add',
                type:"POST",
                data: fields,
                success: function(data){
                    data = $.parseJSON(data);
                    sct.hideProgress();

                    if(data.error !== undefined) {
                        sct.InfoBar("error", data.error);
                    } else if(data.success !== undefined) {
                        sct.InfoBar("success", data.success);
                    }

                },
                error: function(){
                    sct.hideProgress();
                    sct.InfoBar("error",'Error while sending , please try again');
                }
            });

            return false;
        }
    });
}

function initProductImageUpload() {

    if($('[data-croppie]').length > 0) {
        var images = [];
        var field = {};

        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {

                    $('[data-croppie]').croppie('bind', {
                        url: e.target.result
                    });
                    $('#productImageModel').modal('show');

                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('[data-croppie]').croppie({
            viewport: {
                width: 350,
                height: 250,
                type: 'square'
            },
            showZoomer: true,
            boundary: {
                width: 700,
                height: 300
            }
        });

        $('[data-crop-btn]').on('click', function () {

            $('[data-croppie]').croppie('result', 'base64').then(function (base64) {
                var element = $('[data-crop-btn]').data('crop-btn');
                $('#' + element).attr('src', base64);

                field[element] = base64;
                images.push(element)

                $('#productImageModel').modal('hide');
            });

        });

        if ($('[data-file-select]').length > 0) {

            $('[data-file-select]').each(function () {
                $(this).change(function () {
                    $('[data-crop-btn]').data('crop-btn', $(this).data('file-select'));
                    readFile(this);
                });
            })

        }

        $('#productForm').on('submit', function (e) {
            e.preventDefault();

            $('#ajaxLoader').loader('setMessage', 'Saving images...');
            $('#ajaxLoader').loader('show');

            $.ajax({
                url: '/admin/products/image/' + $('#ProductID').val(),
                type: "POST",
                data: field,
                success: function (response) {

                    $('#ajaxLoader').loader('hide');
                    response = $.parseJSON(response);

                    $('#notification').notification('setMessage', response.message);

                    if(response.success == true) {
                        $('#notification').notification('show', 'success');
                    } else if(response.error == true) {
                        $('#notification').notification('show', 'error');
                    }
                },
                error: function () {
                    $('#ajaxLoader').loader('hide');
                    $('#notification').notification('setMessage', 'opp! connecting error, try again');
                    $('#notification').notification('show', 'error');
                }
            });

            return false;

        });
    }
}

function initBannerImageUpload() {

    if($('[data-croppie-banner]').length > 0) {

        var images = [];
        var field = {};

        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {

                    $('[data-croppie-banner]').croppie('bind', {
                        url: e.target.result
                    });
                    $('#bannerImageModel').modal('show');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('[data-croppie-banner]').croppie({
            viewport: {
                width: 850,
                height: 360,
                type: 'square'
            },
            showZoomer: true,
            boundary: {
                width: 850,
                height: 350
            }
        });

        $('[data-crop-btn]').on('click', function () {

            $('[data-croppie-banner]').croppie('result', 'base64').then(function (base64) {
                var element = $('[data-crop-btn]').data('crop-btn');
                $('#' + element).attr('src', base64);

                field[element] = base64;
                images.push(element)

                $('#bannerImageModel').modal('hide');
            });

        });

        if ($('[data-file-select]').length > 0) {

            $('[data-file-select]').each(function () {
                $(this).change(function () {
                    $('[data-crop-btn]').data('crop-btn', $(this).data('file-select'));
                    readFile(this);
                });
            })

        }

        $('#bannerImageForm').on('submit', function (e) {
            e.preventDefault();

            $('#ajaxLoader').loader('setMessage', 'Saving images...');
            $('#ajaxLoader').loader('show');

            $.ajax({
                url: '/admin/banners/image/' + $('#ID').val(),
                type: "POST",
                data: field,
                success: function (response) {

                    $('#ajaxLoader').loader('hide');
                    response = $.parseJSON(response);

                    $('#notification').notification('setMessage', response.message);

                    if(response.success == true) {
                        $('#notification').notification('show', 'success');
                    } else if(response.error == true) {
                        $('#notification').notification('show', 'error');
                    }
                },
                error: function () {
                    $('#ajaxLoader').loader('hide');
                    $('#notification').notification('setMessage', 'opp! connecting error, try again');
                    $('#notification').notification('show', 'error');
                }
            });

            return false;

        });
    }
}



$(document).ready(function() {

    initProductImageUpload();
    initBannerImageUpload();

});