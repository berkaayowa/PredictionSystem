(function ($) {

    var loader = function (element, option) {

        var defaults = {
            message: "Loading ...",
            gifUrl: 'https://github.com/berkaayowa/js_loader/blob/dev/example/images/loader.gif?raw=true',
            bgRgab: 'rgba(0, 0, 0, 0.8)',
            color: 'white',
            onStartLoading: null,
            onFinishLoading: null
        };

        this.option = $.extend({}, defaults, option);
        this.$element = $(element);
        this.init();
    }

    var loaderWrapper = $('<div>');
    var messageWrapper = $('<span>');

    loader.prototype = {
        show: function () {
            loaderWrapper.css('display', 'block');
            loaderWrapper.appendTo('body');
            $('body').css('overflow', 'hidden');

            if (jQuery.isFunction(this.option.onStartLoading)) {
                this.option.onStartLoading();
            }
        },
        hide: function () {
            loaderWrapper.css('display', 'c');
            $('body').css('overflow', '');
            loaderWrapper.remove();

            if (jQuery.isFunction(this.option.onFinishLoading)) {
                this.option.onFinishLoading();
            }

        },
        setMessage: function (value) {
            messageWrapper.text(value);
        },
        setHtmlMessage: function (value) {
            messageWrapper.html(value);
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
                    "background": this.option.bgRgab
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

            var image = this.option.gifUrl != null ? $('<img>')
                .css('max-width', '100%')
                .css('left', '-30px')
                .css('position', 'relative')
                .css
                (
                {
                    'margin-left': 'auto',
                    'margin-right': 'auto',
                    'display': 'table-header-group'
                }
                )
                .attr('src', this.option.gifUrl)
                .attr('class', 'loaderGif') : $('<i>');

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
                .css(
                {
                    'color': this.option.color
                }
                )
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
