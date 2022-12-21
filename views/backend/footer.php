<footer class="main-footer text-center">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.1.0
  </div>
  <strong>Copyright &copy; 2014-2022 <a href="https://facebook.com/dvv1208"> Võ Văn Dương </a>.</strong> Đã đăng ký bản quyền.
</footer>


<script src="../public/plugins/jquery/jquery.min.js"></script>
<script src="../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../public/js/jquery.dataTables.min.js"></script>
<script src="../public/dist/js/adminlte.min.js"></script>
<!-- <script src="../public/dist/js/demo.js"></script> -->


<!--   Core JS Files   -->
<script src="../public/assets/js/core/popper.min.js"></script>
<script src="../public/assets/js/core/bootstrap.min.js"></script>
<script src="../public/assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../public/assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="../public/assets/js/plugins/chartjs.min.js"></script>

<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../public/assets/js/soft-ui-dashboard.min.js?v=1.0.6"></script>

</body>

</html>