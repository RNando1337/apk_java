<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('templateadmin/head') ?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-flex justify-content-center mt-5">
                        <div class="sidebar-brand-icon">
                            <h1 class="fas fa-desktop text-primary mt-3"></h1>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-5 mb-5 ">

                            <!-- Illustrations -->
                            <div class="card shadow m-5">
                                <div class="card-header py-4">
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Administrator Login</h6>
                                </div>
                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="form-label">Username</label>
                                            <input type="text" id="useradmin" class="form-control" placeholder="Username" required />
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Password</label>
                                            <input type="password" id="passadmin" class="form-control" placeholder="Password" required />
                                        </div>

                                        <input type="submit" name="submit" id="loginadmin" class="btn btn-primary w-25 mb-4" value="Login" />
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; APK-Java 2022</span>
            </div>
        </div>
    </footer>

    <?php $this->load->view('templateadmin/foot') ?>

</body>

</html>