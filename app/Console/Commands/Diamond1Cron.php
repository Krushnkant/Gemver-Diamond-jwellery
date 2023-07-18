<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PriceRange;
use App\Models\Company;
use App\Models\Diamond;
use App\Models\Vendor;

class Diamond1Cron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'diamond1:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Diamond Asscher Emerald Oval';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
       
        //\Log::info("Diamond Asscher Emerald Oval Uploaded!");
        $oldids = Diamond::whereIn('Shape',['Asscher','Emerald','Oval'])->get()->pluck('diamond_id')->toarray();
        $PriceRanges = PriceRange::where('estatus',1)->get();
        $Company = Company::where('id',1)->first();
        $company_per = $Company->company_percentage;

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
                $per_page = count($diamonds->response->body->diamonds);
                $total_diamond = $diamonds->response->body->total_diamonds_found;
                foreach($diamonds->response->body->diamonds as $collection)
                {
                    unset($oldids[array_search($collection->id, $oldids)]);
                    //dd($collection);
                    if((int)$collection->total_sales_price > 0 && $collection->total_sales_price != ""){
                        $Stone_No = $collection->stock_num;
                        $amount = (int)$collection->total_sales_price;

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
                        
                        $Diamond = Diamond::select('Amt','Sale_Amt','real_Amt','amt_discount','StockStatus')->where('diamond_id',$collection->id)->first();
                        if($Diamond){
                            if($Diamond->Sale_Amt != $sale_amt){
                                $Diamond->Amt = $collection->total_sales_price;      
                                $Diamond->Sale_Amt = $sale_amt;      
                                $Diamond->real_Amt = $real_amt; 
                                //$Diamond->slug = $this->createSlug($short_title,$Diamond->id);      
                                $Diamond->amt_discount = $percentage;
                                $Diamond->StockStatus = $collection->available;
                                $Diamond->save();
                            }    
                        }else{ 
                            $data = ([
                                'Company_id' => 1,  
                                'Stone_No' => $Stone_No,
                                'diamond_id' => $collection->id,
                                'short_title' => 'Lab Grown Diamond '.$short_title,
                                'long_title' => 'Lab Grown Diamond '.$long_title,
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
                                'Culet_Size_ID' => $collection->culet_size,
                                'Ratio' => $collection->meas_ratio,
                                'growth_type' => $collection->growth_type,
                                'created_at' => new \DateTime(null, new \DateTimeZone('Asia/Kolkata')),
                                
                            ]);
                            Diamond::insert($data);

                            
                        } 
                        
                    }  
                } 
            }    
        } 

        if(isset($total_diamond) && $total_diamond > 0){
           $totalpage = (int) floor(($total_diamond / $per_page));
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
                            unset($oldids[array_search($collection->id, $oldids)]);
                            //dd($collection);
                            if((int)$collection->total_sales_price > 0 && $collection->total_sales_price != ""){
                                $Stone_No = $collection->stock_num;
                                
                                $amount = (int)$collection->total_sales_price;
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
                                
                                $Diamond = Diamond::select('Amt','Sale_Amt','real_Amt','amt_discount','StockStatus')->where('diamond_id',$collection->id)->first();
                                if($Diamond){
                                    if($Diamond->Sale_Amt != $sale_amt){
                                        $Diamond->Amt = $collection->total_sales_price;      
                                        $Diamond->Sale_Amt = $sale_amt;      
                                        $Diamond->real_Amt = $real_amt; 
                                        //$Diamond->slug = $this->createSlug($short_title,$Diamond->id);      
                                        $Diamond->amt_discount = $percentage;
                                        $Diamond->StockStatus = $collection->available;
                                        $Diamond->save();
                                    }    
                                }else{ 
                                    $data = ([
                                        'Company_id' => 1,  
                                        'Stone_No' => $Stone_No,
                                        'diamond_id' => $collection->id,
                                        'short_title' => 'Lab Grown Diamond '.$short_title,
                                        'long_title' => 'Lab Grown Diamond '.$long_title,
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
                                        'Culet_Size_ID' => $collection->culet_size,
                                        'Ratio' => $collection->meas_ratio,
                                        'growth_type' => $collection->growth_type,
                                        'created_at' => new \DateTime(null, new \DateTimeZone('Asia/Kolkata')),
                                        
                                    ]);
                                    Diamond::insert($data);
        
                                    
                                } 
                                
                               
                            }  
                        } 

                        
                    }    
                }
           }
        }

        // foreach($oldids as $oldid){
        //     // $deletediamond = Diamond::where('diamond_id',$oldid);
        //     // $deletediamond->StockStatus = 0;
        //     // $deletediamond->save();
        //     Diamond::where('diamond_id', $oldid)
        //     ->update([
        //         'StockStatus' => '0'
        //         ]);
        // }

       // Diamond::whereIn('diamond_id',$oldids)->where('StockStatus','<>',0)->update(['StockStatus' => '0']);
        Diamond::whereIn('diamond_id',$oldids)->delete();
       
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
