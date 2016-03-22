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
$type = (string) filter_input(INPUT_GET, 'Create');
$bId = (string) filter_input(INPUT_GET, 'bId');
$fPage = (string) filter_input(INPUT_GET, 'fPage');
//Update case
if (!empty($type) && $type == "Edit") {
    
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
                <div class="main_content" style="margin-left: 0px !important;">
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
                                    Blog Detail
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="row-fluid">
                        <div class="span12">
                            <div>
                                <a href="<?= $fPage ?>">
                                    <i class="splashy-arrow_state_blue_left"></i> Back
                                </a>
                            </div>
                            <div class="heading clearfix">
                                <h3 class="pull-left">Create/Update Blog Form</h3>
                            </div>
                            <div>
                                <fieldset>
                                    <div class="control-group">
                                        <label class="control-label">Blog Categories*</label>
                                        <div class="controls">
                                            <select id="blogCate" name="blogCate" class="span6" required>
                                                <option value="">-- Please select blog category --</option>
                                                <?php
                                                $sqlGetBcate = "SELECT * FROM GTRICH_BLOG_CATEGORY";
                                                $resGetBcare = mysql_query($sqlGetBcate);
                                                while ($rowBcate = mysql_fetch_array($resGetBcare)) {
                                                    ?>
                                                    <option value="<?= $rowBcate['B_CATE_ID'] ?>"><?= $rowBcate['B_CATE_NAME'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Blog Title*</label>
                                        <div class="controls">
                                            <input type="text" name="cateName" id="blogTitle" class="span6" placeholder="blogTitle" required/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Allow user comment*</label>
                                        <div class="controls">
                                            <select id="blogCate" name="blogCate" class="span6" required>
                                                <option value="false">Now Allow</option>
                                                <option value="true">Allow</option>                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Blog Status*</label>
                                        <div class="controls">
                                            <select id="blogPublish" name="blogPublish" class="span6" required>
                                                <option value="">== Select blog status ==</option>
                                                <option value="Publish">Publish</option>
                                                <option value="Not Publish">Not Publish</option>                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group" style="border: #000 solid 1px; padding: 10px;">
                                        <label class="control-label">Image Blog Type*</label>
                                        <select id="imageBlogType" name="imageBlogType" class="span6" required>
                                            <option value="">== Select Image type ==</option>
                                            <option value="Cover Image">Cover Image</option>
                                            <option value="Blog Image">Blog Image</option>                                                
                                        </select>
                                        <form role="form" id="blogImageForm" enctype="multipart/form-data"> 
                                            <div class="well well-sm">
                                                <input type="file" id="blogImage" name="blogImage">
                                            </div>
                                        </form>
                                        <div id="show_image_tbl"></div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Blog Detail*</label>
                                        <div class="controls">
                                            <textarea type="text" name="cateName" id="blogDetail" class="span6" placeholder="Blog Detail" ></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <input type="button" class="btn btn-gebo" value="Save Blog"> 
                                        <input type="button" onclick="cancelBlog()" class="btn btn-danger" value="Cancel Blog">
                                    </div>
                                </fieldset>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
            <style>
                label.error{
                    color: red !important;
                }
            </style>

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
            <script src="../assets/lib/validation/jquery.validate.js"></script>     
            <script src="../assets/ckeditor/ckeditor.js"></script>

            <script type="text/javascript">
                                            $(document).ready(function () {
                                                //Initial Element in page
                                                auBlogPage.initialElement();

                                                $("#blogImage").change(function () {
                                                    var file = this.files[0];
                                                    var imagefile = file.type;
                                                    var fileSize = (file.size / 1024 / 1024); //image size in kb

                                                    var match = ["image/jpeg", "image/png", "image/jpg"];
                                                    if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                                                        alert("Please Select A valid Image File\n Only jpeg, jpg and png Images type allowed");
                                                        return false;
                                                    } else if (fileSize > 2) {
                                                        // the image file size must not over than 2 mb
                                                        alert("Please select a valid Image File\nOnly less than 2 mb of image are allowed");
                                                    } else {
                                                        var reader = new FileReader();
                                                        reader.onload = imageIsLoaded;
                                                        reader.readAsDataURL(this.files[0]);
                                                    }
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
                                            auBlogPage = {
                                                initialElement: function () {
                                                    $("html").removeClass("js");
                                                    $editor = CKEDITOR;
                                                    $editorConfig = CKEDITOR.config;
                                                    $editor.replace('blogDetail');

                                                    //Load image table
                                                    $.ajax({
                                                        url: "imageUploadTable.php",
                                                        type: 'POST',
                                                        beforeSend: function (xhr) {
                                                            $("html").addClass("js");
                                                        }, success: function (data, textStatus, jqXHR) {
                                                            $("#show_image_tbl").html(data);
                                                            $("html").removeClass("js");
                                                        }
                                                    });
                                                }
                                            };
                                            function cancelBlog() {
                                                window.location.href = "<?= $fPage ?>";
                                            }
                                            function imageIsLoaded(e) {
                                                $("#previewImageUploadDialog").modal("show");
                                                $("#previewImageUpload").html("<img src='" + e.target.result + "' width='500px'/>");
                                            }
                                            function saveBlogImageToTmp() {
                                                var imageBlogType = $("#imageBlogType").val();
                                                if (imageBlogType == "") {
                                                    alert("Please select image blog type");
                                                } else {
                                                    $("#previewImageUploadDialog").modal("hide");
                                                    setTimeout(function () {
                                                        var formData = new FormData();
                                                        //Append files infos
                                                        jQuery.each($("#blogImage")[0].files, function (i, file) {
                                                            formData.append('blogImage', file);
                                                        });
                                                        $.ajax({
                                                            url: "../../model/com.gogetrich.function/uploadBlogImage.php?imageType=" + imageBlogType,
                                                            type: 'POST',
                                                            xhr: function () {  // Custom XMLHttpRequest
                                                                var myXhr = $.ajaxSettings.xhr();
                                                                if (myXhr.upload) { // Check if upload property exists
                                                                    myXhr.upload.addEventListener('progress', function (e) {
                                                                        if (e.lengthComputable) {

                                                                        }
                                                                    }, false); // For handling the progress of the upload
                                                                }
                                                                return myXhr;
                                                            },
                                                            beforeSend: function (e) {
                                                                $("html").addClass("js");
                                                            },
                                                            success: function (e) {
                                                                $.ajax({
                                                                    url: "imageUploadTable.php",
                                                                    type: 'POST',
                                                                    beforeSend: function (xhr) {

                                                                    }, success: function (data, textStatus, jqXHR) {
                                                                        $("#show_image_tbl").html(data);
                                                                        $("html").removeClass("js");
                                                                    }
                                                                });
                                                                $("#productImage").val("");
                                                            },
                                                            data: formData,
                                                            cache: false,
                                                            contentType: false,
                                                            processData: false
                                                        });
                                                    }, 100);
                                                }
                                            }
                                            function deleteBlogImageInTmp(imageId) {
                                                var r = confirm("Do you want to delete this item?");
                                                if (r == true) {
                                                    $.ajax({
                                                        url: "../../model/com.gogetrich.function/deleteImageBlogInTmp.php?imageId=" + imageId,
                                                        type: 'POST',
                                                        beforeSend: function (xhr) {
                                                            $("html").addClass("js");
                                                        }, success: function (data, textStatus, jqXHR) {
                                                            $.ajax({
                                                                url: "imageUploadTable.php",
                                                                type: 'POST',
                                                                beforeSend: function (xhr) {
                                                                    $("html").addClass("js");
                                                                }, success: function (data, textStatus, jqXHR) {
                                                                    $("#show_image_tbl").html(data);
                                                                    $("html").removeClass("js");
                                                                }
                                                            });
                                                            $("html").removeClass("js");

                                                        }
                                                    });
                                                }
                                            }
            </script>
        </div>
        <div class="modal hide" id="previewImageUploadDialog">
            <div class="modal-header">
                <button class="close" data-dismiss="modal" id="closeNoti">×</button>
                <h3>Images preview</h3>
            </div>
            <div class="modal-body">
                <div class="alert alert-block alert-info fade in">
                    <p id="previewImageUpload" style="max-height: 300px; overflow: auto;">

                    </p>
                </div>
                <input type="button" onclick="saveBlogImageToTmp()" class="btn btn-gebo" value="Save"> 
                <input type="button" onclick="$('#previewImageUploadDialog').modal('hide');
                        $('#blogImage').val('')" class="btn btn-danger" value="Cancel">
            </div>
        </div>
    </body>
</html>