<?php
namespace App\Services;
use App\Models\BlogAndNews;
use App\Services\FileService;

class BlogAndNewsService{
    /**
     * Create a new FileService instance.
     * 
     * @return void
     */
    public function __construct(
        FileService $file_service,
    )
    {
        $this->file_service = $file_service;
    }

    /**
     * Get BlogAndNews.
     */
    public function get($q = null){

        $ban =  BlogAndNews::query();

        if($q){
            $ban = $ban->where('name','like',"%$q%")
            ->orWhere('description','like',"%$q%");
        }

        return $ban->paginate(10);

    }

    /**
     * Create BlogAndNews.
     */
    public function store($name, $description, $image){
        $fileName = $this->file_service->uploadbase64Image($image);

        $ban =  BlogAndNews::create([
            'name' => $name,
            'description' => $description,
            'image' => $fileName,
        ]);

        return $ban;

        // $fileName = $this->file_service->uploadbase64Image($image);

        // $ban->image = $fileName;
        // return $ban->save();

    }
    
    /**
     * Like BlogAndNews.
     */
    public function like($user_id, $blog_news_id){

        $ban =  BlogAndNews::findOrFail($blog_news_id);

        $ban->likes()->attach($user_id);

    }

    /**
     * Comment BlogAndNews.
     */
    public function comment($user_id, $blog_news_id, $comment){

        $ban =  BlogAndNews::findOrFail($blog_news_id);

        $ban->comments()->attach([0=>['blog_news_id' => $blog_news_id,'user_id' => $user_id, 'text' => $comment]]);

    }
}

?>