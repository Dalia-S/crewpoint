@section('boatForm')
  <form action="{{route('editProfile.store')}}" method="POST">
    {{ method_field('POST') }}
    {{ csrf_field() }}
    <input name="form" type="hidden" value="boat">
    <div class="form-group">
      <label>Boat Name:</label>
      <input name="username" type="text" class="form-control" value="{{ $user->username }}" required>
      @if($errors->has('username'))
          <span class="help-block">
              <strong>{{ $errors->first('username') }}</strong>
          </span>
      @endif
    </div>
    <div class="form-group">
      <label>Boat type:</label>
      <input name="boat_type" type="text" class="form-control" value="{{ isset($profile['boat_type'])?$profile['boat_type']:'' }}" placeholder="Boat type">
      @if($errors->has('boat_type'))
          <span class="help-block">
              <strong>{{ $errors->first('boat_type') }}</strong>
          </span>
      @endif
    </div>
    <div class="form-group">
      <label>Model:</label>
      <input name="model" type="text" class="form-control" value="{{ isset($profile['model'])?$profile['model']:'' }}" placeholder="Boat model">
      @if($errors->has('model'))
          <span class="help-block">
              <strong>{{ $errors->first('model') }}</strong>
          </span>
      @endif
    </div>
    <div class="form-group">
      <label>Location:</label>
      <input name="location" type="text" class="form-control" value="{{ isset($profile['location'])?$profile['location']:'' }}" placeholder="Boat location">
      @if($errors->has('location'))
          <span class="help-block">
              <strong>{{ $errors->first('location') }}</strong>
          </span>
      @endif
    </div>
    <div class="form-group">
      <label>Type of Sailing:</label>
      <input name="sailing_type" type="text" class="form-control" value="{{ isset($profile['sailing_type'])?$profile['sailing_type']:'' }}" placeholder="e.g. racing or cruising">
      @if($errors->has('sailing_type'))
          <span class="help-block">
              <strong>{{ $errors->first('sailing_type') }}</strong>
          </span>
      @endif
    </div>
    <div class="form-group">
      <label>Usual Crew Size:</label>
      <input name="crew_size" type="text" class="form-control" value="{{ isset($profile['crew_size'])?$profile['crew_size']:'' }}" placeholder="e.g. skipper plus 2 crew">
      @if($errors->has('crew_size'))
          <span class="help-block">
              <strong>{{ $errors->first('crew_size') }}</strong>
          </span>
      @endif
    </div>
    <div class="form-group">
      <label>Contact Person:</label>
      <input name="contact_person" type="text" class="form-control" value="{{ isset($profile['contact_person'])?$profile['contact_person']:'' }}" placeholder="Crew Point account owner">
      @if($errors->has('contact_person'))
          <span class="help-block">
              <strong>{{ $errors->first('contact_person') }}</strong>
          </span>
      @endif
    </div>
    <div class="form-group" id="saved">
      <label>Profile Status</label>
      <select name="status" class="form-control">
        <option value="Active" @if($user->status=='Active') selected @endif>Active</option>
        <option value="Inactive" @if($user->status=='Inactive') selected @endif>Inactive</option>
        <option value="Hidden" @if($user->status=='Hidden') selected @endif>Hidden</option>
      </select>
    </div>
    <button type="submit" class="btn btn-outline-primary editProfileButton">Save Changes</button>
    @if(Session::has('status'))
      <p class="alert alert-success">{{ session('status') }}</p>
    @endif
  </form>
@stop
