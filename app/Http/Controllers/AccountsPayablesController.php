<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\AccountsPayableRequest;
use App\AccountsPayableModel;
use App\PartyModel;
use App\AccountsModel;
use DB;

class AccountsPayablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $accountsPayables = DB::table('tbl_accounts_payables')
            ->join('tbl_parties', 'tbl_accounts_payables.party_id', '=', 'tbl_parties.party_id')
            ->select('tbl_accounts_payables.*', 'tbl_parties.party_name')
            ->paginate(5);

        //$accountsReceivables = AccountsReceivableModel::orderBy('created_at', 'asc')->paginate(1);
        return view('AccountsPayables.index', ['accountsPayables' => $accountsPayables]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $parties = PartyModel::pluck('party_name', 'party_id');
        $parties->prepend('Select Party', '');
        $accounts_credited = AccountsModel::pluck('accounts_title', 'accounts_id');
        $accounts_credited->prepend('Select Account', '');
        $date_default = "";

        return view('AccountsPayables.add', ['parties' => $parties, 'accounts_credited' => $accounts_credited, 'date_default' => $date_default]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountsPayableRequest $request)
    {
        AccountsPayableModel::create($request->all());
        return redirect('accountsPayables');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $accountsPayable = DB::table('tbl_accounts_payables')
            ->join('tbl_parties', 'tbl_accounts_payables.party_id', '=', 'tbl_parties.party_id')
            ->where('tbl_accounts_payables.id',$id)
            ->select('tbl_accounts_payables.*', 'tbl_parties.party_name')
            ->get();
            

        return view('accountsPayables.show', ['accountsPayable' => $accountsPayable]);
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
        $accounts_credited = AccountsModel::pluck('accounts_title', 'accounts_id');
        $accounts_credited->prepend('Select Account', '');

        $accountsPayable = AccountsPayableModel::findOrFail($id);

        $date_default = $accountsPayable->expected_payments_date;

        return view('accountsPayables.edit', ['accountsPayable' => $accountsPayable, 'parties' => $parties, 'accounts_credited' => $accounts_credited, 'date_default' => $date_default]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccountsPayableRequest $request, $id)
    {   
        $accountsPayable = AccountsPayableModel::findOrFail($id);
        $accountsPayable->update($request->except(['_token', '_method']));

        return redirect('accountsPayables');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $party = AccountsPayableModel::findOrFail($id);

        $party->delete();
        return redirect('accountsPayables');
    }
}
