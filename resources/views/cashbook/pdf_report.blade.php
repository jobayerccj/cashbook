<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title>Pdf Report</title>
<style type="text/css">
    html, body {
        height: 100%;
    }
    @media print {
        #footer {
            display: block;
            position: fixed;
            bottom: 0;
            width:100%;
        }
        tfoot {
            display: table-footer-group;
        }
    }
    table tr > td{
        padding:4px;
        font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size:12px;
    }
    table tr td{
        border-bottom: 1px solid #999;
    }

    .pagenum:before {
        content: counter(page);
    }
</style>
</head>

<body>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th colspan="5">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #000; text-align:left;">
                        <tr>
                            >
                            <td width="100%" rowspan="2" bgcolor="#000000" style="background-color:#000; color:#fff; text-align:center; font-size:22px;"> report</td>
                            
                        </tr>
                        
                    </table>
                </th>
            </tr>
        </thead>
        
        <tbody>
            <tr style="background-color:#84fbfb; font-weight:bold;">
                <td>Name</td>
                <td>Amount</td>
                <td>Type</td>
                <td>Created At</td>
                <td >Balance</td>
                
            </tr>
            @foreach($cashflow_list as $cashflow)
                <tr>
                    <td >{{ $cashflow['name'] }}</td>
                    <td >{{ $cashflow['amount'] }}</td>
                    <td >{{ $cashflow['flow_type'] == 1 ? "Inflow": "Outflow"}}</td>
                    <td >{{ $cashflow['created_at'] }}</td>
                    <td >{{ $cashflow['balance'] }}</td>
                </tr>
            @endforeach

            
        </tbody>

        <tfoot id="footer">
            <tr style="font-weight:bold; border:0 none;">
                <td colspan="11" style="text-align:left; border:0 none;"> {{ date('d/m/Y h:i:s') }} <span class="pagenum"></td>
            </tr>
        </tfoot>
    </table>

</body>
</html>