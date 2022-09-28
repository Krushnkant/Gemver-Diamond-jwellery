@extends('frontend.layout.layout')

@section('content')

<div class="engagement_bg_slider">
    <img src="{{ asset('frontend/image/Engagement_bg.png') }}" alt="">
    <div class="engagement_text_part">
        <h1 class="heading-h1 engagement_heading text-center">Engagement Rings</h1>
        <p class="engagement_paragraph">
            Create your unique engagement ring from either the setting or a diamond. Start from our engagement ring setting and add a diamond or gemstone of your choice, or select from our extensive range of loose diamonds and complete it with a ring setting in your preferred choice of precious metal.
        </p>
        <div class="engagement_button">
            <button class="engagement_start_diamond">Start with Diamond</button>
            <button class="engagement_start_setting ms-3">Start with setting</button>
        </div>
    </div>
</div>
<div class="choose_your_setting_section">
    <h1 class="heading-h1 engagement_heading text-center">Engagement Rings</h1>
</div>

@endsection