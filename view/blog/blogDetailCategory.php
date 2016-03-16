<?php
session_start();
require '../../model/com.gogetrich.function/CredentialValidationService.php';
require '../../model-db-connection/config.php';
$serviceCheck = new CredentialValidationService();
if (!isset($_SESSION['token'])) {
    echo '<script type="text/javascript">window.location.href="../../index.php";</script>';
} else if ($serviceCheck->checkIsTokenValid($_SESSION['token']) == 409) {
    echo '<script type="text/javascript">window.location.href="../loginError?rc=' . md5(409) . '&aRed=true";</script>';
} else {
    $now = time();
    if ($now > isset($_SESSION['expire'])) {
        $timeOut = $serviceCheck->invalidToken($_SESSION['token']);
        if ($timeOut == 200) {
            echo '<script type="text/javascript">'
            . 'window.location.href="../loginError?rc=' . md5(409) . '&aRed=true";" '
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
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-responsive.min.css" />
        <!-- gebo blue theme-->
        <link rel="stylesheet" href="../assets/css/blue.css" id="link_theme" />
        <!-- breadcrumbs-->
        <link rel="stylesheet" href="../assets/lib/jBreadcrumbs/css/BreadCrumb.css" />
        <!-- tooltips-->
        <link rel="stylesheet" href="../assets/lib/qtip2/jquery.qtip.min.css" />
        <!-- notifications -->
        <link rel="stylesheet" href="../assets/lib/sticky/sticky.css" />
        <!-- colorbox -->
        <link rel="stylesheet" href="../assets/lib/colorbox/colorbox.css" />
        <!-- notifications -->
        <link rel="stylesheet" href="../assets/lib/sticky/sticky.css" />    
        <!-- splashy icons -->
        <link rel="stylesheet" href="../assets/img/splashy/splashy.css" />

        <!-- main styles -->
        <link rel="stylesheet" href="../assets/css/style.css" /> 

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
        <div id="loading_layer" style="display:none"><img src="../assets/img/ajax_loader.gif" alt="" /></div>        

        <div id="maincontainer" class="clearfix">
            <!-- header -->
            <header>
                <div class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="container-fluid">
                            <a class="brand" href="../dashboard"><i class="icon-home icon-white"></i> Go get rich Admin</a>
                            <ul class="nav user_menu pull-right">

                                <li class="divider-vertical hidden-phone hidden-tablet"></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $jsonValue['USERNAME']; ?> <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">My Profile</a></li>
                                        <li class="divider"></li>
                                        <li><a href="../../model/com.gogetrich.function/Logout.php">Log Out</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <a data-target=".nav-collapse" data-toggle="collapse" class="btn_menu">
                                <span class="icon-align-justify icon-white"></span>
                            </a>
                            <nav>
                                <div class="nav-collapse">
                                    <ul class="nav">
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                                <i class="icon-user icon-white"></i> User Management <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="#">View All Users</a>
                                                </li>
                                                <li>
                                                    <a href="../dashboard">View User Enroll</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                                <i class="icon-list-alt icon-white"></i> Content Management <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown">
                                                    <a href="#"><i class="icon-calendar"></i> Course Schedule <b class="caret-right"></b></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="../courseCategories/courseCategories">Course Categories</a></li>
                                                        <li><a href="../descriptionHeader/descriptionHeader">Course Description Header</a></li>   
                                                        <li><a href="../courseDetails/courseDetail">Course Detail</a></li>                                                       
                                                    </ul>
                                                </li>
                                                <li class="dropdown">
                                                    <a href="#"><i class="icon-bullhorn"></i> Learn to rich <b class="caret-right"></b></a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="#">Content Categories</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Content Detail</a>
                                                        </li>                                                       
                                                    </ul>
                                                </li>
                                                <li class="dropdown">
                                                    <a href="#">
                                                        <i class="icon-book"></i> Blog management <b class="caret-right"></b>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="blogDetailCategory">Blog Category</a></li>
                                                        <li><a href="blogDetail">Blog Detail</a></li>                                                       
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>

                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>                                
            </header>

            <!-- main content -->
            <div id="contentwrapper">
                <div class="main_content" style="margin-left: 0px !important; height:700px !important;">
                    <nav>
                        <div id="jCrumbs" class="breadCrumb module">
                            <ul>
                                <li>
                                    <a href="../dashboard"><i class="icon-home"></i></a>
                                </li>
                                <li>
                                    <a href="#">Content management</a>
                                </li>
                                <li>
                                    Blog Category
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="heading clearfix">
                                <h3 class="pull-left">Blog Category</h3>
                                <span class="pull-right btn"><i class="icon-plus"></i> Create Blog Category</span>
                            </div>
                            <div id="blogCateTbl"></div>
                        </div>                        
                    </div>
                </div>
            </div>
            <div class="modal hide fade" id="createCate">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">×</button>
                    <h3>Category Form</h3>
                </div>
                <div class="modal-body">                   
                    <div id="alertCate" class="alert alert-danger">Please enter category name</div>
                    <form id="courseCateForm">
                        <div class="formSep">
                            <label>Category Name*</label>
                            <input type="text" name="cateName" id="cateName">
                            <input type="hidden" name="cateID" id="cateID">
                            <input type="hidden" name="cateDate" id="cateDate">
                        </div>                        
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" onclick="saveCate();">Save</a>
                </div>
            </div>


            <script src="../assets/js/jquery.min.js"></script>
            <!-- smart resize event -->
            <script src="../assets/js/jquery.debouncedresize.min.js"></script>
            <!-- hidden elements width/height -->
            <script src="../assets/js/jquery.actual.min.js"></script>
            <!-- js cookie plugin -->
            <script src="../assets/js/jquery.cookie.min.js"></script>
            <!-- main bootstrap js -->
            <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
            <!-- bootstrap plugins -->
            <script src="../assets/js/bootstrap.plugins.min.js"></script>
            <!-- tooltips -->
            <script src="../assets/lib/qtip2/jquery.qtip.min.js"></script>
            <!-- jBreadcrumbs -->
            <script src="../assets/lib/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js"></script>
            <!-- sticky messages -->
            <script src="../assets/lib/sticky/sticky.min.js"></script>
            <!-- fix for ios orientation change -->
            <script src="../assets/js/ios-orientationchange-fix.js"></script>
            <!-- scrollbar -->
            <script src="../assets/lib/antiscroll/antiscroll.js"></script>
            <script src="../assets/lib/antiscroll/jquery-mousewheel.js"></script>
            <!-- common functions -->
            <script src="../assets/js/gebo_common.js"></script>

            <!-- colorbox -->
            <script src="../assets/lib/colorbox/jquery.colorbox.min.js"></script>
            <!-- datatable -->
            <script src="../assets/lib/datatables/jquery.dataTables.min.js"></script>
            <!-- additional sorting for datatables -->
            <script src="../assets/lib/datatables/jquery.dataTables.sorting.js"></script>            

            <script type="text/javascript">
                        $(document).ready(function () {

                            $("#blogCateTbl").load("blogCateTbl.php", function () {
                                $("html").removeClass("js");
                            });
                            setInterval(function () {
                                $.ajax({
                                    url: "../../model/com.gogetrich.function/SessionCheck.php",
                                    type: 'POST',
                                    success: function (data, textStatus, jqXHR) {
                                        if (data == 409) {
                                            //session expired
                                            window.location.href = "../loginError?rc=<?= md5(409) ?>&aRed=true";
                                        }
                                    }
                                });
                            }, 3000);
                        });
            </script>
        </div>
    </body>
</html>