<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Meter Reading</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {{-- {{dd($assign_assets)}} --}}
        <div class="modal-body">
            <form action="{{route('wiresaw.update', $wire_saw->id)}}" method="post" enctype="multipart/form-data" id="editassign">
                @csrf
                @method('PATCH')
                @include('admin.wiresaw._form')
            </form>
        </div>
    </div>
</div>
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
                mala_size: {
                    required: true,
                },
                volume: {
                    required:true
                },
                quantity: {
                    required: true,
                },
                
            },
            messages: {
                mala_size: {
                    required: "Please Enter Mala Size.",
                },
                volume: {
                    required: "Please Enter Volume.",
                },
               
                quantity: {
                    required: "Please Enter quantity.",
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

$('.reservationdate1').datetimepicker({
    format: 'DD-MM-YYYY',
  });

</script>
