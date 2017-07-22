<?php

namespace App\Http\Controllers\Service;

use App\Tool\Validate\ValidateCode;

use App\Http\Controllers\Controller;

class ValidateController extends Controller
{

    public function create()
    {
        $ValidateCode = new ValidateCode;

        return $ValidateCode->doimg();
    }

}
