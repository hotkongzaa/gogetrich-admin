<?php
session_start();
if (empty($_SESSION['username'])) {
    echo '<script type="text/javascript">window.location.href="../../index.php";</script>';
} else {
    $now = time();
    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo '<script type="text/javascript">var r=confirm("Session expire (30 mins)!"); if(r==true){window.location.href="../../index.php";}else{window.location.href="../../index.php";}</script>';
    } else {
        require '../../model-db-connection/config.php';
        //Manage course header
        $sqlGetHeaderToShow = "SELECT * FROM GTRICH_COURSE_HEADER WHERE HEADER_ID = '" . $_GET['hId'] . "'";
        $resHeader = mysql_query($sqlGetHeaderToShow);
        $rowHeader = mysql_fetch_array($resHeader);
        if ($rowHeader['HEADER_NAME'] == "") {
            $notFound = "Cannot found course, Please contact administrator";
        }
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
        <link rel="stylesheet" href="../assets/css/jquery-ui.css" />

        <!-- wizard -->
        <link rel="stylesheet" href="../assets/lib/stepy/css/jquery.stepy.css" />
        <!-- Favicon -->
        <link rel="shortcut icon" href="favicon.ico" />

        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/ie.css" />
            <script src="js/ie/html5.js"></script>
                        <script src="js/ie/respond.min.js"></script>
                        <script src="lib/flot/excanvas.min.js"></script>
        <![endif]-->

        <script type="text/javascript">
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
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $_SESSION['username']; ?> <b class="caret"></b></a>
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
                                                        <li><a href="../courseCategories/courseCategories">Course Categories</a></li>
                                                        <li><a href="../descriptionHeader/descriptionHeader">Course Description Header</a></li>   
                                                        <li><a href="courseDetail">Course Detail</a></li>                                                       
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
                <div class="modal hide fade" id="descHeaderModal">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">×</button>
                        <h3>Create Description Header</h3>
                    </div>
                    <div class="modal-body">
                        <form id="descHeaderForm">
                            <fieldset title="Course Detail Header">
                                <legend class="hide">Create course header&hellip;</legend>
                                <div class="control-group">
                                    <label class="control-label">Header Name*</label>
                                    <div class="controls">
                                        <input type="text" name="descHeaderName" id="descHeaderName" />
                                    </div>
                                </div>                                
                            </fieldset>                                                         
                            <button type="button" onclick="saveDescHeader()" class="finish btn btn-primary"><i class="icon-ok icon-white"></i> Save</button>
                        </form>
                    </div>
                </div>
                <div class="modal hide fade" id="mapUsingDialog">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">×</button>
                        <h3>Google Map Preview</h3>
                    </div>
                    <div class="modal-body">
                        <div class="well">
                            <div id="g_map" style="width:100%;height:400px"></div>
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
                                    <a href="#">Schedule</a>
                                </li>
                                <li>
                                    <a href="courseDetail">Course Detail</a>
                                </li>
                                <li>
                                    Course Update
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="row-fluid">
                        <div class="span12">
                            <div>
                                <a href="courseDetail"><i class="splashy-arrow_state_blue_left"></i> Back</a>
                            </div>
                            <div id="notificationHeader"></div>
                            <br/>
                            <form id="courseDetailForm" class="stepy-wizzard form-horizontal">
                                <fieldset title="Course Detail Header">
                                    <legend class="hide">Create course header&hellip;</legend>
                                    <div class="control-group">
                                        <label class="control-label">Course Categories*</label>
                                        <div class="controls">
                                            <select id="courseCate" name="courseCate" class="span10">
                                                <option value="">== Please select category ==</option>
                                                <?php
                                                $sqlGetCate = "SELECT * "
                                                        . "FROM GTRICH_COURSE_CATEGORY";
                                                $res = mysql_query($sqlGetCate);
                                                while ($row = mysql_fetch_array($res)) {
                                                    ?>
                                                    <option value="<?= $row['CATE_ID'] ?>"><?= $row['CATE_NAME'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Course Name*</label>
                                        <div class="controls">
                                            <input type="text" name="courseName" id="courseName" class="span10"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Course Event Date</label>
                                        <div class="controls">
                                            <div id="chooseDate"></div><br/>
                                            <input type="hidden" name="courseEventDate" id="courseEventDate" class="span10"/>
                                        </div>
                                    </div>
                                    <!--                                    <div class="control-group">
                                                                            <label class="control-label">Course Detail</label>
                                                                            <div class="controls">
                                                                                <textarea name="courseDetail" id="courseDetail" class="span10"></textarea>
                                                                            </div>
                                                                        </div>-->
                                    <div class="control-group">
                                        <label for="descHeaderID" class="control-label">Course Status:</label>
                                        <div class="controls">
                                            <select id="courseStatus" name="courseStatus" class="span9">
                                                <option value="">== Select Course Status ===</option>
                                                <option value="0">Publish</option>
                                                <option value="1">Not Publish</option>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset title="Course Detail">
                                    <legend class="hide">Course Detail&hellip;</legend>
                                    <div id="notificationDetail"></div>
                                    <div class="control-group">
                                        <label for="descHeaderID" class="control-label">Description Header*:</label>
                                        <div class="controls">
                                            <select id="descHeaderID" name="descHeaderID" class="span9">
                                                <option value="">== Please select description header == </option>
                                                <?php
                                                $sqlGetCate = "SELECT * "
                                                        . "FROM GTRICH_DESCRIPTION_HEADER";
                                                $res = mysql_query($sqlGetCate);
                                                while ($row = mysql_fetch_array($res)) {
                                                    ?>
                                                    <option value="<?= $row['DESC_HEADER_ID'] ?>"><?= $row['DESC_HEADER_NAME'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select><span style="margin-left: 10px;cursor: pointer;" onclick="addingDescHeader()"><i class="splashy-application_windows_add"></i></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="detailOrder" class="control-label">Detail order*:</label>
                                        <div class="controls">
                                            <input type="text" name="detailOrder" id="detailOrder"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <label><input type="checkbox" id="useMap" value="map"/> Using Google Map API <i class="splashy-map"></i></label><br/>
                                            <div class="control-group" id="hideMap">
                                                <label for="lat" class="control-label">Latitude*:</label>
                                                <div class="controls">
                                                    <input type="text" id="lat" name="lat"/>
                                                </div><br/>
                                                <label for="lng" class="control-label">Longitude*:</label>
                                                <div class="controls">
                                                    <input type="text" id="lng" name="lng"/>
                                                </div><br/>
                                                <!--div class="controls">
                                                    <input type="button" id="previewMap" class="btn" value="Preview map"/>
                                                </div-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group" id="ifChooseMap">
                                        <label for="descHeaderID" class="control-label">Course Detail*:</label>
                                        <div class="controls">
                                            <textarea name="descriptionDetail" id="descriptionDetail" class="span9"></textarea>
                                        </div>
                                    </div>                                    
                                    <div class="control-group" id="ifChooseMap">
                                        <label for="saveToTmpBtn" class="control-label"></label>
                                        <div class="controls">
                                            <button type="button" onclick="clearHeaderDetailField()" id="saveToTmpBtn" class="btn btn-primary pull-left">
                                                <i class="icon-refresh icon-white"></i> Reset
                                            </button>&nbsp;
                                            <button type="button" onclick="saveCourseToTmp()" style="margin-left: 10px;" id="saveToTmpBtn" class="btn btn-primary pull-left">
                                                <i class="icon-bullhorn icon-white"></i> Save Description
                                            </button>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div id="tempCourseTbl" style="margin-top: 50px;"></div>
                                    </div>
                                    <button type="button" class="finish btn btn-primary" onclick="submitUpdateCourseProcess()">
                                        <i class="icon-ok icon-white"></i> Submit Course
                                    </button>
                                </fieldset>                                

                            </form>
                        </div>                    
                    </div>
                </div>
            </div>            

            <input type="hidden" id="tempCourseDetailID"/>
            <input type="hidden" id="courseHeaderID"/>
            <script src="../assets/js/jquery.min.js"></script>
            <script src="../assets/js/jquery-ui-1.11.1.js"></script>
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
            <script src="../assets/js/jquery-validation/jquery.validate.js"></script>
            <script src="../assets/js/jquery-ui.multidatespicker.js"></script>
            <script src="../assets/ckeditor/ckeditor.js"></script>
            <!-- wizard -->
            <script src="../assets/lib/stepy/js/jquery.stepy.min.js"></script>

            <!-- wizard functions -->
            <script src="../assets/js/gebo_wizard.js"></script>
            <style type="text/css">
                /* begin: jQuery UI Datepicker moving pixels fix */
                table.ui-datepicker-calendar {border-collapse: separate;}
                .ui-datepicker-calendar td {border: 1px solid transparent;}
                /* end: jQuery UI Datepicker moving pixels fix */
                /* begin: jQuery UI Datepicker emphasis on selected dates */
                .ui-datepicker .ui-datepicker-calendar .ui-state-highlight a {
                    background: #743620 none; /* a color that fits the widget theme */
                    color: white; /* a color that is readeable with the color above */
                }
                /* end: jQuery UI Datepicker emphasis on selected dates */
            </style>
            <script type="text/javascript">
                                        var saveCourseTempState = "Save";
                                        $(document).ready(function () {
                                            $("#hideMap").hide();
                                            //Inital Page Element
                                            course_page.initialElement();
                                            $("#useMap").click(function () {
                                                if ($("#useMap").is(':checked')) {
                                                    $("#hideMap").show(); // checked
                                                    $("#ifChooseMap").hide();
                                                    $("#lat").val("");
                                                    $("#lng").val("");
                                                } else {
                                                    $("#hideMap").hide();
                                                    $("#ifChooseMap").show();
                                                    CKEDITOR.instances.descriptionDetail.setData('');
                                                }
                                            });
                                            $("#previewMap").click(function () {
                                                var lat = $("#lat").val();
                                                var lng = $("#lng").val();
                                                $("#mapUsingDialog").modal("show");
                                            });
<?php
if (!empty($notFound)) {
    ?>
                                                $("#notificationHeader").html('<div class="alert alert-error">' +
                                                        '<a class="close" data-dismiss="alert">×</a>' +
                                                        '<strong>Course not found !</strong> Cannot found this course</div>');
                                                $("#courseCate, #courseName, #courseStatus, #courseDetailForm-next-0").prop("disabled", "true");
    <?php
}
?>

                                            $("#courseCate").val('<?= $rowHeader['REF_CATE_ID'] ?>');
                                            $("#courseName").val('<?= $rowHeader['HEADER_NAME'] ?>');
                                            $("#courseStatus").val('<?= $rowHeader['HEADER_COURSE_STATUS'] ?>');
                                            $("#courseHeaderID").val('<?= $rowHeader['HEADER_ID'] ?>');
                                            var date = '<?= $rowHeader['HEADER_EVENT_DATE'] ?>'.split(",");
                                            var resultDate = new Array();
                                            for (var i = 0; i < date.length; i++) {
                                                resultDate.push(date[i].trim());
                                            }
                                            $("#chooseDate").multiDatesPicker({
                                                addDates: resultDate
                                            });
                                            $('#chooseDate').multiDatesPicker('removeIndexes', 0);

                                        });
                                        course_page = {
                                            initialElement: function () {
                                                $("html").removeClass("js");
                                                $("#chooseDate").multiDatesPicker({
                                                    altField: '#courseEventDate',
                                                    numberOfMonths: [1, 4]
                                                });
                                                CKEDITOR.replace('descriptionDetail');
                                                $("#tempCourseTbl").load("tmpCourseTable.php");
                                            }
                                        };
                                        function addingDescHeader() {
                                            $("#descHeaderModal").modal("show");
                                        }
                                        function saveDescHeader() {
                                            var formEle = $("#descHeaderForm").serialize();
                                            $.ajax({
                                                url: "../../model/com.gogetrich.function/SaveDescHeader.php?" + formEle,
                                                type: 'POST',
                                                success: function (data, textStatus, jqXHR) {
                                                    if (data == 200) {
                                                        $.ajax({
                                                            url: "../../model/com.gogetrich.function/GetLastestDescHeader.php",
                                                            type: 'POST',
                                                            beforeSend: function (xhr) {
                                                                $("html").addClass("js");
                                                            },
                                                            success: function (data, textStatus, jqXHR) {
                                                                var json = $.parseJSON(data);
                                                                $("#descHeaderID").append($('<option>', {
                                                                    value: json.DESC_HEADER_ID,
                                                                    text: json.DESC_HEADER_NAME
                                                                }));
                                                                $("html").removeClass("js");
                                                            }
                                                        });
                                                    } else {
                                                        alert(data);
                                                    }
                                                    $("#descHeaderForm").trigger("reset");
                                                    $("#descHeaderModal").modal("hide");
                                                }
                                            });
                                        }
                                        function saveCourseToTmp() {
                                            var descHeaderId = $("#descHeaderID").val();
                                            var lat = $("#lat").val();
                                            var lng = $("#lng").val();
                                            var courseDetail = CKEDITOR.instances.descriptionDetail.getData();
                                            var detailOrder = $("#detailOrder").val();
//                                        var courseDetail = $("#descriptionDetail").val();
                                            if (descHeaderId == "") {
                                                alert("Please select Description Header");
                                            } else if ($("#useMap").is(':checked')) {
                                                if (lat == "") {
                                                    alert("Please enter Latitude of your location");
                                                } else if (lng == "") {
                                                    alert("Please enter Longitude of your location");
                                                } else {
                                                    processTempTransaction(descHeaderId, lat, lng, courseDetail, detailOrder);
                                                }
                                            } else {
                                                processTempTransaction(descHeaderId, lat, lng, courseDetail, detailOrder);
                                            }
                                        }
                                        function processTempTransaction(descHeaderId, lat, lng, courseDetail, detailOrder) {
                                            if (saveCourseTempState == "Save") {
                                                $.ajax({
                                                    url: "../../model/com.gogetrich.function/SaveCourseToTemp.php",
                                                    type: 'POST',
                                                    data: {'detailOrder': detailOrder, 'descHeaderId': descHeaderId, 'lat': lat, 'lng': lng, 'courseDetail': courseDetail},
                                                    beforeSend: function (xhr) {
                                                        $("html").addClass("js");
                                                    },
                                                    success: function (data, textStatus, jqXHR) {
                                                        if (data == 200) {
                                                            $("#notificationDetail").html('<div class="alert alert-success">' +
                                                                    '<a class="close" data-dismiss="alert">×</a>' +
                                                                    '<strong>Save course success !</strong> All course detail have been saved but you have to submit course to complete process</div>');
                                                            clearHeaderDetailField();
                                                            $("#tempCourseTbl").load("tmpCourseTable.php", function () {
                                                                $("html").removeClass("js");
                                                            });
                                                            setTimeout(function () {
                                                                $("#notificationDetail").empty();
                                                            }, 5000);
                                                        } else {
                                                            $("#notificationDetail").html('<div class="alert alert-error">' +
                                                                    '<a class="close" data-dismiss="alert">×</a>' +
                                                                    '<strong>Cannot save course !</strong> ' + data + '</div>');
                                                        }
                                                    }
                                                });
                                                saveCourseTempState = "Save";
                                            } else {
                                                var tempDetailID = $("#tempCourseDetailID").val();
                                                $.ajax({
                                                    url: "../../model/com.gogetrich.function/UpdateCourseInTemp.php",
                                                    type: 'POST',
                                                    data: {'detailOrder': detailOrder, 'descHeaderId': descHeaderId, 'lat': lat, 'lng': lng, 'courseDetail': courseDetail, 'tempDetailID': tempDetailID},
                                                    beforeSend: function (xhr) {
                                                        $("html").addClass("js");
                                                    },
                                                    success: function (data, textStatus, jqXHR) {
                                                        if (data == 200) {
                                                            $("#notificationDetail").html('<div class="alert alert-success">' +
                                                                    '<a class="close" data-dismiss="alert">×</a>' +
                                                                    '<strong>Update course success !</strong> All course detail have been updated but you have to submit course to complete process</div>');
                                                            clearHeaderDetailField();
                                                            $("#tempCourseTbl").load("tmpCourseTable.php", function () {
                                                                $("html").removeClass("js");
                                                            });
                                                            setTimeout(function () {
                                                                $("#notificationDetail").empty();
                                                            }, 5000);
                                                        } else {
                                                            $("#notificationDetail").html('<div class="alert alert-error">' +
                                                                    '<a class="close" data-dismiss="alert">×</a>' +
                                                                    '<strong>Cannot save course !</strong> ' + data + '</div>');
                                                        }
                                                    }
                                                });
                                                saveCourseTempState = "Save";
                                            }
                                        }
                                        function clearHeaderDetailField() {
                                            $("#descHeaderID").val("");
                                            $("#lat").val("");
                                            $("#lng").val("");
                                            CKEDITOR.instances.descriptionDetail.setData('');
                                            $('#useMap').attr('checked', false);
                                            $("#hideMap").hide();
                                            $("#ifChooseMap").show();
                                            $("#detailOrder").val("");
                                            saveCourseTempState = "Save";
                                        }
                                        function deleteCourseTmp(tmpCourseID) {
                                            var r = confirm("Do you want to delete this permanently !");
                                            if (r == true) {
                                                $.ajax({
                                                    url: "../../model/com.gogetrich.function/deleteCourseTmpByID.php?tmpCourseID=" + tmpCourseID,
                                                    type: 'POST',
                                                    beforeSend: function (xhr) {
                                                        $("html").addClass("js");
                                                    },
                                                    success: function (data, textStatus, jqXHR) {
                                                        if (data == 200) {
                                                            $("#notificationDetail").html('<div class="alert alert-success">' +
                                                                    '<a class="close" data-dismiss="alert">×</a>' +
                                                                    '<strong>Delete course success !</strong> Delete course detail complete</div>');
                                                            setTimeout(function () {
                                                                $("#notificationDetail").empty();
                                                            }, 5000);
                                                            $("#tempCourseTbl").load("tmpCourseTable.php", function () {
                                                                $("html").removeClass("js");
                                                            });
                                                        } else {
                                                            $("#notificationDetail").html('<div class="alert alert-error">' +
                                                                    '<a class="close" data-dismiss="alert">×</a>' +
                                                                    '<strong>Cannot save course !</strong> ' + data + '</div>');
                                                            setTimeout(function () {
                                                                $("#notificationDetail").empty();
                                                            }, 5000);
                                                            $("html").removeClass("js");
                                                        }
                                                    }
                                                });
                                            }

                                        }
                                        function submitUpdateCourseProcess() {
                                            var courseCategory = $("#courseCate").val();
                                            var courseName = $("#courseName").val();
                                            var courseEventDate = $("#courseEventDate").val();
                                            var courseStatus = $("#courseStatus").val();
                                            var headerID = $("#courseHeaderID").val();
                                            var detailOrder = $("#detailOrder").val();
                                            if (courseEventDate == "") {
                                                alert("Please select Course Event Date");
                                            } else {
                                                $.ajax({
                                                    url: "../../model/com.gogetrich.function/checkCourseDetailCreated.php",
                                                    type: 'POST',
                                                    beforeSend: function (xhr) {
                                                        $("html").addClass("js");
                                                    },
                                                    success: function (data, textStatus, jqXHR) {
                                                        if (data == 200) {
                                                            $.ajax({
                                                                url: "../../model/com.gogetrich.function/updateDetailHeaderAndDetail.php",
                                                                type: 'POST',
                                                                data: {'detailOrder': detailOrder, 'headerID': headerID, 'courseCategory': courseCategory, 'courseName': courseName, 'courseEventDate': courseEventDate, 'courseStatus': courseStatus},
                                                                success: function (saveHeaderData, textStatus, jqXHR) {
                                                                    if (saveHeaderData == 200) {
                                                                        alert("Update course success");
                                                                        window.location.href = "courseDetail";
                                                                    } else {
                                                                        $("#notificationDetail").html('<div class="alert alert-error">' +
                                                                                '<a class="close" data-dismiss="alert">×</a>' +
                                                                                '<strong>Cannot update course !</strong> ' + saveHeaderData + '</div>');
                                                                        setTimeout(function () {
                                                                            $("#notificationDetail").empty();
                                                                        }, 5000);
                                                                    }
                                                                }
                                                            });
                                                        } else {
                                                            $("#notificationDetail").html('<div class="alert alert-error">' +
                                                                    '<a class="close" data-dismiss="alert">×</a>' +
                                                                    '<strong>Cannot update course !</strong> ' + data + '</div>');
                                                            setTimeout(function () {
                                                                $("#notificationDetail").empty();
                                                            }, 5000);
                                                        }
                                                        $("html").removeClass("js");
                                                    }
                                                });
                                            }
                                        }
                                        function getCourseTmpForEdit(courseTmpID) {
                                            saveCourseTempState = "Edit";
                                            $.ajax({
                                                url: "../../model/com.gogetrich.function/getCourseTempByID.php?courseTmpID=" + courseTmpID,
                                                type: 'POST',
                                                beforeSend: function (xhr) {
                                                    $("html").addClass("js");
                                                },
                                                success: function (data, textStatus, jqXHR) {
                                                    $("html").removeClass("js");
                                                    var json = $.parseJSON(data);
                                                    $("#descHeaderID").val(json.REF_COURSE_HEADER_ID);
                                                    if (json.DETAIL_LAT != "") {
                                                        $('#useMap').attr('checked', true);
                                                        $("#hideMap").show();
                                                        $("#ifChooseMap").hide();
                                                        $("#lat").val(json.DETAIL_LAT);
                                                        $("#lng").val(json.DETAIL_LNG);
                                                    } else {
                                                        $('#useMap').attr('checked', false);
                                                        $("#hideMap").hide();
                                                        $("#ifChooseMap").show();
                                                    }
                                                    CKEDITOR.instances.descriptionDetail.setData(json.DETAIL_DESCRIPTION);
                                                    $("#tempCourseDetailID").val(json.DETAIL_ID);
                                                    $("#detailOrder").val(json.DETAIL_ORDER);
                                                }
                                            });
                                        }
            </script>

        </div>
    </body>
</html>