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
        $year="2016";

        $occupationData = DB::table("occupation")
            ->join("mois","mois.id","=","occupation.idMois")
            ->where("mois.annee",$year)->get();

        $presenceData = DB::table("presence")
            ->join("mois","mois.id","=","presence.idMois")
            ->where("mois.annee",$year)->get();

        $productData = DB::table("Produit")
            ->join("mois","mois.id","=","Produit.idMois")
            ->where("mois.annee",$year)->get();

        $params = $this->getStats();
        dd($params);


        return view("Dash.monthlyInputDash",compact("occupationData","presenceData","productData"));

    }



    public function getParamVal($type){

        $year=2016;
        $paramAn = DB::table("paramannuels")
            ->join("parametres","parametres.id","=","paramannuels.idParametre")
            ->where("paramannuels.annee",$year)
            ->where("parametres.id",$type)
            ->first();


        return $paramAn?$paramAn->valeur :0 ;

    }

    public function getStats(){


        $year="2016";
        $presenceData = DB::table("presence")
            ->join("mois","mois.id","=","presence.idMois")
            ->where("mois.annee",$year)->get();


        foreach ($presenceData as $presence){

        $presence->seuil = $this->getParamVal(7);
        $presence->tolerance = $this->getParamVal(8);

        }



        return $presenceData;

    }

    public function statsPage()
    {
        $stats = $this->getStats();

        //dd($stats);
        return view('dashBoard',compact("stats"));
    }


}
