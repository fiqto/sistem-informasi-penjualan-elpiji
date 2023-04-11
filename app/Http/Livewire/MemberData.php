<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MemberData extends Component
{
    public $data;
    public $selectedMemberId;
    public $memberName;
    public $memberPhoneNumber;
    public $memberAddress;

    public function render()
    {
        $this->data = ModelName::all();

        return view('livewire.member-data');
    }

    public function selectMember($memberId)
    {
        $this->selectedMemberId = $memberId;
        $member = ModelName::find($memberId);
        $this->memberName = $member->member_name;
        $this->memberPhoneNumber = $member->phone_number;
        $this->memberAddress = $member->address;
    }
}
