<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;

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
        $id = $request->input('id');
        $name = $request->input('name');
        $from = $request->input('email');
        $headers = "From:" . $from;
        $msg = $request->input('msg');
        $to = Idea::find($id)->email;
        $to = 'm@osswald.li';
        $subject = Idea::find($id)->title;
        $message = "eLISA email from '" . $name . "'.\n\n" . $msg;
        mail($to,$subject,$message, $headers);
        $this->success();
    }

    public function success()
    {
        echo "Mail was sent.";
    }

}
