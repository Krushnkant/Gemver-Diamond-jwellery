<?php
use Carbon\Carbon;
$deal = \App\Models\Deal::first();
if($deal){

$date = Carbon::parse($deal->start_date);
$formattedDate = $date->format('jS F');
$currentDateTime = Carbon::now();
if($deal->start_date > $currentDateTime){
?>
<div class="" style="background-color:  {{ $deal->background_color }}; color: {{ $deal->text_color }}; ">
    <div class="row countdown justify-content-center" >
      <div class="col-12 col-md-6 col-lg-4 col-xl-3">
        <h5 class="digit">{{ $deal->title }}</h5>
      </div>
      <div class="col-12 col-md-6 col-lg-3 col-xl-3">
        <ul class="nav-center">
            
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
    
           
        </ul>
      </div>
      <div class="col-12 col-md-6 col-lg-3 col-xl-2">
        <h5 class="digit" >{{ $deal->date_title }}</h5>
        <h6 class="text">
            {{ $formattedDate }}
        </h6>
      </div>
      <div class="col-12 col-md-6 col-lg-2 col-xl-1">
        <a href="{{ $deal->url_button }}" target="_blank" style="color: {{ $deal->button_color }}; text-decoration: underline;  ">{{ $deal->text_button }}</a>
      </div>
    </div>
</div>

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