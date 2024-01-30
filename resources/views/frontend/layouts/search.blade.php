<ul>
    @forelse ($list as $data)
        <li>
            <a href="{{ route('details',$data->slug) }}?type=product">
                <img src="{{ asset('public/vendor/images/products/'.$data->thumbnail_image) }}" onerror="this.onerror=null;this.src='{{asset('public/no-image.png')}}'">
                @if($data->variant_name)
                    {{$data->variant_name}}
                @else
                    {{$data->name}}
                @endif
            </a>
        </li>
    @empty
        <center> <img src="{{ asset('public/frontend/assets/images/no-data.png') }}"
            class="svg_img" style="width:60px; height:60px; margin-bottom:5px;"/> <br> No Data Found!</center>
    @endforelse
</ul>