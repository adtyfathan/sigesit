<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

new class extends Component {
    use WithFileUploads;

    public string $name = '';
    public string $email = '';

    #[Validate('nullable|image|max:2048')] // 2MB max for avatar
    public $avatar;

    public $currentAvatar = null;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->currentAvatar = $user->avatar;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'avatar' => ['nullable', 'image', 'max:2048'], // 2MB max
        ]);

        // Handle avatar upload
        if ($this->avatar) {
            // Delete old avatar if exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Store new avatar with a unique name
            $fileName = 'avatar_' . $user->id . '_' . time() . '.' . $this->avatar->getClientOriginalExtension();
            $path = $this->avatar->storeAs('avatars', $fileName, 'public');
            $user->avatar = $path;

            $this->avatar = null;
        }

        $user->fill([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Update current avatar for display
        $this->currentAvatar = $user->avatar;

        $this->dispatch('profile-updated', name: $user->name);

        Session::flash('status', 'profile-updated');
    }

    public function removeAvatar(): void
    {
        $user = Auth::user();

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->avatar = null;
        $user->save();

        $this->currentAvatar = null;

        Session::flash('status', 'avatar-removed');
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('home', absolute: false));
            return;
        }

        $user->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <!-- Avatar Section -->
        <div class="space-y-4">
            <x-input-label for="avatar" :value="__('Avatar')" />

            <!-- Current Avatar Display -->
            <div class="flex items-center space-x-6">
                <div class="shrink-0">
                    @if ($currentAvatar)
                        <img class="h-20 w-20 object-cover rounded-full border-2 border-gray-300"
                            src="{{ Storage::url($currentAvatar) }}" alt="Current avatar">
                    @else
                        <div class="h-20 w-20 rounded-full bg-gray-300 flex items-center justify-center">
                            <img class="h-20 w-20 object-cover rounded-full border-2 border-gray-300"
                                src="{{ asset('images/default-avatar.png') }}" alt="Current avatar">
                        </div>
                    @endif
                </div>

                <div class="flex-1">
                    <!-- File Input -->
                    <input type="file" id="avatar" wire:model="avatar" accept="image/*"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">

                    <!-- Preview for new upload -->
                    @if ($avatar)
                        <div class="mt-2">
                            <img src="{{ $avatar->temporaryUrl() }}"
                                class="h-20 w-20 object-cover rounded-full border-2 border-green-300" alt="Avatar preview">
                            <p class="text-sm text-green-600 mt-1">New avatar ready to save</p>
                        </div>
                    @endif

                    <!-- Remove Avatar Button -->
                    @if ($currentAvatar && !$avatar)
                        <button type="button" wire:click="removeAvatar"
                            wire:confirm="Are you sure you want to remove your avatar?"
                            class="mt-2 text-sm text-red-600 hover:text-red-800">
                            Remove Avatar
                        </button>
                    @endif
                </div>
            </div>

            <div class="text-sm text-gray-500">
                <p>Accepted formats: JPG, PNG. Maximum size: 2MB.</p>
            </div>

            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <!-- Name Field -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email Field -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required
                autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button wire:click.prevent="sendVerification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Submit Section -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('Saved.') }}
            </x-action-message>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-green-600">
                    {{ __('Profile updated successfully.') }}
                </p>
            @endif

            @if (session('status') === 'avatar-removed')
                <p class="text-sm text-green-600">
                    {{ __('Avatar removed successfully.') }}
                </p>
            @endif
        </div>
    </form>
</section>