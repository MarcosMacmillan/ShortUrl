<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashBoard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $urls = ShortUrl::where('user_id', $user->id)->get();
        return view('dashboard', compact('urls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
        ]);

        $user = Auth::user();

        $count = ShortUrl::where('user_id', $user->id)->count();
        if ($count >= 10) {
            return redirect()->route('dashboard')
                ->with('error', 'You have already reached the limit of 10 shortened URLs.');
        }

        $shortCode = substr(md5(uniqid()), 0, 6);

        ShortUrl::create([
            'user_id' => $user->id,
            'original_url' => $request->original_url,
            'short_code' => $shortCode,
        ]);

        return redirect()->route('dashboard')->with('success', 'ShortUrl Created');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $url = ShortUrl::where('id', $id)->where('user_id', $user->id)->first();

        if ($url) {
            $url->delete();
            return redirect()->route('dashboard')->with('success', 'ShortUrl deleted!');
        }

        return redirect()->route('dashboard')->with('error', 'You do not have permission to delete this ShortUrl.');
    }

    public function redirect($id)
    {
        $url = ShortUrl::where('short_code', $id)->firstOrFail();
        return view('redirect', [
            'finalUrl' => $url->original_url
        ]);
    }
}
