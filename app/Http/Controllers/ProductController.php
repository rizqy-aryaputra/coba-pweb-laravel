<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $visitCount =
            session('visit_count', 0);

        if(!session()->has('first_visit')){

            session([
                'first_visit' => now()
            ]);

        }

        session([
            'visit_count' => $visitCount + 1,
            'last_visit' => now()
        ]);
        
        $query = Product::query();

        if ($request->filled('category')) {

            $query->where(
                'kategori',
                $request->category
            );

        }

        if ($request->filled('search')) {

            $query->where(
                'nama',
                'like',
                '%' .
                $request->search .
                '%'
            );

        }

        $products = $query
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $categories = Product::select('kategori')
            ->distinct()
            ->pluck('kategori');

        return view(
            'products.index',
            compact(
                'products',
                'categories'
            )
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
            'foto' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:10240',
        ]);

        $validated['user_id'] = auth()->id();

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
        $recent = session(
            'recent_products',
            []
        );

        $recent = array_diff(
            $recent,
            [$product->id]
        );

        array_unshift(
            $recent,
            $product->id
        );

        $recent = array_slice(
            $recent,
            0,
            4
        );

        session([
            'recent_products' => $recent
        ]);

        $relatedProducts = Product::where(
                'kategori',
                $product->kategori
            )
            ->where(
                'id',
                '!=',
                $product->id
            )
            ->latest()
            ->take(4)
            ->get();

        if ($relatedProducts->count() < 4) {

            $remaining =
                4 - $relatedProducts->count();

            $extraProducts = Product::where(
                    'id',
                    '!=',
                    $product->id
                )
                ->whereNotIn(
                    'id',
                    $relatedProducts->pluck('id')
                )
                ->latest()
                ->take($remaining)
                ->get();

            $relatedProducts =
                $relatedProducts->merge(
                    $extraProducts
                );
        }

        return view(
            'products.show',
            compact(
                'product',
                'relatedProducts'
            )
        );
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
            'foto' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:10240',
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