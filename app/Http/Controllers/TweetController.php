<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tweets.index', [
            // 'tweets' => Tweet::orderBy('created_at', 'desc')->get(),  //ordenar
            'tweets' => Tweet::with('user')->latest()->get(), // común
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation
        $validated = $request->validate([
                'message'=> ['required', 'min:1','max:255'],
            ]);

        //insert into db

        $request->user()->tweets()->create($validated);

        return to_route('tweets.index')->with('status',  __('Tweet created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Tweet $tweet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tweet $tweet)
    {
        //
        $this->authorize('update', $tweet);

        // (Tweer $tweet) => $tweet = Tweet::findOrFail($tweet)
        return view ('tweets.edit', [
            'tweet'=> $tweet
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tweet $tweet)
    {
        //
        $this->authorize('update', $tweet);

         $validated = $request->validate([
                'message'=> ['required', 'min:1','max:255'],
            ]);

        $tweet->update($validated);

        return to_route('tweets.index')->with('status', __('Tweet updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tweet $tweet)
    {
        //
    }
}
