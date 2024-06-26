@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{__('Features')}}</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{route('admin.dashboard')}}">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{__('Home Page')}}</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{__('Features')}}</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card-title d-inline-block">{{__('Features')}}</div>
                </div>
                <div class="col-lg-3">
                    @if (!empty($langs))
                        <select name="language" class="form-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                            <option value="" selected disabled>{{__('Select a Language')}}</option>
                            @foreach ($langs as $lang)
                                <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
                    <a href="#" class="btn btn-primary float-lg-right float-left" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i> {{__('Add Feature')}}</a>
                </div>
            </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              @if (count($features) == 0)
                <h3 class="text-center">{{__('NO FEATURE FOUND')}}</h3>
              @else
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('Image')}}</th>
                        <th scope="col">{{__('Title')}}</th>
                        <th scope="col">{{__('Text')}}</th>
                        <th scope="col">{{__('Serial Number')}}</th>
                        <th scope="col">{{__('Actions')}}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($features as $key => $feature)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>
                              <img src="{{!empty($feature->image) ? asset('assets/front/img/features/'.$feature->image) : asset('assets/admin/img/noimage.jpg')}}" alt="" width="50">
                          </td>
                          <td>{{$feature->title}}</td>
                          <td>{{$feature->text}}</td>
                          <td>{{$feature->serial_number}}</td>
                          <td>
                            <a class="btn btn-secondary my-2 btn-sm" href="{{route('admin.feature.edit', $feature->id) . '?language=' . request()->input('language')}}">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                           
                            </a>
                            <form class="deleteform d-inline-block" action="{{route('admin.feature.delete')}}" method="post">
                              @csrf
                              <input type="hidden" name="feature_id" value="{{$feature->id}}">
                              <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                <span class="btn-label">
                                  <i class="fas fa-trash"></i>
                                </span>
                               
                              </button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">{{__('Add Feature')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="ajaxForm" class="modal-form" action="{{route('admin.feature.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="">{{__('Language')}} **</label>
                <select name="language_id" class="form-control">
                    <option value="" selected disabled>{{__('Select a language')}}</option>
                    @foreach ($langs as $lang)
                        <option value="{{$lang->id}}">{{$lang->name}}</option>
                    @endforeach
                </select>
                <p id="errlanguage_id" class="mb-0 text-danger em"></p>
            </div>
            <div class="form-group">
              <label for="">{{__('Image')}} **</label>
                <div class="col-md-12 showImage mb-3">
                    <img src="{{ asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail">
                </div>
                <input type="file" name="image" id="image" class="form-control image">
              <p id="erricon" class="mb-0 text-danger em"></p>
            </div>
            <div class="form-group">
              <label for="">{{__('Title')}} **</label>
              <input class="form-control" name="title" placeholder="{{__('Enter title')}}">
              <p id="errtitle" class="mb-0 text-danger em"></p>
            </div>
            <div class="form-group">
              <label for="">{{__('Text')}} **</label>
              <textarea class="form-control" name="text" placeholder="{{__('Enter text')}}" rows="5"></textarea>
              <p id="errtext" class="mb-0 text-danger em"></p>
            </div>

            <div class="form-group">
              <label for="">{{__('Serial Number')}} **</label>
              <input type="number" class="form-control ltr" name="serial_number" value="" placeholder="{{__('Enter Serial Number')}}">
              <p id="errserial_number" class="mb-0 text-danger em"></p>
              <p class="text-warning"><small>{{__('The higher the serial number is, the later the feature will be shown.')}}</small></p>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
          <button id="submitBtn" type="button" class="btn btn-primary">{{__('Submit')}}</button>
        </div>
      </div>
    </div>
  </div>

@endsection
