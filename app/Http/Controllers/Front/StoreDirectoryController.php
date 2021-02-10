<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Display a listing of the resource.
 *
 * @param Request $request
 *
 * @return \Illuminate\Http\Response
 */
class StoreDirectoryController extends Controller
{
    public function index(){
    	return view('front.store-directory');
    }
}
