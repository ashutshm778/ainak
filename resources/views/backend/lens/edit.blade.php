@extends('backend.include.header')
@section('content')

<style>
    .cat_div
    {
        background: #f7f7f7;
        padding: 15px;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        margin: 0px 0 10px;
    }
    .brdr {
    border: 1px solid #ddd;
}
.slide-container .slide-content.sidebar-featureList li.featureList {
    font-weight: var(--font-bold);
    font-size: 14px;
    line-height: 17px;
    color: #5b5b5b;
}
.slide-container .slide-content li.featureList {
    position: relative;
    font-size: 13px;
    line-height: 13px;
}
.slide-container .slide-content li.featureList {
    border-top: 1px solid #f0f0f0;
    height: 40px;
    padding: 2px 10px;
    padding-right: 2px;
    display: -webkit-box!important;
    display: -ms-flexbox!important;
    display: flex!important;
    align-items: center;
}
</style>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.lens.index')}}">Edit Lens</a></li>
                            <li class="breadcrumb-item active">Edit Lens</li>
                        </ol>
                    </div>
                    <div class="col-sm-6"></div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-info">
                            <div class="card-body p-0">
                                <div class="modal-body">
                                    <form action="{{route('admin.lens.update',$lens->id)}}" method="POST" class="form-example">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="key" value="{{$key}}">
                                        <input type="hidden" name="page" value="{{$page}}">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="name">Power Type</label>
                                                        <select name="power_type" id="power_type" class="form-control" data-placeholder="Select Power Type"  required>
                                                                <option value="">Select Power Type</option>
                                                                <option value="Single Vision/Powered Eyeglasses" @if($lens->power_type=='Single Vision/Powered Eyeglasses') selected @endif>Single Vision/Powered Eyeglasses</option>
                                                                <option value="Zero Power Eyeglasses" @if($lens->power_type=='Zero Power Eyeglasses') selected @endif>Zero Power Eyeglasses</option>
                                                                <option value="Bifocal/Progressive Eyeglasses" @if($lens->power_type=='Bifocal/Progressive Eyeglasses') selected @endif>Bifocal/Progressive Eyeglasses</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="name">Lens Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name..." value="{{$lens->name}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="name">Price</label>
                                                        <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price..." value="{{$lens->price}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="name">Discount %</label>
                                                        <input type="text" class="form-control" id="discount" name="discount" placeholder="Enter Discount Percentage..." value="{{$lens->discount}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Icon</label>
                                                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                                            <div class="form-control file-amount">Choose Icon</div>
                                                            <input type="hidden" name="icon" class="selected-files" value="{{$lens->icon}}">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                            </div>
                                                        </div>
                                                        <div class="file-preview box sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 brdr mb-3"></div>
                                                <div class="col-md-3 brdr mb-3">
                                                    <div class="slide-container">
                                                        <div class="slide-content sidebar-featureList">
                                                            <li class="featureList">
                                                                <img width="20" class="feature-icon" src="http://localhost/ainak/public/frontend/assets/images/lense-Warranty.svg" alt="Lens Warranty">
                                                                Warranty Period
                                                            </li>
                                                            <li class="featureList">
                                                                <img width="20" class="feature-icon" src="http://localhost/ainak/public/frontend/assets/images/lense-index.svg" alt="Lenses">
                                                                Index/Thickness
                                                            </li>
                                                            <li class="featureList powerElemLi">
                                                                <img width="20" class="feature-icon" src="http://localhost/ainak/public/frontend/assets/images/lense-power.svg" alt="Lenses">
                                                                Power Range
                                                            </li>
                                                            <div class="staticFeature">
                                                                <li class="active featureList Blue Light Blocker">
                                                                    <img width="20" class="feature-icon" src="http://localhost/ainak/public/frontend/assets/images/blue-light-blocker.svg" alt="blue-light-blocker">
                                                                    <div class="icon-test-wrap"><span class="featrName">Blue Light
                                                                            Blocker</span>
                                                                    </div>
                                                                </li>
                                                                <li class="active featureList Anti Scratch Coating">
                                                                    <img width="20" class="feature-icon" src="http://localhost/ainak/public/frontend/assets/images/anti-scratch-coating.svg" alt="anti-scratch-coating">
                                                                    <div class="icon-test-wrap"><span class="featrName">Anti
                                                                            Scratch Coating</span>
                                                                    </div>
                                                                </li>
                                                                <li class="active featureList Both Side Anti Glare Coating">
                                                                    <img width="20" class="feature-icon" src="http://localhost/ainak/public/frontend/assets/images/both-side-anti-glare-coating.svg" alt="both-side-anti-glare-coating">
                                                                    <div class="icon-test-wrap"><span class="featrName">Both Side
                                                                            Anti Glare Coating</span>
                                                                    </div>
                                                                </li>
                                                                <li class="active featureList Both Side Anti Reflective Coating">
                                                                    <img width="20" class="feature-icon" src="http://localhost/ainak/public/frontend/assets/images/both-side-anti-reflective-coating.svg" alt="both-side-anti-reflective-coating">
                                                                    <div class="icon-test-wrap"><span class="featrName">Both Side
                                                                            Anti Reflective Coating</span>
                                                                    </div>
                                                                </li>
                                                                <li class="active featureList UV Protection">
                                                                    <img width="20" class="feature-icon" src="http://localhost/ainak/public/frontend/assets/images/uv-protection.svg" alt="uv-protection">
                                                                    <div class="icon-test-wrap"><span class="featrName">UV
                                                                            Protection</span>
                                                                    </div>
                                                                </li>
                                                                <li class="active featureList Water and Dust Repellent">
                                                                    <img width="20" class="feature-icon" src="http://localhost/ainak/public/frontend/assets/images/water-and-dust-repellent.svg" alt="water-and-dust-repellent">
                                                                    <div class="icon-test-wrap"><span class="featrName">Water and
                                                                            Dust Repellent</span>
                                                                    </div>
                                                                </li>
                                                                <li class="active featureList Breakage &amp; Crack Resistant">
                                                                    <img width="20" class="feature-icon" src="http://localhost/ainak/public/frontend/assets/images/breakage--crack-resistant.svg" alt="breakage--crack-resistant">
                                                                    <div class="icon-test-wrap"><span class="featrName">Breakage
                                                                            &amp; Crack Resistant</span>
                                                                    </div>
                                                                </li>
                                                            </div>
                                                        </div>
                                                        <a class="know-more-coating" style="display: none;" onclick="openCoatingInfo()">Know More About
                                                            Coatings</a>
                                                        <h3 class="lens_origin_country" style="display: none;">Manufactured in
                                                            India</h3>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 brdr mb-3">
                                                    <div class="slide-container">
                                                        <div class="slide-content column-featureList">
                                                            <li class="featureList"> <input type="text" class="form-control" id="warranty_period" name="warranty_period" placeholder="Enter Warranty Period In Month..." value="{{$lens->warranty_period}}" required></li>
                                                            <li class="featureList"> <input type="text" class="form-control" id="thickeness" name="thickeness" placeholder="Enter Thickeness..." value="{{$lens->thickeness}}" required></li>
                                                            <li class="featureList"> <input type="text" class="form-control" id="power_range" name="power_range" placeholder="Enter Power Range..." value="{{$lens->power_range}}" required></li>
                                                            <li class="featureList">
                                                                 <input type="checkbox" class="form-control" id="blue_light_blocker" name="blue_light_blocker" @if($lens->blue_light_blocker==1) checked @endif value="1">
                                                            </li>
                                                            <li class="featureList"> <input type="checkbox" class="form-control" id="anit_scratch_coating" name="anit_scratch_coating" @if($lens->anit_scratch_coating==1) checked @endif value="1"></li>
                                                            <li class="featureList"> <input type="checkbox" class="form-control" id="b_anti_glare_coating" name="b_anti_glare_coating" @if($lens->b_anti_glare_coating==1) checked @endif value="1"></li>
                                                            <li class="featureList"> <input type="checkbox" class="form-control" id="b_anti_reflective_coating" name="b_anti_reflective_coating" @if($lens->b_anti_reflective_coating==1) checked @endif value="1"></li>
                                                            <li class="featureList"> <input type="checkbox" class="form-control" id="uv_protection" name="uv_protection" @if($lens->uv_protection==1) checked @endif value="1"></li>
                                                            <li class="featureList"> <input type="checkbox" class="form-control" id="water_dust_replellent" name="water_dust_replellent" @if($lens->water_dust_replellent==1) checked @endif value="1"></li>
                                                            <li class="featureList"> <input type="checkbox" class="form-control" id="brekage_crack_resistance" name="brekage_crack_resistance" @if($lens->brekage_crack_resistance==1) checked @endif value="1"></li>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 brdr mb-3"></div>

                                            </div>
                                           
                                        </div>
                                        <div class="card-footer text-center">
                                            <button type="submit" class="btn btn-outline-success mt-1 mb-1" onclick="return confirm('Are you sure you want to Save this Lens?');"><i class="fa fa-check" aria-hidden="true"></i> Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

<script>

  
</script>
