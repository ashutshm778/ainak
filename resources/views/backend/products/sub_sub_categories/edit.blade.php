@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.sub-sub-categories.index')}}">SubSubCategory List</a></li>
                            <li class="breadcrumb-item active">Edit SubSubCategory</li>
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
                                    <form action="{{route('admin.sub-sub-categories.update',$subSubCategory->id)}}" method="POST" class="form-example">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="key" value="{{$key}}">
                                        <input type="hidden" name="search_category_id" value="{{$search_category}}">
                                        <input type="hidden" name="search_subcategory_id" value="{{$search_subcategory}}">
                                        <input type="hidden" name="page" value="{{$page}}">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{$subSubCategory->name}}" placeholder="Enter Name..." required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="category_id">Category</label>
                                                        <select name="category_id[]" id="category_id" class="form-control select2" data-placeholder="Select Category" multiple required onchange="get_sub_categories()">
                                                            @foreach (App\Models\Admin\Category::orderBy('priority','asc')->get() as $category)
                                                                <option value="{{$category->id}}" @if(in_array($category->id,$subSubCategory->category_id)) selected @endif>{{$category->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="sub_category_id">SubCategory</label>
                                                        <select name="subcategory_id[]" id="subcategory_id" class="form-control select2" data-placeholder="Select Category" multiple required></select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea class="form-control summernote" name="description">{!!$subSubCategory->descrption!!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="meta_name">Meta Name</label>
                                                        <input type="text" class="form-control" id="meta_name" name="meta_name" value="{{$subSubCategory->meta_name}}" placeholder="Enter Meta Name...">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="meta_description">Meta Description</label>
                                                        <textarea class="form-control summernote" name="meta_description">{!!$subSubCategory->meta_descrption!!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <button type="submit" class="btn btn-outline-success mt-1 mb-1" onclick="return confirm('Are you sure you want to Save this suubsubcategory?');"><i class="fa fa-check" aria-hidden="true"></i> Update</button>
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

<script src="{{ asset('public/dashboard_css/plugins/jquery/jquery.min.js') }}"></script>
<script>

    $(setTimeout(function () {get_sub_categories()}, 200));
    function get_sub_categories()
    {
        var sub_cat="{{implode(',',$subSubCategory->subcategory_id)}}";
        var category_ids=$('#category_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{route('admin.get.sub.categories.by.category')}}",
            data:{
                category_ids:category_ids
            },
            success: function(data) {
                console.log(data);
                $('#subcategory_id').empty();
                $.each(data, function(key, val) {
                    test= sub_cat.includes(''+val.id);
                    $('#subcategory_id').append('<option value="'+ val.id +'" '+(test ? "selected" : "")+'  >'+ val.name +'</option>');
                });
            }
        });
    }

</script>
