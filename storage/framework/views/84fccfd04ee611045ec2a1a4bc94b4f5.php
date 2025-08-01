<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'actions' => [],
    'badge' => null,
    'badgeColor' => null,
    'button' => false,
    'color' => null,
<<<<<<< HEAD
    'dropdownMaxHeight' => null,
    'dropdownOffset' => null,
    'dropdownPlacement' => null,
    'dropdownWidth' => null,
    'dynamicComponent' => null,
    'group' => null,
    'icon' => null,
    'iconSize' => null,
=======
    'dropdownPlacement' => null,
    'dynamicComponent' => null,
    'group' => null,
    'icon' => null,
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    'iconButton' => false,
    'label' => null,
    'link' => false,
    'size' => null,
    'tooltip' => null,
    'view' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'actions' => [],
    'badge' => null,
    'badgeColor' => null,
    'button' => false,
    'color' => null,
<<<<<<< HEAD
    'dropdownMaxHeight' => null,
    'dropdownOffset' => null,
    'dropdownPlacement' => null,
    'dropdownWidth' => null,
    'dynamicComponent' => null,
    'group' => null,
    'icon' => null,
    'iconSize' => null,
=======
    'dropdownPlacement' => null,
    'dynamicComponent' => null,
    'group' => null,
    'icon' => null,
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    'iconButton' => false,
    'label' => null,
    'link' => false,
    'size' => null,
    'tooltip' => null,
    'view' => null,
]); ?>
<?php foreach (array_filter(([
    'actions' => [],
    'badge' => null,
    'badgeColor' => null,
    'button' => false,
    'color' => null,
<<<<<<< HEAD
    'dropdownMaxHeight' => null,
    'dropdownOffset' => null,
    'dropdownPlacement' => null,
    'dropdownWidth' => null,
    'dynamicComponent' => null,
    'group' => null,
    'icon' => null,
    'iconSize' => null,
=======
    'dropdownPlacement' => null,
    'dynamicComponent' => null,
    'group' => null,
    'icon' => null,
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    'iconButton' => false,
    'label' => null,
    'link' => false,
    'size' => null,
    'tooltip' => null,
    'view' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<<<<<<< HEAD
<!--[if BLOCK]><![endif]--><?php if(! ($dynamicComponent && $group)): ?>
    <?php
        $group = \Filament\Actions\ActionGroup::make($actions)
            ->badgeColor($badgeColor)
            ->color($color)
            ->dropdownMaxHeight($dropdownMaxHeight)
            ->dropdownOffset($dropdownOffset)
            ->dropdownPlacement($dropdownPlacement)
            ->dropdownWidth($dropdownWidth)
            ->icon($icon)
            ->iconSize($iconSize)
=======
<?php if(! ($dynamicComponent && $group)): ?>
    <?php
        $group = \Filament\Actions\ActionGroup::make($actions)
            ->badge($badge)
            ->badgeColor($badgeColor)
            ->color($color)
            ->dropdownPlacement($dropdownPlacement)
            ->icon($icon)
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
            ->label($label)
            ->size($size)
            ->tooltip($tooltip)
            ->view($view);

<<<<<<< HEAD
        $badge === true
            ? $group->badge()
            : $group->badge($badge);

        if ($button) {
            $group
                ->button()
                ->iconPosition($attributes->get('iconPosition') ?? $attributes->get('icon-position'))
                ->outlined($attributes->get('outlined') ?? false);
=======
        if ($button) {
            $group->button();
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
        }

        if ($iconButton) {
            $group->iconButton();
        }

        if ($link) {
            $group->link();
        }
    ?>

    <?php echo e($group); ?>

<?php elseif(! $group->hasDropdown()): ?>
<<<<<<< HEAD
    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $group->getActions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!--[if BLOCK]><![endif]--><?php if($action->isVisible()): ?>
            <?php echo e($action); ?>

        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
=======
    <?php $__currentLoopData = $group->getActions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($action->isVisible()): ?>
            <?php echo e($action); ?>

        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php else: ?>
    <?php
        $actionLists = [];
        $singleActions = [];

        foreach ($group->getActions() as $action) {
            if ($action->isHidden()) {
                continue;
            }

            if ($action instanceof \Filament\Actions\ActionGroup && (! $action->hasDropdown())) {
                if (count($singleActions)) {
                    $actionLists[] = $singleActions;
                    $singleActions = [];
                }

                $actionLists[] = array_filter(
                    $action->getActions(),
                    fn ($action): bool => $action->isVisible(),
                );
            } else {
                $singleActions[] = $action;
            }
        }

        if (count($singleActions)) {
            $actionLists[] = $singleActions;
        }
    ?>

    <?php if (isset($component)) { $__componentOriginal22ab0dbc2c6619d5954111bba06f01db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22ab0dbc2c6619d5954111bba06f01db = $attributes; } ?>
<<<<<<< HEAD
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.index','data' => ['maxHeight' => $group->getDropdownMaxHeight(),'offset' => $group->getDropdownOffset(),'placement' => $group->getDropdownPlacement() ?? 'bottom-start','width' => $group->getDropdownWidth(),'teleport' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
=======
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.index','data' => ['maxHeight' => $group->getDropdownMaxHeight(),'placement' => $group->getDropdownPlacement() ?? 'bottom-start','width' => $group->getDropdownWidth(),'teleport' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php $component->withName('filament::dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<<<<<<< HEAD
<?php $component->withAttributes(['max-height' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group->getDropdownMaxHeight()),'offset' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group->getDropdownOffset()),'placement' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group->getDropdownPlacement() ?? 'bottom-start'),'width' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group->getDropdownWidth()),'teleport' => true]); ?>
=======
<?php $component->withAttributes(['max-height' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group->getDropdownMaxHeight()),'placement' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group->getDropdownPlacement() ?? 'bottom-start'),'width' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group->getDropdownWidth()),'teleport' => true]); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
         <?php $__env->slot('trigger', null, []); ?> 
            <?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => $dynamicComponent] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\DynamicComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<<<<<<< HEAD
<?php $component->withAttributes(['color' => $group->getColor(),'icon' => $group->getIcon(),'icon-size' => $group->getIconSize(),'label-sr-only' => $group->isLabelHidden(),'size' => $group->getSize(),'tooltip' => $group->getTooltip(),'attributes' => \Filament\Support\prepare_inherited_attributes($attributes)->merge($group->getExtraAttributes(), escape: false)]); ?>
=======
<?php $component->withAttributes(['badge' => $group->getBadge(),'badge-color' => $group->getBadgeColor(),'color' => $group->getColor(),'tooltip' => $group->getTooltip(),'icon' => $group->getIcon(),'size' => $group->getSize(),'label-sr-only' => $group->isLabelHidden(),'attributes' => \Filament\Support\prepare_inherited_attributes($attributes)->merge($group->getExtraAttributes(), escape: false)]); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
                <?php echo e($slot); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $attributes = $__attributesOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
         <?php $__env->endSlot(); ?>

<<<<<<< HEAD
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $actionLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $actions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
=======
        <?php $__currentLoopData = $actionLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $actions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
            <?php if (isset($component)) { $__componentOriginal66687bf0670b9e16f61e667468dc8983 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66687bf0670b9e16f61e667468dc8983 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.list.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::dropdown.list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<<<<<<< HEAD
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($action); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
=======
                <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($action); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal66687bf0670b9e16f61e667468dc8983)): ?>
<?php $attributes = $__attributesOriginal66687bf0670b9e16f61e667468dc8983; ?>
<?php unset($__attributesOriginal66687bf0670b9e16f61e667468dc8983); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal66687bf0670b9e16f61e667468dc8983)): ?>
<?php $component = $__componentOriginal66687bf0670b9e16f61e667468dc8983; ?>
<?php unset($__componentOriginal66687bf0670b9e16f61e667468dc8983); ?>
<?php endif; ?>
<<<<<<< HEAD
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
=======
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal22ab0dbc2c6619d5954111bba06f01db)): ?>
<?php $attributes = $__attributesOriginal22ab0dbc2c6619d5954111bba06f01db; ?>
<?php unset($__attributesOriginal22ab0dbc2c6619d5954111bba06f01db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal22ab0dbc2c6619d5954111bba06f01db)): ?>
<?php $component = $__componentOriginal22ab0dbc2c6619d5954111bba06f01db; ?>
<?php unset($__componentOriginal22ab0dbc2c6619d5954111bba06f01db); ?>
<?php endif; ?>
<<<<<<< HEAD
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->
=======
<?php endif; ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php /**PATH C:\laragon\www\magang\laravel-filament\vendor\filament\actions\resources\views/components/group.blade.php ENDPATH**/ ?>