<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\NewLeadMessageMD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\Lead;

class LeadController extends Controller
{


    public function store(Request $request)
    {

        return response()->json([
            'seccess' => true,
            'data' => $request->all(),
        ]);

        // validate

        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        // reutrn response json with error the validator fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        // create Lead
        $new_lead = new Lead();


        // send the email
        Mail::to('mattemutti@gmail.com')->send(new NewLeadMessageMD($new_Lead));

        // return the response

        return response()->json([
            'success' => true,
            'message' => 'Il tuo messaggio è stato inviato con successo',
        ]);


    }

}
