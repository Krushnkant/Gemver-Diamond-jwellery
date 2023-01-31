<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Product;

class RelatedProduct extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $categoryidss; // new property

    //public $primary_category_idss;
    public function __construct($categoryidss)
    {
        $this->categoryidss=$categoryidss;
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
        $primary_category_idss = explode(",",$this->categoryidss);
        dd($primary_category_idss);
        $ProductRelated= Product::select('products.id','products.product_title','products.primary_category_id','product_variants.slug','product_variants.alt_text','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1,'product_variants.term_item_id' => 2])->WhereIn('primary_category_id',$primary_category_idss)->groupBy('products.id')->limit(8)->get();
        return view('components.related-product',compact('ProductRelated'));
    }
}
