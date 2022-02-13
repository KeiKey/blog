<?php

namespace App\Http\Controllers\Admin;

use App\Enums\State;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category\Category;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.categories.index', ['categories' => Category::all()]);
    }

    /**
     * Show the form for creating a new category.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param CategoryStoreRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        Category::create([
            'name' => ucwords($request->validated()['name']),
        ]);

        return RedirectResponse::success();
    }

    /**
     * Show the form for editing the Category resource.
     *
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified category in storage.
     *
     * @param Category $category
     * @param CategoryStoreRequest $request
     * @return RedirectResponse
     */
    public function update(Category $category, CategoryStoreRequest $request): RedirectResponse
    {
        $categoryName = ucwords($request->validated()['name']);

        if (!$category->update(['name' => $categoryName])) {
            return RedirectResponse::error();
        };

        return RedirectResponse::success();
    }

    /**
     * Remove the specified category from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        try {
            $category->delete();
        } catch (Exception $e) {
            return RedirectResponse::error(null, $e->getMessage());
        }

        return RedirectResponse::success();
    }

    /**
     * Disable a category.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function disable(Category $category): RedirectResponse
    {
        if (!$category->update(['state' => State::DISABLED])) {
            return RedirectResponse::error();
        }

        return RedirectResponse::success();
    }

    /**
     * Enable a category.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function enable(Category $category): RedirectResponse
    {
        if (!$category->update(['state' => State::ACTIVE])) {
            return RedirectResponse::error();
        }

        return RedirectResponse::success();
    }
}
