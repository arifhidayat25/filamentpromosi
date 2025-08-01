<<<<<<< HEAD
<?php
    use Filament\Support\Enums\Alignment;
?>

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'actions',
    'alignment' => Alignment::End,
=======
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'actions',
    'alignment' => null,
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    'record' => null,
    'wrap' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'actions',
<<<<<<< HEAD
    'alignment' => Alignment::End,
=======
    'alignment' => null,
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    'record' => null,
    'wrap' => false,
]); ?>
<?php foreach (array_filter(([
    'actions',
<<<<<<< HEAD
    'alignment' => Alignment::End,
=======
    'alignment' => null,
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    'record' => null,
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
=======
    use Filament\Support\Enums\Alignment;

>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    $actions = array_filter(
        $actions,
        function ($action) use ($record): bool {
            if (! $action instanceof \Filament\Tables\Actions\BulkAction) {
                $action->record($record);
            }

            return $action->isVisible();
        },
    );
<<<<<<< HEAD

    if (! $alignment instanceof Alignment) {
        $alignment = filled($alignment) ? (Alignment::tryFrom($alignment) ?? $alignment) : null;
    }
?>

<!--[if BLOCK]><![endif]--><?php if($actions): ?>
    <div
        <?php echo e($attributes->class([
                'fi-ta-actions flex shrink-0 items-center gap-3',
                'flex-wrap' => $wrap,
                'sm:flex-nowrap' => $wrap === '-sm',
                match ($alignment) {
                    Alignment::Center => 'justify-center',
                    Alignment::Start, Alignment::Left => 'justify-start',
                    Alignment::End, Alignment::Right => 'justify-end',
                    Alignment::Between, Alignment::Justify => 'justify-between',
                    'start md:end' => 'justify-start md:justify-end',
                    default => $alignment,
                },
            ])); ?>

    >
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($action); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
    </div>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->
=======
?>

<div
    <?php echo e($attributes->class([
            'fi-ta-actions flex shrink-0 items-center gap-3',
            'flex-wrap' => $wrap,
            'sm:flex-nowrap' => $wrap === '-sm',
            match ($alignment) {
                Alignment::Center, 'center' => 'justify-center',
                Alignment::Start, Alignment::Left, 'start', 'left' => 'justify-start',
                'start md:end' => 'justify-start md:justify-end',
                default => 'justify-end',
            },
        ])); ?>

>
    <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $labeledFromBreakpoint = $action->getLabeledFromBreakpoint();
        ?>

        <span
            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'inline-flex',
                '-mx-2' => $action->isIconButton() || $labeledFromBreakpoint,
                match ($labeledFromBreakpoint) {
                    'sm' => 'sm:mx-0',
                    'md' => 'md:mx-0',
                    'lg' => 'lg:mx-0',
                    'xl' => 'xl:mx-0',
                    '2xl' => '2xl:mx-0',
                    default => null,
                },
            ]); ?>"
        >
            <?php echo e($action); ?>

        </span>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php /**PATH C:\laragon\www\magang\laravel-filament\vendor\filament\tables\resources\views/components/actions.blade.php ENDPATH**/ ?>