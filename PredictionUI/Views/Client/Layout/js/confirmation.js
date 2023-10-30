(function($) {
    $.fn.confirmation = function(options) {
        var settings = {
            title: "Please confirm",
            message: "Confirmation message",
            id: "confirmation",
            onClick: null
        };

        options = $.extend(settings, options);

        function initialize(event) {

            event.preventDefault();

            var confirmationWarpper = $('<div>')
                .attr('class','confirmation-warpper')
                .css({
                    "position": "fixed",
                    "left": "0",
                    "top": "0",
                    "bottom": "0",
                    "background": "rgba(0, 0, 0, 0.6)",
                    "width": "100%",
                    "height": "100%",
                    "z-index": "2147483647",
                    'display': 'none'
                })
                .on('click', function(e) {
                    RemoveConfirmation();
                });

            function RemoveConfirmation() {
                confirmationWarpper.remove();
            }

            function onClick(value) {

                if(options.onClick != null) {
                    options.onClick(value, event);
                }

                RemoveConfirmation();
            }

            var confirmationContent = $('<div>')
                .attr('class','confirmation-content')
                .css({
                    "padding": "15px",
                    "background": "white",
                    "width": "auto",
                    "position": "absolute"
                });

            confirmationContent.appendTo(confirmationWarpper)

            var confirmationTitle = $('<div>')
                .attr('class','confirmation-title')
                .css({
                    'max-width': '200px',
                    'display': 'block',
                    'width': '230px',
                    'border-bottom': '1px solid #b1b0b0',
                    'padding': '5px',
                    'background': '#efefef'
                })
                .text(options.title);

            confirmationTitle.appendTo(confirmationContent)

            var confirmationMessage = $('<div>')
                .attr('class','confirmation-message')
                .css({
                    'padding': '5px',
                    'border': '1px solid #f3f3f3',
                    'margin-bottom': '10px',
                    'margin-top': '10px',
                    'max-width': '200px',
                    'font-size': '13px'
                })
                .text(options.message);

            confirmationMessage.appendTo(confirmationContent)

            var confirmationButtons = $('<div>')
                .attr('class','confirmation-btn');

            var btnYes = $('<button>')
                .attr('id','yes')
                .attr('class', 'btn btn-danger')
                .css('width', '50%')
                .text('Yes')
                .on('click', function(e) {
                    onClick($(this).attr('id'));
                });

            btnYes.appendTo(confirmationButtons);

            var btnNo = $('<button>')
                .attr('id','no')
                .attr('class', 'btn btn-default')
                .css('width', '50%')
                .text('No')
                .on('click', function(e) {
                    onClick($(this).attr('id'), e);
                });

            btnNo.appendTo(confirmationButtons)

            confirmationButtons.appendTo(confirmationContent);

            function center() {

                var wWidth = window.innerWidth;
                var wHeight = window.innerHeight;

                confirmationContent.css({
                    'left': wWidth/2 - 200/2,
                    'top': wHeight/2 - 200/2
                });
            }

            center();

            $(window).resize(function(){
                center();
            });

            return confirmationWarpper;
        }

        return this.each(function(e) {

            if($(this).data('exist'))
                return $(this);

            $(this).data('exist', true);

            $(this).on('click', function(e) {

                var message = $(this).attr('confirmation-message');
                var title = $(this).attr('confirmation-title');
                options.message = message !== "undefined" ? message : options.message;
                options.title = title !== "undefined" ? title : options.title;
                $("body").append(initialize(e));
                $('.confirmation-warpper').fadeIn(400);

            });

        });
    }
})(jQuery);

