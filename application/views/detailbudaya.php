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
                        <h2>Detail Budaya</h2>
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
                            <li class="breadcrumb-item active" aria-current="page">Detail Budaya</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ****** Breadcumb Area End ****** -->

    <!-- ****** Single Blog Area Start ****** -->
    <section class="single_blog_area section_padding_80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="row no-gutters">


                        <!-- Single Post -->
                        <div class="col-10 col-sm-11">
                            <div class="single-post">
                                <!-- Post Thumb -->

                                <div class="post-thumb">
                                    <img src="<?= base_url() . $datas[0]["gambar"]; ?>" alt="">
                                </div>
                                <!-- Post Content -->
                                <div class="post-content">
                                    <div class="post-meta d-flex">
                                        <div class="post-author-date-area d-flex">
                                            <!-- Post Author -->
                                            <div class="post-author">
                                                <a><?= $model->kategori_kebudayaan($datas[0]["jenis_kebudayaan"]) ?></a>
                                            </div>
                                            <!-- Post Date -->
                                            <div class="post-date">
                                                <a><?= $model->tgl_indo($datas[0]["tanggal"]) ?></a>
                                            </div>
                                        </div>
                                        <!-- Post Comment & Share Area -->
                                        <div class="post-comment-share-area d-flex">
                                            <!-- Post Share -->
                                        </div>
                                    </div>
                                    <a href="#">
                                        <h2 class="post-headline"><?= $datas[0]["judul"] ?></h2>
                                    </a>
                                    <p><?= $datas[0]["deskripsi"] ?></p>


                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-info mr-2" link="<?= $datas[0]["audio"] ?>" id="audio">
                                            Belajar Budaya Dengan Audio
                                        </button>

                                        <button type="button" class="btn btn-info" link="<?= $datas[0]["video"] ?>" id="video">
                                            Belajar Budaya Dengan Video
                                        </button>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade bd-example-modal-lg" id="modalcontent" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="tutup" class="btn btn-warning" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Comment Area Start -->
                            <div class="comment_area section_padding_50 clearfix">
                                <h4 class="mb-30"><?= $model->total_komentar($this->uri->segment('2')) ?> Comments</h4>

                                <ol>

                                    <?php
                                    // var_dump($komentars);
                                    foreach ($komentars as $komen) :
                                    ?>
                                        <li class="single_comment_area">
                                            <div class="comment-wrapper d-flex">
                                                <!-- Comment Meta -->
                                                <div class="comment-author">
                                                    <img src="<?= base_url() ?>assets_homepage/img/profile-img/profile.png" alt="">
                                                </div>
                                                <!-- Comment Content -->
                                                <div class="comment-content">
                                                    <span class="comment-date text-muted"><?= $model->tgl_indo($komen->tanggal) ?></span>
                                                    <h5><?= $komen->nama ?></h5>
                                                    <p><?= $komen->deskripsi ?></p>
                                                    <a onclick="$(this).getparent('<?= $komen->id ?>')" class="active" href="#komen">Reply</a>
                                                </div>
                                            </div>
                                            <!-- loop -->
                                            <ol class="children">
                                                <?php
                                                $counts = $model->counter_comment($komen->id);
                                                if (sizeof($counts) > 0) :
                                                    foreach ($counts as $reply) :
                                                ?>
                                                        <li class="single_comment_area">
                                                            <div class="comment-wrapper d-flex">
                                                                <!-- Comment Meta -->
                                                                <div class="comment-author">
                                                                    <img src="<?= base_url() ?>assets_homepage/img/profile-img/profile.png" alt="">
                                                                </div>
                                                                <!-- Comment Content -->
                                                                <div class="comment-content">
                                                                    <span class="comment-date text-muted"><?= $model->tgl_indo($reply->tanggal) ?></span>
                                                                    <h5><?= $reply->nama ?></h5>
                                                                    <p><?= $reply->deskripsi ?></p>
                                                                    <a onclick="$(this).getparent('<?= $komen->id ?>')" class="active" href="#komen">Reply</a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </ol>
                                            <!-- end loop -->
                                        </li>
                                    <?php
                                    endforeach;
                                    ?>
                                </ol>
                            </div>

                            <!-- Leave A Comment -->
                            <div class="leave-comment-area section_padding_50 clearfix">
                                <div class="comment-form" id="komen">
                                    <h4 class="mb-30">Leave A Comment</h4>

                                    <!-- Comment Form -->
                                    <form id="form_komen" method="post">
                                        <input type="hidden" id="parent_id">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="komen-name" placeholder="Name">
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" name="message" id="komen-message" cols="30" rows="10" placeholder="Message"></textarea>
                                        </div>
                                        <button id="button_komen" type="submit" class="btn contact-btn">Post Comment</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ****** Single Blog Area End ****** -->

    <?php $this->load->view('templatepage/foot') ?>
</body>