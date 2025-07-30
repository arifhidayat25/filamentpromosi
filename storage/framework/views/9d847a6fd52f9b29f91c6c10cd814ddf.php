<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'label' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'label' => null,
]); ?>
<?php foreach (array_filter(([
    'label' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<fieldset
    <?php echo e($attributes->class([
            'fi-fieldset rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-white/5 dark:ring-white/10',
        ])); ?>

>
    <?php if(filled($label)): ?>
        <legend class="text-sm font-medium leading-6">
            <?php echo e($label); ?>

        </legend>
    <?php endif; ?>

    <?php echo e($slot); ?>

</fieldset>
<?php /**PATH C:\laragon\www\magang\laravel-filament\vendor\filament\support\resources\views/components/fieldset.blade.php ENDPATH**/ ?>