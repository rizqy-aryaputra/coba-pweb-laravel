<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);

        $visitCount =
            session('visit_count', 0);
        $visitCount++;

        session([
            'visit_count' => $visitCount
        ]);
        if(!session()->has('first_visit')){
            session([
                'first_visit' => now()
                    ->format('d M Y H:i:s')
            ]);
        }

        session([
            'last_visit' => now()
                ->format('d M Y H:i:s')
        ]);

        return view(
            'products.index',
            compact('products')
        );
    }

    public function resetVisit()
    {
        session()->forget([
            'visit_count',
            'first_visit',
            'last_visit'
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Visit counter reset!'
            );
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;

        $products = Product::where('nama', 'like', "%{$keyword}%")
            ->get();

        return response()->json($products);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|unique:products',
            'nama' => 'required|min:3',
            'kategori' => 'required|in:Bag,Shoes,Accessories,Watch',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'tanggal_masuk' => 'required',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'user_id' => auth()->id(),
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFoto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('uploads'), $namaFoto);
            $validated['foto'] = 'uploads/' . $namaFoto;
        }

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'kode' => 'required|unique:products,kode,' . $product->id,
            'nama' => 'required|min:3',
            'kategori' => 'required|in:Bag,Shoes,Accessories,Watch',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'tanggal_masuk' => 'required',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFoto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('uploads'), $namaFoto);
            $validated['foto'] = 'uploads/' . $namaFoto;
        }

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}