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

    {{-- image part starts --}}

    <div class="waxon_tm_portoflio">
        <div class="container">
            <div class="waxon_tm_main_title">
                <div class="title">
                    <h3>Featured Works (Images)<span class="bg">Portfolio</span></h3>
                </div>
                <div class="portfolio_filter">
                    <ul>
                        <li>
                            <a class="current" id = "preventDefaultOfAll" data-filter=".every">
                                <span class="first">All</span>
                                <span class="second">All</span>
                            </a>
                        </li>
                        @foreach ($image_categories as  $category)
                            <li>
                                <a href="#" data-filter=".{{ $category->category_name }}">
                                    <span class="first">{{ $category->category_name }}</span>
                                    <span class="second">{{ $category->category_name }}</span>
                                </a>
                            </li>
                        @endforeach


                        {{-- <li>
                            <a href="#" data-filter=".youtube">
                                <span class="first">Youtube</span>
                                <span class="second">Youtube</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-filter=".soundcloud">
                                <span class="first">Soundcloud</span>
                                <span class="second">Soundcloud</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-filter=".image">
                                <span class="first">Image</span>
                                <span class="second">Image</span>
                            </a>
                        </li> --}}
                    </ul>
                    <div class="wrapper">
                        <a href="#"><span class="trigger"></span></a>
                    </div>
                </div>
            </div>
            <div class="portfolio_inner">
                <ul class="gallery_zoom">
                    @foreach ($images_info as $images)
                        <li class="{{ $images->oneCategory->category_name }} every">
                            <div class="list_inner">
                                <div class="image">
                                    <img src="{{ url('./storage/portfolio' . '/' . $images->image_name) }}" alt="" />
                                    <div class="main" data-img-url="{{ url('./storage/portfolio' . '/' . $images->image_name) }}"></div>
                                    <a class="full_link zoom" href="{{ url('./storage/portfolio' . '/' . $images->image_name) }}"></a>
                                </div>
                                <div class="title">
                                    <h3><a href="#">Sweet Cherry</a></h3>
                                    <span><a href="#">Vimeo</a></span>
                                </div>
                            </div>
                        </li>
                        {{-- <li class="image">
                            <div class="list_inner">
                                <div class="image">
                                    <img src="img/thumbs/1-1.jpg" alt="" />
                                    <div class="main" data-img-url="img/portfolio/4.jpg"></div>
                                    <a class="full_link zoom" href="img/portfolio/4.jpg"></a>
                                </div>
                                <div class="title">
                                    <h3><a href="#">Yellow Phone</a></h3>
                                    <span><a href="#">Image</a></span>
                                </div>
                            </div>
                        </li> --}}
                    @endforeach


                </ul>
            </div>
        </div>
    </div>
    {{-- image part ends --}}

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
