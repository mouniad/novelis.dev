<?php
/**
 * Created by PhpStorm.
 * User: Mounia
 * Date: 5/20/2017
 * Time: 9:16 AM
 */

namespace Tests\Unit;

use App\GroupContact;
use App\Http\Controllers\GroupsController;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class GroupsControllerTest extends TestCase
{
    protected $fail = [ 'status' => false, 'message' => "Nothing found"];
    protected $success = [ 'status' => true, 'message' => "Success"];

    protected function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    public function testGetListSuccess()
    {
        factory(GroupContact::class, 2)->create();
        $data = GroupContact::orderBy('active', 'desc')->get();

        $this->assertEquals(2, GroupContact::count());

        $this->getJson('/api/contact/group/list')
            ->assertStatus(200)
            ->assertSee(json_encode([
                'status'=>$this->success['status'],
                'message'=>$this->success['message'],
                'data'=> $data
            ]));
    }

    public function testGetListFail()
    {
        $this->getJson('/api/contact/group/list')
            ->assertStatus(200)
            ->assertSee(json_encode([
                'status'=>$this->fail['status'],
                'message'=>$this->fail['message'],
                'data'=> []
            ]));
    }

    public function testGetItemSuccess()
    {
        factory(GroupContact::class, 1)->create();
        $data = GroupContact::first();

        $this->assertEquals(1, GroupContact::count());

        $this->getJson(action('GroupsController@item', $data->id))
            ->assertStatus(200)
            ->assertSee(json_encode([
                'status'=>$this->success['status'],
                'message'=>$this->success['message'],
                'data'=> $data
            ]));
    }

    public function testGetItemFail()
    {
        $this->assertEquals(0, GroupContact::count());

        $this->getJson(action('GroupsController@item', 12))
            ->assertStatus(200)
            ->assertSee(json_encode([
                'status'=>$this->fail['status'],
                'message'=>$this->fail['message'],
                'data'=> null
            ]));
    }

    public function testStoreItemSuccess()
    {
        $response = $this->json('POST', 'api/contact/group/store', ['name' => 'Family', 'slug' => 'family'])
                            ->assertStatus(200);
        $group = GroupContact::first();

        $response->assertSee(json_encode([
                'status'=>$this->success['status'],
                'message'=>$this->success['message'],
                'data'=> $group
            ]));
    }

    public function testUpdateItemSuccess()
    {
        $group = factory(GroupContact::class)->create();
        $group = GroupContact::find($group->id);

        $response = $this->json('PUT', 'api/contact/group/update/1', ['name' => 'Family', 'slug' => 'family']);
        $group->name = 'Family';
        $group->slug = 'family';
        $response->assertSee(json_encode([
                'status'=>$this->success['status'],
                'message'=>$this->success['message'],
                'data'=> $group
            ]));
    }


    public function testDestroyItemSuccess()
    {
        $group = factory(GroupContact::class)->create();
        $this->assertEquals(1, GroupContact::count());

        $response = $this->json('DELETE', 'api/contact/group/delete/1')
                            ->assertStatus(200);

        $response->assertSee(json_encode([
                'status'=>$this->success['status'],
                'message'=>$this->success['message'],
                'data'=> true
            ]));
    }
}




