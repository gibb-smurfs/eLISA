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
            $idea_title = Idea::find($id)->title;
            $to = Crypt::decrypt(Idea::find($id)->email);

            \Illuminate\Support\Facades\Mail::to($to)
                ->send(
                    new \App\Mail\ContactRequestMail(
                        $request->post('msg'),
                        $request->post('name'),
                        $request->post('email'),
                        $idea_title,
                        $id
                    )
                );

            return response($id, 200);

        } catch (\Exception $ex) {
            return response()->json(['err' => ['Something went wrong.']], 500);
        }
    }
}
