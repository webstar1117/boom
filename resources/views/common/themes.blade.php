
<div id="theme-content" class="theme-wrapper">
    <div class="category-wrapper">
        <h5>SELECT CATEGORY:</h5>
        <select name="category" id="category">
            <option value="all">All</option>
            @foreach ($theme_categories as $item)
                <option value="{{ $item->id }}">
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
        <div class="close-btn">
            <i class="fas fa-times" onclick="closingSelectingTheme()"></i>
        </div>
    </div>
    <div class="owl-carousel carousel">
        @foreach ($themes as $item)
            <div class="single-theme" data-category-id="{{ $item->category_id }}">
                <img onclick="selectTheme(this,{{ $item->id }}, '{{ $item->css_file }}')"
                    src="{{ asset('/assets/images/themes/screenshot/' . $item->image) }}" alt="" />
                <p class="theme-title">{{ $memorial->firstname }} {{ $memorial->middlename }} {{ $memorial->lastname }}</p>
                <div class="save-btn-wrapper">
                    <button class="btn save-btn" onclick="saveTheme()">Save</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
