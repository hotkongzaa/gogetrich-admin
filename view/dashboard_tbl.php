<?php
require '../model-db-connection/config.php';
?>                       
<table class="table table-bordered table-striped table_vam" id="dt_gal">
    <thead>
        <tr>
            <th>No.</th>
            <th>Customer Name</th>
            <th>Payment Status</th>
            <th>Phone number</th>
            <th>Register Date</th>
            <th>Course Name</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sqlGetUserEnroll = "SELECT * FROM RICH_CUSTOMER_ENROLL RCE "
                . "LEFT JOIN RICH_CUSTOMER RC ON RC.CUS_ID = RCE.ENROLL_CUS_ID "
                . "LEFT JOIN GTRICH_COURSE_HEADER GCH ON RCE.ENROLL_COURSE_ID = GCH.HEADER_ID "
                . "ORDER BY RCE.CREATED_DATE_TIME DESC";
        $resGetUserEnroll = mysql_query($sqlGetUserEnroll);
        $no = 1;
        while ($rowGetUserEnroll = mysql_fetch_array($resGetUserEnroll)) {
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><i class="splashy-group_green"></i> <?= $rowGetUserEnroll['CUS_FIRST_NAME'] ?> <?= $rowGetUserEnroll['CUS_LAST_NAME'] ?></td>
                <td>
                    <?php
                    if ($rowGetUserEnroll['PAYMENT_STATUS'] == "PENDING") {
                        echo '<i class="splashy-box_locked"></i>: ' . $rowGetUserEnroll['PAYMENT_STATUS'];
                    } else if ($rowGetUserEnroll['PAYMENT_STATUS'] == "COMPLETE") {
                        echo '<i class="splashy-box_okay"></i>: ' . $rowGetUserEnroll['PAYMENT_STATUS'];
                    } else if ($rowGetUserEnroll['PAYMENT_STATUS'] == "REJECT") {
                        echo '<i class="splashy-box_remove"></i>: ' . $rowGetUserEnroll['PAYMENT_STATUS'];
                    } else {
                        echo '<i class="splashy-box_locked"></i>: ' . $rowGetUserEnroll['PAYMENT_STATUS'];
                    }
                    ?>
                </td>
                <td><i class="splashy-comment_reply"></i> <?= $rowGetUserEnroll['CUS_PHONE_NUMBER'] ?></td>
                <td><i class="splashy-calendar_week"></i> <?= $rowGetUserEnroll['CREATED_DATE_TIME'] ?></td>
                <td><i class="splashy-mail_light_stuffed"></i>: <?= $rowGetUserEnroll['HEADER_NAME'] ?></td>
                <td>
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="viewEnroll?enID=<?= $rowGetUserEnroll['ENROLL_ID'] ?>&uID=<?= $rowGetUserEnroll['CUS_ID'] ?>&cName=<?= $rowGetUserEnroll['HEADER_NAME'] ?>&pT=<?= md5($rowGetUserEnroll['PAYMENT_STATUS']) ?>"><i class="splashy-application_windows_share"></i> View Enroll</a></li>
                            <li><a href="#"><i class="splashy-application_windows_edit"></i> Edit Enroll</a>
                            <li><a href="#" onclick="deleteEnrollment('<?= $rowGetUserEnroll['ENROLL_ID'] ?>')"><i class="splashy-application_windows_remove"></i> Delete Enroll</a></li>
                            <li class="divider"></li>
                            <li><a href="#" onclick="changePaymentStatus('<?= $rowGetUserEnroll['ENROLL_ID'] ?>', 'COMPLETE')"><i class="splashy-box_okay"></i> Complete payment</a></li>
                            <li><a href="#" onclick="changePaymentStatus('<?= $rowGetUserEnroll['ENROLL_ID'] ?>', 'PENDING')"><i class="splashy-box_locked"></i> Pending payment</a></li>
                            <li><a href="#" onclick="changePaymentStatus('<?= $rowGetUserEnroll['ENROLL_ID'] ?>', 'REJECT')"><i class="splashy-box_remove"></i> Reject payment</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php
            $no++;
        }
        ?>
    </tbody>
</table>
<script type="text/javascript">
    $('#dt_gal').dataTable({
        "sDom": "<'row'<'span6'<'dt_actions'>l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
        "sPaginationType": "bootstrap"
    });
</script>
<style type="text/css">
    #dt_gal_wrapper{
        overflow: visible !important
    }
</style>