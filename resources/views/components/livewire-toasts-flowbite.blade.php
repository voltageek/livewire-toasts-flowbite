<div x-data class="fixed top-0 right-0 left-0 lg:left-auto p-4 overflow-x-hidden z-200">
    <template x-for="(toast, index) in $store.toasts.list" :key="toast.id">
        <div x-show="toast.visible" @click="$store.toasts.destroyToast(index)"
            x-transition:enter="transition ease-in duration-200"
            x-transition:enter-start="transform opacity-0 translate-y-2" x-transition:enter-end="transform opacity-100"
            x-transition:leave="transition ease-out duration-300"
            x-transition:leave-start="transform translate-y-0 opacity-100"
            x-transition:leave-end="transform translate-y-full opacity-0"
            class="shadow-lg mx-auto w-96 max-w-full text-md pointer-events-auto bg-clip-padding rounded-lg block mb-3"
            >
            <div class="flex justify-between items-center py-2 px-3 bg-clip-padding border-b border-gray-500 rounded-t-lg"
            :class="{
                'bg-blue-600': toast.type === 'info',
                'bg-green-600': toast.type === 'success',
                'bg-yellow-500': toast.type === 'warning',
                'bg-pink-500': toast.type === 'danger',
            }">
                <p class="font-bold text-white flex items-center">
                    <i x-show="toast.type == 'info'" class="fa-solid fa-circle-info"></i>
                    <i x-show="toast.type == 'success'" class="fa-solid fa-circle-check"></i>
                    <i x-show="toast.type == 'warning'" class="fa-solid fa-circle-exclaimation"></i>
                    <i x-show="toast.type == 'error'" class="fa-solid fa-circle-xmark"></i>
                </p>
                <div class="flex items-center">
                    {{-- <p class="text-white opacity-90 text-xs">11 mins ago</p> --}}
                    <button type="button"
                        class="btn-close btn-close-white box-content w-4 h-4 ml-2 text-white border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-white hover:opacity-75 hover:no-underline"
                        aria-label="Close"></button>
                </div>
            </div>
            <div class="p-3 rounded-b-lg break-words bg-white" x-text="toast.message"></div>
        </div>
    </template>
</div>
