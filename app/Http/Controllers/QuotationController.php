<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\QuotationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class QuotationController extends Controller
{
    function __construct(private QuotationRepositoryInterface $quotationRepository)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'age' => 'required|string',
            'currency_id' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'One or more validation rules failed. Please check the data you send in the request.',
            ]);
        }

        $requestParams = $validator->validate();

        try {
            $response = $this->quotationRepository->index($requestParams);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ]);
        }

        return response()->json(
            $response
        );
    }
}
