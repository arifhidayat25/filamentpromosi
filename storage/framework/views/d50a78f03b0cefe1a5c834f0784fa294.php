<?php
    use Filament\Support\Enums\ActionSize;
    use Filament\Support\Enums\IconPosition;
    use Filament\Support\Enums\IconSize;
?>

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'badge' => null,
    'badgeColor' => 'primary',
<<<<<<< HEAD
    'badgeSize' => 'xs',
    'color' => 'primary',
    'disabled' => false,
    'form' => null,
    'formId' => null,
    'grouped' => false,
    'href' => null,
=======
    'color' => 'primary',
    'disabled' => false,
    'form' => null,
    'grouped' => false,
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    'icon' => null,
    'iconAlias' => null,
    'iconPosition' => IconPosition::Before,
    'iconSize' => null,
    'keyBindings' => null,
    'labeledFrom' => null,
    'labelSrOnly' => false,
<<<<<<< HEAD
    'loadingIndicator' => true,
    'outlined' => false,
    'size' => ActionSize::Medium,
    'spaMode' => null,
    'tag' => 'button',
    'target' => null,
=======
    'outlined' => false,
    'size' => 'md',
    'tag' => 'button',
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    'tooltip' => null,
    'type' => 'button',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'badge' => null,
    'badgeColor' => 'primary',
<<<<<<< HEAD
    'badgeSize' => 'xs',
    'color' => 'primary',
    'disabled' => false,
    'form' => null,
    'formId' => null,
    'grouped' => false,
    'href' => null,
=======
    'color' => 'primary',
    'disabled' => false,
    'form' => null,
    'grouped' => false,
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    'icon' => null,
    'iconAlias' => null,
    'iconPosition' => IconPosition::Before,
    'iconSize' => null,
    'keyBindings' => null,
    'labeledFrom' => null,
    'labelSrOnly' => false,
<<<<<<< HEAD
    'loadingIndicator' => true,
    'outlined' => false,
    'size' => ActionSize::Medium,
    'spaMode' => null,
    'tag' => 'button',
    'target' => null,
=======
    'outlined' => false,
    'size' => 'md',
    'tag' => 'button',
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    'tooltip' => null,
    'type' => 'button',
]); ?>
<?php foreach (array_filter(([
    'badge' => null,
    'badgeColor' => 'primary',
<<<<<<< HEAD
    'badgeSize' => 'xs',
    'color' => 'primary',
    'disabled' => false,
    'form' => null,
    'formId' => null,
    'grouped' => false,
    'href' => null,
=======
    'color' => 'primary',
    'disabled' => false,
    'form' => null,
    'grouped' => false,
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    'icon' => null,
    'iconAlias' => null,
    'iconPosition' => IconPosition::Before,
    'iconSize' => null,
    'keyBindings' => null,
    'labeledFrom' => null,
    'labelSrOnly' => false,
<<<<<<< HEAD
    'loadingIndicator' => true,
    'outlined' => false,
    'size' => ActionSize::Medium,
    'spaMode' => null,
    'tag' => 'button',
    'target' => null,
=======
    'outlined' => false,
    'size' => 'md',
    'tag' => 'button',
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    'tooltip' => null,
    'type' => 'button',
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
    if (! $iconPosition instanceof IconPosition) {
        $iconPosition = filled($iconPosition) ? (IconPosition::tryFrom($iconPosition) ?? $iconPosition) : null;
    }

    if (! $size instanceof ActionSize) {
        $size = filled($size) ? (ActionSize::tryFrom($size) ?? $size) : null;
    }

    $iconSize ??= match ($size) {
        ActionSize::ExtraSmall, ActionSize::Small => IconSize::Small,
        default => IconSize::Medium,
    };

    if (! $iconSize instanceof IconSize) {
        $iconSize = filled($iconSize) ? (IconSize::tryFrom($iconSize) ?? $iconSize) : null;
    }

    $buttonClasses = \Illuminate\Support\Arr::toCssClasses([
        ...[
            'fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2',
            'pointer-events-none opacity-70' => $disabled,
            'rounded-lg' => ! $grouped,
            'flex-1 [&:nth-child(1_of_.fi-btn)]:rounded-s-lg [&:nth-last-child(1_of_.fi-btn)]:rounded-e-lg [&:not(:nth-child(1_of_.fi-btn))]:shadow-[-1px_0_0_0_theme(colors.gray.200)] [&:not(:nth-last-child(1_of_.fi-btn))]:me-px dark:[&:not(:nth-child(1_of_.fi-btn))]:shadow-[-1px_0_0_0_theme(colors.white/20%)]' => $grouped,
            'cursor-pointer' => $tag === 'label',
            match ($color) {
                'gray' => null,
                default => 'fi-color-custom',
            },
            // @deprecated `fi-btn-color-*` has been replaced by `fi-color-*` and `fi-color-custom`.
            is_string($color) ? "fi-btn-color-{$color}" : null,
            is_string($color) ? "fi-color-{$color}" : null,
            ($size instanceof ActionSize) ? "fi-size-{$size->value}" : null,
            // @deprecated `fi-btn-size-*` has been replaced by `fi-size-*`.
            ($size instanceof ActionSize) ? "fi-btn-size-{$size->value}" : null,
            match ($size) {
                ActionSize::ExtraSmall => 'gap-1 px-2 py-1.5 text-xs',
                ActionSize::Small => 'gap-1 px-2.5 py-1.5 text-sm',
                ActionSize::Medium => 'gap-1.5 px-3 py-2 text-sm',
                ActionSize::Large => 'gap-1.5 px-3.5 py-2.5 text-sm',
                ActionSize::ExtraLarge => 'gap-1.5 px-4 py-3 text-sm',
                default => $size,
=======
    $stringSize = match ($size) {
        ActionSize::ExtraSmall => 'xs',
        ActionSize::Small => 'sm',
        ActionSize::Medium => 'md',
        ActionSize::Large => 'lg',
        ActionSize::ExtraLarge => 'xl',
        default => $size,
    };

    $buttonClasses = \Illuminate\Support\Arr::toCssClasses([
        ...[
            "fi-btn fi-btn-size-{$stringSize} relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus:ring-2 disabled:pointer-events-none disabled:opacity-70",
            'flex-1' => $grouped,
            'rounded-lg' => ! $grouped,
            is_string($color) ? "fi-btn-color-{$color}" : null,
            match ($size) {
                ActionSize::ExtraSmall, 'xs' => 'gap-1 px-2 py-1.5 text-xs',
                ActionSize::Small, 'sm' => 'gap-1 px-2.5 py-1.5 text-sm',
                ActionSize::Medium, 'md' => 'gap-1.5 px-3 py-2 text-sm',
                ActionSize::Large, 'lg' => 'gap-1.5 px-3.5 py-2.5 text-sm',
                ActionSize::ExtraLarge, 'xl' => 'gap-1.5 px-4 py-3 text-sm',
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
            },
            'hidden' => $labeledFrom,
            match ($labeledFrom) {
                'sm' => 'sm:inline-grid',
                'md' => 'md:inline-grid',
                'lg' => 'lg:inline-grid',
                'xl' => 'xl:inline-grid',
                '2xl' => '2xl:inline-grid',
                default => 'inline-grid',
            },
        ],
        ...(
            $outlined ?
                [
                    'fi-btn-outlined ring-1',
                    match ($color) {
<<<<<<< HEAD
                        'gray' => 'text-gray-950 ring-gray-300 hover:bg-gray-400/10 focus-visible:ring-gray-400/40 dark:text-white dark:ring-gray-700',
=======
                        'gray' => 'text-gray-950 ring-gray-300 hover:bg-gray-400/10 focus:ring-gray-400/40 dark:text-white dark:ring-gray-700',
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
                        default => 'text-custom-600 ring-custom-600 hover:bg-custom-400/10 dark:text-custom-400 dark:ring-custom-500',
                    },
                ] :
                [
                    'shadow-sm' => ! $grouped,
<<<<<<< HEAD
                    'bg-white text-gray-950 hover:bg-gray-50 dark:bg-white/5 dark:text-white dark:hover:bg-white/10' => ($color === 'gray') || ($tag === 'label'),
                    'ring-1 ring-gray-950/10 dark:ring-white/20' => (($color === 'gray') || ($tag === 'label')) && (! $grouped),
                    'bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50' => ($color !== 'gray') && ($tag !== 'label'),
                    '[input:checked+&]:bg-custom-600 [input:checked+&]:text-white [input:checked+&]:ring-0 [input:checked+&]:hover:bg-custom-500 dark:[input:checked+&]:bg-custom-500 dark:[input:checked+&]:hover:bg-custom-400 [input:checked:focus-visible+&]:ring-custom-500/50 dark:[input:checked:focus-visible+&]:ring-custom-400/50 [input:focus-visible+&]:z-10 [input:focus-visible+&]:ring-2 [input:focus-visible+&]:ring-gray-950/10 dark:[input:focus-visible+&]:ring-white/20' => ($color !== 'gray') && ($tag === 'label'),
                    '[input:checked+&]:bg-gray-400 [input:checked+&]:text-white [input:checked+&]:ring-0 [input:checked+&]:hover:bg-gray-300 dark:[input:checked+&]:bg-gray-600 dark:[input:checked+&]:hover:bg-gray-500' => ($color === 'gray'),
                    ]
=======
                    ...match ($color) {
                        'gray' => [
                            'bg-white text-gray-950 hover:bg-gray-50 dark:bg-white/5 dark:text-white dark:hover:bg-white/10',
                            'ring-1 ring-gray-950/10 dark:ring-white/20' => ! $grouped,
                        ],
                        default => [
                            'bg-custom-600 text-white hover:bg-custom-500 dark:bg-custom-500 dark:hover:bg-custom-400',
                            'focus:ring-custom-500/50 dark:focus:ring-custom-400/50' => ! $grouped,
                        ],
                    },
                ]
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
        ),
    ]);

    $buttonStyles = \Illuminate\Support\Arr::toCssStyles([
<<<<<<< HEAD
        \Filament\Support\get_color_css_variables(
            $color,
            shades: [400, 500, 600],
            alias: 'button',
        ) => $color !== 'gray',
    ]);

    $iconClasses = \Illuminate\Support\Arr::toCssClasses([
        'fi-btn-icon transition duration-75',
        match ($iconSize) {
            IconSize::Small => 'h-4 w-4',
            IconSize::Medium => 'h-5 w-5',
            IconSize::Large => 'h-6 w-6',
            default => $iconSize,
        },
        'text-gray-400 dark:text-gray-500' => ($color === 'gray') || ($tag === 'label'),
        'text-white' => ($color !== 'gray') && ($tag !== 'label') && (! $outlined),
        '[:checked+*>&]:text-white' => $tag === 'label',
    ]);

    $badgeContainerClasses = 'fi-btn-badge-ctn absolute start-full top-0 z-[1] w-max -translate-x-1/2 -translate-y-1/2 rounded-md bg-white dark:bg-gray-900 rtl:translate-x-1/2';
=======
        \Filament\Support\get_color_css_variables($color, shades: [400, 500, 600]) => $color !== 'gray',
    ]);

    $iconSize ??= match ($size) {
        ActionSize::ExtraSmall, ActionSize::Small, 'xs', 'sm' => IconSize::Small,
        default => IconSize::Medium,
    };

    $iconClasses = \Illuminate\Support\Arr::toCssClasses([
        'fi-btn-icon',
        match ($iconSize) {
            IconSize::Small, 'sm' => 'h-4 w-4',
            IconSize::Medium, 'md' => 'h-5 w-5',
            IconSize::Large, 'lg' => 'h-6 w-6',
            default => $iconSize,
        },
        match ($color) {
            'gray' => 'text-gray-400 dark:text-gray-500',
            default => null,
        },
    ]);

    $stringIconSize = match ($iconSize) {
        IconSize::Small => 'sm',
        IconSize::Medium => 'md',
        IconSize::Large => 'lg',
        default => $iconSize,
    };

    $badgeClasses = 'absolute -top-1 start-full z-10 -ms-1 -translate-x-1/2 rounded-md bg-white dark:bg-gray-900';
>>>>>>> 40ba94650047b47ec683394909f249e12f029589

    $labelClasses = \Illuminate\Support\Arr::toCssClasses([
        'fi-btn-label',
        'sr-only' => $labelSrOnly,
    ]);

<<<<<<< HEAD
    $wireTarget = $loadingIndicator ? $attributes->whereStartsWith(['wire:target', 'wire:click'])->filter(fn ($value): bool => filled($value))->first() : null;

    $hasFormProcessingLoadingIndicator = $type === 'submit' && filled($form);
    $hasLoadingIndicator = filled($wireTarget) || $hasFormProcessingLoadingIndicator;
=======
    $wireTarget = $attributes->whereStartsWith(['wire:target', 'wire:click'])->filter(fn ($value): bool => filled($value))->first();

    $hasFileUploadLoadingIndicator = $type === 'submit' && filled($form);
    $hasLoadingIndicator = filled($wireTarget) || $hasFileUploadLoadingIndicator;
>>>>>>> 40ba94650047b47ec683394909f249e12f029589

    if ($hasLoadingIndicator) {
        $loadingIndicatorTarget = html_entity_decode($wireTarget ?: $form, ENT_QUOTES);
    }
<<<<<<< HEAD

    $hasTooltip = filled($tooltip);
?>

<!--[if BLOCK]><![endif]--><?php if($labeledFrom): ?>
    <?php if (isset($component)) { $__componentOriginalf0029cce6d19fd6d472097ff06a800a1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf0029cce6d19fd6d472097ff06a800a1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon-button','data' => ['badge' => $badge,'badgeColor' => $badgeColor,'color' => $color,'disabled' => $disabled,'form' => $form,'formId' => $formId,'href' => $href,'icon' => $icon,'iconAlias' => $iconAlias,'iconSize' => $iconSize,'keyBindings' => $keyBindings,'label' => $slot,'size' => $size,'tag' => $tag,'target' => $target,'tooltip' => $tooltip,'type' => $type,'class' => 
=======
?>

<?php if($labeledFrom): ?>
    <?php if (isset($component)) { $__componentOriginalf0029cce6d19fd6d472097ff06a800a1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf0029cce6d19fd6d472097ff06a800a1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon-button','data' => ['badge' => $badge,'badgeColor' => $badgeColor,'color' => $color,'disabled' => $disabled,'form' => $form,'icon' => $icon,'iconAlias' => $iconAlias,'iconSize' => $iconSize,'keyBindings' => $keyBindings,'label' => $slot,'size' => $size,'tag' => $tag,'tooltip' => $tooltip,'type' => $type,'class' => 
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
            match ($labeledFrom) {
                'sm' => 'sm:hidden',
                'md' => 'md:hidden',
                'lg' => 'lg:hidden',
                'xl' => 'xl:hidden',
                '2xl' => '2xl:hidden',
                default => 'hidden',
            }
        ,'attributes' => \Filament\Support\prepare_inherited_attributes($attributes)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<<<<<<< HEAD
<?php $component->withAttributes(['badge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($badge),'badge-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($badgeColor),'color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($color),'disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($disabled),'form' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($form),'form-id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($formId),'href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($href),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'icon-alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconAlias),'icon-size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconSize),'key-bindings' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($keyBindings),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($slot),'size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($size),'tag' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tag),'target' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($target),'tooltip' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tooltip),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($type),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
=======
<?php $component->withAttributes(['badge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($badge),'badge-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($badgeColor),'color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($color),'disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($disabled),'form' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($form),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'icon-alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconAlias),'icon-size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconSize),'key-bindings' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($keyBindings),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($slot),'size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($size),'tag' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tag),'tooltip' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tooltip),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($type),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
            match ($labeledFrom) {
                'sm' => 'sm:hidden',
                'md' => 'md:hidden',
                'lg' => 'lg:hidden',
                'xl' => 'xl:hidden',
                '2xl' => '2xl:hidden',
                default => 'hidden',
            }
        ),'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\prepare_inherited_attributes($attributes))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf0029cce6d19fd6d472097ff06a800a1)): ?>
<?php $attributes = $__attributesOriginalf0029cce6d19fd6d472097ff06a800a1; ?>
<?php unset($__attributesOriginalf0029cce6d19fd6d472097ff06a800a1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf0029cce6d19fd6d472097ff06a800a1)): ?>
<?php $component = $__componentOriginalf0029cce6d19fd6d472097ff06a800a1; ?>
<?php unset($__componentOriginalf0029cce6d19fd6d472097ff06a800a1); ?>
<?php endif; ?>
<<<<<<< HEAD
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->

<<?php echo e($tag); ?>

    <?php if($tag === 'a'): ?>
        <?php echo e(\Filament\Support\generate_href_html($href, $target === '_blank', $spaMode)); ?>

    <?php endif; ?>
    <?php if(($keyBindings || $hasTooltip) && (! $hasFormProcessingLoadingIndicator)): ?>
        x-data="{}"
    <?php endif; ?>
    <?php if($keyBindings): ?>
        x-bind:id="$id('key-bindings')"
        x-mousetrap.global.<?php echo e(collect($keyBindings)->map(fn (string $keyBinding): string => str_replace('+', '-', $keyBinding))->implode('.')); ?>="document.getElementById($el.id).click()"
    <?php endif; ?>
    <?php if($hasTooltip): ?>
        x-tooltip="{
            content: <?php echo \Illuminate\Support\Js::from($tooltip)->toHtml() ?>,
            theme: $store.theme,
        }"
    <?php endif; ?>
    <?php if($hasFormProcessingLoadingIndicator): ?>
        x-data="{
            form: null,
            isProcessing: false,
            processingMessage: null,
        }"
        x-init="
            form = $el.closest('form')

            form?.addEventListener('form-processing-started', (event) => {
                isProcessing = true
                processingMessage = event.detail.message
            })

            form?.addEventListener('form-processing-finished', () => {
                isProcessing = false
            })
        "
        x-bind:class="{ 'enabled:opacity-70 enabled:cursor-wait': isProcessing }"
    <?php endif; ?>
    <?php echo e($attributes
            ->merge([
                'disabled' => $disabled,
                'form' => $formId,
                'type' => $tag === 'button' ? $type : null,
                'wire:loading.attr' => $tag === 'button' ? 'disabled' : null,
                'wire:target' => ($hasLoadingIndicator && $loadingIndicatorTarget) ? $loadingIndicatorTarget : null,
                'x-bind:disabled' => $hasFormProcessingLoadingIndicator ? 'isProcessing' : null,
            ], escape: false)
            ->class([$buttonClasses])
            ->style([$buttonStyles])); ?>

>
    <!--[if BLOCK]><![endif]--><?php if($iconPosition === IconPosition::Before): ?>
        <!--[if BLOCK]><![endif]--><?php if($icon): ?>
            <?php if (isset($component)) { $__componentOriginalbfc641e0710ce04e5fe02876ffc6f950 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['attributes' => 
                    \Filament\Support\prepare_inherited_attributes(
                        new \Illuminate\View\ComponentAttributeBag([
                            'alias' => $iconAlias,
                            'icon' => $icon,
                            'wire:loading.remove.delay.' . config('filament.livewire_loading_delay', 'default') => $hasLoadingIndicator,
                            'wire:target' => $hasLoadingIndicator ? $loadingIndicatorTarget : null,
                        ])
                    )->class([$iconClasses])
                ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
                    \Filament\Support\prepare_inherited_attributes(
                        new \Illuminate\View\ComponentAttributeBag([
                            'alias' => $iconAlias,
                            'icon' => $icon,
                            'wire:loading.remove.delay.' . config('filament.livewire_loading_delay', 'default') => $hasLoadingIndicator,
                            'wire:target' => $hasLoadingIndicator ? $loadingIndicatorTarget : null,
                        ])
                    )->class([$iconClasses])
                )]); ?>
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
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <!--[if BLOCK]><![endif]--><?php if($hasLoadingIndicator): ?>
            <?php if (isset($component)) { $__componentOriginalbef7c2371a870b1887ec3741fe311a10 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbef7c2371a870b1887ec3741fe311a10 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.loading-indicator','data' => ['attributes' => 
                    \Filament\Support\prepare_inherited_attributes(
                        new \Illuminate\View\ComponentAttributeBag([
                            'wire:loading.delay.' . config('filament.livewire_loading_delay', 'default') => '',
                            'wire:target' => $loadingIndicatorTarget,
                        ])
                    )->class([$iconClasses])
                ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::loading-indicator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
                    \Filament\Support\prepare_inherited_attributes(
                        new \Illuminate\View\ComponentAttributeBag([
                            'wire:loading.delay.' . config('filament.livewire_loading_delay', 'default') => '',
                            'wire:target' => $loadingIndicatorTarget,
                        ])
                    )->class([$iconClasses])
                )]); ?>
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

        <!--[if BLOCK]><![endif]--><?php if($hasFormProcessingLoadingIndicator): ?>
            <?php if (isset($component)) { $__componentOriginalbef7c2371a870b1887ec3741fe311a10 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbef7c2371a870b1887ec3741fe311a10 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.loading-indicator','data' => ['xCloak' => 'x-cloak','xShow' => 'isProcessing','class' => $iconClasses]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::loading-indicator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-cloak' => 'x-cloak','x-show' => 'isProcessing','class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses)]); ?>
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
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <span
        <?php if($hasFormProcessingLoadingIndicator): ?>
            x-show="! isProcessing"
        <?php endif; ?>
        class="<?php echo e($labelClasses); ?>"
    >
        <?php echo e($slot); ?>

    </span>

    <!--[if BLOCK]><![endif]--><?php if($hasFormProcessingLoadingIndicator): ?>
        <span
            x-cloak
            x-show="isProcessing"
            x-text="processingMessage"
            class="<?php echo e($labelClasses); ?>"
        ></span>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!--[if BLOCK]><![endif]--><?php if($iconPosition === IconPosition::After): ?>
        <!--[if BLOCK]><![endif]--><?php if($icon): ?>
            <?php if (isset($component)) { $__componentOriginalbfc641e0710ce04e5fe02876ffc6f950 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['attributes' => 
                    \Filament\Support\prepare_inherited_attributes(
                        new \Illuminate\View\ComponentAttributeBag([
                            'alias' => $iconAlias,
                            'icon' => $icon,
                            'wire:loading.remove.delay.' . config('filament.livewire_loading_delay', 'default') => $hasLoadingIndicator,
                            'wire:target' => $hasLoadingIndicator ? $loadingIndicatorTarget : null,
                        ])
                    )->class([$iconClasses])
                ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
=======
<?php endif; ?>

<?php if($tag === 'button'): ?>
    <button
        <?php if(($keyBindings || $tooltip) && (! $hasFileUploadLoadingIndicator)): ?>
            x-data="{}"
        <?php endif; ?>
        <?php if($keyBindings): ?>
            x-mousetrap.global.<?php echo e(collect($keyBindings)->map(fn (string $keyBinding): string => str_replace('+', '-', $keyBinding))->implode('.')); ?>

        <?php endif; ?>
        <?php if($tooltip): ?>
            x-tooltip="{
                content: <?php echo \Illuminate\Support\Js::from($tooltip)->toHtml() ?>,
                theme: $store.theme,
            }"
        <?php endif; ?>
        <?php if($hasFileUploadLoadingIndicator): ?>
            x-data="{
                form: null,
                isUploadingFile: false,
            }"
            x-init="
                form = $el.closest('form')

                form?.addEventListener('file-upload-started', () => {
                    isUploadingFile = true
                })

                form?.addEventListener('file-upload-finished', () => {
                    isUploadingFile = false
                })
            "
            x-bind:class="{ 'enabled:opacity-70 enabled:cursor-wait': isUploadingFile }"
        <?php endif; ?>
        <?php echo e($attributes
                ->merge([
                    'disabled' => $disabled,
                    'type' => $type,
                    'wire:loading.attr' => 'disabled',
                    'wire:target' => ($hasLoadingIndicator && $loadingIndicatorTarget) ? $loadingIndicatorTarget : null,
                    'x-bind:disabled' => $hasFileUploadLoadingIndicator ? 'isUploadingFile' : false,
                ], escape: false)
                ->class([$buttonClasses])
                ->style([$buttonStyles])); ?>

    >
        <?php if(in_array($iconPosition, [IconPosition::Before, 'before'])): ?>
            <?php if($icon): ?>
                <?php if (isset($component)) { $__componentOriginalbfc641e0710ce04e5fe02876ffc6f950 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['alias' => $iconAlias,'icon' => $icon,'wire:loading.remove.delay' => $hasLoadingIndicator,'wire:target' => $hasLoadingIndicator ? $loadingIndicatorTarget : null,'class' => $iconClasses]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<<<<<<< HEAD
<?php $component->withAttributes(['attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
                    \Filament\Support\prepare_inherited_attributes(
                        new \Illuminate\View\ComponentAttributeBag([
                            'alias' => $iconAlias,
                            'icon' => $icon,
                            'wire:loading.remove.delay.' . config('filament.livewire_loading_delay', 'default') => $hasLoadingIndicator,
                            'wire:target' => $hasLoadingIndicator ? $loadingIndicatorTarget : null,
                        ])
                    )->class([$iconClasses])
                )]); ?>
=======
<?php $component->withAttributes(['alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconAlias),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'wire:loading.remove.delay' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hasLoadingIndicator),'wire:target' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hasLoadingIndicator ? $loadingIndicatorTarget : null),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses)]); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
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

        <!--[if BLOCK]><![endif]--><?php if($hasLoadingIndicator): ?>
            <?php if (isset($component)) { $__componentOriginalbef7c2371a870b1887ec3741fe311a10 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbef7c2371a870b1887ec3741fe311a10 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.loading-indicator','data' => ['attributes' => 
                    \Filament\Support\prepare_inherited_attributes(
                        new \Illuminate\View\ComponentAttributeBag([
                            'wire:loading.delay.' . config('filament.livewire_loading_delay', 'default') => '',
                            'wire:target' => $loadingIndicatorTarget,
                        ])
                    )->class([$iconClasses])
                ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
=======
            <?php endif; ?>

            <?php if($hasLoadingIndicator): ?>
                <?php if (isset($component)) { $__componentOriginalbef7c2371a870b1887ec3741fe311a10 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbef7c2371a870b1887ec3741fe311a10 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.loading-indicator','data' => ['wire:loading.delay' => '','wire:target' => $loadingIndicatorTarget,'class' => $iconClasses . ' ' . $stringIconSize]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php $component->withName('filament::loading-indicator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<<<<<<< HEAD
<?php $component->withAttributes(['attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
                    \Filament\Support\prepare_inherited_attributes(
                        new \Illuminate\View\ComponentAttributeBag([
                            'wire:loading.delay.' . config('filament.livewire_loading_delay', 'default') => '',
                            'wire:target' => $loadingIndicatorTarget,
                        ])
                    )->class([$iconClasses])
                )]); ?>
=======
<?php $component->withAttributes(['wire:loading.delay' => '','wire:target' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($loadingIndicatorTarget),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses . ' ' . $stringIconSize)]); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
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
<<<<<<< HEAD
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <!--[if BLOCK]><![endif]--><?php if($hasFormProcessingLoadingIndicator): ?>
            <?php if (isset($component)) { $__componentOriginalbef7c2371a870b1887ec3741fe311a10 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbef7c2371a870b1887ec3741fe311a10 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.loading-indicator','data' => ['xCloak' => 'x-cloak','xShow' => 'isProcessing','class' => $iconClasses]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
=======
            <?php endif; ?>

            <?php if($hasFileUploadLoadingIndicator): ?>
                <?php if (isset($component)) { $__componentOriginalbef7c2371a870b1887ec3741fe311a10 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbef7c2371a870b1887ec3741fe311a10 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.loading-indicator','data' => ['xShow' => 'isUploadingFile','xCloak' => 'x-cloak','class' => $iconClasses . ' ' . $stringIconSize]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php $component->withName('filament::loading-indicator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<<<<<<< HEAD
<?php $component->withAttributes(['x-cloak' => 'x-cloak','x-show' => 'isProcessing','class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses)]); ?>
=======
<?php $component->withAttributes(['x-show' => 'isUploadingFile','x-cloak' => 'x-cloak','class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses . ' ' . $stringIconSize)]); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
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
<<<<<<< HEAD
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!--[if BLOCK]><![endif]--><?php if(filled($badge)): ?>
        <div class="<?php echo e($badgeContainerClasses); ?>">
            <?php if (isset($component)) { $__componentOriginal986dce9114ddce94a270ab00ce6c273d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal986dce9114ddce94a270ab00ce6c273d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.badge','data' => ['color' => $badgeColor,'size' => $badgeSize]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
=======
            <?php endif; ?>
        <?php endif; ?>

        <span
            <?php if($hasFileUploadLoadingIndicator): ?>
                x-show="! isUploadingFile"
            <?php endif; ?>
            class="<?php echo e($labelClasses); ?>"
        >
            <?php echo e($slot); ?>

        </span>

        <?php if($hasFileUploadLoadingIndicator): ?>
            <span x-show="isUploadingFile" x-cloak>
                <?php echo e(__('filament::components/button.messages.uploading_file')); ?>

            </span>
        <?php endif; ?>

        <?php if(in_array($iconPosition, [IconPosition::After, 'after'])): ?>
            <?php if($icon): ?>
                <?php if (isset($component)) { $__componentOriginalbfc641e0710ce04e5fe02876ffc6f950 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['alias' => $iconAlias,'icon' => $icon,'wire:loading.remove.delay' => $hasLoadingIndicator,'wire:target' => $hasLoadingIndicator ? $loadingIndicatorTarget : null,'class' => $iconClasses]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconAlias),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'wire:loading.remove.delay' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hasLoadingIndicator),'wire:target' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hasLoadingIndicator ? $loadingIndicatorTarget : null),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses)]); ?>
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
            <?php endif; ?>

            <?php if($hasLoadingIndicator): ?>
                <?php if (isset($component)) { $__componentOriginalbef7c2371a870b1887ec3741fe311a10 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbef7c2371a870b1887ec3741fe311a10 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.loading-indicator','data' => ['wire:loading.delay' => '','wire:target' => $loadingIndicatorTarget,'class' => $iconClasses . ' ' . $stringIconSize]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::loading-indicator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:loading.delay' => '','wire:target' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($loadingIndicatorTarget),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses . ' ' . $stringIconSize)]); ?>
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
            <?php endif; ?>

            <?php if($hasFileUploadLoadingIndicator): ?>
                <?php if (isset($component)) { $__componentOriginalbef7c2371a870b1887ec3741fe311a10 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbef7c2371a870b1887ec3741fe311a10 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.loading-indicator','data' => ['xShow' => 'isUploadingFile','xCloak' => 'x-cloak','class' => $iconClasses . ' ' . $stringIconSize]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::loading-indicator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-show' => 'isUploadingFile','x-cloak' => 'x-cloak','class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses . ' ' . $stringIconSize)]); ?>
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
            <?php endif; ?>
        <?php endif; ?>

        <?php if(filled($badge)): ?>
            <div class="<?php echo e($badgeClasses); ?>">
                <?php if (isset($component)) { $__componentOriginal986dce9114ddce94a270ab00ce6c273d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal986dce9114ddce94a270ab00ce6c273d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.badge','data' => ['color' => $badgeColor,'size' => 'xs']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php $component->withName('filament::badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<<<<<<< HEAD
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($badgeColor),'size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($badgeSize)]); ?>
                <?php echo e($badge); ?>

             <?php echo $__env->renderComponent(); ?>
=======
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($badgeColor),'size' => 'xs']); ?>
                    <?php echo e($badge); ?>

                 <?php echo $__env->renderComponent(); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php endif; ?>
<?php if (isset($__attributesOriginal986dce9114ddce94a270ab00ce6c273d)): ?>
<?php $attributes = $__attributesOriginal986dce9114ddce94a270ab00ce6c273d; ?>
<?php unset($__attributesOriginal986dce9114ddce94a270ab00ce6c273d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal986dce9114ddce94a270ab00ce6c273d)): ?>
<?php $component = $__componentOriginal986dce9114ddce94a270ab00ce6c273d; ?>
<?php unset($__componentOriginal986dce9114ddce94a270ab00ce6c273d); ?>
<?php endif; ?>
<<<<<<< HEAD
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</<?php echo e($tag); ?>>
=======
            </div>
        <?php endif; ?>
    </button>
<?php elseif($tag === 'a'): ?>
    <a
        <?php if($keyBindings || $tooltip): ?>
            x-data="{}"
        <?php endif; ?>
        <?php if($keyBindings): ?>
            x-mousetrap.global.<?php echo e(collect($keyBindings)->map(fn (string $keyBinding): string => str_replace('+', '-', $keyBinding))->implode('.')); ?>

        <?php endif; ?>
        <?php if($tooltip): ?>
            x-tooltip="{
                content: <?php echo \Illuminate\Support\Js::from($tooltip)->toHtml() ?>,
                theme: $store.theme,
            }"
        <?php endif; ?>
        <?php echo e($attributes
                ->class([$buttonClasses])
                ->style([$buttonStyles])); ?>

    >
        <?php if($icon && in_array($iconPosition, [IconPosition::Before, 'before'])): ?>
            <?php if (isset($component)) { $__componentOriginalbfc641e0710ce04e5fe02876ffc6f950 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['alias' => $iconAlias,'icon' => $icon,'class' => $iconClasses]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconAlias),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses)]); ?>
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
        <?php endif; ?>

        <span class="<?php echo e($labelClasses); ?>">
            <?php echo e($slot); ?>

        </span>

        <?php if($icon && in_array($iconPosition, [IconPosition::After, 'after'])): ?>
            <?php if (isset($component)) { $__componentOriginalbfc641e0710ce04e5fe02876ffc6f950 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['alias' => $iconAlias,'icon' => $icon,'class' => $iconClasses]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconAlias),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses)]); ?>
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
        <?php endif; ?>

        <?php if(filled($badge)): ?>
            <div class="<?php echo e($badgeClasses); ?>">
                <?php if (isset($component)) { $__componentOriginal986dce9114ddce94a270ab00ce6c273d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal986dce9114ddce94a270ab00ce6c273d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.badge','data' => ['color' => $badgeColor,'size' => 'xs']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($badgeColor),'size' => 'xs']); ?>
                    <?php echo e($badge); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal986dce9114ddce94a270ab00ce6c273d)): ?>
<?php $attributes = $__attributesOriginal986dce9114ddce94a270ab00ce6c273d; ?>
<?php unset($__attributesOriginal986dce9114ddce94a270ab00ce6c273d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal986dce9114ddce94a270ab00ce6c273d)): ?>
<?php $component = $__componentOriginal986dce9114ddce94a270ab00ce6c273d; ?>
<?php unset($__componentOriginal986dce9114ddce94a270ab00ce6c273d); ?>
<?php endif; ?>
            </div>
        <?php endif; ?>
    </a>
<?php endif; ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php /**PATH C:\laragon\www\magang\laravel-filament\vendor\filament\support\resources\views/components/button/index.blade.php ENDPATH**/ ?>