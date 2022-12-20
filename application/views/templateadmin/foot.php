   <!-- Bootstrap core JavaScript-->
   <!-- <script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script> -->
   <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery/jquery-1.11.0.min.js"></script>
   <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

   <!-- Core plugin JavaScript-->
   <script type="text/javascript" src="<?= base_url() ?>assets/js/node_modules/bootstrap4-notify/bootstrap-notify.min.js"></script>
   <script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

   <!-- Custom scripts for all pages-->
   <script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>


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
           $("#loginadmin").on('click', function(e) {
               e.preventDefault();
               var user = $("#useradmin").val();
               var pass = $("#passadmin").val();
               $.ajax({
                   url: "<?= base_url() ?>admin/ajaxlogin",
                   type: "POST",
                   data: {
                       username: user,
                       password: pass
                   },
                   success: function(data) {
                       if (data["jenis"] == "success") {
                           notification(data["pesan"], data["jenis"]);
                           setTimeout(function() {
                               window.location.href = '<?= base_url() ?>admin/dashboard';
                           }, 3000);
                       } else {
                           notification(data["pesan"], data["jenis"]);
                       }
                   }
               });
           });
       });
   </script>