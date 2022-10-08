<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
class InboxController extends Controller
{
    //All Inbox
    public function index(Request $request)
    {
        Gate::authorize('app.inbox.index');
        $contacts = Contact::filter()->latest()->paginate(10)->appends($request->query());
        return Inertia::render('Backend/Inbox/Index',['contacts' => $contacts]);
    }
 
    //Show Single Inbox
    public function show(Contact $contact)
    {
        Gate::authorize('app.inbox.update');
        $contact->update(['status'=>'1']);
        return Inertia::render('Backend/Inbox/Show',[
            'contact' => $contact
        ]);
    }
 
    //Delete Inbox
    public function destroy(Contact $contact)
    {
        Gate::authorize('app.inbox.delete');
        $contact->delete();
        return back()->with('success','Message deleted');
    }
}
