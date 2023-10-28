<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BlogAndNewsService;
use App\Http\Requests\BANStoreRequest;
use App\Http\Requests\BANCommentRequest;

class BlogAndNewsController extends Controller
{
    /**
     * Create a new BlogAndNewsService  instance.
     * 
     * @return void
     */
    public function __construct(
        BlogAndNewsService $blog_and_news_service,
    )
    {
        $this->ban_service = $blog_and_news_service;
        $this->middleware('auth:api', ['except' => ['index','store']]);
    }

    public function index(Request $request){

        $q = $request->q;

        $data = $this->ban_service->get($q);


        return response()->json([
            'status' => true,
            'data' => $data
        ],201);
    }

    public function store(BANStoreRequest $request){

        $data = $this->ban_service->store($request->name,$request->description,$request->image);

        return response()->json([
            'status' => true,
            'message' => 'Blog/News created successfully.',
            'data' => $data
        ],201);
    }

    public function like(int $blog_news_id){

        $this->ban_service->like(auth()->user()->id,$blog_news_id);

        return response()->json([
            'status' => true,
            'message' => 'Blog_News liked successfully.',
        ],200);
    }

    public function comment(int $blog_news_id,BANCommentRequest $request){

        $this->ban_service->comment(auth()->user()->id,$blog_news_id,$request->text);

        return response()->json([
            'status' => true,
            'message' => 'Blog_News comented successfully.',
        ],200);
    }
}



