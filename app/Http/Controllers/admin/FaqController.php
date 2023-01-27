<?php

namespace App\Http\Controllers\admin;
use App\Models\Faq;
use App\Models\ProjectPage;
use App\Models\MenuPage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function index(){
        $action = "list";
        
        return view('admin.faqs.list',compact('action'));
    }

    public function create(){
        $action = "create";
        $custom_fields = Faq::get();
        $menu_pages = MenuPage::get();
        return view('admin.faqs.list',compact('action','custom_fields','menu_pages'));
        // return redirect('/faqs');
    }

    public function save(Request $request){
        $messages = [
            'question.required' =>'Please provide a Question',
            'answer.required' =>'Please provide a Answer',
            'menu_page_id.required' =>'Please select Menu Page',
        ];

        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'answer' => 'required',
            'menu_page_id' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        if (isset($request->action) && $request->action=="update"){
            $action = "update";
            $Faq = Faq::where('id',$request->faq_id)->first();

            if(!$Faq){
                return response()->json(['status' => '400']);
            }

            $Faq->question = $request->question;
            $Faq->answer = $request->answer;
            $Faq->menu_page_ids = implode(',',$request->menu_page_id);
        }
        else{
            $action = "add";
            $Faq = new Faq();
            $Faq->question = $request->question;
            $Faq->answer = $request->answer;
            $Faq->menu_page_ids = implode(',',$request->menu_page_id);
            $Faq->created_at = new \DateTime(null, new \DateTimeZone('Asia/Kolkata'));
        }

        $Faq->save();

        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function allFaqslist(Request $request){
        if ($request->ajax()) {
            $columns = array(
                0 => 'id',
                1 => 'question',
                2 => 'answer',
                3 => 'action',
            );
            $totalData = Faq::count();
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
                $Faqs = Faq::offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
            }
            else {
                $search = $request->input('search.value');
                $Faqs =  Faq::where('question','LIKE',"%{$search}%")
                    ->orWhere('answer', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();


                $totalFiltered = count($Faqs->toArray());
            }
            //print_r($Faqs); die;
            $data = array();

            if(!empty($Faqs))
            {
                foreach ($Faqs as $Faq)
                {
                    $page_id = ProjectPage::where('route_url','admin.faqs.list')->pluck('id')->first();

                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="editFaqBtn" class="btn btn-gray text-blue btn-sm" data-id="' .$Faq->id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    $action .= '<button id="deleteFaqBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeleteFaqModal" data-id="' .$Faq->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    
                    $nestedData['question'] = $Faq->question;
                    $nestedData['answer'] = $Faq->answer;
                  
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

    function editFaq($id){
        $action = "edit";
        $custom_fields = Faq::get();
        $Faq = Faq::where('id',$id)->first()->toArray();
        $menu_pages = MenuPage::get();
        return view('admin.faqs.list',compact('action','Faq','custom_fields','menu_pages'));
    }

    public function deleteFaq($id){
        $Faqform = Faq::where('id',$id)->first();
        if ($Faqform){
            $Faqform->estatus = 3;
            $Faqform->save();
            $Faqform->delete();
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }

}
