<?php

namespace App\Http\Controllers;

use App\Models\ExportTicket;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExportTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ExportTicket::paginate(20);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($storage_id, Request $request)
    {
        $storage_id = $request->from_storage_id;
        $to_storage_id = $request->to_storage_id;
        $auth = Auth::user();
        $data_json = json_encode($request->data);
        // return $data_json;
        $result =  ExportTicket::create(array_merge($request->all(), ['user_id' => $auth->id ?? 1, 'data' => $data_json]));
        $data_inven = json_decode($result->data);
        // return $data_inven;
        $inventory = Inventory::where("storage_id", $storage_id)->get();
        foreach ($data_inven as $key_data => $quantity_data) {
            $exist = Inventory::where("storage_id", $storage_id)->where('product_id', $key_data)->first();
            if ($exist) {
                $to_storage = Inventory::where("storage_id", $to_storage_id)->where('product_id', $key_data)->first();
                $exist->quantity +=  $quantity_data;
                $exist->save();
                $to_storage->quantity -=  $quantity_data;
                $to_storage->save();
            }
        }
        return $inventory;

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExportTicket  $exportTicket
     * @return \Illuminate\Http\Response
     */
    public function show(ExportTicket $exportTicket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExportTicket  $exportTicket
     * @return \Illuminate\Http\Response
     */
    public function edit(ExportTicket $exportTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExportTicket  $exportTicket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExportTicket $exportTicket)
    {
        $exportTicket->update($request->all());
        return ExportTicket::find($exportTicket->id_export_ticket);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExportTicket  $exportTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExportTicket $exportTicket)
    {
        return $exportTicket->delete();
        //
    }
}
