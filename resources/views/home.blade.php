@extends('layouts.app')
@section('title')
    Tableau de Board
@endsection
@section('csspage')
@endsection
@section('dashactive')
    class= "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-tachometer"></i>
        </div>
        <div class="header-title">
            <h1> Tableau De Board</h1>
            <small> Votre Page D'accueil</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('home')}}">Tableau de Bord</a></li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
@endsection
@section('scriptpage')
@endsection
