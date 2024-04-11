@extends('layout')

@section('title')
    Отзывы
@endsection

@section('main_content')
    <h1>Отзывы</h1>

    <hr>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <br>

    <h2>Форма добавления отзыва</h2>
    <form method="POST" action="/reviews/check">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Введите ваше имя">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email адрес</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Сообщение</label>
            <textarea class="form-control" name="massage" id="massage" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Отправить отзывы</button>
    </form>

    <br>
    <hr>
    <h2>Все отзывы</h2>

    <form method="GET" action="{{ route('search') }}" class="inline-flex gap-4 mt-10 mb-10" role="search">
        <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..."
            aria-label="Search" id="s" name="s">
        <button type="submit" class="btn btn-success">Поиск</button>
    </form>

    <br>
    <div class="grid grid-cols-3 gap-6">
        @if ($reviews)
            @foreach ($reviews as $el)
                <div class="alert alert-warning">
                    <h3>{{ $el->name }}</h3>
                    <p>{{ $el->email }}</p>
                    <p>{{ $el->massage }}</p>

                    <a href="{{ route('review-one', $el->id) }}" class="btn btn-success">Подробнее</a>
                </div>
            @endforeach
            <div class="p-7">
                {{ $reviews->links() }}
            </div>
        @else
            ничего не найдено
        @endif
    </div>

@endsection
