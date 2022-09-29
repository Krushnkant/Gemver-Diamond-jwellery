@extends('frontend.layout.layout')

@section('content')

<div class="engagement_bg_slider">
    <img src="{{ asset('frontend/image/engagement-bg.png') }}" alt="">
    <div class="engagement_text_part">
        <h1 class="heading-h1 engagement_heading text-start mb-3">Engagement Ring</h1>
        <p class="engagement_paragraph mb-4">
            Create your unique engagement ring from either the setting or a diamond.
        </p>
        <div class="engagement_button">
            <button class="engagement_start_diamond">Start with Diamond</button>
            <button class="engagement_start_setting ms-3">Start with setting</button>
        </div>
    </div>
</div>
<div class="choose_your_setting_heading text-center">
    Choose Your Setting Stlye
</div>

@endsection