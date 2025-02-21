@extends('layout.app')
@section('content')





<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Mines</li>
                        <li class="breadcrumb-item">Edit New Mine</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12 col-12">
                    <!-- general form elements -->
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-10 col-9">
                                    <h4>Edit Mine</h4>
                                </div>
                                <div class="col-md-2 col-3">
                                    <a href="{{route('list-mine-managment')}}" class="btn btn btn-primary btn-sm float-right">Mines List</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="{{route('update-mine-managment')}}" method="POST" id="formAuthentication">
                                @csrf
                                <input type="hidden" name="editid" value="{{@$mine->id}}">
                                <div class="row">
                                    <div class="mb-3 col-md-4 col-12">
                                        <label>Mine Name <span class="text-red">*</span>   </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa fa-building"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="mine_name" value="{{@$mine->mine_name }}" placeholder="Mine Name">
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-4 col-12">
                                        <label for="exampleInputPassword1"> Mine Contact <span class="text-red">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fab fa-whatsapp" aria-hidden="true"></i></span>
                                            </div>
                                            <input type="number" class="form-control" id="exampleInputPassword1" name="mine_contact" value="{{@$mine->mine_contact }}" placeholder="Mine Contact">
                                        </div>
                                        @error('mine_contact')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-4 col-12">
                                        <label for="exampleInputPassword1"> Mine Email <span class="text-red">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa fa-envelope"></i></span>
                                            </div>
                                            <input type="email" class="form-control" name="mine_email" value="{{@$mine->mine_email }}" id="exampleInputPassword1" placeholder="Mine Email">
                                        </div>
                                        @error('mine_email')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group  mb-1  col-md-4 col-12">
                                        <label>State</label>
                                        <select class="form-control select2 a3" name="state_id" id="state_id">
                                            <option value="" selected>Select State <span class="text-red">*</span></option>
                                            @foreach($states as $state)
                                            <option value="{{$state->id}}" {{ $state->id == $mine->state_id ? 'selected' : '' }}>{{$state->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group  mb-1  col-md-4 col-12">
                                        <label>City/Village <span class="text-red">*</span></label>
                                        <select class="form-control select2 a3" id="city_id" name="city_id">
                                            <option selected>Select Your City</option>

                                        </select>
                                    </div>




                                    <div class="mb-3 col-md-4 col-12">
                                        <label for="exampleInputPassword1"> Gps Location <span class="text-red">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"></span>
                                            </div>
                                            <input type="text" class="form-control" id="location" name="gps_location" value="{{@$mine->gps_location }}" oninput="getSuggestions()" placeholder="As Per Address Gps Location">
                                        </div>
                                        <ul id="suggestions">
                                        </ul>
                                    </div>



                                    <div class="mb-3 col-md-12 col-12">
                                        <label class="form-label" for="basic-icon-default-message"><i class="fa fa-message"></i>Address
                                        </label>
                                        <textarea id="basic-icon-default-message" class="form-control" aria-describedby="basic-icon-default-message2" name="address" placeholder="Address">{{@$mine->address }} </textarea>
                                    </div>

                                    <div class="form-group mb-3 col-md-3 col-12">
                                        <label>Mine Purchase Date <span class="text-red">*</span></label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="mine_purchase_date" value="{{@$mine->mine_purchase_date }}" placeholder="Date" />
                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <center>

                                    <button type="submit" class="btn btn-success btn-sm mt-3">Submit</button>
                                    <button type="reset" class="btn btn-warning btn-sm mt-3">Reset</button>
                                </center>
                            </form>
                        </div>
                        <!-- /.card-body -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

@endsection
@section('other-scripts')

<script>
    $(document).ready(function() {

        $('#state_id').on('change', function() {
            var state_id = $(this).val();
            var city_id = {{$mine->city_id}};

            $("#city_id").html('');
            $.ajax({
                url: "{{url('get-state-by-cites')}}",
                type: "POST",
                data: {
                    state_id: state_id,
                    "_token": "{{ csrf_token() }}",
                },
                dataType: 'json',
                success: function(result) {
                    $('#city_id').html('<option value="">Select City</option>');
                    $.each(result.cities, function(key, value) {
                        var isSelected = (city_id == value.id) ? 'selected' : '';
                        $("#city_id").append('<option value="' + value.id + '" ' + isSelected + '>' + value.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error cases here if needed
                    console.error(xhr.responseText);
                }
            });
        });
        
        // Trigger the 'change' event on page load to populate the city dropdown.
        $('#state_id').trigger('change');
    });
</script>




<script>
    function getSuggestions() {
        var locationInput = document.getElementById('location').value;
        var service = new google.maps.places.AutocompleteService();

        var suggestionsList = document.getElementById('suggestions');
        suggestionsList.innerHTML = '';

        if (locationInput === '') {
            $('#suggestions').hide(); // Hide suggestions if input is empty
            return;
        }

        service.getPlacePredictions({
            input: locationInput,
            types: ['geocode']
        }, function(predictions, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK && predictions) {
                predictions.forEach(function(prediction) {
                    var li = document.createElement('li');
                    var link = document.createElement('a');
                    link.href = "#";
                    link.textContent = prediction.description;
                    link.addEventListener("click", function() {
                        setLocation(prediction.description);
                        hideScriptCode();
                    });
                    li.appendChild(link);
                    suggestionsList.appendChild(li);
                });
            } else {
                var li = document.createElement('li');
                li.textContent = 'No suggestions found.';
                suggestionsList.appendChild(li);
            }

            $('#suggestions').show(); // Show suggestions after retrieving data
        });
    }

    function setLocation(location) {
        document.getElementById('location').value = location;
    }

    function hideScriptCode() {
        $('#suggestions').hide();
    }
</script>



<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkW__vI2DazIWYjIMigyxwDtc_kyCBVIo&libraries=places"></script>
</script>

@endsection