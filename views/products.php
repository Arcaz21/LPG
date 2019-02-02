<?php 

session_start();
if( !isset($_SESSION['username']) && !isset($_SESSION['password'])){
    header("location: index.php");

    
}
unset($_SESSION['page']);
$_SESSION['page'] = "products";
?>
<?php include "../controllers/productFunction.php"; ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>ADMIN</title>
        <!-- BOOTSTRAP STYLES-->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!--CUSTOM BASIC STYLES-->
        <link href="assets/css/basic.css" rel="stylesheet" />
        <!--CUSTOM MAIN STYLES-->
        <link href="assets/css/custom.css" rel="stylesheet" />
        <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <!-- Custom Theme Style -->
        <link href="assets/css/custom.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="assets/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="assets/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- Datatables -->
        <link href="assets/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="assets/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="assets/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="assets/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

        <!-- bootstrap-progressbar -->
        <link href="assets/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="assets/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="assets/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <link href="../build/css/custom.min.css" rel="stylesheet">
    </head>
<body>
    <?php  $db = new userModel();
    $data = $db->getUse($_SESSION['username']); ?>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="col-md-3">
                <div class="main-box mb-red">
                    <a href="#">
                      <?php date_default_timezone_set('Asia/Manila');?>
                      <!--  TIME SCRIPT -->
                      <script type="text/javascript" src="assets/js/date_time.js" ></script>
                      <span id="date_time"></span>
                      <script type="text/javascript">window.onload = date_time('date_time');</script> 
                    </a>
                </div>
            </div>
            <div class="header-right">
                <p style="font-size: 27px;">
                    <?php echo $data->fname ." ". $data->lname."  "?>
                    <a href="index.php" class="btn btn-danger" title="Logout">
                        <i class="fa fa-sign-out "></i>
                    </a>
                </p>
            </div>
        </nav>
        <!-- /. NAV SIDE -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <center>
                            <h2 style="color: white; margin-top:18%; font-weight:bold; font-size:250%;">P.O.S</h2>
                        </center>
                    </li>
                    <li>
                        <a style="cursor: pointer; margin-top:3%; margin-left:15%;" class="tablinks" href="dashboard.php">
                            <i class="fa fa-laptop"></i>P.O.S
                         </a>  

                         

                         <a style="cursor: pointer; margin-top:3%; margin-left:15%;" class="tablinks" href="vendors.php">
                            <i class="fa fa-users"></i>Clients  
                        </a>

                        <a style="cursor: pointer; margin-top:3%; margin-left:15%;" class="tablinks" href="sales_rep.php">
                            <i class="fa fa-line-chart"></i>Sales Report  
                        </a>

                        <a style="cursor: pointer; margin-top:3%; margin-left:15%;" class="tablinks" href="products.php">
                            <i class="fa fa-briefcase"></i>Products
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /. CONTENT  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Modal -->
                          <div class="modal fade" id="theModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                              </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->
                        <!-- End Modal -->
                        <!-- Notifications-->
                        <!-- FAILED NOTIFICATION -->
                            <?php if(isset($_SESSION['failed'])): ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <?php echo $_SESSION['failed']." "; ?> 
                                    <button onclick="" type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php unset($_SESSION['failed']) ?>
                                </div>
                            <?php endif; ?>
                        <!-- END -->

                        <!-- INFO NOTIFICATION -->
                            <?php if(isset($_SESSION['info'])): ?>
                                <div class="alert alert-info alert-dismissable">
                                    <?php echo $_SESSION['info']." "; ?> 
                                    <button onclick="" type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <a href="stat.php">Statistics.</a>
                                    <?php unset($_SESSION['info']) ?>
                                </div>
                            <?php endif; ?>
                        <!-- END -->

                        <!-- SUCCESS NOTIFICATION -->
                            <?php if(isset($_SESSION['success'])): ?>
                                <div class="alert alert-success alert-dismissable">
                                    <i class="fa fa-check"></i>
                                    <?php echo $_SESSION['success']." "; ?> 
                                    <button onclick="" type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php unset($_SESSION['success']) ?>
                                </div>
                            <?php endif; ?>
                        <!-- END -->

                        <!-- SUCCESS UPLOAD EMP NOTIFICATION -->
                            <?php if(isset($_SESSION['emp'])): ?>
                                <div class="alert alert-success alert-dismissable">
                                    <?php echo $_SESSION['emp']." "; ?> 
                                    <button onclick="" type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php unset($_SESSION['emp']) ?>
                                </div>
                            <?php endif; ?>
                        <!-- END -->

                        <!-- SUCCESS UPLOAD APP NOTIFICATION -->
                            <?php if(isset($_SESSION['app'])): ?>
                                <div class="alert alert-success alert-dismissable">
                                    <?php echo $_SESSION['app']." "; ?> 
                                    <button onclick="" type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php unset($_SESSION['app']) ?>
                                </div>
                            <?php endif; ?>
                        <!-- END -->

                        <!-- DELETED NOTIFICATION -->
                            <?php if(isset($_SESSION['delete'])): ?>
                                <div class="alert alert-success alert-dismissable">
                                    <?php echo $_SESSION['delete']." "; ?> 
                                    <button onclick="" type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php unset($_SESSION['delete']) ?>
                                    <a href="addproduct.php"  class="alert-link">Add New Member?</a>
                                </div>
                            <?php endif; ?>
                        <!-- END -->

                        <!-- UPDATED NOTIFICATION -->
                            <?php if(isset($_SESSION['update'])): ?>
                                <div class="alert alert-success alert-dismissable">
                                    <?php echo $_SESSION['update']." "; ?> 
                                    <button onclick="" type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php unset($_SESSION['update']) ?>
                                    <!-- <a href="addMember.php" data-toggle="modal" data-target="#theModal" class="alert-link">Add New Member</a>. -->
                                </div>
                            <?php endif; ?>
                        <!-- END -->
                        <!-- End Notifications -->

                        <!-- /top product tiles -->
                        <div class="row tile_count">
                                <?php error_reporting(E_ERROR | E_PARSE); foreach ($getprodcount as $index => $product): 
                                if($product['description']=='LPG'&&$product['cat_id']=='11'){ if($product['status'] == '1'){$product['status'] = 'Filled';}else{$product['status'] = 'Empty';} ?>
                                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="tile-stats">
                                              <div class="icon"><i class="fa fa-archive"></i></div>
                                              <div class="count"><?php echo $product['qty']; ?></div>
                                              <h3><?php echo $product['name']; ?></h3>
                                              <p><?php echo 'PRICE:'.$product['price']; ?></p>
                                            </div>
                                            <form action="<?php $_PHP_SELF ?>" method="POST">
                                            <input hidden="" name="prodid" value="<?php echo $product['product_id']; ?>">
                                            <input hidden="" name="deleteprod" value="deleteprod">
                                             <button type="submit" class="btn btn-warning btn-lg">Delete</button>
                                            </form>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="tile-stats">
                                                <?php if($product['name'] == 'Solane'):?>
                                                <div style="z-index: 1; position: absolute; right: -20px;  top: 20px;" ><img width="50%"   src="../build/images/solane.png"></div>
                                                <?php endif; ?>
                                                 <?php if($product['name'] == 'Pryce Gas'):?>
                                                <div style="z-index: 2; position: absolute; top: 25px; left: 200px" ><img width=90%" src="../build/images/pryce.png"></div>
                                                <?php endif; ?>
                                                 <?php if($product['name'] == 'Phoenix'):?>
                                                <div style="z-index: 2; position: absolute; top: 25px; left: 200px" ><img width=90%" src="../build/images/phoenix.png"></div>
                                                <?php endif; ?>
                                              <div class="count"><?php echo $product['qty']; ?></div>
                                              <h3><?php echo $product['name']." ".$product['weight']."Kg"; ?></h3>
                                              <p><?php if($product['cat_id'] == '11'){if($product['status'] == '1'){$product['status'] = 'FILLED';}else{$product['status'] = 'EMPTY';}echo 'STATUS:'.$product['status'];} ?></p>
                                            </div>
                                             <form action="<?php $_PHP_SELF ?>" method="POST">
                                            <input hidden="" name="prodid" value="<?php echo $product['product_id']; ?>">
                                            <input hidden="" name="deleteprod" value="deleteprod">
                                             <button type="submit" class="btn btn-warning btn-lg">Delete</button>
                                            </form>
                                        </div>

                                    <?php }?>
                                <?php endforeach; ?>
                        </div>
                        <!-- /top product tiles -->


                          <div id="row">
                                <a href="addproduct.php" class="btn btn-info btn-lg">Add Product</a>
                                <a href="editproducts.php" class="btn btn-info btn-lg">Update</a>
                                <a href="editproducts.php" class="btn btn-info btn-lg">Refill</a>
                          </div>
                        
                    </div>
                </div>
            </div>

            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                          <div class="x_title">
                            <h2>Product Log<small><?php echo $data->fname ." ". $data->lname."  " ?></small></h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                            <p class="text-muted font-13 m-b-30">
                              The Product Log is where you can view your interaction with your products. ex. updating, deleting and deleteing. You can also export to csv, print and copy all the contents of this table in on-click.
                            </p>
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th>Product Name</th>
                                  <th>Description</th>
                                  <th>Quantity</th>
                                  <th>Status</th>
                                </tr>
                              </thead>


                              <tbody>
                                <?php error_reporting(E_ERROR | E_PARSE); foreach ($getprodcount as $index => $logs): ?>
                                <tr>
                                  <td><?php echo $logs['name'] ?></td>
                                  <td><?php echo $logs['description'] ?></td>
                                  <td><?php echo $logs['qty'] ?></td>
                                  <td>
                                  <?php if($logs['status'] == '1'):
                                            $logs['status'] = 'FILLED';
                                        endif;
                                        if($logs['status'] == '2'):
                                            $logs['status'] = 'EMPTY';
                                        endif;
                                        if($logs['status'] == '3'):
                                            $logs['status'] = 'IN-USE';
                                        endif;
                                        if($logs['status'] == '4'):
                                            $logs['status'] = 'REFILLING';
                                        endif; 
                                    ?>
                                    <?php echo $logs['status'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- /. WRAPPER  -->
<!--         <div id="footer-sec">
                <img style="margin-bottom:-5.5%; margin-left:40%;" height="8%" src="assets/img/pod_2.png" />
                <p style="margin-top:10px; margin-left:50.5%;">Felcris Centrale,</p>
                <p style="margin-top:-10px; margin-left:50.5%;"> Located at Brgy. 40-D,</p>
                <p style="margin-top:-10px; margin-left:50.5%;">Quimpo Boulevard,</p>
                <p style="margin-top:-10px; margin-left:50.5%;"> Davao City, Fronting LTO.</p>
        </div> -->
              <!-- /. FOOTER  -->
</body>


<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- jQuery -->
<script src="assets/jquery/dist/jquery.min.js"></script>
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="assets/js/jquery.metisMenu.js"></script>
 <!-- Chart.js -->
<script src="assets/Chart.js/dist/Chart.min.js"></script>

<!-- Bootstrap -->
<script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="assets/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="assets/nprogress/nprogress.js"></script>

<!-- jQuery -->
<script src="assets/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="assets/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="assets/nprogress/nprogress.js"></script>
<!-- iCheck -->
<script src="assets/iCheck/icheck.min.js"></script>
<!-- Datatables -->
<script src="assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="assets/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="assets/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="assets/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="assets/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="assets/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="assets/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="assets/jszip/dist/jszip.min.js"></script>
<script src="assets/pdfmake/build/pdfmake.min.js"></script>
<script src="assets/pdfmake/build/vfs_fonts.js"></script>

<!-- Skycons -->
<script src="assets/skycons/skycons.js"></script>
<!-- Flot -->
<script src="assets/Flot/jquery.flot.js"></script>
<script src="assets/Flot/jquery.flot.pie.js"></script>
<script src="assets/Flot/jquery.flot.time.js"></script>
<script src="assets/Flot/jquery.flot.stack.js"></script>
<script src="assets/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="assets/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="assets/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="assets/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="assets/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="assets/jqvmap/dist/jquery.vmap.js"></script>
<script src="assets/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="assets/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="assets/moment/min/moment.min.js"></script>
<script src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>




</html>