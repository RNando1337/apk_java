<?php $this->load->view('templatepage/head') ?>

<body>
    <?php
    $this->load->view('templatepage/header')
    ?>

    <!-- ****** Breadcumb Area Start ****** -->
    <div class="breadcumb-area" style="background-image: url(../assets_homepage/img/bg-img/batik.png);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="bradcumb-title text-center">
                        <h2><?= $model->kategori_kebudayaan($id)  ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="breadcumb-nav">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Daftar Budaya</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ****** Breadcumb Area End ****** -->

    <!-- ****** Archive Area Start ****** -->
    <section class="archive-area section_padding_80">
        <div class="container">
            <div class="row">

                <?php
                foreach ($budayas as $budaya) :
                    // print_r($budaya);
                ?>
                    <!-- Single Post -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="single-post wow fadeInUp" data-wow-delay="0.1s">
                            <!-- Post Thumb -->
                            <div class="post-thumb">
                                <img src="<?= base_url() . $budaya->gambar ?>" alt="">
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <div class="post-meta d-flex">
                                    <div class="post-author-date-area d-flex">
                                        <!-- Post Author -->
                                        <div class="post-author">
                                            <span><?= $model->kategori_kebudayaan($budaya->jenis_kebudayaan) ?></span>
                                        </div>
                                        <!-- Post Date -->
                                    </div>
                                    <!-- Post Comment & Share Area -->
                                    <div class="post-comment-share-area d-flex">
                                        <!-- Post Share -->
                                    </div>
                                </div>
                                <a href="<?= base_url() ?>detailbudaya/<?= $budaya->id ?>">
                                    <h4 class="post-headline"><?= $budaya->judul ?></h4>
                                </a>
                            </div>
                        </div>
                    </div>

                <?php
                endforeach;
                ?>

                <div class="col-12">
                    <div class="pagination-area d-sm-flex mt-15">
                        <nav aria-label="#">
                            <ul class="pagination">
                                <?php
                                echo $this->pagination->create_links();
                                ?>
                                <!-- <li class="page-item active">
                                    <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                </li> -->
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ****** Archive Area End ****** -->

    <?php $this->load->view('templatepage/foot') ?>
</body>