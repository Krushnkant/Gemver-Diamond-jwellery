<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectPage;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers;


class ContactusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $action = "list";
        return view('admin.contactus.list',compact('action'));
    }

    public function allcontactslist(Request $request){
     
        if ($request->ajax()) {
            $tab_type = $request->tab_type;
            if ($tab_type == "active_contact_tab"){
                $estatus = 1;
            }
            elseif ($tab_type == "deactive_contact_tab"){
                $estatus = 2;
            }
             
            $columns = array(
                0 =>'id',
                1 =>'customer_info',
                2=> 'message',
                3=> 'created_at',
               // 7=> 'action',
            );

            $totalData = ContactUs::count();
            if (isset($estatus)){
                $totalData = ContactUs::where('estatus',$estatus)->count();
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
                
                $contacts = ContactUs::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir);

                if (isset($estatus)){
                    $contacts = $contacts->where('estatus',$estatus);
                }
                $contacts = $contacts->get();
            }
            else {
                $search = $request->input('search.value');
                $contacts =  ContactUs::where(function($query) use($search){
                    $query->where('id','LIKE',"%{$search}%")
                          ->orWhere('name', 'LIKE',"%{$search}%")
                          ->orWhere('subject', 'LIKE',"%{$search}%");
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                if (isset($estatus)){
                    $contacts = $contacts->where('estatus',$estatus)->where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                              ->orWhere('name', 'LIKE',"%{$search}%")
                              ->orWhere('subject', 'LIKE',"%{$search}%");
                        })
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
                }

                $totalFiltered = ContactUs::where(function($query) use($search){
                    $query->where('id','LIKE',"%{$search}%")
                         ->orWhere('name', 'LIKE',"%{$search}%")
                         ->orWhere('subject', 'LIKE',"%{$search}%");
                    })->count();
                if (isset($estatus)){
                    $totalFiltered = $totalFiltered->where('estatus',$estatus)->where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                             ->orWhere('name', 'LIKE',"%{$search}%")
                             ->orWhere('subject', 'LIKE',"%{$search}%");
                        })->count();
                }
               
            }
            $data = array();

            if(!empty($contacts))
            {
                foreach ($contacts as $contact)
                {
                    $page_id = ProjectPage::where('route_url','admin.users.list')->pluck('id')->first();
                    // $action='';
                    // if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                    //     $action .= '<button id="deleteContactBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeleteContactModal" data-id="' .$contact->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    // }

                    $customer_info = '';
                    if (isset($contact->email)){
                        $customer_info .= '<span><i class="fa fa-user" aria-hidden="true"></i> ' .$contact->name .'</span>';
                    }
                    if (isset($contact->email)){
                        $customer_info .= '<span><i class="fa fa-envelope" aria-hidden="true"></i> ' .$contact->email .'</span>';
                    }
                    if (isset($contact->mobile_no)){
                        $customer_info .= '<span><i class="fa fa-phone" aria-hidden="true"></i> ' .$contact->mobile_no .'</span>';
                    }

                    $message = '';
                    if (isset($contact->subject)){
                        $message .= '<span> ' .$contact->subject .'</span>';
                    }
                    if (isset($contact->message)){
                        $message .= '<span> ' .$contact->message .'</span>';
                    }
                   

                    $newDate = date("d-m-Y", strtotime($contact->created_at));
                    $nestedData['customer_info'] = $customer_info;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            // dump($validator->errors());
            return $this->sendError($validator->errors(), "Validation Errors", []);
        }else{
            $data = $request->all();
            $contact = ContactUs::Create($data);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function deletecontact($id){
        $Faqform = ContactUs::where('id',$id)->first();
        if ($Faqform){
            $Faqform->save();
            $Faqform->delete();
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }
}
