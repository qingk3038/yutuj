<?php

namespace App\Events;

use App\Models\Travel;
use Illuminate\Queue\SerializesModels;

class TravelStatusChange
{
    use SerializesModels;

    public $travel;

    public function __construct(Travel $travel)
    {
        $this->travel = $travel;
    }
}