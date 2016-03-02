<?php
require '../../model-db-connection/config.php';
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="enrollment_sheet_data.xls"');
header('Cache-Control: max-age=0');
?>                  
<table class="table table-bordered table-striped table_vam" border="1">
    <thead>
        <tr>
            <th>No.</th>
            <th>Customer Name</th>
            <th>Payment Status</th>
            <th>Phone number</th>
            <th>Register Date</th>
            <th>Course Name</th>
            <th>Remark</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $searchCriteria = (string) filter_input(INPUT_GET, 'searchCriteria');
        if ($searchCriteria == "all") {
            $sqlGetUserEnroll = "SELECT * FROM RICH_CUSTOMER_ENROLL RCE "
                    . "LEFT JOIN RICH_CUSTOMER RC ON RC.CUS_ID = RCE.ENROLL_CUS_ID "
                    . "LEFT JOIN GTRICH_COURSE_HEADER GCH ON RCE.ENROLL_COURSE_ID = GCH.HEADER_ID "
                    . "ORDER BY RCE.CREATED_DATE_TIME DESC";
        } else {
            $customerFName = (string) filter_input(INPUT_GET, 'customerFName');
            $customerLName = (string) filter_input(INPUT_GET, 'customerLName');
            $regisFromDate = (string) filter_input(INPUT_GET, 'regisFromDate');
            $regisToDate = (string) filter_input(INPUT_GET, 'regisToDate');
            $courseHeaderId = (string) filter_input(INPUT_GET, 'courseHeaderId');
            $paymentStatus = (string) filter_input(INPUT_GET, 'paymentStatus');

            $conditaionCustomerFName = $customerFName == "" ? "" : "AND RC.CUS_FIRST_NAME LIKE '%" . $customerFName . "%' ";
            $conditaionCustomerLName = $customerLName == "" ? "" : "AND RC.CUS_LAST_NAME LIKE '%" . $customerLName . "%' ";
            $conditioncourseHeaderId = $courseHeaderId == 0 ? "" : "AND GCH.HEADER_ID LIKE '" . $courseHeaderId . "' ";
            $conditionPaymentStatus = "";
            if (!empty($paymentStatus) || $paymentStatus != 0) {
                $conditionPaymentStatus = "AND RCE.PAYMENT_STATUS LIKE '" . $paymentStatus . "' ";
            }
            $conditionaDate = "";
            if (!empty($regisFromDate) && !empty($regisToDate)) {
                $conditionaDate = "AND RCE.CREATED_DATE_TIME BETWEEN '" . $regisFromDate . "' AND '" . $regisToDate . "' ";
            }

            $sqlGetUserEnroll = "SELECT * FROM RICH_CUSTOMER_ENROLL RCE "
                    . "LEFT JOIN RICH_CUSTOMER RC ON RC.CUS_ID = RCE.ENROLL_CUS_ID "
                    . "LEFT JOIN GTRICH_COURSE_HEADER GCH ON RCE.ENROLL_COURSE_ID = GCH.HEADER_ID "
                    . "WHERE 1=1 "
                    . $conditaionCustomerFName
                    . $conditaionCustomerLName
                    . $conditioncourseHeaderId
                    . $conditionPaymentStatus
                    . $conditionaDate
                    . "ORDER BY RCE.CREATED_DATE_TIME DESC";
        }

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
                <td> <?= $rowGetUserEnroll['CUS_PHONE_NUMBER'] ?></td>
                <td> <?= $rowGetUserEnroll['CREATED_DATE_TIME'] ?></td>
                <td> <?= $rowGetUserEnroll['HEADER_NAME'] ?></td>
                <td></td>
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