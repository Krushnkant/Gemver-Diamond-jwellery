<!-- 


    <div class="container mt-5 text-center">
        <h2 class="mb-4">
            Import Export Excel & CSV File 
        </h2>

            @csrf
            <div class="form-group mb-4">
                <div class="custom-file text-left">
                    <input type="file" name="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <button class="btn btn-primary">Import Users</button>
            
        </form>
    </div> -->



    <form class="form-valide" action="" id="DiamondCreateForm" method="post" enctype="multipart/form-data">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 container justify-content-center">
    
    <div class="form-group">
        <input type="file" name="file" class="custom-file-input" id="customFile">
        <label class="custom-file-label" for="customFile">Choose file</label>
        <div id="file-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

     <button type="button" class="btn btn-outline-primary" id="save_newDiamondBtn" data-action="add">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
     <button type="button" class="btn btn-primary" id="save_closeDiamondBtn" data-action="add">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>

    </div>
</form>




