<x-front-layout>
  <!-- Main Content -->
  <section class="bg-darkGrey relative py-[70px]">
    <div class="container">
      <!-- Breadcrumb -->
      <ul class="flex items-center gap-5 mb-[50px]">
        <li
            class="text-secondary font-normal text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-5">
          <a href="{{ route('front.home') }}">Home</a>
        </li>
        <li
            class="text-secondary font-normal text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-5">
          <a href="{{ route('front.catalog.type', $type->slug) }}">
            {{ $car->type->name }}
          </a>
        </li>
        <li
            class="text-dark font-semibold text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-5">
          Details
        </li>
      </ul>

      <div class="grid grid-cols-12 gap-[30px]">
        <!-- Car Preview -->
        <div class="col-span-12 lg:col-span-8">
          <div class="bg-white p-4 rounded-[30px] flex flex-col gap-4" id="gallery">
            <img :src="thumbnails[activeThumbnail].url" :key="thumbnails[activeThumbnail].id"
                 class="md:h-[490px] rounded-[18px] h-auto w-full" alt="">
            <div class="grid items-center grid-cols-4 gap-3 md:gap-5">
              <div v-for="(thumbnail, index) in thumbnails" :key="thumbnail.id">
                <a href="#!" @click="changeActive(index)">
                  <img :src="thumbnail.url" alt="" class="thumbnail"
                       :class="{ selected: index == activeThumbnail }">
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Details -->
        <div class="col-span-12 md:col-start-5 lg:col-start-auto md:col-span-8 lg:col-span-4">
          <div class="bg-white p-5 pb-[30px] rounded-3xl h-full">
            <div class="flex flex-col h-full divide-y divide-grey">
              <!-- Name, Category, Rating -->
              <div class="max-w-[230px] pb-5">
                <h1 class="font-bold text-[28px] leading-[42px] text-dark mb-[6px]">
                    {{ $car->name }}
                </h1>
                <p class="text-secondary font-normal text-base mb-[10px]">
                  {{ $car->type->name }}
                </p>
                {{-- stock --}}
                <p class="text-primary font-normal text-base mb-[10px]">
                  Stock: {{ $car->stock }}
                </p>
              </div>
              <!-- Features -->
              <ul class="flex flex-col gap-4 flex-start pt-5 pb-[25px]">
                @php
                  $features = explode(',', $car->features);
                @endphp
                @foreach ($features as $feature)
                  <li class="flex items-center gap-3 text-base font-semibold text-dark">
                    <img src="/svgs/ic-checkDark.svg" alt="">
                    {{ $feature }}
                  </li>
                @endforeach
              </ul>
              <!-- Price, CTA Button -->
              <div class="flex items-center justify-between gap-4 pt-5 mt-auto">
                <div>
                  <p class="font-bold text-dark text-[22px]">
                    Rp.{{ number_format($car->price) }}
                  </p>
                  <p class="text-base font-normal text-secondary">
                    /day
                  </p>
                </div>
                <div class="w-full max-w-[70%]">
                  <!-- Button Primary -->
                  <div class="p-1 rounded-full bg-primary group">
                    {{-- if stock <= 0 cannot checkout --}}
                    @if ($car->stock <= 0)
                      <a href="#!" class="btn-primary">
                        <p>
                          Out of Stock
                        </p>
                      </a>
                    @else
                        <a href="{{ route('front.catalog.checkout', $car->slug) }}" class="btn-primary">
                            <p>
                            Book Now
                            </p>
                            <img src="/svgs/ic-arrow-right.svg" alt="">
                        </a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Similar Cars -->
  <section class="bg-darkGrey">
    <div class="container relative py-[100px]">
      <header class="mb-[30px]">
        <h2 class="font-bold text-dark text-[26px] mb-1">
          Similar Cars
        </h2>
        <p class="text-base text-secondary">Start your big day</p>
      </header>

      <!-- Cars -->
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-[29px]">
        @foreach ($similarCars as $similarCar)
          <!-- Card -->
          <div class="card-popular">
            <div>
              <h5 class="text-lg text-dark font-bold mb-[2px]">
                {{ $similarCar->name }}
              </h5>
              <p class="text-sm font-normal text-secondary">
                {{ $similarCar->type ? $similarCar->type->name : '-' }}
              </p>
              <a href="{{ route('front.catalog.detail', $similarCar->slug) }}" class="absolute inset-0"></a>
            </div>
            <img src="{{ $similarCar->thumbnail }}" class="rounded-[18px] min-w-[216px] w-full h-[150px]"
                 alt="">
            <div class="flex items-center justify-between gap-1">
              <!-- Price -->
              <p class="text-sm font-normal text-secondary">
                <span class="text-base font-bold text-primary">Rp.{{ $similarCar->price }}</span>/day
              </p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <script src="https://unpkg.com/vue@next/dist/vue.global.js"></script>
  <script>
    const {
      createApp
    } = Vue
    createApp({
      data() {
        return {
          activeThumbnail: 0,
          thumbnails: [
            @foreach (json_decode($car->photos) as $key => $photo)
              {
                id: {{ $key }},
                url: "{{ Storage::url($photo) }}"
              },
            @endforeach
          ],
        }
      },
      methods: {
        changeActive(id) {
          this.activeThumbnail = id;
        }
      }
    }).mount('#gallery')
  </script>

  <script src="https://code.jquery.com/jquery-3.6.3.min.js"
          integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</x-front-layout>
