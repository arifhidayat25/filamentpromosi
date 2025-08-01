<?php if (isset($component)) { $__componentOriginalbdee036326cbc931a2e3bf686403ecb7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbdee036326cbc931a2e3bf686403ecb7 = $attributes; } ?>
<<<<<<< HEAD
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-actions::components.group','data' => ['badge' => $getBadge(),'badgeColor' => $getBadgeColor(),'dynamicComponent' => 'filament::button','group' => $group,'iconPosition' => $getIconPosition(),'labeledFrom' => $getLabeledFromBreakpoint(),'outlined' => $isOutlined(),'size' => $getSize(),'class' => 'fi-ac-btn-group']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
=======
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-actions::components.group','data' => ['group' => $group,'dynamicComponent' => 'filament::button','outlined' => $isOutlined(),'labeledFrom' => $getLabeledFromBreakpoint(),'iconPosition' => $getIconPosition(),'iconSize' => $getIconSize(),'class' => 'fi-ac-btn-group']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php $component->withName('filament-actions::group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<<<<<<< HEAD
<?php $component->withAttributes(['badge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getBadge()),'badge-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getBadgeColor()),'dynamic-component' => 'filament::button','group' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group),'icon-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getIconPosition()),'labeled-from' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getLabeledFromBreakpoint()),'outlined' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isOutlined()),'size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getSize()),'class' => 'fi-ac-btn-group']); ?>
=======
<?php $component->withAttributes(['group' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group),'dynamic-component' => 'filament::button','outlined' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isOutlined()),'labeled-from' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getLabeledFromBreakpoint()),'icon-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getIconPosition()),'icon-size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getIconSize()),'class' => 'fi-ac-btn-group']); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    <?php echo e($getLabel()); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbdee036326cbc931a2e3bf686403ecb7)): ?>
<?php $attributes = $__attributesOriginalbdee036326cbc931a2e3bf686403ecb7; ?>
<?php unset($__attributesOriginalbdee036326cbc931a2e3bf686403ecb7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbdee036326cbc931a2e3bf686403ecb7)): ?>
<?php $component = $__componentOriginalbdee036326cbc931a2e3bf686403ecb7; ?>
<?php unset($__componentOriginalbdee036326cbc931a2e3bf686403ecb7); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\magang\laravel-filament\vendor\filament\actions\resources\views/button-group.blade.php ENDPATH**/ ?>