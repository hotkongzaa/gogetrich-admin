<?php
session_start();
require '../model/com.gogetrich.function/CredentialValidationService.php';
require '../model-db-connection/config.php';
$serviceCheck = new CredentialValidationService();
if (!isset($_SESSION['token'])) {
    echo '<script type="text/javascript">window.location.href="../index.php";</script>';
} else if ($serviceCheck->checkIsTokenValid($_SESSION['token']) == 409) {
    echo '<script type="text/javascript">window.location.href="loginError?rc=' . md5(409) . '&aRed=true";</script>';
} else {
    $now = time();
    if ($now > isset($_SESSION['expire'])) {
        $timeOut = $serviceCheck->invalidToken($_SESSION['token']);
        if ($timeOut == 200) {
            echo '<script type="text/javascript">'
            . 'window.location.href="loginError?rc=' . md5(409) . '&aRed=true";" '
            . '</script>';
        }
    } else {
        $jsonObj = $serviceCheck->getTokenDetail($_SESSION['token']);
        $jsonValue = json_decode($jsonObj, true);

        $userId = (string) filter_input(INPUT_GET, 'uID');

        $sqlGetCusInfo = "SELECT * FROM RICH_CUSTOMER WHERE CUS_ID = '" . $userId . "'";
        $resGetCusInfo = mysql_query($sqlGetCusInfo);
        $rowGetCusInfo = mysql_fetch_assoc($resGetCusInfo);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Gogetrich Admin Panel</title>

        <!-- Bootstrap framework -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-responsive.min.css" />
        <!-- gebo blue theme-->
        <link rel="stylesheet" href="assets/css/blue.css" id="link_theme" />
        <!-- breadcrumbs-->
        <link rel="stylesheet" href="assets/lib/jBreadcrumbs/css/BreadCrumb.css" />
        <!-- tooltips-->
        <link rel="stylesheet" href="assets/lib/qtip2/jquery.qtip.min.css" />
        <!-- colorbox -->
        <link rel="stylesheet" href="assets/lib/colorbox/colorbox.css" />    
        <!-- code prettify -->
        <link rel="stylesheet" href="assets/lib/google-code-prettify/prettify.css" />    
        <!-- notifications -->
        <link rel="stylesheet" href="assets/lib/sticky/sticky.css" />    
        <!-- splashy icons -->
        <link rel="stylesheet" href="assets/img/splashy/splashy.css" />
        <!-- flags -->
        <link rel="stylesheet" href="assets/img/flags/flags.css" />	
        <!-- calendar -->
        <link rel="stylesheet" href="assets/lib/fullcalendar/fullcalendar_gebo.css" />

        <!-- main styles -->
        <link rel="stylesheet" href="assets/css/style.css" />

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans" />

        <!-- Favicon -->
        <link rel="shortcut icon" href="favicon.ico" />

        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/ie.css" />
            <script src="js/ie/html5.js"></script>
                        <script src="js/ie/respond.min.js"></script>
                        <script src="lib/flot/excanvas.min.js"></script>
        <![endif]-->

        <script>
            //* hide all elements & show preloader
            document.documentElement.className += 'js';
        </script>
        <!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  --></head>
    <body>
        <div id="loading_layer" style="display:none"><img src="assets/img/ajax_loader.gif" alt="" /></div>        

        <div id="maincontainer" class="clearfix">
            <!-- header -->
            <header>
                <?php include './utils/leftHandMenu.php'; ?>                              
            </header>

            <!-- main content -->
            <div id="contentwrapper">
                <div class="main_content" style="margin-left: 0px !important;">
                    <nav>
                        <div id="jCrumbs" class="breadCrumb module">
                            <ul>
                                <li>
                                    <a href="dashboard"><i class="icon-home"></i></a>
                                </li>
                                <li>
                                    <a href="#">User management</a>
                                </li>
                                <li>
                                    <a href="#">View User Enroll</a>
                                </li>
                                <li>
                                    View user: <?= $rowGetCusInfo['CUS_FIRST_NAME'] ?> <?= $rowGetCusInfo['CUS_LAST_NAME'] ?>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div>
                        <a href="dashboard"><i class="splashy-arrow_state_blue_left"></i> Back</a><br/><br/>
                    </div>
                    <div class="row-fluid">
                        <?php
                        if (!empty($rowGetCusInfo['CUS_FIRST_NAME'])) {
                            ?>

                            <div class="span12">
                                <div class="heading clearfix">
                                    <h3 class="pull-left"><strong>User Detail: </strong> <i class="splashy-group_green"></i> <?= $rowGetCusInfo['CUS_FIRST_NAME'] ?> <?= $rowGetCusInfo['CUS_LAST_NAME'] ?></h3>                        
                                    <br/><br/>
                                    <h3 class="pull-left"><strong>Course Registered: </strong><i class="splashy-document_a4_marked"></i> <?= $_GET['cName'] ?></h3>
                                </div>
                                <div class="span8">
                                    <table class="table table-bordered table-striped table_vam">
                                        <tbody>
                                            <tr>
                                                <td><strong>Payment status: </strong></td>
                                                <td>
                                                    <?php
                                                    if ($_GET['pT'] == md5("PENDING")) {
                                                        echo '<i class="splashy-box_locked"></i>: PENDING';
                                                    } else if ($_GET['pT'] == md5("COMPLETE")) {
                                                        echo '<i class="splashy-box_okay"></i>: COMPLETE';
                                                    } else if ($_GET['pT'] == md5("REJECT")) {
                                                        echo '<i class="splashy-box_remove"></i>: REJECT';
                                                    } else {
                                                        echo '<i class="splashy-box_locked"></i>: UNKNOWN';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="250px"><strong>Username: </strong></td>
                                                <td>
                                                    <?= $rowGetCusInfo['CUS_USERNAME'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="250px"><strong>Name: </strong></td>
                                                <td>
                                                    <?= $rowGetCusInfo['CUS_FIRST_NAME'] ?> <?= $rowGetCusInfo['CUS_LAST_NAME'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="250px"><strong>Email: </strong></td>
                                                <td>
                                                    <?= $rowGetCusInfo['CUS_EMAIL'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="250px"><strong>Gender: </strong></td>
                                                <td>
                                                    <?= $rowGetCusInfo['CUS_GENDER'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="250px"><strong>Contact Address: </strong></td>
                                                <td>
                                                    <?= $rowGetCusInfo['CUS_CONTACT_ADDRESS'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="250px"><strong>Receipt Address: </strong></td>
                                                <td>
                                                    <?= $rowGetCusInfo['CUS_RECEIPT_ADDRESS'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="250px"><strong>Phone number: </strong></td>
                                                <td>
                                                    <?= $rowGetCusInfo['CUS_PHONE_NUMBER'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="250px"><strong>Facebook Address: </strong></td>
                                                <td>
                                                    <?= $rowGetCusInfo['CUS_FACEBOOK_ADDRESS'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="250px"><strong>Registered Date time: </strong></td>
                                                <td>
                                                    <?= $rowGetCusInfo['CREATED_DATE_TIME'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="250px" style="vertical-align: top"><strong>Course Registration: </strong></td>
                                                <td>
                                                    <div class="span12">
                                                        <div id="accordion1" class="accordion">
                                                            <?php
                                                            $sqlGetEnrollDetail = "SELECT * FROM GTRICH_COURSE_HEADER GCH "
                                                                    . "LEFT JOIN RICH_CUSTOMER_ENROLL RCE ON GCH.HEADER_ID = RCE.ENROLL_COURSE_ID "
                                                                    . "WHERE ENROLL_ID = '" . $_GET['enID'] . "'";
                                                            $resGetEnrollDetail = mysql_query($sqlGetEnrollDetail);
                                                            $rowEnrollDetail = mysql_fetch_assoc($resGetEnrollDetail);
                                                            ?>
                                                            <div class="accordion-group">
                                                                <div class="accordion-heading">
                                                                    <a href="#collapseOne1" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle acc-in">
                                                                        <strong>Course Name: </strong><i class="splashy-document_a4_marked"></i> <?= $rowEnrollDetail['HEADER_NAME'] ?>
                                                                    </a>
                                                                </div>
                                                                <div class="accordion-body in collapse" id="collapseOne1">
                                                                    <div class="accordion-inner">
                                                                        <?php
                                                                        $sqlGetRegisDetailByID = "SELECT * FROM RICH_CUSTOMER_ENROLL WHERE ENROLL_ID = '" . $_GET['enID'] . "'";
                                                                        $resGetRegisDetailByID = mysql_query($sqlGetRegisDetailByID);
                                                                        $rowGetRegisDetailByID = mysql_fetch_assoc($resGetRegisDetailByID);
                                                                        ?>
                                                                        <li><strong>ช่องทางการจ่ายที่เลือก</strong> (Payment method): <?= $rowGetRegisDetailByID['ENROLL_PAYMENT_TERM'] == 1 ? "จ่ายเงินสดหน้างาน ในวันแรกของการอบรม" : "โอนเงินเข้าบัญชี (ชื่อบัญชี 'บจ. เอสอี ทอล์ค' ธนาคารกรุงเทพ เลขที่บัญชี 021-7-08688-3, กรุณาส่งสำเนาหลักฐานการโอนเงินมาที่ pinhatai.d@gmail.com)" ?></li>
                                                                        <li><strong>ส่วนลด: </strong></li>
                                                                        <ul>
                                                                            <?php
                                                                            $disArray = explode("||", $rowGetRegisDetailByID['ENROLL_SEMINARDISCOUNT']);
                                                                            for ($i = 0; $i < sizeof($disArray) - 1; $i++) {
                                                                                ?>
                                                                                <li><?= $disArray[$i] ?></li>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </ul>                                                                        
                                                                        <li>
                                                                            <strong>ลงทะเบียนเมื่อ: </strong> <?= $rowGetRegisDetailByID['CREATED_DATE_TIME'] ?>
                                                                        </li>
                                                                    </div>
                                                                </div>
                                                            </div>                                                        
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="span3">
                                    <div class="w-box" id="w_sort04">    
                                        <div class="w-box-header">
                                            Course Registered by this customer
                                        </div>
                                        <div class="w-box-content">
                                            <table class="table table-striped table_vam no-th">
                                                <tbody>
                                                    <?php
                                                    $sqlGetAnotherCourseByUserID = "SELECT * FROM RICH_CUSTOMER_ENROLL RCE "
                                                            . "LEFT JOIN GTRICH_COURSE_HEADER GCH ON RCE.ENROLL_COURSE_ID = GCH.HEADER_ID "
                                                            . "WHERE ENROLL_CUS_ID = '" . $_GET['uID'] . "'";
                                                    $resAnotherRegis = mysql_query($sqlGetAnotherCourseByUserID);
                                                    while ($rowAnotherRegistered = mysql_fetch_array($resAnotherRegis)) {
                                                        ?>
                                                        <tr>                                                        
                                                            <td><?= $rowAnotherRegistered['HEADER_NAME'] ?></td>
                                                            <td><?= $rowAnotherRegistered['PAYMENT_STATUS'] ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                        } else {
                            ?>
                            <div class="error_box">
                                <h1>404 Page/File not found</h1>
                                <p>The page/file you've requested has been moved or taken off the site.</p>
                                <a href="dashboard" class="back_link btn btn-small">Go back</a>
                            </div>
                            <?php
                        }
                        ?>

                    </div>      
                </div>
            </div>

            <script src="assets/js/jquery.min.js"></script>
            <!-- smart resize event -->
            <script src="assets/js/jquery.debouncedresize.min.js"></script>
            <!-- hidden elements width/height -->
            <script src="assets/js/jquery.actual.min.js"></script>
            <!-- js cookie plugin -->
            <script src="assets/js/jquery.cookie.min.js"></script>
            <!-- main bootstrap js -->
            <script src="assets/bootstrap/js/bootstrap.min.js"></script>
            <!-- tooltips -->
            <script src="assets/lib/qtip2/jquery.qtip.min.js"></script>
            <!-- jBreadcrumbs -->
            <script src="assets/lib/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js"></script>
            <!-- lightbox -->
            <script src="assets/lib/colorbox/jquery.colorbox.min.js"></script>
            <!-- fix for ios orientation change -->
            <script src="assets/js/ios-orientationchange-fix.js"></script>
            <!-- scrollbar -->
            <script src="assets/lib/antiscroll/antiscroll.js"></script>
            <script src="assets/lib/antiscroll/jquery-mousewheel.js"></script>
            <!-- common functions -->
            <script src="assets/js/gebo_common.js"></script>

            <script src="assets/lib/jquery-ui/jquery-ui-1.8.20.custom.min.js"></script>
            <!-- touch events for jquery ui-->
            <script src="assets/js/forms/jquery.ui.touch-punch.min.js"></script>
            <!-- multi-column layout -->
            <script src="assets/js/jquery.imagesloaded.min.js"></script>
            <script src="assets/js/jquery.wookmark.js"></script>
            <!-- responsive table -->
            <script src="assets/js/jquery.mediaTable.min.js"></script>
            <!-- datatable -->
            <script src="assets/lib/datatables/jquery.dataTables.min.js"></script>
            <!-- small charts -->
            <script src="assets/js/jquery.peity.min.js"></script>
            <!-- charts -->
            <script src="assets/lib/flot/jquery.flot.min.js"></script>
            <script src="assets/lib/flot/jquery.flot.resize.min.js"></script>
            <script src="assets/lib/flot/jquery.flot.pie.min.js"></script>
            <!-- calendar -->
            <script src="assets/lib/fullcalendar/fullcalendar.min.js"></script>
            <!-- sortable/filterable list -->
            <script src="assets/lib/list_js/list.min.js"></script>
            <script src="assets/lib/list_js/plugins/paging/list.paging.min.js"></script>
            <!-- dashboard functions -->
            <script src="assets/js/gebo_dashboard.js"></script>

            <script>
            $(document).ready(function () {
                setTimeout('$("html").removeClass("js")', 500);
                setInterval(function () {
                    $.ajax({
                        url: "../model/com.gogetrich.function/SessionCheck.php",
                        type: 'POST',
                        success: function (data, textStatus, jqXHR) {
                            if (data == 409) {
                                //session expired
                                window.location.href = "loginError?rc=<?= md5(409) ?>&aRed=true";
                            }
                        }
                    });
                }, 3000);
            });
            </script>

        </div>
    </body>
</html>