<?php
    $plugin = (function_exists('filament') && filament()->isServing()) ? \Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin::get() : null;
    $heading = $this->getHeading();
    $subheading = $this->getSubheading();
    $filters = $this->getFilters();
    $indicatorsCount = $this->getIndicatorsCount();
    $darkMode = $this->getDarkMode();
    $width = $this->getFilterFormWidth();
    $pollingInterval = $this->getPollingInterval();
    $chartId = $this->getChartId();
    $chartOptions = $this->getOptions();
    $filterFormAccessible = $this->getFilterFormAccessible();
    $loadingIndicator = $this->getLoadingIndicator();
    $contentHeight = $this->getContentHeight();
    $deferLoading = $this->getDeferLoading();
    $footer = $this->getFooter();
    $readyToLoad = $this->readyToLoad;
    $extraJsOptions = $this->extraJsOptions();
?>
<?php if (isset($component)) { $__componentOriginalb525200bfa976483b4eaa0b7685c6e24 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb525200bfa976483b4eaa0b7685c6e24 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-widgets::components.widget','data' => ['class' => 'filament-widgets-chart-widget filament-apex-charts-widget']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-widgets::widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'filament-widgets-chart-widget filament-apex-charts-widget']); ?>
    <?php if (isset($component)) { $__componentOriginal9b945b32438afb742355861768089b04 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9b945b32438afb742355861768089b04 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.card','data' => ['class' => 'filament-apex-charts-card']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'filament-apex-charts-card']); ?>
        <div x-data="{ dropdownOpen: false }" @apexhcharts-dropdown.window="dropdownOpen = $event.detail.open">

            <?php if (isset($component)) { $__componentOriginald9d230b37b44dbcd5ca3c381b79c72e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald9d230b37b44dbcd5ca3c381b79c72e4 = $attributes; } ?>
<?php $component = Leandrocfe\FilamentApexCharts\Components\Header::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-apex-charts::header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Leandrocfe\FilamentApexCharts\Components\Header::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($heading),'subheading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subheading),'filters' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filters),'indicatorsCount' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($indicatorsCount),'width' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($width),'filterFormAccessible' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filterFormAccessible)]); ?>
                 <?php $__env->slot('filterForm', null, []); ?> 
                    <?php echo e($this->form); ?>

                 <?php $__env->endSlot(); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald9d230b37b44dbcd5ca3c381b79c72e4)): ?>
<?php $attributes = $__attributesOriginald9d230b37b44dbcd5ca3c381b79c72e4; ?>
<?php unset($__attributesOriginald9d230b37b44dbcd5ca3c381b79c72e4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald9d230b37b44dbcd5ca3c381b79c72e4)): ?>
<?php $component = $__componentOriginald9d230b37b44dbcd5ca3c381b79c72e4; ?>
<?php unset($__componentOriginald9d230b37b44dbcd5ca3c381b79c72e4); ?>
<?php endif; ?>

            <?php if (isset($component)) { $__componentOriginal42f04f3b4393322830ce3f497dfbcde9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42f04f3b4393322830ce3f497dfbcde9 = $attributes; } ?>
<?php $component = Leandrocfe\FilamentApexCharts\Components\Chart::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-apex-charts::chart'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Leandrocfe\FilamentApexCharts\Components\Chart::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['chartId' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($chartId),'chartOptions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($chartOptions),'contentHeight' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contentHeight),'pollingInterval' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pollingInterval),'loadingIndicator' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($loadingIndicator),'darkMode' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($darkMode),'deferLoading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($deferLoading),'readyToLoad' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($readyToLoad),'extraJsOptions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($extraJsOptions)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal42f04f3b4393322830ce3f497dfbcde9)): ?>
<?php $attributes = $__attributesOriginal42f04f3b4393322830ce3f497dfbcde9; ?>
<?php unset($__attributesOriginal42f04f3b4393322830ce3f497dfbcde9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal42f04f3b4393322830ce3f497dfbcde9)): ?>
<?php $component = $__componentOriginal42f04f3b4393322830ce3f497dfbcde9; ?>
<?php unset($__componentOriginal42f04f3b4393322830ce3f497dfbcde9); ?>
<?php endif; ?>

            <!--[if BLOCK]><![endif]--><?php if($footer): ?>
                <div class="relative">
                    <?php echo $footer; ?>

                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9b945b32438afb742355861768089b04)): ?>
<?php $attributes = $__attributesOriginal9b945b32438afb742355861768089b04; ?>
<?php unset($__attributesOriginal9b945b32438afb742355861768089b04); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9b945b32438afb742355861768089b04)): ?>
<?php $component = $__componentOriginal9b945b32438afb742355861768089b04; ?>
<?php unset($__componentOriginal9b945b32438afb742355861768089b04); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb525200bfa976483b4eaa0b7685c6e24)): ?>
<?php $attributes = $__attributesOriginalb525200bfa976483b4eaa0b7685c6e24; ?>
<?php unset($__attributesOriginalb525200bfa976483b4eaa0b7685c6e24); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb525200bfa976483b4eaa0b7685c6e24)): ?>
<?php $component = $__componentOriginalb525200bfa976483b4eaa0b7685c6e24; ?>
<?php unset($__componentOriginalb525200bfa976483b4eaa0b7685c6e24); ?>
<?php endif; ?>
<?php /**PATH C:\Users\user\Downloads\finote-patched\finote-main\vendor\leandrocfe\filament-apex-charts\src\/../resources/views/widgets/apex-chart-widget.blade.php ENDPATH**/ ?>