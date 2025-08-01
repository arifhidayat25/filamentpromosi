<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'actions',
    'alignment' => null,
    'fullWidth' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'actions',
    'alignment' => null,
    'fullWidth' => false,
]); ?>
<?php foreach (array_filter(([
    'actions',
    'alignment' => null,
    'fullWidth' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<<<<<<< HEAD
<!--[if BLOCK]><![endif]--><?php if(count($actions)): ?>
=======
<?php if(count($actions)): ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
    <div
        <?php if($this->areFormActionsSticky()): ?>
            x-data="{
                isSticky: false,

                evaluatePageScrollPosition: function () {
                    this.isSticky =
<<<<<<< HEAD
                        document.body.scrollHeight >=
                        window.scrollY + window.innerHeight * 2
=======
                        window.scrollY + window.innerHeight * 2 <=
                        document.body.scrollHeight
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
                },
            }"
            x-init="evaluatePageScrollPosition"
            x-on:scroll.window="evaluatePageScrollPosition"
            x-bind:class="{
<<<<<<< HEAD
                'fi-sticky sticky bottom-0 -mx-4 transform bg-white p-4 shadow-lg ring-1 ring-gray-950/5 transition dark:bg-gray-900 dark:ring-white/10 md:bottom-4 md:rounded-xl':
                    isSticky,
            }"
        <?php endif; ?>
        class="fi-form-actions"
    >
        <?php if (isset($component)) { $__componentOriginal59d80b1aec4ae4c914a3e52dede19504 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal59d80b1aec4ae4c914a3e52dede19504 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.actions','data' => ['actions' => $actions,'alignment' => $alignment ?? $this->getFormActionsAlignment(),'fullWidth' => $fullWidth]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::actions'); ?>
=======
                'fi-form-actions-sticky-panel sticky bottom-0 -mx-4 transform bg-white p-4 shadow-lg ring-1 ring-gray-950/5 transition dark:bg-gray-900 dark:ring-white/10 md:bottom-4 md:rounded-xl':
                    isSticky,
            }"
        <?php endif; ?>
    >
        <?php if (isset($component)) { $__componentOriginalb2f112d7b18f6837dfc4fbc7ec4524d2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb2f112d7b18f6837dfc4fbc7ec4524d2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-actions::components.actions','data' => ['actions' => $actions,'alignment' => $alignment ?? $this->getFormActionsAlignment(),'fullWidth' => $fullWidth,'class' => 'fi-form-actions']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-actions::actions'); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<<<<<<< HEAD
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actions),'alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($alignment ?? $this->getFormActionsAlignment()),'full-width' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($fullWidth)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal59d80b1aec4ae4c914a3e52dede19504)): ?>
<?php $attributes = $__attributesOriginal59d80b1aec4ae4c914a3e52dede19504; ?>
<?php unset($__attributesOriginal59d80b1aec4ae4c914a3e52dede19504); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal59d80b1aec4ae4c914a3e52dede19504)): ?>
<?php $component = $__componentOriginal59d80b1aec4ae4c914a3e52dede19504; ?>
<?php unset($__componentOriginal59d80b1aec4ae4c914a3e52dede19504); ?>
<?php endif; ?>
    </div>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->
=======
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actions),'alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($alignment ?? $this->getFormActionsAlignment()),'full-width' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($fullWidth),'class' => 'fi-form-actions']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb2f112d7b18f6837dfc4fbc7ec4524d2)): ?>
<?php $attributes = $__attributesOriginalb2f112d7b18f6837dfc4fbc7ec4524d2; ?>
<?php unset($__attributesOriginalb2f112d7b18f6837dfc4fbc7ec4524d2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb2f112d7b18f6837dfc4fbc7ec4524d2)): ?>
<?php $component = $__componentOriginalb2f112d7b18f6837dfc4fbc7ec4524d2; ?>
<?php unset($__componentOriginalb2f112d7b18f6837dfc4fbc7ec4524d2); ?>
<?php endif; ?>
    </div>
<?php endif; ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php /**PATH C:\laragon\www\magang\laravel-filament\vendor\filament\filament\resources\views/components/form/actions.blade.php ENDPATH**/ ?>