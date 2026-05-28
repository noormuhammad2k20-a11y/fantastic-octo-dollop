@extends('layouts.app')

@section('title', 'Stress Test - Multiple Interactive Tools')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Cross-Tool Stress Test</h1>
        <p class="lead text-secondary">Validating DOM/CSS/JS isolation across multiple interactive calculators.</p>
    </div>

    <div class="row g-5">
        <div class="col-lg-6">
            <h3 class="mb-4">Tool 1: Jupiter Sign</h3>
            @include('tools.interactive.jupiter-sign-calculator')
        </div>
        
        <div class="col-lg-6">
            <h3 class="mb-4">Tool 2: Saturn Sign</h3>
            @include('tools.interactive.saturn-sign-calculator')
        </div>

        <div class="col-lg-6">
            <h3 class="mb-4">Tool 3: Lucky Number Finder</h3>
            @include('tools.interactive.lucky-number-finder')
        </div>

        <div class="col-lg-6">
            <h3 class="mb-4">Tool 4: Personality Number</h3>
            @include('tools.interactive.personality-number-calculator')
        </div>
    </div>
</div>
@endsection
