<?php

namespace App\Services;

use App\Enums\ResponseStatus;
use App\Enums\State;
use App\Models\Category\Category;

class CategoryService
{
    private $response;

    public function __construct()
    {
        $this->response = getActionResponse();
    }

    /**
     * @param $request
     * @return Category
     */
    public function createCategory($request): Category
    {
        return Category::create([
            'name' => ucwords($request->name),
        ]);
    }

    /**
     * @param Category $category
     * @param $request
     * @return Category
     */
    public function updateCategory(Category $category, $request): Category
    {
        $category->update(['name' => ucwords($request->name)]);

        return $category;
    }

    /**
     * @param Category $category
     * @return string[]
     */
    public function deleteCategory(Category $category): array
    {
        try {
            $category->delete();
        } catch (\Exception $e) {
            $this->response = getActionResponse(ResponseStatus::FAILURE);
        }

        return getActionResponse(ResponseStatus::SUCCESS, 'You deleted the category '. $category->name .'!');
    }

    /**
     * @param Category $category
     * @return Category
     */
    public function disableCategory(Category $category): Category
    {
        $category->update(['state' => State::DISABLED]);

        return $category;
    }

    /**
     * @param Category $category
     * @return Category
     */
    public function enableCategory(Category $category): Category
    {
        $category->update(['state' => State::ACTIVE]);

        return $category;
    }
}
