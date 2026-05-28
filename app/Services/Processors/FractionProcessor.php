<?php

namespace App\Services\Processors;

use App\Services\FractionService;

class FractionProcessor
{
    /**
     * Process fraction logic (Backend fallback)
     */
    public function process($file, string $slug, array $options = [])
    {
        try {
            $formula = $options['formula'] ?? '';
            $result = "";

            switch ($formula) {
                case 'reduce_fractions':
                case 'fraction_simplifier':
                    $f = FractionService::simplify($options['numerator'] ?? 0, $options['denominator'] ?? 1);
                    $result = $f[0] . '/' . $f[1];
                    break;
                case 'mixed_to_fraction':
                    $w = $options['whole'] ?? 0;
                    $n = $options['numerator'] ?? 0;
                    $d = $options['denominator'] ?? 1;
                    $sign = $w < 0 ? -1 : 1;
                    $newN = $sign * (abs($w) * $d + $n);
                    $f = FractionService::simplify($newN, $d);
                    $result = $f[0] . '/' . $f[1];
                    break;
                case 'fraction_to_percent':
                    $n = $options['numerator'] ?? 0;
                    $d = $options['denominator'] ?? 1;
                    $result = round(($n / $d) * 100, 2) . '%';
                    break;
                case 'decimal_to_fraction':
                    $f = FractionService::fromDecimal($options['decimal'] ?? '0');
                    $result = $f[0] . '/' . $f[1];
                    break;
                // Add other cases as needed...
            }

            return [
                'success' => true,
                'content' => $result
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
