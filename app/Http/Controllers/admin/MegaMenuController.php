<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\MegaMenu;
use App\Models\SubMenu;
use App\Models\Category;
use App\Models\MenuCategory;
use App\Models\ProjectPage;

class MegaMenuController extends Controller
{
    private $page = "Mega Menu";

    public function index(){
        $MegaMenus = MegaMenu::get();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.megamenus.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.megamenu.list',compact('MegaMenus','canWrite'))->with('page',$this->page);
    }

    public function editmegamenus($id){
        $MegaMenu = MegaMenu::find($id);
        return response()->json($MegaMenu);
    }

    public function updateMegaMenu(Request $request){
        $messages = [
            'title.required' =>'Please provide a title',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $MegaMenu = MegaMenu::find($request->mega_menu_id);
        if(!$MegaMenu){
            return response()->json(['status' => '400']);
        }
        $MegaMenu->title = $request->title;
        $old_image = $MegaMenu->menu_thumb;
        $menu_thumb = "";
        if ($request->hasFile('menu_thumb')) {
            $image = $request->file('menu_thumb');
            $menu_thumb = 'menu_thumb_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/megamenu');
            $image->move($destinationPath, $menu_thumb);
            if(isset($old_image)) {
                $old_image = public_path('images/megamenu/' . $old_image);
                if (file_exists($old_image)) {
                    //unlink($old_image);
                }
            }
            $MegaMenu->menu_thumb = $menu_thumb;
        }
        $MegaMenu->save();
        return response()->json(['status' => '200','title' => $MegaMenu->title,'menu_thumb' => $menu_thumb ]);
    }

    public function submenu($id){
        $SubMenus = SubMenu::where('mega_menu_id',$id)->get();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.megamenus.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.megamenu.submenulist',compact('SubMenus','canWrite'))->with('page',$this->page);
    }

    public function editsubmenus($id){
        $SubMenu = SubMenu::find($id);
        return response()->json($SubMenu);
    }

    public function updateSubMenu(Request $request){
        $messages = [
            'title.required' =>'Please provide a title',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }
        //dd($request->all());
        $SubMenu = SubMenu::find($request->sub_menu_id);
        if(!$SubMenu){
            return response()->json(['status' => '400']);
        }
        $SubMenu->title = $request->title;
        $SubMenu->save();
        return response()->json(['status' => '200','title' => $SubMenu->title ]);
    }


    public function submenumanage($id,$megaid){
        $MenuCategories = MenuCategory::where('menu_id',$id)->get();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.megamenus.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        $categories = Category::where('is_custom',0)->where('estatus',1)->get()->toArray();
        return view('admin.megamenu.manage',compact('MenuCategories','canWrite','categories','id','megaid'))->with('page',$this->page);
    }

    public function editsubmenumanage($id){
        $MenuCategory = MenuCategory::find($id);
        return response()->json($MenuCategory);
    }

    public function updateMenuManage(Request $request){
        $messages = [
            'title.required' =>'Please provide a title',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        if($request->manage_id == ""){
           $MenuCategory = new MenuCategory();
        }else{
            $MenuCategory = MenuCategory::find($request->manage_id);
            if(!$MenuCategory){
                return response()->json(['status' => '400']);
            }
            $old_image = $MenuCategory->menu_thumb;
        }
        
        $MenuCategory->title = $request->title;
        $MenuCategory->category_id = $request->category_id;
        $MenuCategory->menu_id = $request->menu_id;
    
        if ($request->hasFile('icon')) {
            $image = $request->file('icon');
            $icon = 'icon_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/categoryicon');
            $image->move($destinationPath, $icon);
            if(isset($old_image)) {
                $old_image = public_path('images/categoryicon/' . $old_image);
                if (file_exists($old_image)) {
                    //unlink($old_image);
                }
            }
            $MenuCategory->icon = $icon;
        }
        $MenuCategory->save();
        return response()->json(['status' => '200','title' => $MenuCategory->title ]);
    }

    public function deletesubmenusmanage($id){
        $menucategory = MenuCategory::find($id);
        if ($menucategory){
            $menucategory->delete();
           
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }
}
