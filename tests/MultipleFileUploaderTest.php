<?php


use Nam\ActiveObject\MultipleFileUploader;
use Nam\ActiveObject\UploadCommand;

class MultipleFileUploaderTest extends PHPUnit_Framework_TestCase
{

    public function testItCanUploadMultipleFile()
    {
        $multipleUploader = new MultipleFileUploader;

        $speed       = 8;
        $size        = 50;
        // chunk = 6.25
        $uploaderOne = new UploadCommand( $speed, $size, $multipleUploader );
        $multipleUploader->addUploader( $uploaderOne );

        $speed       = 4;
        $size        = 20;
        // chunk = 5
        $uploaderTwo = new UploadCommand( $speed, $size, $multipleUploader );
        $multipleUploader->addUploader( $uploaderTwo );

        $multipleUploader->run();
    }
}
 