<x-front-layout>
  <!-- Hero -->
  <section class="container relative pb-[100px] pt-[30px]">
    <div class="flex flex-col lg:flex-row items-center justify-center gap-[30px]">
      <!-- Preview Image -->
      <div class="relative">
        <div class="absolute z-0 hidden lg:block">
          <div class="font-extrabold text-[220px] text-darkGrey tracking-[-0.06em] leading-[101%]">
            <div data-aos="fade-right" data-aos-delay="300">
              NEW
            </div>
            <div data-aos="fade-left" data-aos-delay="600">
              FORTUNER
            </div>
          </div>
        </div>
        <img src="/images/fortuner.png" class="w-full max-w-[963px] z-10 relative" alt="" data-aos="zoom-in"
             data-aos-delay="950">
      </div>

      <div class="flex flex-col items-center justify-around lg:gap-[60px] gap-7">
        <!-- Car Details -->
        <div class="flex items-center gap-y-12">
          <div class="flex flex-col items-center gap-[2px] px-3 md:px-10" data-aos="fade-left" data-aos-delay="1400">
            <h6 class="font-bold text-dark text-xl md:text-[26px] text-center">
               Bersiap untuk Petualangan Tanpa Batas!
            </h6>
          </div>
        </div>
        <!-- Button Primary -->
        <div class="p-1 rounded-full bg-primary group" data-aos="zoom-in" data-aos-delay="3400">
          <a href="{{ route('front.catalog') }}" class="btn-primary">
            <p class="transition-all duration-[320ms] translate-x-3 group-hover:-translate-x-1">
              Cari Mobil
            </p>
            <img src="/svgs/ic-arrow-right.svg"
                 class="opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all duration-[320ms]"
                 alt="">
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Popular Cars -->
  <section class="bg-darkGrey" id="popularCars">
    <div class="container relative py-[100px]">
      <header class="mb-[30px]">
        <h2 class="font-bold text-dark text-[26px] mb-1">
          Mobil
        </h2>
        <p class="text-base text-secondary">Mulai Sekarang!</p>
      </header>

      <!-- Cars -->
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-[29px]">
        @foreach ($cars as $car)
          <!-- Card -->
          <div class="card-popular">
            <div>
              <h5 class="text-lg text-dark font-bold mb-[2px]">
                {{ $car->name }}
              </h5>
              <p class="text-sm font-normal text-secondary">
                {{ $car->type ? $car->type->name : '-' }}
              </p>
              <a href="{{ route('front.catalog.detail', $car->slug) }}" class="absolute inset-0"></a>
            </div>
            <img src="{{ $car->thumbnail }}" class="rounded-[18px] min-w-[216px] w-full h-[150px]" alt="">
            <div class="flex items-center justify-between gap-1">
              <!-- Price -->
              <p class="text-sm font-normal text-secondary">
                <span class="text-base font-bold text-primary">Rp.{{ $car->price }}</span>/hari
              </p>
              <!-- Rating -->
              {{-- <p class="text-dark text-xs font-semibold flex items-center gap-[2px]">
                ({{ $item->star }}/5)
                <img src="/svgs/ic-star.svg" alt=""> --}}
              </p>
            </div>
          </div>
        @endforeach
      </div>
      <div class="flex items-center justify-center mt-12">
          <div class="p-1 rounded-full bg-primary group w-max">
              <a href="{{ route('front.catalog') }}" class="btn-primary">
              <p class="transition-all duration-[320ms] translate-x-3 group-hover:-translate-x-1">
                Lebih Banyak
              </p>
              <img src="/svgs/ic-arrow-right.svg"
                   class="opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all duration-[320ms]"
                   alt="">
              </a>
          </div>
      </div>
    </div>
  </section>

  <!-- Extra Benefits -->
  <section class="container relative pt-[100px]">
    <div class="flex items-center flex-col md:flex-row flex-wrap justify-center gap-8 lg:gap-[120px]">
      <img src="/images/review.svg" class="w-full lg:max-w-[536px]" alt="">
      <div class="max-w-[268px] w-full">
        <div class="flex flex-col gap-[30px]">
          <header>
            <h2 class="font-bold text-dark text-[26px] mb-1">
              Extra Benefits
            </h2>
            <p class="text-base text-secondary">Mengemudi dengan aman dan nyaman</p>
          </header>
          <!-- Benefits Item -->
          <div class="flex items-center gap-4">
            <div class="bg-dark rounded-[26px] p-[19px]">
              <img src="/svgs/ic-car.svg" alt="">
            </div>
            <div>
              <h5 class="text-lg text-dark font-bold mb-[2px]">
                Mobil Terbaik
              </h5>
              <p class="text-sm font-normal text-secondary">Dapatkan mobil dengan kualitas terbaik</p>
            </div>
          </div>
          <div class="flex items-center gap-4">
            <div class="bg-dark rounded-[26px] p-[19px]">
              <img src="/svgs/ic-card.svg" alt="">
            </div>
            <div>
              <h5 class="text-lg text-dark font-bold mb-[2px]">
                Harga
              </h5>
              <p class="text-sm font-normal text-secondary">Dapatkan harga terbaik</p>
            </div>
          </div>
          <div class="flex items-center gap-4">
            <div class="bg-dark rounded-[26px] p-[19px]">
              <img src="/svgs/ic-securityuser.svg" alt="">
            </div>
            <div>
              <h5 class="text-lg text-dark font-bold mb-[2px]">
                Aman
              </h5>
              <p class="text-sm font-normal text-secondary">Kami menjamin keamanan data anda</p>
            </div>
          </div>
          <div class="flex items-center gap-4">
            <div class="bg-dark rounded-[26px] p-[19px]">
              <img src="/svgs/ic-convert3dcube.svg" alt="">
            </div>
            <div>
              <h5 class="text-lg text-dark font-bold mb-[2px]">
                Kemudahan
              </h5>
              <p class="text-sm font-normal text-secondary">Transaksi dengan mudah dan aman</p>
            </div>
          </div>
        </div>
        <!-- CTA Button -->
        <div class="mt-[50px]">
          <!-- Button Primary -->
          <div class="p-1 rounded-full bg-primary group">
            <a href="{{ route('front.catalog') }}" class="btn-primary">
              <p class="transition-all duration-[320ms] translate-x-3 group-hover:-translate-x-10 text-center">
                Cari Mobil
              </p>
              <img src="/svgs/ic-arrow-right.svg"
                   class="transition-all duration-[320ms] opacity-0 group-hover:opacity-100 group-hover:translate-x-10"
                   alt="">
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="py-10 md:pt-[100px] md:pb-[70px] container">
    <p class="text-base text-center text-secondary">
      2023 Copyright SetiaAbadi | Created by Farino Joshua
    </p>
  </footer>
</x-front-layout>
