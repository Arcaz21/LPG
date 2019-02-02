<?php 

session_start();
if( !isset($_SESSION['username']) && !isset($_SESSION['password'])){
    header("location: index.php");
    
}
unset($_SESSION['page']);
unset($_SESSION['invoice']);
$_SESSION['page'] = "dashboard";
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
        <!-- bootstrap-wysiwyg -->
        <link href="../assets/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
        <!-- Select2 -->
        <link href="../assets/select2/dist/css/select2.min.css" rel="stylesheet">
        <!-- Switchery -->
        <link href="../assets/switchery/dist/switchery.min.css" rel="stylesheet">
        <!-- starrr -->
        <link href="../assets/starrr/dist/starrr.css" rel="stylesheet">
        <!-- bootstrap-daterangepicker -->
        <link href="../assets/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">



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
                    <!--FORM-->
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                          <div class="x_title">
                            <h2>Window<small>This is the window of the P.O.S. system. All products to be sold will display here.<code>Proceed to the P.O.S table below.</code></small></h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Product</th>
                                  <th>Price</th>
                                  <th>Description</th>
                                  <th>Quantity</th>
                                  <th>Sub-Total</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php error_reporting(E_ERROR | E_PARSE); foreach ($getcart as $index => $cart): ?>
                                <tr>
                                  <th scope="row">1</th>
                                  <td><?php echo $cart['name']; ?></td>
                                  <td><?php echo "₱".number_format($cart['price'],2); ?></td>
                                  <td><?php echo $cart['description']." ".$cart['weight']."kg"." ".$cart['brand']; ?></td>
                                  <td><?php echo $cart['cartqty']; ?></td>
                                  <td><?php echo "₱".number_format(($cart['price']*$cart['cartqty']),2);?></td>
                                  <td>
                                    <form action="<?php $_PHP_SELF ?>" method="POST" >
                                        <input  hidden="hidden" name="prodid" value="<?php echo $cart['product_id'] ?>">
                                        <input  hidden="hidden" name="cart" value="<?php echo $cart['product_id'] ?>">
                                        <input  hidden="hidden" name="userID" value="<?php echo $data->user_id ?>">
                                        <input  hidden="hidden" name="action" value="delete">
                                        <button class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                                    </form>
                                  </td>
                                </tr>
                                <?php endforeach; ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    <!--End of FORM-->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_content">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h4>CHECKOUT</h4>
                                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target=".bs-example-modal-sm">CASH <i class="fa fa-money"></i></button>
                                            <?php if($getcarttotal[0]['GrandTotal'] != NUll): ?>
                                            <!-- modals -->
                                            <!-- Small modal -->
                                              <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                  <div class="modal-content">

                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                                      </button>
                                                      <h4 class="modal-title" id="myModalLabel2">Modal title</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="x_panel">
                                                          <div class="x_content">
                                                            <br>
                                                            <form action="<?php $_PHP_SELF ?>" method="POST" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" >

                                                              <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Customer<span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                                  <select class="form-control" name="vendor">
                                                                    <option>Others</option>
                                                                   <?php error_reporting(E_ERROR | E_PARSE); foreach ($getvendor as $index => $vend): ?>
                                                                    <option value="<?php echo $vend['vendor_id'];?>"><?php echo $vend['name']; ?></option>
                                                                <?php endforeach; ?>
                                                                  </select>
                                                                </div>
                                                              </div>
                                                              <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="due-payment">Due Payment 
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                  <input hidden="hidden" type="number" id="due-payment" name="due-payment" required="required" value="<?php echo $getcarttotal[0]['GrandTotal']; ?>" >
                                                                  <h4 class=" col-md-7 col-xs-12"><?php echo "₱".$getcarttotal[0]['GrandTotal'].".00"; ?></h4>
                                                                </div>
                                                              </div>
                                                              <div class="item form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number" >Payment <span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                  <input type="number" id="number" name="payment" required="required"
                                                                  min="<?php echo $getcarttotal[0]['GrandTotal']; ?>"class="form-control col-md-7 col-xs-12" >
                                                                </div>
                                                              </div>
                                                              <div class="ln_solid"></div>
                                                              <div class="form-group">
                                                                <input hidden="" value="<?php echo $data->user_id ?>" name="user" >
                                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                                  <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
                                                                  <button class="btn btn-primary" type="reset">Reset</button>
                                                                  <button id="send" type="submit" class="btn btn-success">Submit</button>
                                                                </div>
                                                              </div>
                                                            </form>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            <!-- /modals -->
                                        <?php endif; ?>
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                              <div class="x_title">
                                <h2>P.O.S.<small><?php echo $data->fname ." ". $data->lname."  "?></small></h2>
                                <div class="clearfix"></div>
                              </div>
                              <div class="x_content">
                                <p class="text-muted font-13 m-b-30">
                                  Welcome to the P.O.S. page of this system. Please make sure you are using the proper unsername. The username loged in will be responsible for every transaction on this page and will be liable to any damage or loss occured under this username.
                                </p>
                                <table id="datatable" class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                      <th>Product Name</th>
                                      <th>Description</th>
                                      <th>Weight</th>
                                      <th>Quantity</th>
                                      <th>Price/each</th>
                                      <th>Sell Items</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php error_reporting(E_ERROR | E_PARSE); foreach ($getprodcount1 as $index => $prod): ?>
                                    <tr>
                                      <td><?php echo $prod['name'] ?></td>
                                      <td><?php echo $prod['description'] ?></td>
                                      <td><?php echo $prod['weight']."kg" ?></td>
                                      <td><?php if($prod['qty'] == 0){echo "OUT OF STOCK";}else{echo $prod['qty']."/pcs";} 
                                      ?></td>
                                      <td><?php echo "₱".number_format($prod['price'],2) ?></td>
                                      <td>
                                        <form action="<?php $_PHP_SELF ?>" method="POST" >
                                            <input data-validate-minmax="1,100" required="required" type="number" name="pcs">
                                            <input  hidden="hidden" name="prodid" value="<?php echo $prod['product_id'] ?>">
                                            <input  hidden="hidden" name="cart" value="<?php echo $prod['product_id'] ?>">
                                            <input  hidden="hidden" name="userID" value="<?php echo $data->user_id ?>">
                                            <input  hidden="hidden" name="action" value="addcart">
                                            <button class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                        </form>
                                        <?php endforeach; ?>
                                      </td>
                                    </tr>
                                    
                                  </tbody>
                                </table>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- /. WRAPPER  -->
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

<!-- FastClick -->
<script src="assets/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="assets/nprogress/nprogress.js"></script>

<script src="tabs.js"></script>

<!-- jQuery -->
<script src="assets/jquery/dist/jquery.min.js"></script>
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

<!-- validator -->
<script src="assets/validator/validator.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>




</html>