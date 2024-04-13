<?php
use Carbon\Carbon;
$deal = \App\Models\Deal::first();
if($deal){

$date = Carbon::parse($deal->start_date);
$formattedDate = $date->format('jS F');
$currentDateTime = Carbon::now();
if($deal->start_date > $currentDateTime){
    $button_url =  "#"; 
?>
 @if($deal->application_dropdown_id == 1)
 <?php $button_url =  "#" ?>
 @elseif($deal->application_dropdown_id == 2)
 <?php 
    $product_variant = \App\Models\ProductVariant::where('estatus',1)->where('product_id',$deal->product_variant_id)->first(['slug']);
    $button_url = isset($product_variant->slug)?URL('product-details/'.$product_variant->slug):"#";
 ?>
 @elseif($deal->application_dropdown_id == 3)
 <?php 
    $category = \App\Models\Category::where('estatus',1)->where('id',$deal->value)->first(['slug']);
    $button_url = isset($category->slug)?URL('shop/'.$category->slug):"#";
 ?>

 @elseif($deal->application_dropdown_id == 4)
 <?php $button_url = $deal->value; ?>
 @endif  
<div class="counter-section" style="background-color:  {{ $deal->background_color }}; color: {{ $deal->text_color }}; ">
    <div class="container">
    <div class="row countdown justify-content-center align-items-center gx-3 gy-4 gy-md-0">
      <div class="col-lg-4 col-md-6 col-sm-12 mt-0">
        <h2 class="mb-0 fw-normal text-uppercase">{{ $deal->title }}</h2>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12">
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
      <div class="col-lg-3 col-md-6 col-sm-12">
        <h4 class="text-uppercase">{{ $deal->date_title }}</h4>
        <h6 class="text">
            {{ $formattedDate }}
        </h6>
      </div>
      <div class="col-lg-2 col-md-6 col-sm-12">
        <a href="{{ $button_url }}" target="_blank" style="color: {{ $deal->button_color }}; border: 1px solid {{ $deal->button_color }}; padding: 10px; border-radius: 5px; display: block;">{{ $deal->text_button }}</a>
      </div>
    </div>
    </div>
</div>

<?php } ?>
<script>
    var count = new Date("{{ $deal->start_date }}").getTime();
    var x = setInterval( function() {
        var now = new Date().getTime();
        var d = count - now;
        if (d <= 0) {
            clearInterval(x); // Stop the countdown
            jQuery('.counter-section').hide();
            // document.querySelector('.counter-section').style.display = 'none'; // Hide the counter section
            return; // Exit the function
        }
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