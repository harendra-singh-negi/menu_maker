@php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
@endphp
@extends('user.layout')

@includeIf('user.partials.rtl-style')

@section('content')
    <div class="page-header">
        <h4 class="page-title">Intro Section</h4>
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
                <a href="#">Website Pages</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Home Page</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Intro Section</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="card-title">Update Intro Section</div>
                        </div>
                        <div class="col-lg-2">
                            @if (!empty($userLangs))
                                <select name="language" class="form-control"
                                        onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                                    <option value="" selected disabled>Select a Language</option>
                                    @foreach ($userLangs as $lang)
                                        <option
                                            value="{{$lang->code}}"
                                            {{$lang->code == request()->input('language') ? 'selected' : ''}}
                                        >
                                            {{$lang->name}}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body pt-5 pb-4">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <form id="ajaxForm" action="{{route('user.introsection.update', $lang_id)}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="col-12 mb-2">
                                                <label for="image"><strong>Main Image </strong></label>
                                            </div>
                                            <div class="col-md-12 showIntroMainImage mb-3">
                                                <img
                                                    src="{{ $abs->intro_main_image ?Uploader::getImageUrl(Constant::WEBSITE_IMAGE,$abs->intro_main_image,$userBs) : asset('assets/admin/img/noimage.jpg')}}"
                                                    alt="..." class="img-thumbnail" width="200">
                                            </div>
                                            <input type="file" name="intro_main_image" id="intro_main_image"
                                                   class="form-control">
                                            <p id="errintro_main_image" class="mb-0 text-danger em"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Section Title</label>
                                    <input type="text" class="form-control" name="intro_section_title"
                                           value="{{$abs->intro_section_title}}">
                                    <p id="errintro_section_title" class="em text-danger mb-0"></p>
                                </div>

                                <div class="form-group">
                                    <label for="">Title **</label>
                                    <input type="text" class="form-control" name="intro_title"
                                           value="{{$abs->intro_title}}">
                                    <p id="errintro_title" class="em text-danger mb-0"></p>
                                </div>

                                <div class="form-group">
                                    <label for="">Text **</label>
                                    <textarea name="intro_text" class="form-control">{{$abs->intro_text}}</textarea>
                                    <p id="errintro_text" class="em text-danger mb-0"></p>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="image" class="d-block"><strong>Signature</strong></label>
                                            <div class="showImage mb-3">
                                                @if (!empty($abs->intro_signature))
                                                    <a class="remove-image" data-type="signature"><i
                                                            class="far fa-times-circle"></i></a>
                                                @endif
                                                <img
                                                    src="{{$abs->intro_signature ? Uploader::getImageUrl(Constant::WEBSITE_IMAGE,$abs->intro_signature,$userBs) : asset('assets/admin/img/noimage.jpg')}}"
                                                    alt="..." class="img-thumbnail" width="200">
                                            </div>
                                            <input type="file" name="intro_signature" class="form-control " id="intro_signature">
                                            <p id="errintro_signature" class="mb-0 text-danger em"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="col-12 mb-2">
                                                <label for="image"><strong>Video Background</strong></label>
                                            </div>
                                            <div class="col-md-12 intro_video_image mb-3">
                                                <img
                                                    src="{{$abs->intro_video_image ? Uploader::getImageUrl(Constant::WEBSITE_IMAGE,$abs->intro_video_image,$userBs) : asset('assets/admin/img/noimage.jpg')}}"
                                                    alt="..." class="img-thumbnail" width="200">
                                            </div>
                                            <input type="file" name="intro_video_image" id="intro_video_image"
                                                   class="form-control image">
                                            <p id="errintro_video_image" class="mb-0 text-danger em"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Video URL</label>
                                    <input type="text" class="form-control ltr" name="intro_video_link"
                                           value="{{$abs->intro_video_link}}">
                                    <p id="errintro_video_link" class="em text-danger mb-0"></p>
                                </div>

                                <div class="form-group">
                                    <label for="">Contact Text </label>
                                    <input type="text" class="form-control ltr" name="intro_contact_text"
                                           value="{{$abs->intro_contact_text}}">
                                    <p id="errintro_contact_text" class="em text-danger mb-0"></p>
                                </div>

                                <div class="form-group">
                                    <label for="">Contact Number</label>
                                    <input type="text" class="form-control ltr" name="intro_contact_number"
                                           value="{{$abs->intro_contact_number}}">
                                    <p id="errintro_contact_number" class="em text-danger mb-0"></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="form">
                        <div class="form-group from-show-notify row">
                            <div class="col-12 text-center">
                                <button type="submit" id="submitBtn" class="btn btn-success">
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
<script>
    let routeUrl = "{{route('user.introsection.img.rmv')}}";
    let currentUrl = "{{url()->current()}}";
    let langCode = "{{$abs->language->code}}";
</script>
<script src="{{ asset('assets/tenant/js/blade.js') }}"></script>
  
@endsection
