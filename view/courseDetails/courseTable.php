<?php
require '../../model-db-connection/config.php';
?>
<table class="table table-bordered table-striped table_vam" id="dt_gal">
    <thead>
        <tr>                                                              
            <th>No.</th>
            <th>Course Name</th>
            <th>Course Category</th>
            <th>Created date time</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $id = 1;
        $sqlSelectCate = "SELECT * FROM GTRICH_COURSE_HEADER GCH "
                . "LEFT JOIN GTRICH_COURSE_CATEGORY GCC ON GCH.REF_CATE_ID = GCC.CATE_ID";
        $res = mysql_query($sqlSelectCate);
        while ($row = mysql_fetch_array($res)) {
            ?>
            <tr>       
                <td style="text-align: center" width="50px"><?= $id ?></td>
                <td><?= $row['HEADER_NAME'] ?></td>
                <td><?= $row['CATE_NAME'] ?></td>
                <td><?= $row['HEADER_CREATE_DATE_TIME'] ?></td>
                <td style="text-align: center"><?php
                    if ($row['HEADER_COURSE_STATUS'] == 0) {
                        echo 'Publish';
                    } else {
                        echo 'Not Publish';
                    }
                    ?></td>
                <td style="text-align: center">
                    <a href="#" class="btn btn-small" title="Edit" onclick="prepareAndUpdateDetail('<?= $row['HEADER_ID'] ?>')">
                        <i class="icon-adt_atach"></i> Edit
                    </a>
                    <a href="#" class="btn btn-small" title="Delete" onclick="deleteCourseHeaderDetailByID('<?= $row['HEADER_ID'] ?>')">
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
    $('#dt_gal').dataTable({
        "sDom": "<'row'<'span6'<'dt_actions'>l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
        "sPaginationType": "bootstrap"
    });
</script>