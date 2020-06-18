<!-- /.content-wrapper -->
<footer class="main-footer">
  <?php
    $copyYear=2019;
    $curYear= date ('Y');
  ?>
  <strong>Copyright &copy; <?php  echo $copyYear. (($copyYear !=$curYear) ? '-'. $curYear: ''); ?>  <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 3.0.5
  </div>
</footer>
