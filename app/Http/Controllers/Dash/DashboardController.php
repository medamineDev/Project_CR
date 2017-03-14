<?php

namespace App\Http\Controllers\Dash;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class DashboardController extends Controller
{


    public function monthlyDashIndex()
    {

        /* todo get dynamic Year*/
        $year = "2016";

        $occupationData = DB::table("occupation")
            ->join("mois", "mois.id", "=", "occupation.idMois")
            ->where("mois.annee", $year)->get();

        $presenceData = DB::table("presence")
            ->join("mois", "mois.id", "=", "presence.idMois")
            ->where("mois.annee", $year)->get();

        $productData = DB::table("Produit")
            ->join("mois", "mois.id", "=", "Produit.idMois")
            ->where("mois.annee", $year)->get();

        $params = $this->getStats();


        return view("Dash.monthlyInputDash", compact("occupationData", "presenceData", "productData"));

    }


    public function getParamVal($type)
    {

        $year = 2016;
        $paramAn = DB::table("paramannuels")
            ->join("parametres", "parametres.id", "=", "paramannuels.idParametre")
            ->where("paramannuels.annee", $year)
            ->where("parametres.id", $type)
            ->first();


        return $paramAn ? $paramAn->valeur : 0;

    }

    public function getStats($year, $month, $getByMonth)
    {


        $presenceData = DB::table("presence")
            ->join("mois", "mois.id", "=", "presence.idMois");

        if ($getByMonth) {

            $presenceData = $presenceData->where("mois.id", $month);
        }

        $presenceData = $presenceData->where("mois.annee", $year)->get();


        $occupationData = DB::table("occupation")
            ->join("mois", "mois.id", "=", "occupation.idMois");

        if ($getByMonth) {

            $occupationData = $occupationData->where("mois.id", $month);
        }

        $occupationData = $occupationData->where("mois.annee", $year)->get();


        foreach ($presenceData as $presence) {

            $presence->seuil = $this->getParamVal(7);
            $presence->tolerance = $this->getParamVal(8);

        }

        foreach ($occupationData as $occupation) {

            $occupation->seuil = $this->getParamVal(3);
            $occupation->tolerance = $this->getParamVal(4);

        }


        return ["occupationData" => $occupationData, "presenceData" => $presenceData];

    }

    public function statsPage($year = false, $month = false)
    {
        $getByMonth = false;
        if($month){

            $getByMonth = true;
        }

        if (!$year && !$month) {

            $now = new \DateTime('now');
            $year = $now->format('Y');

        }

        $stats = $this->getStats($year, $month, $getByMonth);
        $occupationData = $stats["occupationData"];
        $presenceData = $stats["presenceData"];

        return view('dashBoard', compact("occupationData", "presenceData","getByMonth","year","month"));
    }


}
