<?php

namespace App\Events;

use App\Competition;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ECompetitionScoreUpdate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var Competition $competition  Competicion de la que se extraeran datos*/
    private $idCompetition;

    /** @var Array $competitionScore Arreglo de Equipos con posicion puntuacion y orden*/
    public $competition;
    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct($idCompetition)
    {
        $this->idCompetition=$idCompetition;
        $this->competition=Competition::scoreboard($idCompetition);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel("Copetition.ScoreBoard.{$this->idCompetition}");
    }
}
