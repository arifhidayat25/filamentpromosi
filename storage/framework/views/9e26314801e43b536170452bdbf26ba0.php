<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
<<<<<<< HEAD
    'circular' => true,
    'size' => 'md',
=======
    'size' => 'md',
    'src',
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
<<<<<<< HEAD
    'circular' => true,
    'size' => 'md',
]); ?>
<?php foreach (array_filter(([
    'circular' => true,
    'size' => 'md',
=======
    'size' => 'md',
    'src',
]); ?>
<?php foreach (array_filter(([
    'size' => 'md',
    'src',
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<<<<<<< HEAD
<img
    <?php echo e($attributes
            ->class([
                'fi-avatar object-cover object-center',
                'rounded-md' => ! $circular,
                'fi-circular rounded-full' => $circular,
                match ($size) {
                    'sm' => 'h-6 w-6',
                    'md' => 'h-8 w-8',
                    'lg' => 'h-10 w-10',
                    default => $size,
                },
            ])); ?>

/>
=======
<div
    <?php echo e($attributes
            ->class([
                'fi-avatar bg-cover bg-center',
                match ($size) {
                    'md' => 'h-9 w-9',
                    'lg' => 'h-10 w-10',
                    default => $size,
                },
            ])
            ->style([
                "background-image: url('{$src}')",
            ])); ?>

></div>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php /**PATH C:\laragon\www\magang\laravel-filament\vendor\filament\support\resources\views/components/avatar.blade.php ENDPATH**/ ?>