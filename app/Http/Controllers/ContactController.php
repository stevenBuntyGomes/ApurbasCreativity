<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Resources\ContactCollection as ContactCollection;
use App\Http\Resources\Contact as ContactResource;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function storeContact(Request $request){
        $request->validate([
            'contact_name' => 'required',
            'contact_email' => 'required',
            'contact_description' => 'required',
        ]);

        Contact::create([
            'contact_name' => $request->contact_name,
            'contact_email' => $request->contact_email,
            'contact_description' => $request->contact_description,
        ]);

        return back()->with('success', 'Thank you for contacting us.');

    }


    public function getContacts(){
        $contactCount = Contact::all();
        if($contactCount->count() > 1){
            $contacts = Contact::orderBy('id', 'desc')->get();
            return new ContactCollection($contacts);
        }else{
            $contacts = Contact::all();
            return new ContactCollection($contacts);
        }
    }

    public function deleteContact(){
        $data = request()->validate([
            'contact_id' => 'required',
        ]);

        Contact::where('id', $data['contact_id'])->delete();

        return response()->json('done');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
