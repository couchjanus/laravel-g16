<?php

namespace App\Http\Controllers\Admin;
use App\Invitation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationMail;

class InvitationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invitations = Invitation::where('registered_at', null)->orderBy('created_at', 'desc')->get();
        $title = 'Invitation Requests';
        return view('admin.invitations.index', compact('title', 'invitations'));
    }

    public function sendInvite(Request $request, $id)
    {
        $invite = Invitation::findOrFail($id);
        
        $url = $invite->getLink();
        $email = $invite->email;

        Mail::to($email)->send(new InvitationMail($url));
        return redirect()->route('admin.showInvitations')->with('success','Invitation Sended Successfully.');
    }
}
