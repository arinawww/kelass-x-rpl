<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $profile = $request->user()->profile;

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profile not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Profile retrieved successfully',
            'data' => new ProfileResource($profile)
        ]);
    }

    public function publicShow()
    {
        // For a personal portfolio, grab the first profile
        $profile = Profile::with('user')->first();

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profile not found',
                'data' => null
            ], 404);
        }

        $profileData = (new ProfileResource($profile))->toArray(request());
        // Attach the user's name to the public response
        if ($profile->user) {
            $profileData['name'] = $profile->user->name;
        }

        return response()->json([
            'success' => true,
            'message' => 'Profile retrieved successfully',
            'data' => $profileData
        ]);
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bio' => 'required|string',
            'cita_cita' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Up to 5MB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 422);
        }

        $updateData = [
            'bio' => $request->bio,
            'cita_cita' => $request->cita_cita,
        ];

        // Process file upload if provided
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('profiles', 'public');
            $updateData['foto'] = $path;
        }

        $profile = Profile::updateOrCreate(
            ['user_id' => $request->user()->id],
            $updateData
        );

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'data' => new ProfileResource($profile)
        ]);
    }
}
