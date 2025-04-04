<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogBanner;
use App\Models\HomeSetting;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(){
        $Categories = BlogCategory::select('id','category_name')->where(['estatus' => 1])->get();
        $BlogBanners = BlogBanner::where(['estatus' => 1,'page' => 0])->get()->ToArray();
        $blogs = Blog::where(['estatus' => 1])->inRandomOrder()->limit(4)->orderBy('id', 'DESC')->get();
        $homesetting = HomeSetting::select('most_viewed_product_id')->first();
        $mostviewproductids = explode(',',$homesetting->most_viewed_product_id);
        $mostviewproducts = Product::with('product_variant')->where(['estatus' => 1])->whereIn('id',$mostviewproductids)->get();
        $meta_title = "Blogs ";
        $meta_description = "Blogs";
        return view('frontend.blogs',compact('Categories','BlogBanners','blogs','mostviewproducts'))->with(['meta_title'=>$meta_title,'meta_description'=>$meta_description]);
    }

    public function fetchblogs(Request $request){
        $data = $request->all();
       
        if(isset($data["action"]))
        {
            $category = (isset($data["category"]) && $data["category"]) ? $data["category"]  : null;
            $query = Blog::where('estatus',1);
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
                            <a href="'.url("blog/".$row->slug).'"><img src="'.url('/').'/'.$row->blog_thumb.'" alt=""></a>
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
                               <a href="'.url("/").'/blog/'.$row->slug.'"> '.$row->title.'</a>
                            </div>
                            <p class="blog_box_paragraph">
                                '. $description .'
                            </p>
                            <button class="explore-category-btn mb-0 mb-md-3 mt-3 read_more_btn cat-details" data-value="'.$row->slug.'">Read more</button>
                        </div>
                    </div>
                </div>
                ';
            }
            } 
            $data = ['output' => $output,'datacount' => count($result)];   
            return $data;
            }
    }

    public function blogdetails($slug){
          
        $blog = Blog::with('category')->where(['slug' => $slug,'estatus' => 1])->first();
        if(!$blog) {
            return view('frontend/404');
        } 
        $blogs = Blog::where(['estatus' => 1])->limit(4)->orderBy('id', 'DESC')->get();
        $BlogBanners = Blogbanner::where(['estatus' => 1,'page' => 0])->get()->ToArray();
        $homesetting = HomeSetting::select('most_viewed_product_id')->first();
        $mostviewproductids = explode(',',$homesetting->most_viewed_product_id);
        $mostviewproducts = Product::with('product_variant')->where(['estatus' => 1])->wherein('id',$mostviewproductids)->get();
        $meta_title = isset($blog->meta_title)?$blog->meta_title:"";
        $meta_description = isset($blog->meta_description)?$blog->meta_description:"";
        return view('frontend.blog',compact('blog','blogs','BlogBanners','mostviewproducts'))->with(['meta_title'=>$meta_title,'meta_description'=>$meta_description]);
    }
}
