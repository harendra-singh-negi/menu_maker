@extends('user.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Call Waiter</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{route('user.dashboard')}}">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Settings</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Call Waiter</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Call Waiter Status</div>
        </div>
        <div class="card-body pt-5 pb-4">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form  enctype="multipart/form-data" action="{{route('user.call.waiter.update')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="row text-center">
                        <div class="col-lg-12">
                           <div class="form-group">
                             <span class="text-warning">To make this feature work, setup pusher credentials from <strong><a href="{{ route('user.plugins') }}" target="_blank"><span class="text-primary">Settings > Plugins</span></a></strong></span>
                           </div>
                        </div>
                    </div>
                  <div class="col-lg-12">
                    @if(!empty($packagePermissions) && in_array('QR Menu',$packagePermissions))
                    <div class="form-group">
                        <label>In QR Menu</label>
                        <div class="selectgroup w-100">
                           <label class="selectgroup-item">
                            <input type="radio" name="qr_call_waiter" value="1" class="selectgroup-input" {{$userBs->qr_call_waiter == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Active</span>
                           </label>
                           <label class="selectgroup-item">
                            <input type="radio" name="qr_call_waiter" value="0" class="selectgroup-input" {{$userBs->qr_call_waiter == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Deactive</span>
                           </label>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label>In Website</label>
                        <div class="selectgroup w-100">
                           <label class="selectgroup-item">
                            <input type="radio" name="website_call_waiter" value="1" class="selectgroup-input" {{$userBs->website_call_waiter == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Active</span>
                           </label>
                           <label class="selectgroup-item">
                            <input type="radio" name="website_call_waiter" value="0" class="selectgroup-input" {{$userBs->website_call_waiter == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Deactive</span>
                           </label>
                        </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  <div class="form">
                    <div class="form-group from-show-notify row">
                      <div class="col-12 text-center">
                        <button type="submit" class="btn btn-success">Update</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
