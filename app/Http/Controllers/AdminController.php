<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\BouleDeNeige;
use App\Models\Nounours;
use App\Models\Parfum;
use App\Models\Cadeau;
use App\Models\Order;

class AdminController extends Controller
{
    private function getModel($category)
    {
        return match ($category) {
            'boules-de-neige' => BouleDeNeige::class,
            'nounours' => Nounours::class,
            'parfums' => Parfum::class,
            'cadeaux' => Cadeau::class,
            default => abort(404),
        };
    }

    public function index(Request $request, $category)
    {
        $modelClass = $this->getModel($category);
        $products = $modelClass::latest()->get();
        $pendingOrders = Order::where('status', 'pending')->latest()->get();
        $pendingOrdersCount = $pendingOrders->count();

        return view('admin.index', compact('products', 'category', 'pendingOrders', 'pendingOrdersCount'));
    }

    public function store(Request $request, $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tag' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'nullable|string',
        ]);

        $modelClass = $this->getModel($category);
        $imagePath = $request->file('image')->store('products', 'public');

        $modelClass::create([
            'name' => $request->name,
            'tag' => $request->tag,
            'price' => $request->price,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Produit ajouté avec succès !');
    }

    public function update(Request $request, $category, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tag' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'nullable|string',
        ]);

        $modelClass = $this->getModel($category);
        $product = $modelClass::findOrFail($id);

        $data = [
            'name' => $request->name,
            'tag' => $request->tag,
            'price' => $request->price,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            if ($product->image && !str_starts_with($product->image, 'http')) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return back()->with('success', 'Produit modifié avec succès !');
    }

    public function destroy($category, $id)
    {
        $modelClass = $this->getModel($category);
        $product = $modelClass::findOrFail($id);

        if ($product->image && !str_starts_with($product->image, 'http')) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return back()->with('success', 'Produit supprimé avec succès !');
    }

    public function acceptOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'accepted']);
        return back()->with('success', 'Commande validée avec succès !');
    }

    public function refuseOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'refused']);
        return back()->with('success', 'Commande refusée.');
    }
}