<?php

namespace App\Http\Controllers;

use App\Filament\User\Resources\ConsultationResource\RelationManagers\NcdRiskFactorRelationManager;
use App\Models\Patient;
use App\Models\Province;
use App\Models\VitalSign;
use App\Models\FundSource;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\CervicalCancer;
use App\Models\NCDRiskFactor;
use App\Models\WorkFinancialPlan;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\Municipality;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\WorkFinancialPlanActivities;
use App\Models\ProjectProcurmentManagementPlan;
use App\Models\WorkFinancialPlanImplementationStatement;


class PDFController extends Controller
{  
    public function accomplishment_report(Request $request){

        $year = $request->year;

        $getProvince = Province::where('regcode',2)->get();
 
        $report = [];
 
        foreach ($getProvince as $key => $value) {
 
 
     $women_count = Patient::select('*')
     ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
     ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, birthdate, CURDATE())'), [30, 65])
     ->where('gender','Female')
     ->where('provcode',$value->provcode)
     ->whereYear('created_at', $year)
     ->count();

    
     $via = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
     ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
     ->where('patients.gender', 'Female')
     ->where('patients.provcode', $value->provcode)
     ->whereYear('consultations.consultation_date', $year)
     ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
     ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
     ->where('cervical_cancers.type_screening', 'V-VIA')
     ->count();
 
 
     $pap = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
     ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
     ->where('patients.gender', 'Female')
     ->where('patients.provcode', $value->provcode)
     ->whereYear('consultations.consultation_date', $year)
     ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
     ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
     ->where('cervical_cancers.type_screening', 'P-Pap Smear')
     ->count();
 
     $hpv = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
     ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
     ->where('patients.gender', 'Female')
     ->where('patients.provcode', $value->provcode)
     ->whereYear('consultations.consultation_date', $year)
     ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
     ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
     ->where('cervical_cancers.type_screening', 'H-HPV')
     ->count();
       
 
           $percentage = 0;
 
           $total = ($via + $pap + $hpv);
 
           if ($women_count != 0) {
               $percentage = ($via + $pap + $hpv) / $women_count * 100;
           }
 
 
 
         $via_negative = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
     ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
         ->where('patients.gender', 'Female')
         ->where('patients.provcode', $value->provcode)
         ->whereYear('consultations.consultation_date', $year)
         ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
         ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
         //->where('cervical_cancers.type_screening', 'V-VIA')
         ->where('cervical_cancers.result', 'VN-VIA Negative')
         ->count();
     
     
         $pap_negative = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
     ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
         ->where('patients.gender', 'Female')
         ->where('patients.provcode', $value->provcode)
         ->whereYear('consultations.consultation_date', $year)
         ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
         ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
         //->where('cervical_cancers.type_screening', 'P-Pap Smear')
         ->where('cervical_cancers.result', 'PN-Pap Smear Normal')
         ->count();
     
         $hpv_negative = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
     ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
         ->where('patients.gender', 'Female')
         ->where('patients.provcode', $value->provcode)
         ->whereYear('consultations.consultation_date', $year)
         ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
         ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
         //->where('cervical_cancers.type_screening', 'H-HPV')
         ->where('cervical_cancers.result',  'HPV-Negative')
         ->count();
         
     
             $percentage_negative = 0;
             $total_negative = ($via_negative + $pap_negative + $hpv_negative);
     
             if ($women_count != 0) {
                 $percentage_negative = ($via_negative + $pap_negative + $hpv_negative) / $women_count * 100;
             }
 
 
         
           $positive = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
     ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
             ->where('patients.gender', 'Female')
             ->where('patients.provcode', $value->provcode)
             ->whereYear('consultations.consultation_date', $year)
             ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
             ->where(function($query) {
                 $query->where('cervical_cancers.result', 'VP-VIA Positive')
                       ->orWhere('cervical_cancers.result', 'PA-Pap Smear Abnormal');
             })
             ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
             ->count();
 
             $percentage_positive = 0;
     
             if ($women_count != 0) {
                 $percentage_positive = $positive / $women_count * 100;
             }
 
 
              $suspicious = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
     ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
             ->where('patients.gender', 'Female')
             ->where('patients.provcode', $value->provcode)
             ->whereYear('consultations.consultation_date', $year)
             ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
             ->where(function($query) {
                 $query->where('cervical_cancers.result', 'VS-VIA Suspicious Cancer')
                       ->orWhere('cervical_cancers.result', 'PS-Pap Smear Suspicious Cancer');
             })
             ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
             ->count();
              $percentage_suspicious = 0;
     
             if ($women_count != 0) {
                 $percentage_suspicious = $suspicious / $women_count * 100;
             }
 
             $number_positive = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
     ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
             ->where('patients.gender', 'Female')
             ->where('patients.provcode', $value->provcode)
             ->whereYear('consultations.consultation_date', $year)
             ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
             ->where(function($query) {
                 $query->where('cervical_cancers.result', 'VP-VIA Positive')
                       ->orWhere('cervical_cancers.result', 'PA-Pap Smear Abnormal');
             
             })
             ->whereNotNull('treatment_management')
             ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
             ->count();
 
             
             $thermal_abiation = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
     ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
             ->where('patients.gender', 'Female')
             ->where('patients.provcode', $value->provcode)
             ->whereYear('consultations.consultation_date', $year)
             ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
             ->where(function($query) {
                 $query->where('cervical_cancers.result', 'VP-VIA Positive')
                       ->orWhere('cervical_cancers.result', 'PA-Pap Smear Abnormal');
             
             })
             ->where('treatment_management','Thermal Abiation') 
             ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
             ->count();
 
 
             $cryotherapy = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
     ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
             ->where('patients.gender', 'Female')
             ->where('patients.provcode', $value->provcode)
             ->whereYear('consultations.consultation_date', $year)
             ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
             ->where(function($query) {
                 $query->where('cervical_cancers.result', 'VP-VIA Positive')
                       ->orWhere('cervical_cancers.result', 'PA-Pap Smear Abnormal');
             
             })
             ->where('treatment_management','Cryotherapy') 
             ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
             ->count();
 
 
             
             $excisional_treatment = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
     ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
             ->where('patients.gender', 'Female')
             ->where('patients.provcode', $value->provcode)
             ->whereYear('consultations.consultation_date', $year)
             ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
             ->where(function($query) {
                 $query->where('cervical_cancers.result', 'VP-VIA Positive')
                       ->orWhere('cervical_cancers.result', 'PA-Pap Smear Abnormal');
             
             })
             ->where('treatment_management','Excisional Treatment/surgery') 
             ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
             ->count();
 
 
 
 
             
 
           
       
            $obj = new \stdClass();
            $obj->province_name = $value->provname;
            $obj->women_count = $women_count;
            $obj->via = $via;
            $obj->pap = $pap;
            $obj->hpv = $hpv;
            $obj->total = $total;
            $obj->percentage = $percentage.'%';
 
            $obj->via_negative = $via_negative;
            $obj->pap_negative  = $pap_negative;
            $obj->hpv_negative  = $hpv_negative;
 
            $obj->total_negative  = $total_negative;
            $obj->percentage_negative  = $percentage_negative.'%';
           
 
            $obj->positive = $positive;
            $obj->percentage_positive = $percentage_positive.'%';
            $obj->suspicious = $suspicious;
            $obj->percentage_suspicious = $percentage_suspicious.'%';
            $obj->number_positive = $number_positive;
 
            $obj->thermal_abiation = $thermal_abiation;
            $obj->cryotherapy = $cryotherapy;
            $obj->excisional_treatment = $excisional_treatment;
 
            $report[] = $obj;
            
        }
 
    //    dd($report);
 
        $pdf = PDF::loadView('filament.reports.AccomplishmentReport',compact('report'));
         $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('tcl.pdf');
     }


 

       

     public function accomplishmentprovince_report(Request $request){

        $year = $request->year;

        $getProvince = Province::where('regcode',2)->get();
 
        $report = [];
        $municiplaity = [];

 
        foreach ($getProvince as $key => $value) {

        //municipality




            
             $getMunicipalities = Municipality::where('provcode',$value->provcode)->get();

             $municiplaity = [];

             foreach ($getMunicipalities as $key => $val) {

                // "id" => 126
                // "regcode" => "02"
                // "provcode" => "0209"
                // "citycode" => "020901"
                // "cityname" => "BASCO (Capital)"
                // "nscb_city_code" => "020901"
                // "nscb_city_name" => "BASCO (Capital)"



                $women_count_city = Patient::select('*')
                ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
                ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, birthdate, CURDATE())'), [30, 65])
                ->where('gender','Female')
                ->where('provcode',$val->provcode)
                ->where('citycode',$val->citycode)
                ->whereYear('created_at', $year)
                ->count();
                
                $via_city = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
                ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
                ->where('patients.gender', 'Female')
                ->where('patients.provcode', $val->provcode)
                 ->where('patients.citycode', $val->citycode)
                 ->whereYear('consultations.consultation_date', $year)
                ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
                ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
                ->where('cervical_cancers.type_screening', 'V-VIA')
                ->count();
            
            
                $pap_city  = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
                ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
                ->where('patients.gender', 'Female')
                ->where('patients.provcode', $val->provcode)
                 ->where('patients.citycode', $val->citycode)
                 ->whereYear('consultations.consultation_date', $year)
                ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
                ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
                ->where('cervical_cancers.type_screening', 'P-Pap Smear')
                ->count();
            
                $hpv_city  = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
                ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
                ->where('patients.gender', 'Female')
                ->where('patients.provcode', $val->provcode)
                 ->where('patients.citycode', $val->citycode)
                 ->whereYear('consultations.consultation_date', $year)
                ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
                ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
                ->where('cervical_cancers.type_screening', 'H-HPV')
                ->count();
               
         
                   $percentage_city  = 0;
         
                   $total_city  = ($via_city  + $pap_city  + $hpv_city );
         
                   if ($women_count_city  != 0) {
                       $percentage_city  = ($via_city  + $pap_city  + $hpv_city ) / $women_count_city  * 100;
                   }
         
         
         
                 $via_negative_city  = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
                ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
                    ->where('patients.gender', 'Female')
                    ->where('patients.provcode', $val->provcode)
                     ->where('patients.citycode', $val->citycode)
                     ->whereYear('consultations.consultation_date', $year)
                    ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
                    ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
                    //->where('cervical_cancers.type_screening', 'V-VIA')
                    ->where('cervical_cancers.result', 'VN-VIA Negative')
                    ->count();
                
                
                    $pap_negative_city  = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
                ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
                    ->where('patients.gender', 'Female')
                    ->where('patients.provcode', $val->provcode)
                     ->where('patients.citycode', $val->citycode)
                     ->whereYear('consultations.consultation_date', $year)
                    ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
                    ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
                    //->where('cervical_cancers.type_screening', 'P-Pap Smear')
                    ->where('cervical_cancers.result', 'PN-Pap Smear Normal')
                    ->count();
                
                    $hpv_negative_city  = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
                ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
                    ->where('patients.gender', 'Female')
                    ->where('patients.provcode', $val->provcode)
                     ->where('patients.citycode', $val->citycode)
                     ->whereYear('consultations.consultation_date', $year)
                    ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
                    ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
                    //->where('cervical_cancers.type_screening', 'H-HPV')
                    ->where('cervical_cancers.result',  'HPV-Negative')
                    ->count();
                    
                
                        $percentage_negative_city  = 0;
                        $total_negative_city  = ($via_negative_city  + $pap_negative_city  + $hpv_negative_city );
                
                        if ($women_count_city  != 0) {
                            $percentage_negative_city  = ($via_negative_city  + $pap_negative_city  + $hpv_negative_city ) / $women_count_city  * 100;
                        }
            
            
                    
                    $positive_city  = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
                ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
                        ->where('patients.gender', 'Female')
                        ->where('patients.provcode', $val->provcode)
                        ->where('patients.citycode', $val->citycode)
                        ->whereYear('consultations.consultation_date', $year)
                        ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
                        ->where(function($query) {
                            $query->where('cervical_cancers.result', 'VP-VIA Positive')
                                ->orWhere('cervical_cancers.result', 'PA-Pap Smear Abnormal');
                        })
                        ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
                        ->count();
            
                        $percentage_positive_city  = 0;
                
                        if ($women_count_city  != 0) {
                            $percentage_positive_city  = $positive_city  / $women_count_city  * 100;
                        }
            
            
                        $suspicious_city  = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
                ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
                        ->where('patients.gender', 'Female')
                        ->where('patients.provcode', $val->provcode)
                        ->where('patients.citycode', $val->citycode)
                        ->whereYear('consultations.consultation_date', $year)
                        ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
                        ->where(function($query) {
                            $query->where('cervical_cancers.result', 'VS-VIA Suspicious Cancer')
                                ->orWhere('cervical_cancers.result', 'PS-Pap Smear Suspicious Cancer');
                        })
                        ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
                        ->count();
                        $percentage_suspicious_city  = 0;
                
                        if ($women_count_city  != 0) {
                            $percentage_suspicious_city  = $suspicious_city  / $women_count_city  * 100;
                     }
         
                     $number_positive_city  = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
             ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
                     ->where('patients.gender', 'Female')
                     ->where('patients.provcode', $val->provcode)
                     ->where('patients.citycode', $val->citycode)
                     ->whereYear('consultations.consultation_date', $year)
                     ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
                     ->where(function($query) {
                         $query->where('cervical_cancers.result', 'VP-VIA Positive')
                               ->orWhere('cervical_cancers.result', 'PA-Pap Smear Abnormal');
                     
                     })
                     ->whereNotNull('treatment_management')
                     ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
                     ->count();
         
                     
                     $thermal_abiation_city  = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
             ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
                     ->where('patients.gender', 'Female')
                     ->where('patients.provcode', $val->provcode)
                     ->where('patients.citycode', $val->citycode)
                     ->whereYear('consultations.consultation_date', $year)
                     ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
                     ->where(function($query) {
                         $query->where('cervical_cancers.result', 'VP-VIA Positive')
                               ->orWhere('cervical_cancers.result', 'PA-Pap Smear Abnormal');
                     
                     })
                     ->where('treatment_management','Thermal Abiation') 
                     ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
                     ->count();
         
         
                     $cryotherapy_city  = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
             ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
                     ->where('patients.gender', 'Female')
                     ->where('patients.provcode', $val->provcode)
                     ->where('patients.citycode', $val->citycode)
                     ->whereYear('consultations.consultation_date', $year)
                     ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
                     ->where(function($query) {
                         $query->where('cervical_cancers.result', 'VP-VIA Positive')
                               ->orWhere('cervical_cancers.result', 'PA-Pap Smear Abnormal');
                     
                     })
                     ->where('treatment_management','Cryotherapy') 
                     ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
                     ->count();
         
         
                     
                     $excisional_treatment_city  = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
             ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
                     ->where('patients.gender', 'Female')
                     ->where('patients.provcode', $val->provcode)
                     ->where('patients.citycode', $val->citycode)
                     ->whereYear('consultations.consultation_date', $year)
                     ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
                     ->where(function($query) {
                         $query->where('cervical_cancers.result', 'VP-VIA Positive')
                               ->orWhere('cervical_cancers.result', 'PA-Pap Smear Abnormal');
                     
                     })
                     ->where('treatment_management','Excisional Treatment/surgery') 
                     ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
                     ->count();
         
         
         
         
                     
         
                   
               
                    $objcity = new \stdClass();
                    $objcity->municipality_name_city  = $val->cityname;
                    $objcity->women_count_city  = $women_count_city ;
                    $objcity->via_city  = $via_city;
                    $objcity->pap_city  = $pap_city;
                    $objcity->hpv_city  = $hpv_city;
                    $objcity->total_city  = $total_city ;
                    $objcity->percentage_city  = $percentage_city .'%';
         
                    $objcity->via_negative_city  = $via_negative_city;
                    $objcity->pap_negative_city   = $pap_negative_city;
                    $objcity->hpv_negative_city   = $hpv_negative_city;
         
                    $objcity->total_negative_city   = $total_negative_city;
                    $objcity->percentage_negative_city   = $percentage_negative_city.'%';
                   
         
                    $objcity->positive_city  = $positive_city;
                    $objcity->percentage_positive_city  = $percentage_positive_city .'%';
                    $objcity->suspicious_city  = $suspicious_city;
                    $objcity->percentage_suspicious_city  = $percentage_suspicious_city .'%';
                    $objcity->number_positive_city  = $number_positive_city;
         
                    $objcity->thermal_abiation_city  = $thermal_abiation_city;
                    $objcity->cryotherapy_city  = $cryotherapy_city;
                    $objcity->excisional_treatment_city  = $excisional_treatment_city;
         
                    $municiplaity[] = $objcity;
        
        






             }

























        




        
        // province////
 
        $women_count = Patient::select('*')
        ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
        ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, birthdate, CURDATE())'), [30, 65])
        ->where('gender','Female')
        ->where('provcode',$value->provcode)
        ->whereYear('created_at', $year)
        ->count();
        
        $via = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
        ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
        ->where('patients.gender', 'Female')
        ->where('patients.provcode', $value->provcode)
        ->whereYear('consultations.consultation_date', $year)
        ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
        ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
        ->where('cervical_cancers.type_screening', 'V-VIA')
        ->count();
    
    
        $pap = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
        ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
        ->where('patients.gender', 'Female')
        ->where('patients.provcode', $value->provcode)
        ->whereYear('consultations.consultation_date', $year)
        ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
        ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
        ->where('cervical_cancers.type_screening', 'P-Pap Smear')
        ->count();
    
        $hpv = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
        ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
        ->where('patients.gender', 'Female')
        ->where('patients.provcode', $value->provcode)
        ->whereYear('consultations.consultation_date', $year)
        ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
        ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
        ->where('cervical_cancers.type_screening', 'H-HPV')
        ->count();
       
 
           $percentage = 0;
 
           $total = ($via + $pap + $hpv);
 
           if ($women_count != 0) {
               $percentage = ($via + $pap + $hpv) / $women_count * 100;
           }
 
 
 
         $via_negative = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
        ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
            ->where('patients.gender', 'Female')
            ->where('patients.provcode', $value->provcode)
            ->whereYear('consultations.consultation_date', $year)
            ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
            ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
            //->where('cervical_cancers.type_screening', 'V-VIA')
            ->where('cervical_cancers.result', 'VN-VIA Negative')
            ->count();
        
        
            $pap_negative = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
        ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
            ->where('patients.gender', 'Female')
            ->where('patients.provcode', $value->provcode)
            ->whereYear('consultations.consultation_date', $year)
            ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
            ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
            //->where('cervical_cancers.type_screening', 'P-Pap Smear')
            ->where('cervical_cancers.result', 'PN-Pap Smear Normal')
            ->count();
        
            $hpv_negative = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
        ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
            ->where('patients.gender', 'Female')
            ->where('patients.provcode', $value->provcode)
            ->whereYear('consultations.consultation_date', $year)
            ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
            ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
            //->where('cervical_cancers.type_screening', 'H-HPV')
            ->where('cervical_cancers.result',  'HPV-Negative')
            ->count();
            
        
                $percentage_negative = 0;
                $total_negative = ($via_negative + $pap_negative + $hpv_negative);
        
                if ($women_count != 0) {
                    $percentage_negative = ($via_negative + $pap_negative + $hpv_negative) / $women_count * 100;
                }
    
    
            
            $positive = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
        ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
                ->where('patients.gender', 'Female')
                ->where('patients.provcode', $value->provcode)
                ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
                ->where(function($query) {
                    $query->where('cervical_cancers.result', 'VP-VIA Positive')
                        ->orWhere('cervical_cancers.result', 'PA-Pap Smear Abnormal');
                })
                ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
                ->count();
    
                $percentage_positive = 0;
        
                if ($women_count != 0) {
                    $percentage_positive = $positive / $women_count * 100;
                }
    
    
                $suspicious = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
        ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
                ->where('patients.gender', 'Female')
                ->where('patients.provcode', $value->provcode)
                ->whereYear('consultations.consultation_date', $year)
                ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
                ->where(function($query) {
                    $query->where('cervical_cancers.result', 'VS-VIA Suspicious Cancer')
                        ->orWhere('cervical_cancers.result', 'PS-Pap Smear Suspicious Cancer');
                })
                ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
                ->count();
                $percentage_suspicious = 0;
        
                if ($women_count != 0) {
                    $percentage_suspicious = $suspicious / $women_count * 100;
             }
 
             $number_positive = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
     ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
             ->where('patients.gender', 'Female')
             ->where('patients.provcode', $value->provcode)
             ->whereYear('consultations.consultation_date', $year)
             ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
             ->where(function($query) {
                 $query->where('cervical_cancers.result', 'VP-VIA Positive')
                       ->orWhere('cervical_cancers.result', 'PA-Pap Smear Abnormal');
             
             })
             ->whereNotNull('treatment_management')
             ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
             ->count();
 
             
             $thermal_abiation = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
     ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
             ->where('patients.gender', 'Female')
             ->where('patients.provcode', $value->provcode)
             ->whereYear('consultations.consultation_date', $year)
             ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
             ->where(function($query) {
                 $query->where('cervical_cancers.result', 'VP-VIA Positive')
                       ->orWhere('cervical_cancers.result', 'PA-Pap Smear Abnormal');
             
             })
             ->where('treatment_management','Thermal Abiation') 
             ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
             ->count();
 
 
             $cryotherapy = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
     ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
             ->where('patients.gender', 'Female')
             ->where('patients.provcode', $value->provcode)
             ->whereYear('consultations.consultation_date', $year)
             ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
             ->where(function($query) {
                 $query->where('cervical_cancers.result', 'VP-VIA Positive')
                       ->orWhere('cervical_cancers.result', 'PA-Pap Smear Abnormal');
             
             })
             ->where('treatment_management','Cryotherapy') 
             ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
             ->count();
 
 
             
             $excisional_treatment = Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
     ->join('cervical_cancers', 'consultations.id', '=', 'cervical_cancers.consultation_id')
             ->where('patients.gender', 'Female')
             ->where('patients.provcode', $value->provcode)
             ->whereYear('consultations.consultation_date', $year)
             ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE())'), [30, 65])
             ->where(function($query) {
                 $query->where('cervical_cancers.result', 'VP-VIA Positive')
                       ->orWhere('cervical_cancers.result', 'PA-Pap Smear Abnormal');
             
             })
             ->where('treatment_management','Excisional Treatment/surgery') 
             ->selectRaw('COALESCE(SUM(CASE WHEN TIMESTAMPDIFF(YEAR, patients.birthdate, CURDATE()) BETWEEN 30 AND 65 THEN 1 ELSE 0 END), 0) AS age_sum')
             ->count();
 
 
 
 
             
 
       
       
            $obj = new \stdClass();
            $obj->province_name = $value->provname;
            $obj->women_count = $women_count;
            $obj->via = $via;
            $obj->pap = $pap;
            $obj->hpv = $hpv;
            $obj->total = $total;
            $obj->percentage = $percentage.'%';
 
            $obj->via_negative = $via_negative;
            $obj->pap_negative  = $pap_negative;
            $obj->hpv_negative  = $hpv_negative;
 
            $obj->total_negative  = $total_negative;
            $obj->percentage_negative  = $percentage_negative.'%';
           
 
            $obj->positive = $positive;
            $obj->percentage_positive = $percentage_positive.'%';
            $obj->suspicious = $suspicious;
            $obj->percentage_suspicious = $percentage_suspicious.'%';
            $obj->number_positive = $number_positive;
 
            $obj->thermal_abiation = $thermal_abiation;
            $obj->cryotherapy = $cryotherapy;
            $obj->excisional_treatment = $excisional_treatment;
            $obj->municipality = $municiplaity;
 
            $report[] = $obj;



       
            
        }
 

        // dd($report);

 
        $pdf = PDF::loadView('filament.reports.AccomplishmentReportProvince',compact('report'));
         $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('tcl.pdf');
     }




     public function tcl_report(Request $request)
     {
         // Get the selected year from the request
         $year = $request->input('year');
 
         // Fetch all patients with their consultations, and optionally filter by year
         $patients = Patient::with(['consultations.vitalsigns', 'consultations.patient_family_histories', 'consultations.patient_medical_histories', 'consultations.ncdRiskFactor', 'consultations.riskscreening', 'consultations.cervicalcancer', 'consultations.management', 'consultations.diagnosis'])
         ->join('users', 'patients.user_id', '=', 'users.id')
             ->when($year, function ($query, $year) {
                 return $query->whereHas('consultations', function ($query) use ($year) {
                     $query->whereYear('consultation_date', $year);
                  
                 });
             })
             ->where('users.national_health_facility_registries_id',auth()->user()->national_health_facility_registries_id)
             ->get();

  
 
         $reportData = [];

     
         foreach ($patients as $value) {
            $obj = new \stdClass();
            $obj->id = $value->id;
            $obj->name = $value->firstname . ' ' . $value->lastname;
            $obj->birth_date = Carbon::parse($value->birthdate)->format('m-d-Y'); // Format birth date
            $obj->address = $value->barangay->bgyname . ', ' . $value->municipalities->cityname . ', ' . $value->provinces->provname . ', ' . $value->regions->regname;
            
            $obj->rowspan = $value->consultations->count();
        
            // Order consultations by consultation_date ascending
            $obj->consultations = $value->consultations->sortBy('consultation_date');
        
            $firstConsultation = null;
            $consultationArray = [];
            
            foreach ($obj->consultations as $index => $row) {
                $cons_date = new \stdClass();
                $cons_date->consultation_date = Carbon::parse($row->consultation_date)->format('m-d-Y'); // Format consultation date
                
                // Fetch the latest cervical cancer screening record for this consultation
                $cervicalCancer = $row->cervicalcancer()->latest()->first(); // Use the method name
                $cons_date->cervicalcancer = $cervicalCancer;
        
                if ($index === 0) {
                    // Handle the first consultation separately
                    $firstConsultation = $cons_date;
                } else {
                    // Handle the remaining consultations
                    $consultationArray[] = $cons_date;
                }
            }
            
            $obj->firstConsultation = $firstConsultation;
            $obj->consultationArray = $consultationArray;
        
            $reportData[] = $obj;
        }
            // dd($obj->consultationArray);


        //      // Fetch related data
        //      $consultations = $value->consultations;

        //   // Assuming $consultations is a single Consultation instance
        //     $latestCervicalCancer = $consultations->map(function ($consultation) {
        //         return $consultation->cervicalcancer()->latest()->first();
        //     })->filter()->sortByDesc('created_at')->first();
            
        //     if ($latestCervicalCancer) {
        //         $obj->risk_assessment = $latestCervicalCancer->risk_assessment;
        //         $obj->given_counseling = $latestCervicalCancer->given_counseling;
        //     } else {
        //         $obj->risk_assessment = null; // Or any default value you want
        //         $obj->given_counseling = null;
        //     }
            
          

        //      // Concatenate the consultation dates with a delimiter (e.g., comma)
        //      $concatenatedDates = $consultations->map(function ($consultation) {
        //         return Carbon::parse($consultation->consultation_date)->format('m-d-Y'); // Change format as needed
        //     })->implode(', ');

        //         // Assign to the object
        //       $obj->consultation_date = $concatenatedDates;
          
        //        // Initialize counts
        //        $totalCounseling = 0;
        //        $cervicalCancer = [];
        //        $vitalSigns = [];
        //        $medicalRecords = [];
        //        $consultation_data = [];

             

       
        //        foreach ($value->consultations as $consultation) {
        //            // Collect cervical cancer information
        //            $consultation_data = $consultation;

        //            foreach ($consultation->cervicalcancer as $cc) {
        //                $cervicalCancer[] = $cc;
        //                if ($cc->given_counseling === 'yes') {
        //                    $totalCounseling++;
        //                }
        //            }
       
        //            // Collect vital signs information
        //            foreach ($consultation->vitalsigns as $vs) {
        //                $vitalSigns[] = $vs;
        //            }
       
        //            // Collect medical records
        //            foreach ($consultation->ncdRiskFactor as $record) {
        //                $medicalRecords[] = $record;
        //            }
        //        }
       
        //        $obj->vital_signs = $vitalSigns;
        //       // $obj->consultation = $consultation_data->groupConcat('consultation_date');
        //        $obj->type_screening = $cervicalCancer; // Adjust as needed
        //        $obj->cervical_cancers = $cervicalCancer;
       
        //        $obj->count = count($vitalSigns);
        //        $obj->given_counseling = $totalCounseling === 0 ? 'No' : 'Yes';
       
               // Assess risk
            //    $obj->risk_status = empty($medicalRecords) ? 'not assessed' : (collect($medicalRecords)->every(function ($record) {
            //        return $record->smoking === 'no' && $record->highfat === 'no' && $record->highsalt === 'no';
            //    }) ? 'not at risk' : 'in risk');
       
 
          
         
        //  dd($reportData);

         // Generate PDF
         $pdf = PDF::loadView('filament.reports.TclCervicalCancer', compact('reportData'));
         return $pdf->stream('tcl_report.pdf');
     }
 
     public function year()
     {
         // Get the current year
         $currentYear = Carbon::now()->year;
 
         // Create an array of years from current year to 10 years ago
         $years = range($currentYear, $currentYear - 10);
 
         // Pass the $years array to the view
         return view('your.view.name', compact('years'));
     }
 
     public function filter(Request $request)
     {
         // Validate the incoming request
         $request->validate([
             'filter_year' => 'required|numeric',
         ]);
 
         // Retrieve the selected year
         $selectedYear = $request->input('filter_year');
 
         // Fetch filtered records based on the selected year
         $filteredRecords = Patient::whereHas('consultations', function ($query) use ($selectedYear) {
             $query->whereYear('consultation_date', $selectedYear);
         })->get();
 
         // Return the filtered data or redirect as needed
         return response()->json($filteredRecords);
     }
 }