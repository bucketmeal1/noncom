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
            <td colspan="2">
                <center><b>WFP Form 1. Work and Financial Plan</b></center>
            </td>
            <td style="width:180px; border: 1px solid black;">
                <center><b>WFP Form 1</b></center>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="border: 1px solid black;">
                Instruction: 1. This form shall be used by the DOH Unit (office/bureau/CHD/hospital) to present their detailed budget as reflected in their Work and Financial Form 1. It shall reflect the output functions (Strategic, Core and Support) of Office Performance Commitment and Review (OPCR) with their corresponding activities, timeframe (targets), the resource requirements and the responsible persons. This form shall be signed by the head of office/ bureau/CHDs/hospital, submitted to their Assistant Team Leader and submitted to HPDPB cc their Team Leader.
            </td>
        </tr>
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
                <th rowspan="2">&nbsp;OUTPUT FUNCTIONS/ DELIVERABLES*</th>
                <th rowspan="2">&nbsp;ACTIVITIES FOR OUTPUTS</th>
                <th colspan="4">&nbsp;TIMEFRAME**</th>
                <th colspan="4">&nbsp;</th>
                <th rowspan="2">&nbsp;RESPONSIBLE PERSON/UNIT</th>
            </tr>
            <tr>
                <th>&nbsp;Q1</th>
                <th>&nbsp;Q2</th>
                <th>&nbsp;Q3</th>
                <th>&nbsp;Q4</th>
                <th>&nbsp;ITEM</th>
                <th>&nbsp;ITEM COST</th>
                <th>&nbsp;TOTAL COST</th>
                <th>&nbsp;SOURCE OF FUND</th>
            </tr>
        </thead>
        <tbody>

        @php
            $total_cost = 0;
            $unit = "";
        @endphp
           
          @foreach ($data as $key => $value )
          
           @php
               $unit = $value->unit_name;
           @endphp

          <tr style="background-color: rgb(209, 209, 209);">

              <td colspan="11">&nbsp;<b>{{ $value->function }}</b>  </td>

          </tr>

          <tr>
              
              <td rowspan="{{ count($value->activities_list)}}">&nbsp;
                  Capacity Building / Technical Assistance

              </td>
              <td rowspan="{{ count($value->activities_list)}}">&nbsp;Capacity Building  and Provision of Technical assistance on Health Information Systems

              </td>

              @php
                $total = 0;
             @endphp

              @foreach ($value->activities_list as $acct => $activity)
              @if($acct == 0)

                    <td rowspan="{{ count($value->activities_list) }}">&nbsp; {{ $value->q1 }} </td>
                    <td rowspan="{{ count($value->activities_list) }}">&nbsp; {{ $value->q2 }} </td>
                    <td rowspan="{{ count($value->activities_list) }}">&nbsp; {{ $value->q3 }} </td>
                    <td rowspan="{{ count($value->activities_list) }}">&nbsp; {{ $value->q4 }} </td>

                    <td>&nbsp;{{ $activity->activity_items }}</td>
                    <td>&nbsp;{{ number_format($activity->activity_cost,2) }}</td>
                    <td>&nbsp;{{ number_format($activity->activity_total,2) }}</td>
                    <td>&nbsp;{{  $activity->fund_title }}</td>
                    <td>&nbsp;{{ $unit }}</td>

                  @php
                    $total += $activity->activity_total;
                @endphp

              @endif
                  
              @endforeach
          

          </tr>

          

              @foreach ($value->activities_list as $acct => $activity)
              
              @if($acct!= 0)
              <tr>

                  {{-- <td >&nbsp;</td>
                  <td >&nbsp;</td>
                  <td >&nbsp;</td>
                  <td >&nbsp;</td> --}}

                  <td>&nbsp;{{ $activity->activity_items }}</td>
                  <td>&nbsp;{{ number_format($activity->activity_cost,2) }}</td>
                  <td>&nbsp;{{ number_format($activity->activity_total,2) }}</td>
                  <td>&nbsp;{{ $activity->fund_title }}</td>
                  <td>&nbsp;{{ $unit }}</td>
              </tr>

              @php
                 $total += $activity->activity_total;
              @endphp

              @endif

              
               
                        
              @endforeach

          

              <tr>

                    <td colspan="7">&nbsp;<b>Sub-total {{ $value->function }} of all Activities per Outputs</b></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;<b> {{ number_format($total, 2) }}</b></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                   
                </tr>

                @php
                    $total_cost += $total;
                @endphp

            
        @endforeach

                <tr>

                    <td colspan="7">&nbsp;<b>Total Cost</b></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;<b> {{ number_format($total_cost, 2) }}</b></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                
                </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</body>
</html>
