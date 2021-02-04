<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artisan; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Str;
use App\Models\User;

class ArtisanController extends Controller
{
    public function profile(Artisan $artisan) 
    {   
        $products = DB::table('products')
        ->where('artisan_id', $artisan->id)
        ->paginate(3);
        return view('profileArtisan', compact('products', 'artisan'));   
    }

    public function seeProfile() 
    {       
        $artisan = Artisan::getArtisan();
        if($artisan->aproved)
        {
            $products = DB::table('products')
            ->where('artisan_id', $artisan->id)
            ->paginate(3);
        }
        else
        {
            return view('responsesAdmin', ["message" => "Tu perfil está siendo evaluado, ¡Recibirás notícias pronto por email!"]);
        }
        
        return view('profileArtisan', compact('products', 'artisan'));   
    }

    public function store(Request $request){

        $image = $this->setImage($request);

        $newArtisan = Artisan::create([
            'name' => $request->name,
            'location' =>$request->location,
            'description' =>$request->description,
            'image' => $image, 
            'user_id' =>auth()->id(),
            'slug' => Str::slug($request->name, '-')
            ]);
            
            $newArtisan->save(); 

            return view('responsesAdmin', ["message" => "Tu perfil está siendo evaluado, ¡Recibirás notícias pronto por email!"]);
    }

    public function getAll(){

        $artisans = DB::table('artisans')
                    ->where('aproved','=', 1)
                    ->paginate(6);
        return view('artisans', compact('artisans'));
    }

    public function orders()
    {
        $user_id = auth()->id();
        $user = User::find($user_id); 
        $id = DB::table('artisans')->where('user_id','=',$user_id)->value('id');
        $artisan = Artisan::find($id);
        $orders = $artisan->getOrders($id);
     

        return view('artisanOrders', compact('orders'));
    }

    public function destroy()
    {
        $artisan = Artisan::getArtisan();
        $artisan->delete();

        return redirect('/');
    }

    public function edit()
    {
        $artisan = Artisan::getArtisan();       
        return view('editArtisan', compact('artisan'));
    }

    public function update(Request $request , Artisan $artisan)
    {
        $image = $this->setImage($request);

        $artisan->name = $request->name;
        $artisan->location = $request->location;
        $artisan->description = $request->description;
        $artisan->image  = $image;
        $artisan->user_id =auth()->id();
        $artisan->slug =Str::slug($request->name, '-');

        $artisan->save();
            
        return redirect('/artisan/' . $artisan->slug);
    }

    public function deleteOrder($id)
    {
        DB::table('product_user')->where('id','=',$id)->delete();
        return back();
    }

    private function setImage($request)
    {
        $image = '';
        if($request->image)
        {
            $image = $request->file('image')->store('uploads', 'public');
        } 
        else
        {
            $image = 'uploads/amaso.png';
        }  
        return $image;  
    }



}
