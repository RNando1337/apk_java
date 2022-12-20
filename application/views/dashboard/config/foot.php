    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih Ya untuk logout</div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="<?= base_url() ?>admin/logout">Ya</a>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <!-- <script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script> -->
    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery/jquery-1.11.0.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script type="text/javascript" src="<?= base_url() ?>assets/js/node_modules/bootstrap4-notify/bootstrap-notify.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- CKEDITOR -->
    <script src="<?= base_url() ?>assets/js/ckeditor4/ckeditor.js"></script>


    <script>
        <?php if (isset($ckeditortrigger)) :
        ?>
            CKEDITOR.replace('editor1', {
                language: 'id',
                toolbar: [{
                        name: 'basicstyles',
                        items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']
                    },
                    {
                        name: 'paragraph',
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv',
                            '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl'
                        ]
                    },
                    {
                        name: 'links',
                        items: ['Link', 'Unlink', 'Anchor']
                    },
                    '/',
                    {
                        name: 'styles',
                        items: ['Styles', 'Format', 'FontSize']
                    },
                    {
                        name: 'colors',
                        items: ['TextColor']
                    },
                    {
                        name: 'tools',
                        items: ['Maximize', 'ShowBlocks']
                    }
                ]
            });
        <?php endif; ?>


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
            $("select").select2();
            var table = $('#budayalist');
            var table2 = $("#adminlist");
            table.DataTable({
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: '<?= base_url() ?>admin/budayajson',
                    type: "POST",
                },
            });

            table2.DataTable({
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: '<?= base_url() ?>admin/adminjson',
                    type: "POST",
                },
            });

            $("#tambahbudaya").on('click', function(e) {
                e.preventDefault();
                var gambar = $('#imgbudaya')[0].files[0];
                var audio = $('#adbudaya')[0].files[0];
                var video = $('#vdbudaya').val();
                var kategori = $('#kategoribudaya').val();
                var deskripsi = $('#deskripsibudaya').val();
                var file = $('#imgbudaya').val().trim();
                var fileaudio = $('#adbudaya').val().trim();
                // var filevideo = $('#vdbudaya').val().trim();
                var judul = $("#judulbudaya").val();

                var datas = new FormData();
                datas.append("gambar", gambar);
                datas.append("audio", audio);
                datas.append("video", video);
                datas.append("kategori", kategori);
                datas.append("deskripsi", deskripsi);
                datas.append("judul", judul);
                console.log(...datas);

                if (file &&
                    fileaudio &&
                    kategori.trim() &&
                    deskripsi.trim() &&
                    judul.trim()) {
                    Swal.fire({
                        title: 'Kamu yakin?',
                        text: "Apa datamu sudah benar!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3c8dbc',
                        cancelButtonColor: '#dd4b39',
                        confirmButtonText: 'Simpan!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '<?= base_url() ?>admin/ajaxaddbudaya',
                                type: "POST",
                                data: datas,
                                contentType: false,
                                processData: false,
                                success: function(data) {
                                    if (data[0]["jenis"] == "success") {
                                        notification(data[0]["pesan"], data[0]["jenis"]);
                                        setTimeout(function() {
                                            window.location.href = '<?= base_url() ?>admin/kebudayaan';
                                        }, 3000);
                                    } else {
                                        notification(data[0]["pesan"], data[0]["jenis"]);
                                    }
                                }
                            });
                        }
                    })
                } else {
                    notification("Form tidak boleh kosong", "danger");
                }

            });

            $("#editbudaya").on('click', function(e) {
                e.preventDefault();
                var kategori = $("#kategoribudaya").val();
                var gambar = $("#gambar")[0].files[0];
                var audio = $("#adbudaya")[0].files[0];
                var deskripsi = $("#deskripsibudaya").val();
                var judul = $("#judulbudaya").val();
                var id = $("#idbudaya").val();
                var gambarhidden = $("#gambarhidden").val();
                var adhidden = $("#adhidden").val();
                var video = $("#vdbudaya").val();
                var datas = new FormData();
                datas.append("id", id);
                datas.append("gambar", gambar);
                datas.append("audio", audio);
                datas.append("kategori", kategori);
                datas.append("deskripsi", deskripsi);
                datas.append("judul", judul);
                datas.append("gambarhidden", gambarhidden);
                datas.append("adhidden", adhidden);
                datas.append("video", video);
                if (kategori.trim() &&
                    deskripsi.trim() &&
                    judul.trim()) {
                    Swal.fire({
                        title: 'Kamu yakin?',
                        text: "Apa datamu sudah benar!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3c8dbc',
                        cancelButtonColor: '#dd4b39',
                        confirmButtonText: 'Simpan!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '<?= base_url() ?>admin/ajaxeditbudaya',
                                type: "POST",
                                data: datas,
                                contentType: false,
                                processData: false,
                                success: function(data) {
                                    // console.log(data);
                                    if (data[0]["jenis"] == "success") {
                                        notification(data[0]["pesan"], data[0]["jenis"]);
                                        setTimeout(function() {
                                            window.location.href = '<?= base_url() ?>admin/kebudayaan';
                                        }, 3000);
                                    } else {
                                        notification(data[0]["pesan"], data[0]["jenis"]);
                                    }
                                }
                            });
                        }
                    })
                } else {
                    notification("Form tidak boleh kosong", "danger");
                }

            });

            $('#budayalist').on('click', "#hapusbudaya", function(e) {
                e.preventDefault();
                var recid = $(this).attr("recid");
                var gambarvalue = $(this).attr("gambarvalue");
                Swal.fire({
                    title: 'Anda yakin ingin menghapus?',
                    text: "Data tidak dapat kembali setelah dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "<?= base_url() ?>admin/deletebudaya",
                            type: "POST",
                            data: {
                                id: recid,
                                gambar: gambarvalue
                            },
                            success: function(data) {
                                if (data["jenis"] == "success") {
                                    notification(data["pesan"], data["jenis"]);
                                    table.DataTable().ajax.reload();
                                } else {
                                    notification(data["pesan"], data["jenis"]);
                                }
                            }
                        })
                    }
                })
            });


            $("#tentangkami").on('click', function(e) {
                e.preventDefault();
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
                var datas = $('#tentangs').serializeArray();
                Swal.fire({
                    title: 'Kamu yakin?',
                    text: "Apa datamu sudah benar!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3c8dbc',
                    cancelButtonColor: '#dd4b39',
                    confirmButtonText: 'Simpan!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?= base_url() ?>admin/ajaxtentangkami',
                            type: "POST",
                            data: datas,
                            success: function(data) {
                                if (data["jenis"] == "success") {
                                    notification(data["pesan"], data["jenis"]);
                                } else {
                                    notification(data["pesan"], data["jenis"]);
                                }
                            }
                        });
                    }
                })
            });

            $("#ubahlogo").on('click', function(e) {
                e.preventDefault();
                var gambar = $('#logo')[0].files[0];
                var datas = new FormData();
                datas.append("gambar", gambar);
                Swal.fire({
                    title: 'Kamu yakin?',
                    text: "Apa datamu sudah benar!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3c8dbc',
                    cancelButtonColor: '#dd4b39',
                    confirmButtonText: 'Simpan!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?= base_url() ?>admin/ajaxeditlogo',
                            type: "POST",
                            data: datas,
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                if (data["jenis"] == "success") {
                                    notification(data["pesan"], data["jenis"]);

                                    setTimeout(function() {
                                        location.reload();
                                    }, 3200);
                                } else {
                                    notification(data["pesan"], data["jenis"]);
                                }
                            }
                        });
                    }
                })
            })

            $("#tambahadmin").on('click', function(e) {
                e.preventDefault();
                var username = $("#usernameadmin").val();
                var level = $("#adminlevel").val();
                $.ajax({
                    url: "<?= base_url() ?>admin/ajaxaddadmin",
                    type: "POST",
                    data: {
                        username: username,
                        level: level
                    },
                    success: function(data) {
                        // console.log(data);
                        if (data["jenis"] == "success") {
                            notification(data["pesan"], data["jenis"]);
                            setTimeout(function() {
                                window.location.href = '<?= base_url() ?>admin/listadmin';
                            }, 3200);
                        } else {
                            notification(data["pesan"], data["jenis"]);
                        }
                    }
                });
            })

            $("#adminlist").on('click', "#hapusadmin", function(e) {
                e.preventDefault();
                var recid = $(this).attr("recid");
                Swal.fire({
                    title: 'Kamu yakin?',
                    text: "Apa datamu sudah benar!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3c8dbc',
                    cancelButtonColor: '#dd4b39',
                    confirmButtonText: 'Simpan!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "<?= base_url() ?>admin/deleteadmin",
                            type: "POST",
                            data: {
                                id: recid
                            },
                            success: function(data) {
                                if (data["jenis"] == "success") {
                                    notification(data["pesan"], data["jenis"]);
                                    table2.DataTable().ajax.reload();
                                } else {
                                    notification(data["pesan"], data["jenis"]);
                                }
                            }
                        });
                    }
                })
            })

            $("#editadmin").on("click", function(e) {
                e.preventDefault();
                var idadmin = $("#idadmin").val();
                var useradmin = $("#useradmin").val();
                var passadmin = $("#passadmin").val();
                var leveladmin = $("#leveladmin").val();
                Swal.fire({
                    title: 'Kamu yakin?',
                    text: "Apa datamu sudah benar!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3c8dbc',
                    cancelButtonColor: '#dd4b39',
                    confirmButtonText: 'Simpan!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "<?= base_url() ?>admin/ajaxeditadmin",
                            type: "POST",
                            data: {
                                id: idadmin,
                                username: useradmin,
                                password: passadmin,
                                level: leveladmin
                            },
                            success: function(data) {
                                if (data["jenis"] == "success") {
                                    notification(data["pesan"], data["jenis"]);
                                    setTimeout(function() {
                                        window.location.href = '<?= base_url() ?>admin/listadmin';
                                    }, 3200);
                                } else {
                                    notification(data["pesan"], data["jenis"]);
                                }
                            }
                        });
                    }
                })
            })


        });
    </script>