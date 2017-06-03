<?php

namespace App\Console\Commands;

use App\Models\Unit\Member;
use App\User;
use Illuminate\Console\Command;

class CreateCAC extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:cac';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates all CAC images on command run';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $membersFaces = '/faces/members';
        //Destroy all images
        \Storage::disk('images')->deleteDirectory($membersFaces);
        \Storage::disk('images')->makeDirectory($membersFaces);
        Member::chunk(10, function ($vpfs) {
            foreach ($vpfs as $vpf) {
                $user = User::find($vpf->user->id);
                $random_string = str_random();
                $faces_array = [
                    'default_face.png',
                    'athanasiadas.png',
                    'bahadur.png',
                    'baros.png',
                    'bayh.png',
                    'burr.png',
                    'byrne.png',
                    'campbell.png',
                    'christou.png',
                    'coburns.png',
                    'collins.png',
                    'constantinou.png',
                    'costas.png',
                    'dayton.png',
                    'dorgan.png',
                    'doukas.png',
                    'gikas.png',
                    'halliwell.png',
                    'hasan.png',
                    'jalai.png',
                    'jeoung.png',
                    'jesus.png',
                    'johnson.png',
                    'kenelloupou.png',
                    'kelly.png',
                    'kirby.png',
                    'martinez.png',
                    'obrien.png',
                    'oconnor.png',
                    'osullivan.png',
                    'reed.png',
                    'sabet.png',
                    'santorum.png',
                    'savalas.png',
                    'smith.png',
                    'snowe.png',
                    'tung.png',
                    'walsh.png',
                    'williams.png',
                    'ximi.png',
                ];
                $images = public_path().'/img/faces/';
                $faces = '/img/faces/members/';
                $face=\Image::make($images.$faces_array[$user->member->face_id])->resize(106,139);
                // Create Image
                $img = \Image::canvas(223,340);
                $img->insert($images.'background.png');
                $img->insert($face,'top-left',13,16);
                // Name Field
                $img->text($user->last_name.',',15,175,function($font){
                    $images = public_path().'/img/faces/';
                    $font->file($images.'slc.ttf');
                    $font->size(16);
                });
                $img->text($user->first_name,15,190,function($font){
                    $images = public_path().'/img/faces/';
                    $font->file($images.'slc.ttf');
                    $font->size(16);
                });
                // Rank
                $img->text($user->member->rank->abbreviation,180,270,function($font){
                    $images = public_path().'/img/faces/';
                    $font->file($images.'slc.ttf');
                    $font->size(12);
                });
                $img->save($images.'members/'.$user->steam_id.'.png');
            }
        });
    }
}
