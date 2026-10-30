<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BouleDeNeige;
use App\Models\Nounours;
use App\Models\Parfum;
use App\Models\Cadeau;
use App\Models\Order;

class ShopController extends Controller
{
    public function index()
    {
        $boules = BouleDeNeige::take(1)->get();
        $nounours = Nounours::take(1)->get();
        $parfums = Parfum::take(1)->get();
        $cadeaux = Cadeau::take(1)->get();
        
        return view('welcome', compact('boules', 'nounours', 'parfums', 'cadeaux'));
    }

    public function boulesDeNeige(Request $request)
    {
        $tag = $request->get('tag');
        $query = BouleDeNeige::query();
        
        if ($tag && $tag !== 'Tous') {
            $query->where('tag', $tag);
        }
        
        $products = $query->get();
        $categoryName = "Boules de Neige";
        $slug = "boules-de-neige";

        return view('category', compact('products', 'categoryName', 'slug', 'tag'));
    }

    public function nounours(Request $request)
    {
        $tag = $request->get('tag');
        $query = Nounours::query();
        
        if ($tag && $tag !== 'Tous') {
            $query->where('tag', $tag);
        }
        
        $products = $query->get();
        $categoryName = "Nounours";
        $slug = "nounours";

        return view('category', compact('products', 'categoryName', 'slug', 'tag'));
    }

    public function parfums(Request $request)
    {
        $tag = $request->get('tag');
        $query = Parfum::query();
        
        if ($tag && $tag !== 'Tous') {
            $query->where('tag', $tag);
        }
        
        $products = $query->get();
        $categoryName = "Parfums";
        $slug = "parfums";

        return view('category', compact('products', 'categoryName', 'slug', 'tag'));
    }

    public function cadeaux(Request $request)
    {
        $tag = $request->get('tag');
        $query = Cadeau::query();
        
        if ($tag && $tag !== 'Tous') {
            $query->where('tag', $tag);
        }
        
        $products = $query->get();
        $categoryName = "Cadeaux";
        $slug = "cadeaux";

        return view('category', compact('products', 'categoryName', 'slug', 'tag'));
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'product_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|in:Casablanca,Rabat,Marrakech,Tanger,Agadir,Autre',
            'address' => 'required|string',
        ]);

        $model = match($request->category) {
            'boules-de-neige' => \App\Models\BouleDeNeige::class,
            'nounours' => \App\Models\Nounours::class,
            'parfums' => \App\Models\Parfum::class,
            'cadeaux' => \App\Models\Cadeau::class,
            default => abort(404, 'Catégorie introuvable'),
        };

        $product = $model::findOrFail($request->product_id);

        $shippingFee = ($request->city === 'Casablanca') ? 20.00 : 35.00;
        $totalPrice = $product->price + $shippingFee;

        Order::create([
            'category' => $request->category,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'product_image' => $product->image,
            'name' => $request->name,
            'phone' => $request->phone,
            'city' => $request->city,
            'address' => $request->address,
            'shipping_fee' => $shippingFee,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Votre commande a été enregistrée avec succès !');
    }
}