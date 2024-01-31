<?php

namespace App\UseCases;

use App\Models\CarModel;
use App\Services\DataValidationService;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class ParseGenerationsUseCase
{
    protected DataValidationService $dataValidationService;

    public function __construct(DataValidationService $dataValidationService)
    {
        $this->dataValidationService = $dataValidationService;
    }

    public function execute(): void
    {
        $carModels = CarModel::all();

        foreach ($carModels as $carModel) {
            $url = $carModel->url;
            $response = Http::get($url);
            $crawler = new Crawler($response->body());

            /** @var CarModel $carModel */
            $regions = $carModel->country_market;

            foreach ($regions as $region) {
                $crawler->filter('.css-pyemnz')->each(function ($container) use ($carModel, $region, $url) {
                    if ($container->filter("#{$region}")->count() > 0) {
                        $container->filter("div[data-ga-stats-name='generations_outlet_item']")
                            ->each(function ($node) use ($carModel, $region, $url) {
                                $market = $region;
                                $name = $this->dataValidationService->extractModelName($node->filter('span[data-ftid="component_article_caption"] span')->text());
                                $period = $this->dataValidationService->extractModelPeriod($node->filter('span[data-ftid="component_article_caption"] span')->text()) ?? null;
                                $generation = $node->filter('div[data-ftid="component_article_extended-info"] div')->first()->text();
                                $image_path = $node->filter('a[data-ftid="component_article"] img')->attr('src');
                                $tech_specs_path = $url . $node->filter('a[data-ftid="component_article"]')->attr('href');

                                $values = [
                                    'market' => $market,
                                    'name' => $name,
                                    'period' => $period,
                                    'generation' => $generation,
                                    'image_path' => $image_path,
                                ];

                                $carModel->generations()->updateOrCreate([
                                    'tech_specs_path' => $tech_specs_path
                                ], $values);
                            });
                    }
                });
            }
        }
    }
}
