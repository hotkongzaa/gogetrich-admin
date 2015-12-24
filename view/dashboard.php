<?php
session_start();
if (empty($_SESSION['username'])) {
    echo '<script type="text/javascript">window.location.href="../index.php";</script>';
} else {
    $now = time();
    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo '<script type="text/javascript">var r=confirm("Session expire (30 mins)!"); if(r==true){window.location.href="../index.php";}else{window.location.href="index.php";}</script>';
    } else {
        
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
                <div class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="container-fluid">
                            <a class="brand" href="dashboard"><i class="icon-home icon-white"></i> Go get rich Admin</a>
                            <ul class="nav user_menu pull-right">
                                <li class="hidden-phone hidden-tablet">
                                    <div class="nb_boxes clearfix">                                        
                                        <a data-toggle="modal" data-backdrop="static" href="#myTasks" class="label ttip_b" title="Course Register">10 <i class="splashy-calendar_week"></i></a>
                                    </div>
                                </li>

                                <li class="divider-vertical hidden-phone hidden-tablet"></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $_SESSION['username']; ?> <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">My Profile</a></li>
                                        <li class="divider"></li>
                                        <li><a href="../model/com.gogetrich.function/Logout.php">Log Out</a></li>
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
                                                    <a href="form_elements.html">View All Users</a>
                                                </li>
                                                <li>
                                                    <a href="form_elements.html">View User Enroll</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                                <i class="icon-list-alt icon-white"></i> Content Management <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown">
                                                    <a href="#">Schedule <b class="caret-right"></b></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="courseCategories/courseCategories">Course Categories</a></li>
                                                        <li><a href="#">Course Description Header</a></li>   
                                                        <li><a href="courseDetails/courseDetail">Course Detail</a></li>                                                       
                                                    </ul>
                                                </li>
                                                <li class="dropdown">
                                                    <a href="#">Learn to rich <b class="caret-right"></b></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#">Content Categories</a></li>
                                                        <li><a href="#">Content Detail</a></li>                                                       
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
                <div class="modal hide fade" id="myTasks">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">×</button>
                        <h3>New Tasks</h3>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">In this table jquery plugin turns a table row into a clickable link.</div>
                        <table class="table table-condensed table-striped" data-rowlink="a">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Summary</th>
                                    <th>Updated</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>P-23</td>
                                    <td><a href="javascript:void(0)">Admin should not break if URL&hellip;</a></td>
                                    <td>23/05/2012</td>
                                    <td class="tac"><span class="label label-important">High</span></td>
                                    <td>Open</td>
                                </tr>
                                <tr>
                                    <td>P-18</td>
                                    <td><a href="javascript:void(0)">Displaying submenus in custom&hellip;</a></td>
                                    <td>22/05/2012</td>
                                    <td class="tac"><span class="label label-warning">Medium</span></td>
                                    <td>Reopen</td>
                                </tr>
                                <tr>
                                    <td>P-25</td>
                                    <td><a href="javascript:void(0)">Featured image on post types&hellip;</a></td>
                                    <td>22/05/2012</td>
                                    <td class="tac"><span class="label label-success">Low</span></td>
                                    <td>Updated</td>
                                </tr>
                                <tr>
                                    <td>P-10</td>
                                    <td><a href="javascript:void(0)">Multiple feed fixes and&hellip;</a></td>
                                    <td>17/05/2012</td>
                                    <td class="tac"><span class="label label-warning">Medium</span></td>
                                    <td>Open</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0)" class="btn">Go to task manager</a>
                    </div>
                </div>
            </header>

            <!-- main content -->
            <div id="contentwrapper">
                <div class="main_content" style="margin-left: 0px !important; height:700px !important;">
                    <div class="row-fluid">
                        <div class="span12">
                            <ul class="dshb_icoNav tac">
                                <li><a href="javascript:void(0)" style="background-image: url(assets/img/gCons/multi-agents.png)"><span class="label label-info">+10</span> Users Register</a></li>
                                <li><a href="javascript:void(0)" style="background-image: url(assets/img/gCons/addressbook.png)">Contents Mgr</a></li>                                
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="heading clearfix">
                                <h3 class="pull-left">Latest Customer Register</h3>
                                <span class="pull-right label label-important">5 Orders</span>
                            </div>
                            <table class="table table-striped table-bordered mediaTable">
                                <thead>
                                    <tr>
                                        <th class="optional">id</th>
                                        <th class="essential persist">Customer</th>
                                        <th class="optional">Status</th>
                                        <th class="optional">Date Added</th>
                                        <th class="essential">Total</th>
                                        <th class="essential">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>134</td>
                                        <td>Summer Throssell</td>
                                        <td>Pending</td>
                                        <td>24/04/2012</td>
                                        <td>$120.23</td>
                                        <td>
                                            <a href="#" title="Edit"><i class="splashy-document_letter_edit"></i></a>
                                            <a href="#" title="Accept"><i class="splashy-document_letter_okay"></i></a>
                                            <a href="#" title="Remove"><i class="splashy-document_letter_remove"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>133</td>
                                        <td>Declan Pamphlett</td>
                                        <td>Pending</td>
                                        <td>23/04/2012</td>
                                        <td>$320.00</td>
                                        <td>
                                            <a href="#" title="Edit"><i class="splashy-document_letter_edit"></i></a>
                                            <a href="#" title="Accept"><i class="splashy-document_letter_okay"></i></a>
                                            <a href="#" title="Remove"><i class="splashy-document_letter_remove"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>132</td>
                                        <td>Erin Church</td>
                                        <td>Pending</td>
                                        <td>23/04/2012</td>
                                        <td>$44.00</td>
                                        <td>
                                            <a href="#" title="Edit"><i class="splashy-document_letter_edit"></i></a>
                                            <a href="#" title="Accept"><i class="splashy-document_letter_okay"></i></a>
                                            <a href="#" title="Remove"><i class="splashy-document_letter_remove"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>131</td>
                                        <td>Koby Auld</td>
                                        <td>Pending</td>
                                        <td>22/04/2012</td>
                                        <td>$180.20</td>
                                        <td>
                                            <a href="#" title="Edit"><i class="splashy-document_letter_edit"></i></a>
                                            <a href="#" title="Accept"><i class="splashy-document_letter_okay"></i></a>
                                            <a href="#" title="Remove"><i class="splashy-document_letter_remove"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>130</td>
                                        <td>Anthony Pound</td>
                                        <td>Pending</td>
                                        <td>20/04/2012</td>
                                        <td>$610.42</td>
                                        <td>
                                            <a href="#" title="Edit"><i class="splashy-document_letter_edit"></i></a>
                                            <a href="#" title="Accept"><i class="splashy-document_letter_okay"></i></a>
                                            <a href="#" title="Remove"><i class="splashy-document_letter_remove"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
                //* show all elements & remove preloader
                setTimeout('$("html").removeClass("js")', 1000);
            });
            </script>

        </div>
    </body>
</html>