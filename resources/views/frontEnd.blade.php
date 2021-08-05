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


<div class="waxon_tm_modalbox_about">
    <div class="box_inner">
        <div class="close">
        <a href="#"><img class="svg" src="img/svg/cancel.svg" alt="" /></a>
        </div>
        <div class="description_wrap scrollable">
            <div class="my_box">
                <div class="left">
                    <div class="about_title">
                        <h3>{{ $skill_info->skill_header }}</h3>
                    </div>
                    <div class="waxon_progress">
                        <div class="progress_inner" data-value="{{ $skill_info->first_skill_percent }}">
                            <span><span class="label">{{ $skill_info->first_skill }}</span><span class="number">{{ $skill_info->first_skill_percent }}%</span></span>
                            <div class="background"><div class="bar"><div class="bar_in"></div></div></div>
                        </div>
                        <div class="progress_inner" data-value="{{ $skill_info->first_skill_percent }}">
                            <span><span class="label">{{ $skill_info->second_skill }}</span><span class="number">{{ $skill_info->second_skill_percent }}%</span></span>
                            <div class="background"><div class="bar"><div class="bar_in"></div></div></div>
                        </div>
                        <div class="progress_inner" data-value="90">
                            <span><span class="label">{{ $skill_info->third_skill }}</span><span class="number">{{ $skill_info->third_skill_percent }}%</span></span>
                            <div class="background"><div class="bar"><div class="bar_in"></div></div></div>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="about_title">
                        <h3>{{ $skill_info->language_header }}</h3>
                    </div>
                    <div class="waxon_progress">
                        <div class="progress_inner" data-value="{{ $skill_info->first_language_percent }}">
                            <span><span class="label">{{ $skill_info->first_language }}</span><span class="number">{{ $skill_info->first_language_percent }}%</span></span>
                            <div class="background"><div class="bar"><div class="bar_in"></div></div></div>
                        </div>
                        <div class="progress_inner" data-value="{{ $skill_info->second_language_percent }}">
                            <span><span class="label">{{ $skill_info->second_language }}</span><span class="number">{{ $skill_info->second_language_percent }}%</span></span>
                            <div class="background"><div class="bar"><div class="bar_in"></div></div></div>
                        </div>
                        <div class="progress_inner" data-value="{{ $skill_info->third_language_percent }}">
                            <span><span class="label">{{ $skill_info->third_language }}</span><span class="number">{{ $skill_info->third_language_percent }}%</span></span>
                            <div class="background"><div class="bar"><div class="bar_in"></div></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


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
                        <li class="current">
                            <a href="#home">
                                <span class="first">Home</span>
                                <span class="second">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="#about">
                                <span class="first">About</span>
                                <span class="second">About</span>
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
                            <a href="#testimonial">
                                <span class="first">Testimonial</span>
                                <span class="second">Testimonial</span>
                            </a>
                        </li>
                        <li>
                            <a href="#contact">
                                <span class="first">Contact</span>
                                <span class="second">Contact</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


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
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="{{ url('portfolio-image') }}">portfolio_image</a></li>
                    <li><a href="{{ url('portfolio-video') }}">portfolio_videos</a></li>
                    <li><a href="#testimonial">Testimonial</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="waxon_tm_hero" id="home">
    <div class="background">
        <div class="leftpart"></div>
        <div class="rightpart">
            <div class="inner">
                <div class="overlay_slider vegas-slide">
                    <div class="vegas-slide-inner" data-images="{{ url('./storage/banner' . '/' . $banner_info->banner_image) }}"></div>
                </div>
                <div class="overlay_image"></div>
                <div class="myOverlay"></div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="content_inner">
                <div class="name">
                    <h3 class="stroke">{{ $banner_info->banner_info_one }}</h3>
                    <h3>{{ $banner_info->banner_info_two }}</h3>
                    <span>{{ $banner_info->banner_info_three }}</span>&nbsp;<span id = "typed"></span>
                </div>
            </div>
            <div class="waxon_tm_down" data-skin="dark" data-position="">
                <div class="line_wrapper">
                    <div class="line"></div>
                </div>
            </div>
        </div>
    </div>
</div>


    <div class="waxon_tm_about" id="about">
        <div class="container">
            <div class="about_inner">
                <div class="left">
                    <img class="thumbnail" src="{{ url('./storage/about' . '/' . $about_info->about_image) }}" alt="" />
                </div>
                <div class="right">
                    <div class="name">
                        <h3>{{ $about_info->about_title }}<span class="bg">{{ $about_info->about_header }}</span></h3>
                        <span class="job">{{ $about_info->about_title_two }}</span>
                    </div>
                    <div class="text">
                        {{ $about_info->about_description }}
                    </div>
                    <div class="waxon_tm_button" data-position="left">
                        <a href="#">
                        <span>{{ $about_info->about_button }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="waxon_tm_service">
        <div class="container">
            <div class="service_inner">
                <ul class="owl-carousel">
                    @foreach($service_info as $service)
                        <li class="item">
                            <div class="list_inner">
                                <img class="svg" src="{{ url('./storage/services' . '/' . $service->service_image) }}" alt="" />
                                <div class="details">
                                    <h3>{{ $service->service_title }}</h3>
                                    <p>{{ $service->service_description }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>


{{-- portfolio video started --}}

{{-- portfolio video ended --}}

<div class="waxon_tm_testimonials" id = "testimonial">
    <div class="container">
        <div class="waxon_tm_main_title">
            <div class="title">
                <h3>What Clients Say<span class="bg">Testimonial</span></h3>
            </div>
        </div>
        <div class="testi_inner">
            <div class="left">
                <div class="quote_list">
                    <ul>
                        @foreach($testimonial_info as $testimonial)
                            <li class="active">
                                <img class="svg" src="img/svg/quote-1.svg" alt="" />
                                <p class="text">{{ $testimonial->testi_description }}</p>
                                <div class="details">
                                    <div class="image">
                                        <div class="main" data-img-url="{{ url('./storage/testimonial' . '/' . $testimonial->image_name) }}"></div>
                                    </div>
                                    <div class="short">
                                        <h3 class="author"><span>{{  $testimonial->testi_name }}</span></h3>
                                        <h3 class="job"><span>{{  $testimonial->testi_position }}</span></h3>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="right">
                <div class="image_list">
                    <ul class="masonry">
                        @foreach($testimonial_info as $testimonial)
                            <li class="active masonry_item">
                                <div class="image">
                                    <img src="{{ url('./storage/testimonial' . '/' . $testimonial->image_name) }}" alt="" />
                                    <div class="main" data-img-url="{{ url('./storage/testimonial' . '/' . $testimonial->image_name) }}"></div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="waxon_tm_button" data-position="left">
                        <a href="{{ url('testimonial') }}">
                            See More Testimonials
                        </a>
                    </div>
    </div>
</div>


<div class="waxon_tm_contact" id="contact">
    <div class="bg_image"></div>
    <div class="container">
        <div class="contact_inner">
            <div class="waxon_tm_main_title">
                <div class="title">
                    <h3>Get in Touch<span class="bg">Contact</span></h3>
                </div>
            </div>
            <div class="desc">
                <p>If you want to take service from me, You can send me through Below form. I will be egarly waiting for your Message. Have a great day.</p>
            </div>
            <div class="wrapper">
                @if(session('product_inserted'))
                    <div class="alert alert-success">
                      <p>{{ session('product_inserted') }}</p>
                    </div>f
                @endif
                <div class="left wow fadeInLeft" data-wow-duration="0.8s">
                    <div class="fields">
                        <form action="{{ url('store-contact-information') }}" method="post" class="contact_form" id="contact_form" enctype = "multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="returnmessage" data-success="Your message has been received, We will contact you soon."></div>
                            <div class="empty_notice"><span>Please Fill Required Fields</span></div>
                            <div class="first">
                                <ul>
                                    <li>
                                        <input name = "contact_name" type="text" placeholder="Name">
                                    </li>
                                    <li>
                                        <input name = "contact_email" type="text" placeholder="Email">
                                    </li>
                                </ul>
                            </div>
                            <div class="last">
                                <textarea name = "contact_description" placeholder="Message"></textarea>
                            </div>
                            <div class="waxon_tm_button" data-position="left">

                                    <button class = "contact_button_submit" type="submit">
                                        <span>Send Message</span>
                                    </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


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


@endsection
@section('typed')
    <script>
        let typed_info = {!! json_encode($typed_info->toArray()) !!};
        let typed_name1 = typed_info[0].typed_name;
        let typed_name2 = typed_info[1].typed_name;
        let typed_name3 = typed_info[2].typed_name;
        let typed_name4 = typed_info[3].typed_name;
        var typed2 = new Typed('#typed', {
            strings: [
                typed_name1,
                typed_name2,
                typed_name3,
                typed_name4,
                // typed_info.forEach((typed) => typed.typed_name),

            ],
            typeSpeed: 100,
            backSpeed: 0,
            fadeOut: true,
            loop: true
        });
        // typed_info.forEach((typed) => typed.typed_name);
        // typed_info.forEach((typed) => console.log(typed.typed_name));
        // console.log(typed_name1);
    </script>
@endsection
