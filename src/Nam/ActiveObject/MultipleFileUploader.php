<?php


namespace Nam\ActiveObject;


class MultipleFileUploader
{

    private $uploaders = [ ];

    public function addUploader( UploadCommand $uploader )
    {
        $this->uploaders[] = $uploader;
    }

    public function run()
    {
        while ( ! empty( $this->uploaders )) {
            $uploader = array_shift( $this->uploaders );
            /** @var UploadCommand $uploader */
            $uploader->execute();
        }
    }
}