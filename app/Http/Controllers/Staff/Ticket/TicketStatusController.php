<?php

namespace App\Http\Controllers\Staff\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Staff\Ticket\TicketStatus;
use Illuminate\Http\Request;

class TicketStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticketStatuses = TicketStatus::all();

        return $ticketStatuses;
    }
}
