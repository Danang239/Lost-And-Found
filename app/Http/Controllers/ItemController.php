<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{   
    public function foundItems(Request $request)
    {
        $query = Item::where('type', 'found')
                    ->whereNull('claimed_at');  // hanya barang yang belum diklaim

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        $items = $query->paginate(9);

        // Ambil klaim pending untuk barang yang dimiliki user (untuk notifikasi)
        $userItemIds = $items->pluck('id')->toArray();

        $pendingClaims = \App\Models\Claim::whereIn('item_id', $userItemIds)
                            ->where('status', 'pending')
                            ->with(['item', 'user'])
                            ->get();

        return view('items.found', compact('items', 'pendingClaims'));
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function allItems(Request $request)
    {
        $search = $request->input('search');

        $items = Item::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })->paginate(10);

        return view('items.all', compact('items'));
    }

    public function dashboard()
    {
        $lostItems = Item::where('type', 'lost')
            ->with('user')
            ->latest()
            ->paginate(6);

        return view('dashboard', compact('lostItems'));
    }


    public function createFound()
    { 
        return view('items.create-found');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:lost,found',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'lost_date' => 'required|date',
            'features' => 'nullable|string|max:255', // <- Tambahkan ini
            'image' => 'nullable|image|max:2048',
        ]);

        $item = new Item();
        $item->user_id = auth()->id();
        $item->type = $validated['type'];
        $item->name = $validated['name'];
        $item->description = $validated['description'];
        $item->category = $validated['category'];
        $item->location = $validated['location'];
        $item->lost_date = $validated['lost_date'];
        $item->features = $validated['features'] ?? null; // <- Tambahkan ini

        if ($request->hasFile('image')) {
            $item->image = $request->file('image')->store('items', 'public');
        }

        $item->save();

        return redirect()->route('dashboard')->with('success', 'Laporan berhasil dikirim!');
    }




    public function index(Request $request)
    {
        $query = Item::where('type', 'found')->whereNull('claimed_at');

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        $items = $query->paginate(9);

        // Ambil ID barang milik user (pemilik item)
        $userItemIds = Item::where('user_id', auth()->id())->pluck('id')->toArray();

        // Ambil klaim pending (verified = 0 artinya pending)
        $pendingClaims = \App\Models\Claim::whereIn('item_id', $userItemIds)
            ->where('verified', 0)
            ->with(['item', 'user'])
            ->get();

        return view('items.index', compact('items', 'pendingClaims'));
    }


    // Method untuk klaim barang
    public function claim($id)
    {
        $item = Item::findOrFail($id);

        if ($item->claimed_at !== null) {
            return redirect()->route('items.index')->with('error', 'Barang sudah diklaim sebelumnya.');
        }

        $item->claimed_at = now();
        $item->save();

        return redirect()->route('items.index')->with('success', 'Barang berhasil diklaim!');
    }

    public function create()
    {
        return view('items.create');
    }

    public function edit(Item $item)
    {
        if ($item->user_id !== Auth::id()) {
            abort(403);
        }

        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        if ($item->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'lost_date' => 'required|date',
            'image' => 'nullable|image|max:2048',
        ]);

        $item->name = $request->name;
        $item->description = $request->description;
        $item->category = $request->category;
        $item->location = $request->location;
        $item->lost_date = $request->lost_date;

        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $item->image = $request->file('image')->store('items', 'public');
        }

        $item->save();

        return redirect()->route('items.index')->with('success', 'Barang hilang berhasil diperbarui!');
    }

    public function destroy(Item $item)
    {
        if ($item->user_id !== Auth::id()) {
            abort(403);
        }

        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Barang hilang berhasil dihapus!');
    }
}
