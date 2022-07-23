<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(){
        $Categories = BlogCategory::where(['estatus' => 1])->get();
        return view('frontend.blogs',compact('Categories'));
    }

    public function fetchblogs(Request $request){
        $data = $request->all();
       
        if(isset($data["action"]))
        {
           
            $category = (isset($data["category"]) && $data["category"]) ? $data["category"]  : null;
            $query = Blog::where('estatus',1);
            
            // if($request->keyword){
            //     // This will only execute if you received any keyword
            //     $query = $query->where('name','like','%'.$keyword.'%');
            // }
        
            if(isset($data["category"])){
                $query = $query->where('category_id',$data["category"]);
            }
            $result = $query->orderBy('created_at','DESC')->paginate(12);
            $output = '';
            if(count($result) > 0){
            foreach($result as $row)
            {
                $taglessBody = strip_tags($row->description);
                $description = Str::limit($taglessBody, 100, "...");
                
                $output .= '
                <div class="col-md-6 col-lg-6 col-xl-4 px-0 px-md-3 mb-md-4">
                    <div class="blog_box">
                        <div class="blog_box_img position-relative">
                        <img src="'.url('/').'/'.$row->blog_thumb.'" alt="">
                        </div>
                        <div class="blg_box_description">
                            <div class="blg_box_date my-2">
                                <span class="me-2"> 
                                    <img src="'. url('frontend/image/icon-1.png') .' " alt="" class="blog-icon-img">
                                </span>
                                <span class="blog_box_date">
                                    '.date('d M, Y', strtotime($row->created_at)).'
                                </span>
                            </div>
                            <div class="blog_box_heading">
                               <a href="'.url("/").'/blog/'.$row->id.'"> '.$row->title.'</a>
                            </div>
                            <p class="blog_box_paragraph">
                                '. $description .'
                            </p>
                            <button class="explore-category-btn mb-0 mb-md-3 read_more_btn cat-details" data-value="'.$row->id.'">Read more</button>
                        </div>
                    </div>
                </div>
                ';
            }
            }else{
                $output .= 'Data Not Found';  
            } 
            $data = ['output' => $output,'datacount' => count($result)];   
            return $data;
            }
    }

    public function blogdetails($id){
        $blog = Blog::with('category')->where(['id' => $id,'estatus' => 1])->first();
        $blogs = Blog::where(['estatus' => 1])->limit(4)->orderBy('id', 'DESC')->get();
        return view('frontend.blog',compact('blog','blogs'));
    }
}
