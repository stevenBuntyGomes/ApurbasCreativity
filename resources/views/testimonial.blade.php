@extends('layouts.frontendApp')
@section('frontendContent')
    <div class="waxon_tm_settings">
        <div class="icon">
            <img class="svg" src="img/svg/setting.svg" alt="" />
            <a class="link" href="#"></a>
        </div>
        <div class="wrapper">
            <span class="title">Unlimited Colors</span>
            <ul class="colors">
                <li><a class="blue" href="#"></a></li>
                <li><a class="green" href="#"></a></li>
                <li><a class="brown" href="#"></a></li>
                <li><a class="pink" href="#"></a></li>
                <li><a class="orange" href="#"></a></li>
                <li class="bl"><a class="black" href="#"></a></li>
                <li class="wh"><a class="white" href="#"></a></li>
                <li><a class="purple" href="#"></a></li>
                <li><a class="sky" href="#"></a></li>
                <li><a class="cadetBlue" href="#"></a></li>
                <li><a class="crimson" href="#"></a></li>
                <li><a class="olive" href="#"></a></li>
                <li><a class="red" href="#"></a></li>
            </ul>
            <span class="title">Magic Cursor</span>
            <ul class="cursor">
                <li><a class="showme show" href="#"></a></li>
                <li><a class="hide" href="#"><img class="svg" src="img/svg/arrow.svg" alt="" /></a></li>
            </ul>
        </div>
    </div>

    <div class="waxon_tm_modalbox_news">
        <div class="box_inner">
        <div class="close">
            <a href="#"><img class="svg" src="img/svg/cancel.svg" alt="" /></a>
        </div>
        <div class="description_wrap scrollable"></div>
        </div>
    </div>

    {{-- top part starts --}}
    <div class="waxon_tm_topbar">
        <div class="container">
            <div class="topbar_inner">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ url('./storage/logo' . '/' . $logo_info->logo_image) }}" alt="" />
                    </a>
                </div>
                <div class="menu">
                    <div class="links">
                        <ul class="anchor_nav">
                            <li>
                                <a href="{{ url('/') }}">
                                    <span class="first">Home</span>
                                    <span class="second">Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('portfolio-image') }}">
                                    <span class="first">Portfolio Image</span>
                                    <span class="second">Portfolio Image</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('portfolio-video') }}">
                                    <span class="first">Portfolio Video</span>
                                    <span class="second">Portfolio Video</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('testimonial') }}">
                                    <span class="first">Testimonial</span>
                                    <span class="second">Testimonial</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- top part ends --}}

    {{-- mobile menu starts --}}

    <div class="waxon_tm_mobile_menu">
        <div class="topbar_inner">
            <div class="container bigger">
                <div class="topbar_in">
                    <div class="logo">
                        <a href="{{ url('/') }}"><img src="{{ url('./storage/logo' . '/' . $logo_info->logo_image) }}" alt="" /></a>
                    </div>
                    <div class="my_trigger">
                        <div class="hamburger hamburger--collapse-r">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dropdown">
            <div class="container">
                <div class="dropdown_inner">
                    <ul class="anchor_nav">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('portfolio-image') }}">portfolio_image</a></li>
                        <li><a href="{{ url('portfolio-video') }}">portfolio_videos</a></li>
                        <li><a href="{{ url('testimonial') }}">Testimonial</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- mobile menu ends --}}

    {{-- testimonial part starts --}}


    <div class="waxon_tm_about" id="about">

        <div class="waxon_tm_testimonials">
            <div class="container">
                <div class="waxon_tm_main_title">
                    <div class="title">
                        <h3>What Clients Say<span class="bg">Testimonial</span></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">

            @foreach ($testimonial_info as $testimonial)
                <div class="about_inner">
                    <div class="left">
                        <img class="thumbnail" src="{{ url('./storage/testimonial' . '/' . $testimonial->image_name) }}" alt="" />
                    </div>
                    <div class="right">
                        <div class="name">
                            <h3>{{ $testimonial->testi_name }}</h3>
                            <span class="job">{{ $testimonial->testi_position }}</span>
                        </div>
                        <div class="text">
                            {{ $testimonial->testi_description }}
                        </div>
                        {{-- <div class="waxon_tm_button" data-position="left">
                            <a href="#">
                            <span>{{ $about_info->about_button }}</span>
                            </a>
                        </div> --}}
                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            @endforeach

        </div>
    </div>
    {{-- testimonial part ends --}}


        {{-- footer part starts --}}
            <div class="waxon_tm_copyright">
                <div class="container">
                    <div class="copyright_inner">
                        <ul>
                            <li class="wow fadeInDown" data-wow-duration="0.8s">
                                <span>{{ $footer_info->site_name  }}</span>
                                <span>{{ $footer_info->site_note }}</span>
                            </li>
                            <li class="wow fadeInDown" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                <span>{{ $footer_info->site_address }}</span>
                                <span>{{ $footer_info->site_city }}</span>
                            </li>
                            <li class="wow fadeInDown" data-wow-duration="0.8s" data-wow-delay="0.4s">
                                <span><a href="#">{{ $footer_info->site_email }}</a></span>
                                <span>{{ $footer_info->site_contact }}</span>
                            </li>
                            <li class="wow fadeInDown" data-wow-duration="0.8s" data-wow-delay="0.6s">
                                <div class="social">
                                    <ul>

                                        @foreach ($footer_social as $social)
                                            <li>
                                                <a target = "blank" href="{{ $social->social_link }}">
                                                    <span class="first"><img class="svg" src="{{ url('./storage/footer' . '/' . $social->image_name) }}" alt="" /></span>
                                                    <span class="second"><img class="svg" src="{{ url('./storage/footer' . '/' . $social->image_name) }}" alt="" /></span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
    {{-- footer part ends --}}
@endsection
