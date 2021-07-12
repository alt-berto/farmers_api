<?php

// Libs
use Illuminate\Support\Str;
use function Aws\filter;


// Read S3 Files
function read_file( $bucket, $keyname ) {
    $s3 = \AWS::createClient('s3');
    try {
        $file_exist = $s3->doesObjectExist( $bucket, $keyname );
        if ( $file_exist ) {
            $cmd = $s3->getCommand( 'GetObject', [
                'Bucket' => $bucket,
                'Key' => $keyname
            ] );
            $request = $s3->createPresignedRequest( $cmd, '+120 minutes' );
            $presigned_url = (string)$request->getUri(  );
            return $presigned_url;
        }
    } catch (\Throwable $th) {
        throw $th;
    }
    return '';
}

// Random String
function random_string( $size ) {
    $bytes = random_bytes( $size / 2 );
    return bin2hex( $bytes );
}


if (!function_exists('urlGenerator')) {
    /**
     * @return \Laravel\Lumen\Routing\UrlGenerator
     */
    function urlGenerator() {
        return new \Laravel\Lumen\Routing\UrlGenerator(app());
    }
}

if (!function_exists('asset')) {
    /**
     * @param $path
     * @param bool $secured
     *
     * @return string
     */
    function asset($path, $secured = false) {
        return urlGenerator()->asset($path, $secured);
    }
}

if (!function_exists('public_path')) {
    /**
     * Get the path to the public folder.
     *
     * @param  string $path
     * @return string
     */
     function public_path($path = '')
     {
         return env('PUBLIC_PATH', base_path('public')) . ($path ? '/' . $path : $path);
     }
 }
