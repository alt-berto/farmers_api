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
