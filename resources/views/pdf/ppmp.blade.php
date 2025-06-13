<!DOCTYPE html>
<html>
<head>
    <title>WFP</title>
    <!-- Add any necessary CSS styles here -->
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .table-header, .table-header th, .table-header td {
            border: 0px solid black;
            border-collapse: collapse;
            font-size: 12px; /* Adjust the font size as needed */
            margin: 0;
            padding: 5px; /* Adjust the padding as needed */
        }
        .content-header, .content-header th, .content-header td {
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 12px; /* Adjust the font size as needed */
            margin: 0;
            padding: 5px; /* Adjust the padding as needed */
        }
        /* Added missing closing tags for center element */
        center {
            display: block;
            text-align: center;
        }
    </style>
</head>
<body>
    <table class="table-header" style="width:980px;">
    
        
        <tr>
            <td style="width:200px;">
                Department:<br>
                CHD/Bureau/Office:<br>
                Cluster/Program/Unit/Section:<br>
                Source of Fund:<br>
                Calendar Year:<br>
                Date:
            </td>
            <td colspan="2">
                <b>Department of Health</b><br>
                <b>Cagayan Valley Center for Health Development</b><br>
                <b>{{ $unit_name }}</b><br>
                <b>{{ $fund_source_name }}</b><br>
                <b>CY {{ $year }}</b><br>
                <b>{{ $cretaed_at }}</b>
            </td>
        </tr>
    </table>
    <table class="content-header" style="width:980px;">
        <thead>

            <tr>
                <th>&nbsp;Code</th>
                <th>&nbsp;General Description</th>
                <th>&nbsp;Unit</th>
                <th>&nbsp;Quantity</th>
                <th>&nbsp;Unit Cost</th>
                <th>&nbsp;Estimated Budget</th>
                <th>&nbsp;Mode of Procurement</th>
                <th>&nbsp;Jan</th>
                <th>&nbsp;Feb</th>
                <th>&nbsp;Mar</th>
                <th>&nbsp;Apr</th>
                <th>&nbsp;May</th>
                <th>&nbsp;Jun</th>
                <th>&nbsp;Jul</th>
                <th>&nbsp;Aug</th>
                <th>&nbsp;Sept</th>
                <th>&nbsp;Oct</th>
                <th>&nbsp;Nov</th>
                <th>&nbsp;Dec</th>
            </tr>

           
           
        </thead>
        <tbody>

            @php
                $total_budget = 0;
                $total_january = 0;
                $total_february = 0;
                $total_march = 0;
                $total_april = 0;
                $total_may = 0;
                $total_june = 0;
                $total_july = 0;
                $total_august = 0;
                $total_september = 0;
                $total_october = 0;
                $total_november = 0;
                $total_december = 0;
            @endphp 

            @foreach ($data as $key => $value )
                
            
            <tr>
                <th>&nbsp; {{ $value->code }} </th>
                <th>&nbsp; {{ $value->description }} </th>
                <th>&nbsp; {{ $value->unit }} </th>
                <th>&nbsp; {{ $value->quantity }} </th>
                <th>&nbsp; {{ $value->cost,2 != 0 ? number_format($value->cost,2) : '' }} </th>
                <th>&nbsp; {{ $value->budget,2 != 0 ? number_format($value->budget,2) : '' }} </th>
                <th>&nbsp; {{  $value->mode_procurement }} </th>
                <th>&nbsp; {{ $value->january,2 != 0 ? number_format($value->january,2) : '' }} </th>
                <th>&nbsp; {{ $value->february,2 != 0 ? number_format($value->february,2) : '' }} </th>
                <th>&nbsp; {{ $value->march,2 != 0 ? number_format($value->march,2) : '' }} </th>
                <th>&nbsp; {{ $value->april,2 != 0 ? number_format($value->april,2) : '' }} </th>
                <th>&nbsp; {{ $value->may,2 != 0 ? number_format($value->may,2) : '' }} </th>
                <th>&nbsp; {{ $value->june,2 != 0 ? number_format($value->june,2) : '' }} </th>
                <th>&nbsp; {{ $value->july,2 != 0 ? number_format($value->july,2) : '' }} </th>
                <th>&nbsp; {{ $value->august,2 != 0 ? number_format($value->august,2) : '' }} </th>
                <th>&nbsp; {{ $value->september,2 != 0 ? number_format($value->september,2) : '' }} </th>
                <th>&nbsp; {{ $value->october,2 != 0 ? number_format($value->october,2) : '' }} </th>
                <th>&nbsp; {{ $value->november,2 != 0 ? number_format($value->november,2) : '' }} </th>
                <th>&nbsp; {{ $value->december,2 != 0 ? number_format($value->december,2) : '' }} </th>
            </tr>

            @php
                $total_budget += $value->budget;
                $total_january += $value->january;
                $total_february += $value->february;
                $total_march += $value->march;
                $total_april += $value->april;
                $total_may += $value->may;
                $total_june += $value->june;
                $total_july += $value->july;
                $total_august += $value->august;
                $total_september += $value->september;
                $total_october += $value->october;
                $total_november += $value->november;
                $total_december += $value->december;
            @endphp 
            @endforeach

                    
            <tr>
                <th>&nbsp;  TOTAL </th>
                <th>&nbsp;  </th>
                <th>&nbsp;  </th>
                <th>&nbsp;  </th>
                <th>&nbsp;  </th>
                <th>&nbsp; {{ number_format($total_budget ,2) }} </th>
                <th>&nbsp;  </th>
                <th>&nbsp; {{ $total_january  != 0 ?  number_format($total_january,2) : '' }} </th>
                <th>&nbsp; {{ $total_february  != 0 ?  number_format($total_february,2) : '' }} </th>
                <th>&nbsp; {{ $total_march  != 0 ?  number_format($total_march,2) : '' }} </th>
                <th>&nbsp; {{ $total_april  != 0 ?  number_format($total_april,2) : '' }} </th>
                <th>&nbsp; {{ $total_may  != 0 ?  number_format($total_may,2) : '' }} </th>
                <th>&nbsp; {{ $total_june  != 0 ?  number_format($total_june,2) : '' }} </th>
                <th>&nbsp; {{ $total_july  != 0 ?  number_format($total_july,2) : '' }} </th>
                <th>&nbsp; {{ $total_august  != 0 ?  number_format($total_august,2) : '' }} </th>
                <th>&nbsp; {{ $total_september  != 0 ?  number_format($total_september,2) : '' }} </th>
                <th>&nbsp; {{ $total_october  != 0 ?  number_format($total_october,2) : '' }} </th>
                <th>&nbsp; {{ $total_november  != 0 ?  number_format($total_november,2) : '' }} </th>
                <th>&nbsp; {{ $total_december  != 0 ?  number_format($total_december,2) : '' }} </th>
            </tr>

        </tbody>
    </table>
</body>
</html>
