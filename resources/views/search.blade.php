@extends('layout')


@section('style')
<link rel='stylesheet' href="{{ asset('css/search.css') }}">
@endsection

@section('script')
<script src="js/search.js" defer> </script>
@endsection


@section('header_content')
What are you looking for?
@endsection


@section('main_content')
<article> 
      <form id="form_imagine" name="nuovopost" method="post" enctype="multipart/form-data" autocomplete="off" action="{{ route('search_immagine') }}">
      <p class="big_title"> Get inspired by the great masters, search a work of art!</p>
      <input type="image" src="https://www.materialui.co/materialIcons/action/search_white_192x192.png" class="search_img">
      <input type="text" class="search" name="ricerca">
      @csrf
      </form>
        <div id="opere" class="contents">
        
        </div>
        <form id="form_music" enctype="multipart/form-data" autocomplete="off" action="{{ route('search_spotify') }}">
          <p class="big_title"> Listen to music for ispiration!</p>
          <input type="image" src="https://www.materialui.co/materialIcons/action/search_white_192x192.png" class="search_img">
          <input type="text" class="search" name="q">
          @csrf
          </form>
          <div id="album" class="contents">
        
          </div>

          <form id="form_users" enctype="multipart/form-data" autocomplete="off" action="{{ route('search_utente') }}">
          <p class="big_title">Artists who are part of our community</p>
          <input type="image" src="https://www.materialui.co/materialIcons/action/search_white_192x192.png" class="search_img">
          <input type="text" class="search" name="username">
          @csrf
          </form>
          <div id="users" class="contents">
        
          </div>
     
    </article>

    <div id="modale" class="hidden">

    </div>
@endsection