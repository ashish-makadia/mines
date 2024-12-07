@extends('layout.app')
@section('title', 'Create ' . $module_name)
@section('content')
    @push('styles')
    @endpush
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if (isset($module_name))
                            <h5>Create {{ $module_name }}</h5>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        @if (isset($newPermissions) && count($newPermissions) > 0)
                            <button class="btn btn-sm btn-success me-2" id="btn-save">Save</button>
                            {{-- <button class="btn btn-sm btn-primary me-2" id="btn-unSelectAll">Unselect All</button> --}}
                            {{-- <button class="btn btn-sm btn-primary" id="btn-selectAll">Select All</button> --}}
                            <label class="form-check-label me-1" for="flexCheckDefault">
                                <input class="i-checks" type="checkbox" id="btn-selectOrUnselect" />
                                Select All
                            </label>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped w-100" id="newPermissions">
                                <thead>
                                    <tr>
                                        <th>Permission Name</th>
                                        <th>Display Name</th>
                                        <th>Description</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="module">
    $(document).ready(function () {
    $('#newPermissions').DataTable({
        data: {!! $newPermissions !!},
        columns: [
            { data: 'name' },
            { data: 'display_name' },
            { data: 'description' },
            {
                data:  null,
                orderable: false,
                searchable: false,
                responsivePriority: 1,
                targets: 0,
                className:"text-center",
                render:function(o){
                    return '<input class="i-checks chk-permissions" value="' + o.name + '" type="checkbox">'
                }
            }
        ],
        paginate: false,
        autoWidth: false,
        responsive: true
    });

    // $('.i-checks').iCheck({
    //     checkboxClass: 'icheckbox_square-green',
    //     radioClass: 'iradio_square-green',
    // });

    //Select and unSelectAll
    // ifChanged, ifClicked
    $("#btn-selectOrUnselect").on('click', function (e) {
        if(!$(this).is(':checked'))
        {
            // $(".chk-permissions").prop("checked", true);
            $(".chk-permissions").attr('checked',false);
        }
        else{
            // $(".chk-permissions").prop("checked", false);
		    $(".chk-permissions").attr('checked',true);
        }
});
    $('#newPermissions input[type=checkbox]').on('ifChanged', function(){
        console.log('object',!$(this).is(':checked'));
        if (!$(this).is(':checked')) {
            $('#btn-selectOrUnselect').iCheck('uncheck');
        }
});

    $(document).on('click', '#btn-save', function(event) {
        event.preventDefault();
        var permissions = [];
        $(".chk-permissions").each(function(index, el) {
            if(el.checked) {
                permissions.push(el.value.trim());
            }
        });

        if(permissions.length) {
            $.ajax({
                type: "POST",
                url: "{{ route("{$module_route}.store") }}",
                dataType: 'json',
                data : {names : permissions},
                headers: {
                    "X-CSRF-TOKEN":"{{ csrf_token() }}"
                },
                success: function (data) {
                    toastr.success('Permissions added successfully');
                    removeRowFromDatatableAfterStorePermission();
                },
                error: function (xhr, status, error) {
                    toastr.error(error);
                }
            });
        }
        else {
            toastr.error('Please select at least one permissions');
        }
    });


    function removeRowFromDatatableAfterStorePermission() {
        $(".chk-permissions").each(function(index, el) {
            if(el.checked) {
                el.closest('tr').remove();
            }
        });
    }
});
</script>
@endpush
