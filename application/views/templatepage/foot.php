    <!-- ****** Footer Menu Area Start ****** -->
    <footer class="footer_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-content">

                        <!-- Menu Area Start -->
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#yummyfood-footer-nav" aria-controls="yummyfood-footer-nav" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars" aria-hidden="true"></i> Menu</button>
                            <!-- Menu Area Start -->
                            <div class="collapse navbar-collapse justify-content-center" id="yummyfood-footer-nav">
                                <ul class="navbar-nav">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="<?= base_url() ?>">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url() ?>daftarbudaya">Daftar Budaya</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url() ?>tentangkami">Tentang Kami</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link" href="#">Kontak</a>
                                    </li> -->
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Copywrite Text -->
                    <div class="copy_right_text text-center">
                        <p>Copyright @2022 APK-Java</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- ****** Footer Menu Area End ****** -->

    <!-- Jquery-2.2.4 js -->
    <script src="<?= base_url() ?>assets_homepage/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="<?= base_url() ?>assets_homepage/js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap-4 js -->
    <script src="<?= base_url() ?>assets_homepage/js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins JS -->
    <script src="<?= base_url() ?>assets_homepage/js/others/plugins.js"></script>
    <!-- Active JS -->
    <script src="<?= base_url() ?>assets_homepage/js/active.js"></script>
    <!-- Core plugin JavaScript-->
    <script type="text/javascript" src="<?= base_url() ?>assets/js/node_modules/bootstrap4-notify/bootstrap-notify.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <script>
        function notification(pesan, jenis) {
            if (jenis == 'success') {
                var bgcolor = '#00a65a';
                var color = '#fff';
                var jenis = jenis;
            } else if (jenis == 'danger') {
                var bgcolor = '#dd4b39';
                var color = '#fff';
                var jenis = jenis;
            } else if (jenis == 'warning') {
                var bgcolor = '#f39c12';
                var color = '#fff';
                var jenis = jenis;
            } else if (jenis == 'info') {
                var bgcolor = '#3c8dbc';
                var color = '#fff';
                var jenis = jenis;
            } else {
                var bgcolor = '#d2d6de';
                var color = '#000';
                var jenis = 'success';
            }
            $.notify(pesan, {
                align: "right",
                verticalAlign: "top",
                type: jenis,
                progress: 3,
                width: "400px",
            });
        }

        $(document).ready(function() {
            $("#audio").on("click", function(e) {
                e.preventDefault();
                var audio = $(this).attr("link");
                $("#modalcontent").modal("show");
                $("#modalcontent").find('.modal-title').text("Versi Audio")
                $("#modalcontent").find('.modal-body').append(`
                <center>
                <audio controls>
                    <source src="<?= base_url() ?>${audio}" type="audio/mpeg">
                </audio>
                </center>
                `)
            });
            $("#video").on("click", function(e) {
                e.preventDefault();
                var video = $(this).attr("link");
                $("#modalcontent").modal("show");
                $("#modalcontent").find('.modal-title').text("Versi Video");
                $("#modalcontent").find('.modal-body').append(`
                <center>
                <iframe width="560" height="315" src="${video}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                </iframe>
                </center>
                `)
            });
            $(".modal").on("hidden.bs.modal", function() {
                $(".modal-body").html("");
            });
            // $(".modal #tutup").on("click", function(e) {
            //     e.preventDefault();
            //     // console.log(2);
            //     console.log($("#modalcontent").find(".modal-body"));
            //     $("#modalcontent").find(".modal-body").html("");
            // })
            $("#button_komen").on("click", function(e) {
                e.preventDefault();
                var parent_komen = $("#parent_id").val();
                var komen_name = $("#komen-name").val();
                var komen_msg = $("#komen-message").val();
                var datas = new FormData();
                datas.append("id_budaya", <?= $this->uri->segment('2'); ?>)
                datas.append("name", komen_name);
                datas.append("msg", komen_msg);
                datas.append("parent_id", parent_komen);
                $.ajax({
                    url: '<?= base_url() ?>homepage/ajaxKomen',
                    type: "POST",
                    data: datas,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data["jenis"] == "success") {
                            notification(data["pesan"], data["jenis"]);
                            setTimeout(function() {
                                location.reload();
                            }, 3400);
                        } else {
                            notification(data["pesan"], data["jenis"]);
                        }
                    }
                })
            });

            $.fn.getparent = function($id) {
                $("#parent_id").val($id);
            }
        });
    </script>