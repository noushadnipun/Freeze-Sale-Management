<html>
<body>
    <p>Bill Serial No</p> 
    <p>To</p>
    <p>Transcom Beverages Limited</p>
    <p>Gazipur</p>
    <p></p>
    <p>Subject: </p>
    <p>Period: </p>

    <table style="display: table;"  border="1">
        <thead>
            <tr>
                <th colspan="4" class="text-left" style="font-weight: bold; text-align: center;">
                    Bill Summary Statement
                </th>
            </tr>
            <tr>
                <th style="font-weight: bold;  text-align: center;">SL No</th>
                <th style="font-weight: bold;  text-align: center;">Page No</th>
                <th style="font-weight: bold;  text-align: center;">Quantity</th>
                <th style="font-weight: bold;  text-align: center;">Amount of Bill</th>
                {{-- <th style="font-weight: bold;  text-align: center;">Amount of Bill</th> --}}
            </tr>
        </thead>
        <tbody>
            
            @for ($i = 1; $i <= $ceilPage; $i++)
                <tr>
                <td style="vertical-align: center; text-align: center;">{{$i}}</td>
                <td style="vertical-align: center; text-align: center;">Page No {{$i}}</td>
                <td style="vertical-align: center; text-align: center;">
                
                    @if($i == $ceilPage && $lastItemCount != 0)
                        {{$lastItemCount}}
                    @else
                        {{$itemPerPage}}
                    @endif
                
                </td>
                <td style="vertical-align: center; text-align: center;">
                    
                   {{$getSale->skip($i*$itemPerPage-$itemPerPage)->take($itemPerPage)->sum('grand_total')}}
                </td>
                    {{-- <td style="vertical-align: center; text-align: center;">1980</td> --}}
                </tr>
            @endfor

        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="text-left" style="font-weight: bold; text-align: right;">
                Total
                </th>
                <th colspan="1" style="font-weight: bold;  text-align: center;">{{$getSale->count()}}</th>
                <th colspan="1" style="font-weight: bold;  text-align: center;">
                    <?php $totalAmount = $getSale->sum('grand_total');?>
                    {{$totalAmount}}
                </th>
            </tr>
            <tr>
                <th colspan="2" class="text-left" style="font-weight: bold; text-align: right;">
                    Vat 
                </th>
                <th colspan="1" style="font-weight: bold;  text-align: center;">15%</th>
                <th colspan="1" style="font-weight: bold;  text-align: center;">
                    
                    @php
                        $withVat = 15 * $totalAmount / 100;
                    @endphp
                    {{$withVat}}
                </th>
            </tr>

            <tr>
                <th colspan="2" class="text-left" style="font-weight: bold; text-align: right;">
                    Grand Total
                </th>
                <th colspan="1"></th>
                <th colspan="1" style="font-weight: bold;  text-align: center;">
                    
                    @php
                        $grandTotal = $totalAmount+$withVat;
                    @endphp
                    {{$grandTotal}}
                </th>
            </tr>
            <tr></tr>
            <tr>
                <th colspan="4" class="text-left" style="font-weight: bold; text-align: left;">
                     @php
                        $inWordAmount  = App\CustomClass\NumberToWord::numberTowords($grandTotal); 
                    @endphp
                 In Word: {{ $inWordAmount }}
                </th>
            </tr>

        </tfoot>
    </table>
        
    <table style="display: table;">
        <tbody>
            <tr></tr>
            <tr>
                <td colspan="3" style="font-weight: bold; text-align: left;">
                     Proprietor Seal &amp; Sign
                </td>
            </tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr>
                <td colspan="3" style="font-weight: bold; text-align: left;">
                    Checked By MED
                </td>
                <td colspan="3"  style="font-weight: bold; text-align: left;">
                    Signature of
                </td>
                <td colspan="3" style="font-weight: bold; text-align: left;">
                    Signature of
                </td>
                <td colspan="3" style="font-weight: bold; text-align: left;">
                    Signature of
                </td>
                <td colspan="3" style="font-weight: bold; text-align: left;">
                    Signature of
                </td>
            </tr>
        </tbody>
    </table>
</body>
<style>
    .text-center-align-center {
        text-align: center;
    }

    tr td {
        border: 1px solid #000000;
    }
</style>

</html>