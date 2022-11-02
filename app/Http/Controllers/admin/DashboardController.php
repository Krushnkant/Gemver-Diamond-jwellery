<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Opinion;
use App\Models\Inquiry;
use App\Models\ProjectPage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index(){
        $yesterday_date = date('Y-m-d',strtotime("-1 days"));
      
        $today_order =  Order::whereNotIn('order_status', [7,8])->whereDate('created_at', '=', date('Y-m-d'))->get();
        $today_order_amount = $today_order->count();
        $today_order_sum = $today_order->sum('total_ordercost');
      
        $yesterday_order =  Order::whereNotIn('order_status', [7,8])->whereDate('created_at', '=',$yesterday_date)->get();
        $yesterday_order_amount = $yesterday_order->count();
        $yesterday_order_sum = $yesterday_order->sum('total_ordercost');

        $today_user =  User::where('role',3)->whereDate('created_at', '=', date('Y-m-d'))->get();
        $today_user_count = $today_user->count();
        
        $yesterday_user =  User::where('role',3)->whereDate('created_at', '=', $yesterday_date)->get();
        $yesterday_user_count = $yesterday_user->count();

        $today_inquiry =  Inquiry::whereDate('created_at', '=', date('Y-m-d'))->get();
        $today_inquiry_count = $today_inquiry->count();
        $today_opinion =  Opinion::whereDate('created_at', '=', date('Y-m-d'))->get();
        $today_opinion_count = $today_opinion->count();

        $now = Carbon::now();
        $month = $now->month;
        $years = $now->year;
        $level_1_month_commisionn_current = [];
        $chatorders = Order::select("*")->whereNotIn('order_status', [7,8])->whereMonth('created_at', '=', $month)
                                                ->whereYear('created_at', '=', $years)
                                                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))
                                                ->selectRaw('count(id) as amount')
                                                ->get();

        if($chatorders != null){
            foreach($chatorders as $com){
                $ddd = date('d', strtotime($com->created_at));
                $level_1_month_commisionn_current[(int)$ddd] =  $com->amount;
               // array_push($level_1_month_commisionn_current, $sss);
            }
        }                                        
        //dd($level_1_month_commisionn_current);
        
        $number = cal_days_in_month(CAL_GREGORIAN, $month, $years);
        $order_current_string = [];
        for($i = 1; $i <= $number; $i++){
            
            if($chatorders != null){
                //dump($i);
               // dump($level_1_month_commisionn_current);
                if(array_key_exists($i,$level_1_month_commisionn_current)){
                   // dd($level_1_month_commisionn_current[$i]);
                //foreach($chatorders as $aa){
                   // $ddd = date('d', strtotime($aa->created_at));
                    //if($ddd == $i){
                        $amount = $level_1_month_commisionn_current[$i];
                        array_push($order_current_string, $amount);
                    //}
                }else{
                    array_push($order_current_string, 0);
                }

            }else{
                array_push($order_current_string, 0);
            }
           
        }
        $string_version_1 = implode(',', $order_current_string);


        $level_2_month_commisionn_current = [];
        $chatsalesorders = Order::select("*")->whereNotIn('order_status', [7,8])->whereMonth('created_at', '=', $month)
                                                ->whereYear('created_at', '=', $years)
                                                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))
                                                ->selectRaw('sum(total_ordercost) as amount')
                                                ->get();

        if($chatsalesorders != null){
            foreach($chatsalesorders as $com){
                $ddd = date('d', strtotime($com->created_at));
                $level_2_month_commisionn_current[(int)$ddd] =  $com->amount;
               // array_push($level_1_month_commisionn_current, $sss);
            }
        }                                        
        //dd($level_1_month_commisionn_current);
        
        $number = cal_days_in_month(CAL_GREGORIAN, $month, $years);
        $order_sales_current_string = [];
        for($i = 1; $i <= $number; $i++){
            
            if($chatsalesorders != null){
                //dump($i);
               // dump($level_1_month_commisionn_current);
                if(array_key_exists($i,$level_2_month_commisionn_current)){
                   // dd($level_1_month_commisionn_current[$i]);
                //foreach($chatorders as $aa){
                   // $ddd = date('d', strtotime($aa->created_at));
                    //if($ddd == $i){
                        $amount = $level_2_month_commisionn_current[$i];
                        array_push($order_sales_current_string, $amount);
                    //}
                }else{
                    array_push($order_sales_current_string, 0);
                }

            }else{
                array_push($order_sales_current_string, 0);
            }
           
        }
        $string_version_2 = implode(',', $order_sales_current_string);

        $chattotalorders = Order::whereNotIn('order_status', [7,8])->whereMonth('created_at', '=', $month)
                                                ->whereYear('created_at', '=', $years)
                                                ->selectRaw('count(id) as charttotalorder')
                                                ->first();

        $chattotalsalesorders = Order::whereNotIn('order_status', [7,8])->whereMonth('created_at', '=', $month)
        ->whereYear('created_at', '=', $years)
        ->selectRaw('sum(total_ordercost) as charttotalamount')
        ->first();                                        
        
        return view('admin.dashboard',compact('today_order_amount','yesterday_order_amount','today_user_count','yesterday_user_count','today_order_sum','yesterday_order_sum','today_inquiry_count','today_opinion_count','string_version_1','string_version_2','chattotalorders','chattotalsalesorders'));
    }

    public function TodayallOrderlist(Request $request){
  
        if ($request->ajax()) {
            $columns = array(
                0 =>'id',
                1 =>'order_info',
                2=> 'customer_info',
                3=> 'note',
                4=> 'payment_status',
                5=> 'order_status',
                6=> 'created_at',
                7=> 'action',
            );

            $tab_type = $request->tab_type;
            if ($tab_type == "NewOrder_orders_tab"){
                $order_status = [1];
            }
            elseif ($tab_type == "OutforDelivery_orders_tab"){
                $order_status = [2];
            }
            elseif ($tab_type == "Delivered_orders_tab"){
                $order_status = [3];
            }
            elseif ($tab_type == "ReturnRequest_orders_tab"){
                $order_status = [4,5];
            }
            elseif ($tab_type == "Returned_orders_tab"){
                $order_status = [6];
            }
            elseif ($tab_type == "Cancelled_orders_tab"){
                $order_status = [7,8];
            }

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if($order == "id"){
                $order = "created_at";
                $dir = 'desc';
            }

            $totalData = Order::whereDate('created_at', '=', date('Y-m-d'))->count();
            if (isset($order_status)){
                $totalData = Order::whereDate('created_at', '=', date('Y-m-d'))->whereIn('order_status',$order_status)->count();
            }
            $totalFiltered = $totalData;

            if(empty($request->input('search.value')))
            {
                $Orders = Order::with('order_item')->whereDate('created_at', '=', date('Y-m-d'));
                if (isset($order_status)){
                    $Orders = $Orders->whereIn('order_status',$order_status);
                }
                $Orders = $Orders->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
            }
            else {
                $search = $request->input('search.value');
                $Orders = Order::with('order_item')->whereDate('created_at', '=', date('Y-m-d'));
                if (isset($order_status)){
                    $Orders = $Orders->whereIn('order_status',$order_status);
                }
                $Orders = $Orders->where(function($query) use($search){
                    $query->where('custom_orderid','LIKE',"%{$search}%")
                        ->orWhere('payment_type', 'LIKE',"%{$search}%");
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

                $totalFiltered = count($Orders->toArray());
            }

            $data = array();
            if(!empty($Orders))
            {
                foreach ($Orders as $Order)
                {
                    $user_info = User::find($Order->user_id);
                    // dump($user_info);
                    $page_id = ProjectPage::where('route_url','admin.orders.list')->pluck('id')->first();
                   
                    $action = '';
                   // $action .= '<button id="invoiceBtn" class="btn btn-gray text-blue btn-sm" onclick="getInvoiceData(\''.$Order->id.'\')"><i class="fa fa-print" aria-hidden="true"></i></button>';
                    if($Order->tracking_url != ""){
                        $action .= '<a href="'.$Order->tracking_url.'" id="" class="btn btn-gray text-dark btn-sm" ><i class="fa fa-truck" aria-hidden="true"></i></a>';
                    }else{
                        $action .= '<button id="editTrackingBtn" class="btn btn-gray text-dark btn-sm" data-toggle="modal" data-target="#TrackingModal" onclick="" data-id="' .$Order->id. '" ><i class="fa fa-truck" aria-hidden="true"></i></button>';
                    }

                    if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ) {
                        $action .= '<button id="ViewOrderBtn" target="blank" class="btn gradient-9 btn-sm" onclick="editOrder(' . $Order->id . ')"><i class="fa fa-eye" aria-hidden="true"></i></button>';
                    }
                    
                    if ( isset($Order->order_status) && $Order->order_status == 4 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $action .= '<button type="button" class="btn mb-1 btn-success btn-xs" data-id="'.$Order->id.'" id="ApproveReturnRequestBtn">Approve</button>';
                        $action .= '<button type="button" class="btn mb-1 btn-danger btn-xs" data-id="'.$Order->id.'" id="RejectReturnRequestBtn">Reject</button>';
                    }

                    $order_info = '<span>Order ID: '.$Order->custom_orderid.'</span>';
                    $order_info .= '<span>Total Order Cost: $ '.$Order->total_ordercost.'</span>';
                    $order_info .= '<span>Total Items: '.count($Order->order_item).'</span>';

                    $delivery_address = json_decode($Order->delivery_address,true);
                    $customer_info = $delivery_address['CustomerName'];
                    // dump($customer_info);
                    if($delivery_address['CustomerMobile'] != ""){
                        $customer_info .= '<span><i class="fa fa-phone" aria-hidden="true"></i> '.$delivery_address['CustomerMobile'].'</span>';
                    }else{
                        $customer_info .= '<span><i class="fa fa-phone" aria-hidden="true"></i> '.$user_info->full_name.'</span>';
                    }

                    if($delivery_address['DelAddress1'] != ""){
                        $customer_info .= '<span><i class="fa fa-map-marker" aria-hidden="true"></i> '.$delivery_address['DelAddress1'].'</span>';
                    }else{
                        $customer_info .= '<span><i class="fa fa-map-marker" aria-hidden="true"></i> '.$user_info->mobile_no.'</span>';
                    }

                    $NoteBoxDisplay = $Order->order_note;
                    if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ) {
                        $NoteBoxDisplay = '<textarea class="custom-textareaBox orderNoteBox" id="orderNoteBox' . $Order->id . '" rows="4" data-id="' . $Order->id . '">' . $Order->order_note . '</textarea>';
                    }

                    if(isset($Order->payment_status)) {
                        $payment_status = getPaymentStatus($Order->payment_status);
                        $payment_type = getPaymentType($Order->payment_type);
                        $payment_status = '<span class="'.$payment_status['class'].'">'.$payment_status['payment_status'].'</span><span>'.$payment_type.'</span>';
                    }

                    if(isset($Order->order_status)) {
                        $order_status = getOrderStatus($Order->order_status);
                        $order_status = '<span class="'.$order_status['class'].'">'.$order_status['order_status'].'</span>';
                    }

                    if ($Order->order_status == 4 || $Order->order_status == 6){
                        $returnreq_images = explode(",",$Order->order_return_imgs);
                        $returnreq_images_paths = array_map(function ($val){
                            return url($val);
                        }, $returnreq_images);
                        $returnreq_images_paths = "['".implode("','",$returnreq_images_paths)."']";
                        $order_status .= '<span class="returnReqImgs" id="returnReqImgs_'.$Order->id.'">
                                <a href="javascript:void(0)" class="btn btn-dark btn-sm"><i class="fa fa-image"></i></a>
                                <script type="text/javascript">
                                    $("#returnReqImgs_'.$Order->id.'").slickLightbox({images: '.$returnreq_images_paths.'});
                                </script>
                                </span>';
                        $order_status .= '<button id="VideoBtn" class="btn btn-sm text-blue" data-id="'.$Order->id.'" data-toggle="modal" data-target="#ReturnReqVideoModal"><i class="fa fa-video-camera" aria-hidden="true"></i></button>';
                    }

                    $date = '<span><b>Order Date:</b></span><span>'.date('d-m-Y h:i A', strtotime($Order->created_at)).'</span>';
                    if(isset($Order->delivery_date)){
                        $date .= '<span><b>Delivery Date:</b></span><span>'.$Order->delivery_date.'</span>';
                    }

                    $table = '<table class="subclass text-center" cellpadding="6" cellspacing="0" border="0" style="padding-left:50px; width: 50%">';
                    $item = 1;
                    foreach ($Order->order_item as $order_item){
                        $item_details = json_decode($order_item->item_details,true);

                        // if($item_details['ItemType'] == 2){
                        //     $ProductVariant = ProductVariant::where('id',$item_details['variantId'])->first();
                        //     $Diamond = Diamond::where('id',$item_details['diamondId'])->first(); 
                        // }else if($item_details['ItemType'] == 1){
                        //     $ProductVariant = Diamond::where('id',$item_details['variantId'])->first(); 
                        // }else{
                        //     $ProductVariant = ProductVariant::where('id',$item_details['variantId'])->first();
                        // }
                        
                        $table .='<tr>';
                        if(isset($item_details['ItemType']) && $item_details['ItemType'] == 0){
                            if(isset($item_details['ProductImage'])){
                                $table .='<td>'.$item.'</td><td class="multirow"><img src="'.url($item_details['ProductImage']).'" width="50px" height="50px"></td>';
                            }
                        }else if(isset($item_details['ItemType']) &&  $item_details['ItemType'] == 1){
                            $table .='<td>'.$item.'</td><td class="multirow"><img src="'.url($item_details['ProductImage']).'" width="50px" height="50px"></td>';
                        }else{
                            $table .='<td>'.$item.'</td><td class="multirow"><img src="'.$item_details['DiamondImage'].'" width="50px" height="50px"><img src="'.url($item_details['ProductImage']).'" width="50px" height="50px"></td>';
                        }
                        $table .='<td class="multirow text-left">
                                    <b>'.$item_details['ProductTitle'].'</b>';
                        //$table .='<span>'.$item_details['attribute'].': '.$item_details['attributeTerm'].'</span>';
                        $orderItemPrice = '';
                        if (isset($item_details['itemQuantity'])){
                            $orderItemPrice = ' &times; '.$item_details['itemQuantity'].' Qty';
                        }
                        if (isset($item_details['orderItemPrice'])){
                            // $table .= '<td>Price: $ '.$item_details['orderItemPrice'].'</td>';
                            $table .= '<td class="multirow text-right">Item Price: $ '.$item_details['orderItemPrice'].$orderItemPrice;
                        }
                        if (isset($item_details['SubDiscount'])){
                            $table .= '<span>Sub Discount: $ '.$item_details['SubDiscount'].'</span>';
                        }
                        if (isset($item_details['totalItemAmount'])){
                            $table .= '<span>total Amount: $ '.$item_details['totalItemAmount'].'</span>';
                        }
                        if (isset($item_details['itemPayableAmt'])){
                            $table .= '<span>Payable Amount: $ '.$item_details['itemPayableAmt'].'</span></td>';
                        }
                        $table .= '</tr>';
                        $item++;
                    }
                    $table .='</table>';

                    $nestedData['order_info'] = $order_info;
                    $nestedData['customer_info'] = $customer_info;
                    $nestedData['note'] = $NoteBoxDisplay;
                    $nestedData['payment_status'] = $payment_status;
                    $nestedData['order_status'] = $order_status;
                    $nestedData['created_at'] = $date;
                    $nestedData['action'] = $action;
                    $nestedData['table1'] = $table;
                    $data[] = $nestedData;
                }
                // dd();
            }

            $json_data = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data,
            );

//            return json_encode($json_data);
            echo json_encode($json_data);
        }
    }

    
}
