<?php namespace App\Repositories\Frontend\Unit\Teamspeak;

use App\Exceptions\GeneralException;
use App\Models\Unit\Member;
use App\User;
use App\Teamspeak as TeamspeakModel;
use TeamSpeak3;
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

        try {
            $this->ts = TeamSpeak3::factory('serverquery://' . $user . ':' . $pass . '@' . $ip . ':10011/?server_port=' . $port);

        } catch (\TeamSpeak3_Exception $e) {
            $this->ts = null;
        }

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
        foreach ($uuids as $uid) {
            try {
                $user = $this->ts->clientFindDb($uid->uuid, true);
                $currentGroups = collect($this->ts->clientGetServerGroupsByDbid($user));
                //Remove ignore groups that need to be ignored (push to talk, etc)
                foreach ($groupsNo as $ignore) {
                    $currentGroups->forget($ignore);
                }
                //Deal with default group
                if ($currentGroups->contains('sgid', 8))
                    $currentGroups->forget(8);
                $currentGroups = $currentGroups->keys();
                //Find groups that need to be added
                $add = $groups->diff($currentGroups);
                $remove = $currentGroups->diff($groups);
                // Remove Groups
                foreach ($remove as $group) {
                    $this->ts->serverGroupClientDel($group, $user);
                }
                // Add Groups
                foreach ($add as $group) {
                    $this->ts->serverGroupClientAdd($group, $user);
                }
            } catch (\TeamSpeak3_Exception $e) {
                return collect(['success' => false, 'message' => $e->getCode() . ' - ' . $e->getMessage()]);
            }
        }
        return collect(['success' => true, 'message' => 'Teamspeak update successful.']);
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
        try {
            $user = $this->ts->clientFindDb($uuid, true);
            $currentGroups = collect($this->ts->clientGetServerGroupsByDbid($user));
            if ($currentGroups->contains('sgid', 8))
                $currentGroups->forget(8);
            $currentGroups = $currentGroups->keys();
            foreach ($currentGroups as $group) {
                $this->ts->serverGroupClientDel($group, $user);
            }
        } catch (\TeamSpeak3_Exception $e) {
            return collect(['success' => false, 'message' => $e->getCode() . ' - ' . $e->getMessage()]);
        }
        return collect(['success' => true, 'message' => 'Teamspeak update successful.']);
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
}