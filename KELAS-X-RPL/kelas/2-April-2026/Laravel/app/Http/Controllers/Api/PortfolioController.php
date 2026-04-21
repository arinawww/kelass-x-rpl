<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Http\Resources\PortfolioResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::all();
        return response()->json([
            'success' => true,
            'message' => 'Portfolios retrieved successfully',
            'data' => PortfolioResource::collection($portfolios)
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'link' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 422);
        }

        $portfolio = Portfolio::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Portfolio created successfully',
            'data' => new PortfolioResource($portfolio)
        ], 201);
    }

    public function destroy($id)
    {
        $portfolio = Portfolio::find($id);

        if (!$portfolio) {
            return response()->json([
                'success' => false,
                'message' => 'Portfolio not found',
                'data' => null
            ], 404);
        }

        $portfolio->delete();

        return response()->json([
            'success' => true,
            'message' => 'Portfolio deleted successfully',
            'data' => null
        ]);
    }
}
