<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts = Post::query()->get();
//        $posts = Post::query()->where('id','=',1)->get();
//        $posts = Post::query()->find(1);

        return new JsonResponse([
            'data' => $posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $created = DB::transaction(function () use ($request){
            $created = Post::query()->create([
                'title' => $request->title,
                'body' => $request->body,
            ]);
            if($userIds = $request->user_ids){
                $created->users()->sync($request->user_ids);
            }
            return $created;
        });

        return new JsonResponse([
            'data' => $created
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Post $post)
    {
        return new JsonResponse([
            'data' => $post
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Post $post)
    {
//        $post->update($request->only(['title','body']));
        $updated = $post->update([
            'title' => $request->title ?? $post ->title,
            'body' => $request->title ?? $post ->body,
        ]);
        if(!$updated){
            return new JsonResponse([
                'errors' =>[
                    'Failed to update model.'
                ],Response::HTTP_BAD_REQUEST
            ]);
        }
        return new JsonResponse([
            'data' => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
