@extends('layouts.convert')

@section('content')
<div class="row">
    <h1>{{$data['title']}}</h1>
    <ul>
        <li><a href="{{route('convert.index', 'pdf')}}" class="col-4">PDF 변환</a></li>
        <li><a href="{{route('convert.index', 'image')}}" class="col-4">이미지 확장자 변환</a></li>
    </ul>
</div>
@endsection