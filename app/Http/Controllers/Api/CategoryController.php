<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $data =  Category::where('user_id', Auth::id())->get();
        return new DataResource($data, 'success', 'get all category successfully');
    }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required', 'jenis' => 'required',]);

        $data =  Category::create([
            'nama'    => $request->nama,
            'jenis'    => $request->jenis,
            'user_id' => Auth::id(),
        ]);

        return new DataResource($data, 'success', 'create category successfully');
    }

    public function show(Category $category)
    {
        return new DataResource($category, 'success', 'get detail category successfully');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['nama' => 'required']);

        $this->authorizeCategory($category);
        $category->update($request->only('nama'));
        return new DataResource($category, 'success', 'category updated successfully');
    }

    public function destroy(Category $category)
    {
        $this->authorizeCategory($category);
        $data = $category->delete();

        if (!$data) {
            return response()->json(['status' => 'failed', 'message' => 'failed delete category'], 500);
        }

        return response()->json(['status' => 'success', 'message' => 'category deleted successfully'], 200);
    }

    private function authorizeCategory(Category $category)
    {
        abort_if($category->user_id !== Auth::id(), 403, 'Unauthorized',);
    }
}