<?php

namespace App\Services;

use App\Enums\State;
use App\Models\Category\Category;

class CategoryService
{
    private $response;

    public function __construct()
    {
        $this->response = [
            'status' => 'no_access',
            'message' => 'Not Authorized!'
        ];
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

        $this->response['status'] = ['success'];
        $this->response['message'] = ['You created the category '. $category->name .'!'];

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

        $this->response['status'] = ['success'];
        $this->response['message'] = ['You update the category '. $category->name .'!'];

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
            $this->response['status'] = ['fail'];
            $this->response['message'] = ['Something went wrong!'];
        }

        $this->response['status'] = ['success'];
        $this->response['message'] = ['You deleted the category '. $category->name .'!'];

        return $this->response;
    }

    /**
     * @param Category $category
     * @return string[]
     */
    public function disableCategory(Category $category): array
    {
        $category->update(['state' => State::DISABLED]);

        $this->response['status'] = ['success'];
        $this->response['message'] = ['You disabled the category '. $category->name .'!'];

        return $this->response;
    }

    /**
     * @param Category $category
     * @return string[]
     */
    public function enableCategory(Category $category): array
    {
        $category->update(['state' => State::ACTIVE]);

        $this->response['status'] = ['success'];
        $this->response['message'] = ['You enabled the category '. $category->name .'!'];

        return $this->response;
    }
}
