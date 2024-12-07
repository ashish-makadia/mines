<div class="form-group d-flex justify-content-between">
    <label class="pt-2">Role Name</label>
    <div class="flex-grow-1 ms-1"><span class="form-control">{{ $result->name }}</span></div>
    <div class="">
        <button type="button" class="btn btn-warning pull-right ms-1" id="btn-unSelectAll">Unselect All</button>
        <button type="button" class="btn btn-primary pull-right ms-1" id="btn-selectAll">Select All</button>
    </div>
</div>

@foreach ($permissions as $key => $role)
<div class="form-group">
    <div class="alert alert-info" style="margin-top:20px" role="alert">
        <input type="checkbox" class="i-checks select_module chk-header parent-{{$key}}" data-chk="{{ $key }}" name="">
        <h4 class="ms-2" style="display:inline-block">{{ strtoupper($key) }}</h4>
    </div>
{{-- {{dd($permissions)}} --}}
    <div class="d-flex justify-content-around flex-wrap">
        @foreach ($role as $permission)
        <div class="mt-4 w-25 text-center">
            <input type="checkbox" class="i-checks chk-activePermissions {{ $key }}-permission data-{{ $key }}"
                name="permission[]" data-role="{{ $key }}"" value=" {{ $permission->id }}"
                {{ ($permissions->contains('id', $permission->id)) ? "checked" : "" }}>
            <label class="ms-2">{{ $permission->display_name}} </label>
            <div class="help-block">({{ $permission->description}})</div>
        </div>
        @endforeach
    </div>
</div>
@endforeach

<hr>

@push("scripts")
<script type="module">
    $(document).ready(() => {
            //SELECT All
            // $(document).on("click", "#btn-selectAll", function(event) {
            //     $(".chk-activePermissions").iCheck("check");
            //     $(".select_module").iCheck("check");
            // });

            //Unselect All
            $(document).on("click", "#btn-unSelectAll", function(event) {
                $(".chk-activePermissions").iCheck("uncheck");
                $(".select_module").iCheck("uncheck");
            });

            //toogle checkbox for module
            $(".select_module").on("click", function(event) {
                var role = $(this).data("chk");

                if ($(this).is(":checked")) {
                    $(`.${role}-permission`).prop("checked",true);
                    // $(`.${role}-permission`).iCheck("check");
                } else {
                    $(`.${role}-permission`).prope("checked",false);
                }
            });



           const selectCheckboxes = function(role) {
                let allckedbox = $(`.data-${role}`).length;
                let checkedbox = $(`.data-${role}:checked`).length;

                if (allckedbox == checkedbox) $(".parent-" + role).iCheck("check");
            }
            $(".select_module").each(function(index) {
                selectCheckboxes($(this).data("chk"));
            });
        });
</script>
@endpush
