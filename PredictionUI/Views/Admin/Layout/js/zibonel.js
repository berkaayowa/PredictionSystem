var zibonel = {};

zibonel.initNews = function () {
    var title = $('[data-new-title]');

    title.on('focusout', function() {

        if(title.val().trim() != "") {
            var value = title.val();
            $('[data-new-link]').val(titleToLink(value));
        } else {
            alert("dhdhdh");
        }

    });

    function titleToLink(value) {
        value = value.toLowerCase();
        value = value.replace(/\s+$/g, '');
        return value.replace(/\s/g,"-");
    }
};
