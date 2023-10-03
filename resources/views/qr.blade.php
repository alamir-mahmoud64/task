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
            height:145px;
            width:145px;
        }
        td{
            padding:1px;
            text-align: center;
        }
        td.qr_name{
            padding: 7px;
            font-weight: bold;
            text-align: center;
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
                    </td>
                    <td style="border-left: 1px solid black;" class="qr_name">
                        {{trim($rec['name'])}}
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
