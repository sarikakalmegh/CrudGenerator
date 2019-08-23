<?php

namespace Tests\Unit;
use App\Todo;
use App\Http\Controllers\TodoController;
use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    //use RefreshDatabase;
    // public function test_if_it_fetches_most_proirity_task()
    // {
    //     Factory(Todo::class,3)->create();
    //     Factory(Todo::class,3)->create(['priority'=>3]);
    //     $impTask =  Factory(Todo::class)->create(['priority'=>5]);
    //     $task = Todo::prioritize()->get();

    //     $this->assertEquals($impTask->id,$task->first()->id);

    // }
    public function test_store_todo_function()
    {
            $request = Request::create('/store', 'post',[
                'title'   => 'foo',
                'content' => 'bar',
            ]);
            $controller = new TodoController();
            for($i=0;$i<5;$i++)
            {
            $response = $controller->store($request);
            }
    
        $this->assertEquals(302, $response->getStatusCode());
    }
    public function test_update_todo_function()
    {
            $id = Todo::orderBy('id','asc')->skip(1)->take(1)->pluck('id')->first();

            $request = Request::create('/update', 'post',[
                'title'   => 'tesing',
                'content' => 'testing',
            ]);
            $controller = new TodoController();
            $response = $controller->update($request,$id);
           
        $this->assertEquals(302, $response->getStatusCode());
    }
    public function test_show_todo_function()
    {
        $id = Todo::orderBy('id','asc')->skip(1)->take(1)->pluck('id')->first();
            $controller = new TodoController();
            $response = $controller->show($id);
            $this->assertEquals($id,$response->todo->id);
    }
    public function test_destroy_todo_function()
    {
            $id = Todo::orderBy('id','desc')->skip(1)->take(1)->pluck('id')->first();
            $controller = new TodoController();
            $response = $controller->destroy($id);
            $this->assertEquals(302, $response->getStatusCode());               
    }
   

}
