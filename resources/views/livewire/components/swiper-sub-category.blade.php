<div>
    <div class="slider swiper">
        <div class="swiper-wrapper bg-slate-300">
            @foreach ($subCategories as $index => $sub)
            <a href=" {{ route('subcategory.show', $sub -> id) }}" class="swiper-slide flex flex-col items-center bg-slate-500 p-5 rounded-lg cursor-pointer">
                <picture>
                    <source srcset="{{ asset('storage/images/').'/'. $sub -> file_url . '.webp'}}" type="image/webp" >
                    <source srcset="{{ asset('storage/images/').'/'. $sub -> file_url . '.png'}}" type="image/png" >
                    <img loading="lazy" width="200px" height="300px"  src="{{ asset('storage/images/').'/'. $sub -> file_url. '.png' }}" alt="imagen {{ $sub -> file_url }}">
                </picture>
                <p>{{ $sub->name }} </p>
            </a>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

</div>
