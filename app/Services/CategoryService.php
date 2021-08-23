<?php

namespace App\Services;

use App\Models\Category\Category;
use Illuminate\Http\RedirectResponse;

class CategoryService
{
    public function create($request): RedirectResponse
    {
        $category = Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('panel.admin.categories.show', $category->id);
    }
}
