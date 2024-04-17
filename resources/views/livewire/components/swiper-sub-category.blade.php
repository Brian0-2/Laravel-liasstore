<div>
    <div class="slider swiper">
        <div class="swiper-wrapper bg-slate-300">
            @foreach ($subCategories as $index => $sub)
                <div class="swiper-slide flex flex-col items-center bg-slate-500 p-5 rounded-lg">
                    @if ($sub -> id == "1")
                        <img width="200px" height="300px"  src="{{ asset('storage/images/hombres.webp') }}" alt="imagen">
                    @endif
                    <p>  {{ $sub->name }} </p>
                </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>
</div>
