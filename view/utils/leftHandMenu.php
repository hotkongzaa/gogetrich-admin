<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="brand" href="dashboard">
                <!--<img src="http://gogetrich.net/view/assets/images/logo.png" width="120"/>-->
            </a>
            <ul class="nav user_menu pull-right">                             

                <li class="divider-vertical hidden-phone hidden-tablet"></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?= $jsonValue['USERNAME']; ?> <b class="caret"></b>
                    </a>
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
                                <i class="icon-user icon-white"></i> Account Manager <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="dashboard">
                                        <i class="icon icon-book"></i> User Enrollment
                                    </a>
                                </li>
                                <li class="dropdown sub-dropdown">
                                    <a href="cusRegistered/main">
                                        <i class="icon icon-user"></i> Users Access 
                                    </a>
                                    <!--                                    <ul class="dropdown-menu sub-menu">
                                                                            <li>
                                                                                <a href="cusRegistered/main">
                                                                                    <i class="icon icon-edit"></i> Registered Users
                                                                                </a>
                                                                            </li>
                                                                            <li class="divider">
                                                                            </li>
                                                                            <li>
                                                                                <a href="#"> 
                                                                                    <i class="icon icon-globe"></i> User Group Management
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#"> 
                                                                                    <i class="icon icon-lock"></i> Permission Management
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#"> 
                                                                                    <i class="icon icon-user"></i> User Management
                                                                                </a>
                                                                            </li>
                                                                        </ul>-->
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
                                        <li><a href="courseCategories/courseCategories">Course Categories</a></li>
                                        <li><a href="descriptionHeader/descriptionHeader">Course Description Header</a></li>   
                                        <li><a href="courseDetails/courseDetail">Course Detail</a></li>                                                       
                                    </ul>
                                </li>
                                <!--                                <li class="dropdown">
                                                                    <a href="#"><i class="icon-bullhorn"></i> Learn to rich <b class="caret-right"></b></a>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a href="#">Content Categories</a></li>
                                                                        <li><a href="#">Content Detail</a></li>                                                       
                                                                    </ul>
                                                                </li>-->
                                <li class="dropdown">
                                    <a href="#">
                                        <i class="icon-book"></i> Blog management <b class="caret-right"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="blog/blogDetailCategory">Blog Category</a></li>
                                        <li><a href="blog/blogDetail">Blog Detail</a></li>                                                       
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