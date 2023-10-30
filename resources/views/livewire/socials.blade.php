<div class="max-w-6xl mx-auto py-5  " x-data="{
    openTab: 1,
    active: 'text-white border-white',
    inactive: ' hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 ',
}">
    @include('livewire.modal')
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
            <li class="mr-2" @click="openTab = 1" wire:ignore>
                <button :class="openTab == 1 ? active : inactive"
                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg">Blog</button>
            </li>
            <li class="mr-2" class="mr-2" @click="openTab = 2" wire:ignore>
                <button :class="openTab == 2 ? active : inactive"
                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg">Friends</button>
            </li>
            <li class="mr-2" class="mr-2" @click="openTab = 3" wire:ignore>
                <button :class="openTab == 3 ? active : inactive"
                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg">Pending Outgoing
                    Requests</button>
            </li>

            <li class="mr-2" class="mr-2" @click="openTab = 4" wire:ignore>
                <button :class="openTab == 4 ? active : inactive"
                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg">Pending Incoming
                    Requests</button>
            </li>



        </ul>
    </div>




    <div x-show="openTab === 1" class=" p-4 rounded-lg " wire:ignore.self>


        <div @class(['pt-15 w-4/5 m-auto', 'hidden' => !Auth::check()])>
            <x-secondary-button class="show-modal" wire:ignore>
                Create post
            </x-secondary-button>
        </div>


        @foreach ($posts as $post)
            @if (optional(auth()->user()->friendInstance($post->user->toArray()))->status == 'confirmed' || $post->user_id == auth()->user()->id)
                <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-400  py-5">
                    <div>
                        <img src="{{ asset('storage/photos/' . $post->image_path) }}" alt="" class="rounded">
                    </div>
                    <div class=" mb-8">
                        <h2 class="text-gray-300 font-bold text-4xl pb-4">
                            {{ $post->title }} </h2>

                        <span class="text-gray-500">
                            By <span class="font-bold italic text-gray-300">{{ $post->user->name }}</span>, Created on
                            {{ date('jS M Y', strtotime($post->updated_at)) }}
                        </span>

                        <p class=" text-gray-300 pt-5 pb-7  font-light text-justify">
                            {{ $post->description }}
                        </p>

                        <a class="uppercase bg-blue-500 text-gray-100 font-extrabold py-3 px-5 rounded-2xl ">
                            Keep Reading
                        </a>

                        @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                            <span class="float-right">
                                <a href="/blog/{{ $post->slug }}/edit"
                                    class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2">
                                    Edit
                                </a>
                            </span>

                            <span class="float-right">
                                <form action="/blog/{{ $post->slug }}" method="POST">
                                    @csrf
                                    @method('delete')

                                    <button class="text-red-500 pr-3" type="submit">
                                        Delete
                                    </button>

                                </form>
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>



    <div x-show="openTab === 2" class=" p-4 rounded-lg " wire:ignore.self>


        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-3 p-2 ">
            @foreach ($friends as $key => $friend)
                {{-- friends --}}
                <div class="w-full bg-white border  rounded-lg p-5 shadow h-72">






                    <div class="flex flex-col items-center pb-10">

                        <img src="https://source.unsplash.com/500x500?face-{{ $key }}" alt="image"
                            class="w-24 h-24 mb-2 5 rounded-full shadow-lg">
                        <h5 class="mb-1 text-xl font-medium text-gray-900 ">
                            {{ $friend->name }}
                        </h5>
                        <span class="text-sm text-gray-500">{{ $friend->email }} </span>

                        <div class="flex mt-4 space-x-1 md:mt-6">

                            <x-danger-button wire:click="unFriend({{ $friend }})">

                                <svg fill="#ffffff" height="20px" width="20px" version="1.1" id="Layer_1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 368.373 368.373" xml:space="preserve" stroke="#ffffff"
                                    stroke-width="9.577698">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g id="XMLID_107_">
                                            <path id="XMLID_108_"
                                                d="M368.373,241.936c0-57.897-47.102-105-105-105c-34.485,0-65.14,16.713-84.293,42.463 c-7.653-1.61-15.582-2.463-23.707-2.463c-8.643,0-17.064,0.965-25.165,2.781c-38.121,8.543-69.149,36.066-82.606,72.092 c-4.669,12.5-7.229,26.02-7.229,40.127c0,8.284,6.716,15,15,15h125.596c19.246,24.348,49.03,40,82.404,40 C321.271,346.936,368.373,299.834,368.373,241.936z M188.373,241.936c0-20.01,7.892-38.199,20.708-51.662 c13.67-14.359,32.946-23.338,54.292-23.338c41.355,0,75,33.645,75,75s-33.645,75-75,75c-13.592,0-26.339-3.652-37.344-10 C203.549,293.97,188.373,269.7,188.373,241.936z">
                                            </path>
                                            <path id="XMLID_138_"
                                                d="M32.622,84.187c0,23.666,18.367,43.109,41.594,44.857c-7.382-13.302-11.594-28.596-11.594-44.857 s4.212-31.556,11.594-44.857C50.989,41.077,32.622,60.521,32.622,84.187z">
                                            </path>
                                            <path id="XMLID_169_"
                                                d="M15,251.809h1.025c11.601-40.229,40.192-73.322,77.464-90.984c-5.17-1.077-10.482-1.639-15.867-1.639 C34.821,159.186,0,194.008,0,236.809C0,245.094,6.716,251.809,15,251.809z">
                                            </path>
                                            <path id="XMLID_197_"
                                                d="M218.123,84.187c0-34.601-28.149-62.75-62.75-62.75c-21.093,0-39.774,10.473-51.157,26.479 c-7.289,10.25-11.594,22.764-11.594,36.271s4.305,26.021,11.594,36.271c11.383,16.006,30.065,26.478,51.157,26.478 C189.974,146.936,218.123,118.787,218.123,84.187z">
                                            </path>
                                            <path id="XMLID_221_"
                                                d="M293.373,256.936c8.284,0,15-6.716,15-15c0-8.284-6.716-15-15-15h-43.2h-16.8c-8.284,0-15,6.716-15,15 c0,8.284,6.716,15,15,15h31.546H293.373z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                            </x-danger-button>
                            <x-secondary-button wire:click="message({{ $friend->id }})">
                                Message
                            </x-secondary-button>

                        </div>

                    </div>


                </div>
            @endforeach
        </div>

    </div>




    <div x-show="openTab === 3" class=" p-4 rounded-lg" wire:ignore.self>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-3 p-2 ">
            @foreach ($pendingOutgoingRequests as $key => $pendingFriend)
                {{-- outgoing --}}
                <div class="w-full bg-white border  rounded-lg p-5 shadow h-72">

                    <div class="flex flex-col items-center pb-10">

                        <img src="https://source.unsplash.com/500x500?face-{{ $key }}" alt="image"
                            class="w-24 h-24 mb-2 5 rounded-full shadow-lg">
                        <h5 class="mb-1 text-xl font-medium text-gray-900 ">
                            {{ $pendingFriend->name }}
                        </h5>
                        <span class="text-sm text-gray-500">{{ $pendingFriend->email }} </span>

                        <div class="flex mt-4 space-x-3 md:mt-6">

                            <x-secondary-button wire:click="rejectFriendRequest({{ $pendingFriend }})">
                                Cancel
                            </x-secondary-button>

                            <x-primary-button wire:click="message({{ $pendingFriend->id }})">
                                Message
                            </x-primary-button>

                        </div>

                    </div>
                </div>
            @endforeach
        </div>


    </div>

    <div x-show="openTab === 4" class=" p-4 rounded-lg" wire:ignore.self>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-3 p-2 ">
            @foreach ($pendingIncomingRequests as $key => $pendingFriend)
                {{-- incoming --}}
                <div class="w-full bg-white border  rounded-lg p-5 shadow h-72">

                    <div class="flex flex-col items-center pb-10">

                        <img src="https://source.unsplash.com/500x500?face-{{ $key }}" alt="image"
                            class="w-24 h-24 mb-2 5 rounded-full shadow-lg">
                        <h5 class="mb-1 text-xl font-medium text-gray-900 ">
                            {{ $pendingFriend->name }}
                        </h5>
                        <span class="text-sm text-gray-500">{{ $pendingFriend->email }} </span>

                        <div class="flex mt-4 space-x-3 md:mt-6">

                            <x-secondary-button wire:click="acceptFriendRequest({{ $pendingFriend }})">
                                Accept
                            </x-secondary-button>

                            <x-danger-button wire:click="rejectFriendRequest({{ $pendingFriend }})">
                                Reject
                            </x-danger-button>

                        </div>

                    </div>


                </div>
            @endforeach
        </div>


    </div>

</div>
</div>
