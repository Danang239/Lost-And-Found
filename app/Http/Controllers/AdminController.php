<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\Claim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // =========================
    // AUTHORIZATION ADMIN
    // =========================
    protected function authorizeAdmin()
    {
        if (!auth()->check() || auth()->user()->email !== 'admin1@gmail.com') {
            abort(403, 'Unauthorized');
        }
        // admin email: admin1@gmail.com
        // password: password
    }

    // =========================
    // DASHBOARD ADMIN
    // =========================
    public function index()
    {
        $this->authorizeAdmin();

        $lostItems  = Item::where('type', 'lost')->get();
        $foundItems = Item::where('type', 'found')->get();
        $users      = User::where('email', '!=', 'admin1@gmail.com')->get();
        $claims     = Claim::with(['item', 'user'])->get();

        return view('admin.homepage', compact(
            'lostItems',
            'foundItems',
            'users',
            'claims'
        ));
    }

    // =========================
    // EDIT BARANG HILANG
    // =========================
    public function editItem($id)
    {
        $this->authorizeAdmin();

        $item = Item::findOrFail($id);
        return view('admin.items.edit', compact('item'));
    }

    // =========================
    // UPDATE BARANG HILANG
    // =========================
    public function updateItem(Request $request, $id)
    {
        $this->authorizeAdmin();

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'category'    => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'lost_date'   => 'required|date',
            'type'        => 'required|in:lost,found',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'required' => ':attribute wajib diisi.',
        ]);

        $item = Item::findOrFail($id);

        $item->name        = $request->name;
        $item->description = $request->description;
        $item->category    = $request->category;
        $item->location    = $request->location;
        $item->lost_date   = $request->lost_date;
        $item->type        = $request->type;

        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $item->image = $request->file('image')->store('items', 'public');
        }

        $item->save();

        return redirect()
            ->route('admin.homepage')
            ->with('success', 'Barang berhasil diperbarui');
    }

    // =========================
    // EDIT BARANG DITEMUKAN
    // =========================
    public function editFoundItem($id)
    {
        $this->authorizeAdmin();

        $item = Item::findOrFail($id);
        return view('admin.items.edit-found', compact('item'));
    }

    // =========================
    // UPDATE BARANG DITEMUKAN
    // =========================
    public function updateFoundItem(Request $request, $id)
    {
        $this->authorizeAdmin();

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'category'    => 'required|string|max:255',
            'features'    => 'required|string',
            'location'    => 'required|string|max:255',
            'lost_date'   => 'required|date',
            'type'        => 'required|in:lost,found',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $item = Item::findOrFail($id);

        $item->name        = $request->name;
        $item->description = $request->description;
        $item->category    = $request->category;
        $item->features    = $request->features;
        $item->location    = $request->location;
        $item->lost_date   = $request->lost_date;
        $item->type        = $request->type;

        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $item->image = $request->file('image')->store('items', 'public');
        }

        $item->save();

        return redirect()
            ->route('admin.homepage')
            ->with('success', 'Barang ditemukan berhasil diperbarui');
    }

    // =========================
    // EDIT USER
    // =========================
    public function editUser($id)
    {
        $this->authorizeAdmin();

        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // =========================
    // UPDATE USER
    // =========================
    public function updateUser(Request $request, $id)
    {
        $this->authorizeAdmin();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string|max:20',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::findOrFail($id);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $user->profile_photo_path = $request
                ->file('profile_photo')
                ->store('profile_photos', 'public');
        }

        $user->save();

        return redirect()
            ->route('admin.homepage')
            ->with('success', 'Pengguna berhasil diperbarui');
    }

    // =========================
    // DELETE ITEM
    // =========================
    public function destroyItem($id)
    {
        $this->authorizeAdmin();

        $item = Item::findOrFail($id);

        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return redirect()
            ->route('admin.homepage')
            ->with('success', 'Laporan barang berhasil dihapus.');
    }

    // =========================
    // DELETE USER
    // =========================
    public function destroyUser($id)
    {
        $this->authorizeAdmin();

        $user = User::findOrFail($id);

        if ($user->email === 'admin1@gmail.com') {
            return redirect()
                ->route('admin.homepage')
                ->with('error', 'Tidak dapat menghapus admin.');
        }

        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        $user->delete();

        return redirect()
            ->route('admin.homepage')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
