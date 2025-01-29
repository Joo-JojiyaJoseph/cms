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
        public function familydashboard($id){
            $house = House::findOrFail($id);
            $familyMembers = $house->familyMembers;  // Assuming relation is defined in the House model
            return view('familydashboard', compact('house', 'familyMembers'));
        }

}
