@section('crewForm')
  <form action="{{route('editProfile.store')}}" method="POST">
    {{ method_field('POST') }}
    {{ csrf_field() }}
    <input name="form" type="hidden" value="crew">
    <div class="form-group">
      <label>Username:</label>
      <input name="username" type="text" class="form-control" value="{{ $user->username }}" required>
      @if($errors->has('username'))
          <span class="help-block">
              <strong>{{ $errors->first('username') }}</strong>
          </span>
      @endif
    </div>
    <div class="form-group">
      <label>Name:</label>
      <input name="name" type="text" class="form-control" value="{{ $user->name }}" placeholder="Your full name">
      @if($errors->has('name'))
          <span class="help-block">
              <strong>{{ $errors->first('name') }}</strong>
          </span>
      @endif
    </div>
    <div class="form-group">
      <label>Age:</label>
      <input name="age" type="text" class="form-control" value="{{ isset($profile['age'])?$profile['age']:'' }}" placeholder="Your age">
      @if($errors->has('age'))
          <span class="help-block">
              <strong>{{ $errors->first('age') }}</strong>
          </span>
      @endif
    </div>
    <div class="form-group">
      <label>Location:</label>
      <input name="location" type="text" class="form-control" value="{{ isset($profile['location'])?$profile['location']:'' }}" placeholder="Your location">
      @if($errors->has('location'))
          <span class="help-block">
              <strong>{{ $errors->first('location') }}</strong>
          </span>
      @endif
    </div>
    <div class="form-group">
      <label>Qualification:</label>
      <input name="qualification" type="text" class="form-control" value="{{ isset($profile['qualification'])?$profile['qualification']:'' }}" placeholder="Your qualification">
      @if($errors->has('qualification'))
          <span class="help-block">
              <strong>{{ $errors->first('qualification') }}</strong>
          </span>
      @endif
    </div>
    <fieldset class="form-group radio">
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input radio-button" name="miles" value="show" @if(isset($profile['miles']) && $profile['miles'] == 'show') checked @endif required>
          Show total miles logged
        </label>
      </div>
      <div class="form-check">
      <label class="form-check-label">
          <input type="radio" class="form-check-input radio-button" name="miles" value="hide" @if(isset($profile['miles']) && $profile['miles'] == 'hide') checked @endif>
          Hide total miles logged
        </label>
      </div>
    </fieldset>
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
