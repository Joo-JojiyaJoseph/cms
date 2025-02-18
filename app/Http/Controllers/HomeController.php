<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Ward;
use Illuminate\Http\Request;

class HomeController extends Controller
{

        public function warddashboard($id)
        {
            $ward = Ward::findOrFail($id);
            return view('ward-dashboard', compact('ward'));
        }
        public function familydashboard($id,$houseId){
            $house = House::findOrFail($houseId);
            $familyMembers = $house->familyMembers;  // Assuming relation is defined in the House model
            return view('familydashboard', compact('house', 'familyMembers'));
        }
        public function familyMemberReport(){
            return view('report.familyMemberReport');
        }

}
