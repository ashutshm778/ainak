@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Lens List</li>
                        </ol>
                    </div>
                        <div class="col-sm-6">
                            <a href="{{ route('admin.lens.create').'?key='.$search.'&page='.$list->currentPage() }}" class="btn btn-success float-right"> Add Lens <i class="fas fa-plus"></i></a>
                        </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">Lens List</h3>
                                <div class="card-tools">
                                    <form action="{{route('admin.lens.index')}}">
                                        <div class="input-group input-group-sm" style="width: 200px;">
                                            <input type="text" name="key" value="{{$search}}" class="form-control float-right" placeholder="Search">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-2">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 14%;">#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Power Type</th>
                                            <th class="text-center">Icon</th>
                                            <th class="text-center">Is Active</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($list as $key=>$data)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                                                <td class="text-center">{{$data->name}}</td>
                                                <td class="text-center">{{$data->power_type}}</td>
                                                <td class="text-center"><img src="{{asset('public/'.api_asset($data->icon))}}" style="height:100px;"></td>
                                                <td class="text-center">
                                                    @if($data->is_active)
                                                        <a href="{{route('admin.lens.show',$data->id).'?is_active=0&key='.$search.'&page='.$list->currentPage()}}" onclick="return confirm('Are you sure you want to deactive this Lens?');"><span class="badge bg-success">Actived</span></a>
                                                    @else
                                                        <a href="{{route('admin.lens.show',$data->id).'?is_active=1&key='.$search.'&page='.$list->currentPage()}}" onclick="return confirm('Are you sure you want to active this Lens?');"><span class="badge bg-danger">Deactived</span></a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('admin.lens.edit',$data->id).'?key='.$search.'&page='.$list->currentPage()}}" class="btn btn-outline-primary btn-sm mr-1 mb-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    {{-- <a href="{{route('admin.lens.destroy',$data->id).'?key='.$search.'&page='.$list->currentPage()}}" onclick="return confirm('Are you sure you want to delete this brand?');"  class="btn btn-outline-danger btn-sm mb-1" style="width:32px;">
                                                        <i class="fas fa-trash"></i>
                                                    </a> --}}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="footable-empty">
                                                <td colspan="11">
                                                <center style="padding: 70px;"><i class="far fa-frown" style="font-size: 100px;"></i><br><h2>Nothing Found</h2></center>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    {!! $list->appends(['key'=>$search])->links() !!}
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
