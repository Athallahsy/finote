<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'chartId',
    'chartOptions',
    'contentHeight',
    'pollingInterval',
    'loadingIndicator',
    'deferLoading',
    'readyToLoad',
    'darkMode',
    'extraJsOptions',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'chartId',
    'chartOptions',
    'contentHeight',
    'pollingInterval',
    'loadingIndicator',
    'deferLoading',
    'readyToLoad',
    'darkMode',
    'extraJsOptions',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div <?php echo $deferLoading ? ' wire:init="loadWidget" ' : ''; ?> class="flex items-center justify-center filament-apex-charts-chart"
    style="<?php echo e($contentHeight ? 'height: ' . $contentHeight . 'px;' : ''); ?>">
    <!--[if BLOCK]><![endif]--><?php if($readyToLoad): ?>
        <div id="chart"></div>
        <div x-ignore x-load
            x-load-src="<?php echo e(\Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('apexcharts')); ?>"
            x-data="apexcharts({
                options: <?php echo \Illuminate\Support\Js::from($chartOptions)->toHtml() ?>,
                chartId: '#<?php echo e($chartId); ?>',
                theme: <?php echo e($darkMode ? "document.querySelector('html').matches('.dark') ? 'dark' : 'light'" : "'light'"); ?>,
                extraJsOptions: <?php echo e($extraJsOptions ?? '{}'); ?>,
            })">
        </div>
        <div wire:ignore class="w-full filament-apex-charts-chart-container">

            <div class="filament-apex-charts-chart-object" x-ref="<?php echo e($chartId); ?>" id="<?php echo e($chartId); ?>">
            </div>

            <div <?php echo $pollingInterval ? 'wire:poll.' . $pollingInterval . '="updateOptions"' : ''; ?> x-data="{}" x-init="$watch('dropdownOpen', value => $wire.dropdownOpen = value)">
            </div>

        </div>
    <?php else: ?>
        <div class="filament-apex-charts-chart-loading-indicator m-auto">
            <!--[if BLOCK]><![endif]--><?php if($loadingIndicator): ?>
                <?php echo $loadingIndicator; ?>

            <?php else: ?>
                <?php if (isset($component)) { $__componentOriginalbef7c2371a870b1887ec3741fe311a10 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbef7c2371a870b1887ec3741fe311a10 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.loading-indicator','data' => ['class' => 'h-7 w-7 text-gray-500 dark:text-gray-400','wire:loading.delay' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::loading-indicator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-7 w-7 text-gray-500 dark:text-gray-400','wire:loading.delay' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbef7c2371a870b1887ec3741fe311a10)): ?>
<?php $attributes = $__attributesOriginalbef7c2371a870b1887ec3741fe311a10; ?>
<?php unset($__attributesOriginalbef7c2371a870b1887ec3741fe311a10); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbef7c2371a870b1887ec3741fe311a10)): ?>
<?php $component = $__componentOriginalbef7c2371a870b1887ec3741fe311a10; ?>
<?php unset($__componentOriginalbef7c2371a870b1887ec3741fe311a10); ?>
<?php endif; ?>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH C:\Users\user\Downloads\finote-patched\finote-main\vendor\leandrocfe\filament-apex-charts\src\/../resources/views/widgets/components/chart.blade.php ENDPATH**/ ?>