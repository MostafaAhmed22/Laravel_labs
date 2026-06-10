<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Post;

class PruneOldPostsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //delete post created 2 years ago
        $allowedDAte = now()->subYears(2);

        $deletedPosts = Post::where('created_at','<', $allowedDAte)->delete();
    }
}
