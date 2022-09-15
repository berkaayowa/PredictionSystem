(function ($) {
    
    var loader = function (element, option) {

        var defaults = {
            message: "Loading ...",
            setGif: function() {
                return "";
            }
        };

        this.option = $.extend({}, defaults, option);
        this.$element = $(element);
        this.init();
    }

    var loaderWrapper = $('<div>');
    var messageWrapper = $('<span>');
    
    loader.prototype = {
        show: function() {
            loaderWrapper.css('display','block');
            loaderWrapper.appendTo('body');
            $('body').css('overflow', 'hidden');
        },
        hide: function() {
            loaderWrapper.css('display','c');
            $('body').css('overflow', 'scroll');
            loaderWrapper.remove();
        },
        setMessage: function(value) {
            messageWrapper.text(value);
        },
        init: function () {

            loaderWrapper = $('<div>')
                .css({
                    "overflow-x": "hidden",
                    "overflow-y": "auto",
                    "display": "none",
                    "padding-right": "17px",
                    "position": "fixed",
                    "top": "0",
                    "right": "0",
                    "bottom": "0",
                    "left": "0",
                    "z-index": "1050",
                    "background": "rgba(0, 0, 0, 0.8)"
                })
                .attr('class', 'loaderWrapper');

            var contentHoder = $('<div>')
                .css({
                    "display": "block",
                    "margin-left": "auto",
                    "margin-right": "auto",
                    "width": "205px",
                    "margin-top": "40px"
                })
                .attr('class', 'loaderContentHoder');

            var image = $('<img>')
                .css('max-width', '100%')
                .css('left', '-30px')
                .css('position', 'relative')
                .attr('src', this.option.setGif())
                .attr('class', 'loaderGif');

            var textContainer = $('<div>')
                .css({
                    "text-align": "center",
                    "color": "white",
                    "font-weight": "bold",
                    "position": "relative",
                    "bottom": "10px"
                })
                .attr('class', 'loaderTextContainer');

            messageWrapper
                .text(this.option.message)
                .attr('class', 'loaderMessage');

                messageWrapper.appendTo(textContainer);

            textContainer.appendTo(contentHoder);
            image.appendTo(contentHoder);
            contentHoder.appendTo(loaderWrapper);

        }
    }

    $.fn.loader = function (option) {
        var arg = arguments,
            options = typeof option == 'object' && option;;
        return this.each(function () {
            var $this = $(this),
                data = $this.data('loader');

            if (!data) $this.data('loader', (data = new loader(this, options)));
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


