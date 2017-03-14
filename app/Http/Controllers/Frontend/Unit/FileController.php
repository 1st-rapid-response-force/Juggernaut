<?php

namespace App\Http\Controllers\Frontend\Unit;

use App\Models\Unit\Member;
use App\Models\Unit\Perstat;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    public function getMyFile()
    {
        return view('frontend.file.my-file');
    }

    public function getFile($id)
    {
        $file = Member::findOrFail($id);
        return view('frontend.file.file',['member' => $file]);
    }
    /**
     * Shows Returns Face Selection Screen
     */
    public function showFaces()
    {
        $user = \Auth::user();
        $faces_array = [
            ['id'=> 0,'file'=>'/img/faces/'.'default_face.png','name' => 'Default Face'],
            ['id'=> 1,'file'=>'/img/faces/'.'athanasiadas.png','name' => 'Athanasiadas'],
            ['id'=> 2,'file'=>'/img/faces/'.'bahadur.png','name' => 'Bahadur'],
            ['id'=> 3,'file'=>'/img/faces/'.'baros.png','name' => 'Baros'],
            ['id'=> 4,'file'=>'/img/faces/'.'bayh.png','name' => 'Bayh'],
            ['id'=> 5,'file'=>'/img/faces/'.'burr.png','name' => 'Burr'],
            ['id'=> 6,'file'=>'/img/faces/'.'byrne.png','name' => 'Byrne'],
            ['id'=> 7,'file'=>'/img/faces/'.'campbell.png','name' => 'Campbell'],
            ['id'=> 8,'file'=>'/img/faces/'.'christou.png','name' => 'Christou'],
            ['id'=> 9,'file'=>'/img/faces/'.'coburns.png','name' => 'Coburns'],
            ['id'=> 10,'file'=>'/img/faces/'.'collins.png','name' => 'Collins'],
            ['id'=> 11,'file'=>'/img/faces/'.'constantinou.png','name' => 'Constantinou'],
            ['id'=> 12,'file'=>'/img/faces/'.'costas.png','name' => 'Costas'],
            ['id'=> 13,'file'=>'/img/faces/'.'dayton.png','name' => 'Dayton'],
            ['id'=> 14,'file'=>'/img/faces/'.'dorgan.png','name' => 'Dorgan'],
            ['id'=> 15,'file'=>'/img/faces/'.'doukas.png','name' => 'Doukas'],
            ['id'=> 16,'file'=>'/img/faces/'.'gikas.png','name' => 'Gikas'],
            ['id'=> 17,'file'=>'/img/faces/'.'halliwell.png','name' => 'Halliwell'],
            ['id'=> 18,'file'=>'/img/faces/'.'hasan.png','name' => 'Hasan'],
            ['id'=> 19,'file'=>'/img/faces/'.'jalai.png','name' => 'Jalai'],
            ['id'=> 20,'file'=>'/img/faces/'.'jeoung.png','name' => 'Jeoung'],
            ['id'=> 21,'file'=>'/img/faces/'.'jesus.png','name' => 'Jesus'],
            ['id'=> 22,'file'=>'/img/faces/'.'johnson.png','name' => 'Johnson'],
            ['id'=> 23,'file'=>'/img/faces/'.'kanelloupou.png','name' => 'Kenelloupou'],
            ['id'=> 24,'file'=>'/img/faces/'.'kelly.png','name' => 'Kelly'],
            ['id'=> 25,'file'=>'/img/faces/'.'kirby.png','name' => 'Kirby'],
            ['id'=> 26,'file'=>'/img/faces/'.'martinez.png','name' => 'Martinez'],
            ['id'=> 27,'file'=>'/img/faces/'.'obrien.png','name' => 'O\'Brian'],
            ['id'=> 28,'file'=>'/img/faces/'.'oconnor.png','name' => 'O\'Connor'],
            ['id'=> 29,'file'=>'/img/faces/'.'osullivan.png','name' => 'O\'Sullivan'],
            ['id'=> 30,'file'=>'/img/faces/'.'reed.png','name' => 'Reed'],
            ['id'=> 31,'file'=>'/img/faces/'.'sabet.png','name' => 'Sabet'],
            ['id'=> 32,'file'=>'/img/faces/'.'santorum.png','name' => 'Santorum'],
            ['id'=> 33,'file'=>'/img/faces/'. 'savalas.png','name' => 'Savalas'],
            ['id'=> 34,'file'=>'/img/faces/'.'smith.png','name' => 'Smith'],
            ['id'=> 35,'file'=>'/img/faces/'.'snowe.png','name' => 'Snowe'],
            ['id'=> 36,'file'=>'/img/faces/'.'tung.png','name' => 'Tung'],
            ['id'=> 37,'file'=>'/img/faces/'.'walsh.png','name' => 'Walsh'],
            ['id'=> 38,'file'=>'/img/faces/'.'williams.png','name' => 'Williams'],
            ['id'=> 39,'file'=>'/img/faces/'.'ximi.png','name' => 'Ximi'],
        ];

        return view('frontend.file.faces')
            ->with('user',$user)
            ->with('faces',$faces_array);
    }

    /**
     * Saves User Selection
     */
    public function saveFace(Request $request)
    {
        $user = \Auth::user();
        $user->member->face_id = $request->face_id;
        $user->push();
        \Artisan::call('member:cac');

        flash('You have updated your ARMA face.', 'success');
        return redirect()->back();
    }

    public function reportIn(Request $request)
    {
        $user = \Auth()->user();
        $perstat = Perstat::where('active','=','1')->first();
        $user->member->perstat()->attach($perstat->id);
        \Log::info('User has reported in', ['user'=> [$user->id,$user->email,$user->member->position,$user->member->group_id]]);
        flash('Your report in has been filed. Make sure to report in weekly.','success');
        return redirect()->back();

    }

}
