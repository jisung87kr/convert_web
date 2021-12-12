@extends('layouts.convert')

@section('content')
<div class="row">
    <h1>{{$data['title']}}</h1>
    <form action="{{route('convert.process', $data['type'])}}" class="row" method="POST" target="_blank" enctype="multipart/form-data">
        @csrf
        <div class="col-7">
            <input type="file" class="form-control" name="source" placeholder="http://example.com">
        </div>
        <div class="col-1 text-center"> 파일을 </div>
        <div class="col-2">
            <select name="ext" id="" class="form-select">
                <option value="jpg">jpg</option>
                <option value="png">png</option>
                <option value="pdf">pdf</option>
                <option value="tiff">tiff</option>
            </select>
        </div>
        <div class="col-2">
            <input type="submit" class="btn btn-primary" value="변환하기">
        </div>
    </form>
</div>
@endsection