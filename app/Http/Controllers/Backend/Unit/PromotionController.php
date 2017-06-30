<?php

namespace App\Http\Controllers\Backend\Unit;

use App\Models\Unit\Member;
use App\Models\Unit\Qualification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
    public function index()
    {
        // We need to determine if people are eligible to qualify and if they are push them to a collection
        $members = $this->generatePEL();
        return view('backend.unit.promotions.index',['files'=>$members]);


    }

    private function generatePEL()
    {
        $members = Member::active()->get();
        $pel = collect();
        foreach($members as $member)
        {
            // I am going to take the lazy mans approach and statically code this out.
            // Forgive me code gods

            switch($member->rank->id)
            {
                //PV1 -> PV2
                case 2:
                    $qualification = Qualification::whereName('Basic Infantry Training')->first();

                    // If they completed this, then push them to the PEL list
                    if($member->qualifications->contains($qualification->id))
                    {
                        $pel->push($member);
                    }
                    break;
                // PV2 -> PFC
                case 3:
                    if($member->time_in_service >= 7)
                    {
                        $pel->push($member);
                    }
                    break;
                //PFC -> SPC
                case 4:
                    if(($member->time_in_service >= 20) && ($member->qualifications->count() >= 2))
                    {
                        $pel->push($member);
                    }
                    break;
                //SPC -> CPL
                case 5:
                    $qualification = Qualification::whereName('Fire Team Leader')->first();
                    if(($member->time_in_service >= 28) && ($member->qualifications->contains($qualification->id)))
                    {
                        $pel->push($member);
                    }
                    break;
                // CPL -> SGT
                case 6:
                    if($member->time_in_service >= 35)
                    {
                        $pel->push($member);
                    }
                    break;
                // SGT -> SSG
                case 7:
                    $qualification = Qualification::whereName('Squad Leader')->first();
                    if(($member->time_in_service >= 56) && ($member->qualifications->contains($qualification->id)))
                    {
                        $pel->push($member);
                    }
                    break;
                // SSG -> SFC
                case 8:
                    $qualification = Qualification::whereName('Platoon Sergeant')->first();
                    if(($member->time_in_service >= 70) && ($member->qualifications->contains($qualification->id)))
                    {
                        $pel->push($member);
                    }
                    break;
                // SFC -> MSG
                case 9:
                    if($member->time_in_service >= 150)
                    {
                        $pel->push($member);
                    }
                    break;
                // SFC -> MSG
                case 10:
                    if($member->time_in_service >= 360)
                    {
                        $pel->push($member);
                    }
                    break;
                // WO1 -> CW2
                case 14:
                    $qualification = Qualification::whereName('Airframe Pilot')->first();
                    if(($member->qualifications->contains($qualification->id)))
                    {
                        $pel->push($member);
                    }
                    break;
                // CW2 -> CW3
                case 15:
                    $qualification = Qualification::whereName('Rotary Transport')->first();
                    $qualification2 = Qualification::whereName('Fixed-Wing Combat')->first();
                    if(($member->time_in_service >= 40) && ($member->qualifications->contains($qualification->id) || $member->qualifications->contains($qualification2->id)))
                    {
                        $pel->push($member);
                    }
                    break;
                // CW3 -> CW4
                case 16:
                    if(($member->time_in_service >= 56))
                    {
                        $pel->push($member);
                    }
                    break;
                // CW4 -> CW5
                case 17:
                    if(($member->time_in_service >= 70))
                    {
                        $pel->push($member);
                    }
                    break;

                // 2LT -> 1LT
                case 19:
                    if(($member->time_in_service >= 115))
                    {
                        $pel->push($member);
                    }
                    break;

                // 1LT -> CPT
                case 20:
                    if(($member->time_in_service >= 200))
                    {
                        $pel->push($member);
                    }
                    break;

                // CPT -> MAJ
                case 21:
                    if(($member->time_in_service >= 360))
                    {
                        $pel->push($member);
                    }
                    break;
            }

        }
        return $pel;
    }
}
