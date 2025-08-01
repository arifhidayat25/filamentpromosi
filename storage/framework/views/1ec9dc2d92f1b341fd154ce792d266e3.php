<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'heading' => null,
    'logo' => true,
    'subheading' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'heading' => null,
    'logo' => true,
    'subheading' => null,
]); ?>
<?php foreach (array_filter(([
    'heading' => null,
    'logo' => true,
    'subheading' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<<<<<<< HEAD
<header class="fi-simple-header flex flex-col items-center">
    <!--[if BLOCK]><![endif]--><?php if($logo): ?>
        <?php if (isset($component)) { $__componentOriginalb501e8c73315a10eb0eb5fd14fda0d94 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb501e8c73315a10eb0eb5fd14fda0d94 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.logo','data' => ['class' => 'mb-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
=======
<header class="fi-simple-header">
    <?php if($logo): ?>
        <div class="mb-4 flex justify-center">
            <?php if (isset($component)) { $__componentOriginalb501e8c73315a10eb0eb5fd14fda0d94 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb501e8c73315a10eb0eb5fd14fda0d94 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.logo','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php $component->withName('filament-panels::logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<<<<<<< HEAD
<?php $component->withAttributes(['class' => 'mb-4']); ?>
=======
<?php $component->withAttributes([]); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb501e8c73315a10eb0eb5fd14fda0d94)): ?>
<?php $attributes = $__attributesOriginalb501e8c73315a10eb0eb5fd14fda0d94; ?>
<?php unset($__attributesOriginalb501e8c73315a10eb0eb5fd14fda0d94); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb501e8c73315a10eb0eb5fd14fda0d94)): ?>
<?php $component = $__componentOriginalb501e8c73315a10eb0eb5fd14fda0d94; ?>
<?php unset($__componentOriginalb501e8c73315a10eb0eb5fd14fda0d94); ?>
<?php endif; ?>
<<<<<<< HEAD
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!--[if BLOCK]><![endif]--><?php if(filled($heading)): ?>
=======
        </div>
    <?php endif; ?>

    <?php if(filled($heading)): ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
        <h1
            class="fi-simple-header-heading text-center text-2xl font-bold tracking-tight text-gray-950 dark:text-white"
        >
            <?php echo e($heading); ?>

        </h1>
<<<<<<< HEAD
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!--[if BLOCK]><![endif]--><?php if(filled($subheading)): ?>
=======
    <?php endif; ?>

    <?php if(filled($subheading)): ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
        <p
            class="fi-simple-header-subheading mt-2 text-center text-sm text-gray-500 dark:text-gray-400"
        >
            <?php echo e($subheading); ?>

        </p>
<<<<<<< HEAD
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
=======
    <?php endif; ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
</header>
<?php /**PATH C:\laragon\www\magang\laravel-filament\vendor\filament\filament\resources\views/components/header/simple.blade.php ENDPATH**/ ?>