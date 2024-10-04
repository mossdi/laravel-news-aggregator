<?php

namespace App\Exceptions;

use Exception;

class TelegramApiKeyIsNull extends Exception
{
    protected $message = "Telegram apy key is not provided";
}
