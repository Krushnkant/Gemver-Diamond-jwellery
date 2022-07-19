
<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>

<body style="background-color: #f5f5f5;">
    <div style="margin: auto;display: flex; align-items: center; justify-content: center;margin-top: 50px;min-height: 100vh;">
        <div style="font-family: 'Roboto', sans-serif; ">
            <div style="text-align: center; margin-bottom: 20px;">
                <img src="{{ url('frontend/image/logo-transparent.png') }}" alt="" width="100% " style="width: 300px; ">
            </div>
            <div style="background-color: #fff;padding: 50px;min-width:650px;box-shadow: 0px 0px 4px 4px rgb(0 0 0 / 1%);">
                <div style="margin-bottom: 25px; font-weight: 900;font-size: 18px;">Thank you for inquiry</div>
                <div style="margin-bottom: 25px;font-size: 13px;">
                     Our Representative will contact you soon.
                </div>
                <div style="margin-bottom: 5px; font-size: 13px;">
                    {!! $product_info !!}
                {!! $diamond_info !!}
                {!! $spe_info !!}
                </div>
                
                <!-- <button style="margin-bottom: 25px;color: #fff;background-color: #1a5db6; border: 0;padding: 13px 30px;border-radius: 5px; font-size: 13px;">Confirm email</button>
                
                <a href="#" style="color: #1a5db6;font-size: 13px;margin-bottom: 25px;display: inline-block;">https:/inklinkilinknikniinintaniininasdaniaisniasiadnal/basiéahskhda/ <br>
                    askdaksdabskabaksbdakd</a> -->
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