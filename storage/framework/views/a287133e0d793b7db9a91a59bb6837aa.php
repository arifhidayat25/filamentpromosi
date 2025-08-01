<?php if (isset($component)) { $__componentOriginal166a02a7c5ef5a9331faf66fa665c256 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal166a02a7c5ef5a9331faf66fa665c256 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.page.index','data' => ['class' => \Illuminate\Support\Arr::toCssClasses([
        'fi-resource-list-records-page',
        'fi-resource-' . str_replace('/', '-', $this->getResource()::getSlug()),
    ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-panels::page'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
        'fi-resource-list-records-page',
        'fi-resource-' . str_replace('/', '-', $this->getResource()::getSlug()),
    ]))]); ?>
    <div class="flex flex-col gap-y-6">
<<<<<<< HEAD
        <?php if (isset($component)) { $__componentOriginale77d85bd24d039fa58cc32119f1d9bc5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale77d85bd24d039fa58cc32119f1d9bc5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.resources.tabs','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-panels::resources.tabs'); ?>
=======
        <?php if(count($tabs = $this->getTabs())): ?>
            <?php if (isset($component)) { $__componentOriginal447636fe67a19f9c79619fb5a3c0c28d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal447636fe67a19f9c79619fb5a3c0c28d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.tabs.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::tabs'); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<<<<<<< HEAD
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale77d85bd24d039fa58cc32119f1d9bc5)): ?>
<?php $attributes = $__attributesOriginale77d85bd24d039fa58cc32119f1d9bc5; ?>
<?php unset($__attributesOriginale77d85bd24d039fa58cc32119f1d9bc5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale77d85bd24d039fa58cc32119f1d9bc5)): ?>
<?php $component = $__componentOriginale77d85bd24d039fa58cc32119f1d9bc5; ?>
<?php unset($__componentOriginale77d85bd24d039fa58cc32119f1d9bc5); ?>
<?php endif; ?>

        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::RESOURCE_PAGES_LIST_RECORDS_TABLE_BEFORE, scopes: $this->getRenderHookScopes())); ?>
=======
                <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::resource.pages.list-records.tabs.start', scopes: $this->getRenderHookScopes())); ?>


                <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tabKey => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $activeTab = strval($activeTab);
                        $tabKey = strval($tabKey);
                    ?>

                    <?php if (isset($component)) { $__componentOriginal35d4caf141547fb7d125e4ebd3c1b66f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal35d4caf141547fb7d125e4ebd3c1b66f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.tabs.item','data' => ['active' => $activeTab === $tabKey,'badge' => $tab->getBadge(),'icon' => $tab->getIcon(),'iconPosition' => $tab->getIconPosition(),'wire:click' => '$set(\'activeTab\', ' . (filled($tabKey) ? ('\'' . $tabKey . '\'') : 'null') . ')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::tabs.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($activeTab === $tabKey),'badge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tab->getBadge()),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tab->getIcon()),'icon-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tab->getIconPosition()),'wire:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('$set(\'activeTab\', ' . (filled($tabKey) ? ('\'' . $tabKey . '\'') : 'null') . ')')]); ?>
                        <?php echo e($tab->getLabel() ?? $this->generateTabLabel($tabKey)); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal35d4caf141547fb7d125e4ebd3c1b66f)): ?>
<?php $attributes = $__attributesOriginal35d4caf141547fb7d125e4ebd3c1b66f; ?>
<?php unset($__attributesOriginal35d4caf141547fb7d125e4ebd3c1b66f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal35d4caf141547fb7d125e4ebd3c1b66f)): ?>
<?php $component = $__componentOriginal35d4caf141547fb7d125e4ebd3c1b66f; ?>
<?php unset($__componentOriginal35d4caf141547fb7d125e4ebd3c1b66f); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::resource.pages.list-records.tabs.end', scopes: $this->getRenderHookScopes())); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal447636fe67a19f9c79619fb5a3c0c28d)): ?>
<?php $attributes = $__attributesOriginal447636fe67a19f9c79619fb5a3c0c28d; ?>
<?php unset($__attributesOriginal447636fe67a19f9c79619fb5a3c0c28d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal447636fe67a19f9c79619fb5a3c0c28d)): ?>
<?php $component = $__componentOriginal447636fe67a19f9c79619fb5a3c0c28d; ?>
<?php unset($__componentOriginal447636fe67a19f9c79619fb5a3c0c28d); ?>
<?php endif; ?>
        <?php endif; ?>

        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::resource.pages.list-records.table.before', scopes: $this->getRenderHookScopes())); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589


        <?php echo e($this->table); ?>


<<<<<<< HEAD
        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::RESOURCE_PAGES_LIST_RECORDS_TABLE_AFTER, scopes: $this->getRenderHookScopes())); ?>
=======
        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::resource.pages.list-records.table.after', scopes: $this->getRenderHookScopes())); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589

    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal166a02a7c5ef5a9331faf66fa665c256)): ?>
<?php $attributes = $__attributesOriginal166a02a7c5ef5a9331faf66fa665c256; ?>
<?php unset($__attributesOriginal166a02a7c5ef5a9331faf66fa665c256); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal166a02a7c5ef5a9331faf66fa665c256)): ?>
<?php $component = $__componentOriginal166a02a7c5ef5a9331faf66fa665c256; ?>
<?php unset($__componentOriginal166a02a7c5ef5a9331faf66fa665c256); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\magang\laravel-filament\vendor\filament\filament\resources\views/resources/pages/list-records.blade.php ENDPATH**/ ?>