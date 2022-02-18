<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($projectId)
    {
        $tickets = Ticket::with(['project', 'user', 'comments'])->where('project_id', $projectId)->get();

        return response()->json($tickets);
    }

    public function show($ticketId)
    {
        $ticket = Ticket::with(['project', 'user', 'comments'])->where('id', $ticketId)->first();

        return response()->json($ticket);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'       => 'required|max:100',
            'type'        => 'required',
            'status'      => 'required',
            'priority'    => 'required',
            'description' => 'required',
        ]);

        $ticket = Ticket::create([
            'title'       => $request->title,
            'type'        => $request->type,
            'status'      => $request->status,
            'priority'    => $request->priority,
            'description' => $request->description,
        ]);

        return response()->json($ticket, 201);
    }

    public function update(Request $request, Ticket $ticket)
    {
        $this->validate($request, [
            'title'       => 'required|max:100',
            'type'        => 'required',
            'status'      => 'required',
            'priority'    => 'required',
            'description' => 'required',
        ]);

        $ticket->update([
            'title'       => $request->title,
            'type'        => $request->type,
            'status'      => $request->status,
            'priority'    => $request->priority,
            'description' => $request->description,
        ]);

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return response()->json();
    }
}
