<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Diamond;
use App\Models\ProjectPage;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Imports\ImportDiamond;
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


                    $page_id = ProjectPage::where('route_url','admin.diamonds.list')->pluck('id')->first();
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
               $Company = Company::where('id',1)->first();
               $company_per = $Company->company_percentage;
               $company_per_amt = ($par['Amt'] * $company_per)/100;
               $sale_amt =$par['Amt'] + $company_per_amt;
               $par['Sale_Amt'] = $sale_amt;
               $par['Company_id'] = 1;
               $par['Shape'] = ltrim($par['Shape'],' ');

               $Diamond = Diamond::where('Stone_No',$par['Stone_No'])->first();
               if($Diamond){
                  Diamond::where('Stone_No', $par['Stone_No'])
                           ->update([
                                'Live_Rap_Rate' => $par['Live_Rap_Rate'],
                                'Discount' => $par['Discount'],
                                'Rate' => $par['Rate'],
                                'Amt' => $par['Amt'],
                                'Sale_Amt' => $par['Sale_Amt']
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

    
}
