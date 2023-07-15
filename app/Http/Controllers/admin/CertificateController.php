<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\RequestCertificate;
use App\Models\Settings;
use App\Models\Product;
use App\Models\Diamond;
use App\Models\ProductVariantVariant;
use App\Models\ProjectPage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers;

class CertificateController extends Controller
{
    public function index()
    {
        $action = "list";
        return view('admin.certificate.list',compact('action'));
    }

    public function allcertificateslist(Request $request){
        if ($request->ajax()) {

            $columns = array(
                0 =>'id',
                1 =>'product_info',
                2=> 'customer_info',
                3=> 'message',
                4=> 'created_at',
                5=> 'action',
            );

            $totalData = RequestCertificate::count();
            if (isset($estatus)){
                $totalData = RequestCertificate::where('estatus',$estatus)->count();
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
                
                $certificates = RequestCertificate::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir);

                if (isset($estatus)){
                    $certificates = $certificates->where('estatus',$estatus);
                }
                $certificates = $certificates->get();
            }
            else {
                $search = $request->input('search.value');
                $certificates =  RequestCertificate::where(function($query) use($search){
                    $query->where('id','LIKE',"%{$search}%")
                          ->orWhere('name', 'LIKE',"%{$search}%")
                          ->orWhere('message', 'LIKE',"%{$search}%");
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                if (isset($estatus)){
                    $certificates = $certificates->where('estatus',$estatus)->where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                              ->orWhere('name', 'LIKE',"%{$search}%")
                              ->orWhere('message', 'LIKE',"%{$search}%");
                        })
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
                }

                $totalFiltered = RequestCertificate::where(function($query) use($search){
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

            if(!empty($certificates))
            {
                foreach ($certificates as $certificate)
                {
                    $product_info = '';
                    $page_id = ProjectPage::where('route_url','admin.users.list')->pluck('id')->first();
                   
                    $customer_info = '';
                    if (isset($certificate->name)){
                        $customer_info .= '<span><i class="fa fa-user" aria-hidden="true"></i> ' .$certificate->name .'</span>';
                    }
                    if (isset($certificate->email)){
                        $customer_info .= '<span><i class="fa fa-envelope" aria-hidden="true"></i> ' .$certificate->email .'</span>';
                    }
                    if (isset($certificate->phone_number)){
                        $customer_info .= '<span><i class="fa fa-phone" aria-hidden="true"></i> ' .$certificate->phone_number .'</span>';
                    }    
                    
                    if($certificate->type == 1){
                        $product = Product::where('id',$certificate->item_id)->first();
                        if($product){
                            $product_info = '<span>'.$product->product_title.'</span>';
                        }else{
                            $product_info = '-';
                        }
                    }else{
                      

                        $item_details = json_decode($certificate->item_details,true);
                        if(isset($item_details['diamondId'])){
                        $product_info = '<span>'.$item_details['DiamondTitle'].'</span>';
                       
                        }else{
                            $product_info.= "-";
                        }

                    }
                   
                    $message = '';
                    if (isset($certificate->message)){
                        $message .= '<span> ' .$certificate->message .'</span>';
                    }

                    $action='';
                    $action .= '<a href="mailto:'.$certificate->email.'" data-email="" class="btn btn-info text-white btn-sm" target="_blank" ><i class="fa fa-envelope" aria-hidden="true"></i></a>';
                    
                    $newDate = date("d-m-Y", strtotime($certificate->created_at));
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
            'email' => 'required|email',
            'phone_number' => 'required',
            'message' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }else{
            $data = $request->all();
            $certificate = RequestCertificate::Create($data);
        
            if($certificate != null){

                $order_item = array();
                if($certificate->type == 1){
                $product = Product::with('product_variant')->where('id',$certificate->item_id)->first();
                if($product){
                $product_info = '<span>'.$product->product_title.'</span><br>';
                $Productvariantvariants = ProductVariantVariant::leftJoin('attributes', function($join) {
                    $join->on('product_variant_variants.attribute_id', '=', 'attributes.id');
                  })->leftJoin('attribute_terms', function($join) {
                    $join->on('product_variant_variants.attribute_term_id', '=', 'attribute_terms.id');
                  })->where('product_variant_id',$product->product_variant[0]->id)->select('attributes.attribute_name','attribute_terms.attrterm_name')->get();
                   
                foreach($Productvariantvariants as $Productvariantvariant){
                    $spe[] = array(
                        'term' => $Productvariantvariant->attribute_name,
                        'term_name' => $Productvariantvariant->attrterm_name
                    );    
                }

                $sale_price = $product->product_variant[0]->sale_price;
                $item_image = explode(',',$product->product_variant[0]->images);  
                $item_name = $product->product_title;

                $order_item['variantId'] = $product->id;
                $order_item['orderItemPrice'] = $sale_price;
                $order_item['ProductTitle'] = $item_name;
                $order_item['ProductImage'] = $item_image[0];
                $order_item['spe'] = $spe;
            }
            }else{

                $diamond = Diamond::where('id',$certificate->item_id)->first();
                    if($diamond){
                      
                                        $item_name = $diamond->Shape.' '. round($diamond->Weight,2) .' ct ';
                                    
                                        $sale_price = $diamond->Sale_Amt;
                                        $item_image = explode(',',$diamond->Stone_Img_url);
                                        
                                        $spe[] = array(
                                            'term_name' => $diamond->Clarity,
                                            'term' => 'Clarity'
                                        );

                                        $spe[] = array(
                                            'term_name' => $diamond->Color,
                                            'term' => 'Color'
                                        );

                                        $spe[] = array(
                                            'term_name' => $diamond->Lab,
                                            'term' => 'certified'
                                        );

                                
                                        $order_item['diamondId'] = (isset($diamond->id))?$diamond->id:0;
                                        $order_item['orderItemPrice'] = $sale_price;
                                        $order_item['DiamondTitle'] = $item_name;
                                        $order_item['DiamondImage'] = (isset($item_image[0]))?$item_image[0]:"";
                                        $order_item['spe'] = $spe;

                                    }
            }

            $item_details = json_encode($order_item);
            RequestCertificate::where('id', $certificate->id)
                    ->update([
                        'item_details' => $item_details
                        ]);

               
                $data2 = [
                    'message1' => 'Thank You For Certificate Request'
                ]; 
                $templateName = 'email.mailDatainquiry';
                //$mail_sending = Helpers::MailSending($templateName, $data2, $certificate->email, 'Inquiry');
                //$mail_sending1 = Helpers::MailSending($templateName, $data1, $setting->send_email, $inquiry->subject);
                return response()->json(['status' => '200']); 
            }
        }
    }
}
