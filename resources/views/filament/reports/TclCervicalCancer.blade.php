<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Noncom2</title>
    <style>
        table{
            width: 100%;
            border-collapse: collapse;
        }
        th, td{
            font-size:8pt;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="main_container" style="text-align: center;">
        <span style="font-size:10pt;">Target Client List for Cervical Vancer Prevention and Control</span>
        <div >
            <div style="width: 100%;text-align:center;font-size:8pt;">
                <br><span style="margin-right:20pt;">For the Month/Year: __________________________________</span>
                <span style="margin-left:40pt;">Name of Health Facility: __________________________________</span> 
            </div>
        </div>
    </div><br>
    <table border="1">
        <thead>
            <tr>
                <th rowspan="2" style="width:10%;vertical-align:20%;">Name of Patient <br><br> (Surname, First Name, Middle Initial) <br><span style="vertical-align: -900%;"></span></th>
                <th rowspan="2" style="width:5%;vertical-align:20%;">Date of <br> Birth <br> (mm/dd/ <br> yyyy) <br><br> <span style="font-weight: 700;">Age</span>  <br><span style="vertical-align: -800%;"></span></th>
                <th rowspan="2" style="width:8%;vertical-align:20%;">Complete <br> Address  <br><span style="vertical-align: -1270%;"></span></th>
                <th rowspan="2"  style="width:8%;vertical-align:20%;">Date <br> By Visit <br><br> (1st 2nd 3rd) <br><span style="vertical-align: -1025%;"></span></th>
                <th style="width:8%;vertical-align:20%;text-align:left;">Risk <br> Assessment <br> Status</th>
                <th rowspan="2" style="width:8%;vertical-align:20%;">Given <br><span style="text-align: left;"> Counseling <br> /-yes <br> X-No </span><br><span style="vertical-align: -1025%;text-align:center;"></span></th>
                <th rowspan="2" style="width:8%;vertical-align:20%;text-align:left;">Type of <br> Screening <br> Done <br> V - VIA <br> P - Pap <br> Smear <br> H - HPV <br> test</th>
                <th rowspan="2">Result of Diagnosis/Screening</th>
                <th rowspan="2" style="width:10%;vertical-align:20%;text-align:left;"><span>Treatment, <br> Management <br> and Care Status</span><br><br> <span>1-referral, <br> 2-cryotherapy or <br>  TA specify <br> ablation type <br> 3-colposcopy <br> 4-chemoradiation <br> 5-surgery <br> 6-palliative care</span></th>
                <th rowspan="2" style="width:8%;vertical-align:20%;text-align:left;">Schedule <br> of Return <br> Visit</th>
                <th rowspan="2"style="width:8%;vertical-align:20%;text-align:left;"><span>Remarks</span> <br> <span>Record those <br> treatment using <br> cryotherapy or <br> Thermal <br> Ablation</span></th>
            </tr>
            <tr>
                <td style="width:8%;vertical-align:20%;"><br> /- presence of <br> at least 1 <br> risk factor <br> X - Not at risk <br><span style="vertical-align: -425%;"></span></td>
                {{-- <td style="width:6%;">VN-VIA <br> Negative <br><br> VNE - VIA <br> Negative- <br> Ectropion <br><br> PN- Pap <br> Smear <br> Normal <br><br> HPV <br> Negative <br><br></td>
                <td style="width:6%;vertical-align:20%;">VP-VIA <br> positive <br><br> PA-Pap <br> Smear <br> Abnormal <br><br><br> HPV + <br> what type <br><br><span style="vertical-align: -355%;"></td>
                <td style="width:6%;vertical-align:20%;">VS - VIA <br> Suspicious <br> Cancer <br><br> PS - Pap <br> Smear <br> suspicious <br> cancer <br><br> HPV <br> suspicious <br> or <br> malignant <br><br><br><br> \   </td>
            </tr> --}}
          
              {{-- @foreach ($reportData as $patient)
                <tr>
                    <td rowspan="{{ count($reportData) }}">{{ $patient->name }}</td>
                    <td rowspan="{{ count($reportData) }}">{{ $patient->birth_date }}</td>
                    <td rowspan="{{ count($reportData) }}">{{ $patient->address }}</td>
                    <td> {{ $patient->consultation_date }} </td>
                    <td> {{ $patient->risk_assessment }} </td>
                    <td>{{ $patient->given_counseling }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>   
                                 
                </tr>
                  @endforeach --}}


                  @foreach ($reportData as $patient)
                    <tr>
                        <td rowspan="{{ $patient->rowspan }}">{{ $patient->name }}</td>
                        <td rowspan="{{ $patient->rowspan }}">{{ $patient->birth_date }}</td>
                        <td rowspan="{{ $patient->rowspan }}">{{ $patient->address }}</td>

                        <td>{{ $patient->firstConsultation->consultation_date ?? null }}</td>
                        <td>{{ $patient->firstConsultation->cervicalcancer->risk_assessment ?? null }}</td>
                        <td>{{ $patient->firstConsultation->cervicalcancer->given_counseling ?? null }}</td>  
                        <td>{{ $patient->firstConsultation->cervicalcancer->type_screening ?? null }}</td>  
                        <td>{{ $patient->firstConsultation->cervicalcancer->result ?? null }}</td> 
                        <td>{{ $patient->firstConsultation->cervicalcancer->treatment_management ?? null }}</td>  
                        <td>{{ $patient->firstConsultation->cervicalcancer->return_schedule ?? null }}</td>  
                        <td>{{ $patient->firstConsultation->cervicalcancer->remarks ?? null }}</td>  
                    </tr>

                    @foreach ($patient->consultationArray as $cons)
                        <tr>
                            <td>{{ $cons->consultation_date ?? null}}</td>
                            <td>{{ $cons->cervicalcancer->risk_assessment ?? null }}</td>
                            <td>{{ $cons->cervicalcancer->given_counseling ?? null }}</td>
                            <td>{{ $cons->cervicalcancer->type_screening ?? null }}</td>  
                            <td>{{ $cons->cervicalcancer->result ?? null }}</td> 
                            <td>{{ $cons->cervicalcancer->treatment_management ?? null }}</td> 
                            <td>{{ $cons->cervicalcancer->return_schedule ?? null }}</td>  
                            <td>{{ $cons->cervicalcancer->remarks ?? null }}</td>  
                        </tr>
                    @endforeach
@endforeach



        </thead>

    </table>
    
</body>
</html>