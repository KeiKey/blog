<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category\Category;
use App\Services\CategoryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryService $categoryService
    ) {
    }

    /**
     * Display a listing of categories.
     *
     * @return Application|Factory|View
     */
    public function index()
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
        $category = $this->categoryService->createCategory($request);

        return RedirectResponse::success('panel.admin.categories.index',
            Lang::get('general.create_success', ['name' => $category->name])
        );
    }

    /**
     * Show the form for editing the Category resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function edit(Category $category)
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
        $category = $this->categoryService->updateCategory($category, $request);

        return RedirectResponse::success('panel.admin.categories.index',
            Lang::get('general.update_success', ['name' => $category->name])
        );
    }

    /**
     * Remove the specified category from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $handler = $this->categoryService->deleteCategory($category);

        return RedirectResponse::success('panel.admin.categories.index',
            Lang::get('general.delete_success', ['name' => $category->name])
        );
    }

    /**
     * Disable a category.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function disable(Category $category): RedirectResponse
    {
        $category = $this->categoryService->disableCategory($category);

        return RedirectResponse::success('panel.admin.categories.index',
            Lang::get('general.disable_success', ['name' => $category->name])
        );
    }

    /**
     * Enable a category.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function enable(Category $category): RedirectResponse
    {
        $category = $this->categoryService->enableCategory($category);

        return RedirectResponse::success('panel.admin.categories.index',
            Lang::get('general.enable_success', ['name' => $category->name])
        );
    }
}
