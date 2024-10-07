<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Post;

class DashboardController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $posts      = Post::count();
        $menus      = Menu::count();
        $categories = Category::count();

        return response()->json([
            'success' => true,
            'message' => 'List Count Data Table',
            'data' => [
                'posts'      => $posts,
                'menus'      => $menus,
                'categories' => $categories,
            ],
        ], 200);
    }
}
