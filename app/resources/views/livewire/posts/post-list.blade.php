<div class="cursor-default">
    
    <div class="mb-6 flex gap-4 items-center justify-between">
        <h2 class="text-xl font-semibold text-gray-800 cursor-pointer"  wire:click="filter('')"> 
            Postovi
        </h2>

        <div class="flex gap-3">
            <span class="rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-700">
                Ukupno {{ $statusesCount['total'] }}
            </span>

            <span class="rounded-full bg-yellow-100 px-3 py-1 text-sm font-medium text-yellow-700 cursor-pointer" wire:click="filter('pending')">
                Na čekanju {{ $statusesCount['pending'] }}
            </span>

            <span class="rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-700 cursor-pointer" wire:click="filter('complete')">
                Završeno {{ $statusesCount['completed'] }}
            </span>
        </div>
    </div>

    <div class="space-y-3">
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

                    @if($post->status === 'pending')
                        <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700 cursor-pointer" wire:click='update({{$post->id}})'>
                            Na čekanju
                        </span>
                    @else
                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                            Završeno
                        </span>
                    @endif

                </div>

            @endforeach
        </div>

</div>
