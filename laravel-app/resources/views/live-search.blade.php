@extends('layout')

@section('title')
    Живой поиск
@endsection

@section('main_content')
    <h1>Живой поиск</h1>


    <form id="liveSearchForm" method="POST" action="{{ route('live-search') }}" class="inline-flex gap-4 mt-10 mb-10"
        role="search">
        @csrf <!-- CSRF токен необходим для всех POST запросов в Laravel -->
        <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search"
            id="searchInput" name="s2">
        <!-- Кнопку можно убрать или оставить скрытой, если она не используется -->
    </form>
    <div id="searchResults"></div>



    @foreach ($users as $user)
        <p>Имя пользователя: {{ $user->name }} </p>
    @endforeach
@endsection
