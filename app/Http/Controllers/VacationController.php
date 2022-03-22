<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacation;

class VacationController extends Controller
{
    public function AddVacation(Request $req)
    {
        $fields = $req->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'matricule' => 'required|string',
            'periode' => 'required|date|after:today',
            'nbrejrs' => 'required|integer' 
        ]);

        $vacation = Vacation::create([
            'nomJr' => $fields['nom'],
            'prenomJr' => $fields['prenom'],
            'matriculeJr' => $fields['matricule'],
            'periode' => $fields['periode'],
            'nbrejrs' => $fields['nbrejrs']
        ]);

        return response([
            'vacation' => $vacation,
            'message' => 'Vacation added successfully'
        ]);
    }

    public function EditVacation(Request $req)
    {
        $vacation = Vacation::where("id", $req->member_id);

        $fields = $req->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'matricule' => 'required|string',
            'periode' => 'required|date|after:today',
            'nbrejrs' => 'required|integer' 
        ]);

        $vacation->update([
            'nomJr' => $fields['nom'],
            'prenomJr' => $fields['prenom'],
            'matriculeJr' => $fields['matricule'],
            'periode' => $fields['periode'],
            'nbrejrs' => $fields['nbrejrs']
        ]);

        return response([
            'vacation' => $vacation,
            'message' => 'Vacation updated successfully'
        ]);
    }

    public function DeleteVacation(Request $req)
    {
        // return dd($req);
        // return dd($req->member_id);
        $vacation = Vacation::where("id", (int)$req->member_id)->delete();
        // $vacation = Vacation::where("id", $req->memberID);
        // return dd((int)$req->member_id);
        return response([
            'message' => 'Vacation deleted successfully'
        ]);
    }
}
