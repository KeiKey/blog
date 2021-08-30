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
     * @return string[]
     */
    public function createCategory($request): array
    {
        $category = Category::create([
            'name' => ucwords($request->name),
        ]);

        return getActionResponse(ResponseStatus::SUCCESS, 'You created the category '. $category->name .'!');
    }

    /**
     * @param Category $category
     * @param $request
     * @return string[]
     */
    public function updateCategory(Category $category, $request): array
    {
        $category->update(['name' => ucwords($request->name)]);

        return getActionResponse(ResponseStatus::SUCCESS, 'You updated the category '. $category->name .'!');
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
     * @return string[]
     */
    public function disableCategory(Category $category): array
    {
        $category->update(['state' => State::DISABLED]);

        return getActionResponse(ResponseStatus::SUCCESS, 'You disabled the category '. $category->name .'!');
    }

    /**
     * @param Category $category
     * @return string[]
     */
    public function enableCategory(Category $category): array
    {
        $category->update(['state' => State::ACTIVE]);

        return getActionResponse(ResponseStatus::SUCCESS, 'You enabled the category '. $category->name .'!');
    }
}
