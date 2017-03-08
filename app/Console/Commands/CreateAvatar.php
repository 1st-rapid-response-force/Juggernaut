<?php

namespace App\Console\Commands;

use App\Models\Unit\Member;
use App\User;
use Illuminate\Console\Command;

class CreateAvatar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:avatar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates all avatar images';

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
        $membersAvatars = '/avatars/members';
        //Destroy all images
        \Storage::disk('images')->deleteDirectory($membersAvatars);
        \Storage::disk('images')->makeDirectory($membersAvatars);

        Member::chunk(10, function ($vpfs) {
            foreach ($vpfs as $vpf) {
                $images = public_path().'/img/avatars/';
                $membersAvatars = '/img/avatars/members/';
                $random_string = str_random();
                $user = User::find($vpf->user->id);
                $user->member->avatar = $membersAvatars.$random_string.'.png';
                $user->push();
                if(isset($user))
                {
                    if(!isset($user->member->rank->image))
                    {
                        $rankImg = \Image::canvas(1, 1);
                    } else {
                        $rank = \Image::make(public_path().$user->member->rank->image)->widen(112)->heighten(110);
                        $rankImg = \Image::make($rank);
                    }
                    $img = \Image::canvas(160,160)
                        ->insert($images.'background.png')
                        ->insert($rankImg,'center',0,28)
                        ->save($images.'members/'.$random_string.'.png');
                }
            }
        });

    }
}
