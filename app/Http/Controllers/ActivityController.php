<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index()
    {
        $members = User::where('id', '!=', 1)->where('status', '!=', 'inactive')->get();
        $book    = Book::all();

        return view('v_activity/activity', ['listMembers' => $members, 'listBooks' => $book]);
    }

    public function store(Request $request)
    {
        $trx_code = Str::random(6);
        $result_trxcd = strtoupper($trx_code);

        $request['rent_date']   = Carbon::now()->toDateString();
        $request['return_date'] = Carbon::now()->addDay(3)->toDateString();
        $request['trx_code'] = $result_trxcd;
        
        $book = Book::findOrFail($request->book_id)->only('status');

        if ($book['status'] != 'in stock') {
            Session::flash('status', 'failed');
            Session::flash('message', 'Buku Sedang Tidak Tersedia');
            return redirect('/activity');
        }else{
            $count = Activity::where('user_id', $request->user_id)->where('actual_return_date', null)->count();
            if ($count >= 2) {
                Session::flash('status', 'failed');
                Session::flash('message', 'Peminjaman Buku Gagal, Member Telah Mencapai Limit Peminjaman Buku');
                return redirect('/activity');
            }

            try {
                DB::beginTransaction();
                Activity::create($request->all());

                $book = Book::findOrFail($request->book_id);
                $book->status = 'out of stock';
                $book->save();
                DB::commit();

                Session::flash('status', 'success');
                Session::flash('message', 'Peminjaman Buku Berhasil');
                return redirect('/activity');    
            } catch (\Throwable $th) {
                DB::rollBack();
                dd($th);
            }
        }
        return redirect('/activity');
    }

    public function return()
    {
        $user = Auth::user();
        $book = Activity::with('book')->where('user_id', $user->id)->get();

        return view('v_activity/return', ['user' => $user, 'listBooks' => $book]);
    }

    public function returnProses(Request $request)
    {
        $user = Auth::user();
        $dataRent = Activity::where('user_id', $user->id)->where('book_id', $request->book_id)->where('actual_return_date', null);
        $getData  = $dataRent->first();
        $count    = $dataRent->count();

        if ($count == 1) {
            $getData->actual_return_date = Carbon::now()->toDateString();
            $getData->save();

            Session::flash('status', 'success');
            Session::flash('message', 'Pengembalian Buku Berhasil');
            return redirect('/return');
        } else {
            Session::flash('status', 'failed');
            Session::flash('message', 'Pengembalian Buku Gagal');
            return redirect('/return');
        }
    }
}
