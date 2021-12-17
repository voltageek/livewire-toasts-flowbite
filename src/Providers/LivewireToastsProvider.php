<?php

namespace Aliowa\LivewireToasts\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LivewireToastsProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'aliowa');

        if ($this->app->runningInConsole()) {
            $this->publishes(
                [__DIR__ . '/../../resources/views' => $this->app->resourcePath('views/vendor/aliowa/livewire-toasts')],
                ['aliowa-livewire-toasts', 'aliowa-livewire-toasts:views']
            );
        }

        Blade::directive('aliowaLivewireToastsScripts', function () {
            return <<<'HTML'
            <script>
                document.addEventListener('alpine:init', () => {
                    Alpine.store("toasts", {
                        counter: 0,
                        list: [],
                        createToast(message, type = "info") {
                            const index = this.list.length
                            this.list.push({
                                id: this.counter++,
                                message,
                                type,
                                visible: false,
                            })

                            // transition-enter fix:
                            setTimeout(() => {
                                this.list[index].visible = true
                                let totalVisible =
                                    this.list.filter((toast) => {
                                        return toast.visible
                                    }).length + 1
                                setTimeout(() => {
                                    this.destroyToast(index)
                                }, 2000 * totalVisible)
                            }, 0)
                        },
                        destroyToast(index) {
                            this.list[index].visible = false
                        },
                    })
                }),
                document.addEventListener('aliowa:toast', event => {
                    Alpine.store('toasts').createToast(event.detail.message, event.detail.type);
                })
            </script>
HTML;
        });
    }

    public function register()
    {
        //
    }
}