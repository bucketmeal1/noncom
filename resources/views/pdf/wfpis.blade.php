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
            <td style="width:500px;"><center>
                WORK AND FINANCIAL PLAN IMPLEMENTATION STATEMENT
                {{-- <br><small>For the Month of December 2023</small> --}}
                </center>
            </td>
           
        </tr>
    </table>
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
                <th rowspan="2">ACTIVITITES
                    SCHEDULED FOR
                    THE PERIOD</th>
                <th colspan="4">PHYSICAL ACCOMPLISHMENT / OUTPUT</th>
                {{-- <th></th>
                <th></th>
                <th></th> --}}
                <th>REASON /
                    JUSTIFICATION</th>
                <th colspan="4">FINANCIAL INPUT</th>
                {{-- <th></th>
                <th></th>
                <th></th> --}}
            </tr>

            <tr>
                {{-- <th></th> --}}
                <th>PERFORMANCE
                    INDICATOR (PI)</th>
                <th>TARGET</th>
                <th>ACTUAL</th>
                <th>VARIANCE</th>
                <th>For Any Variance
                    (In case of negative
                    variance, indicate
                    when it will be done)</th>
                <th>EXPENSE TYPE (Ex.
                    Training Expense or
                    Board & Lodging,
                    Drugs / Medical
                    Supplies, Financial
                    Assistance, etc.)</th>
                <th>FUNDING
                    SOURCE (Ex.
                    GOP - Regular,
                    Sub-Allotment,
                    Trust Fund, etc.)</th>
                <th>AMOUNT
                    OBLIGATED</th>
                <th>REMARKS</th>
            </tr>

           
        </thead>
        <tbody>

            @foreach ($data as $key => $value )
            
             <tr>
                <td>{{ $value->activity_name }}</td>
                <td>{{ $value->performance_indicator }}</td>
                <td>{{ $value->target }}</td>
                <td>{{ $value->actual }}</td>
                <td>{{ $value->variance }}</td>
                <td>{{ $value->for_any_variance }}</td>
                <td>{{ $value->expense_type }}</td>
                <td>{{ $value->activity_fund }}</td>
                <td>{{ number_format($value->amount_obligation ,2)}}</td>
                <td>{{ $value->remarks }}</td>
             </tr>
                    
             @endforeach

        </tbody
    </table> 
</body>
</html>
