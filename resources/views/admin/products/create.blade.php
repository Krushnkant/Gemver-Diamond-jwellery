@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Product</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">

        <div id="attr-cover-spin" class="cover-spin"></div>
        <form method="post" id="ProductForm" action="">
        {{ csrf_field() }}
        <input type="hidden" id="action" name="action" value="addProduct">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <h4 class="card-title">Add Product</h4>
                            </div>
                        </div>

                        <input type="hidden" id="categoryIds" name="categoryIds">
                        <input type="hidden" id="childCategoryId" name="childCategoryId">
                        <input type="hidden" id="attrid_for_variation" name="attrid_for_variation">
                        <input type="hidden" id="attr_term_ids" name="attr_term_ids">
                        <input type="hidden" id="term_no" name="term_no" value="0">
                        <div class="product-section">
                            <div class="col-sm-12">

                    
                                <div class="form-group row">
                                    <label class="col-lg-12 col-form-label" for="carame">Category <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <nav class="navbar navbar-expand-md categorydrops">
                                            <div class="collapse navbar-collapse categoryDropDown" id="navbarNavDropdown">
                                                <ul class="navbar-nav categoryTitleBox bg-light">
                                                    <li class="nav-item dropdown CatDisabMenuLink">

                                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Categories
                                                        </a>

                                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="position: absolute;">
                                                            <?php
                                                            foreach($catArray as $cat){
                                                            ?>
                                                            <li>
                                                                
                                                                <a class="dropdown-item last-child" href="javascript:void(0)" data-val="<?php echo $cat['id']; ?>" data-title="<?php echo $cat['category_name']; ?>" parent-cat="<?php echo $cat['id']; ?>" ><?php echo $cat['category_name']; ?></a>
                                                                
                                                            </li>
                                                            <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <input type="text" class="form-control input-default" name="CategorySel" readonly="" id="CategorySel" value="">
                                        </nav>
                                        <div id="category-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-12 col-form-label" for="ProductName">Product Title <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control input-default ProductName" id="ProductName" name="ProductName" value="" >
                                        <label id="ProductName-error" class="error invalid-feedback animated fadeInDown" for="ProductName"></label>
                                    </div>
                                </div>

                                <!-- <div class="row form-group">
                                    <label class="col-lg-12 col-form-label" for="hsnCode">HSN Code</label>
                                    <div class="col-lg-12 ml-3">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control input-default" id="hsnCode" name="hsnCode" value="">
                                                <div id="hsnCode-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                            </div>
                                            <div id="AttrVariationBox" class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ml-2">
                                                <div class="basic-dropdown" style="display: none">
                                                    <div class="dropdown">
                                                        <button type="button" type="button" class="btn btn-grey dropdown-toggle" data-toggle="dropdown" id="AttrVariationBtn"></button>
                                                        <div class="dropdown-menu">
                                                            <div class="form-group p-2 mb-0">
                                                                <div class="col-sm-12">
                                                                    <div class="dropAttrTermDiv" id="AttrTermDiv">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="variationAttrsVal-error" class="invalid-feedback animated fadeInDown" style="display: none"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                

                                <div class="row form-group">
                                    <label class="col-lg-12 col-form-label" for="Desc">Description</label>
                                    <div class="col-lg-12">
                                        <textarea type="text" class="form-control input-default" id="desc" name="desc"></textarea>
                                        <div id="desc-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                    <label class="form-check-label">
                                                    <input type="checkbox" name="is_custom" id="is_custom" class="form-check-input primaryBox" value="0">Do you want to add custom product?</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Note</h4>
                        <textarea class="form-control input-default" name="notes" id="notes" rows="7"></textarea>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <button class="AddBox btn btn-primary" id="AddBox" style="display: none"> Add Box</button>
        <div class="row">
            <div class="col-md-12">
                <div class="card variantCard" id="variantProductBox" style="display: none;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" id="copyAppBtn" class="form-check-input primaryBox" value="0">Do you want to copy all values from First Variation Box to All Other Variation Box?</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-group col-md-12">
                            <div class="row variation-box" id="variant-data">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="saveBtn-box">
            <div class="col-md-12">
                <div class="card" id="">
                    <div class="card-body newcard-body row">
                        <div class="col-lg-6 col-sm-6">
                            <button type="button" id="SubmitProductBtn" name="SubmitProductBtn" class="btn btn-primary mr-2">Submit Product <i class="fa fa-circle-o-notch fa-spin submitloader" style="display:none;"></i></button>
{{--                            <button type="button" id="saveDraftBtn" name="saveDraftBtn" class="btn btn-outline-primary">Save As Draft <i class="fa fa-circle-o-notch fa-spin draftloader" style="display:none;"></i></button>--}}
                        </div>
                        <div class="col-lg-6 col-sm-6 text-right">
{{--                            <button type="button" id="discardBtn" name="discardBtn" class="btn btn-outline-primary" onclick="discardCatalog()">Discard <i class="fa fa-circle-o-notch fa-spin discardLoader" style="display:none;"></i></button>--}}
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div id="form-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')
    @include('admin.products.product_js')
@endsection
