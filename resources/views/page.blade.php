@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!!html_entity_decode($page->body)!!}
            </div>
        </div>
    </div>
@endsection