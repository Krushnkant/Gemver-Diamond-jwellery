@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Wedding Bands Page</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <form class="form-valide" action="" id="MenuForm" method="post">
    <div id="cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
   
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Main Section
                        </h4>

                      
                        <div class="row col-lg-12">
                           
                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12  justify-content-center" style="display: none;">
                              <div class="form-group">
                                <label class="col-form-label" for="main_title"> Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-flat" id="main_title" name="main_title" >
                                <div id="main_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>
                             
                             <div class="form-group">
                                <label class="col-form-label" for="main_shotline">Shotline <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="main_shotline" name="main_shotline"></textarea>
                                <div id="main_shotline-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>
                            </div>
                            <div class="col-lg-3 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                                <div class="form-group">
                                   <label class="col-form-label" for="banner_image">Banner Image <span class="text-danger">*</span>
                                   </label>
                                   <input type="file" class="form-control-file" id="banner_image" name="banner_image" placeholder="">
                                  <div id="banner_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    <img src="{{ url('images/placeholder_image.png') }}" class="" id="banner_image_show" height="100px" width="100px"  style="margin-top: 5px">
                                  </div>
                               </div>
                               <div class="col-lg-3 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                                <div class="form-group">
                                    <label class="col-form-label" for="banner_mobile_image">Banner Mobile Image <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" class="form-control-file" id="banner_mobile_image" name="banner_mobile_image" placeholder="">
                                    <div id="banner_mobile_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                        <img src="{{ url('images/placeholder_image.png') }}" class="" id="banner_mobile_image_show" height="100px" width="100px"  style="margin-top: 5px">
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-10 col-sm-10 col-xs-12  justify-content-center">
                                <div class="form-group">
                                    <select  name="main_banner_category_id" id="categories" class="form-control">
                                    <option value="">Select Main Banner Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category['slug'] }}">{{ $category['category_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Section 1
                        </h4>
                      
                        <div class="row add-value">
                            <div class="row col-lg-12">
                                <div class="col-lg-2 ">
                                    <div class="form-group ">
                                        <label class="col-form-label" for="section_category_title"> Image 
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <label class="col-form-label" for="section_category_title"> Title 
                                        </label>
                                   </div>
                                </div>
                             
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <label class="col-form-label" for="section_category_title"> Category 
                                        </label>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row col-lg-12">
                            <div class="col-lg-2 ">
                                <div class="form-group ">
                                    <input type="file" class="form-control-file" id="image[]" onchange="" name="image[]">
                                </div>
                            </div>
                            <div class="col-lg-4 ">
                                <div class="form-group">
                                    <input type="text" class="form-control input-flat" id="subtitle" name="subtitle[]" placeholder="Enter Title">
                                    <div id="subtitle-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                               </div>
                            </div>
                            <div class="col-lg-4 ">
                                <div class="form-group">
                                    <select  name="category_id[]" class="form-control category_id">
                                    <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category['id'] }}">{{ $category['category_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            </div>
                            @if(isset($menupages->menupageshapestyle))
                            @foreach($menupages->menupageshapestyle as $shapestyle)
                    
                            <div class="row col-lg-12">
                                <div class="col-lg-2">
                                    <div class="form-group ">
                                        <input type="hidden" class="form-control-file"  name="orderdataid[]" value="{{ $shapestyle->id }}"> 
                                        <input type="file" class="form-control-file" id="image" onchange="" name="imageold[]">
                                        <img src="{{ asset('images/shopstyle_image/'.$shapestyle->image) }}" class="" id="profilepic_image_show" height="50px" width="50px" style="margin-top: 5px">
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-flat" id="subtitleold" value="{{ $shapestyle->title }}" name="subtitleold[]">
                                        <div id="subtitle-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <select  name="category_id_old[]" class="form-control category_id">
                                        <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category['id'] }}" {{ ($shapestyle->category_id == $category['id']) ? "selected" : "" }} >{{ $category['category_name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 ">
                                    <button type="button" class="minus_btn btn mb-1 btn-outline-danger" ><i class="fa fa-remove"></i> </button>
                                </div>
                            </div>
                                 
                            @endforeach
                            @endif
                        </div>
                        <div class="col-lg-2 ">
                            <div class="form-group">
                                
                            <button type="button" class="btn btn-outline-primary " id="Add" data-action="add">Add New </button>
                                
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Section 2
                        </h4>
                      
                        <div class="row col-lg-12">
                            <div class="col-lg-12 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                                <div class="form-group">
                                    <label class="col-form-label" for="section5_title">Main Title <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control input-flat" id="section5_title" name="section5_title" >
                                    <div id="section5_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>
                            </div>
                        
                            <div class="col-lg-4 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                                <div class="form-group">
                                    <label class="col-form-label" for="section51_image"> Image <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" class="form-control-file" id="section51_image" name="section51_image">
                                    <div id="section51_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    <img src="{{ url('images/placeholder_image.png') }}" class="" id="section51_image_show" height="100px" width="100px"  style="margin-top: 5px">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="section51_title"> Title <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control input-flat" id="section51_title" name="section51_title" >
                                    <div id="section51_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>
                            
                                <div class="form-group" style="display: none;">
                                    <label class="col-form-label" for="section51_description"> Description <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control" id="section51_description" name="section51_description"></textarea>
                                    <div id="section51_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>

                               
                                <div class="form-group">
                                    <label class="col-form-label"> Category <span class="text-danger">*</span>
                                    </label>
                                    <select  name="section51_category" class="form-control category_select">
                                    <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category['slug'] }}">{{ $category['category_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                             
                                
                            </div>

                            <div class="col-lg-4 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                                <div class="form-group">
                                    <label class="col-form-label" for="section52_image"> Image <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" class="form-control-file" id="section52_image" name="section52_image">
                                    <div id="section52_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    <img src="{{ url('images/placeholder_image.png') }}" class="" id="section52_image_show" height="100px" width="100px"  style="margin-top: 5px">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="section52_title"> Title <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control input-flat" id="section52_title" name="section52_title" >
                                    <div id="section52_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>
                            
                                <div class="form-group" style="display: none;">
                                    <label class="col-form-label" for="section52_description"> Description <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control" id="section52_description" name="section52_description"></textarea>
                                    <div id="section52_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label"> Category <span class="text-danger">*</span>
                                    </label>
                                    <select  name="section52_category" class="form-control category_select">
                                    <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category['slug'] }}">{{ $category['category_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>


                            <div class="col-lg-4 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                                <div class="form-group">
                                    <label class="col-form-label" for="section53_image"> Image <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" class="form-control-file" id="section53_image" name="section53_image">
                                    <div id="section53_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    <img src="{{ url('images/placeholder_image.png') }}" class="" id="section53_image_show" height="100px" width="100px"  style="margin-top: 5px">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="section53_title"> Title <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control input-flat" id="section53_title" name="section53_title" >
                                    <div id="section53_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>
                            
                                <div class="form-group" style="display: none;">
                                    <label class="col-form-label" for="section53_description"> Description <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control" id="section53_description" name="section53_description"></textarea>
                                    <div id="section53_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label"> Category <span class="text-danger">*</span>
                                    </label>
                                    <select  name="section53_category" class="form-control category_select">
                                    <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category['slug'] }}">{{ $category['category_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Section 3
                        </h4>
                      
                        <div class="row col-lg-12">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  justify-content-center">
                                <div class="form-group" >
                                    <label class="col-form-label" for="button_url">Select Product
                                    </label>
                                    <?php $select_product = explode(',',$menupages->select_product); ?>
                                    <select id='select_product_id' name="select_product_id[]" class="js-example-basic-multiple form-control" multiple="multiple">
                                    <option value="">Select Product</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product['id'] }}"  @if(in_array($product["id"],$select_product)) selected @endif >{{ $product['product_title'] }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div> 
                        
                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                              <div class="form-group">
                                <label class="col-form-label" for="section1_title"> Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-flat" id="section1_title" name="section1_title" >
                                <div id="section1_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>
                             
                             <div class="form-group">
                                <label class="col-form-label" for="section1_description"> Contant <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="section1_description" name="section1_description"></textarea>
                                <div id="section1_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>
                            </div>
                            <div class="col-lg-3 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                                <div class="form-group">
                                   <label class="col-form-label" for="Logo"> Image <span class="text-danger">*</span>
                                   </label>
                                   <input type="file" class="form-control-file" id="section1_image" name="section1_image" placeholder="">
                                  <div id="section1_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    <img src="{{ url('images/placeholder_image.png') }}" class="" id="section1_image_show" height="100px" width="100px"  style="margin-top: 5px">
                                  </div>
                               </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Section 4
                        </h4>
                      
                        <div class="row col-lg-12">
                            <div class="col-lg-12 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                                <div class="form-group">
                                    <label class="col-form-label" for="section3_title">Main Title <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control input-flat" id="section3_title" name="section3_title" >
                                    <div id="section3_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>
                            </div>
                        
                            {{-- <div class="col-lg-4 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                                <div class="form-group">
                                    <label class="col-form-label" for="section31_image"> Image <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" class="form-control-file" id="section31_image" name="section31_image">
                                    <div id="section31_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    <img src="{{ url('images/placeholder_image.png') }}" class="" id="section31_image_show" height="100px" width="100px"  style="margin-top: 5px">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="section31_title"> Title <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control input-flat" id="section31_title" name="section31_title" >
                                    <div id="section31_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>
                            
                                <div class="form-group">
                                    <label class="col-form-label" for="section31_description"> Description <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control" id="section31_description" name="section31_description"></textarea>
                                    <div id="section31_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>
                                
                            </div>

                            <div class="col-lg-4 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                                <div class="form-group">
                                    <label class="col-form-label" for="section32_image"> Image <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" class="form-control-file" id="section32_image" name="section32_image">
                                    <div id="section32_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    <img src="{{ url('images/placeholder_image.png') }}" class="" id="section32_image_show" height="100px" width="100px"  style="margin-top: 5px">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="section32_title"> Title <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control input-flat" id="section32_title" name="section32_title" >
                                    <div id="section32_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>
                            
                                <div class="form-group">
                                    <label class="col-form-label" for="section32_description"> Description <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control" id="section32_description" name="section32_description"></textarea>
                                    <div id="section32_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>
                                
                            </div>


                            <div class="col-lg-4 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                                <div class="form-group">
                                    <label class="col-form-label" for="section33_image"> Image <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" class="form-control-file" id="section33_image" name="section33_image">
                                    <div id="section33_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    <img src="{{ url('images/placeholder_image.png') }}" class="" id="section33_image_show" height="100px" width="100px"  style="margin-top: 5px">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="section33_title"> Title <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control input-flat" id="section33_title" name="section33_title" >
                                    <div id="section33_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>
                            
                                <div class="form-group">
                                    <label class="col-form-label" for="section33_description"> Description <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control" id="section33_description" name="section33_description"></textarea>
                                    <div id="section33_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>
                                
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Section 5
                        </h4>
                        <div class="row col-lg-12">
                             
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                              <div class="form-group">
                                <label class="col-form-label" for="section4_title"> Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-flat" id="section4_title" name="section4_title" >
                                <div id="section4_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="section4_description"> Description <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="section4_description" name="section4_description"></textarea>
                                <div id="section4_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                            <div class="form-group">
                               <label class="col-form-label" for="section4_image"> Image <span class="text-danger">*</span>
                               </label>
                               <input type="file" class="form-control-file" id="section4_image" name="section4_image" placeholder="">
                              <div id="section4_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                <img src="{{ url('images/placeholder_image.png') }}" class="" id="section4_image_show" height="100px" width="100px"  style="margin-top: 5px">
                              </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 justify-content-center mt-4">
                        <button type="button" class="btn btn-primary" id="saveMenuPage">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@section('js')
<!-- settings JS start -->
<script type="text/javascript">
    $( document ).ready(function() {

        $('.category_id').select2({
            width: '100%',
            placeholder: "Select Category",
            allowClear: false
        });

        $('.category_select').select2({
            width: '100%',
            placeholder: "Select Category",
            allowClear: false
        });
        
        $.get("{{ url('admin/menupage') }}" +'/2/edit', function (data) {
            $('#main_title').val(data.main_title);
           $('#main_shotline').val(data.main_shotline);
           $('#section1_title').val(data.section1_title);
           $('#section1_description').val(data.section1_description);
           $('#section2_title').val(data.section2_title);
           $('#section2_description').val(data.section2_description);
           $('#section3_title').val(data.section3_title);

           $('#section31_title').val(data.section31_title);
           $('#section31_description').val(data.section31_description);
           $('#section32_title').val(data.section32_title);
           $('#section32_description').val(data.section32_description);
           $('#section33_title').val(data.section33_title);
           $('#section33_description').val(data.section33_description);
           $('#section4_title').val(data.section4_title);
           $('#section4_description').val(data.section4_description);

           $('#section5_title').val(data.section5_title);
           $('#section51_title').val(data.section51_title);
           $('#section51_description').val(data.section51_description);
           $('#section52_title').val(data.section52_title);
           $('#section52_description').val(data.section52_description);
           $('#section53_title').val(data.section53_title);
           $('#section53_description').val(data.section53_description);

           $('[name=main_banner_category_id]').val(data.main_banner_category_id).change();

           $('[name=section51_category]').val(data.section51_category).change();
           $('[name=section52_category]').val(data.section52_category).change();
           $('[name=section53_category]').val(data.section53_category).change();

           if(data.banner_image!=null){
                var banner_image = "{{ url('images/aboutus') }}" +"/" + data.banner_image;
                $('#banner_image_show').attr('src', banner_image);
            }
            if(data.banner_mobile_image!=null){
                var banner_mobile_image = "{{ url('images/aboutus') }}" +"/" + data.banner_mobile_image;
                $('#banner_mobile_image_show').attr('src', banner_mobile_image);
            } 

           if(data.section1_image!=null){
                var section1_image = "{{ url('images/aboutus') }}" +"/" + data.section1_image;
                $('#section1_image_show').attr('src', section1_image);
            }
          
            if(data.section2_image!=null){
                var section2_image = "{{ url('images/aboutus') }}" +"/" + data.section2_image;
                $('#section2_image_show').attr('src', section2_image);
            }

            if(data.section3_image!=null){
                var section3_image = "{{ url('images/aboutus') }}" +"/" + data.section3_image;
                $('#section3_image_show').attr('src', section3_image);
            }

            if(data.section31_image!=null){
                var section31_image = "{{ url('images/aboutus') }}" +"/" + data.section31_image;
                $('#section31_image_show').attr('src', section31_image);
            }

            if(data.section32_image!=null){
                var section32_image = "{{ url('images/aboutus') }}" +"/" + data.section32_image;
                $('#section32_image_show').attr('src', section32_image);
            }

            if(data.section33_image!=null){
                var section33_image = "{{ url('images/aboutus') }}" +"/" + data.section33_image;
                $('#section33_image_show').attr('src', section33_image);
            }

            if(data.section4_image!=null){
                var section4_image = "{{ url('images/aboutus') }}" +"/" + data.section4_image;
                $('#section4_image_show').attr('src', section4_image);
            }

            if(data.section51_image!=null){
                var section51_image = "{{ url('images/aboutus') }}" +"/" + data.section51_image;
                $('#section51_image_show').attr('src', section51_image);
            }

            if(data.section52_image!=null){
                var section52_image = "{{ url('images/aboutus') }}" +"/" + data.section52_image;
                $('#section52_image_show').attr('src', section52_image);
            }

            if(data.section53_image!=null){
                var section53_image = "{{ url('images/aboutus') }}" +"/" + data.section53_image;
                $('#section53_image_show').attr('src', section53_image);
            }

        })
    });

    $('body').on('click', '#saveMenuPage', function () {
        $('#saveMenuPage').prop('disabled',true);
        $('#saveMenuPage').find('.loadericonfa').show();
        var formData = new FormData($("#MenuForm")[0]);
        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateWeddingPage') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveMenuPage').prop('disabled',false);
                    $('#saveMenuPage').find('.loadericonfa').hide();

                    if (res.errors.main_title) {
                        $('#main_title-error').show().text(res.errors.main_title);
                    } else {
                        $('#main_title-error').hide();
                    }

                    if (res.errors.main_shotline) {
                        $('#main_shotline-error').show().text(res.errors.main_shotline);
                    } else {
                        $('#main_shotline-error').hide();
                    }

                    if (res.errors.banner_image) {
                        $('#banner_image-error').show().text(res.errors.banner_image);
                    } else {
                        $('#banner_image-error').hide();
                    }
                   
                    if (res.errors.section1_title) {
                        $('#section1_title-error').show().text(res.errors.section1_title);
                    } else {
                        $('#section1_title-error').hide();
                    }

                    if (res.errors.section1_description) {
                        $('#section1_description-error').show().text(res.errors.section1_description);
                    } else {
                        $('#section1_description-error').hide();
                    }

                    if (res.errors.section1_image) {
                        $('#section1_image-error').show().text(res.errors.section1_image);
                    } else {
                        $('#section1_image-error').hide();
                    }

                    if (res.errors.section2_title) {
                        $('#section2_title-error').show().text(res.errors.section2_title);
                    } else {
                        $('#section2_title-error').hide();
                    }

                    if (res.errors.section2_description) {
                        $('#section2_description-error').show().text(res.errors.section2_description);
                    } else {
                        $('#section2_description-error').hide();
                    }

                    if (res.errors.section2_image) {
                        $('#section2_image-error').show().text(res.errors.section2_image);
                    } else {
                        $('#section2_image-error').hide();
                    }

                    if (res.errors.section3_title) {
                        $('#section3_title-error').show().text(res.errors.section3_title);
                    } else {
                        $('#section3_title-error').hide();
                    }

                    if (res.errors.section3_description) {
                        $('#section3_description-error').show().text(res.errors.section3_description);
                    } else {
                        $('#section3_description-error').hide();
                    }

                    if (res.errors.section3_image) {
                        $('#section3_image-error').show().text(res.errors.section3_image);
                    } else {
                        $('#section3_image-error').hide();
                    }

                    if (res.errors.section4_title) {
                        $('#section4_title-error').show().text(res.errors.section4_title);
                    } else {
                        $('#section4_title-error').hide();
                    }

                    if (res.errors.section4_description) {
                        $('#section4_description-error').show().text(res.errors.section4_description);
                    } else {
                        $('#section4_description-error').hide();
                    }

                    if (res.errors.section4_image) {
                        $('#section4_image-error').show().text(res.errors.section4_image);
                    } else {
                        $('#section4_image-error').hide();
                    } 
                }

                if(res.status == 200){
                    
                    $('#saveMenuPage').prop('disabled',false);
                    $('#saveMenuPage').find('.loadericonfa').hide();
                 
                    toastr.success("Wedding Page Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                   
                    $('#saveMenuPage').prop('disabled',false);
                    $('#saveMenuPage').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
             
                $('#saveMenuPage').prop('disabled',false);
                $('#saveMenuPage').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });


    $('#banner_image').change(function(){
        $('#banner_image-error').hide();
        var file = this.files[0];
      
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg", "image/svg+xml"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#banner_image-error').show().text("Please provide a Valid Extension Section Image(e.g: .jpg .png .svg)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#banner_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#banner_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#banner_mobile_image').change(function(){
        $('#banner_mobile_image-error').hide();
        var file = this.files[0];
      
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg", "image/svg+xml"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#banner_mobile_image-error').show().text("Please provide a Valid Extension Section Image(e.g: .jpg .png .svg)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#banner_mobile_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#banner_mobile_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });


    $('#section1_image').change(function(){
        $('#section1_image-error').hide();
        var file = this.files[0];
      
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg", "image/svg+xml"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#section1_image-error').show().text("Please provide a Valid Extension Section Image(e.g: .jpg .png .svg)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#section1_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#section1_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });


    

    $('#section2_image').change(function(){
        
        $('#section2_image-error').hide();
        var file = this.files[0];
      
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg", "image/svg+xml"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#section2_image-error').show().text("Please provide a Valid Extension Section Image(e.g: .jpg .png .svg)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#section2_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#section2_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });


    $('#section3_image').change(function(){
        
        $('#section3_image-error').hide();
        var file = this.files[0];
      
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg", "image/svg+xml"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#section3_image-error').show().text("Please provide a Valid Extension Section Image(e.g: .jpg .png .svg)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#section3_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#section3_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    

    $('#section4_image').change(function(){
        
        $('#section4_image-error').hide();
        var file = this.files[0];
      
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/svg+xml"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#section4_image-error').show().text("Please provide a Valid Extension Section Image(e.g: .jpg .png .svg)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#section4_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#section4_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#section31_image').change(function(){
        
        $('#section31_image-error').hide();
        var file = this.files[0];
      
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#section31_image-error').show().text("Please provide a Valid Extension Section Image(e.g: .jpg .png)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#section31_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#section31_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#section32_image').change(function(){
        
        $('#section32_image-error').hide();
        var file = this.files[0];
      
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#section32_image-error').show().text("Please provide a Valid Extension Section Image(e.g: .jpg .png)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#section32_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#section32_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#section33_image').change(function(){
        
        $('#section33_image-error').hide();
        var file = this.files[0];
      
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#section33_image-error').show().text("Please provide a Valid Extension Section Image(e.g: .jpg .png)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#section33_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#section33_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#section51_image').change(function(){
        
        $('#section51_image-error').hide();
        var file = this.files[0];
      
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#section51_image-error').show().text("Please provide a Valid Extension Section Image(e.g: .jpg .png)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#section51_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#section51_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#section52_image').change(function(){
        
        $('#section52_image-error').hide();
        var file = this.files[0];
      
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#section52_image-error').show().text("Please provide a Valid Extension Section Image(e.g: .jpg .png)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#section52_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#section52_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#section53_image').change(function(){
        
        $('#section53_image-error').hide();
        var file = this.files[0];
      
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#section53_image-error').show().text("Please provide a Valid Extension Section Image(e.g: .jpg .png)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#section53_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#section53_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });


    

    function removeuploadedimg(divId ,inputId, imgName){
        if(confirm("Are you sure you want to remove this file?")){
            $("#"+divId).remove();
            $("#"+inputId).removeAttr('value');
            var filerKit = $("#catIconFiles").prop("jFiler");
            filerKit.reset();
        }
    }



    $('body').on('click', '#Add', function(){    
      var html = '';
      html += '<div class="row col-lg-12"><div class="col-lg-2 ">'+
        '<div class="form-group ">'+
        '<input type="file" class="form-control-file" id="image" onchange="" name="image[]">'+
        '</div>'+
        '</div>'+
        '<div class="col-lg-4 ">'+
        '<div class="form-group">'+
       
        '<input type="text" class="form-control input-flat" id="subtitle" name="subtitle[]">'+
        '<div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>'+
        '</div>'+
        '</div>'+
        '<div class="col-lg-4 ">'+
        '<div class="form-group">'+
        '<select  name="category_id[]" class="form-control category_id">'+
        '<option value="">Select Category</option>'+
        '@foreach($categories as $category)'+
        '<option value="{{ $category["id"] }}">{{ $category["category_name"] }}</option>'+
        '@endforeach'+
        '</select>'+
        '</div>'+
        '</div>'+
        '<div class="col-md-2">'+
            '<button type="button"  class="minus_btn btn mb-1 btn-outline-danger" ><i class="fa fa-remove"></i></button>'+
        '</div>'+
        '</div></div>';
               
        $(".add-value").append(html);
        $('.category_id').select2({
            width: '100%',
            placeholder: "Select Category",
            allowClear: false
        });
    });

    

    $('body').on('click', '.minus_btn', function(){
        var tthis = $(this).parent().parent();
        var ddd = tthis.remove()
    });

    $('#select_product_id').select2({
        width: '100%',
        placeholder: "Select Product",
        allowClear: true
    });


    
</script>
<!-- settings JS end -->
@endsection
