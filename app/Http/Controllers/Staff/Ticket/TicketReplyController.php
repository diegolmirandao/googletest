<?php

namespace App\Http\Controllers\Staff\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Ticket\TicketReplyRequest;
use App\Models\Staff\Ticket\Ticket;
use App\Models\Staff\Ticket\TicketReply;

class TicketReplyController extends Controller
{
    public function __construct() {
        $this->middleware(['direct_permission:ticket_reply.create'])->only('store');
        $this->middleware(['direct_permission:ticket_reply.update'])->only('update');
        $this->middleware(['direct_permission:ticket_reply.delete'])->only('destroy');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TicketReplyRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function store(TicketReplyRequest $request, Ticket $ticket)
    {
        $ticket->replies()->create($request->validated());
        $ticket->load(['department', 'status', 'business', 'replies']);

        return $ticket;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TicketReplyRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @param  \App\Models\TicketReply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(TicketReplyRequest $request, Ticket $ticket, TicketReply $reply)
    {
        $reply->update($request->validated());
        $ticket->load(['department', 'status', 'business', 'replies']);

        return $ticket;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @param  \App\Models\TicketReply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket, TicketReply $reply)
    {
        $reply->delete();
        $ticket->load(['department', 'status', 'business', 'replies']);

        return $ticket;
    }
}
