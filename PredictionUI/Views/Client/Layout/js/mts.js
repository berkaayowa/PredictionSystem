/**
 * Created by berka on 2017/12/31.
 */
var mts = {};

mts.initLogin = function (){

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

mts.initSignup = function (){

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

mts.initFormRequest = function (){

    $('[data-request]').each(function() {

        $(this).on('submit', function(e) {

            e.preventDefault();

            var url = $(this).data('request');
            var type = $(this).attr('request-type');
            var message = $(this).attr('message');
            var id  = $(this).attr('id');
            var responseType = $(this).attr('response-type');
            var responseOn = $(this).attr('response-on');

            var formId = $(this).attr('id');

            var data = {};

            var form = $(this);
            var formdata = false;
            if (window.FormData){

                formdata = new FormData(form[0]);

                var length = $('#' + formId +' [data-image-cropper]').length;
                var count = 0;

                if(length == 0) {
                    berkaPhpJs.request({
                        url: url,
                        type: type,
                        data: formdata ? formdata : form.serialize(),
                        hasFile: true,
                        message: message
                    }, function(success, result) {

                        var s = result;

                        if(result['link'] != null) {
                            setTimeout(function () {
                                window.location = result['link'];
                            }, 1000);
                        }

                        if(responseType == 'html' && result['content']) {
                            $(responseOn).html(result['content'])
                            return ;
                        }

                        if(result.success) {

                        }

                    });
                } else {

                    $('#' + formId +' [data-image-cropper]').each(function() {
                        var id = $(this).attr('identity');
                        var element = $(this).data('image-cropper');
                        $(element).croppie('result', 'blob').then(function (data) {
                            formdata.append(id, data, id +'.png');

                            if(count == length - 1) {
                                berkaPhpJs.request({
                                    url: url,
                                    type: type,
                                    data: formdata ? formdata : form.serialize(),
                                    hasFile: true,
                                    message: message
                                }, function(success, result) {

                                    var s = result;

                                    if(result['link'] != null)
                                        window.location = result['link'];

                                    if(responseType == 'html' && result['content']) {
                                        $(responseOn).html(result['content'])
                                        return ;
                                    }

                                    if(result.success) {

                                    }

                                });
                            }

                            count++;
                        });
                    })
                }


            } else {
                berkaPhpJs.request({
                    url: url,
                    type: type,
                    data: formdata ? formdata : form.serialize(),
                    hasFile: true,
                    message: message
                }, function(success, result) {

                    var s = result;

                    if(result['link'] != null)
                        window.location = result['link'];

                    if(responseType == 'html' && result['content']) {
                        $(responseOn).html(result['content'])
                        return ;
                    }

                    if(result.success) {

                    }

                });
            }


        })
    });

};

//mts.initFormRequest = function (){
//
//    $('[data-request]').each(function() {
//
//        $(this).on('submit', function(e) {
//
//            e.preventDefault();
//
//            var url = $(this).data('request');
//            var type = $(this).attr('request-type');
//            var message = $(this).attr('message');
//            var id  = $(this).attr('id');
//            var responseType = $(this).attr('response-type');
//            var responseOn = $(this).attr('response-on');
//
//            var formId = $(this).attr('id');
//
//            var data = {};
//
//            var form = $(this);
//            var formdata = false;
//            if (window.FormData){
//                formdata = new FormData(form[0]);
//            }
//
//            berkaPhpJs.request({
//                url: url,
//                type: type,
//                data: formdata ? formdata : form.serialize(),
//                hasFile: true,
//                message: message
//            }, function(success, result) {
//
//                var s = result;
//
//                if(result['link'] != null)
//                    window.location = result['link'];
//
//                if(responseType == 'html' && result['content']) {
//                    $(responseOn).html(result['content'])
//                    return ;
//                }
//
//                if(result.success) {
//
//                }
//
//            });
//
//        })
//    });
//
//};

mts.initExportTableToPdf = function() {
    function demoFromHTML() {
        var pdf = new jsPDF('l', 'pt', 'a4');
        // source can be HTML-formatted string, or a reference
        // to an actual DOM element from which the text will be scraped.
        source = $('#test')[0];

        // we support special element handlers. Register them with jQuery-style
        // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
        // There is no support for any other type of selectors
        // (class, of compound) at this time.
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#bypassme': function (element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 10,
            width: 700
        };
        // all coords and widths are in jsPDF instance's declared units
        // 'inches' in this case
        pdf.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },

            function (dispose) {
                // dispose: object with X, Y of the last line add to the PDF
                //          this allow the insertion of new lines after html
                pdf.save('Test.pdf');
            }, margins);
    }


    function createPDF() {
        var sTable = document.getElementById('test').innerHTML;

        var style = "<style>";
        style = style + "table {width: 100%;font: 17px Calibri;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";

        // CREATE A WINDOW OBJECT.
        var win = window.open('', '', 'height=700,width=700');

        win.document.write('<html><head>');
        win.document.write('<title>Profile</title>');   // <title> FOR PDF HEADER.
        win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(sTable);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
        win.document.write('</body></html>');

        win.document.close(); 	// CLOSE THE CURRENT WINDOW.

        win.print();    // PRINT THE CONTENTS.
    }
}

mts.initExportTableExcel = function (tableID, filename){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';

    // Create download link element
    downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

        // Setting the file name
        downloadLink.download = filename;

        //triggering the function
        downloadLink.click();
    }
}

mts.TableToExcel = (function() {
    var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
        , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
    return function(table, name, fileName) {
        if (!table.nodeType) table = document.getElementById(table)
        var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}

        var link = document.createElement("A");
        link.href = uri + base64(format(template, ctx));
        link.download = fileName || 'Workbook.xls';
        link.target = '_blank';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
})();

mts.initExcelExport = function (selector, fileName, tname) {

        $(selector).click(function(){
            mts.TableToExcel(tname, 'ReportCoin', fileName +'.xls');
        });

}


mts.initContactUs = function (){

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

mts.initSubscribe = function (){

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

mts.initCurrency = function(){

    if($('[data-update-currency]').length > 0) {
        $('[data-update-currency]').each(function(e) {
            var currency = $(this).data('update-currency');
            $(this).on('click', function(e) {
                berkaPhpJs.request({
                    url:'/client/setting/currency/' + currency,
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

mts.initLanguage = function(){

    if($('[data-update-language]').length > 0) {
        $('[data-update-language]').each(function(e) {
            var lang = $(this).data('update-language');
            $(this).on('click', function(e) {
                berkaPhpJs.request({
                    url:'/client/setting/lang/' + lang,
                    message: 'Changing language...'
                }, function(success, result) {
                    if(result.success) {
                        window.location.reload();
                    }
                });
            })
        })
    }

};

mts.initSearch = function() {
    $('[data-select]').each(function() {
        var curentElement = $(this);
        $(this).searchselect({
            spinner:'Views/Client/Assets/spinner.gif',
            source: function(searchText, callback) {
                $.get('/client/ajax/type/' + curentElement.data('type')+'', function(data) {
                    data = $.parseJSON(data);
                    callback(data);
                });
            },
            onItemMap: function(item) {

                var word = curentElement.data('text');
                var words = word.split('-');
                var label = '';

                var obj = { value: item[curentElement.data('value')]};

                if(words.length > 0)
                {
                    for(var i= 0; i< words.length; i++){
                        label = label + ' ' + item[words[i]]
                    }

                } else
                {
                    label = item[word];
                }

                obj['label'] = label;

                return obj
            },
            selected: {
                id:curentElement.data('select'),
                text:curentElement.data('select-text')
            }
            ,
            searchable: true,
            onItemSelect: function(item){
                console.log(item);
            }


        })
    })
};

mts.initSearchUser = function() {
    $('[data-search-sender]').each(function() {

        var curentElement = $(this);

        $(this).searchselect({
            source: function(searchText, callback) {
                $.get('/client/ajax/lookup?model=Users&search=' + searchText, function(data) {
                    data = $.parseJSON(data);
                    callback(data);
                });
            },
            onItemMap: function(item) {
                return { value: item['UserID'], label: item['FirstName'] + ' ' + item['LastName']};
            }
            ,
            searchable: true,
            selected: {
                id:null,
                text:null
            },
            onItemSelect: function(item){
                console.log(item);
                $('#SenderName').val(item['FirstName']);
                $('#SenderSurname').val(item['LastName']);
                $('#SenderTel').val(item['Phone']);
                $('#SenderEmail').val(item['EmailAddress']);
                $('#SenderPhysicalAddress').text(item.PhysicalAddress);

                $('#sender-info').removeClass('hide');

                $('#SenderCountryID').val(item.RefCountryID)
                $('#SenderCityID').val(item.RefCityID)
            }

        })
    });

    $('[data-search-receiver]').each(function() {

        $(this).searchselect({
            source: function(searchText, callback) {
                $.get('/client/ajax/lookup?model=Users&search=' + searchText, function(data) {
                    data = $.parseJSON(data);
                    callback(data);
                });
            },
            onItemMap: function(item) {
                return { value: item['UserID'], label: item['FirstName'] + ' ' + item['LastName']};
            }
            ,
            searchable: true,
            onItemSelect: function(item){
                console.log(item);
                $('#ReceiverName').val(item['FirstName']);
                $('#ReceiverSurname').val(item['LastName']);
                $('#ReceiverTel').val(item['Phone']);
                $('#ReceiverEmail').val(item['EmailAddress']);

                $('#ReceiverPhysicalAddress').val(item.PhysicalAddress);
                $('#receiver-info').removeClass('hide');

            }

        })
    });
};

mts.generatePin = function(callback) {

    berkaPhpJs.request({
        url:'/client/setting/generatepin',
        message: 'Generating pin...',
        showLoader: false
    }, function(success, result) {
        if(result.success) {
            callback(result['pin']);
        }
    });

};

mts.generatePinOnClick = function(callback, id) {
    $(id).on('click', function() {
        berkaPhpJs.request({
            url:'/client/setting/generatepin',
            message: 'Generating pin...',
            showLoader: true
        }, function(success, result) {
            if(result.success) {
                callback(result['pin']);
            }
        });
    })

};

mts.initUserInfo = function(name) {

    $('[data-section]').each(function() {
        if($(this).data('section') == name) {
            $(this).removeClass('hide');
        } else {
            $(this).addClass('hide');
        }
    });

    $('#infoModal').modal('show');

};

mts.initTransaction = function() {

    $('#ExistingSender').on('input', function () {
        if($(this).val() == 'YES') {
            $('#SenderSearchID').removeAttr('disabled');
        } else {
            $('#SenderSearchID').attr('disabled', true);
        }
    });

    $('#ExistingReceiver').on('input', function () {
        if($(this).val() == 'YES') {
            $('#ReceiverSearchID').removeAttr('disabled');
        } else {
            $('#ReceiverSearchID').attr('disabled', true);
        }
    });

    $('#btnNewPin').on('click', function(e) {
        mts.generatePin(function(pin) {
            $('#TransactionPIN').val(pin);
            $('#TransactionPINX').val(pin);
        });
    });

    $('#TransactionAmount').on('input', function() {
        var amount = $(this).val();

        if(amount == "")
            amount = 0;
        var interestRate = 0
        $('[data-transaction-amount]').text(amount);

        if(interestRate == "")
            interestRate = 0;

        interestRate = parseFloat(interestRate);
        amount = parseFloat(amount);
        var interest = parseFloat((interestRate / 100 ) * amount).toFixed(2);
        var amountDue = parseFloat((amount + parseFloat(interest))).toFixed(2);

        $('[data-total-amount]').text(amountDue);
        $('[data-interest-amount]').text(interest);


    });

    mts.initSearchUser();
}

mts.InitAjaxText = function () {

    $('[data-ajax-text]').each(function (e) {

        var element = $(this);
        var key = $(this).attr('name');
        var url = $(this).data('ajax-text');

        berkaPhpJs.request({
            url: url,
            type: "GET",
            hasFile: true,
            showLoader: false,
        }, function (success, result) {
            if (success) {
                if (typeof result['data'][key] != 'undefined') {
                    element.text(result['data'][key]);
                }
            }
        });
    });
}

mts.InitAjaxModal = function () {

    $('[data-ajax-modal]').each(function (e) {

        $(this).on("click", function (e) {

            e.preventDefault();

            var element = $(this);
            var key = $(this).attr('name');
            var modal = $(this).data('ajax-modal');
            var url = $(this).attr('href');
            var dataHolder = $(this).attr('modal-data');

            berkaPhpJs.request({
                url: url,
                type: "GET",
                hasFile: true,
                showLoader: true,
            }, function (success, result) {
                if (success) {
                    if (typeof result['data']!= 'undefined') {
                        $(dataHolder).html(result['data']);
                        $(modal).modal('toggle');
                    }
                }
            });

        })
    });
}

mts.initReceive = function()  {

    function confirm(id, authCode, message, uniqueID) {
        berkaPhpJs.request({
            url: '/company/transactions/confirmation',
            type: 'POST',
            data: {transactionAuthorizationCode:authCode, confirmationPIN:id, TransactionUniqueID:uniqueID},
            message: message
        }, function(success, result) {

            if(result.success) {
                $('[data-invoice-body]').html(result['content']);
                $('#invoiceModal').modal('show');
            }

            if(result['link'] != null) {
                setTimeout(function () {
                    window.location = result['link'];
                }, 1000);
            }


        });
    }

    $('#btnConfirm').on('click', function() {

        var msg =  $(this).attr('message');
        var id = $('#confirmationPIN').val();
        var authCode = $('#transactionAuthorizationCode').val();
        var unique = $('#unique').val();

        $('#confirmationPIN').val('');
        $('#transactionAuthCode').val('');

        confirm(id, authCode, msg, unique)

    });
};

mts.initProof = function() {
    $('[data-print-proof]').on('click', function() {
        $('.print-menu').addClass('hidden');
        window.print();
        $('.print-menu').removeClass('hidden');
    });
};

mts.initAction = function() {
    $('[data-action]').on('click', function() {

        berkaPhpJs.request({
            url: $(this).data('action'),
            type: 'GET',
            message: $(this).attr('message')
        }, function(success, result) {

            if(result.success) {
                $('.action-wrapper').html(result['content']);
                $('#actionModal').modal('show');
                //$('#actionModal').removeClass('fade');
            }

        });

    });


};

mts.InitAjaxText = function () {

    $('[data-ajax-text]').each(function (e) {

        var element = $(this);
        var key = $(this).attr('name');
        var url = $(this).data('ajax-text');

        berkaPhpJs.request({
            url: url,
            type: "GET",
            hasFile: true,
            showLoader: false,
        }, function (success, result) {
            if(success) {
                if( typeof result['data'][key] != 'undefined') {
                    element.html('');
                    element.text(result['data'][key]);
                }
            }
        });
    });

    $('[data-post-action]').each(function (e) {

        $(this).on("click", function (e) {

            var target = $(this).attr('target');
            var url = $(this).data('post-action');

            berkaPhpJs.request({
                url: url,
                type: "GET",
                hasFile: false,
                showLoader: true,
            }, function (success, result) {
                if(success) {
                    $(target).html(result['data']);
                    //$(target).text(result['data']);

                    //$(target).text("gdddgdg");
                }
            });

        })


    });

};

mts.initActionButton = function() {
    $('[data-action-btn]').each(function(){

        $(this).confirmation({
            onClick: function(id, event) {

                var transactionId = event.target.getAttribute('data-action-btn');
                var comment = $('#Comment').val();
                var action = event.target.getAttribute('id');

                if (id == 'yes') {
                    berkaPhpJs.request({
                        url: '/company/transactions/action',
                        type: 'POST',
                        data: {action: action, transactionId: transactionId, Comment: comment},
                        message: $(this).attr('message')
                    }, function(success, result) {
                        if(result.success) {
                            window.location.reload();
                        }
                    });
                }
            }
        });

    })
};

mts.initButton = function() {
    $('[data-button]').each(function(){

        var link = $(this).data('button');
        $(this).confirmation({
            onClick: function(id, event) {

                if (id == 'yes') {
                    berkaPhpJs.request({
                        url: link,
                        type: 'GET',
                        data: {},
                        message: $(this).attr('message')
                    }, function(success, result) {
                        if(result.success && result.link) {
                            window.location.reload();
                        }
                    });
                }
            }
        });

    })
};

mts.initPlugin = function() {
    $('[data-color-picker]').each(function(){
        $(this).colorPicker();
    })
};

mts.initNotification = function() {
    var ids = [];

    function check() {
        berkaPhpJs.request({
            url: '/company/panelnotification/alert',
            type: 'GET',
            showLoader: false,
            data:{ids: ids}
        }, function(success, result) {

            if(result.success) {
                ids.push(result.id);

                if($('#notification_' + result.id).length == 0)
                    $('[data-notification-area]').append(result.content);

            }

            setTimeout(check, 3000);
        });


    }

    check();


    // setInterval(function(){check();}, 2000);

};

mts.initNotificationDismiss = function(value) {

    $('[data-notification-dismiss]').confirmation({
        onClick: function(id, event) {
            if (id == 'yes') {
                berkaPhpJs.request({
                    url: '/company/panelnotification/dismiss',
                    type: 'POST',
                    data: {id: event.target.getAttribute('data-notification-dismiss')},
                    message: "Dismissing..."
                }, function(success, result) {
                    if(result.success) {
                        $('#notification_' + event.target.getAttribute('data-notification-dismiss')).remove();
                    }
                });
            }
        }
    });

};

//

mts.initMenuAndLoader = function(value) {

    $('[data-menu-toggle]').on('click', function(){

        berkaPhpJs.request({
            url: '/client/setting/navigation',
            type: 'GET',
            data: {},
            message: "",
            showLoader:false
        }, function(success, result) {

        });

    });

    $(window).load(function() {
        $(".se-pre-con").fadeOut("slow");
    });

};


mts.initAll = function() {

    berkaPhpJs.init();

    mts.initCurrency();
    mts.initLanguage();
    berkaPhpJs.initEqualizer('[data-eq]');
    mts.initFormRequest();
    mts.initSearch();
    mts.initPlugin();
    //mts.initNotification();
    mts.initTable();
    mts.InitAjaxText();
    //mts.initAction();
    mts.initButton();
    //mts.InitAjaxText();
    mts.InitAjaxModal();


    $('[data-static-dropdown]').each(function (e) {
        $(this).select2();
    })


};

var countOrder = 0;

mts.initTable = function() {


    //$("#dataTable").tableExport({
    //    headings: true,
    //    footers: true,
    //    formats: [],
    //    fileName: "id",
    //    bootstrap: true,
    //    position: "bottom",
    //    ignoreRows: null,
    //    ignoreCols: null,
    //    trimWhitespace: true
    //});

    $('#dataTable').DataTable({
        "order": [0],
        paging: true
    });

    //$('.dataTablePaging').DataTable();
};

mts.initCropper = function () {

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
                width: 300,
                height: 300,
                type: 'square'
            },
            showZoomer: true,
            boundary: {
                width: 300,
                height: 300
            }
        });

        $('[data-crop-btn]').on('click', function () {

            $('[data-croppie]').croppie('result', 'base64').then(function (base64) {
                var element = $('[data-crop-btn]').data('crop-btn');
                $('.profile').attr('src', base64);

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
    }
}



$(document).ready(function() {
    mts.initAll();
    mts.initMenuAndLoader();
});