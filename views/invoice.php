<?php 

session_start();
if( !isset($_SESSION['username']) && !isset($_SESSION['password'])){
    header("location: index.php");

    }
if(!isset($_SESSION['invoice']) && $_SESSION['invoice'] != 'PRINT'){
      header("location: dashboard.php");
}$_SESSION['page'] = "import";
?>
<?php include "../controllers/productFunction.php"; ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<style type="text/css">
@media print{.noprint {display: none;}}
@media print{.noscreen{display: none;}}
</style>

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
        <!-- /. CONTENT  -->
        <div id="page-wrapper">
            <div id="page-inner" style="margin: 10px 10px 10px 10px">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                          <div class="x_panel">
                            <div class="x_content">

                              <section class="content invoice">
                                <!-- title row -->
                                <div class="row">
                                  <div class="col-xs-12 invoice-header">
                                    <h1>
                                      <i class="fa fa-globe"></i> Invoice.<small class="pull-right"><?php  echo date('Y-m-d H:i:s'); ?></small>
                                    </h1>

                                      
                                               
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                  <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                                    <strong>PFR LPG Gas Trading</strong>
                                                    <br>Purok 6, Immaculate Conception,
                                                    <br>Lubogan Toril, Davao City 8000
                                                    <br>Phone: +63 (082) 234-6892
                                                    <br>Cel. No.: +639207389757 / +639755978055
                                                </address>
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-4 invoice-col">
                                    To
                                    <address>
                                                    <strong><?php echo $getall[0]['VendName'] ?></strong>
                                                    <br><?php echo $getall[0]['VendAdd']; ?>
                                                    <br><?php echo $getall[0]['VendCompany']; ?>
                                                    <br><?php echo $getall[0]['VendCon']; ?>
                                                </address>
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-4 invoice-col">
                                    <b>Receipt Number: </b> <b style="color: red;"><?php echo $_SESSION['salesID'] ?></b>
                                    <br>
                                    <br>
                                    <b>User's Name:</b> <?php echo $getall[0]['CashierName'] ?>
                                    <br>
                                    <b>Cleint Account:</b> <?php echo $getall[0]['VendID'] ?>
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                  <div class="col-xs-12 table">
                                    <table class="table table-striped">
                                      <thead>
                                        <tr>
                                          <th>Qty</th>
                                          <th>Product</th>
                                          <th>Serial #</th>
                                          <th style="width: 60%">Description</th>
                                          <th>Subtotal</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php error_reporting(E_ERROR | E_PARSE); foreach ($getInfo as $index => $info): ?>
                                        <tr>
                                          <td><?php echo $info['soldqty']?></td>
                                          <td><?php echo $info['productName']?></td>
                                          <td><?php echo $info['serial']?></td>
                                          <td><?php echo $info['description']?></td>
                                          <td><?php echo "₱".number_format($info['SubTotal'],2); ?></td>
                                        </tr>
                                      <?php endforeach; ?>
                                      </tbody>
                                    </table>
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                  <!-- accepted payments column -->
                                  <div class="col-xs-6">
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-xs-6">
                                    <p class="lead">Amount Due 2/22/2014</p>
                                    <div class="table-responsive">
                                      <table class="table">
                                        <tbody>
                                          <tr>
                                            <th style="width:50%; text-align: right;">Subtotal:</th>
                                            <td style="text-align: right;"><?php echo "₱".number_format($getall[0]['VendID'],2); ?></td>
                                          </tr>
                                          <tr>
                                            <th style="width:50%; text-align: right;">Tax (12%)</th>
                                            <td style="text-align: right;"><?php echo "₱".number_format($getall[0]['VendID'],2); ?></td>
                                          </tr>
                                          <tr>
                                            <th style="width:50%; text-align: right;">Total:</th>
                                            <td style="text-align: right;"><?php echo "₱".number_format($getall[0]['VendID'],2); ?></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- this row will not appear when printing -->
                                <div class="noprint">
                                  <div class="col-xs-12">
                                    <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                                    <button class="btn btn-default" onclick="window.location.href='dashboard.php'"><i class="fa fa-back"></i> Done</button>
                                  </div>
                                </div>
                              </section>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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