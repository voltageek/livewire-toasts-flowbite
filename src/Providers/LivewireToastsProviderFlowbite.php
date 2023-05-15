<?php

namespace Voltageek\LivewireToastsFlowbite\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class LivewireToastsProviderFlowbite extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'voltageek');

        $this->callAfterResolving(BladeCompiler::class, function () {
            Blade::component('voltageek::components.livewire-toasts-flowbite', 'voltageek-livewire-toasts-flowbite');
        });

        if ($this->app->runningInConsole()) {
            $this->publishes(
                [__DIR__ . '/../../resources/views' => $this->app->resourcePath('views/vendor/voltageek')],
                ['voltageek', 'voltageek-livewire-toasts-flowbite', 'voltageek-livewire-toasts-flowbite:views']
            );
        }

        Blade::directive('voltageekLivewireToastsFlowbiteScripts', function () {
            return <<<'HTML'
            <script type="text/javascript">
                console.debug("Setting up alpine store");
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
                });
                document.addEventListener('voltageek:toast', event => {
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
