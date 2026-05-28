

<?php
    $cat = $category ?? ($tool['category'] ?? '');
    $medicalCategories = ['medical', 'health', 'clinical'];
    $financeCategories = ['finance', 'finance-tax', 'investment', 'real-estate', 'business', 'legal'];
?>

<?php if(in_array($cat, $medicalCategories)): ?>
<div class="disclaimer-block medical-disclaimer" role="alert">
    <div class="disclaimer-inner">
        <div class="disclaimer-icon">
            <i class="fas fa-notes-medical"></i>
        </div>
        <div>
            <strong>Medical Disclaimer:</strong> This tool is for educational and informational purposes only. 
            It is not a substitute for professional medical advice, diagnosis, or treatment. 
            Always consult a qualified healthcare provider before making any health-related decisions. 
            Do not disregard or delay seeking professional medical advice because of information obtained from this tool.
        </div>
    </div>
</div>
<?php endif; ?>

<?php if(in_array($cat, $financeCategories)): ?>
<div class="disclaimer-block finance-disclaimer" role="alert">
    <div class="disclaimer-inner">
        <div class="disclaimer-icon">
            <i class="fas fa-balance-scale"></i>
        </div>
        <div>
            <strong>Financial Disclaimer:</strong> This calculator provides estimates for informational purposes only. 
            Results are not financial, tax, or legal advice. Actual results may vary based on your specific circumstances. 
            Consult a certified financial advisor, tax professional, or attorney for advice tailored to your situation.
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (! $__env->hasRenderedOnce('a600840e-3c5b-4a1d-8a84-70978c0695e6')): $__env->markAsRenderedOnce('a600840e-3c5b-4a1d-8a84-70978c0695e6');
$__env->startPush('styles'); ?>
<style>
    .disclaimer-block {
        margin: 1.5rem 0;
        border-radius: 12px;
        font-size: 0.9rem;
        line-height: 1.6;
        color: #4b5563;
    }
    .disclaimer-inner {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 1.25rem 1.5rem;
    }
    .disclaimer-icon {
        flex-shrink: 0;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }
    .medical-disclaimer {
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-left: 4px solid #ef4444;
    }
    .medical-disclaimer .disclaimer-icon {
        background: #fee2e2;
        color: #dc2626;
    }
    .finance-disclaimer {
        background: #fffbeb;
        border: 1px solid #fed7aa;
        border-left: 4px solid #f59e0b;
    }
    .finance-disclaimer .disclaimer-icon {
        background: #fef3c7;
        color: #d97706;
    }
    .disclaimer-block strong {
        color: #1f2937;
    }
</style>
<?php $__env->stopPush(); endif; ?>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views/partials/disclaimers.blade.php ENDPATH**/ ?>