<?php

namespace App\Services;

use App\Models\Category\Category;
use Illuminate\Http\RedirectResponse;

class CategoryService
{
    public function create($request): RedirectResponse
    {
        $category = Category::create([
            'name' => ucwords($request->name),
        ]);

        return redirect()->route('panel.admin.categories.index', $category->id)->with('success', 'You created the category '.$category->name .'!');
    }
}
