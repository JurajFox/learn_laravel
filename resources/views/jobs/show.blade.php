<x-layout>
    <x-slot:heading>Job Page</x-slot:heading>

    <h2 class="font-bold text-lg">{{ $job->title }}</h2>
    <p>This job pays {{ $job->salary}} per year.</p>
    <p class="mt-5">
        <x-link-button href="/jobs/{{ $job->id }}/edit">Edit Job</x-link-button>
    </p>
    
</x-layout>