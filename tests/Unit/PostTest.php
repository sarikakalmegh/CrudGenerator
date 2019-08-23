<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Post;
use App\Http\Controllers\Admin\PostsController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
class PostTest extends TestCase
{
    //use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    // public function testExample()
    // {
    //     $this->assertTrue(true);
    // }
    
    public function test_store_post_function()
    {
        // $post = \Mockery::mock(Post::class);
        // $post->shouldReceive('setAttribute')->with('title', 'foo')->andReturn($post);
        // $post->shouldReceive('setAttribute')->with('content', 'bar')->andReturn($post);
        // $post->shouldReceive('setAttribute')->with('category', 'tetsing')->andReturn($post);
        // $post->shouldReceive('save')->andReturn($post);
            $request = Request::create('/store', 'post',[
                'title'    => 'foo',
                'content'  => 'bar',
                'category' => 'tetsing'
            ]);
            $query = new PostsController();

            $result = $query->store($request);

        //$this->assertInstanceOf(Post::class, $result);

            $controller = new PostsController();
            for($i=0;$i<5;$i++)
            {
            $response = $controller->store($request);
            }
         $this->assertEquals(302, $result->getStatusCode());
    }
    public function test_update_post_function()
    {
            $id = Post::orderBy('id','asc')->skip(1)->take(1)->pluck('id')->first();
            $request = Request::create('/update', 'post',[
                'title'    => 'test',
                'content'  => 'test',
                'category' => 'test'
            ]);
            $controller = new PostsController();
            $response = $controller->update($request,$id);
           
        $this->assertEquals(302, $response->getStatusCode());
    }
    // public function test_show_post_function()
    // {
    //         $id = Post::orderBy('id','asc')->skip(1)->take(1)->pluck('id')->first();
    //         $controller = new PostsController();
    //         $response = $controller->show($id);
    //         $this->assertEquals($id,$response->post->id);
    // }
    // public function test_destroy_post_function()
    // {
    //         $id = Post::orderBy('id','desc')->skip(1)->take(1)->pluck('id')->first();
    //         $controller = new PostsController();
    //         $response = $controller->destroy($id);
    //         $this->assertEquals(302, $response->getStatusCode());               
    // }
}
