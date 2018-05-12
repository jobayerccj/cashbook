<script type="text/javascript">
	var base_url = {!! json_encode(url('/')) !!};
</script>
<!-- Scripts -->


<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('public/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('public/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('public/plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/dist/js/app.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('public/dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/dist/js/demo.js') }}"></script>
<script src="{{ asset('public/plugins/bootbox/bootbox.min.js') }} " type="text/javascript"></script>

<!-- DataTables -->
<script src="{{ asset('public/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

<!-- SweetAlert -->
<script src="{{ asset('public/plugins/sweetalert/sweetalert.min.js') }}"></script>
<link href="{{ asset('public/plugins/tabdrop/css/tabdrop.css') }}" rel="stylesheet">

<script src="{{ asset('public/plugins/tabdrop/js/bootstrap-tabdrop.js') }}"></script>
<script src="{{ asset('public/js/common.js') }}"></script>
</body>
</html>
