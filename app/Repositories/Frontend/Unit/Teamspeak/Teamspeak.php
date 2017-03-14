<?php namespace App\Repositories\Frontend\Unit\Teamspeak;

use App\Exceptions\GeneralException;
use App\Models\Unit\Member;
use App\User;
use App\Teamspeak as TeamspeakModel;
use ts3admin;
/**
 * Class Teamspeak
 * @package App\Modules\Teamspeak
 */
class Teamspeak implements TeamspeakContract
{

    /**
     * Teamspeak factory implementation
     */
    protected $ts;
    public function __construct()
    {
        $ip = env('TEAMSPEAK_IP', '127.0.0.1');
        $port = env('TEAMSPEAK_PORT', '9987');
        $user = env('TEAMSPEAK_USER_NAME', 'ts3');
        $pass = env('TEAMSPEAK_PASSWORD', 'password');

        $this->ts = new \ts3admin($ip, 10011);
        $this->ts->connect();
        $this->ts->login($user,$pass);
        $this->ts->selectServer($port);

    }
    /**
     * Updates the teamspeak server based on user
     * @return \Illuminate\Support\Collection
     */
    public function update($user)
    {
        // Establish teamspeak array
        $groups = collect();
        $groupsNo = collect([37]);
        $add = collect();
        $remove = collect();
        if ($user->member->rank->id >= 2) {
            $groups->push(9);
            $groups->push($user->member->rank->teamspeak_id);

            //Admin Check - Rod and Striker and Oges
            if (($user->id == 1) || ($user->id == 2) || ($user->id == 3))
                $groups->push(6);
        } else {
            $groups->push(38);
        }


        //Lets begin
        $uuids = $user->member->teamspeak;
        try {
            foreach ($uuids as $uid) {
                $user = $this->ts->clientDbFind($uid->uuid, true);
                $currentGroupsRequest = collect($this->ts->serverGroupsByClientID($user['data'][0]['cldbid']));
                $currentGroups = collect();

                foreach ($currentGroupsRequest['data'] as $severgroup)
                {
                    $currentGroups->push($severgroup['sgid']);
                }

                // Remove items that are in the ignore list
                $currentGroups = $currentGroups->reject(function($value, $key) use ($groupsNo) {
                    if($groupsNo->contains($value))
                        return true;
                });


                //Find groups that need to be added
                $add = $groups->diff($currentGroups);

                $remove = $currentGroups->diff($groups);

                // Remove Groups
                foreach ($remove as $group) {
                    $this->ts->serverGroupDeleteClient($group, $user['data'][0]['cldbid']);
                }
                // Add Groups
                foreach ($add as $group) {
                    $this->ts->serverGroupAddClient($group, $user['data'][0]['cldbid']);
                }
            }
            return collect(['success' => true, 'message' => 'Teamspeak update successful.']);
        } catch (\ErrorException $e) {
            return collect(['success' => false,'error' => true, 'message' => 'Unable to add Teamspeak UUID, please verify unique id']);
        }



    }
    public function message($user, $message)
    {
        //Lets begin
        $uuids = $user->member->teamspeak;
        foreach ($uuids as $uid) {
            try {
                $user = $this->ts->clientGetByUid($uid->uuid, true);
                $user->message($message);
            } catch (\TeamSpeak3_Exception $e) {
                // Ignore the error and continue
            }
        }
        return collect(['success' => true, 'message' => 'Message sent to all TS Clients that user has on file successful.']);
    }
    public function announce($message)
    {
        $this->ts->message($message);
    }
    /**
     * Removes all groups from UUID
     * @param $uuid
     * @return \Illuminate\Support\Collection
     */
    public function delete($uuid)
    {
        $user = $this->ts->clientDbFind($uuid, true);
        $currentGroupsRequest = collect($this->ts->serverGroupsByClientID($user['data'][0]['cldbid']));
        $currentGroups = collect();

        try {
            foreach ($currentGroupsRequest['data'] as $severgroup)
            {
                $currentGroups->push($severgroup['sgid']);
            }


            foreach ($currentGroups as $group) {
                $this->ts->serverGroupDeleteClient($group, $user['data'][0]['cldbid']);
            }
            return collect(['success' => true, 'message' => 'Teamspeak update successful.']);
        } catch (\ErrorException $e) {
            return collect(['success' => false,'error' => true, 'message' => $e]);
        }



    }
    public function ban($user)
    {
        // Establish teamspeak array
        $groups = collect();
        $remove = collect();
        //Lets begin
        $uuids = $user->member->teamspeak;
        foreach ($uuids as $uid) {
            try {
                $user = $this->ts->clientFindDb($uid->uuid, true);
                $currentGroups = collect($this->ts->clientGetServerGroupsByDbid($user));
                //Deal with default group
                if ($currentGroups->contains('sgid', 8))
                    $currentGroups->forget(8);
                $currentGroups = $currentGroups->keys();
                //Remove all groups
                $remove = $currentGroups;
                // Remove Groups
                foreach ($remove as $group) {
                    $this->ts->serverGroupClientDel($group, $user);
                }
                // Ban User
                $this->ts->banCreate(['uid'=>$uid->uuid],null,'Banned');
            } catch (\TeamSpeak3_Exception $e) {
                return collect(['success' => false, 'message' => $e->getCode() . ' - ' . $e->getMessage()]);
            }
        }
        return collect(['success' => true, 'message' => 'Teamspeak update successful.']);
    }
    public function tsviewer()
    {
        return $this->ts->getViewer(new \TeamSpeak3_Viewer_Html("/images/viewericons/", "/images/flags/", "data:image"));
    }

    public function  __destruct() {
        //delete file
    }
}