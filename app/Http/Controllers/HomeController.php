<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoanService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected LoanService $loanService
    )
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $loans = $this->loanService->getLoanListing();
        return view('home', ['loans' => $loans]);
    }

    public function viewCollectionSchedule(){
        return view('collection');
    }

    public function collectionSchedule(){
        $collection = $this->loanService->getCollecionSchedule();
        return response()->json(['success' => true, 'data' => $collection]);
    }
}
