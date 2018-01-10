<?php

namespace Tests\Unit;

use App\Contact;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ContactsControllerTest extends TestCase
{
    protected $fail = [ 'status' => false, 'message' => "Nothing found"];
    protected $success = [ 'status' => true, 'message' => "Success"];

    protected function setUp() {
        parent::setUp();
        Artisan::call('migrate');
    }

    public function testGetListSuccess()
    {
        factory(Contact::class, 2)->create();
        $data = Contact::orderBy('lastname', 'asc')->with(['emails', 'phones'])->get();

        $this->assertEquals(2, Contact::count());

        $this->getJson(action('ContactsController@all'))
             ->assertStatus(200)
             ->assertSee(json_encode([
                 'status'=>$this->success['status'],
                 'message'=>$this->success['message'],
                 'data'=> $data
             ]));
    }

    public function testGetListFail()
    {
        $this->getJson(action('ContactsController@all'))
             ->assertStatus(200)
             ->assertSee(json_encode([
                 'status'=>$this->fail['status'],
                 'message'=>$this->fail['message'],
                 'data'=> []
             ]));
    }

    public function testGetItemSuccess()
    {
        factory(Contact::class, 1)->create();
        $data = Contact::with(['emails', 'phones', 'group'])->first();

        $this->assertEquals(1, Contact::count());

        $this->getJson(action('ContactsController@item', $data->id))
             ->assertStatus(200)
             ->assertSee(json_encode([
                 'status'=>$this->success['status'],
                 'message'=>$this->success['message'],
                 'data'=> $data
             ]));
    }

    public function testGetItemFail()
    {
        $this->assertEquals(0, Contact::count());

        $this->getJson(action('ContactsController@item', 150))
             ->assertStatus(200)
             ->assertSee(json_encode([
                 'status'=>$this->fail['status'],
                 'message'=>$this->fail['message'],
                 'data'=> null
             ]));
    }

    public function testStoreItemSuccess()
    {
        $response = $this->json('post', action('ContactsController@store'), [
                                                                    'firstname' => 'Mohammed amine',
                                                                    'lastname' => 'BERRICHI']);
        $response->assertSee(json_encode([
            'status'=>$this->success['status'],
            'message'=>$this->success['message'],
            'data'=> Contact::first()
        ]));
    }

    public function testUpdateItemSuccess()
    {
        $contact = factory(Contact::class)->create();

        $contact = Contact::find($contact->id);

        $response = $this->json('put', action('ContactsController@update', $contact->id), [
            'firstname' => 'Mohammed amine',
            'lastname' => 'BERRICHI'
        ]);
        $contact->firstname = 'Mohammed amine' ;
        $contact->lastname = 'BERRICHI' ;
        $response->assertSee(json_encode([
            'status'=>$this->success['status'],
            'message'=>$this->success['message'],
            'data'=> $contact
        ]));
    }

    public function testDeleteItemSuccess()
    {
        $contact = factory(Contact::class)->create();
        $this->assertEquals(1, Contact::count());

        $this->json('delete', action('ContactsController@destroy', $contact->id))
            ->assertStatus(200)
            ->assertSee(
                json_encode([
                    'status'=>$this->success['status'],
                    'message'=>$this->success['message'],
                    'data'=> true
                ])
            );
    }
}
