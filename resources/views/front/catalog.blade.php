<x-front-layout>

  <!-- Popular Cars -->
  <section class="bg-darkGrey" id="popularCars">
    <div class="container relative py-[100px]">
      <header class="mb-[30px]">
        <h2 class="font-bold text-dark text-[26px] mb-1">
          Catalog
        </h2>
      </header>

      <!-- Cars -->
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-[29px] mb-10">
           <div class="card-popular">
            <div>
              <h5 class="text-lg text-dark font-bold mb-[2px]">
                All Type
              </h5>
              <a href="{{ route('front.catalog') }}" class="absolute inset-0"></a>
            </div>
          </div>
        @foreach ($types as $type)
          <!-- Card -->
          <div class="card-popular">
            <div>
              <h5 class="text-lg text-dark font-bold mb-[2px]">
                {{ $type->name }}
              </h5>
              <a href="{{ route('front.catalog.type', $type->slug) }}" class="absolute inset-0"></a>
            </div>
          </div>
        @endforeach
      </div>

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
                <span class="text-base font-bold text-primary">Rp.{{ $car->price }}</span>/day
              </p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>



  <footer class="py-10 md:pt-[100px] md:pb-[70px] container">
    <p class="text-base text-center text-secondary">
     2023 Copyright SetiaAbadi | Created by Farino Joshua
    </p>
  </footer>
</x-front-layout>
