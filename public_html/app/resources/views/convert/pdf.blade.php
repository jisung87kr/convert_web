@extends('layouts.convert')

@section('content')
<div class="row">
    <h1>{{$data['title']}}</h1>
    <form action="{{route('convert.process', $data['type'])}}" class="row" method="POST" target="_blank">
        @csrf
        <div class="col-10">
            <input type="text" class="form-control" name="source" placeholder="http://example.com">
        </div>
        <div class="col-2">
            <input type="submit" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection