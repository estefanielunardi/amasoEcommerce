<?php

namespace App\Http\Controllers;

use App\Models\Ratting;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class RattingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ratting = new Ratting();
        $ratting->ratting = (int)$request->ratting;
        $ratting->user_id = $request->user()->id;
        $ratting->product_id = $request->id;
        
        $rattingId = Ratting::whereIn('product_id', [$ratting->product_id])
            ->where('user_id', [$ratting->user_id])
            ->value('id');

        if($rattingId != null  && $rattingId != 0 ){
            Ratting::whereIn('id', [$rattingId])->update(['ratting'=>$ratting->ratting]);
            
            //return redirect(route('productPage', $ratting->product_id));
            return back();
        }

        $ratting->save();

        //return redirect(route('productPage', $ratting->product_id));
        return back();
        

        //coger el valor del rating.
        //guardar el valor del rating, vinculado al usuario y al producto.
        //sobreescribir el ultimo valor entrado por el mismo usuario.
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ratting  $ratting
     * @return \Illuminate\Http\Response
     */
    public function show(Ratting $ratting)
    {
        //recoger total de valores del producto.
        //hacer la media de valoraciones totales del producto.
        //recoger la utltima votacion del usuario.
        //mostrar la media y la utlima votacion
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ratting  $ratting
     * @return \Illuminate\Http\Response
     */
    public function edit(Ratting $ratting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ratting  $ratting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ratting $ratting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ratting  $ratting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ratting $ratting)
    {
        //
    }
}
