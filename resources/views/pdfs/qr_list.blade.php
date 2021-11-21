<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lista QR</title>
        <style>
            #container {
                width: 100% !important;
                height: 100% !important;
                margin-top: 60px !important;
                margin-left: 135px !important;
            }
            body{
                font-family: Arial, Helvetica, sans-serif;
            }
            .center{}
        </style>
    <body>
        <div id="container">
            <div class="center">
                @foreach( $items as $item )
                    <img style="width: 440px"
                         alt="{{ $item->key . '-img'  }}"
                         src="data:image/png;base64,
                            {!!
                                base64_encode(QrCode::format('png')
                                ->errorCorrection('Q')
                                ->size('440')
                                ->margin(0)
                                ->generate( $item->key ) )
                            !!}"
                    />
                    <br/><br/><br/>
                @endforeach
            </div>
        </div>
    </body>
</html>
