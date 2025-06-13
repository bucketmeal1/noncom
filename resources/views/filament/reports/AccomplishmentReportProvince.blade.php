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
        td{
            font-size:6pt;
            text-align: center;
        }
    </style>
</head>
<body>
    <div>
        <Span style="font-size: 10pt;">Region:</Span> <br>
        <span style="font-size: 10pt;">Reporting Preiod:</span>
    </div>
    <table border="1">
       <tr>
            <td rowspan="3" style="width: 8%;">Provinces/HUCs</td>
            <td rowspan="3" style="width: 6%;">No of 30-65yo Women</td>
            <td colspan="5" >Screening Services</td>
            <td colspan="7">Results</td>
            <td></td>
            <td colspan="4">Referral & Treatment</td>
            <td rowspan="3">Clinical Breast Examination</td>
       </tr>
       <tr>
            <td colspan="4" style="height: 25pt;">No of Woman Screened</td>
            <td rowspan="2" style="width: 3%;">Percent <br> Screened <br> (%)</td>
            <td colspan="4">No of Woman Screened to be Negative</td>
            <td rowspan="2" style="width: 5%;">No of Women <br> Screened <br> Found <br> Positive</td>
            <td rowspan="2" style="width: 4%;">Percent <br> Positive <br> (%)</td>
            <td rowspan="2" style="width: 5%;">No of Women <br> Screened as Suspicious for <br> Cancer</td>
            <td rowspan="2" style="width: 4%;">Percent <br> Suspicious <br> (%)</td>
            <td rowspan="2" style="width: 5%;">No of Positive <br> Women Referred <br> for Treatment</td>
            <td colspan="3"> No of Positive Women Given Treatment</td>

         

       </tr>
       <tr>
            <td>VIA</td>
            <td>Pap Smear</td>
            <td>HPV DNA</td>
            <td>Total</td>

            <td>VIA</td>
            <td>Pap Smear</td>
            <td>HPV DNA</td>
            <td>Total</td>

            <td>Thermal Abiation</td>
            <td>Cryotherapy</td>
            <td>Excisional <br> Treatment/surgery</td>
            {{-- <td>Clinical Breast Examination</td> --}}
       </tr>

       

       @foreach ($report as $value)
     
       <tr>
            <td style="height: 10pt; background-color:rgb(147, 231, 98); text-align:left">{{ $value->province_name }}</td>
            <td style="background-color:rgb(147, 231, 98)">{{ $value->women_count }}</td>
            <td style="background-color:rgb(147, 231, 98)">{{ $value->via }}</td>
            <td style="background-color:rgb(147, 231, 98)">{{ $value->pap }}</td>
            <td style="background-color:rgb(147, 231, 98)">{{ $value->hpv }}</td>
            <td style="background-color:rgb(147, 231, 98)">{{ $value->total }}</td>
            <td style="background-color:rgb(147, 231, 98)">{{ $value->percentage }}</td>
            <td style="background-color:rgb(147, 231, 98)">{{ $value->via_negative }}</td>
            <td style="background-color:rgb(147, 231, 98)">{{ $value->pap_negative }}</td>
            <td style="background-color:rgb(147, 231, 98)">{{ $value->hpv_negative }}</td>
            <td style="background-color:rgb(147, 231, 98)">{{ $value->total_negative }}</td>
            <td style="background-color:rgb(147, 231, 98)">{{ $value->percentage_negative }}</td>
            <td style="background-color:rgb(147, 231, 98)">{{ $value->positive }}</td>
            <td style="background-color:rgb(147, 231, 98)">{{ $value->percentage_positive }}</td>
            <td style="background-color:rgb(147, 231, 98)">{{ $value->suspicious }}</td>
            <td style="background-color:rgb(147, 231, 98)">{{ $value->percentage_suspicious }}</td>
            <td style="background-color:rgb(147, 231, 98)">{{ $value->thermal_abiation }}</td>
            <td style="background-color:rgb(147, 231, 98)">{{ $value->cryotherapy }}</td>
            <td style="background-color:rgb(147, 231, 98)">{{ $value->excisional_treatment }}</td>
            {{-- <td style="background-color:red;">{{ $value->province_name }}</td>
            <td style="background-color:red;">{{ $value->province_name }}</td> --}}
            <td style="background-color:rgb(147, 231, 98)">{{ 0 }}</td>
       </tr>


       @foreach ($value->municipality as $val)
        <tr>
                <td style="height: 10pt; text-align:right">{{ $val->municipality_name_city }}</td>
                <td>{{ $val->women_count_city }}</td>
                <td>{{ $val->via_city }}</td>
                <td>{{ $val->pap_city }}</td>
                <td>{{ $val->hpv_city }}</td>
                <td>{{ $val->total_city }}</td>
                <td>{{ $val->percentage_city }}</td>
                <td>{{ $val->via_negative_city }}</td>
                <td>{{ $val->pap_negative_city }}</td>
                <td>{{ $val->hpv_negative_city }}</td>
                <td>{{ $val->total_negative_city }}</td>
                <td>{{ $val->percentage_negative_city }}</td>
                <td>{{ $val->positive_city }}</td>
                <td>{{ $val->percentage_positive_city }}</td>
                <td>{{ $val->suspicious_city }}</td>
                <td>{{ $val->percentage_suspicious_city }}</td>
                <td>{{ $val->thermal_abiation_city }}</td>
                <td>{{ $val->cryotherapy_city }}</td>
                <td>{{ $val->excisional_treatment_city }}</td>
                {{-- <td>{{ $value->province_name_city }}</td>
                <td>{{ $value->province_name_city }}</td> --}}
                <td>{{ 0 }}</td>
        </tr>
        @endforeach
             
       @endforeach
       {{-- <tr>
        <td style="height: 10pt;">ISABELA</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
    </tr>
       <tr>
        <td style="height: 10pt;">BATANES</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
   </tr>
   <tr>
    <td style="height: 10pt;">NUEVA VIZCAYA</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
</tr>

<tr>
    <td style="height: 10pt;">QUIRINO</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
</tr> --}}


    </table>
    
</body>
</html>
