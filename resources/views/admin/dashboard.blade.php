<x-layouts.admin title="Dashboard" heading="Dashboard">
    <x-admin.empty-state
        icon="ti-dashboard"
        title="Dashboard is ready"
        body="Add the widgets and shortcuts you want to see here as the admin experience grows."
    >
        <x-slot:action>
            <a class="btn btn-primary" href="{{ route('admin.settings.edit') }}">Manage settings</a>
        </x-slot:action>
    </x-admin.empty-state>
</x-layouts.admin>
