@props(['value', 'required'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }} @if ($required ?? False) @include('components.required') @endif
</label>
