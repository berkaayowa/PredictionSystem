/*
 ////////////////////////////////////////////////////////////////
 /////////// Framwork JavaScript functions//////////////////////
 ///////////////////////////////////////////////////////////////
 */

var berkaPhpJs = {};

/*
 ////////////////////////////////////////////////////////////////
 /////////// initFlash
 ///////////////////////////////////////////////////////////////
 */

berkaPhpJs.initFlash = function(){

    $msgBox = $('.console');
    $message = $('#message');

    setTimeout(function() {
        if($message.text().trim() != '') {
            $msgBox.fadeIn(1000);//.delay(2000).fadeOut(150);
        }

        $('[data-close-message]').on('click', function() {
            if($msgBox.hasClass('display_debug')) {
                $msgBox.removeClass('display_debug');
                $msgBox.fadeOut(1000);
            }
        });
    }, 100);

    $flash = $('.flash');

    if($flash.text().trim() != "") {
        $flash.removeClass("hide").delay(6000).slideUp(150);
    }

};

/*
 ////////////////////////////////////////////////////////////////
 /////////// initAjax
 ///////////////////////////////////////////////////////////////
 */

berkaPhpJs.initAjax = function(){

    $("[data-ajax]").each(function() {
        $(this).on('click', function() {
            var getUrl = $(this).data("ajax");
            var panelName = $(this).attr("panel");

            $.ajax({
                url:getUrl,
                type:"GET",
                data: {

                },
                success:function(data){
                    $('#'+panelName).html(data);
                },
                error:function(){

                }
            });
        });
    });

    $("[data-ajax-onload]").each(function() {

        function request() {

            var panelName = $(this);
            var getUrl = $(this).data("ajax-onload");

            $.ajax({
                url:getUrl,
                type:"GET",
                data: {

                },
                success:function(data){
                    $(panelName).html(data);
                },
                error:function(){

                }
            });

        }

        $(this).bind("request", request);
        $(this).trigger('request');

    });

};

berkaPhpJs.initForm = function(){

    $('[data-form]').each(function() {

        $(this).on('submit', function(e) {
            $dataErrorMessage = $(this).find('[data-error-message]');
            $(this).find('[data-required]').each(function() {
                if ($(this).val().trim() == "") {
                    $(this).addClass("data-required");
                    e.preventDefault();
                    $dataErrorMessage.fadeIn(100);
                } else {
                    $(this).removeClass("data-required");
                    $dataErrorMessage.fadeOut(100);
                }
            });
        });

    });

};

berkaPhpJs.showProgress = function(text) {
    $('.processing_msg').text(text);
    $('.loading').fadeIn(120);
    $('body').addClass('hover-f-hidden');
}

berkaPhpJs.hideProgress = function() {
    $('.loading').fadeOut(120);
    $('body').removeClass('hover-f-hidden');
}

berkaPhpJs.InfoBar = function(messageType, text) {

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

/*
 ////////////////////////////////////////////////////////////////
 /////////// initBerkaPhp
 ///////////////////////////////////////////////////////////////
 */

berkaPhpJs.init = function(){

    if ($('[data-date]').length > 0) {
        $('[data-date]').each(function () {

            var format = $(this).data("format") == undefined ? $(this).find('input').data("format") : $(this).data("format");
            //
            //$(this).datepicker({
            //    format: format,
            //    icons:{ previous: 'fa fa-arrow-left', next: 'fa fa-arrow-right'}
            //});
        });
    }

    if ($('[data-editor]').length > 0) {


        $('[data-editor]').each(function() {

            var currentElement = $(this);

            $('[data-editor]').summernote({
                callbacks: {
                    onChange: function(contents, $editable) {

                    }
                }
            });

        })

    }

    $('#ajaxLoader').loader({
        setGif: function(){
            return "/Views/Client/Assets/loader.gif";
        }
    });

    $('#notification').notification({
        duration: 8000,
        icons:{
            success: 'fa fa-check',
            error: 'fa fa-exclamation-triangle',
            warning: 'fa fa-exclamation-circle'
        }
    });

    berkaPhpJs.initAjax();
    berkaPhpJs.initForm();
    berkaPhpJs.initFlash();
    berkaPhpJs.initUtility();
    berkaPhpJs.initEqualizer();
};

var request = {
    url: null,
    type: null,
    data: null
}

berkaPhpJs.request = function(request, callback) {

    var settings = {
        url: null,
        type: 'GET',
        data: {},
        message: 'Processing...',
        showLoader: true,
        hasFile: false
    };

    request = $.extend(settings, request);

    if(request.showLoader){

        $('#notification').notification('hide');
        $('#ajaxLoader').loader('setMessage', request.message).loader('show');

    }

    var ajaxBody = {

        url:request.url,
        type:request.type,
        data: request.data,
        success: function(response){

            $('#ajaxLoader').loader('hide');
            response = $.parseJSON(response);

            if(response.message != false)
                $('#notification').notification('setMessage', response.message);

            if(response.success == true && response.message != false) {
                if(response.hasHtml){
                    $('.notificationMessageSuccess').html(response.hasHtml);
                }
                $('#notification').notification('show', 'success');
            } else if(response.error == true && response.message != false) {
                $('#notification').notification('show', 'error');
            }

            callback(true, response);

        },
        error: function(){

            $('#ajaxLoader').loader('hide');
            $('#notification').notification('setMessage', 'Oop could not connect to the server, try again');
            $('#notification').notification('show', 'error');

            callback(false, null);

        }
    };

    if(request.hasFile)
    {
        ajaxBody.cache = false;
        ajaxBody.contentType = false;
        ajaxBody.processData = false;
    }

    $.ajax(ajaxBody);
};

berkaPhpJs.initUtility = function( ) {
    $('[data-back]').on('click', function() {
        var currentSelector = $(this).attr('parent');
        var backSelector = $(this).data('back');

        $(currentSelector).hide();
        $(backSelector).show();
    })

    $('[data-delete]').confirmation({
        message: "Are you sure you want to delete ",
        title: "Deleting..",
        onClick: function(id, event) {
            if(id == 'yes') {
                location.href = event.target.getAttribute('href');
               // event.preventDefault();
            }
        }
    });

    $('[data-back-link]').on('click', function(e) {
        e.preventDefault();
        window.history.back();
    });

    //$('#dataTable').DataTable({
    //    "order": []
    //});

    if($('[data-color-picker]').length > 0) {
        //$('[data-color-picker]').each(function() {
        //    $(this).farbtastic($(this).data('color-picker'));
        //})
    }

};

berkaPhpJs.initEqualizer = function(selector) {
    function eqHeight(_selector) {
        var elements = $(_selector);
        var highest = 0;
        for (var i = 0; i < elements.length; i++) {
            var element = $(elements[i]);
            if ($(elements[i]).height() > highest) {
                highest = $(elements[i]).height();
            }
        }

        return highest;
    }

    function equalize() {
        $(selector).each(function() {
            $(this).css('display', 'block');
            $(this).height(eqHeight(selector));
        });
    }

    equalize();

    $(window)
        .bind('resize', function() {
            setTimeout(function() {
                console.log('1');
                $(selector).css('height', 'auto');
                equalize();
            }, 150);
        })
        .resize();
};

//$(document).ready(function() {
//    berkaPhpJs.init();
//    berkaPhpJs.initEqualizer();
//});



