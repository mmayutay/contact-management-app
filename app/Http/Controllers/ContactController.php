<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::where('created_by_id', auth()->user()->id)->get();

        return Inertia::render('Contact', [
            'contacts' => $contacts
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        $validated['created_by_id'] = auth()->user()->id;

        Contact::create($validated);
        
        return redirect('/contacts');
        
    }
    
    public function update(Request $request, Contact $contact)
    {
        $validated = $this->validateRequest($request);

        $contact->update($validated);

        return redirect('/contacts');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect('/contacts');
    }

    private function validateRequest(Request $request) {
        return $request->validate([
            'name' => ['required'],
            'company' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
        ]);
    }
}
