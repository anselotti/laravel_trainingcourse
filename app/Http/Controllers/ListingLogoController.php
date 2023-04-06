<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ListingLogoController extends Controller
{
    public function deleteLogo($id)
    {
        $listing = Listing::findOrFail($id);
        Storage::delete($listing->logo);
        $listing->logo = null;
        $listing->save();

        return redirect()->back()->with('message', 'Logo deleted successfully');
    }
}
