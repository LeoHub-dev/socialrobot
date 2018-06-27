<?php

namespace App\Http\Controllers\App;

use App\Models\Follow;
use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.profile.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $title = 'Perfil';
        return view('app.profile.edit',compact('title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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


}
