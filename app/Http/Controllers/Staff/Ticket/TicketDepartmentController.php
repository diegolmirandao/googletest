<?php

namespace App\Http\Controllers\Staff\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Staff\Ticket\TicketDepartment;
use Illuminate\Http\Request;

class TicketDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticketDepartments = TicketDepartment::all();

        return $ticketDepartments;
    }
}
