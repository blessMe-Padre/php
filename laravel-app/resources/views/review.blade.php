@extends('layout')

@section('title')
    {{ $data->name }}
@endsection

@section('main_content')
    <h1>Отзыв</h1>
    <br>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <br>
    <hr>
    <div class="row gap-5">
        <div class="alert alert-warning col">
            <h3>{{ $data->name }}</h3>
            <p>{{ $data->email }}</p>
            <p>{{ $data->massage }}</p>

            <a href="/reviews" class="btn btn-success">Назад</a>
            <a href="{{ route('review-edit', $data->id) }}" class="btn btn-success">Редактировать</a>
            <a href="{{ route('review-delete', $data->id) }}" class="btn btn-danger">Удалить</a>
        </div>
    </div>
@endsection
