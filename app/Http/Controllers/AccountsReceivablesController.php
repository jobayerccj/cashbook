<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\AccountsReceivableRequest;
use App\AccountsReceivableModel;
use App\PartyModel;
use App\AccountsModel;
use DB;

class AccountsReceivablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $accountsReceivables = DB::table('tbl_accounts_receivables')
            ->join('tbl_parties', 'tbl_accounts_receivables.party_id', '=', 'tbl_parties.party_id')
            ->select('tbl_accounts_receivables.*', 'tbl_parties.party_name')
            ->paginate(5);

        //$accountsReceivables = AccountsReceivableModel::orderBy('created_at', 'asc')->paginate(1);
        return view('AccountsReceivables.index', ['accountsReceivables' => $accountsReceivables]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $parties = PartyModel::pluck('party_name', 'party_id');
        $account_debited = AccountsModel::pluck('accounts_title', 'accounts_id');

        $date_default = "";

        return view('AccountsReceivables.add', ['parties' => $parties, 'account_debited' => $account_debited, 'date_default' => $date_default]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountsReceivableRequest $request)
    {
        AccountsReceivableModel::create($request->all());
        return redirect('accountsReceivables');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $accountsReceivable = DB::table('tbl_accounts_receivables')
            ->join('tbl_parties', 'tbl_accounts_receivables.party_id', '=', 'tbl_parties.party_id')
            ->where('tbl_accounts_receivables.id',$id)
            ->select('tbl_accounts_receivables.*', 'tbl_parties.party_name')
            ->get();
            

        return view('accountsReceivables.show', ['accountsReceivable' => $accountsReceivable]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $parties = PartyModel::pluck('party_name', 'party_id');
        $account_debited=[
            ' ' =>'Select Accounts Type',
            '1'=>'Assets',
            '2'=>'Liabilities',
            '3'=>'Income',
            '4'=>'Expense',
            '5'=>'Capital'
        ];

        $accountsReceivable = AccountsReceivableModel::findOrFail($id);

        $date_default = $accountsReceivable->expected_receieving_date;

        return view('accountsReceivables.edit', ['accountsReceivable' => $accountsReceivable, 'parties' => $parties, 'account_debited' => $account_debited, 'date_default' => $date_default]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccountsReceivableRequest $request, $id)
    {
        $accountsReceivable = AccountsReceivableModel::findOrFail($id);
        $accountsReceivable->update($request->except(['_token', '_method']));

        return redirect('accountsReceivables');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $party = AccountsReceivableModel::findOrFail($id);

        $party->delete();
        return redirect('accountsReceivables');
    }
}
