<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Assign Assets</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {{-- {{dd($assign_assets)}} --}}
        <div class="modal-body">
            <form action="{{route('assets-assign.update', $assign_assets->id)}}" method="post" enctype="multipart/form-data" id="editassign">
                @csrf
                @method('PATCH')
                @include('admin.sale_assets._form')
            </form>
        </div>
    </div>
</div>
@section("other_scripts")
<script>
    $(function () {
        $.validator.setDefaults({
            submitHandler: function (form) {
                // Your AJAX code to submit the form can go here
                form.submit();
            }
        });

        $('#editassign').validate({
            rules: {
                sales_date: {
                    required: true,
                },
                assets_type: {
                    required:true
                },
                assets_category: {
                    required: true,
                },
                asset_type: {
                    required: true,
                },
                assets_name: {
                    required: true,
                },
                transfer_mine_name: {
                    required: true,
                },
                quantity: {
                    required: true,
                },
            },
            messages: {
                sales_date: {
                    required: "Please select a date of sale.",
                },
                assets_type: {
                    required: "Please select a assets type.",
                },
                assets_name: {
                    required: "Please Enter Asset name.",
                },
                quantity: {
                    required: "Please Enter quantity.",
                },
                transfer_mine_name: {
                    required: "Please Enter transfer mine name.",
                },
                assets_category: {
                    required: "Please select an asset category.",
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });

$('.reservationdate').datetimepicker({
    format: 'DD-MM-YYYY',
  });

</script>
@endsection
