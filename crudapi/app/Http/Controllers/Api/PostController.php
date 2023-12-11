<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use apiResponseTrait;
    public function index()
    {
        return $this->apiSuccess([
            PostResource::collection(Post::all()),
        ], 'Ini adalah data post');

    }
    public function show($id)
    {
        $post = Post::find($id);
        if ($post) {
            return $this->apiSuccess([
                new PostResource($post),
            ], 'Ini adalah data post');
        }
        return $this->apiError(' Not found!', 'Post not found!');

    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $post = Post::create($data);
        if ($post) {
            return $this->apiSuccess(new PostResource($post), 'Post created!');
        }
        return $this->apiError('Error', 'Failed to create post!', 400);
    }
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post) {
            $data = $request->validate([
                'title' => 'required',
                'body' => 'required',
            ]);
            $post->update($data);
            return $this->apiSuccess(new PostResource($post), 'Post updated!');
        }
        return $this->apiError('Error', 'Failed to update post!', 400);
    }
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return $this->apiSuccess(null, 'Post deleted!');
        }
        return $this->apiError('Error', 'Failed to delete post!', 400);
    }
    public function archive()
    {
        $post = Post::onlyTrashed()->get();
        if ($post) {
            return $this->apiSuccess([
                PostResource::collection($post),
            ], 'posts are archived');
        }
        return $this->apiError(' Not found!', 'There is no Posts Trached!');
    }
    public function restore($id)
    {
        $post = Post::onlyTrashed()->find($id);
        if ($post) {
            $post->restore();
            return $this->apiSuccess(new PostResource($post), 'Post restored!');
        }
        return $this->apiError('Error', 'Failed to restore post!', 400);
    }
    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->find($id);
        if ($post) {
            $post->forceDelete();
            return $this->apiSuccess(null, 'Post permanently deleted!');
        }
        return $this->apiError('Error', 'Failed to permanently delete post!', 400);
    }

}
