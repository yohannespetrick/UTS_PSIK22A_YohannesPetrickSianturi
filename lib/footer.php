</section><!-- /.content -->
      </div><!-- /.content-wrapper -->

                <footer class="footer small">
                    <div class="pull-right"><span class="hide-phone">Copyright <i class="fa fa-copyright"></i> <?php echo date('Y'); ?> |
                     dibuat penuh <span class="text-danger"><i class="fa fa-heart"></i></span> oleh <a href="https://instagram.com/abngpetrick" target="_blank">abngpetrick</a></span></div>
                </footer>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
        </div>
        <!-- END wrapper -->
    
        <script>
            var resizefunc = [];
        </script>

        <!-- Plugins  -->
        <script src="<?php echo $cfg_baseurl; ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>assets/js/popper.min.js"></script><!-- Popper for Bootstrap -->
        <script src="<?php echo $cfg_baseurl; ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>assets/js/detect.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>assets/js/fastclick.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>assets/js/jquery.blockUI.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>assets/js/waves.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>assets/js/wow.min.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>assets/js/jquery.nicescroll.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>assets/js/jquery.scrollTo.min.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>plugins/switchery/switchery.min.js"></script>

        <!-- Counter Up  -->
        <script src="<?php echo $cfg_baseurl; ?>plugins/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>plugins/counterup/jquery.counterup.min.js"></script>

        <!-- skycons -->
        <script src="<?php echo $cfg_baseurl; ?>plugins/skyicons/skycons.min.js" type="text/javascript"></script>

        <!-- Page js  -->
        <script src="<?php echo $cfg_baseurl; ?>assets/pages/jquery.dashboard.js"></script>
        
        <!-- Testimonial js  -->
        <script src="<?php echo $cfg_baseurl; ?>assets/js/swiper-bundle.min.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>assets/js/script.js"></script>

    <?php
$db_host = "localhost";
$MySQLi_CON = new MySQLi ($db_host, $db_user, $db_password, $db_name);
        if($MySQLi_CON->connect_errno)
            {
                die ("KESALAHAN : ->".$MySQLi_CON->connect_errno);
            }
$seminggulalu = date('Y-m-d', strtotime('-7 days', strtotime(date("Y-m-d"))));

    function dbrows_($tabel, $limit) {
        global $MySQLi_CON;
        $query = $MySQLi_CON->query("SELECT * FROM ".$tabel." WHERE ".$limit);
            
        $rows = $query->num_rows;
        return $rows;
        }

    function dbrowss_($tabel, $limit) {
        global $MySQLi_CON;
        $query = $MySQLi_CON->query("SELECT * FROM ".$tabel." WHERE ".$limit);
            
        $rows = $query->num_rows;
        return $rows;
        }
?>

        <!-- Custom main Js -->
        <script src="<?php echo $cfg_baseurl; ?>assets/js/jquery.core.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>assets/js/jquery.app.js"></script>


    </body>
</html>