<?php

namespace Log;

interface Log {

    public function logError($errCocde, $errLogBy, $errMsg);

}