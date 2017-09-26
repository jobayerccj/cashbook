<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Http\Requests\PartyRequest;
use App\PartyModel;

class PartyController extends Controller
{
    public function index()
	{	
		$parties = PartyModel::orderBy('created_at', 'asc')->paginate(5);

	    return view('parties.index', ['parties' => $parties]);
	    
	}

	public function create()
	{	
	    return view('parties.add');
	}

	public function store(PartyRequest $request){
		
		PartyModel::create($request->all());
		return redirect('parties');
	}

	public function edit($party_id){
		$party = PartyModel::where("party_id", $party_id)->firstOrFail();
		return view('parties.edit', ['party' => $party]);
	}

	public function show($party_id){
		$party = PartyModel::where("party_id", $party_id)->firstOrFail();
		return view('parties.show', ['party' => $party]);
	}

	public function update($party_id, PartyRequest $request){
		$party = PartyModel::where("party_id", $party_id)->firstOrFail();
		$party->where("party_id", $party_id)->update($request->except(['_token', '_method']));
		return redirect('parties');
	}

	public function destroy($party_id){
		$party = PartyModel::where("party_id", $party_id)->firstOrFail();
		//$party->where("party_id", $party_id)->update($request->except(['_token', '_method']));

		$party->where("party_id", $party_id)->delete();
		return redirect('parties');
	}
}
