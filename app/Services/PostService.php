<?php

namespace App\Services;

use App\Models\Post\Post;

class PostService
{
    public function create($request)
    {
        $directory = str_replace(' ', '_', $request->title);
        if ($request->hasFile('thumbnail')) {
            $extension = $request->thumbnail->extension();
            $thumbnail_name = time().".".$extension;
            $request->thumbnail->move(public_path('images/thumbnails/'.$directory), $thumbnail_name);
        }

        if ($request->hasFile('bg_image')) {
            $extension = $request->bg_image->extension();
            $bg_image_name = time().".".$extension;
            $request->bg_image->move(public_path('images/bg_images/'.$directory), $bg_image_name);
        }

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => (int)$request->category ?? null,
            'thumbnail' => $thumbnail_name ?? null,
            'bg_image' => $bg_image_name ?? null,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('panel.posts.show', $post->id);
    }

    public function all($disabled = false)
    {
        if ($disabled) {
            return Post::withTrashed();
        }

        return Post::all();
    }

    public function getUserPosts($id, $disabled = false)
    {
//        dd(Post::withTrashed()->where('user_id',$id));
        if ($disabled) {
            return Post::withTrashed()->where('user_id',$id);
        }

        return Post::all()->where('user_id',$id);
    }
}