<?php $this->load->view('templatepage/head') ?>

<body>
    <?php
    $this->load->view('templatepage/header')
    ?>

    <!-- ****** Categories Area Start ****** -->
    <section class="categories_area clearfix" id="about">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single_catagory wow fadeInUp" data-wow-delay=".3s">
                        <img src="<?= base_url() ?>assets_homepage/img/catagory-img/bdy1.png" alt="" width="400px" height="250px">
                        <div class="catagory-title">
                            <a href="<?= base_url('filterbudaya/1') ?>">
                                <h5>Budaya Jateng</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single_catagory wow fadeInUp" data-wow-delay=".6s">
                        <img src="<?= base_url() ?>assets_homepage/img/catagory-img/bdy2.png" alt="" width="400px" height="250px">
                        <div class="catagory-title">
                            <a href="<?= base_url('filterbudaya/2') ?>">
                                <h5>Budaya Jatim</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single_catagory wow fadeInUp" data-wow-delay=".9s">
                        <img src="<?= base_url() ?>assets_homepage/img/catagory-img/bdy3.png" alt="" width="400px" height="250px">
                        <div class="catagory-title">
                            <a href="<?= base_url('filterbudaya/3') ?>">
                                <h5>Budaya Jabar</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ****** Categories Area End ****** -->

    <!-- ****** Blog Area Start ****** -->
    <section class="blog_area section_padding_0_80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="widget-title text-center">
                    <h6>&nbsp;Lastest Post&nbsp;</h6>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="row">

                        <!-- ******* List Blog Area Start ******* -->

                        <!-- Single Post -->
                        <?php
                        foreach ($kebudayaans as $key => $kebudayaan) :
                        ?>
                            <div class="col-12 mb-4">
                                <div class="list-blog single-post d-sm-flex wow fadeInUpBig" data-wow-delay=".2s">
                                    <!-- Post Thumb -->
                                    <div class="post-thumb">
                                        <img src="<?= base_url() . $kebudayaan["gambar"] ?>" alt="">
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <div class="post-meta d-flex">
                                            <div class="post-author-date-area d-flex">
                                                <!-- Post Author -->
                                                <div class="post-date">
                                                    <span><?= $model->kategori_kebudayaan($kebudayaan["jenis_kebudayaan"]) ?></span>
                                                </div>
                                                <!-- Post Date -->
                                            </div>
                                            <!-- Post Comment & Share Area -->
                                            <div class="post-comment-share-area d-flex">
                                                <!-- Post Share -->
                                            </div>
                                        </div>
                                        <a href="#">
                                            <h4 class="post-headline"><?= $kebudayaan["judul"] ?></h4>
                                        </a>
                                        <p><?= substr($kebudayaan["deskripsi"], 0, 100) ?> ...</p>
                                        <a href="<?= base_url() ?>detailbudaya/<?= $kebudayaan["id"] ?>" class="read-more">Detail Budaya</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach;
                        ?>

                    </div>
                </div>
                <!-- ****** Blog Sidebar ****** -->

            </div>
        </div>
    </section>
    <!-- ****** Blog Area End ****** -->

    <?php $this->load->view('templatepage/foot') ?>
</body>