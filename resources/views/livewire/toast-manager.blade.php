<div x-data="{ show:  @entangle('show')}"
     x-show="show"
     x-transition.duration.500ms
     class="fixed bottom-5 right-5 p-4 rounded-lg shadow-lg text-white"
     :class="{
        'bg-blue-500': @js($type) === 'info',
        'bg-red-500': @js($type) === 'danger',
        'bg-yellow-500': @js($type) === 'warning',
        'bg-green-500': @js($type) === 'success'
     }"
     x-init="setTimeout(() => show = false, 3000)"
     style="display: none;">

    <span>{{ $message }}</span>

    <button @click="show = false" class="ml-4 text-white font-bold">X</button>
</div>

