<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $book     = Book::count();
        $category = Category::count();
        $user     = User::count();
        $rentlogs = Activity::with(['user', 'book'])->paginate(3);

        return view('v_admin/dashboard', ['totalBooks' => $book, 'totalCategories' => $category, 'totalUsers' => $user, 'listData' => $rentlogs]);
    }
}
