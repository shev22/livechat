  {{-- overflow-x-hidden overflow-y-auto  --}}
  <div
      class=" bg-black bg-opacity-50 fixed top-10 left-0  z-50 flex w-full p-4 justify-center items-center h-screen hidden modal" wire:ignore.self>
      <div class="relative w-full max-w-2xl max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-start justify-between p-3 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                      Create post
                  </h3>
                  <button type="button"
                      class="close-modal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <div class="p-6 space-y-6 mx-auto">
                  <form wire:submit.prevent="storePost()"> 
                      <div class="border-b-2 border-gray-400">
                          <input type="text" wire:model="title" placeholder="Title..."
                              class="bg-transparent border-none w-full h-16 text-4xl leading-tight focus:outline-none text-gray-400">
                              @error('title') <span class="error text-red-400">{{ $message }}</span> @enderror
                      </div>
                      <div class="border-b-2 border-gray-400 mb-3">
                          <textarea wire:model="description" placeholder="Description..."
                              class="py-20 bg-transparent block border-none  w-full h-56 text-xl outline-none text-gray-400"></textarea>
                              @error('description') <span class="error text-red-400">{{ $message }}</span> @enderror
                      </div>


                      <div class="bg-grey-lighter flex mb-2">
                          <label
                              class="w-44 flex flex-col items-center px-2 py-3 bg-white-rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer rounded">
                              <span class="mt-2 text-base leading-normal text-gray-400">
                                  Select a file
                              </span>
                              <input type="file" wire:model="photo" class="hidden">
                          </label>

                
                      </div>

                      @error('photo') <span class="error text-red-400">{{ $message }}</span> @enderror
                  
              </div>
              <!-- Modal footer -->
              <div class="flex items-center p-2 space-x-1 border-t border-gray-200 rounded-b dark:border-gray-600">
                  <button type="button"
                      class="close-modal text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancel</button>
                  <button 
                      class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Save</button>
              </div>
            </form>
          </div>
      </div>
  </div>
