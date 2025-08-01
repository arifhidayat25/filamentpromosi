<?php if (isset($component)) { $__componentOriginal70308eab0db7bee07ae0d7b141f6dc83 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal70308eab0db7bee07ae0d7b141f6dc83 = $attributes; } ?>
<<<<<<< HEAD
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-actions::components.action','data' => ['action' => $action,'badge' => $getBadge(),'badgeColor' => $getBadgeColor(),'dynamicComponent' => 'filament::button','iconPosition' => $getIconPosition(),'labeledFrom' => $getLabeledFromBreakpoint(),'outlined' => $isOutlined(),'size' => $getSize(),'class' => 'fi-ac-btn-action']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
=======
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-actions::components.action','data' => ['action' => $action,'dynamicComponent' => 'filament::button','outlined' => $isOutlined(),'labeledFrom' => $getLabeledFromBreakpoint(),'iconPosition' => $getIconPosition(),'iconSize' => $getIconSize(),'class' => 'fi-ac-btn-action']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php $component->withName('filament-actions::action'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<<<<<<< HEAD
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action),'badge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getBadge()),'badge-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getBadgeColor()),'dynamic-component' => 'filament::button','icon-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getIconPosition()),'labeled-from' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getLabeledFromBreakpoint()),'outlined' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isOutlined()),'size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getSize()),'class' => 'fi-ac-btn-action']); ?>
=======
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action),'dynamic-component' => 'filament::button','outlined' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isOutlined()),'labeled-from' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getLabeledFromBreakpoint()),'icon-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getIconPosition()),'icon-size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getIconSize()),'class' => 'fi-ac-btn-action']); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    <?php echo e($getLabel()); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal70308eab0db7bee07ae0d7b141f6dc83)): ?>
<?php $attributes = $__attributesOriginal70308eab0db7bee07ae0d7b141f6dc83; ?>
<?php unset($__attributesOriginal70308eab0db7bee07ae0d7b141f6dc83); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal70308eab0db7bee07ae0d7b141f6dc83)): ?>
<?php $component = $__componentOriginal70308eab0db7bee07ae0d7b141f6dc83; ?>
<?php unset($__componentOriginal70308eab0db7bee07ae0d7b141f6dc83); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\magang\laravel-filament\vendor\filament\actions\resources\views/button-action.blade.php ENDPATH**/ ?>