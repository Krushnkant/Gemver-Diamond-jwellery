<?php 

//dd($setting['company_address']);
$CompanyAddress = $setting['company_address'];
$CompanyName = $setting['company_name'];
$CompanyLogo = $setting['company_logo'];
$CompanyEmail = $setting['company_email'];

?>
<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>

<body style="background-color: #f5f5f5;">
    <div style="margin: auto; align-items: center; justify-content: center;margin-top: 50px;min-height: 100vh;">
        <div style="font-family: 'Roboto', sans-serif; margin:20px; ">
            <div style="text-align: center; margin-bottom: 20px;">
                <img src="{{ url('images/company/'.$CompanyLogo) }}" alt=""  style="width: 150px;">
            </div>
            
            <div style="text-align: center;background-color: #fff; padding: 50px; min-width:650px; ">
                <div style="margin-bottom: 25px; font-weight: 900;font-size: 18px;">Thank you for inquiry</div>
                <div style="margin-bottom: 25px;font-size: 13px;">
                     Our Representative will contact you soon.
                </div>
                <div style="margin-bottom: 5px; font-size: 13px;">
                    {!! $data['product_info'] !!}
                    {!! $data['diamond_info'] !!}
                    {!! $data['spe_info'] !!}
                </div>
                
                <!-- <button style="margin-bottom: 25px;color: #fff;background-color: #1a5db6; border: 0;padding: 13px 30px;border-radius: 5px; font-size: 13px;">Confirm email</button>
                
                <a href="#" style="color: #1a5db6;font-size: 13px;margin-bottom: 25px;display: inline-block;">https:/inklinkilinknikniinintaniininasdaniaisniasiadnal/basiéahskhda/ <br>
                    askdaksdabskabaksbdakd</a> -->
                <div style="margin-bottom: 5px; font-size: 13px;">
                    Thank you!
                    <div style="margin-top:3px;">{{ $CompanyName }} Team</div>
                </div>
            </div>
          
            <div style="text-align: center; margin-top: 50px;color: #b7b7b7;font-size: 13px;">
                © 2022 {{ $CompanyName }} 
            </div>
        </div>
    </div>
</body>

</html>