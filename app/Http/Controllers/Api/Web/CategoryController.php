<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $categories = Category::all();

        //return with Api Resource
        return new CategoryResource(true, 'List Data Categories', $categories);
    }

    /**
     * show
     *
     * @param  mixed $slug
     * @return void
     */
    public function show($slug)
    {
        $category = Category::with(['posts' => function($query) {
            // Ambil hanya pos dengan status 'posted'
            $query->where('status', 'posted');
        }])->where('slug', $slug)->first();

        if ($category) {
            // Paginate the posts to 3 per page
            $posts = $category->posts()->paginate(3);

            // Return posts only with API Resource
            return new CategoryResource(true, 'List Data Post By Category', $posts);
        }

        // Return with API Resource if category not found
        return new CategoryResource(false, 'Data Category Tidak Ditemukan!', null);
    }

}
