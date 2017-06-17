<?php

namespace App\Http\Controllers\Frontend\Unit;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoadoutController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $loadout = $this->getLoadout();
        \Log::info('LOADOUT: User is viewing their loadout', ['user'=> [$user->id,$user->email]]);
        return view('frontend.loadout.index')
            ->with('user',$user)
            ->with('primary',$loadout[0])
            ->with('primary_attachments',$loadout[10])
            ->with('secondary',$loadout[1])
            ->with('secondary_attachments',$loadout[11])
            ->with('launcher',$loadout[2])
            ->with('launcher_attachments',$loadout[12])
            ->with('nightvision',$loadout[3])
            ->with('binoculars',$loadout[4])
            ->with('helmet',$loadout[5])
            ->with('goggles',$loadout[6])
            ->with('uniform',$loadout[7])
            ->with('vest',$loadout[8])
            ->with('backpack',$loadout[9])
            ->with('items',$loadout[13]);

    }

    public function saveLoadout(Request $request)
    {
        $user = \Auth::user();
        $loadout = collect([
            $request->primaryWeapon,
            $request->secondary,
            $request->launcherWeapons,
            $request->nightvision,
            $request->helmet,
            $request->goggles,
            $request->uniform,
            $request->vest,
            $request->backpack,
            $request->launcher_attachment,
        ]);


        $loadoutMerged = $loadout->merge($request->primary_attachment)->merge($request->secondary_attachment)->merge($request->items);
        $user->member->loadout()->sync($loadoutMerged->all());

        \Log::info('LOADOUT: User has changed their loadout', ['member'=> $user->member->searchable_name]);
        flash('Your loadout have been saved.','success');
        return redirect(route('frontend.loadout'));
    }

    public function getLoadoutAPI($uuid)
    {
        $user = User::where('steam_id','=', $uuid)->first();
        //If not user found
        if(!isset($user))
        {
            abort('404');
        }


        $loadout = collect();
        foreach($user->member->loadout()->where('empty','=',0)->get() as $item)
        {
            $loadout->push($item->class_name);
        }
        return response()->json($loadout->toArray());
    }

    /**
     * Returns a array object with all primary weapons formatted for ddslick display
     */
    public function getLoadout()
    {
        $user = \Auth::user();
        $currentLoadout = $user->member->loadout;
        $loadout_items = collect();
        foreach($user->member->qualifications as $qualification)
        {
            $loadout_items->push($qualification->loadoutItems);

        }
        $collapsed = $loadout_items->collapse();


        //Collection Trays
        $primary = collect();
        $secondary = collect();
        $launcher = collect();
        $uniform = collect();
        $vest = collect();
        $backpack = collect();
        $helmet = collect();
        $goggles = collect();
        $nightvision = collect();
        $binoculars = collect();
        $primary_attachments = collect();
        $secondary_attachments = collect();
        $launcher_attachments = collect();
        $items = collect();

        foreach($collapsed as $item)
        {
            //Sort Items based on category
            switch ($item->category) {
                case 'primary':
                    $primary->push($item);
                    break;
                case 'secondary':
                    $secondary->push($item);
                    break;
                case 'launcher':
                    $launcher->push($item);
                    break;
                case 'uniform':
                    $uniform->push($item);
                    break;
                case 'vest':
                    $vest->push($item);
                    break;
                case 'backpack':
                    $backpack->push($item);
                    break;
                case 'helmet':
                    $helmet->push($item);
                    break;
                case 'goggles':
                    $goggles->push($item);
                    break;
                case 'nightvision':
                    $nightvision->push($item);
                    break;
                case 'binoculars':
                    $binoculars->push($item);
                    break;
                case 'primary_attachments':
                    $primary_attachments->push($item);
                    break;
                case 'secondary_attachments':
                    $secondary_attachments->push($item);
                    break;
                case 'launcher_attachments':
                    $launcher_attachments->push($item);
                    break;
                case 'items':
                    $items->push($item);
                    break;
                default:
                    $items->push($item);
            }
        }

        // JSONIFY
        $loadout = collect();
        $loadout->push($this->formatLoadout($primary,$currentLoadout));  //0
        $loadout->push($this->formatLoadout($secondary,$currentLoadout)); //1
        $loadout->push($this->formatLoadout($launcher,$currentLoadout)); //2
        $loadout->push($this->formatLoadout($nightvision,$currentLoadout)); //3
        $loadout->push($this->formatLoadout($binoculars,$currentLoadout)); //4
        $loadout->push($this->formatLoadout($helmet,$currentLoadout)); //5
        $loadout->push($this->formatLoadout($goggles,$currentLoadout)); //6
        $loadout->push($this->formatLoadout($uniform,$currentLoadout)); //7
        $loadout->push($this->formatLoadout($vest,$currentLoadout)); //8
        $loadout->push($this->formatLoadout($backpack,$currentLoadout)); //9
        $loadout->push($this->formatLoadout($primary_attachments,$currentLoadout)); //10
        $loadout->push($this->formatLoadout($secondary_attachments,$currentLoadout)); //11
        $loadout->push($this->formatLoadout($launcher_attachments,$currentLoadout)); //12
        $loadout->push($this->formatLoadout($items,$currentLoadout)); //13


        return $loadout;
    }


    private function formatLoadout($source,$loadoutArray,$description = "Select an item")
    {
        $targetFormatted = collect();
        foreach($source as $item)
        {
            $equipped = false;
            //Check if item is in player loadout
            if($loadoutArray->contains($item->id)) $equipped=true;

            $col = collect([
                'text' => $item->name,
                'value' => $item->id,
                'selected'=>$equipped,
                'description'=>$description,
                'imageSrc'=> $item->getImage()
            ]);
            $targetFormatted->push($col);
        }
        return $targetFormatted;
    }
}
