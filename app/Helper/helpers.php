<?php

use App\Enums\ResponseStatus;

if (!function_exists("getActionResponse")) {
    function getActionResponse(string $status = ResponseStatus::NO_ACCESS, string $message = null): array
    {
        switch ($status){
            case ResponseStatus::SUCCESS:
                return [
                    'status' => ResponseStatus::SUCCESS,
                    'message' => $message ?? 'Not Authorized!'
                ];
            case ResponseStatus::FAILURE:
                return [
                    'status' => ResponseStatus::FAILURE,
                    'message' => $message ?? 'Something went wrong!'
                ];
            default:
                return [
                    'status' => ResponseStatus::NO_ACCESS,
                    'message' => $message ?? 'Action was successful!'
                ];
        }
    }
}
