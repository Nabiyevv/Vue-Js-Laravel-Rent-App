<template>
    <div class="flex w-full px-5">
        <select
            class="text-lg justify-center items-center text-gray-500 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200  dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white dark:border-gray-600"
        >
            <option>
                Baku
            </option>
            <option>
                Ganja
            </option>
        </select>

        <div class="relative w-full">
            <input
                type="search"
                class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 dark:bg-gray-700 dark:border-l-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white "
                placeholder="Search for city or address"
                required
            />
            <button
                type="submit"
                class="absolute top-0 right-0 h-full p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                <svg
                    class="w-4 h-4"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 20 20"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                    />
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </div>
    </div>
</template>

<script>

</script>
