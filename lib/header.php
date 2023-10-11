<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <!-- <meta name="viewport" content="width=device-width,initial-scale=1"> -->
        <meta name="description" content="<?php echo $cfg_about; ?>">
        <meta name="author" content="Yohannes Petrick Sianturi">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2"/>
        <meta name="keywords" content="<?php echo $cfg_webname; ?>, Berita, Terpopuler, Terbaru, Viral, Marketing, Digital, Platform, News, Indonesia">

        <link rel="shortcut icon" href="<?php echo $cfg_baseurl; ?>assets/images/honda.png">

        <title><?php echo $cfg_webname; ?></title>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="<?php echo $cfg_baseurl; ?>assets/morris/morris.css">
        <link href="<?php echo $cfg_baseurl; ?>plugins/switchery/switchery.min.css" rel="stylesheet" />
        <link href="<?php echo $cfg_baseurl; ?>plugins/jquery-circliful/css/jquery.circliful.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo $cfg_baseurl; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $cfg_baseurl; ?>assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $cfg_baseurl; ?>assets/css/style.css" rel="stylesheet" type="text/css">
        
        <link href="<?php echo $cfg_baseurl; ?>assets/css/testimonial.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $cfg_baseurl; ?>assets/css/swiper-bundle.min.css" rel="stylesheet" type="text/css">

        <link href="<?php echo $cfg_baseurl; ?>sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
        <script src="<?php echo $cfg_baseurl; ?>sweetalert/sweetalert.min.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>sweetalert/jquery.sweet-alert.custom.js"></script>

        <script src="<?php echo $cfg_baseurl; ?>assets/js/modernizr.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="https://code.highcharts.com/highcharts.src.js"></script> 
       
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112914598-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-112914598-1');
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9326033452897565"
     crossorigin="anonymous"></script>
    </head>


    <body class="fixed-left">
        
        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="<?php echo $cfg_baseurl; ?>" class="logo"><img src="<?php echo $cfg_baseurl; ?>assets/images/honda.png" width="70px"> <span><?php echo $cfg_logo_txt; ?></span></a>
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <nav class="navbar-custom">
                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="mdi mdi-menu"></i>
                            </button>
                        </li>
                    </ul>

                </nav>

            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>
                            <li class="menu-title">Main</li>
 							<?php
							if (isset($_SESSION[ 'user'])) {
							?>
							    <?php
							    if ($data_user['level'] == "Admin") {
							    ?>
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="fa fa-gears"></i> <span>Admin Menu</span>
                                        <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="<?php echo $cfg_baseurl; ?>admin/users/">Kelola Pengguna</a></li>
                                        <li><a href="<?php echo $cfg_baseurl; ?>admin/slideshow/">Kelola Slideshow</a></li>
                                        <li><a href="<?php echo $cfg_baseurl; ?>admin/testimonial/">Kelola Testimoni</a></li>
                                        <li><a href="<?php echo $cfg_baseurl; ?>admin/gallery/">Kelola Galeri</a></li>
                                        <li><a href="<?php echo $cfg_baseurl; ?>admin/article/">Kelola Blog</a></li>
                                        <li><a href="<?php echo $cfg_baseurl; ?>admin/category/">Kelola Kategori</a></li>
                                        <li><a href="<?php echo $cfg_baseurl; ?>admin/about/">Kelola About</a></li>
                                        <li><a href="<?php echo $cfg_baseurl; ?>admin/contact/">Kelola Kontak</a></li>
                                    </ul>
                                </li>
                                <?php
    							} elseif ($data_user['level'] == "Staff") {
    							?>
    							<li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="fa fa-gears"></i> <span>Staff Menu</span>
                                        <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="<?php echo $cfg_baseurl; ?>admin/slideshow/">Kelola Slideshow</a></li>
                                        <li><a href="<?php echo $cfg_baseurl; ?>admin/testimonial/">Kelola Testimoni</a></li>
                                        <li><a href="<?php echo $cfg_baseurl; ?>admin/gallery/">Kelola Galeri</a></li>
                                        <li><a href="<?php echo $cfg_baseurl; ?>admin/article/">Kelola Blog</a></li>
                                        <li><a href="<?php echo $cfg_baseurl; ?>admin/category/">Kelola Kategori</a></li>
                                        <li><a href="<?php echo $cfg_baseurl; ?>admin/about/">Kelola About</a></li>
                                        <li><a href="<?php echo $cfg_baseurl; ?>admin/contact/">Kelola Kontak</a></li>
                                    </ul>
                                </li>
    							<?php
    							}
    							?>
    						<li class="has_sub">
    						    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="fa fa-gear"></i> <span>Pengaturan Akun</span><span class="menu-arrow"></span></a>
    						    <ul class="list-unstyled">
    						        <li><a href="<?php echo $cfg_baseurl; ?>change-name">Ubah Nama</a></li>
    						        <li><a href="<?php echo $cfg_baseurl; ?>change-password">Ubah Sandi</a></li>
    						    </ul>
    						</li>
                            <li>
                                <a href="<?php echo $cfg_baseurl; ?>logout" class="waves-effect waves-primary"><i class="fa fa-sign-out"></i> <span>Keluar</span></a>
                            </li>
                            <hr>
							<?php
							}
							?>
							<li>
                                <a href="<?php echo $cfg_baseurl; ?>" class="waves-effect waves-primary"><i class="fa fa-home"></i> <span>Home</span></a>
                            </li>
                            <li>
                                <a href="<?php echo $cfg_baseurl; ?>article/" class="waves-effect waves-primary"><i class="fa fa-globe"></i> <span>Blog</span></a>
                            </li>
                            <li>
                                <a href="<?php echo $cfg_baseurl; ?>us/" class="waves-effect waves-primary"><i class="fa fa-address-card"></i> <span>About Us</span></a>
                            </li>
                            <li>
                                <a href="<?php echo $cfg_baseurl; ?>skills/" class="waves-effect waves-primary"><i class="fa fa-pencil"></i> <span>Skills</span></a>
                            </li>
                            <li>
                                <a href="<?php echo $cfg_baseurl; ?>experiences/" class="waves-effect waves-primary"><i class="fa fa-trophy"></i> <span>Experiences</span></a>
                            </li>
                            <li>
                                <a href="<?php echo $cfg_baseurl; ?>education/" class="waves-effect waves-primary"><i class="fa fa-graduation-cap"></i> <span>Education</span></a>
                            </li>
                            <li>
                                <a href="<?php echo $cfg_baseurl; ?>work/" class="waves-effect waves-primary"><i class="fa fa-briefcase"></i> <span>Work</span></a>
                            </li>
                            <li>
                                <a href="<?php echo $cfg_baseurl; ?>contact/" class="waves-effect waves-primary"><i class="fa fa-phone"></i> <span>Contact</span></a>
                            </li>
                            <li>
                                <a href="<?php echo $cfg_baseurl; ?>gallery/" class="waves-effect waves-primary"><i class="fa fa-camera"></i> <span>Galeri</span></a>
                            </li>
                        </ul>

                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End -->




            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">