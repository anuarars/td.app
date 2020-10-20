@extends('layouts.app')

@section('content')
    <div class="body">
        <div class="veen" style="background-color: transparent;box-shadow:none;">
            <div class="wrapper" style="width: 100%;top: -20%;left: 0;">
                @include('includes.alerts')
                <form method="POST" action="{{route('address.store', Auth::id())}}" id="login" tabindex="500" style="padding-top:0;">
                    @csrf
                    <h3>Контактные данные</h3>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <select name="region_id" style="height: 40px;padding: 5px 15px;width: 100%;border: solid 1px #999;">
                                @foreach ($regions as $region)
                                    <option value="{{$region->id}}">{{$region->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <input 
                                type="text" 
                                id="district" 
                                class="@error('district') is-invalid @enderror" 
                                name="district" 
                                required 
                                autocomplete="current-district"
                                placeholder="Район/Округ">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 mb-2">
                            <input 
                                type="text" 
                                id="town" 
                                class="@error('town') is-invalid @enderror" 
                                name="town" 
                                required 
                                autocomplete="current-home"
                                placeholder="Населенный пункт">
                        </div>
                        <div class="col-md-3 mb-2">
                            <input 
                                type="number" 
                                id="postcode" 
                                class="@error('postcode') is-invalid @enderror" 
                                name="postcode" 
                                required 
                                autocomplete="current-postcode"
                                placeholder="Индекс">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <input 
                                type="text" 
                                id="home" 
                                class="@error('home') is-invalid @enderror" 
                                name="home" 
                                required 
                                autocomplete="current-home"
                                placeholder="Здание">
                        </div>
                        <div class="col-md-6 mb-2">
                            <input 
                                type="text" 
                                id="street" 
                                class="@error('street') is-invalid @enderror" 
                                name="street" 
                                required 
                                autocomplete="current-street"
                                placeholder="Улица">
                        </div>
                        <div class="col-md-3 mb-2">
                            <input 
                                type="text" 
                                id="unit" 
                                class="@error('unit') is-invalid @enderror" 
                                name="unit" 
                                required 
                                autocomplete="current-unit"
                                placeholder="Офис">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <textarea name="description" placeholder="О Компании" style="height: 100px;"></textarea>
                        </div>
                    </div>
                    <div class="submit">
                        <button type="submit" class="dark">Подтвердить данные</button>
                    </div>
                </form>
            </div>
        </div>	
    </div>
@endsection