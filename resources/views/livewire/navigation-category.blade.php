<ul>
    <li class="relative group inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
        <button>Products</button>
        <div
            class="absolute top-0 left-0 group-hover:translate-y-5 translate-y-0 opacity-0 invisible group-hover:opacity-100 group-hover:visible duration-500 z-50 sm:min-w-[560px] min-w-72 transform">
            <div class="relative top-6 p-6 bg-white rounded-xl shadow-xl w-full">
                <div
                    class="w-10 h-10 bg-white transform rotate-45 absolute top-0 z-0 translate-x-0 transition-transform group-hover:translate-x-[12rem] duration-500 ease-in-out rounded-sm"
                ></div>

                <div class="relative z-10">

                    <div class="grid sm:grid-cols-4 gap-6 grid-cols-2">
                        @foreach($this->parents as $parent)
                            <div class="col-span-1">
                                <p class="uppercase tracking-wider text-gray-500 font-medium text-[13px]">
                                    {{ $parent->name }}
                                </p>
                                <ul class="mt-3 text-[15px]">
                                    @foreach($this->getChildren($parent->id) as $child)
                                        <li>
                                            <a
                                                href="{{ route('home', array('category' => $child->id)) }}"
                                                class="block p-2 -mx-2 rounded-lg hover:bg-gradient-to-br hover:from-indigo-50 hover:to-pink-50 hover:via-blue-50 transition ease-in-out duration-300 text-gray-800 font-semibold hover:text-indigo-600"
                                            >
                                                {{ $child->name }}
                                            </a>
                                        </li>
                                    @endforeach


                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

    </li>
</ul>
