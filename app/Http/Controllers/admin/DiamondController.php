<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Diamond;
use App\Models\Vendor;
use App\Models\ProjectPage;
use App\Models\Company;
use App\Models\PriceRange;
use Illuminate\Http\Request;
use App\Imports\ImportDiamond;
use App\Imports\ImportDiamondNew;
use App\Imports\ImportDiamondNewLatest;
use Excel;
use Illuminate\Support\Facades\Validator;


class DiamondController extends Controller
{
    private $page = "Diamond";

    public function index()
    {
        $action = "list";
        return view('admin.diamonds.list',compact('action'));
    }

    public function alldiamondlist(Request $request){
     
        if ($request->ajax()) {
            $tab_type = $request->tab_type;
            if ($tab_type == "active_newslatter_tab"){
                $estatus = 1;
            }
            elseif ($tab_type == "deactive_newslatter_tab"){
                $estatus = 2;
            }
             
            $columns = array(
                0 =>'id',
                1=> 'diamond_thumb',
                2=> 'Stone_No',
                3=> 'StockStatus',
                4=> 'Shape',
                5=> 'Clarity',
                6=> 'Color',
                7=> 'Location',
                8=> 'Amt',
                9=> 'estatus',
                10=> 'email',
                11=> 'created_at',
            );

            $totalData = Diamond::count();
            if (isset($estatus)){
                $totalData = Diamond::where('estatus',$estatus)->count();
            }
           
            $totalFiltered = $totalData;
            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if($order == "id"){
                $order = "created_at";
                $dir = 'desc';
            }

            if(empty($request->input('search.value')))
            {
                $diamonds = Diamond::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir);

                if (isset($estatus)){
                    $diamonds = $diamonds->where('estatus',$estatus);
                }
                $diamonds = $diamonds->get();
            }
            else {
                $search = $request->input('search.value');
                $diamonds =  Diamond::where(function($query) use($search){
                    $query->where('id','LIKE',"%{$search}%")
                          ->orWhere('Stone_No', 'LIKE',"%{$search}%")
                          ->orWhere('Shape', 'LIKE',"%{$search}%")
                          ->orWhere('Clarity', 'LIKE',"%{$search}%");
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                if (isset($estatus)){
                    $diamonds = $diamonds->where('estatus',$estatus)->where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                              ->orWhere('Stone_No', 'LIKE',"%{$search}%")
                              ->orWhere('Shape', 'LIKE',"%{$search}%")
                              ->orWhere('Clarity', 'LIKE',"%{$search}%");
                        })
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
                }

                $totalFiltered = Diamond::where(function($query) use($search){
                    $query->where('id','LIKE',"%{$search}%")
                         ->orWhere('Stone_No', 'LIKE',"%{$search}%")
                         ->orWhere('Shape', 'LIKE',"%{$search}%")
                         ->orWhere('Clarity', 'LIKE',"%{$search}%");
                    })->count();
                if (isset($estatus)){
                    $totalFiltered = $totalFiltered->where('estatus',$estatus)->where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                             ->orWhere('Stone_No', 'LIKE',"%{$search}%")
                             ->orWhere('Shape', 'LIKE',"%{$search}%")
                             ->orWhere('Clarity', 'LIKE',"%{$search}%");
                        })->count();
                }
            }
            $data = array();

            if(!empty($diamonds))
            {
                foreach ($diamonds as $diamond)
                {
                    $page_id = ProjectPage::where('route_url','admin.diamonds.list')->pluck('id')->first();
                    if( $diamond->estatus==1 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="DiamondStatuscheck_'. $diamond->id .'" onchange="chageDiamondStatus('. $diamond->id .')" value="1" checked="checked"><span class="slider round"></span></label>';
                    }
                    elseif ($diamond->estatus==1){
                        $estatus = '<label class="switch"><input type="checkbox" id="DiamondStatuscheck_'. $diamond->id .'" value="1" checked="checked"><span class="slider round"></span></label>';
                    }

                    if( $diamond->estatus==2 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="DiamondStatuscheck_'. $diamond->id .'" onchange="chageDiamondStatus('. $diamond->id .')" value="2"><span class="slider round"></span></label>';
                    }
                    elseif ($diamond->estatus==2){
                        $estatus = '<label class="switch"><input type="checkbox" id="DiamondStatuscheck_'. $diamond->id .'" value="2"><span class="slider round"></span></label>';
                    }

                    if(isset($diamond->Stone_Img_url) && $diamond->Stone_Img_url !=null ){
                        $pic = $diamond->Stone_Img_url;
                    }
                    else{
                        $pic = url('images/default_avatar.jpg');
                    }


                    
                    $newDate = date("d-m-Y", strtotime($diamond->created_at));
                    $nestedData['diamond_thumb'] = '<img src="'. $pic .'" width="50px" height="50px" alt="'.$diamond->Stone_No.'">';
                    $nestedData['Stone_No'] =$diamond->Stone_No;
                    $nestedData['StockStatus'] =$diamond->StockStatus;
                    $nestedData['Shape'] =$diamond->Shape;
                    $nestedData['Clarity'] =$diamond->Clarity;
                    $nestedData['Color'] =$diamond->Color;
                    $nestedData['Location'] =$diamond->Location;
                    $nestedData['Amt'] =$diamond->Amt;
                    $nestedData['estatus'] = $estatus;

                    $nestedData['created_at'] = $newDate;
                    $data[] = $nestedData;
                }
            }

            $json_data = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data,
            );
            echo json_encode($json_data);
        }
    }

    public function importView(Request $request){
        $action = "create";
        return view('admin.diamonds.list',compact('action'))->with('page',$this->page);
    }

    public function import(Request $request){
        $messages = [
            'file.required' =>'Please provide a file',
        ];

        $validator = Validator::make($request->all(), [
            'file' =>'required',
        ], $messages);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }
        Excel::import(new ImportDiamond, $request->file('file')->store('files'));
        $action = "add";
        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function importnew(Request $request){
        set_time_limit(0);
        //$public_path = public_path() . "\csv\diamond_response.csv";
        $public_path = __DIR__ . '/../../../../public/csv/diamond_response.csv';
        Excel::import(new ImportDiamondNew, $public_path);
        $action = "add";
        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function importnewdiamond(Request $request){
        set_time_limit(0);
        // $public_path = __DIR__ . '/../../../../public/csv/vdb_LG_diamonds.csv';
        // Excel::import(new ImportDiamondNewLatest, $public_path);
        // $action = "add";
        $vender_array = array(); 
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://apiservices.vdbapp.com/v2/diamonds?type=lab_grown_diamond&page_size=100&page_number=1&shapes[]=Round&shapes[]=Heart&shapes[]=Cushion&with_images=true',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Token token=M2wIRs87_aJJT2vlZjTviGG4m-v7jVvdfuCUHqGdu6k, api_key=_vYN1uFpastNYP2bmCsjtfA'
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
           return "cURL Error #:" . $err;
        } else {
            $diamonds = json_decode($response);
            if(isset($diamonds->response->body->diamonds)){ 
                $total_diamond = $diamonds->response->body->total_diamonds_found;
                foreach($diamonds->response->body->diamonds as $collection)
                {
                    //dd($collection);
                    if((int)$collection->total_sales_price > 0 && $collection->total_sales_price != ""){
                        $Stone_No = $collection->stock_num;
                        
                        $PriceRanges = PriceRange::where('estatus',1)->get();
                        $amount = (int)$collection->total_sales_price;

                        $Company = Company::where('id',1)->first();
                        $company_per = $Company->company_percentage;

                        $company_per = 0;
                        foreach($PriceRanges as $PriceRange){
                            if($PriceRange->start_price <=  $amount && $PriceRange->end_price >=  $amount){
                                $company_per = $PriceRange->percentage;
                                $type = $PriceRange->type;
                            }
                        }
                        if($company_per > 0){
                            if($type == 1){
                                $company_per_amt = ((int)$collection->total_sales_price * $company_per)/100;
                            }else{
                                $company_per_amt = (int)$collection->total_sales_price + $company_per;
                            }
                        }else{
                            $company_per_amt = 0;
                        }

                        $sale_amt = round((int)$collection->total_sales_price + $company_per_amt);

                        if($collection->meas_length != "" && $collection->meas_width != "" && $collection->meas_depth != ""){     
                            $DiamondMeasurement = $collection->meas_length.' * '.$collection->meas_width.' * '.$collection->meas_depth; 
                        }else{
                            $DiamondMeasurement = "-";    
                        }

                        $percentage = rand(10, 30);
                        $percentage_amount = ($sale_amt * $percentage)/100;
                        $real_amt = round($percentage_amount + $sale_amt);

                        if($collection->short_title == "" || $collection->short_title == null || $collection->short_title == "N/A"){
                            $short_title = $collection->shape . " " . $collection->size . "ct " .$collection->color. " " .$collection->clarity; 
                        }else{
                            $short_title = $collection->short_title;
                        }

                        if($collection->long_title == "" || $collection->long_title == null || $collection->long_title == "N/A"){
                            $long_title =  $collection->shape . " " . $collection->size . "ct " .$collection->color. " " .$collection->clarity; 
                        }else{
                            $long_title = $collection->long_title;
                        }



                        $Diamond = Diamond::where('diamond_id',$collection->id)->first();
                        if($Diamond){
                        
                            $Diamond->Amt = $collection->total_sales_price;      
                            $Diamond->Sale_Amt = $sale_amt;      
                            $Diamond->real_Amt = $real_amt; 
                            $Diamond->short_title = $short_title; 
                            $Diamond->long_title = $long_title; 
                            $Diamond->slug = $this->createSlug($short_title,$Diamond->id);      
                            $Diamond->amt_discount = $percentage;      
                            $Diamond->shape = strtoupper($collection->shape); 
                            $Diamond->Measurement = $DiamondMeasurement; 
                                    $Diamond->StockStatus = $collection->available;
                                    $Diamond->save();    
                        }else{ 
                            $data = ([
                                'Company_id' => 1,  
                                'Stone_No' => $Stone_No,
                                'diamond_id' => $collection->id,
                                'short_title' => $short_title,
                                'long_title' => $long_title,
                                'slug' => $this->createSlug($short_title),
                                'vendor_id' => $collection->vendor_id,
                                'StockStatus' => $collection->available,
                                'Weight' => $collection->size,
                                'Lab_Report_No' => $collection->lab_sequence_no,
                                'Location' => $collection->city.','.$collection->state.','.$collection->country,
                                'Amt' => $collection->total_sales_price,
                                'Sale_Amt' => $sale_amt,
                                'real_Amt' => $real_amt,
                                'amt_discount' => $percentage,
                                'shape' => strtoupper($collection->shape),
                                'Color' => $collection->color,
                                'Measurement' =>  $DiamondMeasurement,
                                'meas_length' => ($collection->meas_length)?$collection->meas_length:0,
                                'meas_width' => ($collection->meas_width)?$collection->meas_width:0,
                                'meas_depth' => ($collection->meas_depth)?$collection->meas_depth:0,
                                'Certificate_url' => $collection->cert_url,
                                'Video_url' => $collection->video_url,
                                'Stone_Img_url' => isset($collection->image_url)?$collection->image_url:"",
                                'Rate' => $collection->price_per_carat,
                                'Lab' => $collection->lab,
                                'FancyColorIntens' => $collection->fancy_color_intensity,
                                'FancyColorOvertone' => $collection->fancy_color_overtone,
                                'FancyColor' => $collection->fancy_color_dominant_color,
                                'Symm' =>  $collection->symmetry,
                                'Polish' => $collection->polish,
                                'Clarity' => $collection->clarity,
                                'Cut' => $collection->cut,
                                'Total_Depth_Per' => $collection->depth_percent,
                                'Table_Diameter_Per' => $collection->table_percent,
                                'GirdleThin_ID' => $collection->girdle_min,
                                'GirdleThick_ID' => $collection->girdle_max,
                                'FlrColor' => $collection->fluor_color,
                                'FlrIntens' => $collection->fluor_intensity,
                                'CrownHeight' => $collection->crown_height,
                                'CrownAngle' => $collection->crown_angle,
                                'PavillionHeight' => $collection->pavilion_depth,
                                'PavillionAngle' => $collection->pavilion_angle,
                                'Eyeclean' => $collection->eye_clean,
                                'Discount' => $collection->discount_percent,
                                'Girdle_Per' => $collection->girdle_percent,
                                
                                
                                // 'Milkey' => $collection->milky,
                                
                                'Culet_Size_ID' => $collection->culet_size,
                                'Ratio' => $collection->meas_ratio,
                                'growth_type' => $collection->growth_type,
                                // 'Culet_Condition_ID' => $collection->culet_condition,
                                'created_at' => new \DateTime(null, new \DateTimeZone('Asia/Kolkata')),
                                
                                
                                
                                // 'Laser_Inscription' => $collection->inscription,
                                // 'Stone_Comment' => $collection->cert_comment,
                                // 'KeyToSymbols' => $keytosymbols,
                                // 'Black_Inclusion' => $collection->black_inclusion,
                                // 'Open_Inclusion' => $collection->open_inclusion,
                                
                            ]);
                            Diamond::insert($data);

                            
                        } 
                        
                        $Vendor = Vendor::where('vendor_id',$collection->vendor_id)->first();
                        if($Vendor == ""){
                            $vendordata = ([
                                'vendor_id' => $collection->vendor_id,
                                'vendor_phone' => $collection->vendor_phone,
                                'vendor_mobile_phone' => $collection->vendor_mobile_phone,
                                'vendor_email' => $collection->vendor_email,
                                'contact_person' => $collection->contact_person,
                                'vendor_street_address' => $collection->vendor_street_address,
                                'vendor_city' => $collection->vendor_city,
                                'vendor_state' => $collection->vendor_state,
                                'vendor_country' => $collection->vendor_country,
                                'vendor_zip_code' => $collection->vendor_zip_code,
                                'vendor_iphone' => $collection->vendor_iphone  
                        ]);
                        Vendor::insert($vendordata);
                        }else{
                            if(!in_array($collection->vendor_id,$vender_array)){
                                    Vendor::where('vendor_id',$collection->vendor_id)
                                        ->update([
                                            'vendor_phone' => $collection->vendor_phone,
                                            'vendor_mobile_phone' => $collection->vendor_mobile_phone,
                                            'vendor_email' => $collection->vendor_email,
                                            'contact_person' => $collection->contact_person,
                                            'vendor_street_address' => $collection->vendor_street_address,
                                            'vendor_city' => $collection->vendor_city,
                                            'vendor_state' => $collection->vendor_state,
                                            'vendor_country' => $collection->vendor_country,
                                            'vendor_zip_code' => $collection->vendor_zip_code,
                                            'vendor_iphone' => $collection->vendor_iphone 
                                        ]);
                                    
                                    array_push($vender_array,$collection->vendor_id);
                                        
                            }     
                        }
                    }  
                } 
            }    
        } 

        if(isset($total_diamond) && $total_diamond > 0){
           $totalpage = (int) floor(($total_diamond / 100));
           for ($x = 2; $x <= $totalpage + 1; $x++) {
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://apiservices.vdbapp.com/v2/diamonds?type=lab_grown_diamond&page_size=100&shapes[]=Round&shapes[]=Heart&shapes[]=Cushion&with_images=true&page_number='.$x,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Token token=M2wIRs87_aJJT2vlZjTviGG4m-v7jVvdfuCUHqGdu6k, api_key=_vYN1uFpastNYP2bmCsjtfA'
                ),
                ));
        
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                if ($err) {
                   return "cURL Error #:" . $err;
                } else {
                    $diamonds = json_decode($response);
                    if(isset($diamonds->response->body->diamonds)){ 
                        $total_diamond = $diamonds->response->body->total_diamonds_found;
                        foreach($diamonds->response->body->diamonds as $collection)
                        {
                            //dd($collection);
                            if((int)$collection->total_sales_price > 0 && $collection->total_sales_price != ""){
                                $Stone_No = $collection->stock_num;
                                
                                $PriceRanges = PriceRange::where('estatus',1)->get();
                                $amount = (int)$collection->total_sales_price;
        
                                $Company = Company::where('id',1)->first();
                                $company_per = $Company->company_percentage;
        
                                $company_per = 0;
                                foreach($PriceRanges as $PriceRange){
                                    if($PriceRange->start_price <=  $amount && $PriceRange->end_price >=  $amount){
                                        $company_per = $PriceRange->percentage;
                                        $type = $PriceRange->type;
                                    }
                                }
                                if($company_per > 0){
                                    if($type == 1){
                                        $company_per_amt = ((int)$collection->total_sales_price * $company_per)/100;
                                    }else{
                                        $company_per_amt = (int)$collection->total_sales_price + $company_per;
                                    }
                                }else{
                                    $company_per_amt = 0;
                                }
        
                                $sale_amt = round((int)$collection->total_sales_price + $company_per_amt);
        
                                if($collection->meas_length != "" && $collection->meas_width != "" && $collection->meas_depth != ""){     
                                    $DiamondMeasurement = $collection->meas_length.' * '.$collection->meas_width.' * '.$collection->meas_depth; 
                                }else{
                                    $DiamondMeasurement = "-";    
                                }

                                $percentage = rand(10, 30);
                                $percentage_amount = ($sale_amt * $percentage)/100;
                                $real_amt = round($percentage_amount + $sale_amt);

                        if($collection->short_title == "" || $collection->short_title == null || $collection->short_title == "N/A"){
                            $short_title = $collection->shape . " " . $collection->size . "ct " .$collection->color. " " .$collection->clarity; 
                        }else{
                            $short_title = $collection->short_title;
                        }

                        if($collection->long_title == "" || $collection->long_title == null || $collection->long_title == "N/A"){
                            $long_title =  $collection->shape . " " . $collection->size . "ct " .$collection->color. " " .$collection->clarity; 
                        }else{
                            $long_title = $collection->long_title;
                        }
                                
                                $Diamond = Diamond::where('diamond_id',$collection->id)->first();
                                if($Diamond){
                                
                                    $Diamond->Amt = $collection->total_sales_price;      
                                    $Diamond->Sale_Amt = $sale_amt;      
                                    $Diamond->real_Amt = $real_amt;
                                    $Diamond->short_title = $short_title;      
                                    $Diamond->long_title = $long_title;  
                                    $Diamond->slug = $this->createSlug($short_title,$Diamond->id);       
                                    $Diamond->amt_discount = $percentage;       
                                    $Diamond->shape = strtoupper($collection->shape); 
                                    $Diamond->Measurement = $DiamondMeasurement; 
                                    $Diamond->StockStatus = $collection->available;
                                    $Diamond->save();    
                                }else{ 
                                    $data = ([
                                        'Company_id' => 1,  
                                        'Stone_No' => $Stone_No,
                                        'diamond_id' => $collection->id,
                                        'short_title' => $short_title,
                                        'long_title' => $long_title,
                                        'slug' => $this->createSlug($short_title),
                                        'vendor_id' => $collection->vendor_id,
                                        'StockStatus' => $collection->available,
                                        'Weight' => $collection->size,
                                        'Lab_Report_No' => $collection->lab_sequence_no,
                                        'Location' => $collection->city.','.$collection->state.','.$collection->country,
                                        'Amt' => $collection->total_sales_price,
                                        'Sale_Amt' => $sale_amt,
                                        'real_Amt' => $real_amt,
                                        'amt_discount' => $percentage,
                                        'shape' => strtoupper($collection->shape),
                                        'Color' => $collection->color,
                                        'Measurement' =>  $DiamondMeasurement,
                                        'meas_length' => ($collection->meas_length)?$collection->meas_length:0,
                                        'meas_width' => ($collection->meas_width)?$collection->meas_width:0,
                                        'meas_depth' => ($collection->meas_depth)?$collection->meas_depth:0,
                                        'Certificate_url' => $collection->cert_url,
                                        'Video_url' => $collection->video_url,
                                        'Stone_Img_url' => isset($collection->image_url)?$collection->image_url:"",
                                        'Rate' => $collection->price_per_carat,
                                        'Lab' => $collection->lab,
                                        'FancyColorIntens' => $collection->fancy_color_intensity,
                                        'FancyColorOvertone' => $collection->fancy_color_overtone,
                                        'FancyColor' => $collection->fancy_color_dominant_color,
                                        'Symm' =>  $collection->symmetry,
                                        'Polish' => $collection->polish,
                                        'Clarity' => $collection->clarity,
                                        'Cut' => $collection->cut,
                                        'Total_Depth_Per' => $collection->depth_percent,
                                        'Table_Diameter_Per' => $collection->table_percent,
                                        'GirdleThin_ID' => $collection->girdle_min,
                                        'GirdleThick_ID' => $collection->girdle_max,
                                        'FlrColor' => $collection->fluor_color,
                                        'FlrIntens' => $collection->fluor_intensity,
                                        'CrownHeight' => $collection->crown_height,
                                        'CrownAngle' => $collection->crown_angle,
                                        'PavillionHeight' => $collection->pavilion_depth,
                                        'PavillionAngle' => $collection->pavilion_angle,
                                        'Eyeclean' => $collection->eye_clean,
                                        'Discount' => $collection->discount_percent,
                                        'Girdle_Per' => $collection->girdle_percent,
                                        
                                        
                                        // 'Milkey' => $collection->milky,
                                        
                                        'Culet_Size_ID' => $collection->culet_size,
                                        'Ratio' => $collection->meas_ratio,
                                        'growth_type' => $collection->growth_type,
                                        // 'Culet_Condition_ID' => $collection->culet_condition,
                                        
                                        
                                        
                                        
                                        // 'Laser_Inscription' => $collection->inscription,
                                        // 'Stone_Comment' => $collection->cert_comment,
                                        // 'KeyToSymbols' => $keytosymbols,
                                        // 'Black_Inclusion' => $collection->black_inclusion,
                                        // 'Open_Inclusion' => $collection->open_inclusion,
                                        
                                    ]);
                                    Diamond::insert($data);
        
                                    
                                } 
                                
                                // $Vendor = Vendor::where('vendor_id',$collection->vendor_id)->first();
                                // if($Vendor == ""){
                                //     $vendordata = ([
                                //         'vendor_id' => $collection->vendor_id,
                                //         'vendor_phone' => $collection->vendor_phone,
                                //         'vendor_mobile_phone' => $collection->vendor_mobile_phone,
                                //         'vendor_email' => $collection->vendor_email,
                                //         'contact_person' => $collection->contact_person,
                                //         'vendor_street_address' => $collection->vendor_street_address,
                                //         'vendor_city' => $collection->vendor_city,
                                //         'vendor_state' => $collection->vendor_state,
                                //         'vendor_country' => $collection->vendor_country,
                                //         'vendor_zip_code' => $collection->vendor_zip_code,
                                //         'vendor_iphone' => $collection->vendor_iphone  
                                // ]);
                                // Vendor::insert($vendordata);
                                // }else{
                                //     if(!in_array($collection->vendor_id,$vender_array)){
                                //             Vendor::where('vendor_id',$collection->vendor_id)
                                //                 ->update([
                                //                     'vendor_phone' => $collection->vendor_phone,
                                //                     'vendor_mobile_phone' => $collection->vendor_mobile_phone,
                                //                     'vendor_email' => $collection->vendor_email,
                                //                     'contact_person' => $collection->contact_person,
                                //                     'vendor_street_address' => $collection->vendor_street_address,
                                //                     'vendor_city' => $collection->vendor_city,
                                //                     'vendor_state' => $collection->vendor_state,
                                //                     'vendor_country' => $collection->vendor_country,
                                //                     'vendor_zip_code' => $collection->vendor_zip_code,
                                //                     'vendor_iphone' => $collection->vendor_iphone 
                                //                 ]);
                                            
                                //             array_push($vender_array,$collection->vendor_id);
                                                
                                //     }     
                                // }
                            }  
                        } 
                    }    
                }
           }
        }

        $action = "add";
        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function importnewdiamond1(Request $request){
        set_time_limit(0);
        // $public_path = __DIR__ . '/../../../../public/csv/vdb_LG_diamonds.csv';
        // Excel::import(new ImportDiamondNewLatest, $public_path);
        // $action = "add";
        $vender_array = array(); 
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://apiservices.vdbapp.com/v2/diamonds?type=lab_grown_diamond&page_size=100&page_number=1&shapes[]=Asscher&shapes[]=Emerald&shapes[]=Oval&with_images=true',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Token token=M2wIRs87_aJJT2vlZjTviGG4m-v7jVvdfuCUHqGdu6k, api_key=_vYN1uFpastNYP2bmCsjtfA'
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
           return "cURL Error #:" . $err;
        } else {
            $diamonds = json_decode($response);
            if(isset($diamonds->response->body->diamonds)){ 
                $total_diamond = $diamonds->response->body->total_diamonds_found;
                foreach($diamonds->response->body->diamonds as $collection)
                {
                    //dd($collection);
                    if((int)$collection->total_sales_price > 0 && $collection->total_sales_price != ""){
                        $Stone_No = $collection->stock_num;
                        
                        $PriceRanges = PriceRange::where('estatus',1)->get();
                        $amount = (int)$collection->total_sales_price;

                        $Company = Company::where('id',1)->first();
                        $company_per = $Company->company_percentage;

                        $company_per = 0;
                        foreach($PriceRanges as $PriceRange){
                            if($PriceRange->start_price <=  $amount && $PriceRange->end_price >=  $amount){
                                $company_per = $PriceRange->percentage;
                                $type = $PriceRange->type;
                            }
                        }
                        if($company_per > 0){
                            if($type == 1){
                                $company_per_amt = ((int)$collection->total_sales_price * $company_per)/100;
                            }else{
                                $company_per_amt = (int)$collection->total_sales_price + $company_per;
                            }
                        }else{
                            $company_per_amt = 0;
                        }

                        $sale_amt = round((int)$collection->total_sales_price + $company_per_amt);

                        if($collection->meas_length != "" && $collection->meas_width != "" && $collection->meas_depth != ""){     
                            $DiamondMeasurement = $collection->meas_length.' * '.$collection->meas_width.' * '.$collection->meas_depth; 
                        }else{
                            $DiamondMeasurement = "-";    
                        }

                        $percentage = rand(10, 30);
                        $percentage_amount = ($sale_amt * $percentage)/100;
                        $real_amt = round($percentage_amount + $sale_amt);

                        if($collection->short_title == "" || $collection->short_title == null || $collection->short_title == "N/A"){
                            $short_title = $collection->shape . " " . $collection->size . "ct " .$collection->color. " " .$collection->clarity; 
                        }else{
                            $short_title = $collection->short_title;
                        }

                        if($collection->long_title == "" || $collection->long_title == null || $collection->long_title == "N/A"){
                            $long_title =  $collection->shape . " " . $collection->size . "ct " .$collection->color. " " .$collection->clarity; 
                        }else{
                            $long_title = $collection->long_title;
                        }
                        
                        $Diamond = Diamond::where('diamond_id',$collection->id)->first();
                        if($Diamond){
                        
                            $Diamond->Amt = $collection->total_sales_price;      
                            $Diamond->Sale_Amt = $sale_amt;      
                            $Diamond->real_Amt = $real_amt; 
                            $Diamond->short_title = $short_title; 
                            $Diamond->long_title = $long_title; 
                            $Diamond->slug = $this->createSlug($short_title,$Diamond->id);     
                            $Diamond->amt_discount = $percentage;       
                            $Diamond->shape = strtoupper($collection->shape); 
                            $Diamond->Measurement = $DiamondMeasurement; 
                                    $Diamond->StockStatus = $collection->available;
                                    $Diamond->save();    
                        }else{ 
                            $data = ([
                                'Company_id' => 1,  
                                'Stone_No' => $Stone_No,
                                'diamond_id' => $collection->id,
                                'short_title' => $short_title,
                                'long_title' => $long_title,
                                'slug' => $this->createSlug($short_title),
                                'vendor_id' => $collection->vendor_id,
                                'StockStatus' => $collection->available,
                                'Weight' => $collection->size,
                                'Lab_Report_No' => $collection->lab_sequence_no,
                                'Location' => $collection->city.','.$collection->state.','.$collection->country,
                                'Amt' => $collection->total_sales_price,
                                'Sale_Amt' => $sale_amt,
                                'real_Amt' => $real_amt,
                                'amt_discount' => $percentage,
                                'shape' => strtoupper($collection->shape),
                                'Color' => $collection->color,
                                'Measurement' =>  $DiamondMeasurement,
                                'meas_length' => ($collection->meas_length)?$collection->meas_length:0,
                                'meas_width' => ($collection->meas_width)?$collection->meas_width:0,
                                'meas_depth' => ($collection->meas_depth)?$collection->meas_depth:0,
                                'Certificate_url' => $collection->cert_url,
                                'Video_url' => $collection->video_url,
                                'Stone_Img_url' => isset($collection->image_url)?$collection->image_url:"",
                                'Rate' => $collection->price_per_carat,
                                'Lab' => $collection->lab,
                                'FancyColorIntens' => $collection->fancy_color_intensity,
                                'FancyColorOvertone' => $collection->fancy_color_overtone,
                                'FancyColor' => $collection->fancy_color_dominant_color,
                                'Symm' =>  $collection->symmetry,
                                'Polish' => $collection->polish,
                                'Clarity' => $collection->clarity,
                                'Cut' => $collection->cut,
                                'Total_Depth_Per' => $collection->depth_percent,
                                'Table_Diameter_Per' => $collection->table_percent,
                                'GirdleThin_ID' => $collection->girdle_min,
                                'GirdleThick_ID' => $collection->girdle_max,
                                'FlrColor' => $collection->fluor_color,
                                'FlrIntens' => $collection->fluor_intensity,
                                'CrownHeight' => $collection->crown_height,
                                'CrownAngle' => $collection->crown_angle,
                                'PavillionHeight' => $collection->pavilion_depth,
                                'PavillionAngle' => $collection->pavilion_angle,
                                'Eyeclean' => $collection->eye_clean,
                                'Discount' => $collection->discount_percent,
                                'Girdle_Per' => $collection->girdle_percent,
                                
                                
                                // 'Milkey' => $collection->milky,
                                
                                'Culet_Size_ID' => $collection->culet_size,
                                'Ratio' => $collection->meas_ratio,
                                'growth_type' => $collection->growth_type,
                                // 'Culet_Condition_ID' => $collection->culet_condition,
                                'created_at' => new \DateTime(null, new \DateTimeZone('Asia/Kolkata')),
                                
                                
                                
                                // 'Laser_Inscription' => $collection->inscription,
                                // 'Stone_Comment' => $collection->cert_comment,
                                // 'KeyToSymbols' => $keytosymbols,
                                // 'Black_Inclusion' => $collection->black_inclusion,
                                // 'Open_Inclusion' => $collection->open_inclusion,
                                
                            ]);
                            Diamond::insert($data);

                            
                        } 
                        
                        $Vendor = Vendor::where('vendor_id',$collection->vendor_id)->first();
                        if($Vendor == ""){
                            $vendordata = ([
                                'vendor_id' => $collection->vendor_id,
                                'vendor_phone' => $collection->vendor_phone,
                                'vendor_mobile_phone' => $collection->vendor_mobile_phone,
                                'vendor_email' => $collection->vendor_email,
                                'contact_person' => $collection->contact_person,
                                'vendor_street_address' => $collection->vendor_street_address,
                                'vendor_city' => $collection->vendor_city,
                                'vendor_state' => $collection->vendor_state,
                                'vendor_country' => $collection->vendor_country,
                                'vendor_zip_code' => $collection->vendor_zip_code,
                                'vendor_iphone' => $collection->vendor_iphone  
                        ]);
                        Vendor::insert($vendordata);
                        }else{
                            if(!in_array($collection->vendor_id,$vender_array)){
                                    Vendor::where('vendor_id',$collection->vendor_id)
                                        ->update([
                                            'vendor_phone' => $collection->vendor_phone,
                                            'vendor_mobile_phone' => $collection->vendor_mobile_phone,
                                            'vendor_email' => $collection->vendor_email,
                                            'contact_person' => $collection->contact_person,
                                            'vendor_street_address' => $collection->vendor_street_address,
                                            'vendor_city' => $collection->vendor_city,
                                            'vendor_state' => $collection->vendor_state,
                                            'vendor_country' => $collection->vendor_country,
                                            'vendor_zip_code' => $collection->vendor_zip_code,
                                            'vendor_iphone' => $collection->vendor_iphone 
                                        ]);
                                    
                                    array_push($vender_array,$collection->vendor_id);
                                        
                            }     
                        }
                    }  
                } 
            }    
        } 

        if(isset($total_diamond) && $total_diamond > 0){
           $totalpage = (int) floor(($total_diamond / 100));
           for ($x = 2; $x <= $totalpage + 1; $x++) {
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://apiservices.vdbapp.com/v2/diamonds?type=lab_grown_diamond&page_size=100&shapes[]=Asscher&shapes[]=Emerald&shapes[]=Oval&with_images=true&page_number='.$x,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Token token=M2wIRs87_aJJT2vlZjTviGG4m-v7jVvdfuCUHqGdu6k, api_key=_vYN1uFpastNYP2bmCsjtfA'
                ),
                ));
        
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                if ($err) {
                   return "cURL Error #:" . $err;
                } else {
                    $diamonds = json_decode($response);
                    if(isset($diamonds->response->body->diamonds)){ 
                        $total_diamond = $diamonds->response->body->total_diamonds_found;
                        foreach($diamonds->response->body->diamonds as $collection)
                        {
                            //dd($collection);
                            if((int)$collection->total_sales_price > 0 && $collection->total_sales_price != ""){
                                $Stone_No = $collection->stock_num;
                                
                                $PriceRanges = PriceRange::where('estatus',1)->get();
                                $amount = (int)$collection->total_sales_price;
        
                                $Company = Company::where('id',1)->first();
                                $company_per = $Company->company_percentage;
        
                                $company_per = 0;
                                foreach($PriceRanges as $PriceRange){
                                    if($PriceRange->start_price <=  $amount && $PriceRange->end_price >=  $amount){
                                        $company_per = $PriceRange->percentage;
                                        $type = $PriceRange->type;
                                    }
                                }
                                if($company_per > 0){
                                    if($type == 1){
                                        $company_per_amt = ((int)$collection->total_sales_price * $company_per)/100;
                                    }else{
                                        $company_per_amt = (int)$collection->total_sales_price + $company_per;
                                    }
                                }else{
                                    $company_per_amt = 0;
                                }
        
                                $sale_amt = round((int)$collection->total_sales_price + $company_per_amt);
        
                                if($collection->meas_length != "" && $collection->meas_width != "" && $collection->meas_depth != ""){     
                                    $DiamondMeasurement = $collection->meas_length.' * '.$collection->meas_width.' * '.$collection->meas_depth; 
                                }else{
                                    $DiamondMeasurement = "-";    
                                }

                                $percentage = rand(10, 30);
                                $percentage_amount = ($sale_amt * $percentage)/100;
                                $real_amt = round($percentage_amount + $sale_amt);

                        if($collection->short_title == "" || $collection->short_title == null || $collection->short_title == "N/A"){
                            $short_title = $collection->shape . " " . $collection->size . "ct " .$collection->color. " " .$collection->clarity; 
                        }else{
                            $short_title = $collection->short_title;
                        }

                        if($collection->long_title == "" || $collection->long_title == null || $collection->long_title == "N/A"){
                            $long_title =  $collection->shape . " " . $collection->size . "ct " .$collection->color. " " .$collection->clarity; 
                        }else{
                            $long_title = $collection->long_title;
                        }
                                
                                $Diamond = Diamond::where('diamond_id',$collection->id)->first();
                                if($Diamond){
                                
                                    $Diamond->Amt = $collection->total_sales_price;      
                                    $Diamond->Sale_Amt = $sale_amt;      
                                    $Diamond->real_Amt = $real_amt;
                                    $Diamond->short_title = $short_title;      
                                    $Diamond->long_title = $long_title;  
                                    $Diamond->slug = $this->createSlug($short_title,$Diamond->id);      
                                    $Diamond->amt_discount = $percentage;       
                                    $Diamond->shape = strtoupper($collection->shape); 
                                    $Diamond->Measurement = $DiamondMeasurement; 
                                    $Diamond->StockStatus = $collection->available;
                                    $Diamond->save();    
                                }else{ 
                                    $data = ([
                                        'Company_id' => 1,  
                                        'Stone_No' => $Stone_No,
                                        'diamond_id' => $collection->id,
                                        'short_title' => $short_title,
                                        'long_title' => $long_title,
                                        'slug' => $this->createSlug($short_title),
                                        'vendor_id' => $collection->vendor_id,
                                        'StockStatus' => $collection->available,
                                        'Weight' => $collection->size,
                                        'Lab_Report_No' => $collection->lab_sequence_no,
                                        'Location' => $collection->city.','.$collection->state.','.$collection->country,
                                        'Amt' => $collection->total_sales_price,
                                        'Sale_Amt' => $sale_amt,
                                        'real_Amt' => $real_amt,
                                        'amt_discount' => $percentage,
                                        'shape' => strtoupper($collection->shape),
                                        'Color' => $collection->color,
                                        'Measurement' =>  $DiamondMeasurement,
                                        'meas_length' => ($collection->meas_length)?$collection->meas_length:0,
                                        'meas_width' => ($collection->meas_width)?$collection->meas_width:0,
                                        'meas_depth' => ($collection->meas_depth)?$collection->meas_depth:0,
                                        'Certificate_url' => $collection->cert_url,
                                        'Video_url' => $collection->video_url,
                                        'Stone_Img_url' => isset($collection->image_url)?$collection->image_url:"",
                                        'Rate' => $collection->price_per_carat,
                                        'Lab' => $collection->lab,
                                        'FancyColorIntens' => $collection->fancy_color_intensity,
                                        'FancyColorOvertone' => $collection->fancy_color_overtone,
                                        'FancyColor' => $collection->fancy_color_dominant_color,
                                        'Symm' =>  $collection->symmetry,
                                        'Polish' => $collection->polish,
                                        'Clarity' => $collection->clarity,
                                        'Cut' => $collection->cut,
                                        'Total_Depth_Per' => $collection->depth_percent,
                                        'Table_Diameter_Per' => $collection->table_percent,
                                        'GirdleThin_ID' => $collection->girdle_min,
                                        'GirdleThick_ID' => $collection->girdle_max,
                                        'FlrColor' => $collection->fluor_color,
                                        'FlrIntens' => $collection->fluor_intensity,
                                        'CrownHeight' => $collection->crown_height,
                                        'CrownAngle' => $collection->crown_angle,
                                        'PavillionHeight' => $collection->pavilion_depth,
                                        'PavillionAngle' => $collection->pavilion_angle,
                                        'Eyeclean' => $collection->eye_clean,
                                        'Discount' => $collection->discount_percent,
                                        'Girdle_Per' => $collection->girdle_percent,
                                        
                                        
                                        // 'Milkey' => $collection->milky,
                                        
                                        'Culet_Size_ID' => $collection->culet_size,
                                        'Ratio' => $collection->meas_ratio,
                                        'growth_type' => $collection->growth_type,
                                        // 'Culet_Condition_ID' => $collection->culet_condition,
                                        'created_at' => new \DateTime(null, new \DateTimeZone('Asia/Kolkata')),
                                        
                                        
                                        
                                        // 'Laser_Inscription' => $collection->inscription,
                                        // 'Stone_Comment' => $collection->cert_comment,
                                        // 'KeyToSymbols' => $keytosymbols,
                                        // 'Black_Inclusion' => $collection->black_inclusion,
                                        // 'Open_Inclusion' => $collection->open_inclusion,
                                        
                                    ]);
                                    Diamond::insert($data);
        
                                    
                                } 
                                
                             
                            }  
                        } 
                    }    
                }
           }
        }

        $action = "add";
        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function importnewdiamond2(Request $request){
        set_time_limit(0);
        // $public_path = __DIR__ . '/../../../../public/csv/vdb_LG_diamonds.csv';
        // Excel::import(new ImportDiamondNewLatest, $public_path);
        // $action = "add";
        $vender_array = array(); 
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://apiservices.vdbapp.com/v2/diamonds?type=lab_grown_diamond&page_size=100&page_number=1&shapes[]=Radiant&shapes[]=Marquise&shapes[]=Princess&shapes[]=Pear&with_images=true',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Token token=M2wIRs87_aJJT2vlZjTviGG4m-v7jVvdfuCUHqGdu6k, api_key=_vYN1uFpastNYP2bmCsjtfA'
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
           return "cURL Error #:" . $err;
        } else {
            $diamonds = json_decode($response);
            if(isset($diamonds->response->body->diamonds)){ 
                $total_diamond = $diamonds->response->body->total_diamonds_found;
                foreach($diamonds->response->body->diamonds as $collection)
                {
                    //dd($collection);
                    if((int)$collection->total_sales_price > 0 && $collection->total_sales_price != ""){
                        $Stone_No = $collection->stock_num;
                        
                        $PriceRanges = PriceRange::where('estatus',1)->get();
                        $amount = (int)$collection->total_sales_price;

                        $Company = Company::where('id',1)->first();
                        $company_per = $Company->company_percentage;

                        $company_per = 0;
                        foreach($PriceRanges as $PriceRange){
                            if($PriceRange->start_price <=  $amount && $PriceRange->end_price >=  $amount){
                                $company_per = $PriceRange->percentage;
                                $type = $PriceRange->type;
                            }
                        }
                        if($company_per > 0){
                            if($type == 1){
                                $company_per_amt = ((int)$collection->total_sales_price * $company_per)/100;
                            }else{
                                $company_per_amt = (int)$collection->total_sales_price + $company_per;
                            }
                        }else{
                            $company_per_amt = 0;
                        }

                        $sale_amt = round((int)$collection->total_sales_price + $company_per_amt);

                        if($collection->meas_length != "" && $collection->meas_width != "" && $collection->meas_depth != ""){     
                            $DiamondMeasurement = $collection->meas_length.' * '.$collection->meas_width.' * '.$collection->meas_depth; 
                        }else{
                            $DiamondMeasurement = "-";    
                        }

                        $percentage = rand(10, 30);
                        $percentage_amount = ($sale_amt * $percentage)/100;
                        $real_amt = round($percentage_amount + $sale_amt);

                        if($collection->short_title == "" || $collection->short_title == null || $collection->short_title == "N/A"){
                            $short_title = $collection->shape . " " . $collection->size . "ct " .$collection->color. " " .$collection->clarity; 
                        }else{
                            $short_title = $collection->short_title;
                        }

                        if($collection->long_title == "" || $collection->long_title == null || $collection->long_title == "N/A"){
                            $long_title =  $collection->shape . " " . $collection->size . "ct " .$collection->color. " " .$collection->clarity; 
                        }else{
                            $long_title = $collection->long_title;
                        }
                        
                        $Diamond = Diamond::where('diamond_id',$collection->id)->first();
                        if($Diamond){
                        
                            $Diamond->Amt = $collection->total_sales_price;      
                            $Diamond->Sale_Amt = $sale_amt;      
                            $Diamond->real_Amt = $real_amt;
                                    $Diamond->short_title = $short_title;      
                                    $Diamond->long_title = $long_title;  
                                    $Diamond->slug = $this->createSlug($short_title,$Diamond->id);      
                            $Diamond->amt_discount = $percentage;       
                            $Diamond->shape = strtoupper($collection->shape); 
                            $Diamond->Measurement = $DiamondMeasurement; 
                                    $Diamond->StockStatus = $collection->available;
                                    $Diamond->save();    
                        }else{ 
                            $data = ([
                                'Company_id' => 1,  
                                'Stone_No' => $Stone_No,
                                'diamond_id' => $collection->id,
                                'short_title' => $short_title,
                                'long_title' => $long_title,
                                'slug' => $this->createSlug($short_title),
                                'vendor_id' => $collection->vendor_id,
                                'StockStatus' => $collection->available,
                                'Weight' => $collection->size,
                                'Lab_Report_No' => $collection->lab_sequence_no,
                                'Location' => $collection->city.','.$collection->state.','.$collection->country,
                                'Amt' => $collection->total_sales_price,
                                'Sale_Amt' => $sale_amt,
                                'real_Amt' => $real_amt,
                                'amt_discount' => $percentage,
                                'shape' => strtoupper($collection->shape),
                                'Color' => $collection->color,
                                'Measurement' =>  $DiamondMeasurement,
                                'meas_length' => ($collection->meas_length)?$collection->meas_length:0,
                                'meas_width' => ($collection->meas_width)?$collection->meas_width:0,
                                'meas_depth' => ($collection->meas_depth)?$collection->meas_depth:0,
                                'Certificate_url' => $collection->cert_url,
                                'Video_url' => $collection->video_url,
                                'Stone_Img_url' => isset($collection->image_url)?$collection->image_url:"",
                                'Rate' => $collection->price_per_carat,
                                'Lab' => $collection->lab,
                                'FancyColorIntens' => $collection->fancy_color_intensity,
                                'FancyColorOvertone' => $collection->fancy_color_overtone,
                                'FancyColor' => $collection->fancy_color_dominant_color,
                                'Symm' =>  $collection->symmetry,
                                'Polish' => $collection->polish,
                                'Clarity' => $collection->clarity,
                                'Cut' => $collection->cut,
                                'Total_Depth_Per' => $collection->depth_percent,
                                'Table_Diameter_Per' => $collection->table_percent,
                                'GirdleThin_ID' => $collection->girdle_min,
                                'GirdleThick_ID' => $collection->girdle_max,
                                'FlrColor' => $collection->fluor_color,
                                'FlrIntens' => $collection->fluor_intensity,
                                'CrownHeight' => $collection->crown_height,
                                'CrownAngle' => $collection->crown_angle,
                                'PavillionHeight' => $collection->pavilion_depth,
                                'PavillionAngle' => $collection->pavilion_angle,
                                'Eyeclean' => $collection->eye_clean,
                                'Discount' => $collection->discount_percent,
                                'Girdle_Per' => $collection->girdle_percent,
                                
                                
                                // 'Milkey' => $collection->milky,
                                
                                'Culet_Size_ID' => $collection->culet_size,
                                'Ratio' => $collection->meas_ratio,
                                'growth_type' => $collection->growth_type,
                                // 'Culet_Condition_ID' => $collection->culet_condition,
                                'created_at' => new \DateTime(null, new \DateTimeZone('Asia/Kolkata')),
                                
                                
                                
                                // 'Laser_Inscription' => $collection->inscription,
                                // 'Stone_Comment' => $collection->cert_comment,
                                // 'KeyToSymbols' => $keytosymbols,
                                // 'Black_Inclusion' => $collection->black_inclusion,
                                // 'Open_Inclusion' => $collection->open_inclusion,
                                
                            ]);
                            Diamond::insert($data);

                            
                        } 
                        
                        $Vendor = Vendor::where('vendor_id',$collection->vendor_id)->first();
                        if($Vendor == ""){
                            $vendordata = ([
                                'vendor_id' => $collection->vendor_id,
                                'vendor_phone' => $collection->vendor_phone,
                                'vendor_mobile_phone' => $collection->vendor_mobile_phone,
                                'vendor_email' => $collection->vendor_email,
                                'contact_person' => $collection->contact_person,
                                'vendor_street_address' => $collection->vendor_street_address,
                                'vendor_city' => $collection->vendor_city,
                                'vendor_state' => $collection->vendor_state,
                                'vendor_country' => $collection->vendor_country,
                                'vendor_zip_code' => $collection->vendor_zip_code,
                                'vendor_iphone' => $collection->vendor_iphone  
                        ]);
                        Vendor::insert($vendordata);
                        }else{
                            if(!in_array($collection->vendor_id,$vender_array)){
                                    Vendor::where('vendor_id',$collection->vendor_id)
                                        ->update([
                                            'vendor_phone' => $collection->vendor_phone,
                                            'vendor_mobile_phone' => $collection->vendor_mobile_phone,
                                            'vendor_email' => $collection->vendor_email,
                                            'contact_person' => $collection->contact_person,
                                            'vendor_street_address' => $collection->vendor_street_address,
                                            'vendor_city' => $collection->vendor_city,
                                            'vendor_state' => $collection->vendor_state,
                                            'vendor_country' => $collection->vendor_country,
                                            'vendor_zip_code' => $collection->vendor_zip_code,
                                            'vendor_iphone' => $collection->vendor_iphone 
                                        ]);
                                    
                                    array_push($vender_array,$collection->vendor_id);
                                        
                            }     
                        }
                    }  
                } 
            }    
        } 

        if(isset($total_diamond) && $total_diamond > 0){
           $totalpage = (int) floor(($total_diamond / 100));
           for ($x = 2; $x <= $totalpage + 1; $x++) {
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://apiservices.vdbapp.com/v2/diamonds?type=lab_grown_diamond&page_size=100&shapes[]=Radiant&shapes[]=Marquise&shapes[]=Princess&shapes[]=Pear&with_images=true&page_number='.$x,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Token token=M2wIRs87_aJJT2vlZjTviGG4m-v7jVvdfuCUHqGdu6k, api_key=_vYN1uFpastNYP2bmCsjtfA'
                ),
                ));
        
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                if ($err) {
                   return "cURL Error #:" . $err;
                } else {
                    $diamonds = json_decode($response);
                    if(isset($diamonds->response->body->diamonds)){ 
                        $total_diamond = $diamonds->response->body->total_diamonds_found;
                        foreach($diamonds->response->body->diamonds as $collection)
                        {
                            //dd($collection);
                            if((int)$collection->total_sales_price > 0 && $collection->total_sales_price != ""){
                                $Stone_No = $collection->stock_num;
                                
                                $PriceRanges = PriceRange::where('estatus',1)->get();
                                $amount = (int)$collection->total_sales_price;
        
                                $Company = Company::where('id',1)->first();
                                $company_per = $Company->company_percentage;
        
                                $company_per = 0;
                                foreach($PriceRanges as $PriceRange){
                                    if($PriceRange->start_price <=  $amount && $PriceRange->end_price >=  $amount){
                                        $company_per = $PriceRange->percentage;
                                        $type = $PriceRange->type;
                                    }
                                }
                                if($company_per > 0){
                                    if($type == 1){
                                        $company_per_amt = ((int)$collection->total_sales_price * $company_per)/100;
                                    }else{
                                        $company_per_amt = (int)$collection->total_sales_price + $company_per;
                                    }
                                }else{
                                    $company_per_amt = 0;
                                }
        
                                $sale_amt = round((int)$collection->total_sales_price + $company_per_amt);
        
                                if($collection->meas_length != "" && $collection->meas_width != "" && $collection->meas_depth != ""){     
                                    $DiamondMeasurement = $collection->meas_length.' * '.$collection->meas_width.' * '.$collection->meas_depth; 
                                }else{
                                    $DiamondMeasurement = "-";    
                                }

                                $percentage = rand(10, 30);
                                $percentage_amount = ($sale_amt * $percentage)/100;
                                $real_amt = round($percentage_amount + $sale_amt);

                        if($collection->short_title == "" || $collection->short_title == null || $collection->short_title == "N/A"){
                            $short_title = $collection->shape . " " . $collection->size . "ct " .$collection->color. " " .$collection->clarity; 
                        }else{
                            $short_title = $collection->short_title;
                        }

                        if($collection->long_title == "" || $collection->long_title == null || $collection->long_title == "N/A"){
                            $long_title =  $collection->shape . " " . $collection->size . "ct " .$collection->color. " " .$collection->clarity; 
                        }else{
                            $long_title = $collection->long_title;
                        }
                                
                                $Diamond = Diamond::where('diamond_id',$collection->id)->first();
                                if($Diamond){
                                
                                    $Diamond->Amt = $collection->total_sales_price;      
                                    $Diamond->Sale_Amt = $sale_amt;      
                                    $Diamond->real_Amt = $real_amt;
                                    $Diamond->short_title = $short_title;      
                                    $Diamond->long_title = $long_title;  
                                    $Diamond->slug = $this->createSlug($short_title,$Diamond->id);      
                                    $Diamond->amt_discount = $percentage;      
                                    $Diamond->shape = strtoupper($collection->shape); 
                                    $Diamond->Measurement = $DiamondMeasurement; 
                                    $Diamond->StockStatus = $collection->available;
                                    $Diamond->save();    
                                }else{ 
                                    $data = ([
                                        'Company_id' => 1,  
                                        'Stone_No' => $Stone_No,
                                        'diamond_id' => $collection->id,
                                        'short_title' => $short_title,
                                        'long_title' => $long_title,
                                        'slug' => $this->createSlug($short_title),
                                        'vendor_id' => $collection->vendor_id,
                                        'StockStatus' => $collection->available,
                                        'Weight' => $collection->size,
                                        'Lab_Report_No' => $collection->lab_sequence_no,
                                        'Location' => $collection->city.','.$collection->state.','.$collection->country,
                                        'Amt' => $collection->total_sales_price,
                                        'Sale_Amt' => $sale_amt,
                                        'real_Amt' => $real_amt,
                                        'amt_discount' => $percentage,
                                        'shape' => strtoupper($collection->shape),
                                        'Color' => $collection->color,
                                        'Measurement' =>  $DiamondMeasurement,
                                        'meas_length' => ($collection->meas_length)?$collection->meas_length:0,
                                        'meas_width' => ($collection->meas_width)?$collection->meas_width:0,
                                        'meas_depth' => ($collection->meas_depth)?$collection->meas_depth:0,
                                        'Certificate_url' => $collection->cert_url,
                                        'Video_url' => $collection->video_url,
                                        'Stone_Img_url' => isset($collection->image_url)?$collection->image_url:"",
                                        'Rate' => $collection->price_per_carat,
                                        'Lab' => $collection->lab,
                                        'FancyColorIntens' => $collection->fancy_color_intensity,
                                        'FancyColorOvertone' => $collection->fancy_color_overtone,
                                        'FancyColor' => $collection->fancy_color_dominant_color,
                                        'Symm' =>  $collection->symmetry,
                                        'Polish' => $collection->polish,
                                        'Clarity' => $collection->clarity,
                                        'Cut' => $collection->cut,
                                        'Total_Depth_Per' => $collection->depth_percent,
                                        'Table_Diameter_Per' => $collection->table_percent,
                                        'GirdleThin_ID' => $collection->girdle_min,
                                        'GirdleThick_ID' => $collection->girdle_max,
                                        'FlrColor' => $collection->fluor_color,
                                        'FlrIntens' => $collection->fluor_intensity,
                                        'CrownHeight' => $collection->crown_height,
                                        'CrownAngle' => $collection->crown_angle,
                                        'PavillionHeight' => $collection->pavilion_depth,
                                        'PavillionAngle' => $collection->pavilion_angle,
                                        'Eyeclean' => $collection->eye_clean,
                                        'Discount' => $collection->discount_percent,
                                        'Girdle_Per' => $collection->girdle_percent,
                                        
                                        
                                        // 'Milkey' => $collection->milky,
                                        
                                        'Culet_Size_ID' => $collection->culet_size,
                                        'Ratio' => $collection->meas_ratio,
                                        'growth_type' => $collection->growth_type,
                                        // 'Culet_Condition_ID' => $collection->culet_condition,
                                        'created_at' => new \DateTime(null, new \DateTimeZone('Asia/Kolkata')),
                                        
                                        
                                        
                                        // 'Laser_Inscription' => $collection->inscription,
                                        // 'Stone_Comment' => $collection->cert_comment,
                                        // 'KeyToSymbols' => $keytosymbols,
                                        // 'Black_Inclusion' => $collection->black_inclusion,
                                        // 'Open_Inclusion' => $collection->open_inclusion,
                                        
                                    ]);
                                    Diamond::insert($data);
           
                                } 
                                
                            }  
                        } 
                    }    
                }
           }
        }

        $action = "add";
        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function importnewdiamond3(Request $request){
        set_time_limit(0);
        // $public_path = __DIR__ . '/../../../../public/csv/vdb_LG_diamonds.csv';
        // Excel::import(new ImportDiamondNewLatest, $public_path);
        // $action = "add";
        $vender_array = array(); 
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://apiservices.vdbapp.com/v2/diamonds?type=lab_grown_diamond&page_size=100&with_images=true&shapes%5B%5D=Briolette&shapes%5B%5D=Eurocut&shapes%5B%5D=Flanders&shapes%5B%5D=Half%20Moon&shapes%5B%5D=Kite&shapes%5B%5D=Old%20Miner&shapes%5B%5D=Bullet&shapes%5B%5D=Hexagonal&shapes%5B%5D=Lozenge&shapes%5B%5D=Tapered%20Bullet&shapes%5B%5D=Octagonal&shapes%5B%5D=Triangle&shapes%5B%5D=Rose%20Cut&shapes%5B%5D=Ideal%20Oval&shapes%5B%5D=Ideal%20Square&shapes%5B%5D=Square%20Emerald&shapes%5B%5D=Sig81&shapes%5B%5D=Cushion%20Modified%20Brilliant&shapes%5B%5D=Ideal%20Cushion&shapes%5B%5D=Pentagonal&shapes%5B%5D=Star&shapes%5B%5D=Trapezoid&shapes%5B%5D=Trilliant&shapes%5B%5D=Baguette&shapes%5B%5D=Shield&shapes%5B%5D=Tapered%20Baguette&shapes%5B%5D=Ideal%20Heart&shapes%5B%5D=Other&page_number=1',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Token token=M2wIRs87_aJJT2vlZjTviGG4m-v7jVvdfuCUHqGdu6k, api_key=_vYN1uFpastNYP2bmCsjtfA'
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
           return "cURL Error #:" . $err;
        } else {
            $diamonds = json_decode($response);
            if(isset($diamonds->response->body->diamonds)){ 
                $total_diamond = $diamonds->response->body->total_diamonds_found;
                foreach($diamonds->response->body->diamonds as $collection)
                {
                    //dd($collection);
                    if((int)$collection->total_sales_price > 0 && $collection->total_sales_price != ""){
                        $Stone_No = $collection->stock_num;
                        
                        $PriceRanges = PriceRange::where('estatus',1)->get();
                        $amount = (int)$collection->total_sales_price;

                        $Company = Company::where('id',1)->first();
                        $company_per = $Company->company_percentage;

                        $company_per = 0;
                        foreach($PriceRanges as $PriceRange){
                            if($PriceRange->start_price <=  $amount && $PriceRange->end_price >=  $amount){
                                $company_per = $PriceRange->percentage;
                                $type = $PriceRange->type;
                            }
                        }
                        if($company_per > 0){
                            if($type == 1){
                                $company_per_amt = ((int)$collection->total_sales_price * $company_per)/100;
                            }else{
                                $company_per_amt = (int)$collection->total_sales_price + $company_per;
                            }
                        }else{
                            $company_per_amt = 0;
                        }

                        $sale_amt = round((int)$collection->total_sales_price + $company_per_amt);

                        if($collection->meas_length != "" && $collection->meas_width != "" && $collection->meas_depth != ""){     
                            $DiamondMeasurement = $collection->meas_length.' * '.$collection->meas_width.' * '.$collection->meas_depth; 
                        }else{
                            $DiamondMeasurement = "-";    
                        }

                        $percentage = rand(10, 30);
                        $percentage_amount = ($sale_amt * $percentage)/100;
                        $real_amt = round($percentage_amount + $sale_amt);

                        if($collection->short_title == "" || $collection->short_title == null || $collection->short_title == "N/A"){
                            $short_title = $collection->shape . " " . $collection->size . "ct " .$collection->color. " " .$collection->clarity; 
                        }else{
                            $short_title = $collection->short_title;
                        }

                        if($collection->long_title == "" || $collection->long_title == null || $collection->long_title == "N/A"){
                            $long_title =  $collection->shape . " " . $collection->size . "ct " .$collection->color. " " .$collection->clarity; 
                        }else{
                            $long_title = $collection->long_title;
                        }
                        
                        $Diamond = Diamond::where('diamond_id',$collection->id)->first();
                        if($Diamond){
                        
                            $Diamond->Amt = $collection->total_sales_price;      
                            $Diamond->Sale_Amt = $sale_amt;      
                            $Diamond->real_Amt = $real_amt;
                                    $Diamond->short_title = $short_title;      
                                    $Diamond->long_title = $long_title;  
                                    $Diamond->slug = $this->createSlug($short_title,$Diamond->id);      
                            $Diamond->amt_discount = $percentage;       
                            $Diamond->shape = strtoupper($collection->shape); 
                            $Diamond->Measurement = $DiamondMeasurement; 
                                    $Diamond->StockStatus = $collection->available;
                                    $Diamond->save();    
                        }else{ 
                            $data = ([
                                'Company_id' => 1,  
                                'Stone_No' => $Stone_No,
                                'diamond_id' => $collection->id,
                                'short_title' => $short_title,
                                'long_title' => $long_title,
                                'slug' => $this->createSlug($short_title),
                                'vendor_id' => $collection->vendor_id,
                                'StockStatus' => $collection->available,
                                'Weight' => $collection->size,
                                'Lab_Report_No' => $collection->lab_sequence_no,
                                'Location' => $collection->city.','.$collection->state.','.$collection->country,
                                'Amt' => $collection->total_sales_price,
                                'Sale_Amt' => $sale_amt,
                                'real_Amt' => $real_amt,
                                'amt_discount' => $percentage,
                                'shape' => strtoupper($collection->shape),
                                'Color' => $collection->color,
                                'Measurement' =>  $DiamondMeasurement,
                                'meas_length' => ($collection->meas_length)?$collection->meas_length:0,
                                'meas_width' => ($collection->meas_width)?$collection->meas_width:0,
                                'meas_depth' => ($collection->meas_depth)?$collection->meas_depth:0,
                                'Certificate_url' => $collection->cert_url,
                                'Video_url' => $collection->video_url,
                                'Stone_Img_url' => isset($collection->image_url)?$collection->image_url:"",
                                'Rate' => $collection->price_per_carat,
                                'Lab' => $collection->lab,
                                'FancyColorIntens' => $collection->fancy_color_intensity,
                                'FancyColorOvertone' => $collection->fancy_color_overtone,
                                'FancyColor' => $collection->fancy_color_dominant_color,
                                'Symm' =>  $collection->symmetry,
                                'Polish' => $collection->polish,
                                'Clarity' => $collection->clarity,
                                'Cut' => $collection->cut,
                                'Total_Depth_Per' => $collection->depth_percent,
                                'Table_Diameter_Per' => $collection->table_percent,
                                'GirdleThin_ID' => $collection->girdle_min,
                                'GirdleThick_ID' => $collection->girdle_max,
                                'FlrColor' => $collection->fluor_color,
                                'FlrIntens' => $collection->fluor_intensity,
                                'CrownHeight' => $collection->crown_height,
                                'CrownAngle' => $collection->crown_angle,
                                'PavillionHeight' => $collection->pavilion_depth,
                                'PavillionAngle' => $collection->pavilion_angle,
                                'Eyeclean' => $collection->eye_clean,
                                'Discount' => $collection->discount_percent,
                                'Girdle_Per' => $collection->girdle_percent,
                                
                                
                                // 'Milkey' => $collection->milky,
                                
                                'Culet_Size_ID' => $collection->culet_size,
                                'Ratio' => $collection->meas_ratio,
                                'growth_type' => $collection->growth_type,
                                // 'Culet_Condition_ID' => $collection->culet_condition,
                                'created_at' => new \DateTime(null, new \DateTimeZone('Asia/Kolkata')),
                                
                                
                                
                                // 'Laser_Inscription' => $collection->inscription,
                                // 'Stone_Comment' => $collection->cert_comment,
                                // 'KeyToSymbols' => $keytosymbols,
                                // 'Black_Inclusion' => $collection->black_inclusion,
                                // 'Open_Inclusion' => $collection->open_inclusion,
                                
                            ]);
                            Diamond::insert($data);

                            
                        } 
                        
                        $Vendor = Vendor::where('vendor_id',$collection->vendor_id)->first();
                        if($Vendor == ""){
                            $vendordata = ([
                                'vendor_id' => $collection->vendor_id,
                                'vendor_phone' => $collection->vendor_phone,
                                'vendor_mobile_phone' => $collection->vendor_mobile_phone,
                                'vendor_email' => $collection->vendor_email,
                                'contact_person' => $collection->contact_person,
                                'vendor_street_address' => $collection->vendor_street_address,
                                'vendor_city' => $collection->vendor_city,
                                'vendor_state' => $collection->vendor_state,
                                'vendor_country' => $collection->vendor_country,
                                'vendor_zip_code' => $collection->vendor_zip_code,
                                'vendor_iphone' => $collection->vendor_iphone  
                        ]);
                        Vendor::insert($vendordata);
                        }else{
                            if(!in_array($collection->vendor_id,$vender_array)){
                                    Vendor::where('vendor_id',$collection->vendor_id)
                                        ->update([
                                            'vendor_phone' => $collection->vendor_phone,
                                            'vendor_mobile_phone' => $collection->vendor_mobile_phone,
                                            'vendor_email' => $collection->vendor_email,
                                            'contact_person' => $collection->contact_person,
                                            'vendor_street_address' => $collection->vendor_street_address,
                                            'vendor_city' => $collection->vendor_city,
                                            'vendor_state' => $collection->vendor_state,
                                            'vendor_country' => $collection->vendor_country,
                                            'vendor_zip_code' => $collection->vendor_zip_code,
                                            'vendor_iphone' => $collection->vendor_iphone 
                                        ]);
                                    
                                    array_push($vender_array,$collection->vendor_id);
                                        
                            }     
                        }
                    }  
                } 
            }    
        } 

        if(isset($total_diamond) && $total_diamond > 0){
           $totalpage = (int) floor(($total_diamond / 100));
           for ($x = 2; $x <= $totalpage + 1; $x++) {
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://apiservices.vdbapp.com/v2/diamonds?type=lab_grown_diamond&page_size=100&with_images=true&shapes%5B%5D=Briolette&shapes%5B%5D=Eurocut&shapes%5B%5D=Flanders&shapes%5B%5D=Half%20Moon&shapes%5B%5D=Kite&shapes%5B%5D=Old%20Miner&shapes%5B%5D=Bullet&shapes%5B%5D=Hexagonal&shapes%5B%5D=Lozenge&shapes%5B%5D=Tapered%20Bullet&shapes%5B%5D=Octagonal&shapes%5B%5D=Triangle&shapes%5B%5D=Rose%20Cut&shapes%5B%5D=Ideal%20Oval&shapes%5B%5D=Ideal%20Square&shapes%5B%5D=Square%20Emerald&shapes%5B%5D=Sig81&shapes%5B%5D=Cushion%20Modified%20Brilliant&shapes%5B%5D=Ideal%20Cushion&shapes%5B%5D=Pentagonal&shapes%5B%5D=Star&shapes%5B%5D=Trapezoid&shapes%5B%5D=Trilliant&shapes%5B%5D=Baguette&shapes%5B%5D=Shield&shapes%5B%5D=Tapered%20Baguette&shapes%5B%5D=Ideal%20Heart&shapes%5B%5D=Other&page_number='.$x,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Token token=M2wIRs87_aJJT2vlZjTviGG4m-v7jVvdfuCUHqGdu6k, api_key=_vYN1uFpastNYP2bmCsjtfA'
                ),
                ));
        
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                if ($err) {
                   return "cURL Error #:" . $err;
                } else {
                    $diamonds = json_decode($response);
                    if(isset($diamonds->response->body->diamonds)){ 
                        $total_diamond = $diamonds->response->body->total_diamonds_found;
                        foreach($diamonds->response->body->diamonds as $collection)
                        {
                            //dd($collection);
                            if((int)$collection->total_sales_price > 0 && $collection->total_sales_price != ""){
                                $Stone_No = $collection->stock_num;
                                
                                $PriceRanges = PriceRange::where('estatus',1)->get();
                                $amount = (int)$collection->total_sales_price;
        
                                $Company = Company::where('id',1)->first();
                                $company_per = $Company->company_percentage;
        
                                $company_per = 0;
                                foreach($PriceRanges as $PriceRange){
                                    if($PriceRange->start_price <=  $amount && $PriceRange->end_price >=  $amount){
                                        $company_per = $PriceRange->percentage;
                                        $type = $PriceRange->type;
                                    }
                                }
                                if($company_per > 0){
                                    if($type == 1){
                                        $company_per_amt = ((int)$collection->total_sales_price * $company_per)/100;
                                    }else{
                                        $company_per_amt = (int)$collection->total_sales_price + $company_per;
                                    }
                                }else{
                                    $company_per_amt = 0;
                                }
        
                                $sale_amt = round((int)$collection->total_sales_price + $company_per_amt);
        
                                if($collection->meas_length != "" && $collection->meas_width != "" && $collection->meas_depth != ""){     
                                    $DiamondMeasurement = $collection->meas_length.' * '.$collection->meas_width.' * '.$collection->meas_depth; 
                                }else{
                                    $DiamondMeasurement = "-";    
                                }

                                $percentage = rand(10, 30);
                                $percentage_amount = ($sale_amt * $percentage)/100;
                                $real_amt = round($percentage_amount + $sale_amt);

                        if($collection->short_title == "" || $collection->short_title == null || $collection->short_title == "N/A"){
                            $short_title = $collection->shape . " " . $collection->size . "ct " .$collection->color. " " .$collection->clarity; 
                        }else{
                            $short_title = $collection->short_title;
                        }

                        if($collection->long_title == "" || $collection->long_title == null || $collection->long_title == "N/A"){
                            $long_title =  $collection->shape . " " . $collection->size . "ct " .$collection->color. " " .$collection->clarity; 
                        }else{
                            $long_title = $collection->long_title;
                        }
                                
                                $Diamond = Diamond::where('diamond_id',$collection->id)->first();
                                if($Diamond){
                                
                                    $Diamond->Amt = $collection->total_sales_price;      
                                    $Diamond->Sale_Amt = $sale_amt;      
                                    $Diamond->real_Amt = $real_amt;
                                    $Diamond->short_title = $short_title;      
                                    $Diamond->long_title = $long_title;  
                                    $Diamond->slug = $this->createSlug($short_title,$Diamond->id);      
                                    $Diamond->amt_discount = $percentage;       
                                    $Diamond->shape = strtoupper($collection->shape); 
                                    $Diamond->Measurement = $DiamondMeasurement; 
                                    $Diamond->StockStatus = $collection->available;
                                    $Diamond->save();    
                                }else{ 
                                    $data = ([
                                        'Company_id' => 1,  
                                        'Stone_No' => $Stone_No,
                                        'diamond_id' => $collection->id,
                                        'short_title' => $short_title,
                                        'long_title' => $long_title,
                                        'slug' => $this->createSlug($short_title),
                                        'vendor_id' => $collection->vendor_id,
                                        'StockStatus' => $collection->available,
                                        'Weight' => $collection->size,
                                        'Lab_Report_No' => $collection->lab_sequence_no,
                                        'Location' => $collection->city.','.$collection->state.','.$collection->country,
                                        'Amt' => $collection->total_sales_price,
                                        'Sale_Amt' => $sale_amt,
                                        'real_Amt' => $real_amt,
                                        'amt_discount' => $percentage,
                                        'shape' => strtoupper($collection->shape),
                                        'Color' => $collection->color,
                                        'Measurement' =>  $DiamondMeasurement,
                                        'meas_length' => ($collection->meas_length)?$collection->meas_length:0,
                                        'meas_width' => ($collection->meas_width)?$collection->meas_width:0,
                                        'meas_depth' => ($collection->meas_depth)?$collection->meas_depth:0,
                                        'Certificate_url' => $collection->cert_url,
                                        'Video_url' => $collection->video_url,
                                        'Stone_Img_url' => isset($collection->image_url)?$collection->image_url:"",
                                        'Rate' => $collection->price_per_carat,
                                        'Lab' => $collection->lab,
                                        'FancyColorIntens' => $collection->fancy_color_intensity,
                                        'FancyColorOvertone' => $collection->fancy_color_overtone,
                                        'FancyColor' => $collection->fancy_color_dominant_color,
                                        'Symm' =>  $collection->symmetry,
                                        'Polish' => $collection->polish,
                                        'Clarity' => $collection->clarity,
                                        'Cut' => $collection->cut,
                                        'Total_Depth_Per' => $collection->depth_percent,
                                        'Table_Diameter_Per' => $collection->table_percent,
                                        'GirdleThin_ID' => $collection->girdle_min,
                                        'GirdleThick_ID' => $collection->girdle_max,
                                        'FlrColor' => $collection->fluor_color,
                                        'FlrIntens' => $collection->fluor_intensity,
                                        'CrownHeight' => $collection->crown_height,
                                        'CrownAngle' => $collection->crown_angle,
                                        'PavillionHeight' => $collection->pavilion_depth,
                                        'PavillionAngle' => $collection->pavilion_angle,
                                        'Eyeclean' => $collection->eye_clean,
                                        'Discount' => $collection->discount_percent,
                                        'Girdle_Per' => $collection->girdle_percent,
                                        
                                        
                                        // 'Milkey' => $collection->milky,
                                        
                                        'Culet_Size_ID' => $collection->culet_size,
                                        'Ratio' => $collection->meas_ratio,
                                        'growth_type' => $collection->growth_type,
                                        // 'Culet_Condition_ID' => $collection->culet_condition,
                                        'created_at' => new \DateTime(null, new \DateTimeZone('Asia/Kolkata')),
                                        
                                        
                                        
                                        // 'Laser_Inscription' => $collection->inscription,
                                        // 'Stone_Comment' => $collection->cert_comment,
                                        // 'KeyToSymbols' => $keytosymbols,
                                        // 'Black_Inclusion' => $collection->black_inclusion,
                                        // 'Open_Inclusion' => $collection->open_inclusion,
                                        
                                    ]);
                                    Diamond::insert($data);
           
                                } 
                                
                            }  
                        } 
                    }    
                }
           }
        }

        $action = "add";
        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function addDiamond(Request $request){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://paldiam.diamx.net/api/ClientStockSearch?UserID=gemone.diamonds@gmail.com&Password=gemverDiamond@2022',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array('Content-Length: 0'),
        ));
    
        $response = curl_exec($curl);
    
        curl_close($curl);
        $dimonds =  json_decode($response,true);
        //dd($dimonds->StoneList);
        //par = $dimonds->StoneList;

        if($dimonds['ApiStatus'] == 'Success'){
           foreach($dimonds['StoneList'] as $par){
             
               $PriceRanges = PriceRange::where('estatus',1)->get();
               $amount = $par['Amt'];
               // dd($amount);

              // $Company = Company::where('id',1)->first();
               //$company_per = $Company->company_percentage;
               $company_per = 0;
               foreach($PriceRanges as $PriceRange){
                    if($PriceRange->start_price <=  $amount && $PriceRange->end_price >=  $amount){
                        $company_per = $PriceRange->percentage;
                        $type = $PriceRange->type;
                    }
               }
               if($company_per > 0){
                    if($type == 1){
                        $company_per_amt = ($par['Amt'] * $company_per)/100;
                    }else{
                        $company_per_amt = $par['Amt'] + $company_per;
                    }
               }else{
                    $company_per_amt = 0;
               }
               //dd($company_per_amt);
               $sale_amt =$par['Amt'] + $company_per_amt;
               $par['Sale_Amt'] = round($sale_amt);
               $par['Company_id'] = 1;
               $par['Shape'] = strtolower(ltrim($par['Shape'],' '));
               $par['Polish'] = ltrim($par['Polish'],' ');
               $par['Symm'] = ltrim($par['Symm'],' ');

               $Diamond = Diamond::where('Stone_No',$par['Stone_No'])->first();
               if($Diamond){
                  Diamond::where('Stone_No', $par['Stone_No'])
                           ->update([
                                'Live_Rap_Rate' => $par['Live_Rap_Rate'],
                                'Discount' => $par['Discount'],
                                'Rate' => $par['Rate'],
                                'Amt' => round($par['Amt']),
                                'Sale_Amt' => round($par['Sale_Amt'])
                            ]);
               }else{
                  Diamond::create($par);
               }
           }
           return response()->json(array('success'=>true,'status_code' => 1, 'message' => 'Add Data Diamond'));
        }else{
            return response()->json(array('success'=>false,'status_code' => 0, 'message' => 'Api Now Working'));  
        } 
    } 

    public function changediamondstatus($id){
        $diamond = Diamond::find($id);
        if ($diamond->estatus==1){
            $diamond->estatus = 2;
            $diamond->save();
            return response()->json(['status' => '200','action' =>'deactive']);
        }
        if ($diamond->estatus==2){
            $diamond->estatus = 1;
            $diamond->save();
            return response()->json(['status' => '200','action' =>'active']);
        }
    }

    public function createSlug($title, $id = 0)
    {
        $slug = str_slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }
    
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Diamond::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }

    
}
