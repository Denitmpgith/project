<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Mockery;
use Tests\TestCase;
use App\Models\{
    User,
    Post,
    Apply,
    Comment,
    PartPost,
    PostFile,
    ApplyFile,
    ApplyRate,
    Fortfolio,
    user_detiles,
    FortDetiles,
    ReplyComment,
    ListCategory,
};

class Relasi_Table extends TestCase
{
    private $user, $post, $apply, $comment, $postFile, $partPost, $applyFile, $applyRate, $fortfolio, $user_detiles, $fortDetile, $replyComment, $listCategory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::first();
        $this->post = Post::first();
        $this->apply = apply::first();
        $this->comment = comment::first();
        $this->postFile = postFile::first();
        $this->partPost = partPost::first();
        $this->applyFile = applyFile::first();
        $this->applyRate = applyRate::first();
        $this->fortfolio = fortfolio::first();
        $this->user_detiles = user_detiles::first();
        $this->fortDetile = fortDetiles::first();
        $this->replyComment = replyComment::first();
        $this->listCategory = listCategory::first();
        // $this->transaction = transaction::first();
    }

    public function test_table_post_dan_table_user()
    {
        $this->assertEquals($this->user->username, $this->post->user->username);
    }
    public function test_table_fortfolio_dan_table_user()
    {
        $this->assertEquals($this->user->username, $this->fortfolio->user->username);
    }
    public function test_table_user_detiles_dan_table_user()
    {
        $this->assertEquals($this->user->username, $this->user_detiles->user->username);
    }
    public function test_table_fort_detile_dan_table_fortfolio()
    {
        $this->assertEquals($this->fortfolio->name_file, $this->fortDetile->fortfolio->name_file);
    }
    public function test_table_post_file_dan_table_post()
    {
        $this->assertEquals($this->post->title, $this->postFile->post->title);
    }
    public function test_table_part_post_dan_table_post()
    {
        $this->assertEquals($this->post->title, $this->partPost->post->title);
    }
    public function test_table_list_category_dan_table_post()
    {
        $this->assertEquals($this->post->title, $this->listCategory->post->title);
    }
    public function test_table_comment_dan_table_post()
    {
        $this->assertEquals($this->post->title, $this->comment->post->title);
    }
    public function test_table_comment_dan_table_user()
    {
        $this->assertEquals($this->user->username, $this->comment->user->username);
    }
    public function test_table_apply_dan_table_post()
    {
        $this->assertEquals($this->post->title, $this->apply->post->title);
    }
    public function test_table_apply_dan_table_user()
    {
        $user = User::where('username', $this->apply->user->username)->first();
        $this->assertEquals($this->apply->user->username, $user->username);
    }
    public function test_table_applyFile_dan_apply()
    {
        $this->assertEquals($this->applyFile->apply->title, $this->apply->title);
    }
    public function test_table_apply_rate_dan_apply()
    {
        $this->assertEquals($this->applyRate->apply->title, $this->apply->title);
    }
    public function test_table_reply_comment_dan_comment_dan_table_user()
    {
        $this->assertEquals($this->user->username, $this->replyComment->comment->user->username);
    }
    public function test_table_reply_comment_dan_table_comment()
    {
        $this->assertEquals($this->comment->title, $this->replyComment->comment->title);
    }

}
