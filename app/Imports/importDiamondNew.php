<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\Diamond;
use App\Models\Company;
use App\Models\Vendor;
use App\Models\PriceRange;
//use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportDiamondNew implements WithHeadingRow,ToCollection
{
    /**
    * @param array $collection
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $collections)
    {
        $vender_array = array(); 
        foreach($collections as $collection)
        {
        
            $Stone_No = $collection['stock_num'];
            
            $PriceRanges = PriceRange::where('estatus',1)->get();
            $amount = (int)$collection['total_sales_price'];

            $Company = Company::where('id',2)->first();
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
                    $company_per_amt = ((int)$collection['total_sales_price'] * $company_per)/100;
                }else{
                    $company_per_amt = (int)$collection['total_sales_price'] + $company_per;
                }
            }else{
                 $company_per_amt = 0;
            }

            $sale_amt = round((int)$collection['total_sales_price'] + $company_per_amt);
            
            $Diamond = Diamond::where('Stone_No',$Stone_No)->first();
            if($Diamond){
                 Diamond::where('Stone_No', $Stone_No)
                        ->update([
                            'Amt' => $collection['total_sales_price'],
                            'Sale_Amt' => $sale_amt,
                            'shape' => strtoupper($collection['shape']),
                        ]);
            }else{ 
                   $data = ([
                    'Company_id' => 2,  
                    'Stone_No' => $Stone_No,
                    'diamond_id' => $collection['id'],
                    'short_title' => $collection['short_title'],
                    'long_title' => $collection['long_title'],
                    'vendor_id' => $collection['vendor_id'],
                    'StockStatus' => $collection['available'],
                    'Weight' => $collection['size'],
                    'Lab_Report_No' => $collection['cert_num'],
                    'Location' => $collection['city'].','.$collection['state'].','.$collection['country'],
                    'Amt' => $collection['total_sales_price'],
                    'Sale_Amt' => $sale_amt,
                    'shape' => strtoupper($collection['shape']),
                    'Color' => $collection['color'],
                    'Measurement' => $collection['meas_ratio'],
                    'Certificate_url' => $collection['cert_url'],
                    'Video_url' => $collection['video_url'],
                    'Stone_Img_url' => $collection['image_url'],
                    'Rate' => $collection['price_per_carat'],
                    'Lab' => $collection['lab'],
                    'FancyColorIntens' => $collection['fancy_color_intensity'],
                    'FancyColorOvertone' => $collection['fancy_color_overtone'],
                    'FancyColor' => $collection['fancy_color_dominant_color'],
                    'Symm' =>  $collection['symmetry'],
                    'Polish' => $collection['polish'],
                    'Clarity' => $collection['clarity'],
                    'Cut' => $collection['cut'],
                    'Total_Depth_Per' => $collection['depth_percent'],
                    'Table_Diameter_Per' => $collection['table_percent'],
                    'GirdleThin_ID' => $collection['girdle_min'],
                    'GirdleThick_ID' => $collection['girdle_max'],
                    'FlrColor' => $collection['fluor_color'],
                    'FlrIntens' => $collection['fluor_intensity'],
                    'CrownHeight' => $collection['crown_height'],
                    'CrownAngle' => $collection['crown_angle'],
                    'PavillionHeight' => $collection['pavilion_depth'],
                    'PavillionAngle' => $collection['pavilion_angle'],
                    'Eyeclean' => $collection['eye_clean'],
                    'Discount' => $collection['discount_percent'],
                    'Girdle_Per' => $collection['girdle_percent'],
                    
                    
                    // 'Milkey' => $collection['milky'],
                    
                    // 'Culet_Size_ID' => $collection['culet_size'],
                    // 'Culet_Condition_ID' => $collection['culet_condition'],
                    
                    
                    
                    
                    // 'Laser_Inscription' => $collection['inscription'],
                    // 'Stone_Comment' => $collection['cert_comment'],
                    // 'KeyToSymbols' => $keytosymbols,
                    // 'Black_Inclusion' => $collection['black_inclusion'],
                    // 'Open_Inclusion' => $collection['open_inclusion'],
                      
                ]);
                Diamond::insert($data);

                
          }  

          $Vendor = Vendor::where('vendor_id',$collection['vendor_id'])->first();
                if($Vendor == ""){
                    $vendordata = ([
                        'vendor_id' => $collection['vendor_id'],
                        'vendor_phone' => $collection['vendor_phone'],
                        'vendor_mobile_phone' => $collection['vendor_mobile_phone'],
                        'vendor_email' => $collection['vendor_email'],
                        'contact_person' => $collection['contact_person'],
                        'vendor_street_address' => $collection['vendor_street_address'],
                        'vendor_city' => $collection['vendor_city'],
                        'vendor_state' => $collection['vendor_state'],
                        'vendor_country' => $collection['vendor_country'],
                        'vendor_zip_code' => $collection['vendor_zip_code'],
                        'vendor_iphone' => $collection['vendor_iphone']  
                ]);
                Vendor::insert($vendordata);
               }else{
                    if(!in_array($collection['vendor_id'],$vender_array)){
                            Vendor::where('vendor_id',$collection['vendor_id'])
                                ->update([
                                    'vendor_phone' => $collection['vendor_phone'],
                                    'vendor_mobile_phone' => $collection['vendor_mobile_phone'],
                                    'vendor_email' => $collection['vendor_email'],
                                    'contact_person' => $collection['contact_person'],
                                    'vendor_street_address' => $collection['vendor_street_address'],
                                    'vendor_city' => $collection['vendor_city'],
                                    'vendor_state' => $collection['vendor_state'],
                                    'vendor_country' => $collection['vendor_country'],
                                    'vendor_zip_code' => $collection['vendor_zip_code'],
                                    'vendor_iphone' => $collection['vendor_iphone'] 
                                ]);
                           
                            array_push($vender_array,$collection['vendor_id']);
                               
                    }     
               }
        }    
    }
}
