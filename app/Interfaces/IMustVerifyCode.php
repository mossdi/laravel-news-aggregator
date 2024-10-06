<?php

namespace App\Interfaces;

interface IMustVerifyCode
{
    public function sendCodeNotification(): void;

    public function verifyCode(string $code): bool;

    public function hasVerifiedCode(): bool;
}
