<<<<<<< HEAD
<?php
    $brandName = filament()->getBrandName();
    $brandLogo = filament()->getBrandLogo();
    $brandLogoHeight = filament()->getBrandLogoHeight() ?? '1.5rem';
    $darkModeBrandLogo = filament()->getDarkModeBrandLogo();
    $hasDarkModeBrandLogo = filled($darkModeBrandLogo);

    $getLogoClasses = fn (bool $isDarkMode): string => \Illuminate\Support\Arr::toCssClasses([
        'fi-logo',
        'flex' => ! $hasDarkModeBrandLogo,
        'flex dark:hidden' => $hasDarkModeBrandLogo && (! $isDarkMode),
        'hidden dark:flex' => $hasDarkModeBrandLogo && $isDarkMode,
    ]);

    $logoStyles = "height: {$brandLogoHeight}";
?>


            <?php $content = (function ($args) {
                return function ($logo, $isDarkMode = false) use ($args) {
                    extract($args, EXTR_SKIP);
                    ob_start(); ?>
        
    <?php if($logo instanceof \Illuminate\Contracts\Support\Htmlable): ?>
        <div
            <?php echo e($attributes
                    ->class([$getLogoClasses($isDarkMode)])
                    ->style([$logoStyles])); ?>

        >
            <?php echo e($logo); ?>

        </div>
    <?php elseif(filled($logo)): ?>
        <img
            alt="<?php echo e(__('filament-panels::layout.logo.alt', ['name' => $brandName])); ?>"
            src="<?php echo e($logo); ?>"
            <?php echo e($attributes
                    ->class([$getLogoClasses($isDarkMode)])
                    ->style([$logoStyles])); ?>

        />
    <?php else: ?>
        <div
            <?php echo e($attributes->class([
                    $getLogoClasses($isDarkMode),
                    'text-xl font-bold leading-5 tracking-tight text-gray-950 dark:text-white',
                ])); ?>

        >
            <?php echo e($brandName); ?>

        </div>
    <?php endif; ?>

            <?php return new \Illuminate\Support\HtmlString(ob_get_clean()); };
                })(get_defined_vars()); ?>
        

<?php echo e($content($brandLogo)); ?>


<?php if($hasDarkModeBrandLogo): ?>
    <?php echo e($content($darkModeBrandLogo, isDarkMode: true)); ?>

=======
<?php if(filled($brand = filament()->getBrandName())): ?>
    <div
        <?php echo e($attributes->class([
                'fi-logo text-xl font-bold leading-5 tracking-tight text-gray-950 dark:text-white',
            ])); ?>

    >
        <?php echo e($brand); ?>

    </div>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
<?php endif; ?>
<?php /**PATH C:\laragon\www\magang\laravel-filament\vendor\filament\filament\resources\views/components/logo.blade.php ENDPATH**/ ?>