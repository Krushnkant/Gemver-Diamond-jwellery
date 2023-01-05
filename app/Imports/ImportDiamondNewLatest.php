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

class ImportDiamondNewLatest implements WithHeadingRow,ToCollection
{
    /**
    * @param array $collection
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $collections)
    {
              set_time_limit(0);
        $vender_array = array(); 
        foreach($collections as $collection)
        {
            
            if((int)$collection['total_price'] > 0 && $collection['total_price'] != ""){
                $Stone_No = $collection['stock'];
                
                $PriceRanges = PriceRange::where('estatus',1)->get();
                $amount = (int)$collection['total_price'];

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
                        $company_per_amt = ((int)$collection['total_price'] * $company_per)/100;
                    }else{
                        $company_per_amt = (int)$collection['total_price'] + $company_per;
                    }
                }else{
                    $company_per_amt = 0;
                }

                $sale_amt = round((int)$collection['total_price'] + $company_per_amt);

                if($collection['measurement_length'] != "" && $collection['measurement_width'] != "" && $collection['measurement_height'] != ""){     
                    $DiamondMeasurement = $collection['measurement_length'].' * '.$collection['measurement_width'].' * '.$collection['measurement_height']; 
                }else{
                    $DiamondMeasurement = "-";    
                }
                
                $Diamond = Diamond::where('Stone_No',$Stone_No)->first();
                if($Diamond){
                  //  Diamond::where('Stone_No', $Stone_No)
                          //  ->update([
                              //  'Amt' => $collection['total_price'],
                              //  'Sale_Amt' => $sale_amt,
                               // 'shape' => strtoupper($collection['shape']),
                                //'Measurement' => $collection['measurement_length'].' * '.$collection['measurement_width'].' * '.$collection['measurement_height'],
                                //'Culet_Size_ID' => $collection['culet'],
                                //'Ratio' => $collection['ratio'],
                                //'growth_type' => $collection['growth_type'],
                           // ]);
                   // $idiamond = Diamond::where('Stone_No', $Stone_No)->first();  
                    $Diamond->Amt = $collection['total_price'];      
                    $Diamond->Sale_Amt = $sale_amt;      
                    $Diamond->shape = strtoupper($collection['shape']); 
                    $Diamond->Measurement = $DiamondMeasurement; 
                    $Diamond->save();    
                }else{ 
                    $data = ([
                        'Company_id' => 1,  
                        'Stone_No' => $Stone_No,
                        'diamond_id' => $collection['unique_id_of_diamond'],
                        'short_title' => $collection['shape'] .' '.  $collection['carat'] .' ct',
                        'long_title' => $collection['carat'] .' Carat ' .$collection['shape'] . ' Lab Grown Diamond',
                        'vendor_id' => 0,
                        'StockStatus' => $collection['available'],
                        'Weight' => $collection['carat'],
                        'Lab_Report_No' => $collection['report'],
                        'Location' => $collection['city'].','.$collection['state'].','.$collection['country'],
                        'Amt' => $collection['total_price'],
                        'Sale_Amt' => $sale_amt,
                        'shape' => strtoupper($collection['shape']),
                        'Color' => $collection['color'],
                        'Measurement' =>  $DiamondMeasurement,
                        'meas_length' => ($collection['measurement_length'])?$collection['measurement_length']:0,
                        'meas_width' => ($collection['measurement_width'])?$collection['measurement_width']:0,
                        'meas_depth' => ($collection['measurement_height'])?$collection['measurement_height']:0,
                        'Certificate_url' => $collection['certificate_url'],
                        'Video_url' => $collection['video_url'],
                        'Stone_Img_url' => $collection['image_url'],
                        'Rate' => $collection['pricect'],
                        'Lab' => $collection['lab'],
                        'FancyColorIntens' => $collection['fancy_intensity'],
                        'FancyColorOvertone' => $collection['fancy_overtone'],
                        'FancyColor' => $collection['fancy_color'],
                        'Symm' =>  $collection['symmetry'],
                        'Polish' => $collection['polish'],
                        'Clarity' => $collection['clarity'],
                        'Cut' => $collection['cut'],
                        'Total_Depth_Per' => $collection['depth'],
                        'Table_Diameter_Per' => $collection['table'],
                        'GirdleThin_ID' => $collection['girdle'],
                        'GirdleThick_ID' => $collection['girdle'],
                        'FlrColor' => $collection['fluor'],
                        'FlrIntens' => $collection['fluor'],
                        'CrownHeight' => $collection['crown'],
                        'CrownAngle' => $collection['crown_angle'],
                        'PavillionHeight' => $collection['pavillion'],
                        'PavillionAngle' => $collection['pavillion_angle'],
                        'Eyeclean' => 0,
                        'Discount' => $collection['discount'],
                        'Girdle_Per' => $collection['girdle'],
                        
                        
                        // 'Milkey' => $collection['milky'],
                        
                         'Culet_Size_ID' => $collection['culet'],
                         'Ratio' => $collection['ratio'],
                         'growth_type' => $collection['growth_type'],
                        // 'Culet_Condition_ID' => $collection['culet_condition'],
                        
                        
                        
                        
                        // 'Laser_Inscription' => $collection['inscription'],
                        // 'Stone_Comment' => $collection['cert_comment'],
                        // 'KeyToSymbols' => $keytosymbols,
                        // 'Black_Inclusion' => $collection['black_inclusion'],
                        // 'Open_Inclusion' => $collection['open_inclusion'],
                        
                    ]);
                    Diamond::insert($data);

                    
                }  

                // $Vendor = Vendor::where('vendor_id',$collection['vendor_id'])->first();
                // if($Vendor == ""){
                //     $vendordata = ([
                //         'vendor_id' => $collection['vendor_id'],
                //         'vendor_phone' => $collection['vendor_phone'],
                //         'vendor_mobile_phone' => $collection['vendor_mobile_phone'],
                //         'vendor_email' => $collection['vendor_email'],
                //         'contact_person' => $collection['contact_person'],
                //         'vendor_street_address' => $collection['vendor_street_address'],
                //         'vendor_city' => $collection['vendor_city'],
                //         'vendor_state' => $collection['vendor_state'],
                //         'vendor_country' => $collection['vendor_country'],
                //         'vendor_zip_code' => $collection['vendor_zip_code'],
                //         'vendor_iphone' => $collection['vendor_iphone']  
                // ]);
                // Vendor::insert($vendordata);
                // }else{
                //     if(!in_array($collection['vendor_id'],$vender_array)){
                //             Vendor::where('vendor_id',$collection['vendor_id'])
                //                 ->update([
                //                     'vendor_phone' => $collection['vendor_phone'],
                //                     'vendor_mobile_phone' => $collection['vendor_mobile_phone'],
                //                     'vendor_email' => $collection['vendor_email'],
                //                     'contact_person' => $collection['contact_person'],
                //                     'vendor_street_address' => $collection['vendor_street_address'],
                //                     'vendor_city' => $collection['vendor_city'],
                //                     'vendor_state' => $collection['vendor_state'],
                //                     'vendor_country' => $collection['vendor_country'],
                //                     'vendor_zip_code' => $collection['vendor_zip_code'],
                //                     'vendor_iphone' => $collection['vendor_iphone'] 
                //                 ]);
                            
                //             array_push($vender_array,$collection['vendor_id']);
                                
                //     }     
                // }
            }   
        }    
    }
}
