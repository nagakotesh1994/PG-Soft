<?php
include 'DB_OPR/DB.php';
$conn = DB_Connect();
if (!isset($_SESSION['LoginId']))
    echo "<script>window.location.href = {$pages['home_page']};</script>";
if (isset($_REQUEST['submit'])) {
    $status = PG_Beds_Insert($_REQUEST);
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




                        </div>
                        <!--/.col (left) -->


                    </div>
                    <!-- /.row -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">PG Hostel Beds List</h3>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                                <div class="row">
                                    <div class="col-sm-12">

                                        <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Default Modal</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form>
                                                        <div class="modal-body">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">PG - Hostel Name:</label>
                                                                    <input type="text" class="form-control" name="m_name" id="m_name" placeholder="Enter Hostel Name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Room No:</label>
                                                                    <input type="text" class="form-control" name="m_roomno" id="m_roomno" placeholder="Room no">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Guest Name:</label>
                                                                    <input type="text" class="form-control" name="m_guest_name" id="m_guest_name" placeholder="Guest Name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary" name="submit">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

                                        <div class="form-group">
                                            <label>Select Hostel</label>
                                            <select class="form-control" name="hostel_name" id="hostel_name">
                                                <?php
                                                $query = "SELECT * FROM `pg_hostel`";
                                                $result = $conn->query($query);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo "<option value='{$row['id']}'>{$row['PG_Hostel_Name']}</option>";
                                                }


                                                ?>
                                            </select>
                                            <script>
                                                function getdata(roomno) {
                                                    document.getElementById('m_roomno').value = roomno.value;
                                                    document.getElementById('m_name').value = document.getElementById('hostel_name').textContent.trim();
                                                    //alert(roomno.value);
                                                }
                                            </script>
                                        </div>
                                        Room-1<br>

                                        <?php
                                        for ($i = 1; $i <= 20; $i++) {
                                            echo "<button type='button' class='btn btn-primary btn-lg' value='{$i}' data-toggle='modal' data-target='#modal-default' onclick='getdata(this)'>{$i}</button>&nbsp;";
                                        }
                                        ?>


                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">PG Hostel List</h3>
                            <button type="submit" name="submit" class="btn bg-gradient-primary float-right" data-toggle="modal" data-target="#modal-default">Create PG</button>

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
                                                    <th class="sorting" width="20%" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="">Name</th>
                                                    <th class="sorting" width="20%" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="">Bed No</th>
                                                    
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>


                                                <!-- <tr class="odd">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Netscape Navigator 9</td>
                                                    <td>Win 98+ / OSX.2+</td>
                                                </tr> -->
                                                <?php Get_PG_Hostel_Beds_Data(); ?>

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
    if (isset($_REQUEST['submit'])) {
        echo $messages[5];
    }
    ?>
</body>

</html>