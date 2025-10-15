<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Like;
use App\Models\Dislike;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * @OA\Get(
     *     path="/api/recommended",
     *     summary="List of recommended people",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Paginated list of users")
     * )
     */
    public function recommended(Request $request)
    {
        $user = $request->user();

        $excludedIds = Like::where('from_user_id', $user->id)->pluck('to_user_id')
            ->merge(Dislike::where('from_user_id', $user->id)->pluck('to_user_id'))
            ->push($user->id);

        $recommended = User::whereNotIn('id', $excludedIds)->paginate(10);

        return response()->json($recommended);
    }

    /**
     * @OA\Post(
     *     path="/api/like/{id}",
     *     summary="Like a person",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Liked successfully")
     * )
     */
    public function like($id, Request $request)
    {
        $user = $request->user();

        if ($user->id == $id) {
            return response()->json(['message' => 'Cannot like yourself'], 400);
        }

        Like::create([
            'from_user_id' => $user->id,
            'to_user_id' => $id,
        ]);

        return response()->json(['message' => 'Liked']);
    }

    /**
     * @OA\Post(
     *     path="/api/dislike/{id}",
     *     summary="Dislike a person",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Disliked successfully")
     * )
     */
    public function dislike($id, Request $request)
    {
        $user = $request->user();

        if ($user->id == $id) {
            return response()->json(['message' => 'Cannot dislike yourself'], 400);
        }

        Dislike::create([
            'from_user_id' => $user->id,
            'to_user_id' => $id,
        ]);

        return response()->json(['message' => 'Disliked']);
    }

    /**
     * @OA\Get(
     *     path="/api/liked",
     *     summary="List of liked people",
     *     tags={"Users"},
     *     @OA\Response(response=200, description="List of liked users")
     * )
     */
    public function liked(Request $request)
    {
        $user = $request->user();

        $likedIds = Like::where('from_user_id', $user->id)->pluck('to_user_id');

        $likedUsers = User::whereIn('id', $likedIds)->get();

        return response()->json($likedUsers);
    }
}