@extends('layout')

@section('style')
<link rel='stylesheet' href="{{ asset('css/home.css') }}">
@endsection

@section('extra_routes')
const url_scaricaOpereSala="{{ route('home_scaricaOpereSala') }}";
const url_inserimentovalutazione="{{ route('home_inserimentovalutazione') }}";

@endsection

@section('script')
@if (isset($user) && !isset($isartista) )
<script src="js/home.js" defer> </script>
@endif
@endsection

@section('header_content')
<em>Recent events have made us lose the pleasure of immersing ourselves in art.</em><br />
Now you can do it from home in complete safety.<br />
@if (!isset($user))
<a href="{{ route('login') }}">Let's get started</a>
@endif
@endsection


@if (isset($user) && !isset($isartista) && isset($sala) )
@section('body_data')
data-sala={{$sala}}
@endsection
@endif



@section('main_content')

@if (!isset($user) || isset($isartista) )
    <section>
        <div id="main">
            <h1>WELCOME TO SANAT!</h1>
            <p>
                Here is the first online art gallery where artists can show their works without the limit of today's restrictions due to Covid-19.
            </p>
        </div>

        <div id="details">
            <div id="flex-container-sculpture">
                <img src="{{ asset('img/immagine.jpg') }}" />

                <h1>Sculpture:</h1><br />
                <p>is the branch of the visual arts that operates in three dimensions. It is one of the plastic arts.<br />
                    Durable sculptural processes originally used carving (the removal of material) <br />
                    and modelling (the addition of material, as clay), in stone, metal, ceramics, wood and other materials. <br />
                </p>

            </div>
            <div id="flex-container-painting">
                <img src="{{ asset('img/immagine3.jpg') }}" />

                <h1>Painting:</h1>
                <p>is the practice of applying paint, pigment, color or other medium to a solid.</p>

            </div>
            <div id="flex-container-architecture">
                <img src="{{ asset('img/immagine5.jpg') }}" />

                <h1>Architecture:</h1>
                <p>(Latin architectura, from the Greek ἀρχιτέκτων arkhitekton "architect", from ἀρχι- "chief" and τέκτων "creator")<br />
                    is both the process and the product of planning, designing, and constructing buildings or other structures.<br />
                    Architectural works, in the material form of buildings, are often perceived as cultural symbols and as works of art.</br></p>

            </div>
        </div>
    </section>
@else
    <section>

        <div id="container">

        </div>
    </section>
@endif

@endsection

@if(isset($sala))
@section('body_data')
data-sala="{{ $sala }}
@endsection
@endif