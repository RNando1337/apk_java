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
                                        <label class="form-label">Judul</label>
                                        <input class="form-control" id="judulbudaya" placeholder="Judul Kebudayaan" required />
                                    </div>

                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Upload Gambar</label>
                                            <input class="form-control" type="file" name="image" accept="image/*" id="imgbudaya" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Upload Audio</label>
                                            <input class="form-control" type="file" name="audio" accept="audio/*" id="adbudaya" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Video</label>
                                        <input class="form-control" id="vdbudaya" placeholder="Video Kebudayaan" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Kategori Budaya</label>
                                        <select class="form-control" id="kategoribudaya">
                                            <option value="1">Budaya Jawa Tengah</option>
                                            <option value="2">Budaya Jawa Barat</option>
                                            <option value="3">Budaya Jawa Timur</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Deskripsi Budaya</label>
                                        <textarea class="form-control" id="deskripsibudaya" rows="3" name="desk" placeholder="Deskripsi/Keterangan" required></textarea>
                                    </div>
                                </div>

                                <input type="submit" name="submit" id="tambahbudaya" class="btn btn-primary w-25 ml-4 mb-4" value="Tambah Budaya" />
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