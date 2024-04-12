@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">
                                @isset($page_title)
                                    {{$page_title}}
                                @endisset
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-info">
                            <div class="card-body table-responsive p-2" id="table">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Address</th>
                                            <th class="text-center">Left Lense Detail</th>
                                            <th class="text-center">Right Lense Detail</th>
                                            <th class="text-center">File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($repair_glass_enquiry as $key=>$data)
                                            <tr>
                                                <td class="text-center">{{($key+1) + ($repair_glass_enquiry->currentPage() - 1)*$repair_glass_enquiry->perPage()}}</td>
                                                <td class="text-center">{{$data->name}}</td>
                                                <td class="text-center">
                                                  House No :  {{$data->house_no}}<br>
                                                  Pincode  :  {{$data->pincode}}<br>
                                                  District :  {{$data->district}}<br>
                                                  State :  {{$data->state}}<br>
                                                  Landmark :  {{$data->landmark}}<br>
                                                </td>
                                                <td class="text-center">
                                                 Lense :   {{$data->left_eye_lense}}<br>
                                                 Power :   {{$data->power_left}}<br>
                                                </td>
                                                <td class="text-center">
                                                    Lense :   {{$data->right_eye_lense}}<br>
                                                    Power :   {{$data->power_right}}<br>
                                                   </td>
                                                <td class="text-center"><img src="{{asset('public/public/repair_glass/'.$data->file)}}" style="height:100px;"></td>
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
                                {{$repair_glass_enquiry->links()}}
                                <hr>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>

function is_active(id)
    {
        var value=$('#is_active_'+id).prop("checked");
        var id=$('#is_active_'+id).val();

        if(value)
        {
            var value = 1;
        }
        else
        {
            var value = 0;
        }

        $.ajax({
            type: 'GET',
            url: "{{route('admin.review.status.update',['',''])}}/"+id+'/'+value+'?type=is_active',
            success: function(data) {
                if(value)
                {
                    toastr.success('Review Activeted Successfully!')
                }
                else
                {
                    toastr.error('Review Deactiveted Successfully!')
                }
            }
        });
    } 

    </script>

@endsection
