<?php

namespace App\Console\Commands;

use App\UseCases\ParseCarModelsUseCase;
use Illuminate\Console\Command;

class ParseCarModels extends Command
{
    protected $signature = 'parse:car-models';
    protected $description = 'Parse Audi car models';

    private ParseCarModelsUseCase $useCase;

    /**
     * @param ParseCarModelsUseCase $useCase
     */
    public function __construct(ParseCarModelsUseCase $useCase)
    {
        parent::__construct();
        $this->useCase = $useCase;
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        try {
            $this->useCase->execute();
            $this->info('Audi car models parsed and saved successfully.');
        } catch (\Throwable $e) {
            $this->error('[PARSE_ERROR]: ' . $e->getMessage());
        }
    }
}
