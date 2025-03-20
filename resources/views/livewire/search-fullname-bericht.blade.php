<div>

        <div class="mt-2">
            <input 
                id="searchText"
                type="text" 
                class="p-4 w-full border rounded-md bg-cool-gray-200 text-black"
                wire:model.live.debounce="searchText"
                placeholder="klantnaam zoeken..."
            >
        </div>
        <livewire:search-fullname-results :results="$results"/>
</div>
