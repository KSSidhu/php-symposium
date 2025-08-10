<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $talk->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="grid gap-4 p-6 text-gray-900">
                    <div>
                        <h1>Abstract</h1>
                        {{ $talk->abstract }}
                    </div>

                    <div>
                        <h1>Length</h1>
                        {{ $talk->length }}
                    </div>

                    <div>
                        <h3>Organizer Notes</h3>
                        <span>{{ $talk->organizer_notes }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
