<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\ServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;

interface CategoryServiceInterface extends ServiceInterface
{
    public function index();
    public function create(FormRequest $request);
    public function update(FormRequest $request, Category $category);
    public function delete(Category $category);
    public function getActiveCate();
}
