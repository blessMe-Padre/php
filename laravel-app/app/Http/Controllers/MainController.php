<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ReviewsModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function main() {
        return view('welcome');
    }

    public function about() {
        return view('about');
    }

    public function reviews() {
        $reviews = new ReviewsModel();
        $reviews =  $reviews->paginate(6);

        return view('reviews', ['reviews' => $reviews]);
    }

    public function reviews_check(Request $request) {
        $valid = $request->validate([
            'name' => 'required | min:3',
            'massage' => 'required | min:10',
        ]);

        $review = new ReviewsModel();
        $review->name = $request->input('name');
        $review->email = $request->input('email');
        $review->massage = $request->input('massage');

        if (Auth::check()) { // Проверяем, авторизован ли пользователь
            $review->user_id = Auth::id(); // Получаем ID пользователя и присваиваем его свойству user_id
        } else {
            $review->user_id = 666; // Получаем ID пользователя и присваиваем его свойству user_id
        }

        $review->save();

        return redirect()->route('reviews')->with('success', 'Отзыв был успешно добавлен');
    }

    public function show_one_reviews($id) {
        $reviews = new ReviewsModel();
        return view('review', ['data' => $reviews->find($id)]);
    }

    public function review_edit($id) {
        $reviews = new ReviewsModel();
        return view('review-edit', ['data' => $reviews->find($id)]);
    }

    public function review_edit_submit($id, Request $request) {

        // TODO: создать собственный файл валидации
        // https://www.youtube.com/watch?v=-OIhxs8plMQ&list=PL0lO_mIqDDFX3vIw4mSilTVihgL98y3e4&index=4&ab_channel=%D0%93%D0%BE%D1%88%D0%B0%D0%94%D1%83%D0%B4%D0%B0%D1%80%D1%8C

        $valid = $request->validate([
            'name' => 'required | min:3',
            'massage' => 'required | min:10',
        ]);

        $review = ReviewsModel::find($id);
        $review->name = $request->input('name');
        $review->email = $request->input('email');
        $review->massage = $request->input('massage');

        $review->save();

        return redirect()->route('review-one', $id)->with('success', 'Отзыв был успешно изменен');
    }

    public function delete_review($id) {
        ReviewsModel::find($id)->delete();
        return redirect()->route('reviews');
    }

    public function search(Request $request) {
        $s = $request->input('s'); // Предполагаем, что 'search' - это имя параметра из запроса
        $reviews = ReviewsModel::where('name', 'like', "%{$s}%")->paginate(6);
        return view('reviews', ['reviews' => $reviews]);
    }

    // public function live_search(Request $request) {
    //     $users = new User();
    //     $users = $users->all();
    //     return view('live-search', ['users' => $users]);
    // }

    public function live_search(Request $request) {
        $query = $request->get('s2');
        $users = User::where('name', 'LIKE', "%{$query}%")->get();

        if ($request->ajax()) {
            return response()->json(view('partials.user_list', ['users' => $users])->render());
        } else {
            // Для не-AJAX запроса, если такие могут быть
            return view('live-search', ['users' => $users]);
        }
    }


}
