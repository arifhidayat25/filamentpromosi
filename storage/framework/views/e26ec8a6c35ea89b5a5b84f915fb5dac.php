<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'column',
    'isClickDisabled' => false,
    'record',
    'recordAction' => null,
    'recordKey' => null,
    'recordUrl' => null,
<<<<<<< HEAD
    'shouldOpenRecordUrlInNewTab' => false,
=======
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'column',
    'isClickDisabled' => false,
    'record',
    'recordAction' => null,
    'recordKey' => null,
    'recordUrl' => null,
<<<<<<< HEAD
    'shouldOpenRecordUrlInNewTab' => false,
=======
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
]); ?>
<?php foreach (array_filter(([
    'column',
    'isClickDisabled' => false,
    'record',
    'recordAction' => null,
    'recordKey' => null,
    'recordUrl' => null,
<<<<<<< HEAD
    'shouldOpenRecordUrlInNewTab' => false,
=======
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    use Filament\Support\Enums\Alignment;

    $action = $column->getAction();
<<<<<<< HEAD
    $alignment = $column->getAlignment() ?? Alignment::Start;
=======
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    $name = $column->getName();
    $shouldOpenUrlInNewTab = $column->shouldOpenUrlInNewTab();
    $tooltip = $column->getTooltip();
    $url = $column->getUrl();

<<<<<<< HEAD
    if (! $alignment instanceof Alignment) {
        $alignment = filled($alignment) ? (Alignment::tryFrom($alignment) ?? $alignment) : null;
    }

    $columnClasses = \Illuminate\Support\Arr::toCssClasses([
        'flex w-full disabled:pointer-events-none',
        match ($alignment) {
            Alignment::Start => 'justify-start text-start',
            Alignment::Center => 'justify-center text-center',
            Alignment::End => 'justify-end text-end',
            Alignment::Left => 'justify-start text-left',
            Alignment::Right => 'justify-end text-right',
            Alignment::Justify, Alignment::Between => 'justify-between text-justify',
            default => $alignment,
=======
    $columnClasses = \Illuminate\Support\Arr::toCssClasses([
        'flex w-full disabled:pointer-events-none',
        match ($column->getAlignment()) {
            Alignment::Center, 'center' => 'justify-center text-center',
            Alignment::End, 'end' => 'justify-end text-end',
            Alignment::Left, 'left' => 'justify-start text-left',
            Alignment::Right, 'right' => 'justify-end text-right',
            Alignment::Justify, 'justify' => 'justify-between text-justify',
            default => 'justify-start text-start',
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
        },
    ]);

    $slot = $column->viewData(['recordKey' => $recordKey]);
?>

<div
<<<<<<< HEAD
    <?php if(filled($tooltip)): ?>
=======
    <?php if($tooltip): ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
        x-data="{}"
        x-tooltip="{
            content: <?php echo \Illuminate\Support\Js::from($tooltip)->toHtml() ?>,
            theme: $store.theme,
        }"
    <?php endif; ?>
    <?php echo e($attributes->class(['fi-ta-col-wrp'])); ?>

>
<<<<<<< HEAD
    <!--[if BLOCK]><![endif]--><?php if(($url || ($recordUrl && $action === null)) && (! $isClickDisabled)): ?>
        <a
            <?php echo e(\Filament\Support\generate_href_html($url ?: $recordUrl, $url ? $shouldOpenUrlInNewTab : $shouldOpenRecordUrlInNewTab)); ?>

=======
    <?php if(($url || ($recordUrl && $action === null)) && (! $isClickDisabled)): ?>
        <a
            href="<?php echo e($url ?: $recordUrl); ?>"
            <?php if($shouldOpenUrlInNewTab): ?> target="_blank" <?php endif; ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
            class="<?php echo e($columnClasses); ?>"
        >
            <?php echo e($slot); ?>

        </a>
    <?php elseif(($action || $recordAction) && (! $isClickDisabled)): ?>
        <?php
            if ($action instanceof \Filament\Tables\Actions\Action) {
                $wireClickAction = "mountTableAction('{$action->getName()}', '{$recordKey}')";
            } elseif ($action) {
                $wireClickAction = "callTableColumnAction('{$name}', '{$recordKey}')";
            } else {
                if ($this->getTable()->getAction($recordAction)) {
                    $wireClickAction = "mountTableAction('{$recordAction}', '{$recordKey}')";
                } else {
                    $wireClickAction = "{$recordAction}('{$recordKey}')";
                }
            }
        ?>

        <button
            type="button"
<<<<<<< HEAD
            wire:click.stop.prevent="<?php echo e($wireClickAction); ?>"
=======
            wire:click="<?php echo e($wireClickAction); ?>"
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
            wire:loading.attr="disabled"
            wire:target="<?php echo e($wireClickAction); ?>"
            class="<?php echo e($columnClasses); ?>"
        >
            <?php echo e($slot); ?>

        </button>
    <?php else: ?>
        <div class="<?php echo e($columnClasses); ?>">
            <?php echo e($slot); ?>

        </div>
<<<<<<< HEAD
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
=======
    <?php endif; ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
</div>
<?php /**PATH C:\laragon\www\magang\laravel-filament\vendor\filament\tables\resources\views/components/columns/column.blade.php ENDPATH**/ ?>