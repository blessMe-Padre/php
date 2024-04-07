@extends('layout')

@section('title')
    {{ $data->name }}
@endsection

@section('main_content')
    <h1>Редактировать отзыв</h1>
    <br>
    <hr>
    <form method="POST" action="{{ route('review-edit-submit', $data->id) }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" value="{{ $data->name }}" name="name" class="form-control" id="name"
                placeholder="Введите ваше имя">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email адрес</label>
            <input type="email" value="{{ $data->email }}" name="email" class="form-control" id="email"
                placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Сообщение</label>
            <textarea class="form-control" name="massage" id="massage" rows="3">{{ $data->massage }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
@endsection
