<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'alias' => null,
    'class' => '',
    'icon' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'alias' => null,
    'class' => '',
    'icon' => null,
]); ?>
<?php foreach (array_filter(([
    'alias' => null,
    'class' => '',
    'icon' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
<<<<<<< HEAD
    $icon = ($alias ? \Filament\Support\Facades\FilamentIcon::resolve($alias) : null) ?: ($icon ?? $slot);
?>

<!--[if BLOCK]><![endif]--><?php if($icon instanceof \Illuminate\Contracts\Support\Htmlable): ?>
    <span <?php echo e($attributes->class($class)); ?>>
        <?php echo e($icon); ?>

    </span>
<?php elseif(str_contains($icon, '/')): ?>
    <img
        <?php echo e($attributes
                ->merge(['src' => $icon])
                ->class($class)); ?>

    />
<?php else: ?>
    <?php echo e(svg($icon,
        $class,
        array_filter($attributes->getAttributes()),)); ?>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->
=======
    $icon = ($alias ? \Filament\Support\Facades\FilamentIcon::resolve($alias) : null) ?: $icon;
?>

<?php if(is_string($icon)): ?>
    <?php echo e(svg($icon, $class, array_filter($attributes->getAttributes()))); ?>
<?php else: ?>
    <div <?php echo e($attributes->class($class)); ?>>
        <?php echo e($icon ?? $slot); ?>

    </div>
<?php endif; ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php /**PATH C:\laragon\www\magang\laravel-filament\vendor\filament\support\resources\views/components/icon.blade.php ENDPATH**/ ?>