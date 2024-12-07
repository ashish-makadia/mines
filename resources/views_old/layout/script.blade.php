<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<!-- <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script> -->
<!-- Sparkline -->
<!-- <script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script> -->
<!-- JQVMap -->
<!-- <script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script> -->


<!-- Summernote -->
<!-- <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script> -->

<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- jquery-validation -->
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>

<!-- overlayScrollbars -->
<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<!--    <script src="{{ asset('assets/dist/js/demo.js') }}"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script> -->
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/datepicker/bootstrap-datepicker.min.js') }}"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- ----toster message---- -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<!-- <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>
  @if(Session::has('message'))
  toastr.options = {
    "closeButton": true,
    "progressBar": true
  }
  toastr.success("{{ session('message') }}");
  @endif
  @if(Session::has('error'))
  toastr.options = {
    "closeButton": true,
    "progressBar": true
  }
  toastr.error("{{ session('error') }}");
  @endif
</script>

<script>
  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4'
    });

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });


    $('#reservationdate1').datetimepicker({
      format: 'DD-MM-YYYY',
    });

    $('#reservationdate').datetimepicker({
      format: 'DD-MM-YYYY',
    });

    $('#reservationdate input').focus(function() {
        $(this).parent().datetimepicker('show');
    });
    $(".employee_datepicker").datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#reservationdate1 input').focus(function() {
        $(this).parent().datetimepicker('show');
    });
  });
  $(document).on('click', '[data-dismiss="modal"]', function(){
      console.log("fsgdsgds");


    $('input').val("");
    $('textarea').val("");
    $('select').val("").trigger('change');
  })

  $( '.modal' )
   .on('hide', function() {
       console.log('hide');
   })
   .on('hidden', function(){
       console.log('hidden');
   })
   .on('show', function() {
       console.log('show');
   })
   .on('shown', function(){
      console.log('shown' )
   });

  $( '#modal' )
   .on('hide', function() {
       console.log('hide');
   })
  $(document).on('hide.bs.modal','.modal-body form', function () {
      console.log("Hello");

  });

//   $("#issued_assets").on("change", function() {
    function getAssets(val,assets_id){
            // var val = $(this).val();
            $.ajax({
                url: "{{ route('get-assets-name') }}",
                type: 'get',
                dataType: 'json',
                data: {
                    category: val
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data.machineryAssets) {
                        html = '<option value="">Select Assets</option>'
                        $.each(data.machineryAssets, function(index, value) {
                            html += `<option value=${value.id}>${value.machine_name}</option>`;
                        });
                        console.log(html,$(".assets_name"),assets_id);
                        $(".assets_name").html(html);
                        if(assets_id>0){
                            $('.assets_name').val(assets_id).trigger('change');
                            getAssetsData(assets_id);
                        }


                    }
                }

            })
        }
        // $("#assets_name").on("change", function() {
            function getAssetsData(id){
            $.ajax({
                url: "{{ route('get-assets-data') }}",
                type: 'get',
                dataType: 'json',
                data: {
                    id: id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data.machineryAssets) {
                        qty = data.machineryAssets.remaining_quantity;
                        $(".assign_qty").val(qty)
                        // $(".quantity").attr("max", qty);
                        // $(".quantity").val(qty);

                        // var pend_qty = qty - parseFloat($(".quantity").val())
                        // $(".pending_quantity").val((pend_qty > 0 ? pend_qty : 0))
                        // $(".pending_quantity").attr("max", (pend_qty > 0 ? pend_qty : 0));
                    }

                }
            });
        }
</script>

