<?php
include('db_func.php');
global $con;


if (!chk_adm_login()) {
    header('location: login.php');
    exit;
}

$log_email = $_SESSION['log_adm_email'];
// grab login user data;

global $grab_user_data_fet;

$grab_user_data_qur = "SELECT `Account_type`, `U_id`, `D_id`, `r_id`, `U_name`, `u_email`, `profile_img` FROM `user` WHERE `u_email`='".$log_email."'";
$grab_user_data_exc = mysqli_query($con, $grab_user_data_qur) or die (mysqli_error($con));
$grab_user_data_fet = mysqli_fetch_assoc($grab_user_data_exc);


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Data Tables</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include 'header.php'; ?>
    <!-- Left side column. contains the logo and sidebar -->
    <?php include 'sidebar.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Users
                <small>Preview page</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Users</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
                            <div class="box">
                                <div class="box-header">
                                    <i class="fa fa-user"></i> <h3 class="box-title">Users</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <?php
                                    if(isset($_GET['status']) && $_GET['status'] == 'online'){
                                    $user="Select * from `user` WHERE(is_status = 'check in' OR is_status = 'online')";
                                    $users_query=mysqli_query($con,$user);?>
                                    <table id="example1" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Employe</th>
                                            <th>status</th>
                                        </tr>

                                        </thead>
                                        <tbody>
                                        <?php
                                        while($row=mysqli_fetch_assoc($users_query)) {
                                            ?>

                                            <tr>
                                                <td>
                                                    <?php echo $row['U_name'];?>
                                                </td>

                                                <td  style="padding-left: 10px;">
                                                    <?php echo $row['is_status'];?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <?php }?>
                                        </tbody>
                                    </table>
                                        <?php if(isset($_GET['status']) && $_GET['status'] == 'offline'){
                                        $user="Select * from `user` WHERE(is_status = 'offline')";
                                        $users_query=mysqli_query($con,$user);?>
                                        <table id="example1" class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>Employe</th>
                                                <th>status</th>
                                            </tr>

                                            </thead>
                                            <tbody>
                                            <?php
                                            while($row=mysqli_fetch_assoc($users_query)) {
                                                ?>

                                                <tr>
                                                    <td>
                                                        <?php echo $row['U_name'];?>
                                                    </td>

                                                    <td>
                                                        <?php echo $row['is_status'];?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                     </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <?php include 'footer.php'; ?>
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
</body>
</html>