<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class MaxThreePosts implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
// Count the number of posts the  user  created
        $postCount = Post::where('user_id', Auth::id())->count();

        // if he have 3 or more posts, reject the submission
        if ($postCount >= 3) {
            $fail('You have reached the maximum limit of 3 posts. Delete an existing post to create a new one.');
        }

    }
}
