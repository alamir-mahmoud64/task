<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Print Qr Codes</title>
        <style>
            td{
                padding:10px;text-align: center;
            }
            table{
                border:1px solid black;
            }
            /*table td:last-of-type{
                border-top: 1px solid black;
            }*/
        </style>
    </head>
    <body class="antialiased">
    <form action="{{route('generateQR')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <table>
            <thead>
            <tr>
                <td colspan="2">
                    <h3>Generate QR Codes</h3>
                </td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Upload QR data file :</td>
                <td>
                    <input type="file" name="qr_data_file" required />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Upload File">
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="2" style="color:red;">
                    <ul>
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        @endif
                    </ul>
                </td>
            </tr>
            </tfoot>
        </table>
    </form>
    </body>
</html>
