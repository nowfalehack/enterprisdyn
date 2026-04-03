<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // GET /api/users
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;

        $users = User::paginate($limit);

        return response()->json([
            'status' => true,
            'message' => 'Users fetched successfully',

            'data' => UserResource::collection($users->items()),

            'pagination' => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'per_page' => $users->perPage(),
                'total' => $users->total(),
                'next_page_url' => $users->nextPageUrl(),
                'prev_page_url' => $users->previousPageUrl(),
            ]
        ]);
    }

    // GET /api/users/{id}
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'User fetched successfully',
                'data' => new UserResource($user)
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }
    }
}