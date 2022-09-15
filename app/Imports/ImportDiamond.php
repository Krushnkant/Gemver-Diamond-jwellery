<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\Diamond;
use App\Models\Company;
use App\Models\PriceRange;
//use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportDiamond implements WithHeadingRow,ToCollection
{
    /**
    * @param array $collection
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $collections)
    {
        foreach($collections as $collection)
        {
           // dd($collection['key_to_symbols']);
            if($collection['availability'] == 'G' ||  $collection['availability'] == 'YES'){
                $availability = 'AVAILABLE';
            }else{
                $availability = 'NOTAVAILABLE';
            }

            if(isset($collection['discounts'])){
                $discount = $collection['discounts'];
            }else{
                $discount = $collection['discount'];
            }

            if(isset($collection['key_to_symbols'])){
                $keytosymbols = $collection['key_to_symbols'];
            }elseif(isset($collection['keytosymbols'])){
                $keytosymbols = $collection['keytosymbols'];
            }else{
                $keytosymbols = "";
            }

            if(isset($collection['cert_file'])){
                $certfile = $collection['cert_file'];
            }elseif(isset($collection['cert_file'])){
                $certfile = $collection['certfile'];
            }else{
                $certfile = "";
            }
            
            if(isset($collection['stock'])){
                $Stone_No = $collection['stock'];
            }else{
                $Stone_No = $collection['stock_id'];
            }
            
            
            

            $PriceRanges = PriceRange::where('estatus',1)->get();
            $amount = (int)$collection['final_price'];

            //$Company = Company::where('id',2)->first();
           // $company_per = $Company->company_percentage;

            $company_per = 0;
            foreach($PriceRanges as $PriceRange){
                 if($PriceRange->start_price <=  $amount && $PriceRange->end_price >=  $amount){
                     $company_per = $PriceRange->percentage;
                     $type = $PriceRange->type;
                 }
            }
            if($company_per > 0){
                if($type == 1){
                    $company_per_amt = ((int)$collection['final_price'] * $company_per)/100;
                }else{
                    $company_per_amt = (int)$collection['final_price'] + $company_per;
                }
            }else{
                 $company_per_amt = 0;
            }

            $sale_amt = round((int)$collection['final_price'] + $company_per_amt);
            
            $Diamond = Diamond::where('Stone_No',$Stone_No)->first();
            if($Diamond){
                 Diamond::where('Stone_No', $Stone_No)
                        ->update([
                            'Amt' => $collection['final_price'],
                            'Sale_Amt' => $sale_amt,
                        ]);
            }else{ 
                   $data = ([
                    'Company_id' => 2,  
                    'Stone_No' => $Stone_No,
                    'StockStatus' => $availability,
                    'Shape' => ltrim(strtolower($collection['shape']),' '),
                    'Weight' => $collection['weight'],
                    'Color' => $collection['color'],
                    'Clarity' => $collection['clarity'],
                    'Cut' => $collection['cut'],
                    'Polish' => ltrim($collection['polish'],' '),
                    'Symm' => ltrim($collection['symmetry'],' '),
                    'FlrIntens' => $collection['fluorescence_intensity'],
                    'FlrColor' => $collection['fluorescence_color'],
                    'Measurement' => $collection['measurements'],
                    'Shade' => $collection['shade'],
                    'Milkey' => $collection['milky'],
                    'Eyeclean' => $collection['eye_clean'],
                    'Lab' => $collection['lab'],
                    'Lab_Report_No' => $collection['report'],
                    'Location' => $collection['location'],
                    'Discount' => $discount,
                    'Rate' => $collection['price_per_carat'],
                    'Amt' => $collection['final_price'],
                    'Sale_Amt' => $sale_amt,
                    'Total_Depth_Per' => $collection['depth'],
                    'Table_Diameter_Per' => $collection['table'],
                    'GirdleThin_ID' => $collection['girdle_thin'],
                    'GirdleThick_ID' => $collection['girdle_thick'],
                    'Girdle_Per' => $collection['girdle'],
                    'Culet_Size_ID' => $collection['culet_size'],
                    'Culet_Condition_ID' => $collection['culet_condition'],
                    'CrownHeight' => $collection['crown_height'],
                    'CrownAngle' => $collection['crown_angle'],
                    'PavillionHeight' => $collection['pavilion_depth'],
                    'PavillionAngle' => $collection['pavilion_angle'],
                    'Laser_Inscription' => $collection['inscription'],
                    'Stone_Comment' => $collection['cert_comment'],
                    'KeyToSymbols' => $keytosymbols,
                    'Black_Inclusion' => $collection['black_inclusion'],
                    'Open_Inclusion' => $collection['open_inclusion'],
                    'FancyColor' => $collection['fancy_color'],
                    'FancyColorIntens' => $collection['fancy_color_intensity'],
                    'FancyColorOvertone' => $collection['fancy_color_overtone'],
                    'Certificate_url' => $certfile,
                    'Video_url' => $collection['diamond_video'],
                    'Stone_Img_url' => $collection['diamond_image'],
                    
                ]);
                Diamond::insert($data);
          }  
        }    
    }
}
