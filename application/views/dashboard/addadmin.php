<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('dashboard/config/head') ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php $this->load->view('dashboard/config/sidebar') ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php $this->load->view('dashboard/config/nav') ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="col-lg mb-4">

                        <!-- Illustrations -->
                        <div class="card">
                            <form method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Username</label>
                                        <input class="form-control w-50" id="usernameadmin" placeholder="Username" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1" class="col">Level admin</label>
                                        <select class="form-control w-50 col-lg-12" id="adminlevel">
                                            <option value="1">Superadmin</option>
                                            <option value="2">Admin biasa</option>
                                        </select>
                                    </div>

                                </div>

                                <input type="submit" name="submit" id="tambahadmin" class="btn btn-primary w-25 ml-4 mb-4" value="Tambah Admin" />
                            </form>
                        </div>

                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php
    $this->load->view('dashboard/config/foot');
    ?>

</body>

</html>