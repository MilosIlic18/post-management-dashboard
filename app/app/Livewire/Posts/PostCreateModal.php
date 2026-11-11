<?php

namespace App\Livewire\Posts;

use App\Services\PostService;
use Livewire\Attributes\On;
use Livewire\Component;

class PostCreateModal extends Component
{
   private PostService $postService;
   public string $title = '';
   public bool $showModal = false;

   public function boot(PostService $postService): void {

        $this->postService = $postService;
    }

    protected function rules(): array {

        return [
            'title' => ['required','string','max:255'],
        ];
    }

    protected function messages(): array {

        return [
            'title.required' => 'Naziv je obavezan.',
            'title.string'   => 'Naziv mora biti tekst.',
            'title.max'      => 'Naziv može imati maksimalno 255 karaktera.',
        ];
    }

    #[On('create-post')]
    public function openModal(): void {

        $this->showModal = true;
    }

    public function closeModal(): void {

        $this->reset('title');
        $this->resetValidation();
        $this->dispatch('refresh-post-groups');
        $this->showModal = false;
    }

    public function createPost(): void {

        $this->postService->createPost($this->validate());

        $this->reset('title');
        $this->showModal = false;
        $this->dispatch('refresh-post-groups');

    }

    public function render()
    {
        return view('livewire.posts.post-create-modal');
    }
}
