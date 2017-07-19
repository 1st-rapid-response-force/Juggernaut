<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Unit\Member;
use App\Models\Unit\Team;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AutoCompleteController extends Controller
{
    public function getMembers(Request $request)
    {
        $vpfs = Member::where('searchable_name', 'LIKE', '%'.$request->q.'%')->get();
        $results = collect();
        foreach ($vpfs as $vpf)
        {
            $rt = [
                'id' => $vpf->user->id,
                'text' => $vpf->searchable_name
            ];
            $results->push($rt);
        }
        return \Response::json(['results' => $results]);
    }

    public function getElements(Request $request)
    {
        $elements = Team::where('name', 'LIKE', '%'.$request->q.'%')->get();
        $results = collect();
        foreach ($elements as $element)
        {
            $rt = [
                'id' => $element->id,
                'text' => $element->name
            ];
            $results->push($rt);
        }
        return \Response::json(['results' => $results]);
    }
}
