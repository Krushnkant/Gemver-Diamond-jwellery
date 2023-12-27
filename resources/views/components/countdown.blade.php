<?php
use Carbon\Carbon;
$deal = \App\Models\Deal::first();
if($deal){

$date = Carbon::parse($deal->start_date);
$formattedDate = $date->format('jS F');
$currentDateTime = Carbon::now();
if($deal->start_date > $currentDateTime){
?>
<ul class="nav countdown" style="background-color:  {{ $deal->background_color }}; color: {{ $deal->text_color }}; ">
    <li style="margin-right: 50px;">
        <h5 class="digit">{{ $deal->title }}</h5>
       
    </li>
    <li>
        <h5 class="digit" id="days">00</h5>
        <h6 class="text">
			days
        </h6>
    </li>
    <li>
        <h5 class="digit" id="hours">00</h5>
        <h6 class="text">
            hours
        </h6>
    </li>
    <li>
        <h5 class="digit" id="mins">00</h5>
        <h6 class="text">
			minutes
        </h6>
    </li>
    <li>
        <h5 class="digit" id="secs">00</h5>
        <h6 class="text">
            seconds
        </h6>
    </li>

    <li style="margin-left: 50px; margin-right: 20px; ">
        <h5 class="digit" >{{ $deal->date_title }}</h5>
        <h6 class="text">
            {{ $formattedDate }}
        </h6>
    </li>

    <li style=" margin-top: 20px; ">
        <a href="{{ $deal->url_button }}" target="_blank" style="color: {{ $deal->button_color }}; text-decoration: underline;  ">{{ $deal->text_button }}</a>
    </li>
</ul>
<?php } ?>
<script>
    var count = new Date("{{ $deal->start_date }}").getTime();
    var x = setInterval( function() {
        var now = new Date().getTime();
        var d = count - now;
        var days = Math.floor(d/(1000*60*60*24));
        var hours = Math.floor((d%(1000*60*60*24))/(1000*60*60));
        var minutes = Math.floor((d%(1000*60*60))/(1000*60));
        var seconds = Math.floor((d%(1000*60))/1000);
        document.getElementById("days").innerHTML = days;
        document.getElementById("hours").innerHTML = hours;
        document.getElementById("mins").innerHTML = minutes;
        document.getElementById("secs").innerHTML = seconds;
    },1000);
</script>
<?php } ?>