<?php

namespace App\Http\Controllers\Staff\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Ticket\TicketRequest;
use App\Http\Requests\Staff\Ticket\TicketReplyRequest;
use App\Models\Staff\Ticket\Ticket;
use App\Models\Staff\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function __construct() {
        $this->middleware(['direct_permission:ticket.view'])->only('index', 'show');
        $this->middleware(['direct_permission:ticket.create'])->only('store');
        $this->middleware(['direct_permission:ticket.update'])->only('update');
        $this->middleware(['direct_permission:ticket.delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_size = $request->filled('page_size') ? $request->page_size : config('constants.default_page_size');
        $tickets = Ticket::paginate($page_size);
        return $tickets;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketRequest $request)
    {
        $ticket = Ticket::create($request->validated());
        $ticket->load(['department', 'status', 'business', 'replies']);

        return $ticket;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);

        $ticket->load(['department', 'status', 'business', 'replies']);

        return $ticket;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(TicketRequest $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $ticket->update($request->validated());
        $ticket->load(['department', 'status', 'business', 'replies']);
        
        return $ticket;
    }

    /**
     * Close the ticket.
     *
     * @param  \App\Http\Requests\TicketRequest  $request
     * @param  \App\Models\Business  $business
     * @param  \App\Models\BusinessServicePrice  $servicePrice
     * @return \Illuminate\Http\Response
     */
    public function close(TicketRequest $request, Ticket $ticket)
    {
        $ticket->update([
            'ticket_status_id' => 4
        ]);

        $ticket->load(['department', 'status', 'business', 'replies']);

        return $ticket;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);

        $ticket->delete();

        return $ticket;
    }
}
