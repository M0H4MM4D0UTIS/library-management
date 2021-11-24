<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lended;
use App\Models\Member;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;


class HomeApi extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->respondWithError("access deny ;)", 403);
    }
    public function autocomplete_member_name(Request $request)
    {
        $this->validate($request, [
            'query' => 'required|string'
        ]);
        if(intval(trim($request->input('query')))){
            $members = Member::where('id', '=', intval(trim($request->input('query'))))->get()->all();
        } else {
            $members = Member::where('fullname', 'LIKE', '%'.$request->input('query').'%')->get()->all();
        }
        return $this->respondWithData([
            "query" => $request->input('query'),
            'suggestions' => array_map(function($member){
                return [
                    'value' => $member->fullname,
                    'data' => $member->fullname ,
                    'active' => ($member->active == 1),
                    'expired' => (strtoTime($member->expire) < time())
                ];
            }, $members)
        ]);
    }
    public function autocomplete_book_name(Request $request)
    {
        $this->validate($request, [
            'query' => 'required|string'
        ]);
        if(intval(trim($request->input('query')))){
            $books = Book::where('id', '=', intval(trim($request->input('query'))))->get()->all();
        } else {
            $books = Book::where('name', 'LIKE', '%'.$request->input('query').'%')->get()->all();
        }
        return $this->respondWithData([
            "query" => $request->input('query'),
            'suggestions' => array_map(function($member){
                return $member->name;
            }, $books)
        ]);
    }


}
