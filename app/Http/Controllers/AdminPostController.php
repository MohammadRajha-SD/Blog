<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
// use Illuminate\Support\Facades\Gate;

use App\Models\Post;

class AdminPostController extends Controller
{
    public function index() {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50),
        ]);
    }

    public function create() {
        return view('admin.posts.create');
    }

    public function store() 
    {
        Post::create(array_merge($this->validatePost(), [
            'user_id' => request()->user()->id,
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]));

        return redirect('/admin/blog');
    }

    public function edit(Post $post) {
        return view('admin.posts.edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post) {
       
        $attr = $this->validatePost($post);

        if ($attr['thumbnail'] ?? false) {
            $attr['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attr);

        return back()->with('success', 'Post Updated.');
    }

    public function destroy(Post $post) {
        $post->delete();        

        return back()->with('success', 'Post Deleted.');
    }

    protected function validatePost(?Post $post = null) : array
    {
        $post ??= new Post();
        return request()->validate([
            'title' => 'required',
            'slug' =>['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'thumbnail' =>  $post->exists ? ['image'] : ['required', 'image'],
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'published_at' => 'required',
        ]);

    }

}
