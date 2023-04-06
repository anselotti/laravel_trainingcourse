@if(session()->has('message'))

<div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition:leave="transition ease-out duration-1000" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-48 py-3">
    <p>
        {{session('message')}}
    </p>
</div>

@endif