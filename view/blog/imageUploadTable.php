<?php
session_start();
require '../../model-db-connection/config.php';
require '../../model/com.gogetrich.function/CredentialValidationService.php';
$serviceCheck = new CredentialValidationService();
$jsonObj = $serviceCheck->getTokenDetail($_SESSION['token']);
$jsonValue = json_decode($jsonObj, true);
?>
<table class="table table-bordered table-striped table_vam dttanl" >
    <thead>
        <tr>                                                              
            <th>No.</th>
            <th></th>
            <th>Image Name</th>
            <th>Upload Date time</th>
            <th>Image Type</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $id = 1;
        $sqlSelectCate = "SELECT * FROM GTRICH_BLOG_IMAGES_UPLOAD WHERE PARTIAL_REG='PARTIAL' AND REF_STAFF_ID ='" . $jsonValue['USERID'] . "' ORDER BY IMAGE_UPLOAD_DATE_TIME DESC";
        $res = mysql_query($sqlSelectCate);
        while ($row = mysql_fetch_array($res)) {
            ?>
            <tr>       
                <td style="text-align: center" width="50px"><?= $id ?></td>
                <td><img src="../assets/uploads/images/<?= $row['IMAGE_NAME'] ?>" width="100px"/></td>
                <td><?= $row['IMAGE_NAME'] ?></td>
                <td><?= $row['IMAGE_UPLOAD_DATE_TIME'] ?></td>   
                <td><?= $row['IMAGE_TYPE'] ?></td>   
                <td style="text-align: center">                    
                    <a href="#" class="btn btn-small" title="Delete" onclick="deleteBlogImageInTmp('<?= $row['IMAGE_ID'] ?>', '<?= $row['IMAGE_NAME'] ?>')">
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
<script type="text/javascript">
    $('.dttanl').dataTable({
        "sDom": "<'row'<'span6'<'dt_actions'>l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
        "sPaginationType": "bootstrap"
    });
</script>