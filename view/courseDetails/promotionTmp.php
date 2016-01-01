<?php
session_start();
require '../../model-db-connection/config.php';
?>
<table class="table table-bordered table-striped table_vam" id="promotionTmpTbl">
    <thead>
        <tr>                                                              
            <th>No.</th>
            <th>Promotion Name</th>
            <th>Created date time</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $id = 1;
        $sqlSelectCate = "SELECT * FROM GTRICH_PROMOTION_TMP GCH WHERE DISTRIBUTOR_ID = '" . $_SESSION['userId'] . "' ORDER BY PRO_CREATED_DATE_TIME DESC";
        $res = mysql_query($sqlSelectCate);
        while ($row = mysql_fetch_array($res)) {
            ?>
            <tr>       
                <td style="text-align: center" width="50px"><?= $id ?></td>
                <td><?= $row['PRO_NAME'] ?></td>
                <td><?= $row['PRO_CREATED_DATE_TIME'] ?></td>
                <td style="text-align: center">
                    <a href="#" class="btn btn-small" title="Edit" onclick="getPromotionTmpByID('<?= $row['PRO_ID']
            ?>')">
                        <i class="icon-adt_atach"></i> Edit
                    </a>
                    <a href="#" class="btn btn-small" title="Delete" onclick="deletePromotionTmpByID('<?= $row['PRO_ID'] ?>')">
                        <i class="icon-adt_trash"></i> Delete
                    </a>
                </td>
            </tr>
            <?php
            $id++;
        }
        ?>

    </tbody>
</table>