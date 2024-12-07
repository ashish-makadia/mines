<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">View Assets</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">  
            <table class="table">
                <tr>
                    <td><strong>Mine:</strong>{{@$data->mine->mine_name}}</td>
                    <td><strong>Assets Catagory:</strong>{{@$data->category->category_name}}</td>
                </tr>
                <tr>
                    <td><strong>Multipal Machine:</strong>
                     {{ $machine_names_str }}</td>
                     <td></td>
                </tr>
            </table>
        </div>
    </div>
</div>