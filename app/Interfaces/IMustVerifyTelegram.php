<?php

namespace App\Interfaces;

interface IMustVerifyTelegram
{
    public function sendCodeNotification(): void;

    public function verifyCode(string $code): bool;

    public function hasVerifiedCode(): bool;
}
