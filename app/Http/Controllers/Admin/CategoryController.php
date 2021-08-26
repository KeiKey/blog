<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category\Category;
use App\Services\CategoryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(
        CategoryService $categoryService
    ) {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of categories.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        toastr()->info('Are you the 6 fingered man?');
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
        $handler = $this->categoryService->createCategory($request);

        return redirect()->route('panel.admin.categories.index')->with($handler[0], $handler[1]);
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
        $handler = $this->categoryService->updateCategory($category, $request);

        return redirect()->route('panel.admin.categories.index')->with($handler[0], $handler[1]);
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

        return redirect()->route('panel.admin.categories.index')->with($handler[0], $handler[1]);
    }

    /**
     * Disable a category.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function disable(Category $category): RedirectResponse
    {
        $handler = $this->categoryService->disableCategory($category);

        return redirect()->route('panel.admin.categories.index')->with($handler[0], $handler[1]);
    }

    /**
     * Enable a category.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function enable(Category $category): RedirectResponse
    {
        $handler = $this->categoryService->enableCategory($category);

        return redirect()->route('panel.admin.categories.index')->with($handler[0], $handler[1]);
    }
}
