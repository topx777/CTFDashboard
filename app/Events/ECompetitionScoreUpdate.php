<?php

namespace App\Events;

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
    private $competition;

    /** @var Array $competitionScore Arreglo de Equipos con posicion puntuacion y orden*/
    public $competitionScore;
    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct($competition)
    {
        $this->competition=$competition;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel("Copetition.ScoreBoard.{$this->competition->id}");
    }
}
