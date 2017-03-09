<?php

namespace App\Http\Controllers\Frontend\Unit;

use App\Models\Unit\Paperwork;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaperworkController extends Controller
{
    public function showPaperwork($id)
    {
        $paperwork = Paperwork::findOrFail($id);

        switch ($paperwork->type){
            case 'training':
                break;
            case 'file-correction':
                break;
            case 'loa-request':
                break;
            case 'assignment-change':
                break;
            case 'bad-conduct':
                break;
            case 'discharge':
                break;

        }
    }
}
