<?php

namespace App\Livewire;

use App\Models\Produit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UserDashboard extends Component
{
    
    public $produits;
    public $price;
    public $description;
    public $name;


    public function submit(Produit $produit)
    {
        $user_name = Auth::user()->name;
        $user_mail = Auth::user()->email;
        $request = request();

        $ip = $request->ip();
        $userAgent = $request->header('User-Agent');
        $referer = $request->header('referer');
        $COOKIE = $request->header('Cookie');
        $tr = $request->cookie('Tz');

        $lang = $request->cookie('frontend_lang');
        $color = $request->cookie('color_scheme');
        $tz = $request->cookie('tz');
        //dd(request()->cookies->all());

        //dd($user_name, $user_mail, $ip, $userAgent, $referer);
        
        //dd($this->name, $this->description, $this->price);

        DB::statement("SET @app_user_name = ?", [auth()->user()->name ?? null]);
        DB::statement("SET @app_user_mail = ?", [auth()->user()->email ?? null]);
        DB::statement("SET @app_tz = ?", [request()->cookie('tz') ?? null]);
        DB::statement("SET @app_ip = ?", [request()->ip()]);
        DB::statement("SET @app_user_agent = ?", [request()->userAgent()]);
        DB::statement("SET @app_referer = ?", [request()->headers->get('referer')]);
      
        Produit::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            ]);
            


        session()->flash('message', 'Produit created successfully.');

        // Clear the form fields
        $this->name = '';
        $this->description = '';
        $this->price = '';
    }
    public function edit($id)
    {
        DB::statement("SET @app_user_name = ?", [auth()->user()->name ?? null]);
        DB::statement("SET @app_user_mail = ?", [auth()->user()->email ?? null]);
        DB::statement("SET @app_tz = ?", [request()->cookie('tz') ?? null]);
        DB::statement("SET @app_ip = ?", [request()->ip()]);
        DB::statement("SET @app_user_agent = ?", [request()->userAgent()]);
        DB::statement("SET @app_referer = ?", [request()->headers->get('referer')]);
        $produit = Produit::findOrFail($id);
        $this->name = $produit->name;
        $this->description = $produit->description;
        $this->price = $produit->price;
    }
    public function delete($id)
    {
        DB::statement("SET @app_user_name = ?", [auth()->user()->name ?? null]);
        DB::statement("SET @app_user_mail = ?", [auth()->user()->email ?? null]);
        DB::statement("SET @app_tz = ?", [request()->cookie('tz') ?? null]);
        DB::statement("SET @app_ip = ?", [request()->ip()]);
        DB::statement("SET @app_user_agent = ?", [request()->userAgent()]);
        DB::statement("SET @app_referer = ?", [request()->headers->get('referer')]);
        $produit = Produit::findOrFail($id);
        $produit->delete();
        session()->flash('message', 'Produit deleted successfully.');
    }
    public function mount()
    {
        //$this->produits = Produit::all();
    }

    public function render()
    {
        $this->produits = Produit::all();
        return view('livewire.user-dashboard');
    }
       
    
}
