<?php

namespace App\Http\Controllers\Backend\Unit;

use App\Models\Unit\Paperwork;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaperworkController extends Controller
{
    public function index()
    {
        $paperwork = Paperwork::all();
        return view('backend.paperwork.index',['paperwork' => $paperwork]);
    }

    public function show($id)
    {
        $paperwork = Paperwork::findOrFail($id);
        $pretty = $this->prettyPrint($paperwork->paperwork);
        return view('backend.paperwork.quickview',['paperwork' => $paperwork,'jsonDump' => $pretty]);
    }

    public function showProgramCompletionForm()
    {
        return view('backend.paperwork.program-completion.new');
    }

    public function storeProgramCompletionForm(Request $request)
    {
        $form = collect($request->except('_token'));
        $paperwork = \Auth::User()->member->paperwork()->create(['type'=>'discharge','paperwork'=> $form->toJson()]);
        flash('Discharge Application has been filed, we will notify you via email.', 'success');
        return redirect(route('frontend.files.my-file'));
    }

    public function reviewFlightPlan(Request $request)
    {

    }

    private function prettyPrint( $json )
    {
        $result = '';
        $level = 0;
        $in_quotes = false;
        $in_escape = false;
        $ends_line_level = NULL;
        $json_length = strlen( $json );

        for( $i = 0; $i < $json_length; $i++ ) {
            $char = $json[$i];
            $new_line_level = NULL;
            $post = "";
            if( $ends_line_level !== NULL ) {
                $new_line_level = $ends_line_level;
                $ends_line_level = NULL;
            }
            if ( $in_escape ) {
                $in_escape = false;
            } else if( $char === '"' ) {
                $in_quotes = !$in_quotes;
            } else if( ! $in_quotes ) {
                switch( $char ) {
                    case '}': case ']':
                    $level--;
                    $ends_line_level = NULL;
                    $new_line_level = $level;
                    break;

                    case '{': case '[':
                    $level++;
                    case ',':
                        $ends_line_level = $level;
                        break;

                    case ':':
                        $post = " ";
                        break;

                    case " ": case "\t": case "\n": case "\r":
                    $char = "";
                    $ends_line_level = $new_line_level;
                    $new_line_level = NULL;
                    break;
                }
            } else if ( $char === '\\' ) {
                $in_escape = true;
            }
            if( $new_line_level !== NULL ) {
                $result .= "\n".str_repeat( "\t", $new_line_level );
            }
            $result .= $char.$post;
        }

        return $result;
    }
}
