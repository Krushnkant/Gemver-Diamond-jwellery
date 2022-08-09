<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Opinion;
use App\Models\Settings;
use App\Models\product;
use App\Models\ProjectPage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers;

class OpinionController extends Controller
{
    public function index()
    {
        $action = "list";
        return view('admin.opinion.list',compact('action'));
    }

    public function allopinionslist(Request $request){
        if ($request->ajax()) {

            $columns = array(
                0 =>'id',
                1 =>'product_info',
                2=> 'customer_info',
                3=> 'message',
                4=> 'created_at',
                5=> 'action',
            );

            $totalData = Opinion::count();
            if (isset($estatus)){
                $totalData = Opinion::where('estatus',$estatus)->count();
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
                
                $Opinions = Opinion::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir);

                if (isset($estatus)){
                    $Opinions = $Opinions->where('estatus',$estatus);
                }
                $Opinions = $Opinions->get();
            }
            else {
                $search = $request->input('search.value');
                $Opinions =  Opinion::where(function($query) use($search){
                    $query->where('id','LIKE',"%{$search}%")
                          ->orWhere('name', 'LIKE',"%{$search}%")
                          ->orWhere('message', 'LIKE',"%{$search}%");
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                if (isset($estatus)){
                    $Opinions = $Opinions->where('estatus',$estatus)->where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                              ->orWhere('name', 'LIKE',"%{$search}%")
                              ->orWhere('message', 'LIKE',"%{$search}%");
                        })
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
                }

                $totalFiltered = Opinion::where(function($query) use($search){
                    $query->where('id','LIKE',"%{$search}%")
                         ->orWhere('name', 'LIKE',"%{$search}%")
                         ->orWhere('message', 'LIKE',"%{$search}%");
                    })->count();
                if (isset($estatus)){
                    $totalFiltered = $totalFiltered->where('estatus',$estatus)->where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                             ->orWhere('name', 'LIKE',"%{$search}%")
                             ->orWhere('message', 'LIKE',"%{$search}%");
                        })->count();
                }
               
            }
            $data = array();

            if(!empty($Opinions))
            {
                foreach ($Opinions as $opinion)
                {
                    $page_id = ProjectPage::where('route_url','admin.users.list')->pluck('id')->first();
                   
                    $customer_info = '';
                    if (isset($opinion->name)){
                        $customer_info .= '<span><i class="fa fa-user" aria-hidden="true"></i> ' .$opinion->name .'</span>';
                    }
                    if (isset($opinion->email)){
                        $customer_info .= '<span><i class="fa fa-envelope" aria-hidden="true"></i> ' .$opinion->email .'</span>';
                    }
                    if (isset($opinion->mobile_no)){
                        $customer_info .= '<span><i class="fa fa-phone" aria-hidden="true"></i> ' .$opinion->mobile_no .'</span>';
                    }    
                    
                    $product = Product::where('id',$opinion->product_id)->first();
                    if($product){
                        $product_info = '<span>'.$product->product_title.'</span>';
                    }else{
                        $product_info = '-';
                    }
                   
                    $message = '';
                    if (isset($opinion->message)){
                        $message .= '<span> ' .$opinion->message .'</span>';
                    }

                    $action='';
                    $action .= '<a href="mailto:'.$opinion->email.'" data-email="" class="btn btn-info text-white btn-sm" target="_blank" ><i class="fa fa-envelope" aria-hidden="true"></i></a>';
                    
                    $newDate = date("d-m-Y", strtotime($opinion->created_at));
                    $nestedData['customer_info'] = $customer_info;
                    $nestedData['product_info'] = $product_info;
                    $nestedData['message'] = $message;
                    $nestedData['created_at'] = $newDate;
                    $nestedData['action'] = $action;
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

    public function save(Request $request){
        $setting = Settings::first();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }else{
            $data = $request->all();
            $opinion = Opinion::Create($data);
        
            if($opinion != null){
                //dd($inquiry);
               // echo $inquiry->SKU.'demo'; die;
                // if($inquiry->SKU != ''){
                //     $product = ProductVariant::with('product')->where('SKU', 'like', '%' . $inquiry->SKU)->first();
                //     if($product){
                //     $product_info = '<span>'.$product->product->product_title.'</span><span> SKU: '.$product->SKU.'</span>';
                //     $Productvariantvariants = ProductVariantVariant::leftJoin('attributes', function($join) {
                //         $join->on('product_variant_variants.attribute_id', '=', 'attributes.id');
                //       })->leftJoin('attribute_terms', function($join) {
                //         $join->on('product_variant_variants.attribute_term_id', '=', 'attribute_terms.id');
                //       })->where('product_variant_id',$product->id)->select('attributes.attribute_name','attribute_terms.attrterm_name')->get();
                       
                //     foreach($Productvariantvariants as $Productvariantvariant){
                //         $product_info .= '<span>'.$Productvariantvariant->attribute_name.' : '.$Productvariantvariant->attrterm_name.'</span>';
                //     }
                //     }else{
                //         $product_info = '-';
                //     }
                //     }else{
                //         $product_info = '-';
                //     }

                //     if($inquiry->stone_no == "" && $inquiry->SKU == ""){
                //         $product_info = 'bulk order inquiry'; 
                //     }

                
                // $data1 = [
                //     'product_info' => $product_info,
                // ];

               // dd($data1);
                
                $data2 = [
                    'message1' => 'Thank You For Product Opinion'
                ]; 
                $templateName = 'email.mailDatainquiry';
                //$mail_sending = Helpers::MailSending($templateName, $data2, $opinion->email, 'Inquiry');
                //$mail_sending1 = Helpers::MailSending($templateName, $data1, $setting->send_email, $inquiry->subject);
                return response()->json(['status' => '200']); 
            }
        }
    }
}
