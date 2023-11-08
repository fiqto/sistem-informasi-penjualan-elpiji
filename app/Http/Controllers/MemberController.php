<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Transaction;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->has('search')) {
            $keyword = $request->search;
            $members = Member::where('nik', 'like', "%$keyword%")
                ->orWhere('member_name', 'like', "%$keyword%")
                ->orWhere('phone_number', 'like', "%$keyword%")
                ->orWhere('address', 'like', "%$keyword%")
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $members = Member::orderBy('id', 'desc')
                ->paginate(10);
        }
        
        return view('member.table', compact('members'));
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
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
        $hasTransactions = Transaction::where('member_id', $member->id)->exists();

        if ($hasTransactions) {
            return redirect()->route('members.index')
                ->with('error', 'Tidak dapat menghapus data karena memiliki keterhubungan dengan transaksi yang ada.');
        }

        $member->delete();
        
        return redirect()->route('members.index')
            ->with('success', 'Berhasil Dihapus!');
    }
}
