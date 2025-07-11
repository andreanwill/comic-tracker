<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JumbotronImage;
use Illuminate\Support\Facades\Storage;

class JumbotronImageController extends Controller
{
    public function index()
    {
        $images = JumbotronImage::orderBy('order')->get();
        return view('admin.jumbotron.index', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $count = JumbotronImage::count();
        $max = 5 - $count;
        if ($request->hasFile('images') && $max > 0) {
            $files = array_slice($request->file('images'), 0, $max);
            foreach ($files as $file) {
                $path = $file->store('jumbotron', 'public');
                $order = JumbotronImage::max('order') + 1;
                JumbotronImage::create([
                    'image_path' => $path,
                    'order' => $order,
                ]);
            }
        }
        return redirect()->route('admin.jumbotron.index')->with('success', 'Gambar berhasil diupload.');
    }

    public function destroy(JumbotronImage $jumbotron)
    {
        Storage::disk('public')->delete($jumbotron->image_path);
        $jumbotron->delete();
        return redirect()->route('admin.jumbotron.index')->with('success', 'Gambar berhasil dihapus.');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*' => 'integer',
        ]);
        foreach ($request->orders as $id => $order) {
            JumbotronImage::where('id', $id)->update(['order' => $order]);
        }
        return response()->json(['success' => true]);
    }
}
