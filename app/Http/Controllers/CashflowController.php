<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cashflow;
use Validator;
use PDF;
use Excel;
use App\Exports\CashflowExport;

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

            $current_balance = Cashflow::orderBy('id', 'DESC')->limit('1')->value('balance');

            $new_balance = $request['flow_type'] == 1 ? $current_balance += $request['amount'] : $current_balance -= $request['amount'];

            //add new cashbook entry
            Cashflow::create([
                    'name' => $request['name'],
                    'amount' =>   $request['amount'],
                    'flow_type' => $request['flow_type'],
                    'description' => $request['description'],
                    'balance' => $new_balance

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
    public function show($id)
    {   
        $data['detail'] = Cashflow::findorFail($id);

        echo view('cashbook.detail', $data)->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['detail'] = Cashflow::findorFail($id);

        echo view('cashbook.edit', $data)->render();
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'flow_type' => 'required'
        ]);

        if($validator->fails()){
            $data['success'] = false;
            $data['message'] = $validator->errors();
            echo json_encode($data);
        }
        else{

            //$cashflow = Cashflow::findorFail($id);

            //edit cashbook entry
            Cashflow::where('id', $request['id'])
                    ->update([
                        'name' => $request['name'],
                        'flow_type' => $request['flow_type'],
                        'description' => $request['description'],
                    ]);

            $data['success'] = true;
            $data['message'] = "Entry named <b>".$request['name']."</b> successfully updated";
            echo json_encode($data);
        }
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

    public function generate_pdf(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'start_from' => 'required|before_or_equal:'.$request['start_to'],
            'start_to' => 'required|after_or_equal:'.$request['start_from']
        ]);

        if($validator->fails()){
            $data['success'] = false;
            $data['message'] = $validator->errors();
            echo json_encode($data);
        }
        else{

            $data['cashflow_list'] = Cashflow::where('created_at', '>=', date("Y-m-d", strtotime($request['start_from'])))->where('created_at', '<=', date("Y-m-d", strtotime($request['start_to'])))
                ->orderBy('id', 'DESC')->get();

            
            $pdf = PDF::loadView('cashbook.pdf_report', $data);
            $file_name = 'monthly_report'.time().'.pdf';

            file_put_contents('./uploads/pdf/'.$file_name, $pdf->download($file_name)); 

            $data['success'] = true;
            $data['filename'] = $file_name;
            $data['message'] = 'Pdf successfully generated';
            echo json_encode($data);
        }
    }

    public function generate_excel() 
    {
        return Excel::download(new CashflowExport, 'cashflow.xlsx');
    }
}
