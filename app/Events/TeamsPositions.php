<?php

namespace App\Events;

use App\Team;
use App\TeamChallenge;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TeamsPositions implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $teams;
    public function __construct()
    {
        $teams=Team::orderBy('score', 'desc')->get();
        $teamObj=[];
        foreach ($teams as $key => $team) {
            $teamObj[$key]=$team;
            $teamObj[$key]->flag=TeamChallenge::where('finish', true)->where('idTeam',$team->id)->count();
        }

        $this->teams=$teamObj;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('scoreBoard');
    }
}
