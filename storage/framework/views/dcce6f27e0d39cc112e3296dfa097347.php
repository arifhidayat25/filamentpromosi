<<<<<<< HEAD
<?php
    use Filament\Support\Enums\Alignment;
?>

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'activelySorted' => false,
    'alignment' => Alignment::Start,
=======
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'activelySorted' => false,
    'alignment' => null,
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    'name',
    'sortable' => false,
    'sortDirection',
    'wrap' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'activelySorted' => false,
<<<<<<< HEAD
    'alignment' => Alignment::Start,
=======
    'alignment' => null,
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    'name',
    'sortable' => false,
    'sortDirection',
    'wrap' => false,
]); ?>
<?php foreach (array_filter(([
    'activelySorted' => false,
<<<<<<< HEAD
    'alignment' => Alignment::Start,
=======
    'alignment' => null,
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    'name',
    'sortable' => false,
    'sortDirection',
    'wrap' => false,
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
    if (! $alignment instanceof Alignment) {
        $alignment = filled($alignment) ? (Alignment::tryFrom($alignment) ?? $alignment) : null;
    }
?>

<th
    <?php if($activelySorted): ?>
        aria-sort="<?php echo e($sortDirection === 'asc' ? 'ascending' : 'descending'); ?>"
    <?php endif; ?>
    <?php echo e($attributes->class(['fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6'])); ?>
=======
    use Filament\Support\Enums\Alignment;
?>

<th
    <?php echo e($attributes
            ->class(['fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6'])); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589

>
    <<?php echo e($sortable ? 'button' : 'span'); ?>

        <?php if($sortable): ?>
<<<<<<< HEAD
            aria-label="<?php echo e(trim(strip_tags($slot))); ?>"
=======
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
            type="button"
            wire:click="sortTable('<?php echo e($name); ?>')"
        <?php endif; ?>
        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'group flex w-full items-center gap-x-1',
            'whitespace-nowrap' => ! $wrap,
            'whitespace-normal' => $wrap,
            match ($alignment) {
<<<<<<< HEAD
                Alignment::Start => 'justify-start',
                Alignment::Center => 'justify-center',
                Alignment::End => 'justify-end',
                Alignment::Left => 'justify-start rtl:flex-row-reverse',
                Alignment::Right => 'justify-end rtl:flex-row-reverse',
                Alignment::Justify, Alignment::Between => 'justify-between',
                default => $alignment,
            },
        ]); ?>"
    >
        <span
            class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white"
        >
=======
                Alignment::Center, 'center' => 'justify-center',
                Alignment::End, 'end' => 'justify-end',
                Alignment::Left, 'left' => 'justify-start rtl:flex-row-reverse',
                Alignment::Right, 'right' => 'justify-end rtl:flex-row-reverse',
                Alignment::Start, 'start' => 'justify-start',
                default => null,
            },
        ]); ?>"
    >
        <?php if($sortable): ?>
            <span class="sr-only">
                <?php echo e(__('filament-tables::table.sorting.fields.column.label')); ?>

            </span>
        <?php endif; ?>

        <span class="text-sm font-semibold text-gray-950 dark:text-white">
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
            <?php echo e($slot); ?>

        </span>

<<<<<<< HEAD
        <!--[if BLOCK]><![endif]--><?php if($sortable): ?>
            <?php if (isset($component)) { $__componentOriginalbfc641e0710ce04e5fe02876ffc6f950 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['alias' => 
                    match (true) {
                        $activelySorted && ($sortDirection === 'asc') => 'tables::header-cell.sort-asc-button',
                        $activelySorted && ($sortDirection === 'desc') => 'tables::header-cell.sort-desc-button',
                        default => 'tables::header-cell.sort-button',
                    }
                ,'icon' => $activelySorted && $sortDirection === 'asc' ? 'heroicon-m-chevron-up' : 'heroicon-m-chevron-down','class' => \Illuminate\Support\Arr::toCssClasses([
                    'fi-ta-header-cell-sort-icon h-5 w-5 shrink-0 transition duration-75',
                    'text-gray-950 dark:text-white' => $activelySorted,
                    'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 group-focus-visible:text-gray-500 dark:group-hover:text-gray-400 dark:group-focus-visible:text-gray-400' => ! $activelySorted,
=======
        <?php if($sortable): ?>
            <?php if (isset($component)) { $__componentOriginalbfc641e0710ce04e5fe02876ffc6f950 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['alias' => $activelySorted && $sortDirection === 'asc' ? 'tables::header-cell.sort-asc-button' : 'tables::header-cell.sort-desc-button','icon' => $activelySorted && $sortDirection === 'asc' ? 'heroicon-m-chevron-up' : 'heroicon-m-chevron-down','class' => \Illuminate\Support\Arr::toCssClasses([
                    'fi-ta-header-cell-sort-icon h-5 w-5 transition duration-75',
                    'text-gray-950 dark:text-white' => $activelySorted,
                    'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 group-focus:text-gray-500 dark:group-hover:text-gray-400 dark:group-focus:text-gray-400' => ! $activelySorted,
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
                ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<<<<<<< HEAD
<?php $component->withAttributes(['alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
                    match (true) {
                        $activelySorted && ($sortDirection === 'asc') => 'tables::header-cell.sort-asc-button',
                        $activelySorted && ($sortDirection === 'desc') => 'tables::header-cell.sort-desc-button',
                        default => 'tables::header-cell.sort-button',
                    }
                ),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($activelySorted && $sortDirection === 'asc' ? 'heroicon-m-chevron-up' : 'heroicon-m-chevron-down'),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                    'fi-ta-header-cell-sort-icon h-5 w-5 shrink-0 transition duration-75',
                    'text-gray-950 dark:text-white' => $activelySorted,
                    'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 group-focus-visible:text-gray-500 dark:group-hover:text-gray-400 dark:group-focus-visible:text-gray-400' => ! $activelySorted,
=======
<?php $component->withAttributes(['alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($activelySorted && $sortDirection === 'asc' ? 'tables::header-cell.sort-asc-button' : 'tables::header-cell.sort-desc-button'),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($activelySorted && $sortDirection === 'asc' ? 'heroicon-m-chevron-up' : 'heroicon-m-chevron-down'),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                    'fi-ta-header-cell-sort-icon h-5 w-5 transition duration-75',
                    'text-gray-950 dark:text-white' => $activelySorted,
                    'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 group-focus:text-gray-500 dark:group-hover:text-gray-400 dark:group-focus:text-gray-400' => ! $activelySorted,
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
                ]))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950)): ?>
<?php $attributes = $__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950; ?>
<?php unset($__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbfc641e0710ce04e5fe02876ffc6f950)): ?>
<?php $component = $__componentOriginalbfc641e0710ce04e5fe02876ffc6f950; ?>
<?php unset($__componentOriginalbfc641e0710ce04e5fe02876ffc6f950); ?>
<?php endif; ?>
<<<<<<< HEAD
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
=======

            <span class="sr-only">
                <?php echo e($sortDirection === 'asc' ? __('filament-tables::table.sorting.fields.direction.options.desc') : __('filament-tables::table.sorting.fields.direction.options.asc')); ?>

            </span>
        <?php endif; ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    </<?php echo e($sortable ? 'button' : 'span'); ?>>
</th>
<?php /**PATH C:\laragon\www\magang\laravel-filament\vendor\filament\tables\resources\views/components/header-cell.blade.php ENDPATH**/ ?>