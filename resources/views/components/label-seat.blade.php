@props(['disabled', 'seat'])


<label for="{{ $attributes['for'] }}" data-tooltip-target="{{ $attributes['data-tooltip-target'] }}"
    {{ $attributes->merge(['class' => 'flex flex-col gap-4 items-center select-none font-bold transition-colors duration-200 ease-in-out peer-checked:border-purple-600 peer-checked:text-purple-600 [&>svg]:h-10 [&>svg]:w-10)' . ($disabled ? ' border-red-500 text-red-500' : ' border-gray-300 text-gray-300 cursor-pointer')]) }}>
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Icons"
        viewBox="0 0 32 32" xml:space="preserve" class=" fill-current">
        <style type="text/css">
            .st0 {
                stroke: #000000;
                stroke-width: 2;
                stroke-linecap: round;
                stroke-linejoin: round;
                stroke-miterlimit: 10;
            }
        </style>
        <path class="st0" d="M9,29H5c-1.1,0-2-0.9-2-2V17c0-1.7,1.3-3,3-3h0c1.7,0,3,1.3,3,3V29z" />
        <path class="st0" d="M27,29h-4V17c0-1.7,1.3-3,3-3h0c1.7,0,3,1.3,3,3v10C29,28.1,28.1,29,27,29z" />
        <rect x="9" y="19" class="st0" width="14" height="10" />
        <path class="st0" d="M6,14V7.8C6,5.7,7.7,4,9.8,4h12.3C24.3,4,26,5.7,26,7.8V14" />
    </svg>
</label>
<div id="{{ $attributes['data-tooltip-target'] }}" role="tooltip"
    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white text-center transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
    Seat {{ $seat->id }} <br>
    @if ($disabled)
        <p class="text-red-500 font-bold">Not Available</p>
    @else
        <p class="text-green-500 font-bold">Available</p>
    @endif
    <div class="tooltip-arrow" data-popper-arrow></div>
</div>
