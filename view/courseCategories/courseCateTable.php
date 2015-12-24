<?php
require '../../model-db-connection/config.php';
?>
<table class="table table-bordered table-striped table_vam" id="dt_gal">
    <thead>
        <tr>                                                              
            <th>No.</th>
            <th>Course Categories Name</th>
            <th>Create Date Time</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $id = 1;
        $sqlSelectCate = "SELECT * FROM GTRICH_COURSE_CATEGORY";
        $res = mysql_query($sqlSelectCate);
        while ($row = mysql_fetch_array($res)) {
            ?>
            <tr>       
                <td style="text-align: center" width="50px"><?= $id ?></td>
                <td><?= $row['CATE_NAME'] ?></td>
                <td style="text-align: center" width="150px"><?= $row['CATE_CREATE_DATE_TIME'] ?></td>
                <td style="text-align: center" width="150px">
                    <a href="#" class="btn btn-small" title="Edit" onclick="getCourseCateByID('<?= $row['CATE_ID'] ?>')"><i class="icon-pencil"></i> Edit</a>
                    <a href="#" class="btn btn-small" title="Delete" onclick="deleteCourseCate('<?= $row['CATE_ID'] ?>')"><i class="icon-trash"></i> Delete</a>
                </td>
            </tr>
            <?php
            $id++;
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