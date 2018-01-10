<?php

namespace App\Http\Controllers;

use App\GroupContact;
use App\Http\Concerns\SendableTrait;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    use SendableTrait;

    /**
     * @return ResponseFactory|Response
     */
    public function all()
    {
        $data = GroupContact::orderBy('active', 'desc')->get();
        return $this->send($data);
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     */
    public function item($id)
    {
        $data = GroupContact::find($id);
        return $this->send($data);
    }

    /**
     * @param Request $request
     * @return ResponseFactory|Response
     */

    public function store(Request $request)
    {
        $group = GroupContact::create($request->except('_token'));
        $group = GroupContact::find($group->id);
        return $this->send($group);
    }

    /**
     * @param Request $request
     * @param $id
     * @return ResponseFactory|Response
     */
    public function update(Request $request, $id)
    {
        $group = GroupContact::findOrFail($id);
        $group->update($request->except('_token'));
        return $this->send($group);
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     */
    public function destroy($id)
    {
        GroupContact::destroy($id);
        return $this->send(true);
    }
}
