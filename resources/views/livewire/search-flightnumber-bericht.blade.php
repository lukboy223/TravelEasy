<div>

        <div class="mt-2">
            <input 
                id="flightnumberSearch"
                type="text" 
                class="p-4 w-full border rounded-md bg-cool-gray-200 text-black"
                wire:model.live.debounce="flightnumberSearch"
                placeholder="klantnaam zoeken..."
                value="{{ $flightnumberSearch }}"
            >
        </div>

        <livewire:search-fullname-results :results="$results"/>
</div>