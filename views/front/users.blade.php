@extends('front.layout')

@section('pagename')
    - {{__('Listings')}}
@endsection

@section('meta-description', !empty($seo) ? $seo->profiles_meta_description : '')
@section('meta-keywords', !empty($seo) ? $seo->profiles_meta_keywords : '')

@section('breadcrumb-title')
    {{__('Listings')}}
@endsection
@section('breadcrumb-link')
    {{__('Listings')}}
@endsection

@section('content')

    <section class="user-profile-area ptb-120 pb-80">
        <div class="container">
            <div class="row">
                @if (count($users) == 0)
                    <div class="bg-light text-center py-5 d-block w-100">
                        <h3>{{__('NO RESTAURANT FOUND')}}</h3>
                    </div>
                @else
                    @foreach($users as $user)
                        <div class="col-lg-4 col-sm-6">
                            <div class="swiper-slide user-card mb-30">
                                <div class="card" data-aos="fade-up" data-aos-delay="100">
                                    <div class="icon">
                                        @if($user->image)
                                            <img class="lazy" src="{{ asset(\App\Constants\Constant::WEBSITE_TENANT_USER_IMAGE .'/'.$user->image) }}"
                                                 alt="user">
                                        @else
                                            <img class="lazy" src="{{ asset('assets/admin/img/propics/blank_user.jpg') }}"
                                                 alt="user">
                                        @endif
                                    </div>
                                    <div class="card-content green">
                                        <h3 class="card-title">{{$user->first_name." ".$user->last_name}}</h3>
                                        <div class="social-link d-none">
                                            @foreach($user->social_media as $social)
                                                <a href="{{$social->url}}" target="_blank"><i class="{{$social->icon}}"></i></a>
                                            @endforeach
                                        </div>
                                        <div class="cta-btns">
                                            <a href="{{detailsUrl($user)}}" class="btn btn-sm secondary-btn">{{__('View Website')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="pagination mb-30 justify-content-center">
                {{$users->appends(['search' => request()->input('search'),'location' => request()->input('location')])->links()}}
            </div>
        </div>
       
      
    </section>

@endsection
