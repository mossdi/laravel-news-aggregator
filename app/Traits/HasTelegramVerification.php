<?php

namespace App\Traits;

use App\Exceptions\TelegramApiKeyIsNull;
use App\Jobs\SendTelegramCode;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Exceptions\TelegramChatIdIsNull;

trait HasTelegramVerification
{
    private string $code;

    /**
     * @param int $codeLength
     * @throws TelegramApiKeyIsNull
     * @throws TelegramChatIdIsNull
     */
    public function sendCodeNotification(int $codeLength = 6): void
    {
        $this->throwExceptionIfApiKeyIsNull();
        $this->throwExceptionIfChatIdIsNull();

        $this
            ->forceFill([
                'verification_code' => Hash::make($this->generateSecretCode($codeLength)),
                'verified_at' => null,
            ])
            ->save();

        dispatch(new SendTelegramCode($this->getChatForVerification(), $this->code));
    }

    public function verifyCode(string $code): bool
    {
        if (Hash::check($code, $this->verification_code)) {
            $this
                ->forceFill([
                    'verification_code' => null,
                    'verified_at' => Carbon::now(),
                ])
                ->save();

            return true;
        }

        $this
            ->forceFill(['verification_code' => null])
            ->save();

        return false;
    }

    public function hasVerifiedCode(): bool
    {
        return !is_null($this->verified_at);
    }

    private function getChatForVerification(): string
    {
        return $this->chat_id;
    }

    private function generateSecretCode(int $codeLength): string
    {
        return $this->code = strtoupper(Str::random($codeLength));
    }

    /**
     * @throws TelegramApiKeyIsNull
     */
    private function throwExceptionIfApiKeyIsNull(): void
    {
        if (is_null(config('telegram.api-key'))) {
            throw new TelegramApiKeyIsNull();
        }
    }

    /**
     * @throws TelegramChatIdIsNull
     */
    private function throwExceptionIfChatIdIsNull(): void
    {
        if (is_null($this->chat_id)) {
            throw new TelegramChatIdIsNull();
        }
    }
}
