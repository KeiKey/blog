<?php

namespace App\Services;

use App\Enums\State;
use App\Models\Category\Category;
use App\Models\User\User;
use Illuminate\Http\RedirectResponse;

class CategoryService
{
    private $response;

    public function __construct()
    {
        $this->response = ['no_access', 'Not Authorized!'];
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
        $this->response = ['success', 'You created the category: '. $category->name.'!'];

        return $this->response;
    }

    /**
     * @param Category $category
     * @param $request
     * @return string[]
     */
    public function updateCategory(Category $category, $request): array
    {
        $category->update(['name' => ucwords($request->name)]);
        $this->response = ['success', 'You update the category: '. $category->name.'!'];

        return $this->response;
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
            $this->response = ['fail', 'Something went wrong!'];
        }
        $this->response = ['success', 'You deleted the category: '. $category->name.'!'];

        return $this->response;
    }

    /**
     * @param Category $category
     * @return string[]
     */
    public function disableCategory(Category $category): array
    {
        $category->update(['state' => State::DISABLED]);
        $this->response = ['success', 'You disabled the post: '. $category->name.'!'];

        return $this->response;
    }

    /**
     * @param Category $category
     * @return string[]
     */
    public function enableCategory(Category $category): array
    {
        $category->update(['state' => State::ACTIVE]);
        $this->response = ['success', 'You enabled the post: '. $category->name.'!'];

        return $this->response;
    }
}
