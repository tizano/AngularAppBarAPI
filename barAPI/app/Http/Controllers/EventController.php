<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Event::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event;
        $event->event_name = $request->input('event_name');
        $event->event_picture = $request->input('event_picture');
        $event->event_address = $request->input('event_address');
        $event->event_city = $request->input('event_city');
        $event->event_date = $request->input('event_date');
        if ($event->save()) {
            return response()->json($event, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        if(!$event)
            return response()->json(array('error' => true), 400);
        else {
            return response()->json($event, 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        if(!$event)
            return response()->json(array('error' => true), 400);
        else {

            if ($event->update($request->all())) {
                return response()->json($event, 200);
            }
            else {
                return response()->json(array('error' => true), 400);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        if(!$event)
            return response()->json(array('error' => true), 400);
        else {
            $event->delete();
            return response()->json(null, 204);
        }
    }
}
