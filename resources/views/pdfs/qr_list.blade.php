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

            body{
                font-size: 0;
                /** font-family: Arial, Helvetica, sans-serif;**/
            }
            .center{
                width: 100% !important;
                height: 100% !important;
                margin: 0 0 0 0;
            }
        </style>
    <body>
        <div id="container">
            <div class="center">
                @foreach( $items as $item )
                    <img style="display: inline-block; vertical-align: middle; width: 80px; margin-bottom: 20px; font-size: 12px;"
                         alt="{{ $item->key . '-img'  }}"
                         src="data:image/png;base64,
                            {!!
                                base64_encode(QrCode::format('png')
                                ->errorCorrection('Q')
                                ->size('80')
                                ->margin(0)
                                ->generate( $item->key ) )
                            !!}"
                    />
                    
                @endforeach
                <p>.</p>
            </div>
        </div>
    </body>
</html>
