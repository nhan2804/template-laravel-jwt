<?php

namespace App\Http\Controllers;

use App\Models\ImportTicket;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImportTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ImportTicket::paginate(20);
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
    public function store(Request $request)
    {
        $storage_id = $request->from_store_id;
        $auth = Auth::user();
        $data_json = json_encode($request->data);
        // return $data_json;
        $result =  ImportTicket::create(array_merge($request->all(), ['user_id' => $auth->id ?? 1, 'data' => $data_json]));
        $data_inven = json_decode($result->data);
        // return $data_inven;
        $inventory = Inventory::where("storage_id", $storage_id)->get();
        foreach ($data_inven as $key_data => $quantity_data) {

            $exist = Inventory::where("storage_id", $storage_id)->where('product_id', $key_data)->first();
            if ($exist) {
                $exist->quantity +=  $quantity_data;
                $exist->save();
            } else {
                Inventory::create([
                    'product_id' => $key_data,
                    'storage_id' => $storage_id,
                    'quantity' => $quantity_data
                ]);
            }
            # code...
        }


        return $inventory;
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImportTicket  $importTicket
     * @return \Illuminate\Http\Response
     */
    public function show(ImportTicket $importTicket)
    {

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImportTicket  $importTicket
     * @return \Illuminate\Http\Response
     */
    public function edit(ImportTicket $importTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ImportTicket  $importTicket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImportTicket $importTicket)
    {
        $importTicket->update($request->all());
        return ImportTicket::find($importTicket->id_import_ticket);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImportTicket  $importTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImportTicket $importTicket)
    {
        return $importTicket->delete();
        //
    }
}
