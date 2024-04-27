<div>
    <div class="slider swiper">
        <div class="swiper-wrapper bg-slate-300">
            @foreach ($subCategories as $index => $sub)
            <a href=" {{ route('subcategory.show', $sub -> id) }}" class="swiper-slide flex flex-col items-center bg-slate-500 p-5 rounded-lg cursor-pointer">
                <x-dynamic-images :file_url="$sub-> file_url" />
                <p>{{ $sub->name }} </p>
            </a>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>
</div>
