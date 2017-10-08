<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\AccountsModel;
use App\Http\Requests\AccountsRequest;
use Auth;

class AccountsController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //This method is for accounts titles listing
        $accounts_title = AccountsModel::orderBy('created_at','asc')->get();
        return view('accounts.accounts_title', ['accounts' => $accounts_title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //This is predefined accounts type according to accounting rules
        //passed to accounts title add page for populating dropdown list
        $accounts_type=[
        	' ' =>'Select Accounts Type',
        	'1'=>'Assets',
        	'2'=>'Liabilities',
        	'3'=>'Income',
        	'4'=>'Expense',
        	'5'=>'Capital'
        ];

        $account_sub_type=[
            ' ' =>'Select Accounts Subtype',
            '1'=>'Subtype 1',
            '2'=>'Subtype 2',
            '3'=>'Subtype 3',
        ];

        $ledger=[
            ' ' =>'Select Ledger',
            '1'=>'Ledger 1',
            '2'=>'Ledger 2',
            '3'=>'Ledger 3',
        ];

        return view('accounts.accounts_title_add', 
            [
            'accounts_type' => $accounts_type,
            'account_sub_type' => $account_sub_type,
            'ledger' => $ledger
            ]
            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountsRequest $request)
    {
        //
        $accounts=new AccountsModel();
        $accounts->accounts_title = $request['accounts_title'];
        $accounts->accounts_type = $request['accounts_type'];
        $accounts->account_sub_type = $request['account_sub_type'];
        $accounts->ledger = $request['ledger'];
        $accounts->save();
        return redirect('accounts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $accounts_type=[
        	' ' =>'Select Accounts Type',
        	'1'=>'Assets',
        	'2'=>'Liabilities',
        	'3'=>'Income',
        	'4'=>'Expense',
        	'5'=>'Capital'
        ];
        $accounts_edit=AccountsModel::where('accounts_id',$id)->firstOrFail();
        $data['accounts_type']=$accounts_type;
        $data['accounts_edit']=$accounts_edit;
        return view('accounts.accounts_title_edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccountsRequest $request, $id)
    {
        //
        $accounts=AccountsModel::find($id);
        $accounts->accounts_title=$request['accounts_title'];
        $accounts->accounts_type=$request['accounts_type'];
        $accounts->save();
        return redirect('accounts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
