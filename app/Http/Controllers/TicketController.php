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
    public function index()
    {
        $tickets = Ticket::with(['project', 'user', 'comments'])->get();

        return response()->json($tickets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return response()->json($ticket);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
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
