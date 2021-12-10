            <!-- banner area -->
            <section class="temp banner">
                <h2 class="color-white">{{ $memorial->firstname . ' ' . $memorial->middlename . ' ' . $memorial->lastname }}</h2>
                @if ($profile_photo)
                    <img class="template-profile-image" src="{{ asset('/assets/media/' . $profile_photo) }}" />
                @endif
            </section>
