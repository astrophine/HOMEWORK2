@extends('layout')


@section('style')
<link rel='stylesheet' href="{{ asset('css/gallery.css') }}">
@endsection

@section('script')
@if (isset($user) && !isset($isartista) )
<script src="js/gallery.js" defer> </script>
@else
<script src="js/galleryartist.js" defer> </script>
@endif
@endsection


@section('header_content')
EXHIBITIONS AND DISPLAYS
@endsection

@section('extra_routes')
const url_scaricaOpere="{{ route('create_scaricaOpere') }}";
const url_creaGalleria="{{ route('gallery_creaGalleria') }}";
const url_inizioAbbonamento="{{ route('gallery_inizioAbbonamento') }}";
const url_fineAbbonamento="{{ route('gallery_fineAbbonamento') }}";
const url_scaricaSale="{{ route('gallery_scaricaSale') }}";
const url_cercaSale="{{ route('gallery_cercaSale') }}";
const url_home="{{ route('home') }}";





@endsection

@section('main_content')
@if (isset($user) && isset($isartista) )
      <p>Do you want to create a new gallery?</p>
      <div id="contenuti" class="contents"></div>
@else
   
    <img src="https://www.materialui.co/materialIcons/action/search_white_192x192.png" id="search_img" class="search_img">
    <input type="text" id="search" class="search">

      <p class="big_title">THESE ARE OUR FREE EXHIBITIONS AND DISPLAYS:</p>
      <div id="sale" class="contents">
      </div>

@endif
@endsection