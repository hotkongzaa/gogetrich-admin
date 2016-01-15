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
                <div class="main_content" style="margin-left: 0px !important; height:600px !important;">

                    <div class="row-fluid">
                        <div class="span12">
                            <div class="heading clearfix">
                                <h3 class="pull-left">Customer Enroll</h3>          
                                <!--span class="pull-right btn" onclick="createCate();"><i class="icon-plus"></i> Create Category</span-->
                            </div>
                            <div id="customerEnroll"></div>
                        </div>                        
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
                dashboard.initialElement();

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
            dashboard = {
                initialElement: function () {
                    $("#customerEnroll").load("dashboard_tbl.php", function () {
                        $("html").removeClass("js");
                    });
                }
            };
            </script>

        </div>        
    </body>
</html>