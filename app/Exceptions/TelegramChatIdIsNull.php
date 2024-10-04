<?php

namespace App\Exceptions;

use Exception;

class TelegramChatIdIsNull extends Exception
{
    protected $message = "Telegram user chat id is not provided";
}
