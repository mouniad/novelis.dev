<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Concerns\SendableTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactsController extends Controller
{
    use SendableTrait;

    /**
     * @return ResponseFactory|Response
     */
    public function all()
    {
        $data = Contact::orderBy('lastname', 'asc')->with(['emails', 'phones'])->get();
        return $this->send($data);
    }

    /**
     * @param $id
     *
     * @return ResponseFactory|Response
     */
    public function item($id)
    {
        $data = Contact::with(['emails', 'phones', 'group'])->find($id);
        return $this->send($data);
    }

    /**
     * @param Request $request
     *
     * @return ResponseFactory|Response
     */
    public function store(Request $request)
    {
        $emails = $request->get('emails');
        $phones = $request->get('phones');


        $data = Contact::create($request->except(['_token', 'emails', 'phones']));
        $data = Contact::find($data->id);
        if($emails){
            foreach ($emails as $email )
                $data->emails()->create($email);
        }
        if($phones){
        foreach ($phones as $phone )
            $data->phones()->create($phone);
        }


        return $this->send($data);
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return ResponseFactory|Response
     */
    public function update(Request $request, $id)
    {
        $item = Contact::findOrFail($id);
        $item->update($request->except(['_token', 'emails', 'phones']));
        return $this->send($item);
    }

    /**
     * @param $id
     *
     * @return ResponseFactory|Response
     */
    public function destroy($id)
    {
        $item = Contact::find($id);
        $item->emails()->delete();
        $item->phones()->delete();
        Contact::destroy($id);
        return $this->send(true);
    }
}
