<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Qr Data</title>
    <style>
        .qr_div {
            display: inline-block;
        }
        .page-break {
            page-break-after: always;
        }
        .img{
            height:135px;
            width:135px;
        }
        td{
            padding:1px;
            text-align: center;
        }
        p.qr_val{
            padding: 0px;
            margin: 0px;
            font-weight: bold;
        }
        p.qr_name{
            padding: 3px;
            font-weight: bold;
        }
        @page { margin: 0px; }
        body { margin: 0px; }
    </style>
</head>
<body>
    @foreach($collection as $rec)
        <div class="qr_div">
            <table>
                <tr>
                    <td>
                        <img src="{{$qrObj->render(trim($rec['qr_value']))}}" class="img" alt="QR Code" />
                        <p class="qr_val">{{trim($rec['qr_value'])}}</p>
                    </td>
                    <td style="border-left: 1px solid black;">
                        <p class="qr_name">{{trim($rec['name'])}}</p>
                    </td>
                </tr>
            </table>
        </div>
        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
</body>
</html>
