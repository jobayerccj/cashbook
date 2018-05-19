<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cashflow;
use Validator;

class CashflowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         //$this->middleware('auth');
     }

    public function index()
    {
      $data['cashflow_list'] = Cashflow::orderBy('id', 'desc')->get();
      $data['balance'] = 0;
      return view('cashbook.list', $data);
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
      $validator = Validator::make($request->all(), [
            'name' => 'required',
            'amount' => 'required',
            'flow_type' => 'required'
        ]);

        if($validator->fails()){
            $data['success'] = false;
            $data['message'] = $validator->errors();
            echo json_encode($data);
        }
        else{
            //add new cashbook entry
            Cashflow::create([
                    'name' => $request['name'],
                    'amount' =>   $request['amount'],
                    'flow_type' => $request['flow_type'],
                    'description' => $request['description'],
            ]);

            $data['success'] = true;
            $data['message'] = "New entry named <b>".$request['name']."</b> successfully added in cashbook";
            echo json_encode($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
