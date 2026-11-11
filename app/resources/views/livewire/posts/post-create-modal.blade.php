<div>
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-white rounded-xl p-6 w-full max-w-lg">
                <h2 class="text-xl font-bold mb-4">
                    Kreiraj post
                </h2>

                <form wire:submit="createPost">
                    <div class="flex gap-2 justify-center mb-[10px]">
                        <input
                            type="text"
                            wire:model="title"
                            placeholder="Naziv posta"
                            class="w-full border rounded-lg p-2"
                        />
                        <span class="text-red-600">*</span>
                    </div>
                    @error('title')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    <div class="flex gap-4 mt-[10px]">
                        <button type="button" wire:click="createPost()" class="cursor-pointer">Sačuvaj</button>
                        <button type="button" wire:click="closeModal()" class="cursor-pointer">
                            Otkaži
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>