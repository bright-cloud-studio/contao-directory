<?php

namespace Bcs;

class Handler
{
    protected static $arrUserOptions = array();

    public function onProcessForm($submittedData, $formData, $files, $labels, $form)
    {
        dump_var($submittedData);
    }
}
