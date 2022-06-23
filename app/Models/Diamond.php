<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diamond extends Model
{
    use HasFactory;

    protected $table = 'diamonds';

    protected $fillable = [
        'Company_id',
        'Stone_No',
        'StockStatus',
        'Shape',
        'Weight',
        'Color',
        'Clarity',
        'Cut',
        'Polish',
        'Symm',
        'FlrIntens',
        'FlrColor',
        'FancyColor',
        'FancyColorIntens',
        'FancyColorOvertone',
        'Lab',
        'Lab_Report_No',
        'Lab_Report_Comment',
        'Laser_Inscription',
        'Location',
        'Live_Rap_Rate',
        'Discount',
        'Amt',
        'Sale_Amt',
        'Measurement',
        'Total_Depth_Per',
        'Table_Diameter_Per',
        'GirdleThin_ID',
        'GirdleThick_ID',
        'Girdle_Per',
        'Culet_Size_ID',
        'Culet_Condition_ID',
        'CrownAngle',
        'CrownHeight',
        'PavillionAngle',
        'PavillionHeight',
        'KeyToSymbols',
        'Shade',
        'StarLength',
        'LowerHalve',
        'Table_Inclusion',
        'Black_Inclusion',
        'Side_Inclusion',
        'Open_Inclusion',
        'Center_Inclusion',
        'Feather_Inclusion',
        'HnA_ID',
        'Ratio',
        'Luster_ID',
        'BIS',
        'BIC',
        'WIS',
        'WIC',
        'Source',
        'Eyeclean',
        'Milkey',
        'Tinge',
        'Certificate_url',
        'Stone_Img_url',
        'Video_url',
        'Stone_Comment',
        'Comment',
        'CompanyComment',
    ];
}
