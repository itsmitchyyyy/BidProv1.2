<?php

namespace App\Events;

// use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
// use Illuminate\Broadcasting\PrivateChannel;
// use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ReportEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $seeker_id;
    public $bidder_id;
    public $message;
    public $report_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($seeker_id,$bidder_id,$message,$report_id)
    {
        //
        $this->seeker_id = $seeker_id;
        $this->bidder_id = $bidder_id;
        $this->message = $message;
        $this->report_id = $report_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
        return ['report-notify'];
    }
}
