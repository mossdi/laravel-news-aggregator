<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class SendTelegramCode implements ShouldQueue
{
    use Queueable;

    private string $apiKey;
    private string $code;
    private string $chatId;

    /**
     * Create a new job instance.
     */
    public function __construct(string $chatId, string $code)
    {
        $this->apiKey = config('telegram.api-key');

        $this->chatId = $chatId;
        $this->code = $code;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Http::post('https://api.telegram.org/bot' . $this->apiKey . '/sendMessage', [
            'chat_id' => $this->chatId,
            'text' => $this->code,
        ]);
    }
}
