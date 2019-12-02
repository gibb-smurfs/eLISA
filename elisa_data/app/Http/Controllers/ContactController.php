<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ContactController extends Controller
{
    public function __construct()
    {
    }

    public function contact($id)
    {
        $idea = Idea::with(['comments', 'ratings'])->find($id);
        return view('Contact', ['idea' => $idea]);
    }

    public function mailer(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric',
            'name' => 'required|max:40',
            'email' => 'required|email|max:60',
            'msg' => 'required|min:10|max:1000'
        ]);

        try {
            $id = $request->post('id');
            $name = $request->post('name');
            $from = $request->post('email');
            $headers = "From:" . $from;
            $msg = $request->input('msg');
            $to = Crypt::decrypt(Idea::find($id)->email);
            $subject = Idea::find($id)->title;
            $message = "eLISA email from '" . $name . "'.\n\n" . $msg;

            if (mail($to, $subject, $message, $headers))
                return response($id, 200);
            else throw new \ErrorException('Failed to send message');
        } catch (\Exception $ex) {
            return response()->json(['err' => ['Something went wrong.']], 500);
        }
    }
}
