<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class HomeController extends Controller
{

    /**
     * Show the application homepage.
     *
     * @return \Inertia\Response
     */
    public function homepage()
    {
        return Inertia::render('Welcome')->withViewData(['title' => config('app.name')]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Inertia\Response
     */
    public function dashboard()
    {
        return Inertia::render('Dashboard');
    }

    /**
     * Show the application pauli.
     *
     * @return \Inertia\Response
     */
    public function pauli()
    {
        return Inertia::render('Pauli');
    }
}
