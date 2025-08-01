<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'actions' => [],
    'breadcrumbs' => [],
    'heading',
    'subheading' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'actions' => [],
    'breadcrumbs' => [],
    'heading',
    'subheading' => null,
]); ?>
<?php foreach (array_filter(([
    'actions' => [],
    'breadcrumbs' => [],
    'heading',
    'subheading' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<header
    <?php echo e($attributes->class(['fi-header flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between'])); ?>

>
    <div>
<<<<<<< HEAD
        <!--[if BLOCK]><![endif]--><?php if($breadcrumbs): ?>
=======
        <?php if($breadcrumbs): ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
            <?php if (isset($component)) { $__componentOriginale1cebc129855f156aa8f78d22103aca1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale1cebc129855f156aa8f78d22103aca1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.breadcrumbs','data' => ['breadcrumbs' => $breadcrumbs,'class' => 'mb-2 hidden sm:block']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($breadcrumbs),'class' => 'mb-2 hidden sm:block']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale1cebc129855f156aa8f78d22103aca1)): ?>
<?php $attributes = $__attributesOriginale1cebc129855f156aa8f78d22103aca1; ?>
<?php unset($__attributesOriginale1cebc129855f156aa8f78d22103aca1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale1cebc129855f156aa8f78d22103aca1)): ?>
<?php $component = $__componentOriginale1cebc129855f156aa8f78d22103aca1; ?>
<?php unset($__componentOriginale1cebc129855f156aa8f78d22103aca1); ?>
<?php endif; ?>
<<<<<<< HEAD
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
=======
        <?php endif; ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589

        <h1
            class="fi-header-heading text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl"
        >
            <?php echo e($heading); ?>

        </h1>

<<<<<<< HEAD
        <!--[if BLOCK]><![endif]--><?php if($subheading): ?>
=======
        <?php if($subheading): ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
            <p
                class="fi-header-subheading mt-2 max-w-2xl text-lg text-gray-600 dark:text-gray-400"
            >
                <?php echo e($subheading); ?>

            </p>
<<<<<<< HEAD
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    <div
        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'flex shrink-0 items-center gap-3',
            'sm:mt-7' => $breadcrumbs,
        ]); ?>"
    >
        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_HEADER_ACTIONS_BEFORE, scopes: $this->getRenderHookScopes())); ?>


        <!--[if BLOCK]><![endif]--><?php if($actions): ?>
            <?php if (isset($component)) { $__componentOriginal59d80b1aec4ae4c914a3e52dede19504 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal59d80b1aec4ae4c914a3e52dede19504 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.actions','data' => ['actions' => $actions]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::actions'); ?>
=======
        <?php endif; ?>
    </div>

    <?php if($actions): ?>
        <?php if (isset($component)) { $__componentOriginalb2f112d7b18f6837dfc4fbc7ec4524d2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb2f112d7b18f6837dfc4fbc7ec4524d2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-actions::components.actions','data' => ['actions' => $actions,'class' => \Illuminate\Support\Arr::toCssClasses([
                'shrink-0',
                'sm:mt-7' => $breadcrumbs,
            ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-actions::actions'); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<<<<<<< HEAD
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actions)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal59d80b1aec4ae4c914a3e52dede19504)): ?>
<?php $attributes = $__attributesOriginal59d80b1aec4ae4c914a3e52dede19504; ?>
<?php unset($__attributesOriginal59d80b1aec4ae4c914a3e52dede19504); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal59d80b1aec4ae4c914a3e52dede19504)): ?>
<?php $component = $__componentOriginal59d80b1aec4ae4c914a3e52dede19504; ?>
<?php unset($__componentOriginal59d80b1aec4ae4c914a3e52dede19504); ?>
<?php endif; ?>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_HEADER_ACTIONS_AFTER, scopes: $this->getRenderHookScopes())); ?>

    </div>
=======
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actions),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                'shrink-0',
                'sm:mt-7' => $breadcrumbs,
            ]))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb2f112d7b18f6837dfc4fbc7ec4524d2)): ?>
<?php $attributes = $__attributesOriginalb2f112d7b18f6837dfc4fbc7ec4524d2; ?>
<?php unset($__attributesOriginalb2f112d7b18f6837dfc4fbc7ec4524d2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb2f112d7b18f6837dfc4fbc7ec4524d2)): ?>
<?php $component = $__componentOriginalb2f112d7b18f6837dfc4fbc7ec4524d2; ?>
<?php unset($__componentOriginalb2f112d7b18f6837dfc4fbc7ec4524d2); ?>
<?php endif; ?>
    <?php endif; ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
</header>
<?php /**PATH C:\laragon\www\magang\laravel-filament\vendor\filament\filament\resources\views/components/header/index.blade.php ENDPATH**/ ?>