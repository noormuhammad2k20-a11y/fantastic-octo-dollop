<?php

namespace App\Services;

use App\Services\Processors\UtilityProcessor;
use App\Services\Processors\Batch3Processor;
use App\Services\Processors\ProCalculatorProcessor;
use Exception;

class ProcessorFactory
{
    /**
     * Make the appropriate processor based on the tool configuration.
     */
    public static function make(string $type)
    {
        return match ($type) {
            // Batch 3 Processors mapped to the same unified handler
            'convert-font' => new Batch3Processor(),
            'convert-cad' => new Batch3Processor(),
            'convert-financial' => new Batch3Processor(),
            'convert-data' => new Batch3Processor(),
            'convert-financial-report' => new Batch3Processor(),
            'extract-web' => new Batch3Processor(),
            'url-shortener' => new Batch3Processor(),
            'pro_calculator' => new ProCalculatorProcessor(),
            'pro' => new ProCalculatorProcessor(),

            default => new UtilityProcessor(),
        };
    }
}
