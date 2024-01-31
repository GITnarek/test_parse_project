<?php

namespace App\UseCases;

use App\Models\CarModel;
use App\Services\DataValidationService;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class ParseCarModelsUseCase
{
    protected DataValidationService $dataValidationService;

    public function __construct(DataValidationService $dataValidationService)
    {
        $this->dataValidationService = $dataValidationService;
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        $url = config('app.drom_url');
        $response = Http::get($url);

        $crawler = new Crawler($response->body());

        $crawler->filter('.css-ofm6mg a')
            ->each(function ($node) {
                $name = $this->dataValidationService->extractModelName($node->text());
                $url = $node->attr('href');

                CarModel::query()->updateOrCreate([
                    'url' => $url
                ], [
                    'name' => $name
                ]);
            });
    }
}
