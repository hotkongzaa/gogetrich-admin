<?php
require '../../model-db-connection/config.php';
?>
<table class="table table-bordered table-striped table_vam dataTable">
    <thead>
        <tr>
            <th></th>
            <th>No.</th>
            <th>Customer Username</th>
            <th>Customer Name</th>
            <th>Customer Email</th>
            <th>Mobile No.</th>
            <!--<th></th>-->
        </tr>
    </thead>
    <tbody>
        <?php
        $id = 1;
        $sqlSelectCate = "SELECT * FROM RICH_CUSTOMER ORDER BY CREATED_DATE_TIME DESC";
        $res = mysql_query($sqlSelectCate);
        while ($row = mysql_fetch_array($res)) {
            ?>  
            <tr>       
                <td class="details-control" width="30px"></td>
                <td style="text-align: center" width="30px"><?= $id ?></td>                
                <td><?= $row['CUS_USERNAME'] ?></td>
                <td><?= $row['CUS_FIRST_NAME'] ?> <?= $row['CUS_LAST_NAME'] ?></td>
                <td><?= $row['CUS_EMAIL'] ?></td>
                <td><?= $row['CUS_PHONE_NUMBER'] ?></td>
    <!--                <td style="text-align: center" width="150px">
                    <a href="#" class="btn btn-small" title="Edit" onclick="getCourseCateByID('<?= $row['DESC_HEADER_ID'] ?>')"><i class="icon-pencil"></i> Edit</a>
                    <a href="#" class="btn btn-small" title="Delete" onclick="deleteCourseCate('<?= $row['DESC_HEADER_ID'] ?>')"><i class="icon-trash"></i> Delete</a>
                </td>-->
            </tr>
            <?php
            $id++;
        }
        ?>

    </tbody>
</table>
<style type="text/css">
    td.details-control {
        background: url('../assets/img/details_open.png') no-repeat center center;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('../assets/img/details_close.png') no-repeat center center;
    }

</style>

<script type="text/javascript">
    $(document).ready(function () {

        var table = $('.dataTable').DataTable({
            "order": [[1, 'asc']],
            "sDom": "<'row'<'span6'<'dt_actions'>l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
            "bPaginate": true
        });
        $('.dataTable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                var rowData = row.data();
                $.ajax({
                    url: "../../model/com.gogetrich.function/getCustomerDetailByEmail.php",
                    type: 'POST',
                    data: {'email': rowData[4]},
                    beforeSend: function (xhr) {
                        var content = '<table cellpadding="5" cellspacing="0" border="0" width="100%" style="padding-left:50px;">' +
                                '<tr>' +
                                '<td><img src="../assets/img/ajax_loader_2.gif"/></td>' +
                                '</tr>' +
                                '</table>';
                        row.child(content).show();
                    },
                    success: function (data, textStatus, jqXHR) {
                        var jsonObj = $.parseJSON(data);
                        var content = '<table cellpadding="5" cellspacing="0" border="1" width="100%" style="padding-left:50px;">' +
                                '<tr>' +
                                '<td><strong>Customer First name:</strong></td>' +
                                '<td>' + jsonObj['CUS_FIRST_NAME'] + '</td>' +
                                '<td><strong>Customer Last name:</strong></td>' +
                                '<td>' + jsonObj['CUS_LAST_NAME'] + '</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td><strong>Customer Username:</strong></td>' +
                                '<td>' + jsonObj['CUS_USERNAME'] + '</td>' +
                                '<td><strong>Customer Password:</strong></td>' +
                                '<td>********** <a href="">Reset password</a></td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td><strong>Customer Mobile No.</strong></td>' +
                                '<td>' + jsonObj['CUS_PHONE_NUMBER'] + '</td>' +
                                '<td><strong>Customer Email.</strong></td>' +
                                '<td>' + jsonObj['CUS_EMAIL'] + '</td>' +
                                '</tr>' +
                                '</table>';
                        row.child(content).show();
                    }
                });
                tr.addClass('shown');
            }
        });
        $(".dataTables_paginate").addClass("paging_bootstrap pagination");
    });

</script>