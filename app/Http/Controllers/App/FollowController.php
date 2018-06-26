<?php

namespace App\Http\Controllers\App;

use App\Models\Follow;
use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $follows = Auth::user()->follows()->with(['user'])->paginate(10);
        $followers = Auth::user()->followers()->with(['user'])->paginate(10);

        return view('app.follows.index', compact('follows','followers'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user()->follows()->create([
            'trader_id' => $request->user_id,
            'percent_to_trader' => $request->invest
        ]);

        return response()->json([
            'data' => [
                'message' => 'Se ha seguido al usuario.',
            ],
        ]);

        /*return response()->json([
            'error' => true,
            'message' => 'Error siguiendo'
        ])->setStatusCode(400);*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post = $post->load(['user', 'category', 'tags', 'comments']);

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post->user_id != auth()->user()->id && auth()->user()->is_admin == false) {
            flash()->overlay("You can't edit other peoples post.");
            return redirect('/admin/posts');
        }

        $categories = Category::pluck('name', 'id')->all();
        $tags = Tag::pluck('name', 'name')->all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update([
            'title'       => $request->title,
            'body'        => $request->body,
            'category_id' => $request->category_id
        ]);

        $tagsId = collect($request->tags)->map(function($tag) {
            return Tag::firstOrCreate(['name' => $tag])->id;
        });

        $post->tags()->sync($tagsId);
        flash()->overlay('Post updated successfully.');

        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->user_id != auth()->user()->id && auth()->user()->is_admin == false) {
            flash()->overlay("You can't delete other peoples post.");
            return redirect('/admin/posts');
        }

        $post->delete();
        flash()->overlay('Post deleted successfully.');

        return redirect('/admin/posts');
    }

    public function follow(User $user, Request $request)
    {
        //$this->validate($request, ['body' => 'required']);

        Auth::user()->follows()->create([
            'trader_id' => $user->id,
            'percent_to_trader' => 10
        ]);
        flash()->overlay('Comment successfully created');

        return redirect("/app/dashboard");

    }
}
