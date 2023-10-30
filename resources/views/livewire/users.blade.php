<div class="max-w-6xl mx-auto ">



    <h5 class="text-center text-3xl font-bold py-2 text-gray-300">Users
        <input type="text"
            class=" text-xs text-gray border-0 rounded-lg w-63 font-extrabold  text-gray-900 float-right mr-4"
            placeholder="Search" wire:model.live="search">

    </h5>


    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-3 p-2 ">

        @foreach ($users as $key => $user)
            {{-- child --}}
            <div class="w-full bg-white border border-gray-200 rounded-lg p-5 shadow h-72">

                <div class="flex flex-col items-center pb-10">

                    <img src="https://source.unsplash.com/500x500?face-{{ $key }}" alt="image"
                        class="w-24 h-24 mb-2 5 rounded-full shadow-lg">

                    <h5 class="mb-1 text-xl font-medium text-gray-900 ">
                        {{ $user->name }}
                    </h5>
                    <span class="text-sm text-gray-500">{{ $user->email }} </span>

                    <div class="flex mt-4 space-x-1 md:mt-6">






                        @if ($this->getFriendInstance($user) !== null)
                            @switch(optional($this->getFriendInstance($user))->status)
                                @case('pending')
                                    @if ($user->id == $this->getFriendInstance($user)->friend_id || $user->id == $this->getFriendInstance($user)->user_id)
                                        <x-secondary-button wire:click="test">
                                            pending
                                            {{-- <svg  width=15px fill="#ffffff" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff" stroke-width="49.92"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M1190.725 1368.395c77.93 63.247 151.68 122.993 191.096 252.763l22.25 72.96H515.336l22.137-72.96c39.416-129.77 113.167-189.516 191.21-252.763l169.524-137.675c35.577-28.913 87.304-29.026 122.993.113l169.525 137.562Zm142.306-641.393c135.529-109.891 304.263-246.663 304.263-670.531V0H282v56.47c0 423.869 168.734 560.64 304.264 670.532 88.884 72.057 147.5 119.605 147.5 232.998 0 113.393-58.616 160.941-147.5 232.885C450.734 1302.889 282 1439.66 282 1863.529V1920h1355.294v-56.47c0-423.869-168.734-560.64-304.263-670.645-88.772-71.944-147.502-119.492-147.502-232.885 0-113.393 58.73-160.941 147.502-232.998Z" fill-rule="evenodd"></path> </g></svg> --}}
                                        </x-secondary-button>
                                    @endif
                                @break

                                @case('confirmed')
                                    @if ($user->id == $this->getFriendInstance($user)->friend_id || $user->id == $this->getFriendInstance($user)->user_id)
                                        <x-danger-button wire:click="unFriend({{ $user }})">

                                            unfriend
                                            {{-- <svg fill="#ffffff" height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 368.373 368.373" xml:space="preserve" stroke="#ffffff" stroke-width="9.577698"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="XMLID_107_"> <path id="XMLID_108_" d="M368.373,241.936c0-57.897-47.102-105-105-105c-34.485,0-65.14,16.713-84.293,42.463 c-7.653-1.61-15.582-2.463-23.707-2.463c-8.643,0-17.064,0.965-25.165,2.781c-38.121,8.543-69.149,36.066-82.606,72.092 c-4.669,12.5-7.229,26.02-7.229,40.127c0,8.284,6.716,15,15,15h125.596c19.246,24.348,49.03,40,82.404,40 C321.271,346.936,368.373,299.834,368.373,241.936z M188.373,241.936c0-20.01,7.892-38.199,20.708-51.662 c13.67-14.359,32.946-23.338,54.292-23.338c41.355,0,75,33.645,75,75s-33.645,75-75,75c-13.592,0-26.339-3.652-37.344-10 C203.549,293.97,188.373,269.7,188.373,241.936z"></path> <path id="XMLID_138_" d="M32.622,84.187c0,23.666,18.367,43.109,41.594,44.857c-7.382-13.302-11.594-28.596-11.594-44.857 s4.212-31.556,11.594-44.857C50.989,41.077,32.622,60.521,32.622,84.187z"></path> <path id="XMLID_169_" d="M15,251.809h1.025c11.601-40.229,40.192-73.322,77.464-90.984c-5.17-1.077-10.482-1.639-15.867-1.639 C34.821,159.186,0,194.008,0,236.809C0,245.094,6.716,251.809,15,251.809z"></path> <path id="XMLID_197_" d="M218.123,84.187c0-34.601-28.149-62.75-62.75-62.75c-21.093,0-39.774,10.473-51.157,26.479 c-7.289,10.25-11.594,22.764-11.594,36.271s4.305,26.021,11.594,36.271c11.383,16.006,30.065,26.478,51.157,26.478 C189.974,146.936,218.123,118.787,218.123,84.187z"></path> <path id="XMLID_221_" d="M293.373,256.936c8.284,0,15-6.716,15-15c0-8.284-6.716-15-15-15h-43.2h-16.8c-8.284,0-15,6.716-15,15 c0,8.284,6.716,15,15,15h31.546H293.373z"></path> </g> </g></svg>   --}}

                                        </x-danger-button>
                                    @endif
                                @break

                                @case('blocked')
                                    @if ($user->id == $this->getFriendInstance($user)->friend_id || $user->id == $this->getFriendInstance($user)->user_id)
                                        <x-secondary-button disabled>
                                            blocked
                                        </x-secondary-button>
                                    @endif
                                @break

                                @default
                            @endswitch
                        @else
                            <x-secondary-button wire:click="addTofriends({{ $user }})">

                                <span class="text-green-400 font-extrabold text-sm">+</span> friend
                            </x-secondary-button>
                        @endif


                        <x-primary-button wire:click="message({{ $user->id }})">
                            Message
                        </x-primary-button>

                    </div>

                </div>


            </div>
        @endforeach

    </div>

        {{ $users->links('livewire.pagination') }}


</div>
