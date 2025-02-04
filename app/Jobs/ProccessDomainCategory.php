<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use App\Models\Domain;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProccessDomainCategory implements ShouldQueue
{
    use Queueable;

    protected string $prompt;
    protected string $domain;
    protected int $user_id;

    /**
     * Create a new job instance.
     */
    public function __construct(string $domain, int $user_id)
    {
        $this->user_id = $user_id;
        $this->domain = $domain;
        $this->prompt = "Categorize the website {$this->domain} into one of the following categories and respond with *only the corresponding number* (1-10): Redes Sociais (1), E-commerce (2), Entretenimento (3), Educação (4), Notícias (5), Tecnologia (6), Finanças (7), Saúde (8), Adulto (9), Outros (10).";
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $geminiKey = config("services.gemini");
            $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro:generateContent?key=" . $geminiKey;
            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post($apiUrl, [
                "contents" => [
                    "parts" => ["text" => $this->prompt]
                ]]);

            if ($response->failed()) {
                $status = $response->status();
                $body = $response->body();
                Log::error("Gemini API request failed with status: {$status}, body: {$body}");
                return;
            }

            $data = json_decode($response,true);
            $categoryId = 0;
            if(isset($data) && !empty($data)){
                $categoryId = intval(trim($data['candidates'][0]['content']['parts'][0]['text']));
            }

            if ($categoryId < 1 || $categoryId > 10) {
                $body = $response->body();
                Log::warning("Resposta inválida da API para domínio: $categoryId");
                return;
            }

            Domain::create([
                'name' => $this->domain,
                'user_id' => $this->user_id,
                'category_id' => $categoryId
            ]);
            Log::info('Job successfully completed.');

        } catch (\Exception $e) {
            Log::error("Erro no Job ProcessDomainCategory: " . $e->getMessage());
        }
    }
}
