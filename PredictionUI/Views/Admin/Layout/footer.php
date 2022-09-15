

<script src="/Views/Admin/Layout/js/jquery-2.1.1.js"></script>
<script src="/Views/Admin/Layout/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="/Views/Default/Layout/js/jquery.validate.min.js"></script>

<script src="/Views/Admin/Layout/js/editor.js"></script>
<script src="/Views/Admin/Layout/js/rojobaco-plugins-0.1.0.js"></script>
<script src="/Views/Admin/Layout/js/moment.js"></script>
<script src="/Views/Admin/Layout/js/bootstrap-datetimepicker.js"></script>

<script src="/Views/Admin/Layout/js/jquery.easing.min.js"></script>
<script src="/Views/Admin/Layout/js/croppie.js"></script>
<!--<script src="/Views/Admin/Layout/js/Chart.min.js"></script>-->
<script src="/Views/Admin/Layout/js/sb-admin-datatables.min.js"></script>
<!--<script src="/Views/Admin/Layout/js/sb-admin-charts.min.js"></script>-->
<script src="/Views/Admin/Layout/js/jquery.dataTables.js"></script>
<script src="/Views/Admin/Layout/js/Chart.min.js"></script>
<script src="/Views/Admin/Layout/js/dataTables.bootstrap4.js"></script>
<script src="/Views/Admin/Layout/js/summernote-bs4.js"></script>
<!-- Custom scripts for all pages-->
<script src="/Views/Admin/Layout/js/sb-admin.min.js"></script>

<script src="/Views/Default/Layout/js/loader.js"></script>
<script src="/Views/Default/Layout/js/notification.js"></script>
<script src="/Views/Admin/Layout/js/confirmation.js"></script>
<script src="/BerkaPhp/Template/Utility/Javascript/app.js"></script>
<script src="/Views/Admin/Layout/js/sct.js"></script>

<script>


    $(document).ready(function() {
        $('#dataTable').DataTable({
            "pageLength": 50
        });

        $('[data-select]').each(function() {

            var curentElement = $(this);
            var valueId = $(this).data('select');
            curentElement.val(valueId);
            //curentElement.attr("value", valueId);
            $(this).searchselect({
                source: function(searchText, callback) {
                    $.get('<?=BerkaPhp\Helper\Html::action('/ajax/type')?>/' + curentElement.data('type')+'', function(data) {
                        data = $.parseJSON(data);
                        callback(data);
                    });
                },
                onItemMap: function(item) {
                    return { value: item[curentElement.data('value')], label: item[curentElement.data('text')]}
                },
                selected: {
                    id:curentElement.data('select'),
                    text:curentElement.data('select-text')
                }
                ,
                searchable: false

            });

        });

        $('[data-delete]').confirmation({
            message: "Are you sure you want to delete ",
            title: "Deleting..",
            onClick: function(id, event) {
                if(id == 'yes') {
                    location.href = event.target.getAttribute('href');;
                }
            }
        });

        // $('[data-select]').each(function() {
        //     var valueId = $(this).data('select');
        //     $('input[data-select="' + valueId + '"]').val(valueId);
        // }
    });

//    var ctx = document.getElementById("myPieChart");
//
//    var myPieChart = new Chart(ctx, {
//        type: 'pie',
//        data: {
//            labels: ["Blue", "Red", "Yellow", "Green"],
//            datasets: [{
//                data: [12.21, 15.58, 11.25, 8.32],
//                backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745']
//            }]
//        }
//    });


</script>

</body>
</html>                                                                                                                                           