<link href="{{ asset('css/com_radio_input_review.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/com_radio_input_review/com_radio_input_review.css') }}" rel="stylesheet" type="text/css">

{{--
<table width="0" cellspacing="0" cellpadding="5">
    <th class="left-block-rie">
      <label for="{{ $prof_item }}" class="control-label">{{ $key }}</label>
    </th>
    <th class="right-block-rie">
      @for ($val = 1; $val <= 5; $val++)
        @if($val == 3)
          <input type="radio" name="{{ $prof_item }}" value="{{ $val }}" checked>{{ $val }}
        @else
          <input type="radio" name="{{ $prof_item }}" value="{{ $val }}">{{ $val }}
        @endif
      @endfor
    </th>
</table>
--}}

<div class="rie">
  <div class="flex-box-rie">
    <div class="flex-item-rie">
      {{$key}}
    </div>
    <div id="radios{{$count}}-{{$count_item}}" class="flex-item-rie">
      @for ($val = 1; $val <= 5; $val++)
        <label for="input{{$count}}-{{$count_item}}-{{$val}}"></label>
        @if($val == 3)
          <input id="input{{$count}}-{{$count_item}}-{{$val}}" name="{{ $prof_item }}" value="{{ $val }}" type="radio" checked />
        @else
          <input id="input{{$count}}-{{$count_item}}-{{$val}}" name="{{ $prof_item }}" value="{{ $val }}" type="radio" />
        @endif
      @endfor
      <span id="slider{{$count}}-{{$count_item}}"></span>
    </div>
  </div>
</div>
