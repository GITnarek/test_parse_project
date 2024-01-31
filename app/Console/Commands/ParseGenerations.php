<?php

namespace App\Console\Commands;

use App\UseCases\ParseGenerationsUseCase;
use Illuminate\Console\Command;
use Throwable;

class ParseGenerations extends Command
{
    protected $signature = 'parse:generations';
    protected $description = 'Parse Audi generations for all markets';
    private ParseGenerationsUseCase $useCase;

    public function __construct(ParseGenerationsUseCase $useCase)
    {
        parent::__construct();
        $this->useCase = $useCase;
    }

    /**
     * @throws Throwable
     */
    public function handle(): void
    {
        try {
            $this->useCase->execute();
            $this->info('Audi generations parsed and saved successfully.');
        } catch (Throwable $e) {
            $this->error('[PARSE_ERROR]: ' . $e->getMessage());
        }
    }
}
