<?php

namespace App\Services;

use App\Services\Service;
use App\Services\Interfaces\CategoryServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;

class CategoryService extends Service implements CategoryServiceInterface
{
    public function index()
    {
        $categories = Category::all();
        return $categories;
    }

    public function create(FormRequest $request)
    {
        $input = $request->validate();
        $category = auth()->guard('admin')->user()->categories()->create($input);
        return $category;
    }

    public function update(FormRequest $request, Category $category)
    {
        $input = $request->validate();
        $category = $category->update($input);
        return $category;
    }

    public function delete(Category $category)
    {
        $category->delete($category);
        return true;
    }

    public function getActiveCate()
    {
        $categories = Category::where('status', 1)->get();
        return $categories;
    }
}
