
<template>
    <div class="mt-8 -mx-4 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg "
    style="max-height: 25rem;
    overflow: auto;"
    >
        <table class="min-w-full divide-y divide-gray-300">
            <thead class="dark:bg-slate-900 light:bg-gray-50">
                <tr>
                    <slot name="headColumns" />
                </tr>
            </thead>
            <tbody class="dark:bg-slate-900 light:bg-white divide-y divide-gray-200">
                <slot name="tableRows" />
            </tbody>
        </table>
        <template v-if="paginator">
            <div class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
                <div class="flex justify-between flex-1 sm:hidden">
                    <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Previous</a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Next</a>
                </div>
                <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing
                            <span class="font-medium">{{ paginator.from }}</span>
                            to
                            <span class="font-medium">{{  paginator.to }}</span>
                            of
                            <span class="font-medium">{{ paginator.total }}</span>
                            results
                        </p>
                    </div>
                    <div>
                        <nav class="inline-flex -space-x-px rounded-md shadow-sm isolate" aria-label="Pagination">
                            <a :href="paginator.prev_page_url"
                               class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50 focus:z-20"
                            >
                                <span class="sr-only">Previous</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                </svg>
                            </a>
                            <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                            <template v-for="(link,index) in paginator.links" :key="link.label">
                                <a
                                    v-if="link.label == index"
                                    :href="link.url"
                                    :class="{'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : link.active}"
                                    class="relative items-center hidden px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-50 focus:z-20 md:inline-flex">
                                    {{ link.label }}
                                </a>
                            </template>

                            <a :href="paginator.next_page_url" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50 focus:z-20">
                                <span class="sr-only">Next</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>
<script setup>
defineProps(['paginator'])
</script>

