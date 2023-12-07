<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\ProjectPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogCategoryController extends Controller
{
    private $page = "Blog Category";

    public function index()
    {
        $action = "list";
        $categories = BlogCategory::where('estatus', 1)->get();
        return view('admin.blogcategories.list', compact('action', 'categories'))->with('page', $this->page);
    }

    public function create()
    {
        $action = "create";
        $categories = BlogCategory::where('estatus', 1)->get()->toArray();
        return view('admin.blogcategories.list', compact('action', 'categories'))->with('page', $this->page);
    }

    public function save(Request $request)
    {
        $messages = [
            'category_name.required' => 'Please provide a Category Name',
        ];

        if (isset($request->action) && $request->action == "update") {
            $validator = Validator::make($request->all(), [
                'category_name' => 'required',
            ], $messages);
        } else {
            $validator = Validator::make($request->all(), [
                'category_name' => 'required',
            ], $messages);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 'failed']);
        }

        if (isset($request->action) && $request->action == "update") {
            $action = "update";
            $category = BlogCategory::find($request->category_id);

            if (!$category) {
                return response()->json(['status' => '400']);
            }

            $category->category_name = $request->category_name;

        } else {
            $action = "add";
            $category = new BlogCategory();
            $category->category_name = $request->category_name;
            $category->created_at = new \DateTime(null, new \DateTimeZone('Asia/Kolkata'));

        }

        $category->save();

        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function allblogcategorylist(Request $request)
    {
        if ($request->ajax()) {
            $columns = array(
                0 => 'sr_no',
                1 => 'category_name',
                2 => 'estatus',
                3 => 'created_at',
                4 => 'action',
            );
            $totalData = BlogCategory::count();

            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if ($order == "sr_no") {
                $order = "created_at";
                $dir = 'desc';
            }

            if (empty($request->input('search.value'))) {
                $categories = BlogCategory::offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();

            } else {
                $search = $request->input('search.value');
                $categories = BlogCategory::Where('category_name', 'LIKE', "%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();


                $totalFiltered = BlogCategory::Where('category_name', 'LIKE', "%{$search}%")
                    ->count();

            }


            $data = array();

            if (!empty($categories)) {
                foreach ($categories as $category) {
                    $page_id = ProjectPage::where('route_url', 'admin.categories.list')->pluck('id')->first();

                    if ($category->estatus == 1 && (getUSerRole() == 1 || (getUSerRole() != 1 && is_write($page_id)))) {
                        $estatus = '<label class="switch"><input type="checkbox" id="BlogCategoryStatuscheck_' . $category->id . '" onchange="chageCategoryStatus(' . $category->id . ')" value="1" checked="checked"><span class="slider round"></span></label>';
                    } elseif ($category->estatus == 1) {
                        $estatus = '<label class="switch"><input type="checkbox" id="BlogCategoryStatuscheck_' . $category->id . '" value="1" checked="checked"><span class="slider round"></span></label>';
                    }

                    if ($category->estatus == 2 && (getUSerRole() == 1 || (getUSerRole() != 1 && is_write($page_id)))) {
                        $estatus = '<label class="switch"><input type="checkbox" id="BlogCategoryStatuscheck_' . $category->id . '" onchange="chageCategoryStatus(' . $category->id . ')" value="2"><span class="slider round"></span></label>';
                    } elseif ($category->estatus == 2) {
                        $estatus = '<label class="switch"><input type="checkbox" id="BlogCategoryStatuscheck_' . $category->id . '" value="2"><span class="slider round"></span></label>';
                    }


                    $action = '';
                    if (getUSerRole() == 1 || (getUSerRole() != 1 && is_write($page_id))) {
                        $action .= '<button id="editBlogCategoryBtn" class="btn btn-gray text-blue btn-sm" data-id="' . $category->id . '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if (getUSerRole() == 1 || (getUSerRole() != 1 && is_delete($page_id))) {
                        $action .= '<button id="deleteBlogCategoryBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeleteBlogCategoryModal" onclick="" data-id="' . $category->id . '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }
                    $nestedData['category_name'] = $category->category_name;
                    $nestedData['estatus'] = $estatus;
                    $nestedData['created_at'] = date('d-m-Y h:i A', strtotime($category->created_at));
                    $nestedData['action'] = $action;
                    $data[] = $nestedData;
                }
            }

            $json_data = array(
                "draw" => intval($request->input('draw')),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data,
            );
            echo json_encode($json_data);
        }
    }

    public function changeblogcategorystatus($id)
    {
        $category = BlogCategory::find($id);
        if ($category->estatus == 1) {
            $category->estatus = 2;
            $category->save();
            return response()->json(['status' => '200', 'action' => 'deactive']);
        }
        if ($category->estatus == 2) {
            $category->estatus = 1;
            $category->save();
            return response()->json(['status' => '200', 'action' => 'active']);
        }
    }

    public function deletecategory($id)
    {
        $category = BlogCategory::find($id);
        if ($category) {
            $category->estatus = 3;
            $category->save();
            $category->delete();

            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }

    public function editcategory($id)
    {
        $action = "edit";
        //$categories = BlogCategory::where('estatus',1)->where('id',"!=",$id)->where('parent_category_id',"!=",$id)->get()->toArray();
        $category = BlogCategory::find($id);

        return view('admin.blogcategories.list', compact('action', 'category'))->with('page', $this->page);
    }

}
