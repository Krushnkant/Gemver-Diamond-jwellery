<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Product;
use App\Models\Category;

class RelatedProduct extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $categoryidss; // new property
    public $productid; // new property
    public $iscustom; // new property

    //public $primary_category_idss;
    public function __construct($categoryidss,$productid,$iscustom=0)
    {
        $this->categoryidss=$categoryidss;
        $this->productid=$productid;
        $this->iscustom=$iscustom;
        //dd($primary_category_idss);
       // $this->primary_category_idss = $primary_category_idss;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $primary_category_idss = $this->categoryidss;
        $Category = Category::select('slug')->whereIn(['id',$primary_category_idss])->first();
        $Cslug = $Category->slug;
        $iscustom = $this->iscustom;
        //$ProductRelated= Product::select('products.id','products.product_title','products.primary_category_id','product_variants.slug','product_variants.alt_text','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1,'product_variants.term_item_id' => 2])->WhereIn('primary_category_id',$primary_category_idss)->where('products.id','<>',$this->productid)->groupBy('products.id')->limit(8)->get();
        //dd($primary_category_idss);
        $ProductRelated= Product::with('product_variant')->where(['is_custom' => $this->iscustom,'estatus' => 1])->WhereHas('product_variant',function ($mainQuery) {
            $mainQuery->where('term_item_id',2)->where('estatus',1);
        })->WhereIn('primary_category_id',$primary_category_idss)->where('id','<>',$this->productid)->groupBy('id')->limit(6)->get();
        
        return view('components.related-product',compact('ProductRelated','iscustom','Cslug'));
    }
}
