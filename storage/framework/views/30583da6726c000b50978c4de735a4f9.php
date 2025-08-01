<<<<<<< HEAD
<?php
    $statePath = $getStatePath();
?>

=======
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => $getFieldWrapperView()] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\DynamicComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<<<<<<< HEAD
<?php $component->withAttributes(['field' => $field,'inline-label-vertical-alignment' => \Filament\Support\Enums\VerticalAlignment::Center]); ?>
=======
<?php $component->withAttributes(['field' => $field]); ?>
    <?php
        $statePath = $getStatePath();
    ?>

>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    
            <?php $content = (function ($args) {
                return function () use ($args) {
                    extract($args, EXTR_SKIP);
                    ob_start(); ?>
        
        <?php if (isset($component)) { $__componentOriginal087b30d649cc1cfb7e9ea8930c92d47d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal087b30d649cc1cfb7e9ea8930c92d47d = $attributes; } ?>
<<<<<<< HEAD
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.input.checkbox','data' => ['valid' => ! $errors->has($statePath),'attributes' => 
=======
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.input.checkbox','data' => ['error' => $errors->has($statePath),'attributes' => 
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
                $attributes
                    ->merge([
                        'autofocus' => $isAutofocused(),
                        'disabled' => $isDisabled(),
                        'id' => $getId(),
                        'required' => $isRequired() && (! $isConcealed()),
                        'wire:loading.attr' => 'disabled',
                        $applyStateBindingModifiers('wire:model') => $statePath,
                    ], escape: false)
                    ->merge($getExtraAttributes(), escape: false)
                    ->merge($getExtraInputAttributes(), escape: false)
            ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::input.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<<<<<<< HEAD
<?php $component->withAttributes(['valid' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(! $errors->has($statePath)),'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
=======
<?php $component->withAttributes(['error' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->has($statePath)),'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
                $attributes
                    ->merge([
                        'autofocus' => $isAutofocused(),
                        'disabled' => $isDisabled(),
                        'id' => $getId(),
                        'required' => $isRequired() && (! $isConcealed()),
                        'wire:loading.attr' => 'disabled',
                        $applyStateBindingModifiers('wire:model') => $statePath,
                    ], escape: false)
                    ->merge($getExtraAttributes(), escape: false)
                    ->merge($getExtraInputAttributes(), escape: false)
            )]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal087b30d649cc1cfb7e9ea8930c92d47d)): ?>
<?php $attributes = $__attributesOriginal087b30d649cc1cfb7e9ea8930c92d47d; ?>
<?php unset($__attributesOriginal087b30d649cc1cfb7e9ea8930c92d47d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal087b30d649cc1cfb7e9ea8930c92d47d)): ?>
<?php $component = $__componentOriginal087b30d649cc1cfb7e9ea8930c92d47d; ?>
<?php unset($__componentOriginal087b30d649cc1cfb7e9ea8930c92d47d); ?>
<?php endif; ?>
    
            <?php return new \Illuminate\Support\HtmlString(ob_get_clean()); };
                })(get_defined_vars()); ?>
        

<<<<<<< HEAD
    <!--[if BLOCK]><![endif]--><?php if($isInline()): ?>
=======
    <?php if($isInline()): ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
         <?php $__env->slot('labelPrefix', null, []); ?> 
            <?php echo e($content()); ?>

         <?php $__env->endSlot(); ?>
    <?php else: ?>
        <?php echo e($content()); ?>

<<<<<<< HEAD
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
=======
    <?php endif; ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
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
<?php /**PATH C:\laragon\www\magang\laravel-filament\vendor\filament\forms\resources\views/components/checkbox.blade.php ENDPATH**/ ?>