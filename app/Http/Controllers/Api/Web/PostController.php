<?php

namespace App\Http\Controllers\Api\Web;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $posts = Post::with('user', 'category')
            ->when(request()->q, function($posts) {
                $posts->where('title', 'like', '%'. request()->q .'%');
            })
            ->where('status', 'posted') // Filter hanya yang statusnya 'posted'
            ->latest()
            ->paginate(3);

        //return with Api Resource
        return new PostResource(true, 'List Data Posts', $posts);
    }


    /**
     * show
     *
     * @param  mixed $slug
     * @return void
     */
    public function show($slug)
    {
        // Ambil post berdasarkan slug
        $post = Post::with('user', 'category')->where('slug', $slug)->first();

        // Cek apakah post ditemukan
        if (!$post) {
            return new PostResource(false, 'Detail Data Post Tidak Ditemukan!', null);
        }

        // Jika post status-nya "archive", views tidak akan bertambah
        if ($post->status !== 'archive') {

            // Nama cookie berdasarkan post ID
            $cookieName = 'post_view_' . $post->id;

            // Cek apakah ada cookie untuk post ini
            if (!request()->cookie($cookieName)) {
                // Tambahkan views
                $post->increment('views');

                // Set cookie agar views tidak bertambah saat di-refresh, expired dalam 10 menit
                cookie()->queue($cookieName, true, 10);
            }
        }

        // Return detail post dengan API resource
        return new PostResource(true, 'Detail Data Post!', $post);
    }

    /**
     * postHomepage
     *
     * @return void
     */
    public function postHomepage()
    {
        $posts = Post::with('user', 'category')->take(10)->latest()->get();

        //return with Api Resource
        return new PostResource(true, 'List Data Posts sidebar', $posts);
    }


    /**
     * storeImagePost
     *
     * @param  mixed $request
     * @return void
     */
    public function storeImagePost(Request $request)
    {
        //upload new image
        $image = $request->file('upload');
        $image->storeAs('public/post_images', $image->hashName());

        return response()->json([
            'url' => asset('storage/post_images/'.$image->hashName())
        ]);
    }

}
