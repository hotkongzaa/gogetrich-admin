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
        <div id="loading_layer" style="display:none">
            <img src="../assets/img/ajax_loader.gif" alt="" />
        </div>        
        <div id="maincontainer" class="clearfix">
            <!-- header -->
            <header>
                <?php include '../utils/leftHandMenu_f.php'; ?>                        
            </header>

            <!-- main content -->
            <div id="contentwrapper">
                <div class="main_content">
                    <nav>
                        <div id="jCrumbs" class="breadCrumb module">
                            <ul>
                                <li>
                                    <a href="../dashboard"><i class="icon-home"></i></a>
                                </li>
                                <li>
                                    <a href="#">Account management</a>
                                </li>
                                <li>
                                    <a href="#">User Access</a>
                                </li>
                                <li>
                                    <i class="icon icon-edit"></i> Registered User
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="heading clearfix">
                                <h3 class="pull-left">User Registered Management</h3>
                                <span class="pull-right btn">
                                    <i class="icon-plus"></i> Create User
                                </span>
                                <span class="pull-right btn">
                                    <i class="icon-search"></i> Search User
                                </span>
                            </div>
                            <div id="courseCateTbl"></div>
                        </div>                        
                    </div>
                </div>
            </div>
            <div class="modal hide fade" id="createCate">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">×</button>
                    <h3>Description Header Form</h3>
                </div>
                <div class="modal-body">                   
                    <div id="alertCate" class="alert alert-danger">Please enter description header name</div>
                    <form id="courseCateForm">
                        <div class="formSep">
                            <label>Description Header Name*</label>
                            <input type="text" name="headerName" id="headerName">
                            <input type="hidden" name="headerID" id="headerID">
                            <input type="hidden" name="headerDate" id="headerDate">
                        </div>                        
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" onclick="saveCate();">Save</a>
                </div>
            </div>

            <a href="javascript:void(0)" class="sidebar_switch on_switch ttip_r" title="Hide Sidebar">Sidebar switch</a>
            <div class="sidebar">
                <div class="antiscroll-inner">
                    <div class="antiscroll-content">

                        <div class="sidebar_inner">
                            <form class="input-append" method="post" >

                            </form>
                            <div id="side_accordion" class="accordion">

                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a  href="#collapseUser" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                            <i class="icon icon-edit"></i> Registered User
                                        </a>
                                    </div>
                                    <div class="accordion-body in collapse" id="collapseUser" style="height: auto">
                                        <div class="accordion-inner">
                                            <ul class="nav nav-list">
                                                <li class="nav-header">Course Enrollment</li>
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <i class="icon icon-globe"></i> Enroll to user
                                                    </a>
                                                </li>
                                                <li class="nav-header">Users</li>
                                                <li class="active">
                                                    <a href="main" >
                                                        <i class="icon icon-user"></i> User Registered
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a href="#collapseFour" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                            <i class="icon-cog"></i> Administration Configure
                                        </a>
                                    </div>
                                    <div class="accordion-body in collapse" id="collapseFour" style="height: auto">
                                        <div class="accordion-inner">
                                            <ul class="nav nav-list">
                                                <li class="nav-header">Group & Permission</li>
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <i class="icon icon-globe"></i> User Group Management
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <i class="icon icon-lock"></i> Permission Management
                                                    </a>
                                                </li>
                                                <li class="nav-header">Users</li>
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <i class="icon icon-user"></i> User Management
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="push"></div>
                        </div>


                    </div>
                </div>

            </div>
            <div id="createCusDialog" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">
                        User created form
                    </h3>
                </div>
                <div class="modal-body">
                    <div id="loadCreateForm"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <div id="updateCusDialog" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">
                        User updated form
                    </h3>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="alert alert-danger alert-dismissable" id="errorFormPart">
                            <span class="errorMsgForm"></span>                            
                        </div>
                        <form id="cus_update_form">
                            <fieldset>
                                <legend>ข้อมูลล็อกอิน</legend>

                                <div class="form-group">
                                    <label for="username">ชื่อผู้ใช้ (Username) *</label>
                                    <input type="text" name="username" id="username" placeholder="Username" class="form-control" disabled="disabled"/>
                                </div>

                                <div class="form-group">
                                    <label for="password">รหัสผ่าน (Password) * (กรุณาใส่อย่างน้อย 8 ตัวอักษร)</label> 
                                    <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                                    <label style="color: red">Leave blank if not change or <a href="javascript:void(0)">Reset password</a> to default</label>
                                </div>

                                <div class="form-group">
                                    <label for="confirmPassword">ยืนยันรหัสผ่าน (Confirm password) *</label>
                                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="email">อีเมล์ (Email) * กรุณาสมัครสมาชิกด้วย Email ที่ไม่ใช่ hotmail</label>
                                    <input type="email" id="email" name="email" placeholder="Email Address" class="form-control">
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>ข้อมูลส่วนตัว</legend>
                                <div class="form-group">
                                    <label for="fName">ชื่อ (First Name) *</label>
                                    <input type="text" id="fName" name="fName" placeholder="First Name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="lName">สกุล (Last Name) *</label>
                                    <input type="text" id="lName" name="lName" placeholder="Last Name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="gender">เพศ (Gender)</label>
                                    <select id="gender" name="gender">
                                        <option value="0"></option>
                                        <option value="Male">ชาย</option>
                                        <option value="Female">หญิง</option>
                                        <option value="Other">ไม่ระบุ</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="address">ที่อยู่ (เพื่อการติดต่อ) (Contact address) *</label>
                                    <textarea id="contactAddress" name="contactAddress" style="height: 150px;"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="address">ที่อยู่ (เพื่อออกใบเสร็จ) (Receipt address)</label>
                                    <textarea id="receiptAddress" name="receiptAddress" style="height: 150px;"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="phone">หมายเลขโทรศัพท์ เพื่อการติดต่อ (Phone number) *</label>
                                    <input type="text" id="phone" name="phone" placeholder="Phone number" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="facebookAdr">Facebook address</label>
                                    <input type="text" id="facebookAdr" name="facebookAdr" placeholder="Facebook Address" class="form-control">
                                </div>
                                <div class="control-group">
                                    <label for="forceChange">
                                        <input type="checkbox" name="forceChange" id="forceChange" value="true"/> Force Change password
                                    </label>
                                </div>
                            </fieldset>                 
                            <input type="hidden" id="cusId" name="cusId"/>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn btn-primary" id="saveChange">Save changes</button>
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
            <script src="../assets/js/gebo_common_f.js"></script>

            <!-- colorbox -->
            <script src="../assets/lib/colorbox/jquery.colorbox.min.js"></script>
            <!-- datatable -->
            <!-- additional sorting for datatables -->
            <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
            <script src="../assets/lib/datatables/jquery.dataTables.sorting.js"></script>         


            <script type="text/javascript">
                        $(document).ready(function () {
                            $("#errorFormPart").hide();
                            $("#alertCate").hide();

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

                            $("#courseCateTbl").load("cusRegisteredTbl.php", function () {
                                $("html").removeClass("js");
                            });
                            $("#saveChange").click(function () {
                                var formEle = $("#cus_update_form").serialize();
                                $.ajax({
                                    url: "../../model/com.gogetrich.function/updateCusRegisteredDetail.php?" + formEle,
                                    type: 'POST',
                                    beforeSend: function (xhr) {
                                        $(".errorMsgForm").empty();
                                    },
                                    success: function (data, textStatus, jqXHR) {
                                        
                                    }
                                });
                            });
                        });
                        function loadUserForm(cusId) {
                            $.ajax({
                                url: "../../model/com.gogetrich.function/getCusRegisteredDetail.php?cusId=" + cusId,
                                type: 'POST',
                                beforeSend: function (xhr) {
                                    $("html").addClass("js");
                                },
                                success: function (data, textStatus, jqXHR) {
                                    $("html").removeClass("js");
                                    var jsonObj = $.parseJSON(data);
                                    $("#username").val(jsonObj['CUS_USERNAME']);
                                    $("#email").val(jsonObj['CUS_EMAIL']);
                                    $("#fName").val(jsonObj['CUS_FIRST_NAME']);
                                    $("#lName").val(jsonObj['CUS_LAST_NAME']);
                                    $("#gender").val(jsonObj['CUS_GENDER']);
                                    $("#contactAddress").val(jsonObj['CUS_CONTACT_ADDRESS']);
                                    $("#receiptAddress").val(jsonObj['CUS_RECEIPT_ADDRESS']);
                                    $("#phone").val(jsonObj['CUS_PHONE_NUMBER']);
                                    $("#facebookAdr").val(jsonObj['CUS_FACEBOOK_ADDRESS']);
                                    $("#updateCusDialog").modal("show");
                                    $("#cusId").val(jsonObj['CUS_ID']);
                                }
                            });
                        }
            </script>            
        </div>
    </body>
</html>