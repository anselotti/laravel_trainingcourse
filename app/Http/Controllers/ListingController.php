<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    //show all listings
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);

    }

    // show single lisitng
    public function show(Listing $listing) {

        return view('listings.show', [
            'listing' => $listing
        ]);

    }

     // show single lisitng
     public function create() {

        return view('listings.create');

    }

    // store lisitng data
    public function store(Request $request) {

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'

        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created succesfully!');
    }

    // Show edit form
    public function edit(Listing $listing) {

        return view('listings.edit', ['listing' => $listing]);

    }

    // update lisitng data
    public function update(Request $request, Listing $listing) {

        // make sure logged in user is owner

        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'

        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated!');
    }

    // Delete listing
    public function delete(Listing $listing) {

        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted succesfully!');

    }

    // Manage listing
    public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
    



}
