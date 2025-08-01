<?php
    use Filament\Support\Enums\ActionSize;
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
    'href' => null,
=======
    'color' => 'primary',
    'disabled' => false,
    'form' => null,
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    'icon' => null,
    'iconAlias' => null,
    'iconSize' => null,
    'keyBindings' => null,
    'label' => null,
<<<<<<< HEAD
    'loadingIndicator' => true,
    'size' => ActionSize::Medium,
    'spaMode' => null,
    'tag' => 'button',
    'target' => null,
=======
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
    'href' => null,
=======
    'color' => 'primary',
    'disabled' => false,
    'form' => null,
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    'icon' => null,
    'iconAlias' => null,
    'iconSize' => null,
    'keyBindings' => null,
    'label' => null,
<<<<<<< HEAD
    'loadingIndicator' => true,
    'size' => ActionSize::Medium,
    'spaMode' => null,
    'tag' => 'button',
    'target' => null,
=======
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
    'href' => null,
=======
    'color' => 'primary',
    'disabled' => false,
    'form' => null,
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    'icon' => null,
    'iconAlias' => null,
    'iconSize' => null,
    'keyBindings' => null,
    'label' => null,
<<<<<<< HEAD
    'loadingIndicator' => true,
    'size' => ActionSize::Medium,
    'spaMode' => null,
    'tag' => 'button',
    'target' => null,
=======
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
    if (! $size instanceof ActionSize) {
        $size = filled($size) ? (ActionSize::tryFrom($size) ?? $size) : null;
    }

    $iconSize ??= match ($size) {
        ActionSize::ExtraSmall => IconSize::Small,
        ActionSize::Small, ActionSize::Medium => IconSize::Medium,
        ActionSize::Large, ActionSize::ExtraLarge => IconSize::Large,
        default => IconSize::Medium,
    };

    if (! $iconSize instanceof IconSize) {
        $iconSize = filled($iconSize) ? (IconSize::tryFrom($iconSize) ?? $iconSize) : null;
    }

    $buttonClasses = \Illuminate\Support\Arr::toCssClasses([
        'fi-icon-btn relative flex items-center justify-center rounded-lg outline-none transition duration-75 focus-visible:ring-2',
        'pointer-events-none opacity-70' => $disabled,
        ...match ($size) {
            ActionSize::ExtraSmall => [
                match ($iconSize) {
                    IconSize::Small => '-m-1.5',
                    IconSize::Medium => '-m-1',
                    IconSize::Large => '-m-0.5',
                },
                'h-7 w-7',
            ],
            ActionSize::Small => [
                match ($iconSize) {
                    IconSize::Small => '-m-2',
                    IconSize::Medium => '-m-1.5',
                    IconSize::Large => '-m-1',
                },
                'h-8 w-8',
            ],
            ActionSize::Medium => [
                match ($iconSize) {
                    IconSize::Small => '-m-2.5',
                    IconSize::Medium => '-m-2',
                    IconSize::Large => '-m-1.5',
                },
                'h-9 w-9',
            ],
            ActionSize::Large => [
                match ($iconSize) {
                    IconSize::Small => '-m-3',
                    IconSize::Medium => '-m-2.5',
                    IconSize::Large => '-m-2',
                },
                'h-10 w-10',
            ],
            ActionSize::ExtraLarge => [
                match ($iconSize) {
                    IconSize::Small => '-m-3.5',
                    IconSize::Medium => '-m-3',
                    IconSize::Large => '-m-2.5',
                },
                'h-11 w-11',
            ],
        },
        match ($color) {
            'gray' => 'text-gray-400 hover:text-gray-500 focus-visible:ring-primary-600 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:ring-primary-500',
            default => 'fi-color-custom text-custom-500 hover:text-custom-600 focus-visible:ring-custom-600 dark:text-custom-400 dark:hover:text-custom-300 dark:focus-visible:ring-custom-500',
        },
        is_string($color) ? "fi-color-{$color}" : null,
    ]);

    $buttonStyles = \Filament\Support\get_color_css_variables(
        $color,
        shades: [300, 400, 500, 600],
        alias: 'icon-button',
    );
=======
    $iconSize ??= match ($size) {
        ActionSize::ExtraSmall, 'xs' => IconSize::Small,
        ActionSize::Small, ActionSize::Medium, 'sm', 'md' => IconSize::Medium,
        ActionSize::Large, ActionSize::ExtraLarge, 'lg', 'xl' => IconSize::Large,
    };

    $buttonClasses = \Illuminate\Support\Arr::toCssClasses([
        'fi-icon-btn relative flex items-center justify-center rounded-lg outline-none transition duration-75 focus:ring-2 disabled:pointer-events-none disabled:opacity-70',
        match ($size) {
            ActionSize::ExtraSmall, 'xs' => 'h-7 w-7',
            ActionSize::Small, 'sm' => 'h-8 w-8',
            ActionSize::Medium, 'md' => 'h-9 w-9',
            ActionSize::Large, 'lg' => 'h-10 w-10',
            ActionSize::ExtraLarge, 'xl' => 'h-11 w-11',
            default => $size,
        },
        match ($color) {
            'gray' => 'text-gray-400 hover:text-gray-500 focus:ring-primary-600 dark:text-gray-500 dark:hover:text-gray-400 dark:focus:ring-primary-500',
            default => 'text-custom-500 hover:text-custom-600 focus:ring-custom-600 dark:text-custom-400 dark:hover:text-custom-300 dark:focus:ring-custom-500',
        },
    ]);

    $buttonStyles = \Filament\Support\get_color_css_variables($color, shades: [300, 400, 500, 600]);
>>>>>>> 40ba94650047b47ec683394909f249e12f029589

    $iconClasses = \Illuminate\Support\Arr::toCssClasses([
        'fi-icon-btn-icon',
        match ($iconSize) {
<<<<<<< HEAD
            IconSize::Small => 'h-4 w-4',
            IconSize::Medium => 'h-5 w-5',
            IconSize::Large => 'h-6 w-6',
=======
            IconSize::Small, 'sm' => 'h-4 w-4',
            IconSize::Medium, 'md' => 'h-5 w-5',
            IconSize::Large, 'lg' => 'h-6 w-6',
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
            default => $iconSize,
        },
    ]);

<<<<<<< HEAD
    $badgeContainerClasses = 'fi-icon-btn-badge-ctn absolute start-full top-1 z-[1] w-max -translate-x-1/2 -translate-y-1/2 rounded-md bg-white dark:bg-gray-900 rtl:translate-x-1/2';

    $wireTarget = $loadingIndicator ? $attributes->whereStartsWith(['wire:target', 'wire:click'])->filter(fn ($value): bool => filled($value))->first() : null;
=======
    $badgeClasses = 'absolute start-full top-0 z-10 -ms-1 -translate-x-1/2 rounded-md bg-white dark:bg-gray-900';

    $wireTarget = $attributes->whereStartsWith(['wire:target', 'wire:click'])->filter(fn ($value): bool => filled($value))->first();
>>>>>>> 40ba94650047b47ec683394909f249e12f029589

    $hasLoadingIndicator = filled($wireTarget) || ($type === 'submit' && filled($form));

    if ($hasLoadingIndicator) {
        $loadingIndicatorTarget = html_entity_decode($wireTarget ?: $form, ENT_QUOTES);
    }
<<<<<<< HEAD

    $hasTooltip = filled($tooltip);
?>

<!--[if BLOCK]><![endif]--><?php if($tag === 'button'): ?>
    <button
        <?php if($keyBindings || $hasTooltip): ?>
            x-data="{}"
        <?php endif; ?>
        <?php if($keyBindings): ?>
            x-bind:id="$id('key-bindings')"
            x-mousetrap.global.<?php echo e(collect($keyBindings)->map(fn (string $keyBinding): string => str_replace('+', '-', $keyBinding))->implode('.')); ?>="document.getElementById($el.id).click()"
        <?php endif; ?>
        <?php if($hasTooltip): ?>
=======
?>

<?php if($tag === 'button'): ?>
    <button
        <?php if($keyBindings || $tooltip): ?>
            x-data="{}"
        <?php endif; ?>
        <?php if($keyBindings): ?>
            x-mousetrap.global.<?php echo e(collect($keyBindings)->map(fn (string $keyBinding): string => str_replace('+', '-', $keyBinding))->implode('.')); ?>

        <?php endif; ?>
        <?php if($tooltip): ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
            x-tooltip="{
                content: <?php echo \Illuminate\Support\Js::from($tooltip)->toHtml() ?>,
                theme: $store.theme,
            }"
        <?php endif; ?>
        <?php echo e($attributes
                ->merge([
                    'disabled' => $disabled,
<<<<<<< HEAD
                    'form' => $formId,
                    'type' => $type,
                    'wire:loading.attr' => 'disabled',
                    'wire:target' => ($hasLoadingIndicator && $loadingIndicatorTarget) ? $loadingIndicatorTarget : null,
                ], escape: false)
                ->merge([
                    'title' => $hasTooltip ? null : $label,
                ], escape: true)
=======
                    'title' => $label,
                    'type' => $type,
                ], escape: false)
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
                ->class([$buttonClasses])
                ->style([$buttonStyles])); ?>

    >
<<<<<<< HEAD
        <!--[if BLOCK]><![endif]--><?php if($label): ?>
=======
        <?php if($label): ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
            <span class="sr-only">
                <?php echo e($label); ?>

            </span>
<<<<<<< HEAD
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

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
        <?php if($hasLoadingIndicator): ?>
            <?php if (isset($component)) { $__componentOriginalbef7c2371a870b1887ec3741fe311a10 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbef7c2371a870b1887ec3741fe311a10 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.loading-indicator','data' => ['wire:loading.delay' => '','wire:target' => $loadingIndicatorTarget,'class' => $iconClasses]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
<?php $component->withAttributes(['wire:loading.delay' => '','wire:target' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($loadingIndicatorTarget),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses)]); ?>
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

        <!--[if BLOCK]><![endif]--><?php if(filled($badge)): ?>
            <div class="<?php echo e($badgeContainerClasses); ?>">
                <?php if (isset($component)) { $__componentOriginal986dce9114ddce94a270ab00ce6c273d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal986dce9114ddce94a270ab00ce6c273d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.badge','data' => ['color' => $badgeColor,'size' => $badgeSize]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($badgeColor),'size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($badgeSize)]); ?>
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
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </button>
<?php elseif($tag === 'a'): ?>
    <a
        <?php echo e(\Filament\Support\generate_href_html($href, $target === '_blank', $spaMode)); ?>

        <?php if($keyBindings || $hasTooltip): ?>
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
        <?php echo e($attributes
                ->merge([
                    'title' => $hasTooltip ? null : $label,
                ], escape: true)
                ->class([$buttonClasses])
                ->style([$buttonStyles])); ?>

    >
        <!--[if BLOCK]><![endif]--><?php if($label): ?>
            <span class="sr-only">
                <?php echo e($label); ?>

            </span>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

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

        <!--[if BLOCK]><![endif]--><?php if(filled($badge)): ?>
            <div class="<?php echo e($badgeContainerClasses); ?>">
=======
        <?php endif; ?>

        <?php if(filled($badge)): ?>
            <div class="<?php echo e($badgeClasses); ?>">
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
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
<<<<<<< HEAD
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </a>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->
=======
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
                ->merge([
                    'title' => $label,
                ], escape: false)
                ->class([$buttonClasses])
                ->style([$buttonStyles])); ?>

    >
        <?php if($label): ?>
            <span class="sr-only">
                <?php echo e($label); ?>

            </span>
        <?php endif; ?>

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
<?php /**PATH C:\laragon\www\magang\laravel-filament\vendor\filament\support\resources\views/components/icon-button.blade.php ENDPATH**/ ?>