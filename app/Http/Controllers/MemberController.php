<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $member = DB::table('members')
            ->paginate(10);

        return view('member.table')
            ->with('members', $member);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        //
        DB::table('members')->insert($request->validated());
        
        return redirect()->route('members.index')
            ->with('success', 'Berhasil DiTambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
        dd();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
        return view('member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        //
        $member->update($request->validated());
        
        return redirect()->route('members.index')
            ->with('success', 'Berhasil DiUpdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
        $member->delete();
        
        return redirect()->route('members.index')
            ->with('success', 'Berhasil Dihapus!');
    }
}
