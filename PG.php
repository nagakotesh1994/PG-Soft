<?php
include 'DB.php';
if (!isset($_SESSION['LoginId']))
    echo "<script>window.location.href = {$pages['home_page']};</script>";
if(isset($_REQUEST['submit']))
{
    $status=PG_Hostel_Insert($_REQUEST);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo $pages_titles['dashboard_page_title']; ?>

    <?php include 'HeaderIncludes.php'; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <?php include 'NavBar.php'; ?>

        <!-- Main Sidebar Container -->
        <?php include 'SideBar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?php echo $_SESSION['pg_name']; ?></h1>

                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                                <li class="breadcrumb-item active">PG MANAGEMENT</li>
                                <li class="breadcrumb-item active">CREATE PG HOSTEL</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">

                            <!-- Horizontal Form -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Create PG Hostel</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" class="form-horizontal">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-md-2 col-form-label">PG Hostel Name:</label>
                                            <div class="col-sm-9 col-md-10">
                                                <input type="text" class="form-control" name="PG_Hostel_Name" id="PG_Hostel_Name" placeholder="Enter Your PG Hostel Name">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <!-- <button type="submit" class="btn btn-info">Sign in</button> -->
                                        <button type="submit" name="submit" class="btn btn-primary float-right">Create PG</button>
                                    </div>
                                    <!-- /.card-footer -->
                                </form>
                            </div>
                            <!-- /.card -->

                        </div>
                        <!--/.col (left) -->


                    </div>
                    <!-- /.row -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">PG Hostel List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">


                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting sorting_asc" width="10%" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">S.No</th>
                                                    <th class="sorting" width="70%" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="">PG Hostel Name</th>
                                                    <th class="sorting" width="20%" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                
                                                <!-- <tr class="odd">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Netscape Navigator 9</td>
                                                    <td>Win 98+ / OSX.2+</td>
                                                </tr> -->
                                                <?php Get_PG_Hostel_Data(); ?>

                                            </tbody>
                                            <tfoot>
                                                <!-- <tr>
                                                    <th rowspan="1" colspan="1">Rendering engine</th>
                                                    <th rowspan="1" colspan="1">Browser</th>
                                                    <th rowspan="1" colspan="1">Platform(s)</th>
                                                </tr> -->
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->


                    </div>
                </div><!-- /.container-fluid -->

            </section>



        </div>
        <!-- /.content-wrapper -->
        <?php include 'Footer.php'; ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php include 'FooterIncludes.php'; ?>
    <?php
        if(isset($_REQUEST['submit']))
        {
            echo $messages[5];
        }
    ?>
</body>

</html>