<div class="bg-red-100 p-3 rounded-lg">
    <button class="bg-blue-300 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded my-[15px]" wire:click="createPost()">Kreiraj post</button>
    <livewire:posts.post-create-modal />

        <div class="space-y-3 mt-2 cursor-default">
            @foreach($posts as $post)

                <div class="flex items-center justify-between rounded-xl border border-gray-200 bg-white p-4 shadow-sm transition hover:shadow-md">

                    <div class="flex items-center gap-4">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 text-sm font-medium text-gray-500">
                            {{ $loop->iteration }}
                        </span>

                        <span class="font-medium text-gray-800">
                            {{ $post->title }}
                        </span>
                    </div>

                    
                    
                    <span class="rounded-full bg-[#D7CCC8]/60 px-3 py-1 text-xs font-semibold text-brown-700">
                        Count : {{$post->duplicate_count}}
                    </span>
                    

                </div>

            @endforeach
        </div>
</div>