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
        $this->prompt = "de acordo com esta lista: Redes Sociais, E-commerce, Entretenimento, Educação, Notícias, Tecnologia, Finanças, Saúde, Adulto, Outros.
            Imagine que os valores estão enumerados de 1 a 10, me fale, em apenas um número como resposta, qual destas categorias se encaixa melhor com este domínio dns: $this->domain?
            OBSERVAÇÃO: ME RESPONDA APENAS COM O NÚMERO CORRESPONDENTE AO DA LISTA!!";
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

            $data = $response->json();
            $categoryId = (int) trim($data['choices'][0]['message']['content'] ?? "0");

            if ($categoryId < 1 || $categoryId > 10) {
                Log::warning("Resposta inválida da API para domínio {$this->domain}: {$categoryId}");
                return;
            }

            Domain::create([
                'name' => $this->domain,
                'user_id' => $this->user_id,
                'category_id' => $categoryId
            ]);

        } catch (\Exception $e) {
            Log::error("Erro no Job ProcessDomainCategory: " . $e->getMessage());
        }
    }
}
