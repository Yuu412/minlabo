@if($i == 0)
{{-- begin:人気エリアの表示 --}}

    @foreach($pre_images as $pre_image)
      @if($pre_image->pre_name == $pre_name)
        <img src="{{ asset('img/pre_image/' .$pre_image->pre_image) }}" alt="{{ $pre_image->pre_name }}" width="75" height="75">
      @endif
    @endforeach
      <a class="nav-link" href="{{ url('area/'.$pre_name) }}">{{ $pre_name }}</a>
{{-- end:人気エリアの表示 --}}

@else
{{-- begin:全国各エリアの表示 --}}
  <div class="d-flex flex-row" style="padding:20px 0; padding-left:0px;">
    <h3>{{ $loc_array[$i] }}</h3>
    @foreach($pre_array[$i] as $pre_name)
        <a class="nav-link" href="{{ url('area/'.$pre_name) }}">{{ $pre_name }}</a>
    @endforeach
  </div>
{{-- end:全国各エリアの表示 --}}
@endif
