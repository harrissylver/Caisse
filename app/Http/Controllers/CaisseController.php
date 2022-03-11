<?php

namespace App\Http\Controllers;

use App\Models\Caisse;
use App\Http\Requests\StoreCaisseRequest;
use App\Http\Requests\UpdateCaisseRequest;
use DateTime;
use Illuminate\Http\Request;

class CaisseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('caisse.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCaisseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = $request->type;
        $note = $request->note;
        $total = $request->total;
        $now = date('Y-m-d');
        if ($total == 0) {
            return redirect()->back()->withFail('Montant invalide');
        }
        if ($type != 'depot') {
            $total = -$total;
        }
        Caisse::create([
            'type' => $type,
            'note' => $note,
            'montant' => $total,
            'date' => $now
        ]);
        return redirect()->back()->withSuccess('Enregistrement a été effectué avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Caisse  $caisse
     * @return \Illuminate\Http\Response
     */
    public function show(Caisse $caisse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Caisse  $caisse
     * @return \Illuminate\Http\Response
     */
    public function edit(Caisse $caisse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCaisseRequest  $request
     * @param  \App\Models\Caisse  $caisse
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCaisseRequest $request, Caisse $caisse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Caisse  $caisse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Caisse $caisse)
    {
        //
    }
}
