<?php

namespace App\Services\Processors;

class ProCalculatorProcessor extends BaseProcessor
{
    public function process(string|array $inputPath, string $slug, array $options): array
    {
        // Many pro calculators are health-related, others may be finance. 
        // We use the HealthCalculatorEngine for the relevant tools.
        $healthTools = [
            'calorie-calculator', 'pregnancy-due-date-calculator', 'sleep-calculator',
            'waist-to-hip-ratio-calculator', 'blood-pressure-interpreter', 'life-expectancy-calculator',
            'steps-to-distance-calculator', 'strength-standards-calculator', 'swimming-pace-calculator',
            'triathlon-pace-calculator', 'vo2-max-calculator', 'whtr-calculator'
        ];

        if (in_array($slug, $healthTools)) {
            $engine = new \App\Services\HealthCalculatorEngine();
            return $engine->calculate($slug, $options);
        }

        return ['success' => true, 'message' => 'Processing via ProCalculatorProcessor for ' . $slug, 'options' => $options];
    }
}
