<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageOtherItem;

class SignupController extends Controller
{
    public function index()
    {
        $page_other_item = PageOtherItem::where('id', 1)->first();
        return view('front.signup', compact('page_other_item'));
    }
}
