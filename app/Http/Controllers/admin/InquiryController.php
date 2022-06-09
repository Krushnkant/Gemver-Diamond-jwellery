<?php

namespace App\Http\Controllers\admin;
use App\Models\Inquiry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectPage;
use App\Models\ProductVariant;
use App\Models\ProductVariantVariant;
use App\Models\AttributeTerm;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers;

class InquiryController extends Controller
{
    public function index()
    {
        $action = "list";
        return view('admin.inquiries.list',compact('action'));
    }

    public function allinquirieslist(Request $request){
     
        if ($request->ajax()) {
            $tab_type = $request->tab_type;
            if ($tab_type == "active_inquiry_tab"){
                $estatus = 1;
            }
            elseif ($tab_type == "deactive_inquiry_tab"){
                $estatus = 2;
            }
             
            $columns = array(
                0 =>'id',
                1 =>'product_info',
                2=> 'spe_info',
                3=> 'customer_info',
                4=> 'message',
                5=> 'created_at',
               
            );

            $totalData = Inquiry::count();
            if (isset($estatus)){
                $totalData = Inquiry::where('estatus',$estatus)->count();
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
                
                $Inquiries = Inquiry::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir);

                if (isset($estatus)){
                    $Inquiries = $Inquiries->where('estatus',$estatus);
                }
                $Inquiries = $Inquiries->get();
            }
            else {
                $search = $request->input('search.value');
                $Inquiries =  Inquiry::where(function($query) use($search){
                    $query->where('id','LIKE',"%{$search}%")
                          ->orWhere('name', 'LIKE',"%{$search}%")
                          ->orWhere('inquiry', 'LIKE',"%{$search}%");
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                if (isset($estatus)){
                    $Inquiries = $Inquiries->where('estatus',$estatus)->where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                              ->orWhere('name', 'LIKE',"%{$search}%")
                              ->orWhere('inquiry', 'LIKE',"%{$search}%");
                        })
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
                }

                $totalFiltered = Inquiry::where(function($query) use($search){
                    $query->where('id','LIKE',"%{$search}%")
                         ->orWhere('name', 'LIKE',"%{$search}%")
                         ->orWhere('inquiry', 'LIKE',"%{$search}%");
                    })->count();
                if (isset($estatus)){
                    $totalFiltered = $totalFiltered->where('estatus',$estatus)->where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                             ->orWhere('name', 'LIKE',"%{$search}%")
                             ->orWhere('inquiry', 'LIKE',"%{$search}%");
                        })->count();
                }
               
            }
            $data = array();

            if(!empty($Inquiries))
            {
                foreach ($Inquiries as $inquiry)
                {
                    $page_id = ProjectPage::where('route_url','admin.users.list')->pluck('id')->first();
                   

                    $customer_info = '';
                    if (isset($inquiry->email)){
                        $customer_info .= '<span><i class="fa fa-user" aria-hidden="true"></i> ' .$inquiry->name .'</span>';
                    }
                    if (isset($inquiry->email)){
                        $customer_info .= '<span><i class="fa fa-envelope" aria-hidden="true"></i> ' .$inquiry->email .'</span>';
                    }
                    if (isset($inquiry->mobile_no)){
                        $customer_info .= '<span><i class="fa fa-phone" aria-hidden="true"></i> ' .$inquiry->mobile_no .'</span>';
                        
                    }
                    
                    $product = ProductVariant::with('product')->where('SKU',$inquiry->sku)->first();
                    
                    if($product){

                    $product_info = '<span>'.$product->product->product_title.'</span><span> SKU: '.$product->SKU.'</span>';

                    $Productvariantvariants = ProductVariantVariant::leftJoin('attributes', function($join) {
                        $join->on('product_variant_variants.attribute_id', '=', 'attributes.id');
                      })->leftJoin('attribute_terms', function($join) {
                        $join->on('product_variant_variants.attribute_term_id', '=', 'attribute_terms.id');
                      })->where('product_variant_id',$product->id)->select('attributes.attribute_name','attribute_terms.attrterm_name')->get();
                       
                    foreach($Productvariantvariants as $Productvariantvariant){
                        $product_info .= '<span>'.$Productvariantvariant->attribute_name.' : '.$Productvariantvariant->attrterm_name.'</span>';
                    }
                    }else{
                        $product_info = '-';
                    }
                    $message = '';
                    if (isset($inquiry->inquiry)){
                        $message .= '<span> ' .$inquiry->inquiry .'</span>';
                    }

                    $spe_info ='';

                    if($inquiry->specification_term_id != ""){
                        $term_ids = explode(',', $inquiry->specification_term_id);
                        foreach($term_ids as $term_id){
                            $Productterms = AttributeTerm::leftJoin('attributes', function($join) {
                                $join->on('attributes.id', '=', 'attribute_terms.attribute_id');
                            })->where('attribute_terms.id',$term_id)->select('attributes.attribute_name','attribute_terms.attrterm_name')->get();
                            if($Productterms){
                            foreach($Productterms as $Productterm){
                                $spe_info .= '<span>'.$Productterm->attribute_name.' : '.$Productterm->attrterm_name.'</span>';
                            }
                            }else{
                                $spe_info .= '-';
                            }
                        }
                    }else{
                       $spe_info ='-';   
                    }
                    
                    
                   
                    $newDate = date("d-m-Y", strtotime($inquiry->created_at));
                    $nestedData['customer_info'] = $customer_info;
                    $nestedData['spe_info'] = $spe_info;
                    $nestedData['product_info'] = $product_info;
                    $nestedData['message'] = $message;
                    $nestedData['created_at'] = $newDate;
                   // $nestedData['action'] = $action;
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

  

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'country' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()){

            return $this->sendError($validator->errors(), "Validation Errors", []);
        }else{
            $data = $request->all();
            $contact = Inquiry::Create($data);
            if($contact != null){
                $data1 = [
                    'description' => $contact->description
                ];     
                $username = $contact->first_name." ".$contact->last_name;
                $templateName = 'email.mailData';
                $mail_sending = Helpers::MailSending($templateName, $data1, $contact->email, "Contact Us mail sending");
                return $this->sendResponseWithData($contact, "Send contact message succesfully");  
            }
        }

    }

  

    public function deletecontact($id){
        $Faqform = Inquiry::where('id',$id)->first();
        if ($Faqform){
            $Faqform->save();
            $Faqform->delete();
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }
}
