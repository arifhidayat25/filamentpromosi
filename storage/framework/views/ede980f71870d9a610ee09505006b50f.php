<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
<<<<<<< HEAD
    'livewire' => null,
=======
    'livewire',
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
<<<<<<< HEAD
    'livewire' => null,
]); ?>
<?php foreach (array_filter(([
    'livewire' => null,
=======
    'livewire',
]); ?>
<?php foreach (array_filter(([
    'livewire',
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<!DOCTYPE html>
<html
    lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>"
    dir="<?php echo e(__('filament-panels::layout.direction') ?? 'ltr'); ?>"
    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
        'fi min-h-screen',
        'dark' => filament()->hasDarkModeForced(),
    ]); ?>"
>
    <head>
<<<<<<< HEAD
        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::HEAD_START, scopes: $livewire->getRenderHookScopes())); ?>
=======
        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::head.start')); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589


        <meta charset="utf-8" />
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <?php if($favicon = filament()->getFavicon()): ?>
            <link rel="icon" href="<?php echo e($favicon); ?>" />
        <?php endif; ?>

<<<<<<< HEAD
        <?php
            $title = trim(strip_tags(($livewire ?? null)?->getTitle() ?? ''));
            $brandName = trim(strip_tags(filament()->getBrandName()));
        ?>

        <title>
            <?php echo e(filled($title) ? "{$title} - " : null); ?> <?php echo e($brandName); ?>

        </title>

        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::STYLES_BEFORE, scopes: $livewire->getRenderHookScopes())); ?>
=======
        <title>
            <?php echo e(filled($title = $livewire->getTitle()) ? "{$title} - " : null); ?>

            <?php echo e(filament()->getBrandName()); ?>

        </title>

        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::styles.before')); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589


        <style>
            [x-cloak=''],
            [x-cloak='x-cloak'],
            [x-cloak='1'] {
                display: none !important;
            }

            @media (max-width: 1023px) {
                [x-cloak='-lg'] {
                    display: none !important;
                }
            }

            @media (min-width: 1024px) {
                [x-cloak='lg'] {
                    display: none !important;
                }
            }
        </style>

        <?php echo \Filament\Support\Facades\FilamentAsset::renderStyles() ?>
<<<<<<< HEAD

=======
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
        <?php echo e(filament()->getTheme()->getHtml()); ?>

        <?php echo e(filament()->getFontHtml()); ?>


        <style>
            :root {
<<<<<<< HEAD
                --font-family: '<?php echo filament()->getFontFamily(); ?>';
                --sidebar-width: <?php echo e(filament()->getSidebarWidth()); ?>;
                --collapsed-sidebar-width: <?php echo e(filament()->getCollapsedSidebarWidth()); ?>;
                --default-theme-mode: <?php echo e(filament()->getDefaultThemeMode()->value); ?>;
            }
        </style>

        <?php echo $__env->yieldPushContent('styles'); ?>

        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::STYLES_AFTER, scopes: $livewire->getRenderHookScopes())); ?>
=======
                --font-family: <?php echo filament()->getFontFamily(); ?>;
                --sidebar-width: <?php echo e(filament()->getSidebarWidth()); ?>;
                --collapsed-sidebar-width: <?php echo e(filament()->getCollapsedSidebarWidth()); ?>;
            }
        </style>

        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::styles.after')); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589


        <?php if(! filament()->hasDarkMode()): ?>
            <script>
                localStorage.setItem('theme', 'light')
            </script>
        <?php elseif(filament()->hasDarkModeForced()): ?>
            <script>
                localStorage.setItem('theme', 'dark')
            </script>
        <?php else: ?>
            <script>
<<<<<<< HEAD
                const loadDarkMode = () => {
                    window.theme = localStorage.getItem('theme') ?? <?php echo \Illuminate\Support\Js::from(filament()->getDefaultThemeMode()->value)->toHtml() ?>

                    if (
                        window.theme === 'dark' ||
                        (window.theme === 'system' &&
                            window.matchMedia('(prefers-color-scheme: dark)')
                                .matches)
                    ) {
                        document.documentElement.classList.add('dark')
                    }
                }

                loadDarkMode()

                document.addEventListener('livewire:navigated', loadDarkMode)
            </script>
        <?php endif; ?>

        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::HEAD_END, scopes: $livewire->getRenderHookScopes())); ?>
=======
                const theme = localStorage.getItem('theme') ?? 'system'

                if (
                    theme === 'dark' ||
                    (theme === 'system' &&
                        window.matchMedia('(prefers-color-scheme: dark)')
                            .matches)
                ) {
                    document.documentElement.classList.add('dark')
                }
            </script>
        <?php endif; ?>

        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::head.end')); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589

    </head>

    <body
<<<<<<< HEAD
        <?php echo e($attributes
                ->merge(($livewire ?? null)?->getExtraBodyAttributes() ?? [], escape: false)
                ->class([
                    'fi-body',
                    'fi-panel-' . filament()->getId(),
                    'min-h-screen bg-gray-50 font-normal text-gray-950 antialiased dark:bg-gray-950 dark:text-white',
                ])); ?>

    >
        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::BODY_START, scopes: $livewire->getRenderHookScopes())); ?>
=======
        class="min-h-screen bg-gray-50 font-normal text-gray-950 antialiased dark:bg-gray-950 dark:text-white"
    >
        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::body.start')); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589


        <?php echo e($slot); ?>


        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split(Filament\Livewire\Notifications::class);

$__html = app('livewire')->mount($__name, $__params, 'lw-4148956064-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

<<<<<<< HEAD
        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SCRIPTS_BEFORE, scopes: $livewire->getRenderHookScopes())); ?>
=======
        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::scripts.before')); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589


        <?php echo \Filament\Support\Facades\FilamentAsset::renderScripts(withCore: true) ?>

<<<<<<< HEAD
        <?php if(filament()->hasBroadcasting() && config('filament.broadcasting.echo')): ?>
            <script data-navigate-once>
                window.Echo = new window.EchoFactory(<?php echo \Illuminate\Support\Js::from(config('filament.broadcasting.echo'))->toHtml() ?>)

                window.dispatchEvent(new CustomEvent('EchoLoaded'))
            </script>
        <?php endif; ?>

        <?php if(filament()->hasDarkMode() && (! filament()->hasDarkModeForced())): ?>
            <script>
                loadDarkMode()
=======
        <?php if(config('filament.broadcasting.echo')): ?>
            <script>
                window.addEventListener('DOMContentLoaded', () => {
                    window.Echo = new window.EchoFactory(<?php echo \Illuminate\Support\Js::from(config('filament.broadcasting.echo'))->toHtml() ?>)

                    window.dispatchEvent(new CustomEvent('EchoLoaded'))
                })
>>>>>>> 40ba94650047b47ec683394909f249e12f029589
            </script>
        <?php endif; ?>

        <?php echo $__env->yieldPushContent('scripts'); ?>

<<<<<<< HEAD
        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SCRIPTS_AFTER, scopes: $livewire->getRenderHookScopes())); ?>


        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::BODY_END, scopes: $livewire->getRenderHookScopes())); ?>
=======
        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::scripts.after')); ?>


        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::body.end')); ?>
>>>>>>> 40ba94650047b47ec683394909f249e12f029589

    </body>
</html>
<?php /**PATH C:\laragon\www\magang\laravel-filament\vendor\filament\filament\resources\views/components/layout/base.blade.php ENDPATH**/ ?>