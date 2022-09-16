<!-- <!DOCTYPE html>
<html>
<head>
	<title>mail sending</title>
</head>
<body>
	@if(isset($name))
	<h3>Name :  <span>{{$name}}</span></h3> 
	<h3>Mobile Number :  <span>{{$mobile_no}}</span></h3> 
	<h3>Email Address :  <span>{{$email}}</span></h3> 
	@endif
	
	<h4>{{$message1}}</h4>
</body>
</html> -->

<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body style="background-color: #f5f5f5;">
    <div style="margin: auto; align-items: center; justify-content: center;margin-top: 50px;min-height: 100vh;">
        <div style="font-family: 'Roboto', sans-serif; margin-left:20px; ">
            <div style="text-align: center; margin-bottom: 20px;">
                <img src="{{ url('frontend/image/logo-transparent.png') }}" alt=""  style="width: 150px;">
            </div>
            
            <div style="margin-left:100px;background-color: #fff; padding: 50px; min-width:650px;box-shadow: 0px 0px 4px 4px rgb(0 0 0 / 1%); ">
                <div style="margin-bottom: 25px; font-weight: 900;font-size: 18px;">Thank you for contact us</div>
                <div style="margin-bottom: 25px;font-size: 13px;">
                     Our Representative will contact you soon.
                </div>
                <div style="margin-bottom: 5px; font-size: 13px;">
                    Thank you!
                    <div style="margin-top:3px;">Gemver Affordable Luxury Team</div>
                </div>
            </div>
          
            <div style="text-align: center; margin-top: 50px;color: #b7b7b7;font-size: 13px;">
                © 2022 Gemver Affordable Luxury 
            </div>
        </div>
    </div>
</body>

</html>