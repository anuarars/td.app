@foreach ($categories as $category)
    <option value="{{$category->id}}">
        {!! $delimiter !!}
        {{$category->name}}
    </option>
    @if (count($category->children)>0){
        @include('includes.categories',[
            'categories'=>$category->children,
            'delimiter'=> ' - '.$delimiter
        ])
    }
    @endif
@endforeach