<?php 

session_start();
if( !isset($_SESSION['username']) && !isset($_SESSION['password'])){
    header("location: index.php");
    
}
unset($_SESSION['page']);
$_SESSION['page'] = "clientpage";
print_r($_SESSION['page']);
?>
<?php include "../controllers/productFunction.php"; ?>

<!DOCTYPE html>
<html
    xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>ADMIN</title>
        <!-- BOOTSTRAP STYLES-->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
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
        <link href="assets/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="assets/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
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
                                    <a href="addUser.php" data-toggle="modal" data-target="#theModal" class="alert-link">Add New Member?</a>
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
                    </div>

                    <!--NEW-->
                    <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                          <div class="x_title">
                            <a href="addvendor.php" class="btn btn-info btn-lg">Register Client</a>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th>Client's Name</th>
                                  <th>Business Name</th>
                                  <th>Address</th>
                                  <th>Contact No.</th>
                                  <th>Action</th>
                                </tr>
                              </thead>

                              <tbody>
                                <?php error_reporting(E_ERROR | E_PARSE); foreach ($getClient as $index => $client): ?>
                                <tr>
                                  <td hidden=""><?php echo $client['vendor_id'] ?></td>
                                  <td><?php echo $client['name'] ?></td>
                                  <td><?php echo $client['company'] ?></td>
                                  <td><?php echo $client['address'] ?></td>
                                  <td><?php echo $client['contact'] ?></td>
                                  <td> 
                                    <div class="row" style="margin-left:13%;">
                                      <div class="btn-toolbar">
                                        <div class="btn-group">
                                          <form action="<?php $_PHP_SELF ?>" method="POST" >
                                          <input hidden name="vendID" value="<?php echo $client['vendor_id'] ?>">
                                          <input hidden="" name="delete" value="delete">
                                          <a href="editvendor.php <?php $_SESSION['editid'] = $client['vendor_id'] ?>" class="btn btn-info" type="button"><i class="fa fa-edit"></i></a>
                                          <button class="btn btn-warning" type="submit"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                          
                                      </div>
                                    </div>
                                    </div>
                                  </td>
                                </tr>
                                <?php endforeach; ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                </div> 
              </div> <!--End Page-inner-->
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

<script src="tabs.js"></script>

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

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>




</html>