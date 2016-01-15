<?php
session_start();
require '../../model-db-connection/config.php';
require '../../model/com.gogetrich.function/CredentialValidationService.php';
$serviceCheck = new CredentialValidationService();
$jsonObj = $serviceCheck->getTokenDetail($_SESSION['token']);
$jsonValue = json_decode($jsonObj, true);
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
        $sqlSelectCate = "SELECT * FROM GTRICH_PROMOTION_TMP GCH WHERE DISTRIBUTOR_ID = '" . $jsonValue['USERID'] . "' ORDER BY PRO_CREATED_DATE_TIME DESC";
        $res = mysql_query($sqlSelectCate);
        $sqlCheck = "SELECT COUNT(*) AS CHECKNUM FROM GTRICH_PROMOTION_TMP WHERE DISTRIBUTOR_ID = '" . $jsonValue['USERID'] . "'";
        $resCheck = mysql_query($sqlCheck);
        $rowCheck = mysql_fetch_assoc($resCheck);
        if ($rowCheck['CHECKNUM'] > 0) {
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
        } else {
            ?>
            <tr>       
                <td style="text-align: center" colspan="4">Not found promotion for this course</td>    
            </tr>
            <?php
        }
        ?>

    </tbody>
</table>