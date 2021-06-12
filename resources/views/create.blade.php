@extends('layout')


@section('style')
<link rel='stylesheet' href="{{ asset('css/create.css') }}">
@endsection

@section('script')
<script src="js/create.js" defer> </script>
@endsection

@section('extra_routes')
const CATEGORIE = [{!! $categorie !!} ];
const url_scaricaOpere="{{ route('create_scaricaOpere') }}";
const url_postaOpere="{{ route('create_postaOpera') }}";
@endsection


@section('header_content')
Do you want to share with us your work of art?
@endsection


@section('main_content')

<div id="inserimento_opera">
    <button id=add_work>Click here!</button>

    <div id="modale" class="hidden">

    </div>

</div>
<h1>These are your works:</h1>
<div id="opere_utente" class="contents">

</div>
@endsection