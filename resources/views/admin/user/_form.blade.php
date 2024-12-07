<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <div class="input-group mb-3">
        <input type="text" placeholder="Enter name" class="form-control" value={{isset($result)?$result->name:old("name")}} name="name" id="name" required>
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-user"></span>
          </div>
        </div>
      </div>
      <div class="input-group mb-3">
        <input type="email" name="email" class="form-control" value={{isset($result)?$result->email:old("email")}} placeholder="Email">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
      </div>
      <div class="input-group mb-3">
        <select class="form-control select2 a3" name="role_id" required>
            <option value="">Select Role</option>
            @foreach($roles as $data)
            <option value="{{$data->id}}" {{ isset($result) && $result->role_id == $data->id ? 'selected' : '' }}>{{$data->name}}</option>

            @endforeach
        </select>
      </div>
      @if(!isset($result) && !isset($result->id))
      <div class="input-group mb-3">
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>
      <div class="input-group mb-3">
        <input type="password"  class="form-control" placeholder="Repeat Password" name="c_password" id="psw-repeat" required>
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>
      @endif
    </div>
</div>
<div class="col-md-3"></div>

