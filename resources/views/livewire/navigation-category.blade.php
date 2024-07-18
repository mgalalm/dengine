<div class="hs-dropdown [--strategy:static] md:[--strategy:absolute] [--adaptive:none] md:[--trigger:hover] py-3 md:px-3 md:py-6">
    <button type="button" class="flex items-center w-full text-gray-800 hover:text-gray-600 font-medium dark:text-neutral-200 dark:hover:text-neutral-500">
        {{ __('Categories') }}
        <svg class="flex-shrink-0 ms-2 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
    </button>

    <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 md:w-[705px] lg:w-[750px] hidden z-10 top-full end-0 overflow-hidden bg-white md:shadow-2xl rounded-lg dark:bg-neutral-800 dark:divide-neutral-700 before:absolute before:-top-5 before:start-0 before:w-full before:h-5">
        <div class="grid grid-cols-2 md:grid-cols-12 w-full">
            @for ($i = 0; $i < 4; $i++)
{{--                <div class="md:col-span-2">--}}
{{--                    <div class="flex flex-col py-6 px-3 md:px-6">--}}
{{--                        <div class="space-y-4">--}}
{{--                            <span class="mb-2 text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Category {{ $i + 1 }}</span>--}}

{{--                            <a class="flex gap-x-4 text-gray-800 hover:text-blue-600 dark:text-neutral-200" href="#">--}}
{{--                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="7" x="3" y="3"/><rect width="7" height="7" x="14" y="3"/><rect width="7" height="7" x="14" y="14"/><rect width="7" height="7" x="3" y="14"/></svg>--}}
{{--                                <div class="grow">--}}
{{--                                    <p>Subcategory 1</p>--}}
{{--                                </div>--}}
{{--                            </a>--}}

            <div class="md:col-span-3">
                <div class="flex flex-col py-6 px-3 md:px-6">
                    <div class="space-y-4">
                        <span class="mb-2 text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">About us</span>

                        <a class="flex gap-x-4 text-gray-800 hover:text-blue-600 dark:text-neutral-200" href="#">
                            <div class="grow">
                                <p>Support Docs</p>
                            </div>
                        </a>

                        <a class="flex gap-x-4 text-gray-800 hover:text-blue-600 dark:text-neutral-200" href="#">
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="7" x="14" y="3" rx="1"/><path d="M10 21V8a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H3"/></svg>
                            <div class="grow">
                                <p>Integrations</p>
                            </div>
                        </a>

                        <a class="flex gap-x-4 text-gray-800 hover:text-blue-600 dark:text-neutral-200" href="#">
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><line x1="10" x2="8" y1="9" y2="9"/></svg>
                            <div class="grow">
                                <p>Guides</p>
                            </div>
                        </a>

                        <a class="flex gap-x-4 text-gray-800 hover:text-blue-600 dark:text-neutral-200" href="#">
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7 11 2-2-2-2"/><path d="M11 13h4"/><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/></svg>
                            <div class="grow">
                                <p>API Reference</p>
                            </div>
                        </a>

                        <a class="flex gap-x-4 text-gray-800 hover:text-blue-600 dark:text-neutral-200" href="#">
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                            <div class="grow">
                                <p>API Status</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endfor


        </div>
    </div>
</div>
