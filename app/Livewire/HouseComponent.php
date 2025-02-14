<?php

namespace App\Livewire;

use App\Models\House;
use Livewire\Component;
use App\Models\Ward;
use Illuminate\Http\Request;
use App\Models\FamilyMember;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class HouseComponent extends Component
{  public $isOpenWardLeader = false;

    public $ward_id, $houses, $house_id, $house_name, $number_of_members,$ward,$members,$wardleader,$wardleader_name,$email,$password,$wardleaderidlogin,$address,$about,$member_of_parish_since;
    public $isOpen = false;

    public function mount($ward_id)
    {
        $this->ward_id = $ward_id;
    }

    public function render()
    {

        $this->ward = Ward::findOrFail($this->ward_id);
        $this->houses = House::where('ward_id', $this->ward_id)->get();
        $this->members = FamilyMember::whereHas('house', function ($query) {
            $query->where('ward_id', $this->ward_id);
        })->get();

        $this->wardleader_name = FamilyMember::whereHas('house', function ($query) {
            $query->where('ward_id', $this->ward_id);
        })->where('wardleader',1)->first();


        return view('livewire.house-component');
    }
    public function openModalWardLeader()
    {
        $this->isOpenWardLeader = true;
    }


    public function closeModalLeader()
    {
        $this->isOpenWardLeader = false;
    }

    public function saveWardLeader()
    {

        $validatedData = $this->validate([
            'wardleader' => 'required|exists:family_members,id',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email',
            'password' => ['required'],
        ]);



        $user = User::create([
            'name' => $this->wardleader,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role'=> $this->ward_id,
        ]);

        event(new Registered($user));

        // Auth::login($user);

        FamilyMember::query()->update(['wardleader' => 0]);
        FamilyMember::where('id', $this->wardleader)->update(['wardleader' => 1]);

        session()->flash('message', $this->ward_id ? 'Ward Leader updated successfully!' : 'Ward Leader added successfully!');

        $this->closeModalLeader();
    }

    public function openModal()
    {
        $this->resetFields();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetFields()
    {
        $this->house_id = '';
        $this->house_name = '';
        $this->number_of_members = '';
    }

    public function saveHouse()
    {
        $validatedData = $this->validate([
            'house_name' => 'required|string',
            'number_of_members' => 'required|integer|min:1',
        ]);

        House::updateOrCreate(
            ['id' => $this->house_id],
            ['ward_id' => $this->ward_id, 'house_name' => $this->house_name, 'number_of_members' => $this->number_of_members
            , 'address' => $this->address, 'about' => $this->about,
            'member_of_parish_since' => $this->member_of_parish_since?: null,]
        );

        session()->flash('message', $this->house_id ? 'House updated successfully!' : 'House added successfully!');
        $this->closeModal();
    }

    public function editHouse($id)
    {
        $house = House::findOrFail($id);
        $this->house_id = $house->id;
        $this->house_name = $house->house_name;
        $this->number_of_members = $house->number_of_members;
        $this->address = $house->address;
        $this->about = $house->about;
        $this->member_of_parish_since = $house->member_of_parish_since;
        $this->isOpen = true;
    }

    public function deleteHouse($id)
    {
        House::findOrFail($id)->delete();
        session()->flash('message', 'House deleted successfully!');
    }
    public function goToFamilyMemberDashboard($id)
    {
        return redirect()->route('house.dashboard', ['id' => $id]);
    }
}
