<?php

namespace App\Services;

class HealthCalculatorEngine
{
    /**
     * Main entry point for processing calculations.
     */
    public function calculate(string $formula, array $data): array
    {
        $method = str_ends_with($formula, '_calc') ? $formula : $formula . '_calc';
        
        if (method_exists($this, $method)) {
            return $this->$method($data);
        }
        
        // Fallback to snake_case if kebab-case slug was passed
        $snaked = str_replace('-', '_', $formula);
        $snakedMethod = str_ends_with($snaked, '_calc') ? $snaked : $snaked . '_calc';
        
        if (method_exists($this, $snakedMethod)) {
            return $this->$snakedMethod($data);
        }

        return ['success' => false, 'message' => "Formula '{$formula}' (resolved to '{$method}') not implemented in Health Engine."];
    }

    /**
     * 1. Calorie Calculator (Mifflin-St Jeor)
     */
    protected function calorie_calculator_calc(array $s): array
    {
        $gender = $s['gender'] ?? 'male';
        $weight = (float)($s['weight'] ?? 70);
        $height = (float)($s['height'] ?? 170);
        $age = (int)($s['age'] ?? 30);
        $multiplier = (float)($s['activity'] ?? 1.2);
        $units = $s['unit_system'] ?? 'metric';

        // Convert Imperial to Metric if necessary
        if ($units === 'imperial') {
            $weight = $weight * 0.453592; // lbs to kg
            $height = $height * 2.54;    // inches to cm
        }

        // BMR Calculation (Mifflin-St Jeor)
        if ($gender === 'male') {
            $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;
        } else {
            $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
        }

        $tdee = $bmr * $multiplier;

        return [
            'success' => true,
            'mainValue' => round($tdee),
            'mainLabel' => 'Maintenance Calories (TDEE)',
            'subStats' => [
                ['label' => 'BMR', 'value' => round($bmr) . ' kcal'],
                ['label' => 'Bulking (+500)', 'value' => round($tdee + 500) . ' kcal'],
                ['label' => 'Cutting (-500)', 'value' => round($tdee - 500) . ' kcal'],
            ],
            'macros' => [
                'maintenance' => $this->calculateMacros($tdee),
                'cutting' => $this->calculateMacros($tdee - 500),
                'bulking' => $this->calculateMacros($tdee + 500),
            ]
        ];
    }

    protected function calculateMacros($calories) {
        return [
            'protein' => round(($calories * 0.3) / 4) . 'g',
            'carbs' => round(($calories * 0.4) / 4) . 'g',
            'fats' => round(($calories * 0.3) / 9) . 'g',
        ];
    }

    /**
     * 2. Blood Pressure Interpreter
     */
    protected function blood_pressure_interpreter_calc(array $s): array
    {
        $sys = (int)($s['systolic'] ?? 120);
        $dia = (int)($s['diastolic'] ?? 80);

        $status = 'Normal';
        $badge = 'success';
        $insight = 'Your blood pressure is within the healthy range.';

        if ($sys >= 180 || $dia >= 120) {
            $status = 'Hypertensive Crisis';
            $badge = 'danger';
            $insight = 'EMERGENCY: Consult your doctor immediately.';
        } elseif ($sys >= 140 || $dia >= 90) {
            $status = 'Hypertension Stage 2';
            $badge = 'danger';
            $insight = 'High blood pressure alert. Medical consultation advised.';
        } elseif (($sys >= 130 && $sys <= 139) || ($dia >= 80 && $dia <= 89)) {
            $status = 'Hypertension Stage 1';
            $badge = 'warning';
            $insight = 'Stage 1 Hypertension detected. Monitor closely.';
        } elseif ($sys >= 120 && $sys <= 129 && $dia < 80) {
            $status = 'Elevated';
            $badge = 'info';
            $insight = 'Slightly elevated blood pressure. Consider lifestyle changes.';
        }

        return [
            'success' => true,
            'mainValue' => $status,
            'mainLabel' => 'Blood Pressure Status',
            'badgeType' => $badge,
            'subStats' => [
                ['label' => 'Reading', 'value' => "$sys / $dia mmHg"],
            ],
            'insights' => [$insight]
        ];
    }

    /**
     * 3. Pregnancy Due Date Calculator
     */
    protected function pregnancy_due_date_calculator_calc(array $s): array
    {
        $lmp = $s['lmp_date'] ?? date('Y-m-d');
        $cycle = (int)($s['cycle_length'] ?? 28);
        
        $date = new \DateTime($lmp);
        // Naegele's rule adjusted for cycle length
        $date->modify('+7 days');
        $date->modify('-3 months');
        $date->modify('+1 year');
        
        // Adjust for cycle length (standard is 28)
        $diff = $cycle - 28;
        if ($diff !== 0) {
            $date->modify(($diff > 0 ? '+' : '') . $diff . ' days');
        }

        $now = new \DateTime();
        $interval = $now->diff(new \DateTime($lmp));
        $weeks = floor($interval->days / 7);
        $days = $interval->days % 7;

        return [
            'success' => true,
            'mainValue' => $date->format('M d, Y'),
            'mainLabel' => 'Estimated Due Date',
            'subStats' => [
                ['label' => 'Current Progress', 'value' => "$weeks Weeks, $days Days"],
                ['label' => 'Trimester', 'value' => ($weeks < 13 ? '1st' : ($weeks < 27 ? '2nd' : '3rd'))],
            ]
        ];
    }

    /**
     * 4. Sleep Calculator
     */
    protected function sleep_calculator_calc(array $s): array
    {
        $type = $s['mode'] ?? 'wake'; // 'wake' = I want to wake up at, 'sleep' = I want to sleep at
        $time = $s['time'] ?? '07:00';
        
        $base = new \DateTime($time);
        $cycles = [];
        
        if ($type === 'wake') {
            // Calculate sleep times (going backwards)
            // 6 cycles (9h), 5 cycles (7.5h), 4 cycles (6h), 3 cycles (4.5h)
            for ($i = 6; $i >= 3; $i--) {
                $temp = clone $base;
                $mins = ($i * 90) + 15; // 15 mins to fall asleep
                $temp->modify("-$mins minutes");
                $cycles[] = $temp->format('h:i A');
            }
            $mainLabel = 'Best Times to Go to Bed';
        } else {
            // Calculate wake times (going forwards)
            for ($i = 3; $i <= 6; $i++) {
                $temp = clone $base;
                $mins = ($i * 90) + 15;
                $temp->modify("+$mins minutes");
                $cycles[] = $temp->format('h:i A');
            }
            $mainLabel = 'Best Times to Wake Up';
        }

        return [
            'success' => true,
            'mainValue' => $cycles[1], // Suggest 5 cycles (7.5h) as main
            'mainLabel' => $mainLabel,
            'subStats' => [
                ['label' => 'Optimal (9h)', 'value' => $cycles[0] ?? '--'],
                ['label' => 'Standard (7.5h)', 'value' => $cycles[1] ?? '--'],
                ['label' => 'Minimal (6h)', 'value' => $cycles[2] ?? '--'],
            ]
        ];
    }

    /**
     * 5. Waist-to-Hip Ratio Calculator
     */
    protected function waist_to_hip_ratio_calculator_calc(array $s): array
    {
        $waist = (float)($s['waist'] ?? 80);
        $hip = (float)($s['hip'] ?? 95);
        $gender = $s['gender'] ?? 'male';

        $ratio = $waist / ($hip ?: 1);
        $status = 'Low';
        $badge = 'success';

        if ($gender === 'male') {
            if ($ratio >= 1.0) { $status = 'Very High'; $badge = 'danger'; }
            elseif ($ratio >= 0.96) { $status = 'High'; $badge = 'warning'; }
            elseif ($ratio >= 0.90) { $status = 'Moderate'; $badge = 'info'; }
        } else {
            if ($ratio >= 0.86) { $status = 'Very High'; $badge = 'danger'; }
            elseif ($ratio >= 0.81) { $status = 'High'; $badge = 'warning'; }
            elseif ($ratio >= 0.80) { $status = 'Moderate'; $badge = 'info'; }
        }

        return [
            'success' => true,
            'mainValue' => number_format($ratio, 2),
            'mainLabel' => 'Waist-to-Hip Ratio',
            'badgeType' => $badge,
            'subStats' => [['label' => 'Health Risk', 'value' => $status]]
        ];
    }

    /**
     * 6. WHtR (Waist-to-Height Ratio)
     */
    protected function whtr_calculator_calc(array $s): array
    {
        $waist = (float)($s['waist'] ?? 80);
        $height = (float)($s['height'] ?? 170);
        $units = $s['unit_system'] ?? 'metric';

        $ratio = $waist / ($height ?: 1);
        $status = 'Healthy';
        $badge = 'success';

        if ($ratio > 0.6) { $status = 'High Risk'; $badge = 'danger'; }
        elseif ($ratio > 0.5) { $status = 'Overweight'; $badge = 'warning'; }
        elseif ($ratio < 0.4) { $status = 'Underweight'; $badge = 'info'; }

        return [
            'success' => true,
            'mainValue' => number_format($ratio, 2),
            'mainLabel' => 'Waist-to-Height Ratio',
            'badgeType' => $badge,
            'subStats' => [
                ['label' => 'Health Status', 'value' => $status],
                ['label' => 'Ideal Waist', 'value' => round($height * 0.45) . ' - ' . round($height * 0.5) . ($units === 'metric' ? 'cm' : 'in')]
            ]
        ];
    }

    /**
     * 7. VO2 Max Calculator (Cooper Test)
     */
    protected function vo2_max_calculator_calc(array $s): array
    {
        $distance = (float)($s['distance'] ?? 2000); // meters in 12 mins
        $units = $s['unit_system'] ?? 'metric';

        if ($units === 'imperial') {
            $distance = $distance * 1609.34; // miles to meters
        }

        // Cooper Test Formula: (Distance in meters - 504.9) / 44.73
        $vo2max = ($distance - 504.9) / 44.73;

        return [
            'success' => true,
            'mainValue' => number_format($vo2max, 1),
            'mainLabel' => 'VO2 Max (ml/kg/min)',
            'subStats' => [
                ['label' => 'Fitness Level', 'value' => $this->getVO2Level($vo2max, $s['gender'] ?? 'male')],
            ]
        ];
    }

    protected function getVO2Level($v, $g) {
        if ($g === 'male') {
            if ($v > 50) return 'Elite';
            if ($v > 40) return 'Good';
            return 'Fair';
        }
        if ($v > 45) return 'Elite';
        if ($v > 35) return 'Good';
        return 'Fair';
    }

    /**
     * 8. Steps to Distance Calculator
     */
    protected function steps_to_distance_calculator_calc(array $s): array
    {
        $steps = (int)($s['steps'] ?? 10000);
        $height = (float)($s['height'] ?? 170);
        $gender = $s['gender'] ?? 'male';
        $units = $s['unit_system'] ?? 'metric';

        // Stride Length Approximation
        $stride = $gender === 'male' ? ($height * 0.415) : ($height * 0.413);
        $totalDist = ($steps * $stride) / ($units === 'metric' ? 100000 : 63360); // cm to km or inches to miles

        return [
            'success' => true,
            'mainValue' => number_format($totalDist, 2) . ($units === 'metric' ? ' km' : ' miles'),
            'mainLabel' => 'Estimated Distance',
            'subStats' => [
                ['label' => 'Stride Length', 'value' => round($stride, 1) . ($units === 'metric' ? ' cm' : ' in')],
                ['label' => 'Calories Burnt', 'value' => round($steps * 0.04) . ' kcal'],
            ]
        ];
    }

    /**
     * 9. Life Expectancy Calculator (Simplified)
     */
    protected function life_expectancy_calculator_calc(array $s): array
    {
        $age = (int)($s['age'] ?? 30);
        $gender = $s['gender'] ?? 'male';
        $smoker = $s['is_smoker'] ?? false;
        $exercise = (int)($s['exercise_hours'] ?? 3);
        
        $base = ($gender === 'male' ? 76 : 81);
        $mod = 0;
        if ($smoker) $mod -= 10;
        if ($exercise > 5) $mod += 3;
        if ($exercise === 0) $mod -= 2;

        $results = $base + $mod;

        return [
            'success' => true,
            'mainValue' => $results,
            'mainLabel' => 'Estimated Life Expectancy',
            'subStats' => [
                ['label' => 'Remaining Years', 'value' => max(0, $results - $age)],
                ['label' => 'Gender Ave.', 'value' => $base],
            ]
        ];
    }

    /**
     * 10. Strength Standards (One-rep Max)
     */
    protected function strength_standards_calculator_calc(array $s): array
    {
        $weight = (float)($s['lift_weight'] ?? 100);
        $reps = (int)($s['reps'] ?? 5);
        $units = $s['unit_system'] ?? 'metric';

        // Brzycki Formula
        $orm = $weight * (36 / (37 - $reps));

        return [
            'success' => true,
            'mainValue' => round($orm) . ' ' . ($units === 'metric' ? 'kg' : 'lb'),
            'mainLabel' => 'Estimated 1-Rep Max',
            'subStats' => [
                ['label' => '80% Max', 'value' => round($orm * 0.8)],
                ['label' => '60% Max', 'value' => round($orm * 0.6)],
            ]
        ];
    }

    /**
     * 11. Swimming Pace Calculator
     */
    protected function swimming_pace_calculator_calc(array $s): array
    {
        $dist = (float)($s['distance'] ?? 1000); // meters
        $timeStr = $s['time'] ?? '00:20:00'; // HH:MM:SS
        
        $parts = explode(':', $timeStr);
        $seconds = ($parts[0] * 3600) + ($parts[1] * 60) + ($parts[2] ?? 0);
        
        $pacePer100 = ($seconds / $dist) * 100;
        $mins = floor($pacePer100 / 60);
        $secs = round($pacePer100 % 60);

        return [
            'success' => true,
            'mainValue' => sprintf('%02d:%02d', $mins, $secs) . ' / 100m',
            'mainLabel' => 'Swimming Pace',
            'subStats' => [
                ['label' => 'Total Time', 'value' => $timeStr],
                ['label' => 'Speed', 'value' => number_format(($dist / $seconds) * 3.6, 2) . ' km/h'],
            ]
        ];
    }

    /**
     * 12. Triathlon Pace Calculator
     */
    protected function triathlon_pace_calculator_calc(array $s): array
    {
        $type = $s['tri_type'] ?? 'olympic'; // sprint, olympic, half-iron, iron
        $target = $s['target_time'] ?? '03:00:00';

        $distances = [
            'sprint' => ['swim' => 0.75, 'bike' => 20, 'run' => 5],
            'olympic' => ['swim' => 1.5, 'bike' => 40, 'run' => 10],
            'half-iron' => ['swim' => 1.9, 'bike' => 90, 'run' => 21.1],
            'iron' => ['swim' => 3.8, 'bike' => 180, 'run' => 42.2],
        ];

        $d = $distances[$type];
        
        return [
            'success' => true,
            'mainValue' => ucfirst($type),
            'mainLabel' => 'Triathlon Breakdown',
            'subStats' => [
                ['label' => 'Swim Distance', 'value' => $d['swim'] . ' km'],
                ['label' => 'Bike Distance', 'value' => $d['bike'] . ' km'],
                ['label' => 'Run Distance', 'value' => $d['run'] . ' km'],
            ],
            'insights' => ["Target total time of $target requires elite endurance."]
        ];
    }
}
