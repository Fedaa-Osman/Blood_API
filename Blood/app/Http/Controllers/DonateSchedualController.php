<?php

namespace App\Http\Controllers;

use App\Models\donate_schedual;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Spatie\FlareClient\Http\Response as HttpResponse;
use Symfony\Component\CssSelector\Parser\Reader;
use Symfony\Component\HttpFoundation\Response;

class DonateSchedualController extends Controller
{
    public function __construct()
    {
        $this->middleware('blood.compare')->only('store');
    }

    public function index()
    {
        $donate_schedual = donate_schedual::with('user','blood_type')->get();
        return response()->json ([
            "message" => "Fetch data done",
            "data" => $donate_schedual,
        ],Response::HTTP_ACCEPTED);
    }

    public function store(Request $request)
    {
        $request->validate([
                'user_id' => "required|exists:users,id",
                'amount' => "required|min:1|integer",
                'blood_type_id' => "required|exists:blood_types,id",
                'verified' => "nullable",
        ]);

        $donate_schedual = donate_schedual::create([
                'user_id'=> $request->user_id,
                'amount' => $request->amount,
                'blood_type_id' => $request->blood_type_id,
                'verified' => false,
        ]);

        return response()->json ([
            "message" => "Created Succefully",
            "data" => $donate_schedual,
        ],Response::HTTP_FORBIDDEN);
    }

    public function show($schedual_id)
    {
        $schedual = donate_schedual::where('id','=',$schedual_id)->with('user','blood_type')->get();
        return response()->json ([
            "message" => "Fetch data",
            "data" => $schedual,
        ],Response::HTTP_ACCEPTED);
    }

    public function update(Request $request,$donate_schedual)
    {
        $request->validate([
            'amount' => "required|min:1|integer",
    ]);

        donate_schedual::where('id','=',$donate_schedual)->with('user','blood_type')->update([
            "amount" => $request->amount
        ]);
        return response()->json ([
            "message" => "Data Updated",
        ],Response::HTTP_ACCEPTED);
    }


    public function destroy(donate_schedual $donate_schedual)
    {
        //
    }
}
