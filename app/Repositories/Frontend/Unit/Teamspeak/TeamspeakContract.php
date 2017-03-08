<?php namespace App\Repositories\Frontend\Unit\Teamspeak;
/**
 * Interface TeamspeakContract
 * @package App\Repositories\Image
 */
interface TeamspeakContract {
    public function update($user);
    public function message($user,$message);
    public function announce($message);
    public function delete($uuid);
    public function ban($user);
    public function tsviewer();
}