<!-- {{-- Display success message if it exists --}}
@if (session()->has('alert-success'))
<div class="container">
    <div class="alert alert-success m-2 alert-dismissible" role="alert" id="success-alert">
        {{ session()->get('alert-success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

{{-- Your other error message handling code --}}
@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="container">
    <div class="alert alert-danger m-2 alert-dismissible" role="alert">
        {{ $error }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endforeach

<script>
    // JavaScript code to automatically hide error messages after a few seconds
    // Adjust the delay (in milliseconds) to control how long the messages stay visible
    document.addEventListener('DOMContentLoaded', function() {
        var errorAlerts = document.querySelectorAll(".alert-danger");
        if (errorAlerts) {
            errorAlerts.forEach(function(errorAlert) {
                setTimeout(function() {
                    errorAlert.style.display = 'none';
                }, 5000); // 5000 milliseconds = 5 seconds
            });
        }
    });
</script>
@endif

@foreach (['info', 'warning', 'danger'] as $message)
@if (session()->has('alert-' . $message))
<div class="container">
    <div class="alert alert-{{ $message }} m-2 alert-dismissible" role="alert">
        {{ session()->get('alert-' . $message) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif
@endforeach

<style>
    .m-2 {
        margin-left: 143px !important;
        width: 1093px !important;
    }
</style>

<script>
    // JavaScript code to automatically hide both success and error messages after a few seconds
    // Adjust the delay (in milliseconds) to control how long the messages stay visible
    document.addEventListener('DOMContentLoaded', function() {
        var successAlert = document.getElementById('success-alert');
        if (successAlert) {
            setTimeout(function() {
                successAlert.style.display = 'none';
            }, 5000); // 5000 milliseconds = 5 seconds
        }


    });
</script> -->

<!-- 
@if ($errors->any())
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @foreach ($errors->all() as $error)
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit"></i>
                        Error
                    </h3>
                </div>
                <div class="card-body">
                    {{ $error }}
                    <button type="button" class="btn btn-danger toastrDefaultError">
                        Launch Error Toast
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif -->


@if ($errors->any())
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}');
            @endforeach
        });
    </script>
@endif