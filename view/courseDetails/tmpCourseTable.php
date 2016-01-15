<?php
session_start();
require '../../model-db-connection/config.php';
require '../../model/com.gogetrich.function/CredentialValidationService.php';
$serviceCheck = new CredentialValidationService();
$jsonObj = $serviceCheck->getTokenDetail($_SESSION['token']);
$jsonValue = json_decode($jsonObj, true);
?>
<table class="table table-bordered table-striped table_vam" id="dt_gal">
    <thead>
        <tr>                                                              
            <th>No.</th>
            <th>Description Header</th>
            <th>Course Detail</th>
            <th>Lat Lng</th>
            <th>Created date time</th>
            <th>Order</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $id = 1;
        $sqlSelectCate = "SELECT * FROM GTRICH_COURSE_DETAIL_TMP GCDT "
                . "LEFT JOIN GTRICH_DESCRIPTION_HEADER GDH ON GCDT.REF_COURSE_HEADER_ID = GDH.DESC_HEADER_ID "
                . "WHERE DISTRIBUTOR_ID LIKE '" . $jsonValue['USERID'] . "'";
        $res = mysql_query($sqlSelectCate);
        while ($row = mysql_fetch_array($res)) {
            ?>
            <tr>       
                <td style="text-align: center" width="50px"><?= $id ?></td>
                <td><?= $row['DESC_HEADER_NAME'] ?></td>
                <td><?= $row['DETAIL_DESCRIPTION'] ?></td>
                <?php
                if (empty($row['DETAIL_LAT'])) {
                    ?>
                    <td></td>
                    <?php
                } else {
                    ?>
                    <td><?= $row['DETAIL_LAT'] ?>,<?= $row['DETAIL_LNG'] ?></td>
                    <?php
                }
                ?>

                <td style="text-align: center"><?= $row['DETAIL_CREATED_DATE_TIME'] ?></td>
                <td style="text-align: center" class="edit"><?= $row['DETAIL_ORDER'] ?></td>
                <td style="text-align: center">
                    <a href="#" class="btn btn-small" title="Edit" onclick="getCourseTmpForEdit('<?= $row['DETAIL_ID'] ?>')"><i class="icon-pencil"></i> Edit</a>
                    <a href="#" class="btn btn-small" title="Delete" onclick="deleteCourseTmp('<?= $row['DETAIL_ID'] ?>')"><i class="icon-trash"></i> Delete</a>
                </td>
            </tr>
            <?php
            $id++;
        }
        ?>

    </tbody>
</table>
<script type="text/javascript">
    $(document).ready(function () {
        $('#dt_gal').dataTable({
            "sDom": "<'row'<'span6'<'dt_actions'>l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
            "sPaginationType": "bootstrap"
        });
    });
</script>
