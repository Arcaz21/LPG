<?php 

session_start();
if( !isset($_SESSION['username']) && !isset($_SESSION['password'])){
    header("location: index.php");
    
}
?>
<?php include "../controllers/importFunction.php"; ?>

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
        <link href="../assets/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
        <link href="../assets/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
        <link href="../assets/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- PNotify -->
        <link href="../assets/pnotify/dist/pnotify.css" rel="stylesheet">
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
                            <h2>Button Example <small>Users</small></h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th>Username</th>
                                  <th>Password</th>
                                  <th>First Name</th>
                                  <th>Last Name</th>
                                  <th>Role</th>
                                  <th>Action</th>
                                </tr>
                              </thead>

                              <tbody>
                                <tr>
                                  <td>Tiger Nixon</td>
                                  <td>System Architect</td>
                                  <td>Edinburgh</td>
                                  <td>61</td>
                                  <td>2011/04/25</td>
                                  <td> 
                                    <div class="row" style="margin-left:13%;">
                                      <div class="btn-toolbar">
                                        <div class="btn-group">
                                          <button class="btn btn-info" type="button"><i class="fa fa-edit"></i></button>
                                          <button class="btn btn-success" type="button"><i class="fa fa-user"></i></button>
                                          <button class="btn btn-warning" type="button"><i class="fa fa-trash-o"></i></button>
                                      </div>
                                    </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Garrett Winters</td>
                                  <td>Accountant</td>
                                  <td>Tokyo</td>
                                  <td>63</td>
                                  <td>2011/07/25</td>
                                  <td> 
                                    <div class="row" style="margin-left:13%;">
                                      <div class="btn-toolbar">
                                        <div class="btn-group">
                                          <button class="btn btn-info" type="button"><i class="fa fa-edit"></i></button>
                                          <button class="btn btn-success" type="button"><i class="fa fa-user"></i></button>
                                          <button class="btn btn-warning" type="button"><i class="fa fa-trash-o"></i></button>
                                      </div>
                                    </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Ashton Cox</td>
                                  <td>Junior Technical Author</td>
                                  <td>San Francisco</td>
                                  <td>66</td>
                                  <td>2009/01/12</td>
                                  <td> 
                                    <div class="row" style="margin-left:13%;">
                                      <div class="btn-toolbar">
                                        <div class="btn-group">
                                          <button class="btn btn-info" type="button"><i class="fa fa-edit"></i></button>
                                          <button class="btn btn-success" type="button"><i class="fa fa-user"></i></button>
                                          <button class="btn btn-warning" type="button"><i class="fa fa-trash-o"></i></button>
                                      </div>
                                    </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Cedric Kelly</td>
                                  <td>Senior Javascript Developer</td>
                                  <td>Edinburgh</td>
                                  <td>22</td>
                                  <td>2012/03/29</td>
                                  <td> 
                                    <div class="row" style="margin-left:13%;">
                                      <div class="btn-toolbar">
                                        <div class="btn-group">
                                          <button class="btn btn-info" type="button"><i class="fa fa-edit"></i></button>
                                          <button class="btn btn-success" type="button"><i class="fa fa-user"></i></button>
                                          <button class="btn btn-warning" type="button"><i class="fa fa-trash-o"></i></button>
                                      </div>
                                    </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Airi Satou</td>
                                  <td>Accountant</td>
                                  <td>Tokyo</td>
                                  <td>33</td>
                                  <td>2008/11/28</td>
                                  <td> 
                                    <div class="row" style="margin-left:13%;">
                                      <div class="btn-toolbar">
                                        <div class="btn-group">
                                          <button class="btn btn-info" type="button"><i class="fa fa-edit"></i></button>
                                          <button class="btn btn-success" type="button"><i class="fa fa-user"></i></button>
                                          <button class="btn btn-warning" type="button"><i class="fa fa-trash-o"></i></button>
                                      </div>
                                    </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Brielle Williamson</td>
                                  <td>Integration Specialist</td>
                                  <td>New York</td>
                                  <td>61</td>
                                  <td>2012/12/02</td>
                                  <td> 
                                    <div class="row" style="margin-left:13%;">
                                      <div class="btn-toolbar">
                                        <div class="btn-group">
                                          <button class="btn btn-info" type="button"><i class="fa fa-edit"></i></button>
                                          <button class="btn btn-success" type="button"><i class="fa fa-user"></i></button>
                                          <button class="btn btn-warning" type="button"><i class="fa fa-trash-o"></i></button>
                                      </div>
                                    </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Herrod Chandler</td>
                                  <td>Sales Assistant</td>
                                  <td>San Francisco</td>
                                  <td>59</td>
                                  <td>2012/08/06</td>
                                  <td> 
                                    <div class="row" style="margin-left:13%;">
                                      <div class="btn-toolbar">
                                        <div class="btn-group">
                                          <button class="btn btn-info" type="button"><i class="fa fa-edit"></i></button>
                                          <button class="btn btn-success" type="button"><i class="fa fa-user"></i></button>
                                          <button class="btn btn-warning" type="button"><i class="fa fa-trash-o"></i></button>
                                      </div>
                                    </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Rhona Davidson</td>
                                  <td>Integration Specialist</td>
                                  <td>Tokyo</td>
                                  <td>55</td>
                                  <td>2010/10/14</td>
                                  <td> 
                                    <div class="row" style="margin-left:13%;">
                                      <div class="btn-toolbar">
                                        <div class="btn-group">
                                          <button class="btn btn-info" type="button"><i class="fa fa-edit"></i></button>
                                          <button class="btn btn-success" type="button"><i class="fa fa-user"></i></button>
                                          <button class="btn btn-warning" type="button"><i class="fa fa-trash-o"></i></button>
                                      </div>
                                    </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Colleen Hurst</td>
                                  <td>Javascript Developer</td>
                                  <td>San Francisco</td>
                                  <td>39</td>
                                  <td>2009/09/15</td>
                                  <td> 
                                    <div class="row" style="margin-left:13%;">
                                      <div class="btn-toolbar">
                                        <div class="btn-group">
                                          <button class="btn btn-info" type="button"><i class="fa fa-edit"></i></button>
                                          <button class="btn btn-success" type="button"><i class="fa fa-user"></i></button>
                                          <button class="btn btn-warning" type="button"><i class="fa fa-trash-o"></i></button>
                                      </div>
                                    </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Sonya Frost</td>
                                  <td>Software Engineer</td>
                                  <td>Edinburgh</td>
                                  <td>23</td>
                                  <td>2008/12/13</td>
                                  <td> 
                                    <div class="row" style="margin-left:13%;">
                                      <div class="btn-toolbar">
                                        <div class="btn-group">
                                          <button class="btn btn-info" type="button"><i class="fa fa-edit"></i></button>
                                          <button class="btn btn-success" type="button"><i class="fa fa-user"></i></button>
                                          <button class="btn btn-warning" type="button"><i class="fa fa-trash-o"></i></button>
                                      </div>
                                    </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Jena Gaines</td>
                                  <td>Office Manager</td>
                                  <td>London</td>
                                  <td>30</td>
                                  <td>2008/12/19</td>
                                  <td> 
                                    <div class="row" style="margin-left:13%;">
                                      <div class="btn-toolbar">
                                        <div class="btn-group">
                                          <button class="btn btn-info" type="button"><i class="fa fa-edit"></i></button>
                                          <button class="btn btn-success" type="button"><i class="fa fa-user"></i></button>
                                          <button class="btn btn-warning" type="button"><i class="fa fa-trash-o"></i></button>
                                      </div>
                                    </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Quinn Flynn</td>
                                  <td>Support Lead</td>
                                  <td>Edinburgh</td>
                                  <td>22</td>
                                  <td>2013/03/03</td>
                                  <td> 
                                    <div class="row" style="margin-left:13%;">
                                      <div class="btn-toolbar">
                                        <div class="btn-group">
                                          <button class="btn btn-info" type="button"><i class="fa fa-edit"></i></button>
                                          <button class="btn btn-success" type="button"><i class="fa fa-user"></i></button>
                                          <button class="btn btn-warning" type="button"><i class="fa fa-trash-o"></i></button>
                                      </div>
                                    </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Charde Marshall</td>
                                  <td>Regional Director</td>
                                  <td>San Francisco</td>
                                  <td>36</td>
                                  <td>2008/10/16</td>
                                  <td> 
                                    <div class="row" style="margin-left:13%;">
                                      <div class="btn-toolbar">
                                        <div class="btn-group">
                                          <button class="btn btn-info" type="button"><i class="fa fa-edit"></i></button>
                                          <button class="btn btn-success" type="button"><i class="fa fa-user"></i></button>
                                          <button class="btn btn-warning" type="button"><i class="fa fa-trash-o"></i></button>
                                      </div>
                                    </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Haley Kennedy</td>
                                  <td>Senior Marketing Designer</td>
                                  <td>London</td>
                                  <td>43</td>
                                  <td>2012/12/18</td>
                                  <td> 
                                    <div class="row" style="margin-left:13%;">
                                      <div class="btn-toolbar">
                                        <div class="btn-group">
                                          <button class="btn btn-info" type="button"><i class="fa fa-edit"></i></button>
                                          <button class="btn btn-success" type="button"><i class="fa fa-user"></i></button>
                                          <button class="btn btn-warning" type="button"><i class="fa fa-trash-o"></i></button>
                                      </div>
                                    </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Tatyana Fitzpatrick</td>
                                  <td>Regional Director</td>
                                  <td>London</td>
                                  <td>19</td>
                                  <td>2010/03/17</td>
                                  <td> 
                                    <div class="row" style="margin-left:13%;">
                                      <div class="btn-toolbar">
                                        <div class="btn-group">
                                          <button class="btn btn-info" type="button"><i class="fa fa-edit"></i></button>
                                          <button class="btn btn-success" type="button"><i class="fa fa-user"></i></button>
                                          <button class="btn btn-warning" type="button"><i class="fa fa-trash-o"></i></button>
                                      </div>
                                    </div>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                </div> 
              </div> <!--End Page-inner-->
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
<!--tabs-->
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
<!-- PNotify -->
    <script src="../assets/pnotify/dist/pnotify.js"></script>
    <script src="../assets/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../assets/pnotify/dist/pnotify.nonblock.js"></script>


<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>




</html>