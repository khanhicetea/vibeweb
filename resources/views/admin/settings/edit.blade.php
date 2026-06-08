<x-layouts.admin title="Website Settings" heading="Website Settings">
    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf
        @method('PUT')

        <div class="row row-cards">
            @foreach ($groups as $groupName => $settings)
                <div class="col-lg-6">
                    <x-admin.card :title="$groupName">
                        <div class="card-body">
                            @foreach ($settings as $setting)
                                @php
                                    $inputName = 'settings['.str_replace('.', '][', $setting['key']).']';
                                    $errorKey = 'settings.'.$setting['key'];
                                @endphp

                                <x-admin.field :label="$setting['label']" :name="$errorKey" :for="$setting['key']">
                                    @if ($setting['type'] === 'textarea')
                                        <x-admin.textarea
                                            id="{{ $setting['key'] }}"
                                            name="{{ $inputName }}"
                                            :error="$errorKey"
                                            rows="4"
                                            :value="old($errorKey, $setting['value'])"
                                        />
                                    @else
                                        <x-admin.input
                                            id="{{ $setting['key'] }}"
                                            name="{{ $inputName }}"
                                            type="{{ $setting['type'] }}"
                                            :error="$errorKey"
                                            :value="old($errorKey, $setting['value'])"
                                        />
                                    @endif
                                </x-admin.field>
                            @endforeach
                        </div>
                    </x-admin.card>
                </div>
            @endforeach
        </div>

        <div class="settings-actions">
            <button class="btn btn-primary" type="submit">Save settings</button>
        </div>
    </form>
</x-layouts.admin>
