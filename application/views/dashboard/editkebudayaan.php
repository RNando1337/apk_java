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
                                    <input type="hidden" id="idbudaya" value="<?= $budaya[0]->id ?>" />
                                    <div class="form-group">
                                        <label class="form-label">Judul</label>
                                        <input class="form-control" id="judulbudaya" value="<?= $budaya[0]->judul ?>" placeholder="Judul Kebudayaan" required />
                                    </div>

                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Upload gambar</label>
                                            <input type="hidden" id="gambarhidden" value="<?= $budaya[0]->gambar ?>">
                                            <input class="form-control" type="file" name="image" accept="image/*" id="gambar">
                                            <span class="text-danger">*dapat dikosongi jika tidak ingin diubah</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Upload Audio</label>
                                            <input type="hidden" id="adhidden" value="<?= $budaya[0]->audio ?>">
                                            <input class="form-control" type="file" name="image" accept="audio/*" id="adbudaya" required>
                                            <span class="text-danger">*dapat dikosongi jika tidak ingin diubah</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Video</label>
                                        <input class="form-control" id="vdbudaya" placeholder="Video Kebudayaan" value="<?= $budaya[0]->video ?>" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Kategori Budaya</label>
                                        <select class="form-control" id="kategoribudaya">
                                            <?php
                                            foreach ($selects as $key => $select) :
                                                if (($key + 1) == $budaya[0]->jenis_kebudayaan) :
                                            ?>
                                                    <option value="<?= ($key) + 1 ?>" selected><?= $select ?></option>
                                                <?php
                                                else :
                                                ?>
                                                    <option value="<?= ($key) + 1 ?>"><?= $select ?></option>
                                            <?php
                                                endif;
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Deskripsi Budaya</label>
                                        <textarea class="form-control" id="deskripsibudaya" rows="4" name="desk" placeholder="Deskripsi/Keterangan" required><?= $budaya[0]->deskripsi ?></textarea>
                                    </div>
                                </div>

                                <input type="submit" name="submit" id="editbudaya" class="btn btn-primary w-25 ml-4 mb-4" value="Edit Budaya" />
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