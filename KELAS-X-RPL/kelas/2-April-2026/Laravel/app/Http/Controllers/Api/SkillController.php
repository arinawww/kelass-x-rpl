<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Http\Resources\SkillResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{
    public function index(Request $request)
    {
        $skills = Skill::all();
        return response()->json([
            'success' => true,
            'message' => 'Skills retrieved successfully',
            'data' => SkillResource::collection($skills)
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'level' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 422);
        }

        $skill = Skill::create([
            'user_id' => $request->user()->id,
            'name' => $request->name,
            'level' => $request->level,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Skill created successfully',
            'data' => new SkillResource($skill)
        ], 201);
    }

    public function destroy($id)
    {
        $skill = Skill::find($id);

        if (!$skill) {
            return response()->json([
                'success' => false,
                'message' => 'Skill not found',
                'data' => null
            ], 404);
        }

        $skill->delete();

        return response()->json([
            'success' => true,
            'message' => 'Skill deleted successfully',
            'data' => null
        ]);
    }
}
