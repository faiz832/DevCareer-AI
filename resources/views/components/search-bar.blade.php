<div class="relative" x-data="searchComponent()">
    <div class="flex relative flex-1 max-w-xl">
        <input x-ref="searchInput" x-model="query" @input.debounce.300ms="performSearch" @click.outside="closeSearch"
            class="rounded-full border border-slate-300 w-full lg:w-[500px] px-4 py-2" type="search"
            placeholder="Search courses..." autocomplete="off">
    </div>

    <!-- Search Results Dropdown -->
    <div x-show="isSearching || results.length > 0" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95" style="display: none;"
        class="block absolute z-50 w-full bg-white border border-gray-300 rounded-lg shadow-lg mt-1 max-h-[350px] overflow-auto">
        <div class="p-2">
            <!-- Loading indicator -->
            <div x-show="isSearching" class="text-center py-2">
                <svg class="animate-spin h-5 w-5 mx-auto text-gray-500" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </div>

            <!-- Results list -->
            <template x-for="result in results" :key="result.id">
                <a :href="'/course/' + result.id"
                    class="flex w-full items-center px-4 py-2 hover:bg-gray-100 rounded transition-colors">
                    <div>
                        <div class="text-sm font-medium" x-text="result.name"></div>
                        <div class="text-xs text-gray-500" x-text="'in ' + result.category.name"></div>
                    </div>
                </a>
            </template>

            <!-- No results message -->
            <div x-show="!isSearching && query.length >= 2 && results.length === 0"
                class="text-center py-2 text-gray-500">
                No results found
            </div>
        </div>
    </div>
</div>

<script>
    function searchComponent() {
        return {
            query: '',
            results: [],
            isSearching: false,

            performSearch() {
                if (this.query.length < 1) {
                    this.results = [];
                    return;
                }

                this.isSearching = true;

                fetch(`/search?search=${this.query}`)
                    .then(response => response.json())
                    .then(data => {
                        this.results = data;
                        this.isSearching = false;
                    })
                    .catch(error => {
                        console.error('Error fetching search results:', error);
                        this.isSearching = false;
                    });
            },

            closeSearch() {
                this.results = [];
            }
        }
    }
</script>
