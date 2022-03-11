<?php

namespace App\Http\Controllers;

use App\Models\Caisse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
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
        $caisses = Caisse::all()
            ->groupBy(function ($item) {
                return $item->date;
            })->map(function ($row) {
                return [
                    'rows' => $row,
                    'montant' => $row->sum('montant'),
                    'retrait' => $row->where('montant', '<', 0)->count(),
                    'ajout' => $row->where('montant', '>', 0)->count(),
                    'total' => $row->count()
                ];
            });
        $total = Caisse::sum('montant');
        // dd($caisses);
        return view('home', compact('caisses', 'total'));
    }
    public function destroy(Request $request)
    {
        $date = $request->date;
      
        // Caisse::where('date',$date)->delete();
       
        return Redirect::to("home")->withSuccess('Suppression a été effectué avec succès!');
    }
}
