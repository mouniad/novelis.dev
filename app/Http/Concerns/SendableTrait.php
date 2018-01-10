<?php
namespace App\Http\Concerns;

trait SendableTrait
{
    public function send($data, $successMessage = "Success", $failMessage = "Nothing found")
    {
        if ($data && count($data)>0) {
            $message = $successMessage;
            $status = true;
        }

        else {
            $message = $failMessage;
            $status = false;
        }
        return response()->json(compact('status', 'message', 'data'), 200, [], 0);
    }
}
