(function ($) {

    var notification = function (element, option) {

        var defaults = {
            message: "Notification ...",
            icons:{
                success: '',
                error: '',
                warning: ''
            },
            duration: 2000,
            vertical: 'bottom',
            horizontal: 'right'
        }

        this.option = $.extend({}, defaults, option);
        this.$element = $(element);
        this.init();
    }

    var notificationContainer = $('<div>');
    var notificationMessage = $('<span>');
    var notificationIcon = $('<i>');
    var notificationContentHolder = $('<div>');

    var notificationTypes = {
        success: function(icon) {
            notificationContainer.css({
                "border": "2px solid #076507",
                "background": "#54af54"
            });
            notificationContainer.removeClass("n-warning");
            notificationContainer.removeClass("n-error");
            notificationContainer.addClass("n-success");
            notificationIcon.attr('class', icon);
            notificationMessage.attr('class', 'notificationMessageSuccess');
        },
        error: function(icon) {
            notificationContainer.css({
                "border": "2px solid #381716",
                "background": "#eaa7a7"
            });
            notificationContainer.removeClass("n-warning");
            notificationContainer.removeClass("n-success");
            notificationContainer.addClass("n-error");
            notificationIcon.attr('class', icon);
            notificationMessage.attr('class', 'notificationMessageError');
        },
        warning: function(icon) {
            notificationContainer.css({
                "border": "2px solid #f1ded8",
                "background": "#fff2ee"
            });
            notificationContainer.removeClass("n-error");
            notificationContainer.removeClass("n-success");
            notificationContainer.addClass("n-warning");
            notificationIcon.attr('class', icon);
            notificationMessage.attr('class', 'notificationMessageWarning');
        }
    }

    function center() {

        var wWidth = window.innerWidth;
        var wHeight = window.innerHeight;

        //notificationContainer.css({
        //    'left': wWidth/2 - 600/2
        //});

        //'top': wHeight/2 - 200/2
    }

    center();

    $(window).resize(function(){
        center();
    });

    notification.prototype = {
        show: function(notificationType) {

            notificationTypes[notificationType](this.option.icons[notificationType]);
            notificationContainer.css('display','block');
            notificationContainer.appendTo('body');
            notificationContainer.animate({right: '10px'}, 50);
            notificationContainer.animate({right: '0'}, 50);
            notificationContainer.animate({right: '8px'}, 50);
            notificationContainer.animate({right: '0'}, 50);
            notificationContainer.animate({right: '4px'}, 50);
            notificationContainer.animate({right: '0'}, 50);

            setTimeout(function(){

                notificationContainer.css('display','none');
                notificationContainer.remove();

            }, this.option.duration);
        },
        hide: function() {
            notificationContainer.css('display','none');
            notificationContainer.remove();
        },
        setMessage: function(value) {
            notificationMessage.text(value);
        },
        init: function () {

            notificationContainer
                .css({
                    "display": "none",
                    "position": "fixed",
                    "padding": "13px",
                    "border-radius": "0px",
                    "z-index": "99999999999999999",
                    "text-align": "center"
                });

            notificationContainer.attr('class', 'notification-wrapper');

            if(this.option.vertical == 'bottom') {
                notificationContainer.css('bottom', '35px');
            } else {
                notificationContainer.css('top', '0');
            }

            if(this.option.horizontal == 'right') {
                notificationContainer.css('right', '0');
            } else {
                notificationContainer.css('left', '0');
            }

            notificationMessage.text(this.option.message);

            notificationContentHolder.attr('class', 'notification-container');
            notificationIcon.appendTo(notificationContentHolder);
            notificationMessage.appendTo(notificationContentHolder);
            notificationContentHolder.appendTo(notificationContainer);

        }
    }

    $.fn.notification = function (option) {
        var arg = arguments,
            options = typeof option == 'object' && option;;
        return this.each(function () {
            var $this = $(this),
                data = $this.data('notification');

            if (!data) $this.data('notification', (data = new notification(this, options)));
            if (typeof option === 'string') {
                if (arg.length > 1) {
                    data[option].apply(data, Array.prototype.slice.call(arg, 1));
                } else {
                    data[option]();
                }
            }
        });
    };
})(jQuery)