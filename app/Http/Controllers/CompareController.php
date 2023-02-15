<?php

namespace App\Http\Controllers;
use App\Models\Compare;
use Illuminate\Http\Request;

class CompareController extends Controller
{

    public function index(Request $request,$catid)
    {

        $data = $request->all();
        $ip_address = \Request::ip();
        $results = Compare::with('product')->where('ip_address',$ip_address)->orderBy('id','DESC')->get();
        
        $artilces = '';
        if ($request->ajax()) {
            foreach ($results as $Diamond) {
                $url =  URL('/diamond-details/'.$catid.'/'.$Diamond->product->id);
                if($Diamond->product->Stone_Img_url != ""){
                    $Diamond_image = $Diamond->product->Stone_Img_url;
                }else{
                    if($Diamond->product->Shape == strtoupper('round')){
                        $Diamond_image = url('frontend/image/1.png');    
                    }elseif($Diamond->product->Shape == strtoupper('oval')){
                        $Diamond_image = url('frontend/image/2.png');
                    }elseif($Diamond->product->Shape == strtoupper('emerald')){
                        $Diamond_image = url('frontend/image/3.png');
                    }elseif($Diamond->product->Shape == strtoupper('princess')){
                        $Diamond_image = url('frontend/image/6.png');
                    }elseif($Diamond->product->Shape == strtoupper('cushion')){
                        $Diamond_image = url('frontend/image/7.png');
                    }elseif($Diamond->product->Shape == strtoupper('marquise')){
                        $Diamond_image = url('frontend/image/8.png');
                    }elseif($Diamond->product->Shape == strtoupper('pear')){
                        $Diamond_image = url('frontend/image/9.png');
                    }elseif($Diamond->product->Shape == strtoupper('HEART')){
                        $Diamond_image = url('frontend/image/10.png');
                    }elseif($Diamond->product->Shape == strtoupper('asscher')){
                        $Diamond_image = url('frontend/image/asscher.png');
                    }elseif($Diamond->product->Shape == strtoupper('radiant')){
                        $Diamond_image = url('frontend/image/radiant.png');
                    }else{
                        $Diamond_image = url('frontend/image/edit_box_2.png');
                    }
                }
                $artilces.='
                    <tr >
                        <td><a href="'.$url.'"><img src="'.$Diamond_image.'" height="100px" width="100px" ></a></td>
                        <td>'.$Diamond->product->Shape.'</td>
                        <td>'.$Diamond->product->Weight.' Ct</td>
                        <td>'.$Diamond->product->Cut.'</td>
                        <td>'.$Diamond->product->Color.'</td>
                        <td>'.$Diamond->product->Clarity.'</td>
                        <td>'.$Diamond->product->Lab.'</td>
                        <td>$ '.$Diamond->product->Sale_Amt.'</td>
                        <td><a  class="comparesave" data-id="'.$Diamond->product->id.'"><i class="fa fa-balance-scale"></i></a></td>
                    </tr>';
            }
        }

        $totalcompare = Compare::where('ip_address',$ip_address)->get();
        $data = ['artilces' => $artilces,'totalcompare' => count($totalcompare)];   
        return $data;
      
    }

    public function save(Request $request){
        $comparecheck = Compare::where(['ip_address'=>$request->ip_address,'diamond_id'=>$request->diamond_id])->first();
        if ($comparecheck){
            $comparedelete = Compare::where(['ip_address'=>$request->ip_address,'diamond_id'=>$request->diamond_id]);
            $comparedelete->delete();
        }else{
            $compare = new Compare();
            $compare->ip_address = $request->ip_address;
            $compare->diamond_id = isset($request->diamond_id) ? $request->diamond_id : 0;
            $compare->save();
        }
        return response()->json(['status' => '200']); 
    }

    public function compareladdiamond(Request $request)
    {

        $data = $request->all();
        $ip_address = \Request::ip();
        $results = Compare::with('product')->where('ip_address',$ip_address)->orderBy('id','DESC')->get();
        
        $artilces = '';
        if ($request->ajax()) {
            foreach ($results as $Diamond) {
                $url =  URL('labdiamond-details/'.$Diamond->product->slug);
                if($Diamond->product->Stone_Img_url != ""){
                    $Diamond_image = $Diamond->product->Stone_Img_url;
                }else{
                    if($Diamond->product->Shape == strtoupper('round')){
                        $Diamond_image = url('frontend/image/1.png');    
                    }elseif($Diamond->product->Shape == strtoupper('oval')){
                        $Diamond_image = url('frontend/image/2.png');
                    }elseif($Diamond->product->Shape == strtoupper('emerald')){
                        $Diamond_image = url('frontend/image/3.png');
                    }elseif($Diamond->product->Shape == strtoupper('princess')){
                        $Diamond_image = url('frontend/image/6.png');
                    }elseif($Diamond->product->Shape == strtoupper('cushion')){
                        $Diamond_image = url('frontend/image/7.png');
                    }elseif($Diamond->product->Shape == strtoupper('marquise')){
                        $Diamond_image = url('frontend/image/8.png');
                    }elseif($Diamond->product->Shape == strtoupper('pear')){
                        $Diamond_image = url('frontend/image/9.png');
                    }elseif($Diamond->product->Shape == strtoupper('HEART')){
                        $Diamond_image = url('frontend/image/10.png');
                    }elseif($Diamond->product->Shape == strtoupper('asscher')){
                        $Diamond_image = url('frontend/image/asscher.png');
                    }elseif($Diamond->product->Shape == strtoupper('radiant')){
                        $Diamond_image = url('frontend/image/radiant.png');
                    }else{
                        $Diamond_image = url('frontend/image/edit_box_2.png');
                    }
                }
                $artilces.='
                    <tr >
                        <td><a href="'.$url.'"><img src="'.$Diamond_image.'" height="100px" width="100px" ></a></td>
                        <td>'.$Diamond->product->Shape.'</td>
                        <td>'.$Diamond->product->Weight.' Ct</td>
                        <td>'.$Diamond->product->Cut.'</td>
                        <td>'.$Diamond->product->Color.'</td>
                        <td>'.$Diamond->product->Clarity.'</td>
                        <td>'.$Diamond->product->Lab.'</td>
                        <td>$ '.$Diamond->product->Sale_Amt.'</td>
                        <td><a  class="comparesave" data-id="'.$Diamond->product->id.'"><i class="fa fa-balance-scale"></i></a></td>
                    </tr>';
            }
        }

        $totalcompare = Compare::where('ip_address',$ip_address)->get();
        $data = ['artilces' => $artilces,'totalcompare' => count($totalcompare)];   
        return $data;
      
    }
}
