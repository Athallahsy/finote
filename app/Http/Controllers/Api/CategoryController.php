<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::where('user_id', Auth::id())->get();
    }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required']);

        return Category::create([
            'nama'    => $request->nama,
            'user_id' => Auth::id(),
        ]);
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function update(Request $request, Category $category)
    {
        $this->authorizeCategory($category);
        $category->update($request->only('nama'));
        return $category;
    }

    public function destroy(Category $category)
    {
        $this->authorizeCategory($category);
        $category->delete();
        return response()->noContent();
    }

    private function authorizeCategory(Category $category)
    {
        abort_if($category->user_id !== Auth::id(), 403, 'Unauthorized');
    }
}
